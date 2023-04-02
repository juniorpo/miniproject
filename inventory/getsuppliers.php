<?php
$module="sale";
include "../users/checkmodule.php"
?>
<?php
$sup_no = $_GET['sup_no'];
include "../config.php";
$conn = mysqli_connect($servername,$username,
   $password,$dbname);
if(!$conn)
{  die("Error ".mysqli_connect_error()); }
$sql = "SELECT * FROM suppliers WHERE sup_no='$sup_no'";
  
$result = mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);

echo "<b>".$row['sup_no'].
      "<br>".$row['sup_company'].
      "</b><br>contact: ".$row['sup_contact'].
      "<br>Telephone:  ".$row['sup_telephone'].
      "<br>Email:  ".$row['sup_email']   
      ;
mysqli_close($conn);
 ?>

