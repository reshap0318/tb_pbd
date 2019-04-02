<?php
  session_start();
  session_destroy();
  header('location:/tb_pbd/view/auth/login.php');
?>
