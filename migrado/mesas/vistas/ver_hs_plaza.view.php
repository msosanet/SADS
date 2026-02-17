<html><head><title>Exportar a PDF</title>');
        ventana.document.write('</head><body>');
        ventana.document.write(printContents);
        ventana.document.write('</body></html>');
        ventana.document.close();
        ventana.print();
    }
</script>

<?php $conexion->close(); ?>

