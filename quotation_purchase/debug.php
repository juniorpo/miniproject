<?php
    require_once "../config.php";
    $po_no = $_POST["po_no"];
    $po_date = $_POST["po_date"];
    $sup_no = $_POST["sup_no"];
    $sql = "INSERT INTO purchase_orders (po_no,po_date,order_status,sup_no)
    VALUES ('$po_no','$po_date','quotation','$sup_no')";
    $result = mysqli_query($conn,$sql);
    if ($result) {
        header("refresh:2; url=quotation_list.php");
        echo "COMPLETE";
    }
?>