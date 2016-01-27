<?php
require_once("dompdf/dompdf_config.inc.php");
spl_autoload_register('dompdF_autoload');

function pdf_create($html, $filename, $paper, $orientation, $stream=TRUE){

	$dompdf=new dompdf();
	$dompdf->set_paper($paper, $orientation);
	$dompdf->load_html($html);
	$dompdf->render();
	$dompdf->stream($filename.".pdf");

}
$filename='filename';
$dompdf=new dompdf();
$html=file_get_contents('revisions.editarField');
pdf_create($html, $filename, 'A4', 'portrait');

?>