<?php
 include "../config.php";
 $item_no = $_POST["item_no"];
 $item_name = $_POST["item_name"];
 $price = $_POST["price"];
 $location = $_POST["location"];
 $qty_on_hand = $_POST["qty_on_hand"];
 $reorder_pt = $_POST["reorder_pt"];
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
 $sql = "INSERT INTO inventory (item_no,item_name,price,
             location,qty_on_hand,reorder_pt,sup_no,image_name,image_type,image_data)
         VALUES('$item_no','$item_name','$price',
            '$location','$qty_on_hand','$reorder_pt','$sup_no'
            ,'$image_name','$image_type','$image_data'   
            )";
 if(mysqli_query($conn,$sql))
 {
      header("Refresh:1;url=inventory_list.php");
 }
 else{ echo "Error".mysqli_error($conn);}

 mysqli_close($conn);
?>

