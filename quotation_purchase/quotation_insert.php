<?php
include "../config.php";

$po_no = $_POST["po_no"];
$po_date = $_POST["po_date"];
$sup_no = $_POST["sup_no"];

$con = mysqli_connect($servername,$username,$password,$dbname);
if(mysqli_connect_errno()) 
{
    echo "Fail to connect to MySQL"; exit();
}

$sql= "INSERT INTO purchase_orders  (po_no,po_date,order_status,sup_no) 
               VALUES ('$po_no','$po_date','quotation','$sup_no')";
//echo $sql;exit();

if (mysqli_query($con, $sql)) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

session_start();

Class MyStruct {
  public $id;
  public $q;
}
  
$item_session=$_SESSION["item_session"]; 
$output = "";


if($_SESSION["item_session"]!= "")
{
$nettotal=0;
foreach ($item_session as &$data)
{
echo $data->id."  ".$data->q."<br>";
$sql= "INSERT INTO purchase_relations (po_no,item_no,qty_ordered)  
               VALUES ('$po_no','$data->id','$data->q')";
             echo $sql;
  
if (mysqli_query($con, $sql)) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

}
} 
  mysqli_close($con);
  header( "location:quotation_list.php" );
?>