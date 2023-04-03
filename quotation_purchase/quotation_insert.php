<?php
include "../config.php";

$so_no=$_POST['so_no'];
$so_date=$_POST['so_date'];
$cust_no=$_POST['cust_no'];
$cust_po_no=$_POST['cust_po_no'];
$cust_po_date=$_POST['cust_po_date'];
$ship_via=$_POST['ship_via'];
$fob_term=$_POST['fob_term'];

$con = mysqli_connect($servername,$username,$password,$dbname);
if(mysqli_connect_errno()) 
{
    echo "Fail to connect to MySQL"; exit();
}

$sql= "INSERT INTO sales_orders  (so_no,so_date,cust_no,cust_po_no,cust_po_date,ship_via,fob_term,order_status) 
               VALUES ('$so_no','$so_date','$cust_no',
                        '$cust_po_no','$cust_po_date','$ship_via',
                        '$fob_term','quotation')";
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
$sql= "INSERT INTO sale_relations (so_no,item_no,qty_ordered)  
               VALUES ('$so_no','$data->id','$data->q')";
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