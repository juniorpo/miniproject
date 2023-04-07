<?php
$module="sale";
include "../users/checkmodule.php";
$_SESSION["item_session"] = "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
   <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <?php
  include "../comp/preloader.php";
  ?>

  <!-- Navbar -->
  <?php
  include "../comp/navbar.php";
  ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php
   include "../comp/aside.php";
  ?>
  


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>PURCHASE</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../main/index.php">Home</a></li>
              <li class="breadcrumb-item active">Quatation</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <?php 
            $po_no=$_GET['po_no'];
            include "../config.php";
 
            $conn = mysqli_connect($servername,$username,
              $password,$dbname);
            if(!$conn)
            { die("error".mysqli_connect_error()); }
            $result = mysqli_query($conn," SELECT * FROM `purchase_orders` LEFT JOIN `suppliers` ON `purchase_orders`.`sup_no` = `suppliers`.`sup_no` WHERE purchase_orders.`po_no`='".$po_no."'"); 
            $row = mysqli_fetch_array($result);
    ?>
                        



    <form action="quotation_insert.php" method="post">

          <!-- Main content -->
          <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Quotation Data</h3> 
                      </div>
                      
                      <div class="col-12">
                          <div class="card-header">
                            <a class="btn btn-success" href="quotation_print.php?po_no=<?php echo $po_no;?>" role="button"> Print </a>
                            <a class="btn btn-secondary" href="quotation_list.php" role="button"> Cancel </a>
                            <a class="btn btn-primary" href="quotation_confirm.php?po_no=<?php echo $po_no;?>" role="button"> Confirm to Purchase Order </a>
                          </div>
                      </div>
                      <!-- /.card-header -->
                    <!-- /.card-body -->
                    <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                                                        <div class="form-group">
                                                        <!-- <label class="col-form-label">Quotation Number</label>  -->
                                                        <label class="col-form-label"><h3>PO<?php echo $row["po_no"];?></h3></label> 
                                                        
                                                        </div>
                                                        <div class="form-group">
                                                        <label class="col-form-label">Date</label> 
                                                        <div><?php 
                                                        $newDate = date("d-m-Y", strtotime($row['po_date']));
                                                        echo $newDate;?>                                                       
                                                        </div> </div>
                                                        <div class="form-group">
                                                        <label class="col-form-label">Customer PO</label> 
                                                        <div><?php echo $row['po_date'];?></div></div>
                                                        
                                                        
                                                        
                          </div>
                         <div class="col-md-6">
                                                        <div class="form-group">
                                                        <label class="col-form-label">Supplier Name</label> 
                                                        <div id="txtHint"><?php echo $row['sup_company'];?></div>

                                                        <div class="form-group">
                                                        <label class="col-form-label">Contact</label> 
                                                        <div><?php echo $row['sup_contact']." ".$row['sup_telephone']." ".$row['sup_email']."";?></div>
                                                      
                                                  
                                                      
                          </div>
                    </div>  <!-- class row -->

                   

                    </div> 
                  </div>
                  <!-- /.card -->
                  <!-- /.card -->
                </div>
                <div class="row">
                    <div class="col-md-12">
                    <div class="card">
                    <div class="form-group">
                                                     
                                                          <?php 
                                                                
                                                                $sql2 = "SELECT * FROM `purchase_relations`INNER JOIN inventory ON purchase_relations.item_no = inventory.item_no WHERE purchase_relations.po_no='".$po_no."'";
                                                                //echo $sql2;exit();
                                                                $result2 = mysqli_query($conn,$sql2); 
                                                          
                                                               echo "<table class='table' border='1'>
                                                                <tr>
                                                                <th>product no</th>
                                                                <th>product name</th>
                                                                <th style='text-align:right'>quantity</th>
                                                                <th style='text-align:right'>price</th>
                                                                <th style='text-align:right'>total</th>
                                                                
                                                                ";
                                                             $nettotal=0;
                                                             while($row2 = mysqli_fetch_array($result2))
                                                                 {  
                                                                  $total=  intval($row2['qty_ordered'])*intval($row2['price']);
                                                                  $nettotal+=$total;
                                                                echo "<tr><td>".$row2['item_no']."<td>".$row2['item_name']."<td align='right'>".number_format($row2['qty_ordered'])."<td align='right'>".number_format($row2['price'])."<td align='right'>".number_format($total);
                                                                
                                                             } 
                                                             echo  "<tr><td colspan='4' align='right'>Net Total<td align='right'>".number_format($nettotal); 
                                                             echo "</table>";
                                                             ?>
                                                                                                           
                                                      
                                                      </div>
                                                      
                                                        
                                                        

                    </div>
                    </div>
                    </div>
                <!-- /.col -->
              </div>
                            <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
          </section>
          <!-- /.content -->
    </form>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.5
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
