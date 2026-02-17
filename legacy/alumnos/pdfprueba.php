<?php

require_once __DIR__ . '/vendor/autoload.php';
//include 'vercalif.php';
$content = ob_get_clean(); // get content of the buffer and clean the buffer
$mpdf = new \mPDF();
$mpdf->WriteHTML(file_get_contents('listado.php'));
$mpdf->Output();

?>