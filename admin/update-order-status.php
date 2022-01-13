<?php
require_once('functions/function.php');
$id=$_GET['a'];
$status="Delivered";
$up="UPDATE adm_approve_orderlist SET orderStatus='$status' WHERE id='$id'";
mysqli_query($con,$up);
header('Location: all-orderlist.php');
 ?>
