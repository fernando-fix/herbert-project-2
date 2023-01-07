<?php
namespace src\models;

class User{
    public $id;
    public $name = "Fernando";
    public $email;
    public $password;
    public $token;
    public $avatar = 'default.jpg';
}

interface UserDao {
    public function findByToken($token);
    public function findByEmail($email);
    public function updateToken($email, $token);
    public function addUser(User $user);
}