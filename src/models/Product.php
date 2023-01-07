<?php
namespace src\models;

class Product{
    public $id;
    public $name = "Fernando";
    public $email;
    public $password;
    public $token;
    public $avatar = 'default.jpg';
}

interface ProductDao {
    public function findAll();
    public function addProduct(Product $p);
}