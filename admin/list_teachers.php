<?php
/*require_once "../classes/courses.class.php";*/
require_once "../classes/teacher.class.php";
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


// get teacher's details - more detailed than for the "normal" visitors of the page on the basis of the get method (basically clicking on his name)

$stmt = $db -> prepare("SELECT * FROM teachers");
$stmt -> execute();

$teacher_profile = [];
foreach ($stmt -> fetchAll() as $value){
    $teacher_profile[] = $value;
}


//MySQL request to see all the courses
$statement = $db -> prepare("SELECT teacher FROM courses");
$statement -> execute();

// Putting courses in an array on the basis of the MySQL request for counting how many classes each teacher has
$courses = [];
foreach ($statement -> fetchAll() as $value){
     $courses[] = $value; 
}

/*$statement = $db -> prepare("SELECT teacher FROM courses WHERE teacher = ?");
$statement -> execute(["Parsons"]);
$no_classes_parsons = [];
foreach ($statement -> fetchAll() as $value){
     $no_classes_parsons[] = $value; 
}*/




$no_classes_by_teachers = [];
$no_classes_parsons = null;
$no_classes_stahl = null;
$no_classes_girardot = null;
foreach($courses as $value){
    if($value["teacher"] == "Parsons"){
        $no_classes_parsons++;
        $teacher_profile[0]["no_classes"] = $no_classes_parsons;
    }elseif($value["teacher"] == "Stahl"){
        $no_classes_stahl++;
        $teacher_profile[1]["no_classes"] = $no_classes_stahl;
    }elseif($value["teacher"] == "Girardot"){
        $no_classes_girardot++;
        $teacher_profile[2]["no_classes"] = $no_classes_girardot;
    }
}
session_start();

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
    <button class="button" onclick='window.location.href="form_teachers.php"'>Register a new teacher</button>
   <h2></h2>
    <table border=1px; class="table">
        <thead>
            <tr><th>Id</th><th>First name</th><th>Last name</th><th>Gender</th><th>Language</th><th>Nationality</th><th>Teaching experience</th><th>Motto</th><th>Salary</th><th>No classes currently taught</th></tr>
        </thead>
        <tbody>
    <?php foreach($teacher_profile as $teacher) :?>
        
           <tr>
               <td>
                    <?php echo $teacher["id"]; ?>
                </td>
                <td>
                    <?php echo $teacher["first_name"]; ?>
                </td>
                <td>
                    <a href="../profiles.php?teacher=<?php echo $teacher['last_name']; ?>" title="profile of <?php echo $teacher['last_name']; ?>"><?php echo $teacher["last_name"]; ?></a>
                </td>
                <td>
                    <?php echo $teacher["gender"]; ?>
                </td>
                <td>
                    <?php echo $teacher["language"]; ?>
                </td>
                <td>
                    <?php echo $teacher["nationality"]; ?>
                </td>
                <td>
                    <?php echo $teacher["teaching_experience"]; ?>
                </td>
                <td>
                    <?php echo $teacher["motto"]; ?>
                </td>
                <td>
                    <?php echo $teacher["salary"]; ?>
                </td>
                <td>
                
                    <?php echo $teacher["no_classes"]; ?>
                 
             </td>            
             <?php endforeach; ?>
             
        </tr>
         
     </tbody>
    </table>
    <a href="../index.php">Back to main page</a><br>
    <a href="admin.php">Back to main admin page</a>
</body>
</html>