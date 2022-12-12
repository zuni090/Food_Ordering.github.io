<?php
session_start();
include('function.inc.php');
unset($_SESSION['IS_LOGIN_DELIVERY']);
redirect('deliveryLogin.php');
?>