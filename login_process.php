<?php

require_once("models/User.php");
require_once("models/Message.php");
require_once("dao/UserDao.php");
require_once("globals.php");
require_once("bd.php");

$message = new Message($BASE_URL);
$userDao = new UserDao($conn, $BASE_URL);


///Resgatar o type do formulario
$type = filter_input(INPUT_POST,"type");

 if($type === "registro"){

     $name = filter_input(INPUT_POST, "name");
     $lastname = filter_input(INPUT_POST, "lastname");
     $email = filter_input(INPUT_POST, "email");
     $password = filter_input(INPUT_POST, "password");
     $confirmPassword = filter_input(INPUT_POST, "confirmPassword");
    $profile = filter_input(INPUT_POST, "profile");
    $departamento = filter_input(INPUT_POST, "departamento");

     //Verificar se as senas batem

     if($password === $confirmPassword){
        //As senhas batem
        //Verificar se o Email ja existe
        if($userDao->findByEmail($email) === false){
            //Cadastrar usuario no sistema
            $user = new User();
            //criaçao do token
            $userToken = $user->generateToken();
            //Montar o objeto
            $user->name = $name;
            $user->lastname = $lastname;
            $user->email = $email;
            $user->password = $confirmPassword;
            $user->token = $userToken;
            $user->profile = $profile;
            $user->departamento = $departamento;

            $auth = true;
            $userDao->create($user,$auth);
            $message->setMessage("Cadastro Finalizado com sucesso", "sucess", "CadastrarUsuario.php");

        }else{

            $message->setMessage("O email digitado já existe", "error", "back");
        }


     }else{

        $message->setMessage("As senhas não conferem, por favor digite novamente", "error", "back");
     }
 }else if($type === "create"){
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");
    
    //tentar autentificar o usuario
    if($userDao->authenticateUser($email, $password)){

        $message->setMessage("Seja bem vindo!!","sucess" ,"painel.php");


    //Redirecionar o usuario, caso não conseguir autentificar
     }else{
        $message->setMessage("Email ou senha invalidos", "error", "back");
     }
 }else{

    $message->setMessage("informações invalidas", "error", "index.php");
 }






?>