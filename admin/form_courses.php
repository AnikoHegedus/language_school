<?php
require_once "../classes/courses.class.php";
require_once "../database_teachers.php";

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




$stmt = $db -> prepare("SELECT first_name, last_name FROM teachers ORDER BY last_name");
$stmt -> execute();
$teachers = [];
foreach ($stmt -> fetchAll() as $value){
    $teachers[$value["last_name"]] = $value["last_name"];
}
$last_item = end(course::$list_courses);
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New courses</title>
    <link rel="stylesheet" href="../style/style.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
</head>
<body>
    <header class="header-admin">
        <h1>My Language School</h1>
        <h2>Admin site</h2>
        <button class="button logout" onclick='window.location.href="../index.php"'>Logout</button>
        <div class="hello"><?php require "../shared/header.php"; ?></div>
    </header>

<?php

if($_POST){
    if($_POST["language"] == "English"){
    $course_code = $_POST["level"] . "EN";
    }else if($_POST["language"] == "German"){
    $course_code = $_POST["level"] . "DE";
    }else if($_POST["language"] == "French"){
    $course_code = $_POST["level"] . "FR";
    }
    

    require_once "../database_courses.php";
    
    $statement = $db -> prepare ("INSERT INTO courses (language, no_hours, teacher, level, status, id_course) VALUES (?, ?, ?, ?, ?, ?)");
    $statement -> execute ([$_POST["language"], $_POST["no_hours"],$_POST["teacher"], $_POST["level"], $_POST["status"], $course_code]);

    echo "New course added to the list.";
    
}
?>

   <h2>Insert a new course</h2> 

<form action="" method="post">
Choose a language:
<select name="language" id="language">
    <option value="">---</option>
    <option value="English">English</option>
    <option value="French">French</option>
    <option value="German">German</option>
    <option value="Czech">Czech</option><br>
   
</select>

<br>

Number of hours:
<select name="no_hours">
    <option value="60">60</option>
    <option value="120">120</option>
    <option value="180">180</option>
</select>
<br>
Teacher:
<select name="teacher" id="teacher">
    <option value="">---</option>
    
    <?php
           foreach ($teachers as $lastname){
          echo "<option value=$lastname>$lastname</option>";
        }
        ?>
</select>
<br>
Level:
<select name="level">
    <option value="">---</option>
    <option value="A1">A1</option>
    <option value="A2">A2</option>
    <option value="B1">B1</option>
    <option value="B2">B2</option>
    <option value="C1">C1</option>
    <option value="C2">C2</option>
</select>
<br>
Status:
<select name="status">
    <option value="Open for registration">Open for registration</option>
    <option value="Running">Running</option>
    <option value="On hold">On hold</option>
    <option value="Cancelled">Cancelled</option>
    <option value="Coming soon">Coming soon</option>
</select>
<br>
<input type="submit" value="Send" class="button">

<br>
<br>

</form>
<a href="../index.php">Back to main page</a><br>
<a href="admin.php">Back to main admin page</a>

</body>
</html>