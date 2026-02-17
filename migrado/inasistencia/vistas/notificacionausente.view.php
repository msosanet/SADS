<?php if (!$iasisAuth) { return; } ?>
<!DOCTYPE html>
<html lang="es-ar">
<head>
<meta charset="utf-8" />
<title>Cedula de Notificacion (IASis)</title>
<style>
body { font-family: "Times New Roman", serif; margin: 32px; }
.cedula { border: 1px solid #333; padding: 18px; }
h1 { font-size: 24px; text-align: center; }
p { font-size: 18px; line-height: 1.35; }
.firma { margin-top: 40px; }
</style>
</head>
<body>
<?php if ($iasisParamWarning !== ''): ?>
<div style="border:1px solid #d32f2f;padding:10px;margin-bottom:16px;background:#ffebee;font-family:Arial,sans-serif;">
    <strong>Atencion:</strong> <?php echo htmlspecialchars($iasisParamWarning); ?>
    <br><br>
    <code>index.php?m=inasistencia&f=notificacionausente&dnix=123&fechaxxx=2026-02-16&materiax=Matematica&cursox=1A&turnox=M&tipox=A&vistax=N</code>
</div>
<?php endif; ?>
<div class="cedula">
    <h1>CEDULA DE NOTIFICACION N&deg; <?php echo htmlspecialchars($numero); ?></h1>

    <p style="text-align:right;">Ushuaia, <?php echo htmlspecialchars($hoyTxt); ?>.</p>

    <p>Docente: <strong><?php echo htmlspecialchars($nya); ?></strong></p>
    <p>DNI N&deg; <strong><?php echo htmlspecialchars($dni); ?></strong></p>
    <p>Domicilio: <strong><?php echo htmlspecialchars($domicilio); ?></strong></p>

    <p style="text-align:justify; text-indent: 35px;">
        Se hace saber a usted que, en el plazo de dos (2) dias habiles contados a partir de su notificacion,
        debera informar por escrito las razones que motivaron su <strong><?php echo htmlspecialchars($movi); ?></strong>
        del dia <strong><?php echo htmlspecialchars($faltaTxt); ?></strong>, en el espacio curricular
        <strong><?php echo htmlspecialchars($materia); ?></strong>, curso <strong><?php echo htmlspecialchars($curso); ?></strong>,
        turno <strong><?php echo htmlspecialchars($turno); ?></strong>.
    </p>

    <p style="text-align:justify; text-indent: 35px;">
        En caso contrario, quedara encuadrada/o en lo dispuesto por el Art. 31, Inc. b, Capitulo VI de la Ley 22.140.
    </p>

    <p style="text-align:center;"><strong>QUEDA USTED DEBIDAMENTE NOTIFICADA/O</strong></p>

    <div class="firma">
        <p>Firma: ...............................................................</p>
        <p>Aclaracion: ..........................................................</p>
        <p>Fecha y hora: .......................................................</p>
    </div>
</div>
</body>
</html>
