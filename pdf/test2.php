<?php
require_once("../vendor/autoload.php");
$mpdf = new  \Mpdf\Mpdf([
 'default_font_size'=>16,
 'default_font'=>'sarabun'
]);
ob_start();
?>
<table><tr><td>abc<td>xyz
</table>
<h2>hello world</h2>
<h1>สวัสดีชาวโลก</h1>
<?php
$html=ob_get_contents();
ob_end_clean();
$mpdf->writeHTML($html);
$mpdf->Output();

?>