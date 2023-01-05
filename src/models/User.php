<?php
namespace src\models;

class User {
    public $id;
    public $name;
    public $email;
    public $token;
}

interface UserDao {
    public function showInfo();
    public function addUser(User $u); //add usuario
}