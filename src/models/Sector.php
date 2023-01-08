<?php

namespace src\models;

class Sector
{
    public $id;
    public $name;
    private $responsible;

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

    public function getResponsible()
    {
        return $this->responsible;
    }
    public function setResponsible($responsible): self
    {
        $this->responsible = ucwords(strtolower(trim($responsible)));
        return $this;
    }
}

interface SectorDao
{
    public function findSector(string $sector): bool; //true, false
    public function addSector(Sector $sector);
}
