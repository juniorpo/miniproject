<?php
include "../config.php";

$hidden_cust_no=$_POST['hcust_no'];

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

$conn = mysqli_connect($servername,$username,
        $password,$dbname);
if(!$conn)
    {  die("Error ".mysqli_connect_error()); }

$sql = "UPDATE `customers` SET `cust_email`='$cust_email',`cust_no`='$cust_no',`cust_name`='$cust_name',`cust_street`='$cust_street',`cust_city`='$cust_city',`cust_state`='$cust_state',`cust_zip`='$cust_zip',
`ship_to_name`='$ship_to_name',`ship_to_street`='$ship_to_street',`ship_to_city`='$ship_to_city',`ship_to_state`='$ship_to_state',`ship_to_zip`='$ship_to_zip',`credit_limit`='$credit_limit',
`last_revised`='$last_revised',`credit_terms`='$credit_terms' WHERE cust_no='$hidden_cust_no'";


if(mysqli_query($conn,$sql))
{
    header("Refresh:1;url=customers_list.php");
}
else{ echo "Error".mysqli_error($conn);}

mysqli_close($conn);
?>