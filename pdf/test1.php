<?php
require_once("../vendor/autoload.php");
$mpdf = new  \Mpdf\Mpdf([
 'default_font_size'=>12,
 'default_font'=>'sarabun'

]);

$html = " <h1> hello world สวัสดี";
$html = $html."สวัสดี2";

$mpdf->writeHTML($html);
$mpdf->Output();

?>
