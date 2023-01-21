<?php

namespace src\models;

class Grouplvl
{
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
        $this->name = $name;

        return $this;
    }
}
interface GrouplvlDao
{
    public function findById($id): string;
}
