<?php

class teacher {
    public $name = null;
    public $language = null;
    public $no_courses = 0;

    public function start_new_course(){
        $this -> no_courses += 1;
    }
}