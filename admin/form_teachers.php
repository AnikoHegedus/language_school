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
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New courses</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
   <header class="header-admin">
        <h1>My Language School</h1>
        <h2>Admin site</h2>
        <button class="button logout" onclick='window.location.href="../index.php"'>Logout</button>
        <div class="hello"><?php require "../shared/header.php"; ?></div>
    </header>
   <h2>Register new teacher</h2> 

<?php
if($_POST){
    require_once "../database_teachers.php";
    $statement = $db -> prepare ("INSERT INTO teachers(first_name, last_name, gender, language, nationality, teaching_experience, motto, salary) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $statement -> execute ([$_POST["first_name"], $_POST["last_name"], $_POST["gender"], $_POST["language"], $_POST["nationality"], $_POST["teaching_experience"], $_POST["motto"],$_POST["salary"]]);

    echo "New teacher registered.";
}
?>

<form action="" method="post">
First name:
<input type="text" name="first_name">
<br>
Last name:
<input type="text" name="last_name">
<br>
<label for="male">Male</label>
<input type="radio" name="gender" id="male" value="M">
<label for="female">Female</label>
<input type="radio" name="gender" id="female" value="F"><br>
<br>
Language:
<select name="language">
    <option value="">---</option>
    <option value="English">English</option>
    <option value="French">French</option>
    <option value="German">German</option>
    <option value="Czech">Czech</option>
</select>
<br>
Level:
<select name="level">
    <option value="">---</option>
    <option value="A1">Up to A1</option>
    <option value="A2">Up to A2</option>
    <option value="B1">Up to B1</option>
    <option value="B2">Up to B2</option>
    <option value="C1">Up to C1</option>
    <option value="C2">Up to C2</option>
</select>
<br>
Nationality:
<input type="text" name="nationality">
<br>
Teaching experience:
<input type="text" name="teaching_experience" placeholder="eg. 10+ years">
<br>
Motto:
<textarea rows="6" cols="26" name="motto"></textarea>
<br>
Salary:
<input type="text" name="salary">
<br>
<input type="submit" value="Save" class="button">
<br>


</form>
<a href="../index.php">Back to main page</a><br>
<a href="admin.php">Back to main admin page</a>

</body>
</html>