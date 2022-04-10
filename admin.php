<?php session_start(); 
if($_SESSION['roles'] == 1){

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Admin</title>
</head>
<body>

<?php include('header.php') ?>

<?php

require_once 'class_user.php';
require_once 'database.php';
require_once 'class_pet.php';

$database = new Database;
$categories = $database->pet_category();
$users = $database->all_user();

?>



<h1>Hello Admin !</h1>

<?php

echo '<div class="global">';
foreach ($users as $user){

    echo '<div class="user">';

    echo '
            <div class="div_name">
            <p> ' . $user['name'] . '</p>
            <p class="quantity"> : ' . $user['quantity'] . '</p>
            </div>
        ';

        if($user['quantity'] > 0){

            $pets = $database->users_pets($user['email']);

            foreach($pets as $pet){
                echo '
                        <div class="div_pet">
                                <p class="upper">' . $pet['type'] . ' </p>
                                <p class="pet_name cap">' . $pet['name'] . ' </p>
                        </div>
                
                        
                    ';
            }
        }
        echo '</div>';
}

echo '</div>';


if (!empty($_POST['check'])) {

$database->delete($_POST['check']);

header('location:user.php');

}

?>



</body>
</html>

<?php

}else{
    header('location:user.php');
}
?>

