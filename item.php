<?php
  include('check_session.php');
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

  <div id="wrapper">
    <div style="background-color: grey" id="content-wrapper">

      <div class="container-fluid">

        <!-- New Item -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Mail</div>
          <div style="background-color: grey" class="card-body">
            <div class="table-responsive">
              <form action="#" method="post">
              <table class='table table-hover table-dark table-bordered' width='100%' cellspacing='0'>
              <tr>
                <td>Receipient Name</td>
                <td><input name="name" maxlength="50" required></td>
              </tr>
              <tr>
                <td>Tracking Number</td>
                <td><input name="track" maxlength="13" required></td>
              </tr>
              <tr>
                <td>Courier Name</td>
                <td><select name="courier">
                    <?
                    $con = mysqli_connect("localhost","root","","mail");
                    if (!$con) {
                      echo "Cannot connect".mysqli_connect_error();
                    } else {
                      $sql="SELECT Name
                            FROM courier";
                      $query=mysqli_query($con,$sql);
                      while ($row = mysqli_fetch_array($query)) {
                    ?>
                    <option value="<?echo $row["Name"]?>"><?echo $row["Name"]?></option>
                    <?
                      }
                    }
                   mysqli_close($con);?>
                    </select>
                </td>
              </tr>
              <tr>
                <td>Type</td>
                <td><input name="type" maxlength="10" required></td>
              </tr>
              <tr>
                <td>Date</td>
                <td>
                <input type="date" name="date">
                </td>
              </tr>
            </table>
      <button class="btn btn-block btn-secondary" type="submit" name="submit">Create</button>
          </form>
            </div>
          </div>
          <?php
            $con = mysqli_connect("localhost","root","","mail");
            if (!$con) {
              echo "Cannot connect".mysqli_connect_error();
            } else {
              if (isset($_POST['submit'])) {
                $query = mysqli_query($con,"SELECT CourierID
                                            FROM courier
                                            WHERE Name='".$_POST["courier"]."'");
                $row = mysqli_fetch_array($query);
                $query = $row["CourierID"];
                $name = $_POST['name'];
                $track = $_POST['track'];
                $courier = $_POST['courier'];
                $cid = $query;
                $type = $_POST['type'];
                $date = $_POST['date'];
                $tmp = array();
                $delimiter = "-";
                $tmp = explode($delimiter,$date);
                // echo $tmp[0].$tmp[1].$tmp[2];
                $sql = "INSERT INTO shipment(`Recipient`, `TrackingNumber`, `Type`, `CourierID`, `ArrivalDate`, `UserID`)
                        VALUES ('".$name."','".$track."','".$type."',".$cid.",'".$tmp[0]."-".$tmp[1]."-".$tmp[2]."',1)";
                // echo $sql;
                $insert = mysqli_query($con,$sql);
                if ($insert) {
                  echo "<center><font color='blue'>Created</font></center>";
               	} else {
                  echo "<center><font color='red'>Cannot create item! Possible foreign key problem</font></center>";
                }
              }
            }
            mysqli_close($con);
          ?>
          <div style="background-color: grey" class="card-body">
            <div class="table-responsive">
              <?php
              	$con = mysqli_connect("localhost","root","","mail");
              	// //Check connection
              	if(mysqli_connect_errno($con)) {
              		echo "Fail to connect to MySQL:" . mysqli_connect_error($con);
              	}
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
                  <th>Pickup Date</th>
                  <th>Update</th>
                  <th>Edit</th>
                  </tr>
                </thead>
                <tbody>
                <?
                while($row = mysqli_fetch_array($search)) {
                ?>
            		  <tr><td><? echo $row["ShipmentID"] ?></td>
            		  <td><? echo $row["Recipient"]?></td>
            		  <td><? echo$row["TrackingNumber"]?></td>
                  <td><? echo$row["Type"]?></td>
            		  <td><? echo$row["CourierID"]?></td>
                  <td><? echo$row["ArrivalDate"]?></td>
                  <td><? echo$row["PickupDate"]?></td>
                  <td>
                    <a href=i_update.php?id=<? echo $row["ShipmentID"] ?>>Update</a>
                  </td>
                  <td>
                    <a href=i_delete.php?id=<? echo $row["ShipmentID"] ?>>Delete</a>
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
      <!-- Sticky Footer -->
      <footer>
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Bootstrap Website 2019</span>
          </div>
        </div>
      </footer>

    </div>

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
