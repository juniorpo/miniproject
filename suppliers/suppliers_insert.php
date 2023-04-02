<?php
$module="purchase";
include "../users/checkmodule.php";
?>
<?php
 include "../config.php";
 $sup_no= $_POST["sup_no"];
 $sup_company = $_POST["sup_company"];
 $sup_contact = $_POST["sup_contact"];
 $sup_telephone = $_POST["sup_telephone"];
 $sup_email = $_POST["sup_email"];
 
 $conn = mysqli_connect($servername,$username,
  $password,$dbname);
 if(!$conn)
 { die("error".mysqli_connect_error()); }
 $sql = "INSERT INTO suppliers (sup_no,sup_company,sup_contact,
             sup_telephone,sup_email)
         VALUES('$sup_no','$sup_company','$sup_contact',
            '$sup_telephone','$sup_email'   
            )";
 if(mysqli_query($conn,$sql))
 {
      header("Refresh:1;url=suppliers_list.php");
 }
 else{ echo "Error".mysqli_error($conn);}

 mysqli_close($conn);
?>

