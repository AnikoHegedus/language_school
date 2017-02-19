<?php
/*require_once "../database_courses.php";*/
/*require_once "../database_teachers.php";*/


class teacher {

    protected $db;

    public $name = null;
    public $language = null;
    public $no_courses = 0;

    public function __construct(){
        $this -> db = new PDO ("mysql:host=localhost; dbname=language_school; charset=utf8", "root", "");
        $this -> db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //remove from production!
    }

    public static function courses_by_teacher($teacher){
        $stmt = $this -> db -> prepare("SELECT teacher FROM courses WHERE teacher = '$teacher'");
        $stmt -> execute();
        return $stmt -> fetch();
    }
}
