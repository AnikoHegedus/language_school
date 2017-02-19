<?php
require_once "database_admin.php";
$db = new database();


if($_POST){
    $userid = $db -> insertuser($_POST["name"], $_POST["email"], $_POST["password"]);
    session_start();
    $_SESSION["userid"] = $userid;
    header("Location: admin.php");
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
<form action="" method="post">
    Name:<br>
    <input type="text" name="name"><br>
    Email:<br>
    <input type="text" name="email"><br>
    Password:<br>
    <input type="password" name="password"><br>
    <input type="submit" value="Sign up" class="button">
</form>
</body>
</html>