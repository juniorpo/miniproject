<?php
include "../config.php";

$cust_no = $_GET['cust_no'];

//echo $cust_no;

$sql =" SELECT * FROM customers WHERE cust_no='$cust_no'";
//echo $sql;exit();
$con = mysqli_connect($servername,$username,
$password,$dbname);
if(!$con)
                  {  die("Error ".mysqli_connect_error()); }

$result = mysqli_query($con,$sql); 
$row = mysqli_fetch_array($result);
echo "<b>Customer : </b><br> &nbsp;&nbsp;&nbsp;&nbsp;".$row['cust_no'].
      " ".$row['cust_name'].
      "<br> <b>Address :</b> <br> &nbsp;&nbsp;&nbsp;&nbsp;".
      $row['cust_street'].
      "  ".$row['cust_city'].
      "  ".$row['cust_state'].
      "  ". $row['cust_zip'].
      "<br> <b> Shipping Address :</b> <br>  &nbsp;&nbsp;&nbsp;&nbsp;".
      $row['ship_to_name'].
      "  ".$row['ship_to_street'].
      "  ".$row['ship_to_city'].
      "  ". $row['ship_to_state'].
      "  ". $row['ship_to_zip']
      ;

?>