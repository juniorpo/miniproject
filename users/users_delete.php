<?php 
include "../main/session.php"; 
include "../users/checklogin.php";
if(isset($_SESSION['user_login']))
{
  $checkuser = checkuser($_SESSION['user_login'],'admin');
  if($checkuser=="no")
  {
    echo '<meta http-equiv="refresh" content="0;url=../main/index.php">';
    exit();
  }
}
else
{
  echo '<meta http-equiv="refresh" content="0;url=../main/index.php">';
  exit();
}
?>
<?php
 include "../config.php";
 $user_no = $_GET["user_no"];
 
 $conn = mysqli_connect($servername,$username,
  $password,$dbname);
 if(!$conn)
 { die("error".mysqli_connect_error()); }

 $sql = "DELETE FROM users WHERE user_no='$user_no'";
 if(mysqli_query($conn,$sql))
 {
    header("Refresh:0;url=users_list.php");
 }
 else{ echo "Error".mysqli_error($conn);}
 
?>
