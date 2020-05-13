<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Register</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Register an Account</div>
      <div class="card-body">
        <form action="#" method="post">
          <div class="form-group">
            <div class="form-row">

          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input id="inputUsername" name="username" class="form-control" placeholder="Username" required="required">
              <label for="inputUsername">Username</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" id="inputPassword" name="firstpass" class="form-control" placeholder="Password" required="required">
                  <label for="inputPassword">Password</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" id="confirmPassword" name="secondpass" class="form-control" placeholder="Confirm password" required="required">
                  <label for="confirmPassword">Confirm password</label>
                </div>
              </div>
            </div>
          </div>
          <center>
          <button class="btn btn-block btn-secondary" type="submit" name="submit">Register</button>
          </center>
        </form>
        <?php
            if (!isset($_POST['submit'])) {
              exit;
            } else{
              $first = $_POST['firstpass'];
              $second = $_POST['secondpass'];
              if ($first != $second) {
                echo "<center>";
                echo "<font color=red>Passwords not match</font>";
                echo "</center>";
              } else {
                $con = mysqli_connect("localhost","root","","mail");
                if (!$con) {
              		die('Database not exist').mysqli_error();
              	}
                $username = mysqli_real_escape_string($con,$_POST["username"]);
                $password = mysqli_real_escape_string($con,$_POST["firstpass"]);
                $password = hash("sha256",$password);
              	$sql="INSERT INTO user (UserID,Username,Password) VALUES
              		  (1,'".$username."','".$password."')";

               	//echo $sql;
               	$query=mysqli_query($con,$sql);

               	if ($query) {
                  echo "<center><font color='blue'>Account Created</font></center>";
               	} else {
                  echo "<center><font color='red'>By the policy you can only create one admin account!!!!</font></center>";
                }

              mysqli_close($con);
              }
            }
        ?>
        <div class="text-center">
          <a class="d-block small mt-3 text-dark" href="login.php">Login Page</a>
          <a class="d-block small text-dark" href="forgot-password.php">Forgot Password?</a>
        </div>
      </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
