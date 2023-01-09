<?php
namespace src\models;

class Group{
    private $id;
    private $name;


    public function getId()
    {
        return $this->id;
    }
    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }
    public function setName($name): self
    {
        $this->name = ucwords(strtolower(trim($name)));
        return $this;
    }
}

interface GroupDao {
    public function findAll();
    public function findById($id);
}