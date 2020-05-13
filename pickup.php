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
      <a href="admin.php" class="btn btn-outline-light my-2 my-sm-0" role="button" aria-pressed="true">Back</a>
  </nav>
    <div style="background-color: grey" id="content-wrapper">

      <div class="container-fluid">

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            AIU Mail</div>
          <div style="background-color: grey" class="card-body">
            <div class="table-responsive">
              <?php
                $con = mysqli_connect("localhost","root","","mail");
                // //Check connection
                if(mysqli_connect_errno($con)) {
                  echo "Fail to connect to MySQL:" . mysqli_connect_error($con);
                }
                $name = "SELECT shipment.Recipient,shipment.TrackingNumber,shipment.Type,courier.Name as Courier,shipment.ArrivalDate,shipment.PickupDate,shipment.ShipmentID
                         FROM shipment
                         JOIN courier
                         ON shipment.CourierID=courier.CourierID";
                $search = mysqli_query($con,$name);
                if (!$search) {
                  echo "No such data!";
                } else {
                ?>
                  <form action='#' method='post'>
                  <table class='table table-hover table-dark table-bordered' id='dataTable' width='100%' cellspacing='0'>
                  <thead>
                  <tr>
                  <th>Name</th>
                  <th>Tracking Number</th>
                  <th>Type</th>
                  <th>Courier</th>
                  <th>Arrival Date</th>
                  <th>Pick Up Date</th>
                  <th>Update</th>
                  <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                <?
                while($row = mysqli_fetch_array($search)) {
                  $id = $row['ShipmentID'];
                ?>
                  <tr><td><? echo $row["Recipient"] ?></td>
                  <td><? echo $row["TrackingNumber"] ?></td>
                  <td><? echo $row["Type"] ?></td>
                  <td><? echo $row["Courier"] ?></td>
                  <td><? echo $row["ArrivalDate"] ?></td>
                  <td><? echo $row["PickupDate"] ?></td>
                  <td>
                    <a href=update.php?id=<? echo $id ?>>Update</a>
                  </td>
                  <td>
                    <a href=delete.php?id=<? echo $id ?>>Delete</a>
                  </td>
                  </tr>
                <?
                    }
              }
              ?>
                  </tbody>
              </table>
              <?
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
            <span>Copyright © Bootstrap 2019</span>
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
