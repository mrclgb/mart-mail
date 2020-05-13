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
      <a href="pickup.php" class="btn btn-outline-light my-2 my-sm-0" role="button" aria-pressed="true">Back</a>
  </nav>

  <center>
  <span class="blinking"><p><font size="5">Please search for the given Tracking Number for the current user</font></p></span>
  </center>
    <div style="background-color: grey" id="content-wrapper">

      <div class="container-fluid">

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            AIU Mail</div>
          <div style="background-color: grey" class="card-body">
            <form action="#" method="post">
               <input type="date" name="date">
                  <button class="btn btn-secondary" type="submit" name="submit">Update</button>
            </form>

              <?php
                $con = mysqli_connect("localhost","root","","mail");
                if (!$con) {
                  echo "Cannot connect".mysqli_connect_error($con);
                } else {
                  if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $sql="SELECT TrackingNumber
                          FROM shipment
                          WHERE ShipmentID='".$id."'";
                    //echo $sql;
                    $query = mysqli_query($con,$sql);
                    $show = mysqli_fetch_array($query);
                    echo "<center>
                          <span class='blinking'><p><font size='10'>".
                          "Tracking Number: ".$show[0].
                          "</font></p></span></center>";
                  }
                  if (isset($_POST['submit'])) {
                    $date = $_POST['date'];
                    // echo $date;
                    $tmp1 = array();
                    $tmp2 = array();
                    $str = mysqli_query($con,"SELECT ArrivalDate
                                              FROM shipment
                                              WHERE ShipmentID ='".$id."'");
                    $str = mysqli_fetch_array($str);

                    //echo $str[0];
                    $delimiter = "-";
                    $tmp1 = explode($delimiter,$str[0]);
                    $tmp2 = explode($delimiter,$date);
                    // echo $tmp1[0]."<br>".$tmp1[1]."<br>".$tmp1[2];
                    // echo $tmp2[0]."<br>".$tmp2[1]."<br>".$tmp2[2];
                    if (isset($tmp1)&&isset($tmp2)) {
                      if ($tmp1[0]>$tmp2[0]||$tmp1[0]==$tmp2[0]&&$tmp1[1]>$tmp2[1]||$tmp1[1]==$tmp2[1]&&$tmp1[2]>$tmp2[2]) {
                        echo "<div style='background: white'><center><font color='red'>How can someone pick a future item from the past?</font></center></div>";
                      } else {
                        $sql = "UPDATE shipment
                                SET PickupDate = '".$tmp2[0]."-".$tmp2[1]."-".$tmp2[2]."'
                                WHERE ShipmentID = '".$id."'";
                        // echo $sql;
                        $insert = mysqli_query($con,$sql);
                        if ($insert) {
                          echo "<center><font color='blue'>Created</font></center>";
                        } else {
                          echo "<center><font color='red'>Cannot create item! Possible foreign key problem</font></center>";
                        }
                     }
                   }
                  }
                }
                mysqli_close($con);
              ?>
            <div class="table-responsive">
              <?php
                $con = mysqli_connect("localhost","root","","mail");
                // //Check connection
                if(mysqli_connect_errno($con)) {
                  echo "Fail to connect to MySQL:" . mysqli_connect_error($con);
                }
                $name = "SELECT shipment.Recipient,shipment.TrackingNumber,shipment.Type,courier.Name as Courier,shipment.ArrivalDate,shipment.PickupDate
                         FROM shipment
                         JOIN courier
                         ON shipment.CourierID=courier.CourierID";
                $search = mysqli_query($con,$name);
                if (!$search) {
                  echo "No such data!";
                } else {
                ?>
                  <table class='table table-hover table-dark table-bordered' id='dataTable' width='100%' cellspacing='0'>
                  <thead>
                  <tr>
                  <th>Name</th>
                  <th>Tracking Number</th>
                  <th>Type</th>
                  <th>Courier</th>
                  <th>Arrival Date</th>
                  <th>Pick Up Date</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                while($row = mysqli_fetch_array($search)) {
                ?>
                  <tr>
                  <td><?php echo $row["Recipient"]?></td>
                  <td><? echo $row["TrackingNumber"]?></td>
                  <td><? echo $row["Type"]?></td>
                  <td><? echo $row["Courier"]?></td>
                  <td><? echo $row["ArrivalDate"]?></td>
                  <td><? echo $row["PickupDate"] ?></td>
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
            <span>Copyright © Bootstrap Website 2019</span>
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
