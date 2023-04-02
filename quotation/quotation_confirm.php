<?php


$so_no=$_GET['so_no'];


include "../config.php";
$conn = mysqli_connect($servername,$username,
   $password,$dbname);
if(!$conn)
{  die("Error ".mysqli_connect_error()); }

$sql = "UPDATE sales_orders SET order_status='sale_order' WHERE so_no='$so_no'";



if(mysqli_query($conn,$sql))
 {
   //  echo "Update successfully";
     header("Refresh:0;url=quotation_list.php");
 }
 else{ echo "Error".mysqli_error($conn);}

 mysqli_close($conn);
?>