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
    /*$teachers[$value["first_name"]] = $value["first_name"]; */
    $teachers[$value["last_name"]] = $value["last_name"];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New courses</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <header>
        <h1>My Language School</h1>
    </header>

<?php
if($_POST){
    require_once "database_courses.php";
    $statement = $db -> prepare ("INSERT INTO courses (language, no_hours, teacher, level, status) VALUES (?, ?, ?, ?, ?)");
    $statement -> execute ([$_POST["language"], $_POST["no_hours"],$_POST["teacher"], $_POST["level"], $_POST["status"]]);

    echo "New course added to the list.";
}
?>

   <h2>Insert a new course</h2> 

<form action="" method="post">
Language:
<select name="language">
    <option value="">---</option>
    <option value="English">English</option>
    <option value="French">French</option>
    <option value="German">German</option>
    <option value="Czech">Czech</option>
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
<select name="teacher">
    <option value="">---</option>
    <?php
        /*foreach ($teachers as $lastname){
            echo "<option value=$lastname>$lastname</option>";
        }*/
        if($_POST["language"] == "English"){
            echo "<option value='Parsons'>Parsons</option>";
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
<input type="submit">

<br>
<br>

</form>
<a href="../index.php">Back to main page</a>

</body>
</html>