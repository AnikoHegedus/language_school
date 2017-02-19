<?php

class course{
    public static $list_courses = array();
    
    public static function getNumberOfCourses(){
        return count(static::$list_courses);
    }

    public $id = null;
    public $language = "";
    public $no_hours = 60;
    public $teacher = "";
    public $level = "";
    public $status = "";

    public function __construct($id, $language, $no_hours, $teacher, $level, $status){
        static::$list_courses[] = $this;
        $this -> id = $id;
        $this -> language = $language;
        $this -> no_hours = $no_hours;
        $this -> teacher = $teacher;
        $this -> level = $level;
        $this -> status = $status;
    }
   
}
