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
        header("Location: " . $this->base . "/login.php");
        exit;
    }

    public function validate_login($email, $password)
    {
        if (!empty($email) && !empty($password)) {
            $userDao = new UserDaoMysql($this->connection);
            $loggingUser = $userDao->findByEmail($email);
            if ($loggingUser != false) {

                //verificar senhas
                if (password_verify($password, $loggingUser->getPassword())) {
                    //gerar token
                    $token = md5(time() . rand(1111, 9999) . time());
                    $_SESSION['token'] = $token;

                    //gravar token
                    $userDao->updateToken($email, $token);

                    $_SESSION['success'] = 'Login efetuado com sucesso!';
                    header("Location: " . $this->base . "/index.php");
                    exit;
                } else {
                    $_SESSION['alert'] = 'Senha incorreta, tente novamente!';
                    header("Location: " . $this->base . "/login.php");
                    exit;
                }
            } else {
                $_SESSION['alert'] = 'Email não cadastrado! Entre em contato com o administrador do sistema!';
                $_SESSION['email'] = $email;
                header("Location: " . $this->base . "/login.php");
                exit;
            }
        }
    }

    public function registerUser(User $user)
    {
        $newUserDao = new UserDaoMysql($this->connection);
        
        // verificar se e-mail já existe
        if ($newUserDao->findByEmail($user->getEmail()) != false) {
            $_SESSION['alert'] = "E-mail já cadastrado no banco! informe outro e-mail";
            header("location: " . $this->base . "/users_cad.php");
            exit;
        }

        // tratar a senha envidada pelo usuário
        $hash = password_hash($user->getPassword(), PASSWORD_DEFAULT);
        $token = md5(time() . rand(0, 9999));

        $user->setPassword($hash);
        $user->setToken($token);

        $newUserDao->addUser($user);
    }
}
