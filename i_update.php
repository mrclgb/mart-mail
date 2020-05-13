<?php
  include("check_session.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Item</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">
<nav class="navbar bg-dark">
      <a href="item.php" class="btn btn-outline-light my-2 my-sm-0" role="button" aria-pressed="true">Back</a>
  </nav>

    <div style="background-color: grey" id="content-wrapper">

      <div class="container-fluid">

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            AIU Mail</div>
          <div style="background-color: grey" class="card-body">
            <form action="#" method="post">
              <?php
                  $con = mysqli_connect("localhost","root","","mail");
                  if (!$con) {
                    echo "Cannot connect".mysqli_connect_error($con);
                  } else {
                    if (isset($_GET['id'])) {
                      $id = $_GET['id'];
                      // echo $id;
                      $sql="SELECT *
                            FROM shipment
                            WHERE ShipmentID='".$id."'";
                      // echo $sql;
                      $query = mysqli_query($con,$sql);
                      $show = mysqli_fetch_array($query);
                      // echo $show['Name'];
              ?>
               <table class='table table-hover table-dark table-bordered' width='100%' cellspacing='0'>
                <tr>
                <td>Shipment ID</td>
                <td><input type="hidden" name="id" value="<? echo $id ?>"><? echo $id ?></td>
               </tr>
               <tr>
                 <td>Recipient</td>
                 <td><input name="recipient" maxlength="30" value="<? echo $show["Recipient"] ?>"></td>
               </tr>
               <tr>
                 <td>Tracking Number</td>
                 <td><input name="number" maxlength="15" value="<? echo $show["TrackingNumber"] ?>"></td>
               </tr>
               <tr>
                 <td>Type</td>
                 <td><input name="type" maxlength="100" value="<? echo $show["Type"] ?>"></td>
               </tr>
               <tr>
                 <td>ArrivalDate</td>
                 <td><input type="date" name="date" maxlength="100" value="<? echo $show["ArrivalDate"] ?>"></td>
               </tr>
              </table>
                  <button class="btn btn-secondary" type="submit" name="submit">Update</button>
            </form>

            <?
                  }
                }
                if (isset($_POST["submit"])) {
                  $sql="UPDATE shipment
                		    SET Recipient='".$_POST["recipient"]."',
                		  	    TrackingNumber='".$_POST["number"]."',
                		  	    Type='".$_POST["type"]."',
                            ArrivalDate='".$_POST["date"]."'
                		    WHERE ShipmentID='".$_POST["id"]."'";

                 	// echo $sql;
                 	$query=mysqli_query($con,$sql);

                 	if ($query) {
                 		echo "<center><font color='blue'>Updated</font></center>";
                 	} else {
                 		die('Cannot update').mysqli_error($con);
                 		echo "<center><font color='red'>Cannot update!</font></center>";
                 	}
                }
            ?>
            <div class="table-responsive">
              <?php
                $name = "SELECT *
                         FROM shipment";
                $search = mysqli_query($con,$name);
                if (!$search) {
                  echo "No such data!";
                } else {
                ?>
                  <table class='table table-hover table-dark table-bordered' id='dataTable' width='100%' cellspacing='0'>
                  <thead>
                  <tr>
                  <th>Shipment ID</th>
                  <th>Recipient</th>
                  <th>Tracking Number</th>
                  <th>Type</th>
                  <th>Courier ID</th>
                  <th>Arrival Date</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                while($row = mysqli_fetch_array($search)) {
                ?>
                  <tr>
                    <tr><td><? echo $row["ShipmentID"] ?></td>
              		  <td><? echo $row["Recipient"]?></td>
              		  <td><? echo$row["TrackingNumber"]?></td>
                    <td><? echo$row["Type"]?></td>
              		  <td><? echo$row["CourierID"]?></td>
                    <td><? echo$row["ArrivalDate"]?></td>
                  </tr>
              <?php
                    }
              }
              ?>
              </tbody>
              </table>
              <?php
              mysqli_close($con);
              ?>
            </div>
          </div>

        </div>
      </div>

      <!-- Sticky Footer -->
      <footer>
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Bootstrap Copy and Paste Website 2019</span>
          </div>
        </div>
      </footer>

    </div>


  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
