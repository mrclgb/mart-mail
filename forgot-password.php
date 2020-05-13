<?php
  session_start();
  $_SESSION['forgot'] = time()+3600;
  setcookie("forgot", hash("sha256",rand()), time()+3600);
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Forgot Password</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Reset Password</div>
      <div class="card-body">
        <div class="text-center mb-4">
          <h4>Forgot your password?</h4>
          <p>Just type your password twice cuz I don't know how to reset with phone number or email.</p>
        </div>
        <form action="#" method="post">
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
        <button class="btn btn-block btn-secondary" type="submit" name="submit">Reset</button>
        </center>
        </form>
        <?php
        if (isset($_POST['submit'])) {
          $first = $_POST['firstpass'];
          $second = $_POST['secondpass'];
          if ($first != $second) {
            echo "<center>";
            echo "<font color=red>Passwords not match</font>";
            echo "</center>";
          } else{
            $con = mysqli_connect("localhost","root","","mail");
          	if (!$con) {
          		die('Database not exist').mysqli_error();
          	} else {
                $password = mysqli_real_escape_string($con,$_POST['firstpass']);
                $password = hash("sha256",$password);
                $sql = "UPDATE user
              		      SET Password='".$password."'
                        WHERE UserID=1";
                //echo $sql;
                $query=mysqli_query($con,$sql);


                if ($query) {
                  echo "<center><font color='blue'>Password Reset</font></center>";
                } else {
                  echo "<center><font color='red'>Cannot change password contact the one who write this!</font></center>";
                }
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

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
