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
 $old_user_no = $_POST["old_user_no"];
 $user_email = $_POST["user_email"];
 $user_name = $_POST["user_name"];
 $user_login = $_POST["user_login"];
 $user_password = $_POST["user_password"];
 $user_password = md5($user_password);

 $image_name = $_FILES["myfile"]["name"];
 $image_type= $_FILES["myfile"]["type"];
 if($image_name<>"")
 $image_data = addslashes(file_get_contents($_FILES["myfile"]["tmp_name"]));
 else
 $image_data="";

 $conn = mysqli_connect($servername,$username,
  $password,$dbname);
 if(!$conn)
 { die("error".mysqli_connect_error()); }

 $sql = "  UPDATE users SET user_email='$user_email',user_name='$user_name',
            user_login='$user_login',user_password='$user_password'
            ";
if($image_name<>"")
$sql = $sql.",image_name='$image_name',image_type='$image_type',image_data='$image_data'";
$sql = $sql. " WHERE user_no='$old_user_no'"; 

 if(mysqli_query($conn,$sql))
 {
   //  echo "Update successfully";
     header("Refresh:0;url=users_list.php");
 }
 else{ echo "Error".mysqli_error($conn);}

 mysqli_close($conn);
?>