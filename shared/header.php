<?php
/*
require_once "../database_courses.php";
require_once "../database_teachers.php";
require_once "../classes/courses.class.php";
*/
require_once "../admin/database_admin.php";
require_once "user.php";

$db = new database();
$user = new user($db);

$name = $user->getName();

if($name){
    echo "You are using the site as <br>" . htmlspecialchars($user->getName());
}else{
    echo "<a href='signup.php'>Sign up</a><br>";
    echo "<a href='login.php'>Log in</a>";
}