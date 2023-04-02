<?php
$module="admin";
include "../users/checkmodule.php"
?>
<?php
 include "../config.php";
 $user_no = $_GET["user_no"];
 $module_no = $_GET["module_no"];

 if($user_no==0 && $module_no=='admin')
 {
 echo '<meta http-equiv="refresh" content="0;url=../authorize/authorize_list.php">';
 exit(); 
 }
 
 
 $conn = mysqli_connect($servername,$username,
  $password,$dbname);
 if(!$conn)
 { die("error".mysqli_connect_error()); }

 $sql = "DELETE FROM authorize WHERE user_no='$user_no' AND module_no='$module_no'";
 if(mysqli_query($conn,$sql))
 {
    header("Refresh:0;url=authorize_list.php");
 }
 else{ echo "Error".mysqli_error($conn);}
 
?>
