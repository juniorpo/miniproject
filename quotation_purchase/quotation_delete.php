<?php
$so_no=$_GET['so_no'];

include "../config.php";
$conn = mysqli_connect($servername,$username,
   $password,$dbname);
if(!$conn)
{  die("Error ".mysqli_connect_error()); }


$sql =  "DELETE FROM sales_orders
         WHERE so_no='$so_no'
         ";
                   
if(mysqli_query($conn,$sql))
{
  $sql2 =  "DELETE FROM sale_relations
  WHERE so_no='$so_no'
  ";
  if(mysqli_query($conn,$sql2))
  {
    mysqli_close($conn);
    header("Refresh:0;url=quotation_list.php");
  }
}
else{ echo "Error".mysqli_error($conn);}
?>