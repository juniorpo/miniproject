<?php
 include "../config.php";
 $item_no = $_POST["item_no"];
 $item_name = $_POST["item_name"];
 $price = $_POST["price"];
 $location = $_POST["location"];
 $qty_on_hand = $_POST["qty_on_hand"];
 $reorder_pt = $_POST["reorder_pt"];
 $old_item_no = $_POST["old_item_no"];
 $sup_no = $_POST["sup_no"];

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

 $sql = "  UPDATE inventory SET item_no='$item_no',
            item_name='$item_name',price='$price',
             location='$location',qty_on_hand='$qty_on_hand',
             reorder_pt='$reorder_pt',sup_no='$sup_no'";
if($image_name<>"")
{ $sql = $sql.",image_name='$image_name',image_type='$image_type',image_data='$image_data'"; }
$sql = $sql. " WHERE item_no='$old_item_no'"; 

 if(mysqli_query($conn,$sql))
 {
   //  echo "Update successfully";
     header("Refresh:1;url=inventory_list.php");
 }
 else{ echo "Error".mysqli_error($conn);}

 mysqli_close($conn);
?>