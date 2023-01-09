<?php
namespace src\models;

class GroupRelation{
    private $id_group;
    private $id_user;

    public function getIdGroup()
    {
        return $this->id_group;
    }
    public function setIdGroup($id_group): self
    {
        $this->id_group = $id_group;
        return $this;
    }

    public function getIdUser()
    {
        return $this->id_user;
    }

    public function setIdUser($id_user): self
    {
        $this->id_user = $id_user;
        return $this;
    }
}

interface GroupRelationDao {
    public function findById($id);
}