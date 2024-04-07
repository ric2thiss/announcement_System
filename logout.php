<?php
 include './model/User.php';
 include './controller/AuthController.php';
session_start();

$user = new User();
$destroy = new AuthController($user);

$destroy->logout();
?>