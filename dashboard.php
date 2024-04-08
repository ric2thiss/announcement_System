<?php
 include './model/User.php';
 include './controller/AuthController.php';
session_start();
$user = new User();
$destroy = new AuthController($user);
$user = $_SESSION['email'];

// echo $_SESSION["email"];
    if($_SESSION["email"] == $user){
        // echo "Hello, " . $_SESSION["email"];
}
    if($_SESSION["email"] == ''){
        header('Location: ./login.php');
    }


    include 'index.php';
?>






