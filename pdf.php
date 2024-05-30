<?php
require_once('vendor/mpdf/mpdf/mpdf.php');

$mpdf = new mPDF();
$mpdf->WriteHTML('<h1>Título del PDF</h1><p>Contenido del PDF...</p>');

$mpdf->Output('filename.pdf', 'F');