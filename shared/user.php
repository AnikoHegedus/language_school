<?php

class user
{

    protected $db;

    public function __construct($db)
    {
        $this -> db = $db;
    }

    public function getName()
    {
        if(isset($_SESSION["userid"]))
        {
            $user = $this->db->getUser(($_SESSION["userid"]));
            if($user){
                return $user["name"];
            }
        }
        return false;
    }

}