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
  <?php 
  include "../config.php";
  $conn = mysqli_connect($servername,$username,$password,$dbname);
  if(!$conn)
  {  die("Error ".mysqli_connect_error()); }
  $result = mysqli_query($conn,' 
    SELECT AUTO_INCREMENT
    FROM information_schema.TABLES
    WHERE TABLE_SCHEMA = "mycompany"
    AND TABLE_NAME = "sales_orders"
  '); 
  $row = mysqli_fetch_array($result);
  $next_so_no = $row["AUTO_INCREMENT"];
  $next_so_no = str_pad((string)$next_so_no,5, "0", STR_PAD_LEFT); 
  $currentDate = date('Y-m-d');
  ?>
  
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>SALE</h1>
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
                            <button class="btn btn-primary" type="submit">  Save Quotation  </button>
                            <a class="btn btn-secondary" href="quotation_list.php" role="button"> Cancel </a>
                          </div>
                      </div>
                      <!-- /.card-header -->
                    <!-- /.card-body -->
                    <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                                                        <div class="form-group">
                                                        <!-- <label class="col-form-label">Quotation Number</label>  -->
                                                        <label class="col-form-label"><?php echo "<h3>SO".$next_so_no."<h3>";?></label> 
                                                        <input class="form-control" type="hidden" name="so_no" value="<?php echo $next_so_no;?>"> 
                                                        </div>
                                                        <div class="form-group">
                                                        <label class="col-form-label">PO Date</label> 
                                                        <input class="form-control" type="date" name="po_date" value="<?php echo $currentDate;?>"></div>
                                                        
                                                       
                          </div>
                         <div class="col-md-6">
                                                        <div class="form-group">
                                                        <label class="col-form-label">Supplier</label> 
                                                          <?php 
                                                                include "../config.php";
                                                                $con = mysqli_connect($servername,$username,$password,$dbname);
                                                                if(mysqli_connect_errno()) 
                                                                 { echo "Fail to connect to MySQL"; exit();
                                                                  }
                                                                 $result = mysqli_query($con,"SELECT * FROM suppliers"); ?>   
                                                          
                                                          <select name="sup_no" onchange="showCustomer(this.value)" class="form-control select2"  style="width: 100%;">
                                                          
                                                          <?php 
                                                                echo "<option value='no customer'>Please select customer</option>";
                                                                while($row = mysqli_fetch_array($result))
                                                                 {  
                                                                echo "<option value='".$row['sup_no']."'>".$row['sup_no']."</option>";
                                                                
                                                             } ?>
                                                        
                                                      </select>
                                                        
                                                        <div id="txtHint">Customer info will be listed here...</div>

                                                            <script>
                                                            function showCustomer(str) {
                                                              var xhttp;    
                                                              if (str == "") {
                                                                document.getElementById("txtHint").innerHTML = "";
                                                                return;
                                                              }
                                                              xhttp = new XMLHttpRequest();
                                                              xhttp.onreadystatechange = function() {
                                                                if (this.readyState == 4 && this.status == 200) {
                                                                  document.getElementById("txtHint").innerHTML = this.responseText;
                                                                }
                                                              };
                                                              xhttp.open("GET","getcustomer.php?sup_no="+str,true);
                                                              xhttp.send();
                                                            }
                                                            </script>
                                                      
                                                   
                                                        
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
                    <div class="form-group">
                                                        <label class="col-form-label">Select Product</label> 
                                                          <?php 
                                                                $result2 = mysqli_query($con,"SELECT * FROM inventory"); ?>
                                                          
                                                          <select id="item" style="width: 40%;">
                                                          
                                                          <?php while($row2 = mysqli_fetch_array($result2))
                                                                 {  
                                                                echo "<option value='".$row2['item_no']."'>".$row2['item_no']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$row2['item_name']."</option>";
                                                                
                                                             } ?>
                                                        
                                                      </select>
                                                      <input  id="quantity" type="text" name="quantity" placeholder="quantity" size=10 value=1>
                                                      <button onclick="showOderDetail()" type="button" class="btn btn-primary">Add Item</button>
                                                      
                                                      </div>
                                                      <div id="orderdetail">order to be listed here...</div>
                                                        
                                                        <script>
                                                            function showOderDetail() {
                                                              var e = document.getElementById("item");
                                                              var value = e.options[e.selectedIndex].value;
                                                              var text = e.options[e.selectedIndex].text;
                                                              var q = document.getElementById("quantity").value;

                                                              var xhttp;    
                                                              if (value == "") {
                                                                document.getElementById("orderdetail").innerHTML = "";
                                                                return;
                                                              }
                                                              xhttp = new XMLHttpRequest();
                                                              xhttp.onreadystatechange = function() {
                                                                if (this.readyState == 4 && this.status == 200) {
                                                                  document.getElementById("orderdetail").innerHTML = this.responseText;
                                                                }
                                                              };
                                                              xhttp.open("GET", "getinventory.php?item_no="+value+"&q="+q, true);
                                                              xhttp.send();

                                                            
                                                            }
                                                            </script>

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
  <?php include "../comp/footer.php";  //ใส่ข้อมูล footer ในไฟล์ footer.php
 ?>

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
