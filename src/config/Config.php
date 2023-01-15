<?php

namespace src\core;

use PDO;

session_start();

date_default_timezone_set('America/Sao_Paulo');

class Config
{
    public $base;
    public $connection;

    public $mode = "developer";

    private $db_host;
    private $db_name;
    private $db_user;
    private $db_pass;

    public function __construct()
    {
        if($this->mode == "developer") {
            //modo de desenvolvimento
            $this->base = "http://localhost/herbert-project-2";

            $this->db_host = "localhost";
            $this->db_name = "ativos";
            $this->db_user = "root";
            $this->db_pass = "";
        } else  {
            //modo de produção
            $this->base = "https://app4test.000webhostapp.com";
            
            $this->db_host = "localhost";
            $this->db_name = "id20029090_localhost";
            $this->db_user = "id20029090_root";
            $this->db_pass = "jq@Sd!H=75mkf6@T";
        }
        
        //fazer a conexão
        $this->connection = new PDO("mysql:dbname=$this->db_name;host=$this->db_host", $this->db_user, $this->db_pass);
    }
}
