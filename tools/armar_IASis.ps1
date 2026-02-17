param(
  [string]$ProjectRoot = (Resolve-Path ".").Path,
  [string]$ForkRoot = "IASis"
)

$ErrorActionPreference = "Stop"

$moduleList = @(
  "inasistencia",
  "inasistenciaprueba",
  "alumnos",
  "docentes",
  "preceptores",
  "cargadocentes",
  "estadistica",
  "mesas",
  "comedor",
  "entrada",
  "dbf2mysql",
  "archivos",
  "classes",
  "mqtt",
  "prueba",
  "shell"
)

# Exclusiones para evitar terceros pesados o binarios sin valor para separar logica/vistas
$excludePathRegex = [regex]"\\(vendor|jpgraph|fpdf|ckeditor|ckeditor_full_back|webinfo|webinfo\.bak|uploads|font|fonts|media|themes|translations|addons|tmp|plugins\\PHPExcel|output\\plugins)(\\|$)"
$htmlMarkerRegex = [regex]"(?is)<!DOCTYPE|<html|<body"

$forkAbs = Join-Path $ProjectRoot $ForkRoot
$legacyRoot = Join-Path $forkAbs "legacy"
$migradoRoot = Join-Path $forkAbs "migrado"
$docsRoot = Join-Path $forkAbs "docs"

New-Item -ItemType Directory -Force $legacyRoot, $migradoRoot, $docsRoot | Out-Null

$report = @()

foreach ($module in $moduleList) {
  $srcModule = Join-Path $ProjectRoot $module
  if (-not (Test-Path $srcModule)) {
    $report += [pscustomobject]@{
      modulo = $module
      total_php = 0
      split_html = 0
      solo_logica = 0
      estado = "no_encontrado"
    }
    continue
  }

  $files = Get-ChildItem $srcModule -Recurse -File -Filter *.php -ErrorAction SilentlyContinue |
    Where-Object { $_.FullName -notmatch $excludePathRegex }

  $total = 0
  $split = 0
  $solo = 0

  foreach ($file in $files) {
    $total++
    $moduleBase = (Resolve-Path $srcModule).Path
    $rel = $file.FullName.Substring($moduleBase.Length + 1)

    $legacyTarget = Join-Path (Join-Path $legacyRoot $module) $rel
    New-Item -ItemType Directory -Force (Split-Path $legacyTarget) | Out-Null
    Copy-Item $file.FullName $legacyTarget -Force

    $content = Get-Content $file.FullName -Raw
    $match = $htmlMarkerRegex.Match($content)

    $logic = $content
    $view = "<?php /* Vista no separable automaticamente: archivo orientado a logica */ ?>`r`n"

    if ($match.Success -and $match.Index -gt 0) {
      $logic = $content.Substring(0, $match.Index)
      $view = $content.Substring($match.Index)
      $split++
    } else {
      $solo++
    }

    $relNoExt = [System.IO.Path]::ChangeExtension($rel, $null)
    if ($relNoExt.EndsWith(".")) { $relNoExt = $relNoExt.Substring(0, $relNoExt.Length - 1) }

    $logicTarget = Join-Path (Join-Path (Join-Path $migradoRoot $module) "logica") ($relNoExt + ".logic.php")
    $viewTarget  = Join-Path (Join-Path (Join-Path $migradoRoot $module) "vistas") ($relNoExt + ".view.php")

    New-Item -ItemType Directory -Force (Split-Path $logicTarget) | Out-Null
    New-Item -ItemType Directory -Force (Split-Path $viewTarget) | Out-Null

    Set-Content -Path $logicTarget -Value $logic -Encoding UTF8
    Set-Content -Path $viewTarget -Value $view -Encoding UTF8
  }

  $report += [pscustomobject]@{
    modulo = $module
    total_php = $total
    split_html = $split
    solo_logica = $solo
    estado = "ok"
  }
}

$timestamp = Get-Date -Format "yyyy-MM-dd HH:mm:ss"
$reportCsv = Join-Path $docsRoot "reporte_migracion.csv"
$report | Export-Csv -Path $reportCsv -NoTypeInformation -Encoding UTF8

$sumTotal = ($report | Measure-Object total_php -Sum).Sum
$sumSplit = ($report | Measure-Object split_html -Sum).Sum
$sumSolo = ($report | Measure-Object solo_logica -Sum).Sum

$md = @()
$md += "# Reporte de Armado IASis"
$md += ""
$md += "Fecha: $timestamp"
$md += ""
$md += "## Criterio aplicado"
$md += "- No se modifico codigo original del sistema."
$md += "- Se genero un fork paralelo en `IASis/legacy` con copias sin cambios."
$md += "- Se genero separacion automatica en `IASis/migrado/<modulo>/logica` y `IASis/migrado/<modulo>/vistas`."
$md += "- No se alteraron archivos de conexion a BD ni credenciales existentes (solo copia)."
$md += "- Se excluyeron carpetas de terceros/pesadas para evitar ruido tecnico (vendor, fpdf, ckeditor, jpgraph, etc.)."
$md += ""
$md += "## Totales"
$md += "- Archivos PHP procesados: $sumTotal"
$md += "- Archivos con separacion por marcador HTML: $sumSplit"
$md += "- Archivos orientados a logica (vista vacia automatica): $sumSolo"
$md += ""
$md += "## Estado por modulo"
foreach ($r in $report) {
  $md += "- $($r.modulo): total=$($r.total_php), split_html=$($r.split_html), solo_logica=$($r.solo_logica), estado=$($r.estado)"
}
$md += ""
$md += "## Observaciones"
$md += "- La separacion fue intencionalmente conservadora para no reescribir reglas de negocio ni SQL."
$md += "- En archivos con PHP intercalado dentro de HTML, parte de logica puede permanecer en `vistas` por compatibilidad."
$md += "- Este fork esta preparado para refactor incremental posterior por modulo."

Set-Content -Path (Join-Path $docsRoot "reporte_migracion.md") -Value ($md -join "`r`n") -Encoding UTF8

Write-Output "PROCESADOS=$sumTotal SPLIT=$sumSplit SOLO_LOGICA=$sumSolo"
