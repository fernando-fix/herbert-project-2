<?php

namespace src\models;

class Log
{
    private $id;
    private $user_id;
    private $type;
    private $detail;
    private $datetime;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getUserId()
    {
        return $this->user_id;
    }
    public function setUserId($user_id): self
    {
        $this->user_id = $user_id;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }
    public function setType($type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getDetail()
    {
        return $this->detail;
    }
    public function setDetail($detail): self
    {
        $this->detail = $detail;
        return $this;
    }

    public function getDateTime()
    {
        return $this->datetime;
    }
    public function setDateTime($datetime): self
    {
        $this->datetime = $datetime;
        return $this;
    }
}

interface LogDao
{
    public function findAll(): array;
}
