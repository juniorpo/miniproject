<?php
$module="admin";
include "../users/checkmodule.php"
?>
<?php
 include "../config.php";
 $user_no = $_POST["user_no"];
 $module_no = $_POST["module_no"];
 
 $conn = mysqli_connect($servername,$username,
  $password,$dbname);
 if(!$conn)
 { die("error".mysqli_connect_error()); }
 $sql = "INSERT INTO authorize (user_no,module_no)
         VALUES('$user_no','$module_no'   
            )";
 if(mysqli_query($conn,$sql))
 {
      header("Refresh:0;url=authorize_list.php");
 }
 else{ 
   echo "Error".mysqli_error($conn);
   header("Refresh:5;url=authorize_list.php");
  }

 mysqli_close($conn);
?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
