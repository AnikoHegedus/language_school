<?php
require_once "classes/courses.class.php";
require_once "database_teachers.php";

//get all the files within classes as array
$files = scandir("classes");

foreach($files as $file){
    // if the file is the reference to this folder
    //or the one above, continue
    if($file == "." || $file == "..")
    continue;
    
    //if the file is a php file 
    if(pathinfo($file, PATHINFO_EXTENSION) == "php"){
        //require the file
        require_once ("classes/" . $file);
    }
}
// get teacher's details on the basis of the get method (basically clicking on his name)
$teachers_name = $_GET["teacher"];
$stmt = $db -> prepare("SELECT last_name, first_name, language, teaching_experience, motto FROM teachers WHERE last_name = '$teachers_name'");
$stmt -> execute();

$teacher_profile = [];
foreach ($stmt -> fetchAll() as $value){
    
    $teacher_profile["last_name"] = $value["last_name"];
    $teacher_profile["first_name"] = $value["first_name"];
    $teacher_profile["language"] = $value["language"];
    $teacher_profile["teaching_experience"] = $value["teaching_experience"];
    $teacher_profile["motto"] = $value["motto"];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profiles</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <header>
        <h1>My Language School</h1>
    </header>

    <h2>Personal profile of <?php echo $teacher_profile["first_name"] . " " . $teacher_profile["last_name"]; ?></h2>
        <?php if($teachers_name == "Parsons" || $teachers_name == "Stahl") :?>
            <img src="img/male.png" alt="profile photo">
        <?php elseif($teachers_name == "Girardot") :?>
            <img src="img/female.png" alt="profile photo">
        <?php endif; ?>
    <p><?php echo "Last name: " . $teacher_profile["last_name"]; ?></p>
    <p><?php echo "First name: " . $teacher_profile["first_name"]; ?></p>
    <p><?php echo "Language taught: " . $teacher_profile["language"]; ?></p>
    <p><?php echo "Teaching experience: " . $teacher_profile["teaching_experience"]; ?></p>
    <p><?php echo "Motto: " . $teacher_profile["motto"]; ?></p>
    <br>
    <a href="index.php">Back to main page</a>
</body>
</html>