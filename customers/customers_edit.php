<!DOCTYPE html>
<?php
$module="sale";
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
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>SUPPLIER</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../main/index.php">Home</a></li>
              <li class="breadcrumb-item active">SuppliersManagement</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <?php 
    include "../config.php";
    $cust_no=$_GET['cust_no'];
    $conn = mysqli_connect($servername,$username,
        $password,$dbname);
    if(!$conn)
    {  die("Error ".mysqli_connect_error()); }
    $result = mysqli_query($conn," SELECT * FROM customers WHERE cust_no='".$cust_no."'"); 
    $row = mysqli_fetch_array($result);
    ?>
    <form action="customers_save.php" method="post">
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
                            <button class="btn btn-primary" type="submit">  SAVE Record  </button>
                            <a class="btn btn-secondary" href="customers_list.php" role="button"> Cancel </a>
                          </div>
                      </div>
                      <!-- /.card-header -->
                    <!-- /.card-body -->
                    <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                                                        <label class="col-form-label">Customer Number</label> 
                                                        <input class="form-control" type="text" name="cust_no" value='<?php echo$row['cust_no'];?>'> 
                                                        <input class="form-control" type="hidden" name="hcust_no" value='<?php echo$row['cust_no'];?>'> 
                                                        </div>
                                                        <div class="form-group">
                                                        <label class="col-form-label">Customer Name</label> 
                                                        <input class="form-control" type="text" name="cust_name" value='<?php echo$row['cust_name'];?>'></div>
                                                        <div class="form-group">
                                                        <label class="col-form-label">Customer Email</label> 
                                                        <input class="form-control" type="text" name="cust_email" value='<?php echo$row['cust_email'];?>'></div>
                                                        <div class="form-group">
                                                        <label class="col-form-label">credit_limit</label> 
                                                        <input class="form-control" type="text" name="credit_limit" value='<?php echo$row['credit_limit'];?>'></div>
                                                        <div class="form-group">
                                                        <label class="col-form-label">last_revised</label> 
                                                        <input class="form-control" type="date" name="last_revised" value='<?php echo$row['last_revised'];?>'></div>
                                                        <div class="form-group">
                                                        <label class="col-form-label">credit_terms</label> 
                                                        <input class="form-control" type="text" name="credit_terms" value='<?php echo$row['credit_terms'];?>'></div>
                          </div>
                          <div class="col-md-6">
                          <div class="form-group">
                          <div class="form-group">
                                                        <label class="col-form-label">Customer Address</label> 
                                                        <input class="form-control" type="text" name="cust_street" placeholder="Street" value='<?php echo$row['cust_street'];?>' ></div>
                                                        <div class="form-group">
                                                        
                                                        <input class="form-control" type="text" name="cust_city" placeholder="City" value='<?php echo$row['cust_city'];?>'></div>
                                                        <div class="form-group">
                                                        
                                                        <input class="form-control" type="text" name="cust_state" placeholder="State" value='<?php echo$row['cust_state'];?>'></div>
                                                        <div class="form-group">
                                                        
                                                        <input class="form-control" type="text" name="cust_zip" placeholder="zip code" value='<?php echo$row['cust_zip'];?>'></div>
                                                        
                                                        <label class="col-form-label">Shiping Address</label> 
                                                        <input class="form-control" type="text" name="ship_to_name" placeholder="Name" value='<?php echo$row['ship_to_name'];?>'></div>
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="ship_to_street" placeholder="Street" value='<?php echo$row['ship_to_street'];?>'></div>
                                                        <div class="form-group">
                                                       
                                                        <input class="form-control" type="text" name="ship_to_city" placeholder="City" value='<?php echo$row['ship_to_city'];?>'></div>
                                                        <div class="form-group">
                                                        
                                                        <input class="form-control" type="text" name="ship_to_state" placeholder="State" value='<?php echo$row['ship_to_state'];?>'></div>
                                                        <div class="form-group">
                                                       
                                                        <input class="form-control" type="text" name="ship_to_zip" placeholder="Zip Code" value='<?php echo$row['ship_to_zip'];?>'></div>
                                                        
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
