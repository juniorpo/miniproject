<!DOCTYPE html>
<?php
$module="warehouse";
include "../users/checkmodule.php"
?>
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


  <?php 
  include "../config.php";
  $conn = mysqli_connect($servername,$username,$password,$dbname);
  if(!$conn)
  {  die("Error ".mysqli_connect_error()); }
  $result = mysqli_query($conn,' 
    SELECT AUTO_INCREMENT
    FROM information_schema.TABLES
    WHERE TABLE_SCHEMA = "mycompany"
    AND TABLE_NAME = "stock_pick"
  '); 
  $row = mysqli_fetch_array($result);
  $next_pick_no = $row["AUTO_INCREMENT"];
  $next_pick_no = str_pad((string)$next_pick_no,5, "0", STR_PAD_LEFT); 
  $currentDate = date('Y-m-d');
  ?>


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>WAREHOUSE</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../main/index.php">Home</a></li>
              <li class="breadcrumb-item active">Stock Move</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <?php 
    $currentDate = date('Y-m-d');
    include "../config.php";
    $so_no=$_GET['so_no'];
    $item_no=$_GET['item_no'];
    $conn = mysqli_connect($servername,$username,
        $password,$dbname);
    if(!$conn)
    {  die("Error ".mysqli_connect_error()); }
    $result = mysqli_query($conn," SELECT * FROM sale_relations LEFT JOIN sales_orders 
    ON sale_relations.so_no=sales_orders.so_no 
    WHERE sale_relations.so_no='$so_no' AND sale_relations.item_no='$item_no'"
    ); 

    $row = mysqli_fetch_array($result);
    ?>
    <form action="stock_move_save.php" method="post">
    <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Customer Data</h3> 
                      </div>
                      
                      <div class="col-12">
                          <div class="card-header">
                            <button class="btn btn-primary" type="submit">  Process  </button>
                            <a class="btn btn-secondary" href="stock_move_list.php" role="button"> Cancel </a>
                          </div>
                      </div>
                      <!-- /.card-header -->
                    <!-- /.card-body -->
                    <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                                  <div class="form-group">
                                  <label class="col-form-label">so_no</label> 
                                  <input disabled class="form-control" type="text" name="" value='SO<?php echo$row['so_no'];?>'> 
                                  <input  class="form-control" type="hidden" name="so_no" value='<?php echo$row['so_no'];?>'> 
                                  </div>
                                  <div class="form-group">
                                  <label class="col-form-label">item_no</label> 
                                  <input disabled class="form-control" type="text" name="" value='<?php echo$row['item_no'];?>'>
                                  <input  class="form-control" type="hidden" name="item_no" value='<?php echo$row['item_no'];?>'>
                                   </div>
                                  <div class="form-group">
                                  <label class="col-form-label">qty_ordered</label> 
                                  <input disabled class="form-control" type="text" name="" value='<?php echo$row['qty_ordered'];?>'>
                                  <input  class="form-control" type="hidden" name="qty_ordered" value='<?php echo$row['qty_ordered'];?>'>
                                  </div>
                                                                                       
                                                        
                          </div>
                          <div class="col-md-6">
                                  <div class="form-group">
                                  <label class="col-form-label">pick_no</label> 
                                  <input disabled class="form-control" type="text" name="" value="PK<?php echo $next_pick_no;?>">
                                  <input  type="hidden" name="pick_no" value="<?php echo $next_pick_no;?>"></div>
                                  <div class="form-group">
                                  <label class="col-form-label">pick_date</label> 
                                  <input class="form-control" type="date" name="pick_date" value="<?php echo $currentDate;?>">
                                  </div>
                                  <div class="form-group">
                                  <label class="col-form-label">picked_by</label> 
                                  <input disabled class="form-control" type="text" name="" value='<?php  echo $_SESSION["user_login"];?>'>
                                  <input  class="form-control" type="hidden" name="picked_by" value='<?php  echo $_SESSION["user_login"];?>'></div>
                              
                                                        
                                                        
                          </div>
                    </div>  <!-- class row -->
                    </div> 
                  </div>
                  <!-- /.card -->
                  <!-- /.card -->
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
  <?php
  include "../comp/footer.php";
  ?>

  
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- bs-custom-file-input -->
<script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
<script type="text/javascript">
    function PreviewImage()
    {
      var oFReader = new FileReader();
      oFReader.readAsDataURL(document.getElementById("exampleInputFile").files[0]);
      oFReader.onload = function(oFREvent){
        document.getElementById("uploadPreview").src=oFREvent.target.result;
      }
    }
     
</script>
</body>
</html>
