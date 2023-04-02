<?php

 require_once('../vendor/autoload.php');


 $mpdf = new \Mpdf\Mpdf([
	'default_font_size' => 16,
	'default_font' => 'sarabun']);

include "../config.php";  
$so_no=$_GET['so_no'];
include "../config.php";
$conn = mysqli_connect($servername,$username,
    $password,$dbname);
if(!$conn)
{  die("Error ".mysqli_connect_error()); }
$result = mysqli_query($conn," SELECT * FROM sales_orders INNER JOIN customers on sales_orders.cust_no=customers.cust_no  WHERE sales_orders.so_no='".$so_no."'"); 
$row = mysqli_fetch_array($result);
ob_start();
?>


<html>
   <h1 style="text-align: center;"> ใบเสนอราคา</h1>
    <table   width="100%" >
    <tr>
        <td style="width:30%">
            <b>Sale Order Number </b> 
        </td>
        <td style="width:20%">
        <?php echo "SO". $row['so_no'];?> 
        </td>   
        <td style="width:30%">
        <b>Customer PO </b>  
        </td> 
        <td style="width:20%">
      
        </td>   
    </tr>
    <tr>
        <td style="width:30%">
            <b>Date </b> 
        </td>
        <td style="width:20%">
        <?php 
            $newDate = date("d-m-Y", strtotime($row['so_date']));
            echo $newDate;?> 
        </td>   
        <td style="width:20%">
       
        <b>Cust PO Date </b> 
        </td> 
        <td style="width:30%">
        <?php 
          $newDate = date("d-m-Y", strtotime($row['cust_po_date']));
          echo $newDate;?> 
        
        </td>  
    </tr>
    <tr>
        <td style="width:30%">
        <b>Customer No </b>  
        </td>
        <td style="width:20%">
        <?php echo $row['cust_no'];?> 
     
        </td>   
        <td style="width:20%">
        <b>Shipping Via</b>  
        </td> 
        <td style="width:30%">
        <?php echo $row['ship_via'];?> 
        </td>  
    </tr>
    <tr>
        <td style="width:30%">
        <b>Customer Name </b> 
      </td>
      <td style="width:20%">
      <?php echo $row['cust_name'];?>   
      </td>
      <td style="width:30%">
      <b>Fob Term</b>  
      </td>
      <td style="width:20%">
      <?php echo $row['fob_term'];?>  
      </td>
    </tr>
    <tr>
        <td style="width:30%">
        <b>Address </b>  
      </td>
      <td style="width:20%" colspan=3>
      <?php echo $row['cust_street']." ".$row['cust_city']." ".$row['cust_state']." ".$row['cust_zip'];?>
      </td>                              
    </tr>
    <tr><td><td><td>
    <tr><td><td><td>
 </table>
                                            
<?php 
    $sql2 = "SELECT * FROM sale_relations INNER JOIN inventory on sale_relations.item_no=inventory.item_no  WHERE sale_relations.so_no='".$so_no."'";
    $result2 = mysqli_query($conn,$sql2); 

    echo '<table border="1">
    <tr>
    <th style="text-align:left;width:20%">product no</th>
    <th style="text-align:left;width:40%">product name</th>
    <th style="text-align:right;width:10%">quantity</th>
    <th style="text-align:right;width:10%">price</th>
    <th style="text-align:right;width:20%">total</th>
    
    ';
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
 

<?php
$html = ob_get_contents();
ob_end_clean();

// send the captured HTML from the output buffer to the mPDF class for processing
$mpdf->WriteHTML($html);
$mpdf->Output();


?>
</body>
</html>
