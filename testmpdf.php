<?php
 require_once('vendor/autoload.php');
 $mpdf = new \Mpdf\Mpdf([
     'default_font_size'=>16,
     'default_font'=>'sarabun'
 ]);
 ob_start();
 ?>

<table border="1">
    <tr><td>11<td>22
</table>
<h1>สวัสดีชาวโลก</h1>
 

 <?php
$html = ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML($html);
 $mpdf->Output();
 ?>
