<?php
require_once "../database_courses.php";
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

//MySQL request to see all the courses
$statement = $db -> prepare("SELECT * FROM courses ORDER BY language, level, id ASC");
$statement -> execute();

// Putting courses in an array on the basis of the MySQL request
$courses = [];
foreach ($statement -> fetchAll() as $value){
     $courses[] = $value; 
}
//MySQL request to count all the courses
$statement = $db -> prepare("SELECT COUNT(id_course) FROM courses");
$statement -> execute();
$no_courses = [];
foreach ($statement -> fetchAll() as $value){
     $no_courses[] = $value; 
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My language school</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <header class="header-admin">
        <h1>My Language School</h1>
        <h2>Admin site</h2>
    </header>
    <button class="button" onclick='window.location.href="form_courses.php"'>Add a new course</button>
    
    <p>Number of courses currently offered: <?php echo $no_courses[0][0]; ?></p>
    
    
    <p>Please find below the list of our courses</p>
    <table border=1px; class="table">
        <thead>
            <tr><th>Language</th><th>Level</th><th>Teacher</th><th>Course ID</th><th>Status</th><th>Number of registered students</th></tr>
        </thead>
        <tbody>
        <!--listing the courses on the basis of the database-->          
        <?php foreach($courses as $course) :?>
        
            <tr>
                <td>
                    <?php echo $course["language"]; ?>
                </td>
                <td>
                    <?php echo $course["level"]; ?>
                </td>
                <td>
                    <?php echo $course["teacher"]; ?></a>
                </td>
                <td>
                    <?php echo $course["id_course"]; ?>
                </td>
                <td>
                    <!--adding links for future students to register-->
                    <?php if ($course["status"] == "Open for registration"){?><a href="../registration.php"><?php echo $course["status"]; ?></a>
                    <?php } else { echo $course["status"]; } ?>
                </td>
                <td>
                    <?php echo $course["no_registered_students"]; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody> 
    </table>
<br>
<a href="../index.php">Back to main page</a>
</body>
</html>