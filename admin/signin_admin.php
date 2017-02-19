<?php
require_once "database_admin.php";
$db = new database();


if($_POST){
    $user = $db->getUserByEmail($_POST["email"]);
    if(empty($user)){
        echo "Wrong user";
    }elseif (password_verify($_POST["password"], $user["password"])){
        session_start();
        $_SESSION["userid"] = $user["id"];
        header("Location: admin.php");
    }else{
        echo "Wrong password";
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin page</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <header class="header-admin">
        <h1>My Language School</h1>
        <h2>Admin site</h2>
    </header>
    <h4>Since it is a demo site you can register yourself or use the following data to log in</h4>
    <p>Email: admin1@admin.org</p>
    <p>Password: admin1</p>
<form action="" method="post">
    Email:<br>
    <input type="text" name="email"><br>
    Password:<br>
    <input type="password" name="password"><br>
    <input type="submit" value="Log in" class="button">
</form>
</body>
</html>