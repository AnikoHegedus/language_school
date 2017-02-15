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
    //the order of the course
    public static $id_course_counter = 0;
    // id_course should show the level, the language and 
    public $id_course = "";

    public static $id_course_counters = array();
    
    // getting the order of the courses
    public function incrementId(){
        self::$id_course_counter++;
    }
    
    //putting the id together with the level and the language
    public function generateId($order){
       $this -> incrementId();
            
        if($this -> language == "English"){
        $this -> id_course = $this -> level. "EN" . $order;
        } elseif ($this -> language == "German"){
        $this -> id_course = $this -> level . "DE" . $order;
        } elseif ($this -> language == "French"){
        $this -> id_course = $this -> level . "FR" . $order;
        }
    }

    // adding the order to the id 
    public static function calculateOrder(){
            // build an array of autoincremented ids
            $ordered_ids = [];
            foreach(static::$list_courses as $key=>$value){
                $ordered_ids[] = $value->id;
            }

            // sort the ids (lowest first)
            sort($ordered_ids);

            // flip the array
            $ordered_ids = array_flip($ordered_ids);

            // go through that array again and for each ->id find the proper order
            foreach(static::$list_courses as $key=>$value){
                $proper_order = $ordered_ids[$value->id]+1;

                $value->generateId($proper_order);
            }
            //$this -> id_course .= $key; 
    }

    public function __construct($id, $language, $no_hours, $teacher, $level, $status){
        static::$list_courses[] = $this;
        $this -> id = $id;
        $this -> language = $language;
        $this -> no_hours = $no_hours;
        $this -> teacher = $teacher;
        $this -> level = $level;
        $this -> status = $status;
        
    }

    public function course_start(){
        $this -> is_running = true;
    }

    public function has_stopped(){
        $this -> is_running = false;
    }
    
    
}
