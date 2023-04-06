<?php
include "../config.php";

$sup_no = $_GET['sup_no'];

//echo $sup_no;

$sql =" SELECT * FROM suppliers WHERE sup_no='$sup_no'";
//echo $sql;exit();
$con = mysqli_connect($servername,$username,
$password,$dbname);
if(!$con)
                  {  die("Error ".mysqli_connect_error()); }

$result = mysqli_query($con,$sql); 
$row = mysqli_fetch_array($result);
echo "<b>Supplier : </b><br> &nbsp;&nbsp;&nbsp;&nbsp;".$row['sup_no']." ".$row['sup_company']."
      <br> <b>Contact :</b>
      <br> &nbsp;&nbsp;&nbsp;&nbsp;".$row['sup_contact']." 
      <br> &nbsp;&nbsp;&nbsp;&nbsp;".$row['sup_telephone']."  
      <br> &nbsp;&nbsp;&nbsp;&nbsp;".$row['sup_email'];

?>