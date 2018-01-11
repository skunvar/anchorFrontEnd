<?php
 //logout.php
 include 'config/config.php';

 session_destroy();
 header("location:".BASE_PATH."home");
 ?>
