<?php

namespace src\models;

class Product
{
    private $id;
    private $patrimony;
    private $name;
    private $description;
    private $last_mov;
    private $id_sector;
    private $id_resp_mov;
}

interface ProductDao
{
    public function findAll();
    public function addProduct(Product $p);
}
