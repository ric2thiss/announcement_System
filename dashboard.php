<?php
 include './model/User.php';
 include './controller/AuthController.php';
session_start();
$user = new User();
$destroy = new AuthController($user);
$user = $_SESSION['email'];

// echo $_SESSION["email"];
    if($_SESSION["email"] == $user){
        echo "Hello, " . $_SESSION["email"];
}
    if($_SESSION["email"] == ''){
        header('Location: ./login.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <br>
    <a href="./logout.php">Log Out</a>
</body>
</html>


