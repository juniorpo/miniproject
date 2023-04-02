<?php
  function checkuser($user_login,$module_no)
  {
  include "../config.php"; 
   $con = mysqli_connect($servername,$username,$password,$dbname);
                  if(mysqli_connect_errno()) 
                    { echo "Fail to connect to MySQL"; exit();
                       }
  $sql= "SELECT * FROM users left join authorize on users.user_no = authorize.user_no 
  WHERE users.user_login='$user_login' and authorize.module_no='$module_no'";
    
  $result = mysqli_query($con,$sql);                     
  $row = mysqli_fetch_array($result);
  $rowcount=mysqli_num_rows($result);
  if($rowcount==0) 
  {
    return "no";
  }
  else
  {
    return "yes";
  }
 }
?>