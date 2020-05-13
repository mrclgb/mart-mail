<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form action="#" method="post">
          <div class="form-group">
            <div class="form-label-group">
              <input name="username" id="inputUsername" class="form-control" placeholder="Username" required="required" autofocus="autofocus">
              <label for="inputUsername">Username</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" name="password" autofocustype="password" id="inputPassword" class="form-control" placeholder="Password" required="required">
              <label for="inputPassword">Password</label>
            </div>
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" value="remember-me">
                Remember Password
              </label>
            </div>
          </div>
          <center>
          <button class="btn btn-block btn-secondary" type="submit" name="submit">Login</button>
          </center>
        </form>
        <?php
          if (isset($_POST['submit'])) {
              $con = mysqli_connect("localhost","root","","mail");
              if (!$con) {
                die('Database not exist').mysqli_error();
              }
              $sql="SELECT Username, Password
                    FROM user";

              //echo $sql;
              $username = mysqli_real_escape_string($con,$_POST["username"]);
              $password = mysqli_real_escape_string($con,$_POST["password"]);
              $password = hash("sha256",$password);
              $query=mysqli_query($con,$sql);

              while ($row = mysqli_fetch_array($query)){
                if ($row["Username"] == $username && $row["Password"] == $password) {
                  $_SESSION['login'] = hash("sha256",rand());
                  header("Location: admin.php");
                } else {
                  echo "<center><font color='red'>Wrong username or password</font></center>";
                }
              }


            mysqli_close($con);
          }
        ?>
        <div class="text-center">
          <a class="d-block small mt-3 text-dark" href="register.php">Register an Account</a>
          <a class="d-block small text-dark" href="forgot-password.php">Forgot Password?</a>
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
