<?php session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
</head>
<body>

<?php include('header.php') ?>


<h1>Registration</h1>
    
<form method="post">
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password">
    <input type="text" name="first_name" placeholder="First name">
    <input type="text" name="last_name" placeholder="Last name">
    <input type="submit" value="Registration" class="btn">
</form>

<div class="div_succes">

<a href="user.php" class="login"> Already registered ?</a>

</div>

<?php

require_once 'class_user.php';
require_once 'database.php';

if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['first_name']) && !empty($_POST['last_name'])) {

    $user = new User($_POST['email'], $_POST['password'], $_POST['first_name'], $_POST['last_name']);

    
    $database = new Database;
    $create_user = $database->createUser($user);

    echo '<div class="div_succes"> <p class="succes">Account create</p> <a href="user.php" class="login">Login</a> </div>';
    
    
}

?>

</body>
</html>