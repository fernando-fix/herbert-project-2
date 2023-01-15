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

    public function getId()
    {
        return $this->id;
    }
    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getPatrimony()
    {
        return $this->patrimony;
    }
    public function setPatrimony($patrimony): self
    {
        $this->patrimony = $patrimony;
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

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getLastMov()
    {
        return $this->last_mov;
    }
    public function setLastMov($last_mov): self
    {
        $this->last_mov = $last_mov;
        return $this;
    }

    public function getIdSector()
    {
        return $this->id_sector;
    }
    public function setIdSector($id_sector): self
    {
        $this->id_sector = $id_sector;
        return $this;
    }

    public function getIdRespMov()
    {
        return $this->id_resp_mov;
    }
    public function setIdRespMov($id_resp_mov): self
    {
        $this->id_resp_mov = $id_resp_mov;
        return $this;
    }
}

interface ProductDao
{
    public function findAll();
    public function addProduct(Product $p);
}
