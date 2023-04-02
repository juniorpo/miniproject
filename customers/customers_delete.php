<?php 
$module="sale";
include "../users/checkmodule.php"
?>
<?php
include "../config.php";
 $cust_no = $_GET["cust_no"];
 
 $conn = mysqli_connect($servername,$username,
  $password,$dbname);
 if(!$conn)
 { die("error".mysqli_connect_error()); }

 $sql =  "DELETE FROM customers
          WHERE cust_no='$cust_no'
          ";              
 if(mysqli_query($conn,$sql))
 {
    header("Refresh:0;url=customers_list.php");
 }
 else{ echo "Error".mysqli_error($conn);}
 
?>

