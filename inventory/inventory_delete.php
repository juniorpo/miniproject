<?php
$module="sale";
include "../users/checkmodule.php"
?>
<?php
 include "../config.php";
 $item_no = $_GET["item_no"];
 
 $conn = mysqli_connect($servername,$username,
  $password,$dbname);
 if(!$conn)
 { die("error".mysqli_connect_error()); }

 $sql = "DELETE FROM inventory WHERE item_no='$item_no'";
 if(mysqli_query($conn,$sql))
 {
    header("Refresh:0;url=inventory_list.php");
 }
 else{ echo "Error".mysqli_error($conn);}
 
?>
