<?php

class database{

    protected $db;

    public function __construct(){
        $this -> db = new PDO ("mysql:host=localhost; dbname=language_school; charset=utf8", "root", "");
        $this -> db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //remove from production!
    }

    public function insertUser($name, $email, $password){
        $stmt = $this -> db -> prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt -> execute([$name, $email, password_hash($password, PASSWORD_DEFAULT)]);
        return $this->db->lastInsertId();
    }

    public function getUser($id){
        $stmt = $this -> db -> prepare("SELECT id, name, email, password FROM users WHERE id = ?");
        $stmt -> execute([$id]);
        return $stmt -> fetch();
    }    

    public function getUserByEmail($email){
        $stmt = $this -> db -> prepare("SELECT id, name, email, password FROM users WHERE email = ?");
        $stmt -> execute([$email]);
        return $stmt -> fetch();
    } 

}