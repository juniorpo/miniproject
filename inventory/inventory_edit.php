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
            <h1>INVENTORY</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../main/index.php">Home</a></li>
              <li class="breadcrumb-item active">InventoryManagement</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Inventory Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php
              include "../config.php";
              $item_no = $_GET["item_no"];
              $conn = mysqli_connect($servername,$username,$password,$dbname);
              if(!$conn) { die("error".mysqli_connect_error());}
              $sql = "SELECT * FROM inventory WHERE item_no='$item_no'";
              $result = mysqli_query($conn,$sql);
              $row=mysqli_fetch_assoc($result);
              ?>
              <form action="inventory_save.php" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                      <div class="col-md-6">                      
                        <div class="form-group">
                            <label for="item_no">Item_no</label>
                            <input type="textbox" class="form-control" name="item_no" id="imput_item_no" placeholder="enter item_no" autofocus value='<?php echo $row["item_no"];?>'>
                            <input type="hidden" name="old_item_no" value='<?php echo $row["item_no"];?>'>
                         </div>
                        <div class="form-group">
                          <label for="item_name">item_name</label>
                          <input type="textbox" class="form-control" name="item_name" id="imput_item_name" placeholder="enter item_name" value='<?php echo $row["item_name"];?>'>
                        </div>
                        <div class="form-group">
                          <label for="item_no">price</label>
                          <input type="textbox" class="form-control" name="price" id="imput_price" placeholder="enter price" value='<?php echo $row["price"];?>'>
                        </div>
                        <div class="form-group">
                          <label for="location">location</label>
                          <input type="textbox" class="form-control" name="location" id="imput_location" placeholder="enter location" value='<?php echo $row["location"];?>'>
                        </div>
                        <div class="form-group">
                          <label for="qty_on_hand">qty_on_hand</label>
                          <input type="textbox" class="form-control" name="qty_on_hand" id="imput_qty_on_hand" placeholder="enter qty_on_hand" value='<?php echo $row["qty_on_hand"];?>'>
                        </div>
                        <div class="form-group">
                          <label for="reorder_pt">reorder_pt</label>
                          <input type="textbox" class="form-control" name="reorder_pt" id="imput_reorder_pt" placeholder="enter reorder_pt" value='<?php echo $row["reorder_pt"];?>'>
                        </div>       
                        <div class="form-group">
                            <?php
                            include "../config.php";
                            $conn = mysqli_connect($servername,$username,
                                $password,$dbname);
                            if(!$conn)
                            {  die("Error ".mysqli_connect_error()); }
                            
                            
                            ?>
                            <label for="reorder_pt">Supplier</label>
                            <select class="form-control" name="sup_no">
                                <?php  
                              $sql2 = "SELECT * FROM suppliers";
                              $result2 = mysqli_query($conn,$sql2);
                              
                                    while($row2=mysqli_fetch_assoc($result2))
                                          {
                                            echo "<option value='".$row2["sup_no"]."'";
                                              if($row["sup_no"]==$row2["sup_no"]) echo " selected";
                                            echo ">".$row2["sup_company"]."</option>";
                                          }
                                ?>
                            </select>                  
                        </div>                
                      </div>
                      <div class="col-md-6">      
                        <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                              <div class="input-group">
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" id="exampleInputFile" name="myfile" onchange="PreviewImage();">
                                  <label class="custom-file-label" for="exampleInputFile">Choose file</label>                          
                                </div>
                              </div>                         
                          </div>     
                          <div class="form-group">
                          <?php 
                                if($row["image_name"]<>"")
                                echo '<img class="product-image img-fluid" id="uploadPreview"" src="data:image/jpeg;base64,'.base64_encode($row["image_data"]).'" width="100px">';
                                else 
                                echo '<img class="product-image img-fluid" id="uploadPreview">';
                              ?>
                          </div>                                                      
                      </div>
                    </div>               
                  </div>               
                <div class="card-footer">
                          <button type="submit" class="btn btn-primary">Submit</button>
                </div>
             </form>
            </div>
         </div>
       </div>
      </div>
    </section>
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
