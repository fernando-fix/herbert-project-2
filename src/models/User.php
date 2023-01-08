<?php
namespace src\models;

class User{
    private $id;
    private $name;
    private $email;
    private $grouplvl;
    private $sector;
    private $password;
    private $token;
    private $avatar = 'default.jpg';

    
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
    
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email): self
    {
        $this->email = $email;
        return $this;
    }
    
    public function getGrouplvl()
    {
        return $this->grouplvl;
    }
    public function setGrouplvl($grouplvl): self
    {
        $this->grouplvl = $grouplvl;
        return $this;
    }
    
    public function getSector()
    {
        return $this->sector;
    }
    public function setSector($sector): self
    {
        $this->sector = $sector;
        return $this;
    }
    
    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password): self
    {
        $this->password = $password;
        return $this;
    }
    
    public function getToken()
    {
        return $this->token;
    }
    public function setToken($token): self
    {
        $this->token = $token;
        return $this;
    }
    
    public function getAvatar()
    {
        return $this->avatar;
    }
    public function setAvatar($avatar): self
    {
        $this->avatar = $avatar;
        return $this;
    }
}

interface UserDao {
    public function findByToken($token);
    public function findByEmail($email);
    public function updateToken($email, $token);
    public function addUser(User $user);
}