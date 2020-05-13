<?php
  session_start();
  unset($_SESSION["login"]);
  session_destroy();
  header('Refresh:0;url=index.php');
?>
