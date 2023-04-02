<?php
$module="purchase";
include "../users/checkmodule.php";
?>
<?php
 include "../config.php";
 $sup_no= $_GET["sup_no"];
 
 $conn = mysqli_connect($servername,$username,
  $password,$dbname);
 if(!$conn)
 { die("error".mysqli_connect_error()); }

 $sql = "DELETE FROM suppliers WHERE sup_no='$sup_no'";
 if(mysqli_query($conn,$sql))
 {
    header("Refresh:0;url=suppliers_list.php");
 }
 else{ echo "Error".mysqli_error($conn);}
 
?>
