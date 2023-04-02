<?php
$module="admin";
include "../users/checkmodule.php"
?>
<?php
 include "../config.php";
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
 $sql = "INSERT INTO users (user_name,user_email,user_login,
             user_password,image_name,image_type,image_data)
         VALUES('$user_name','$user_email','$user_login',
            '$user_password','$image_name','$image_type','$image_data'   
            )";
 if(mysqli_query($conn,$sql))
 {
      header("Refresh:1;url=users_list.php");
 }
 else{ echo "Error".mysqli_error($conn);}

 mysqli_close($conn);
?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
