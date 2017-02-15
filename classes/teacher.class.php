<?php

class teacher {
    public $name = "Jane";
    public $language = "English";
    public $no_courses = 0;

    public function start_new_course(){
        $this -> no_courses += 1;
    }
}