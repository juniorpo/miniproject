<?php
$module="sale";
include "../users/checkmodule.php"
?>
<?php
 require_once('../vendor/autoload.php');
 $mpdf = new \Mpdf\Mpdf([
	'default_font_size' => 16,
	'default_font' => 'sarabun'
]);
$mpdf->SetDocTemplate('../pdf_template/template1.pdf',true);
ob_start();

include "../config.php";
$item_no = $_GET["item_no"];
$conn = mysqli_connect($servername,$username,$password,$dbname);
if(!$conn) { die("error".mysqli_connect_error());}
$sql = "SELECT * FROM inventory LEFT JOIN suppliers on inventory.sup_no=suppliers.sup_no 
WHERE inventory.item_no='$item_no'";
$result = mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
?>
<html>
    <div style="font-size:30px;position: absolute;left: 360px;top: 450px;">
        <b>Inventory View</b>
    </div> 
   <div style="font-size:16px;position: absolute;left: 360px;top: 503px;">
       <b>หมายเลขผลิตภัณฑ์</b>
    </div>
    <div style="font-size:16px;position: absolute;left: 168px;top: 105px;">
        <?php echo "&nbsp;&nbsp;".$row["item_name"];?>
    </div>
   <table border="1" width="100%" >
    <tr>
        <td style="width:20%">
            <br>
        </td>
        <td style="width:30%">
            <?php echo "&nbsp;&nbsp;".$row["item_no"];?>
        </td>   
        <td rowspan=6 style="width:50%">
        <?php 
            echo '<img src="data:image/jpeg;base64,'.base64_encode($row["image_data"]).'" width="500px">';
        ?>
        </td>
    </tr>
    <tr>
        <td style="width: 20%">
            <b>item_name</b> <br>
        </td>
        <td style="width: 30%">
         <!--    -->
        </td>   
    </tr>
    <tr>
        <td style="width: 20%">
            <b>price</b> <br>
        </td>
        <td style="width: 30%">
            <?php echo "&nbsp;&nbsp;".$row["price"];?>
        </td>   
    </tr>
    <tr>
        <td style="width: 20%">
            <b>location</b> <br>
        </td>
        <td style="width: 30%">
            <?php echo "&nbsp;&nbsp;".$row["price"];?>
        </td>   
    </tr>
    <tr>
        <td style="width: 20%">
            <b>qty_on_hand</b> <br>
        </td>
        <td style="width: 30%">
            <?php echo "&nbsp;&nbsp;".$row["qty_on_hand"];?>
        </td>   
    </tr>
    <tr>
        <td style="width: 20%">
            <b>reorder_pt</b> <br>
        </td>
        <td style="width: 30%">
            <?php echo "&nbsp;&nbsp;".$row["reorder_pt"];?>
        </td>   
    </tr>
          
    </table>
</html>   
<?php
$html = ob_get_contents();
ob_end_clean();
// send the captured HTML from the output buffer to the mPDF class for processing
$mpdf->WriteHTML($html);
$mpdf->Output();
?>
