<link rel="stylesheet" href="css/style.css">

<div class="nav">

    <a href="login.php">Login</a>
    <a href="user.php">User</a>

    <?php if($_SESSION && $_SESSION['roles'] == 1){

        echo '<a href="admin.php">Admin</a>';
    }else{

    }
?>
</div>