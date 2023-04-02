<?php
include "../config.php";

$cust_no=$_POST['cust_no'];
$cust_name=$_POST['cust_name'];
$cust_email=$_POST['cust_email'];
$cust_street=$_POST['cust_street'];
$cust_city=$_POST['cust_city'];
$cust_state=$_POST['cust_state'];
$cust_zip=$_POST['cust_zip'];

$ship_to_name=$_POST['ship_to_name'];
$ship_to_street=$_POST['ship_to_street'];
$ship_to_city=$_POST['ship_to_city'];
$ship_to_state=$_POST['ship_to_state'];
$ship_to_zip=$_POST['ship_to_zip'];
$credit_limit=$_POST['credit_limit'];

$last_revised=$_POST['last_revised'];
$credit_terms=$_POST['credit_terms'];


$con = mysqli_connect($servername,$username,
$password,$dbname);
if(mysqli_connect_errno()) 
{
    echo "Fail to connect to MySQL"; exit();
}

$sql= "INSERT INTO `customers`(`cust_no`, `cust_name`,`cust_email`, `cust_street`, `cust_city`, `cust_state`, `cust_zip`, 
              `ship_to_name`, `ship_to_street`, `ship_to_city`, `ship_to_state`, `ship_to_zip`, `credit_limit`,
               `last_revised`, `credit_terms`) 
               VALUES ('$cust_no','$cust_name','$cust_email','$cust_street','$cust_city','$cust_state','$cust_zip',
               '$ship_to_name','$ship_to_street','$ship_to_city','$ship_to_state','$ship_to_zip','$credit_limit',
               '$last_revised','$credit_terms')";

if(mysqli_query($con,$sql))
 {
      header("Refresh:1;url=customers_list.php");
 }
 else{ echo "Error".mysqli_error($con);}

 mysqli_close($con);
?>