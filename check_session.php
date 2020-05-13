<?php
    session_start();
    if (empty($_SESSION["login"])) {
      header("Refresh:0;url=login.php");
    }
?>
