<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cargar Acto Público desde Excel</title>
    <style>
        textarea {
            width: 100%;
            height: 400px;
            font-family: monospace;
            font-size: 14px;
        }
        input[type=submit] {
            margin-top: 10px;
            padding: 8px 16px;
        }
    </style>
</head>
<body>

<h2>Cargar desde Excel</h2>
<p>Pegá los datos (mínimo 21 columnas, separadas por tabulación):</p>
<form method="post">
    <textarea name="exceldata" placeholder="Pegá aquí los datos desde Excel"></textarea>
    <br>
    <input type="submit" value="Guardar en base de datos">
</form>

</body>
</html>

