<?php

namespace src\models;

use src\core\Config;
use src\dao\UserDaoMysql;

require "src/config/Config.php";

class Auth
{
    public $base;
    public $connection;

    public function __construct()
    {
        $config = new Config();

        $this->base = $config->base;
        $this->connection = $config->connection;
    }

    public function isLogged()
    {

        if (isset($_SESSION['token'])) {
            $token = $_SESSION['token'];
            $userDao = new UserDaoMysql($this->connection);
            $loggedUser = $userDao->findByToken($token);
            if ($loggedUser != false) {
                return $loggedUser;
            }
        }
        header("Location: " . $this->base . "/signin.php");
        exit;
    }

    public function validate_login($email, $password)
    {
        if (!empty($email) && !empty($password)) {
            $userDao = new UserDaoMysql($this->connection);
            $loggingUser = $userDao->findByEmail($email);
            if ($loggingUser != false) {

                //verificar senhas
                if (password_verify($password, $loggingUser->password)) {
                    //gerar token
                    $token = md5(time() . rand(1111, 9999) . time());
                    $_SESSION['token'] = $token;

                    //gravar token
                    $userDao->updateToken($email, $token);

                    header("Location: " . $this->base . "/index.php");
                    exit;
                } else {
                    $_SESSION['alert'] = 'Senha incorreta, tente novamente!';
                    header("Location: " . $this->base . "/signin.php");
                    exit;
                }

            } else {
                $_SESSION['alert'] = 'Email não cadastrado! Para se cadastrar preencha os campos abaixo!';
                $_SESSION['email'] = $email;
                header("Location: " . $this->base . "/signup.php");
                exit;
            }
        }
    }
}
