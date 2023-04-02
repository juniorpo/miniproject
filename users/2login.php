<?php
  session_start();
  include "../config.php"; 
  $login = $_POST['login'];
  $pwd = $_POST['password'];
  $pwd=md5($pwd);
  $con = mysqli_connect($servername,$username,$password,$dbname);
                  if(mysqli_connect_errno()) 
                    { echo "Fail to connect to MySQL"; exit();
                       }
  $sql= "SELECT * FROM users WHERE user_login='$login' AND user_password='$pwd'";
  $result = mysqli_query($con,$sql); 

  $row = mysqli_fetch_array($result);
  $rowcount=mysqli_num_rows($result);
  if($rowcount>0) 
  {
    $_SESSION["user_login"]=$row['user_login'];
    $_SESSION["user_no"]=$row["user_no"];
    $_SESSION["user_name"]=$row['user_name'];
    $_SESSION["user_image"]=$row['image_data'];
    $_SESSION["user_email"]=$row['user_email'];
     
    
    header( "location:../main/index.php"); 
  }
 else
 {
      header( "location:login.php" );
 }

?>


