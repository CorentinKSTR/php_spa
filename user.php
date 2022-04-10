<?php session_start(); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>User</title>
</head>
<body>

<?php include('header.php') ?>


<h1 class="connect">Hello</h1>

<form method="post" class="connect">
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password">
    <input type="submit" value="Connect">
</form>




<?php

require_once 'class_user.php';
require_once 'database.php';
require_once 'class_pet.php';

if (!empty($_POST['email']) && !empty($_POST['password'])) {

    $database = new Database;
    $login = $database->login($_POST['email'], $_POST['password']);

    if($login){

    }else{
        echo '<p> Wrong email or password </p> ';
    }
}

if(isset($_SESSION['first_name'])){


    ?> <h1> <?php echo 'Hello ' .  $_SESSION['first_name']; ?></h1><?php


    echo '<style> .connect { display:none;}</style>';

    $database = new Database;
    $categories = $database->pet_category();
    $pets = $database->your_pet();

?>


<form action="" method="POST">

    <input type="text" placeholder="Pet Name" name="name">

    <select name="type" id="">

        <?php
            foreach($categories as $category){
                echo '<option value="'. $category['id'] . '">' . $category['type'] . '</option>';
            }
        ?>
        
    </select>

    <input type="submit" value="Send">
</form>

<?php



if (!empty($_POST['name'])) {

    $pet = new Pet($_POST['name'], $_POST['type'], $_SESSION['id']);

    $database->add_pet($pet);

    header('location:user.php');
    
}

?><h1>Your Pets</h1> 

<div class="liste_pets">


<?php



    foreach($pets as $pet){

        echo '  
    
                <div class="el"> 
                    <p class="upper"> '. $pet['type']  . '</p>' 
                    . ' ' . 
                    '<p class="cap">' . $pet['name']  . '</p> 
                </div>

                <form action="user.php" method="POST" >

                <input type="hidden" name="check" value="' . $pet[0] . '">

                <input type="submit" value="x" class="x">

                </form>';
    }
    
    if (!empty($_POST['check'])) {

        $database->delete($_POST['check']);

        header('location:user.php');
        
    }



}

?>
</div>

</body>
</html>

<?php
