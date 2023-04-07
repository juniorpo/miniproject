<?php
$po_no=$_GET['po_no'];

include "../config.php";
$conn = mysqli_connect($servername,$username,
   $password,$dbname);
if(!$conn)
{  die("Error ".mysqli_connect_error()); }


$sql =  "DELETE FROM purchase_orders
         WHERE po_no='$po_no'
         ";
if(mysqli_query($conn,$sql))
{
  $sql2 =  "DELETE FROM purchase_relations
  WHERE po_no='$po_no'
  ";
  if(mysqli_query($conn,$sql2))
  {
    mysqli_close($conn);
    header("Refresh:0;url=quotation_list.php");
  }
}
else{ echo "Error".mysqli_error($conn);}
?>