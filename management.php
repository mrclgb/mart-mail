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

  <title>Courier Management</title>

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
             Mail</div>
          <div style="background-color: grey" class="card-body">
            <div class="table-responsive">
              <form action="#" method="post">
              <table class='table table-hover table-dark' width='100%' cellspacing='0'>
              <tbody>
              <tr>
                <td>Name</td>
                <td><input name="name" maxlength="30" required></td>
                <td>Phone</td>
                <td><input name="phone" maxlength="15" required></td>
                <td>URL</td>
                <td><input name="url" maxlength="100" required></td>
              </tr>
              </tbody>
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
                $name = $_POST['name'];
                $phone = $_POST['phone'];
                $url = $_POST['url'];
                $sql = "INSERT INTO courier(`Name`, `Phone`, `URL`)
                VALUES ('".$name."','".$phone."','".$url."')";
                //echo $sql;
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
                         FROM courier";
              	$search = mysqli_query($con,$name);
              	if (!$search) {
              		echo "No such data!";
              	} else {
                ?>
                  <table class='table table-hover table-dark table-bordered' id='dataTable' width='100%' cellspacing='0'>
                  <thead>
                  <tr>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>URL</th>
                  <th>Update</th>
                  <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                <?
                while($row = mysqli_fetch_array($search)) {
                  $id = $row['CourierID'];
                ?>
            		  <tr><td><?echo $row["Name"]?></td>
            		  <td><?echo $row["Phone"]?></td>
            		  <td><?echo $row["URL"]?></td>
                  <td>
                    <a href=c_update.php?id=<? echo $id ?>>Update</a>
                  </td>
                  <td>
                    <a href=c_delete.php?id=<? echo $id ?>>Delete</a>
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

      <!-- Sticky Footer -->
      <footer>
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Bootstrap Website 2019</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Are you sure you want to log out?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="index.php">Logout</a>
        </div>
      </div>
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
