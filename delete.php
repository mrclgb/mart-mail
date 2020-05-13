<?php
$con = mysqli_connect("localhost","root","","mail");
if (!$con) {
  die('Database not exist').mysqli_error();
}
$id=$_GET["id"];

  $sql="DELETE FROM shipment
    WHERE ShipmentID='".$id."'";

//echo $sql;
$query=mysqli_query($con,$sql);

if ($query) {
  header('Location: pickup.php');
} else {
  die();
}
mysqli_close($con);
?>
