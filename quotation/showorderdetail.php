<?php
//include "../config.php";
session_start();


Class MyStruct {
  public $id;
  public $q;
}

  
 $item_session=$_SESSION["item_session"]; 

include "../config.php";

$output = "";


if($_SESSION["item_session"]!= "")
{
$nettotal=0;
foreach ($item_session as &$data)
{
echo $data->id."  ".$data->q."<br>";

}
}

?>