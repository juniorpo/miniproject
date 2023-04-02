<?php
include "../config.php";

$so_no=$_POST['so_no'];
$pick_no=$_POST['pick_no'];
$picked_by=$_POST['picked_by'];
$item_no=$_POST['item_no'];
$pick_date=$_POST['pick_date'];
$qty_ordered=$_POST['qty_ordered'];




$conn = mysqli_connect($servername,$username,
        $password,$dbname);
if(!$conn)
    {  die("Error ".mysqli_connect_error()); }

$sql = "UPDATE sale_relations SET pick_no='$pick_no',qty_ordered='$qty_ordered'
        WHERE so_no='$so_no' and item_no='$item_no'
    ";

mysqli_query($conn,$sql);

$sql = "INSERT INTO stock_pick(so_no,pick_no,picked_by,pick_date)
        VALUE('$so_no','$pick_no','$picked_by','$pick_date')
        ";


if(mysqli_query($conn,$sql))
{
    header("Refresh:0;url=stock_move_list.php");
}
else{ echo "Error".mysqli_error($conn);}

mysqli_close($conn);
?>