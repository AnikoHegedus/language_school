<?php
require_once "../classes/courses.class.php";
require_once "../database_teachers.php";
session_start();
//get all the files within classes as array
$files = scandir("../classes");

foreach($files as $file){
    // if the file is the reference to this folder
    //or the one above, continue
    if($file == "." || $file == "..")
    continue;
    
    //if the file is a php file 
    if(pathinfo($file, PATHINFO_EXTENSION) == "php"){
        //require the file
        require_once ("../classes/" . $file);
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
        <button class="button logout" onclick='window.location.href="../index.php"'>Logout</button>
        <div class="hello"><?php require "../shared/header.php"; ?></div>
    </header>
    
    <h1>Choose an option</h1>
    
    <div class="button_list">
        <button onclick='window.location.href="list_teachers.php"' class="button">Database of teachers</button>
        <button onclick='window.location.href="list_courses.php"' class="button">Database of courses</button>
        <button onclick='window.location.href="students.php"' class="button">Database of students</button>
    </div>
    <a href="../index.php">Back to main page</a>
</body>
</html>