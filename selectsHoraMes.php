<?php

require_once("templetes/header.php"); 
require_once("globals.php");
require_once("./bd.php");
require_once("models/Message.php");
require_once("models/User.php"); 
require_once("dao/UserDao.php");

$userDao = new UserDao($conn, $BASE_URL);
$userData = $userDao->verifyToken(true);

$message = new Message($BASE_URL);
$user = new User();
$usuario = $user->getFullName($userData);


///Select Mês janeiro
$horaMesJaneiro = [];
$query = "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( hora ) ) ),'%H:%i')  FROM dados WHERE alocacao = '$usuario' AND mes = 'Janeiro'";
$smtp = $conn->prepare($query);
$smtp->execute();
$horaMesJaneiro = $smtp->fetchAll();

///Select Mês Fevereiro
$horaMesFevereiro = [];
$query = "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( hora ) ) ),'%H:%i')  FROM dados WHERE alocacao = '$usuario' AND mes = 'Fevereiro'";
$smtp = $conn->prepare($query);
$smtp->execute();
$horaMesFevereiro = $smtp->fetchAll();

///Select Mês Março
$horaMesMarco = [];
$query = "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( hora ) ) ),'%H:%i')  FROM dados WHERE alocacao = '$usuario' AND mes = 'Março'";
$smtp = $conn->prepare($query);
$smtp->execute();
$horaMesMarco = $smtp->fetchAll();

///Select Mês Abril
$horaMesAbril = [];
$query = "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( hora ) ) ),'%H:%i')  FROM dados WHERE alocacao = '$usuario' AND mes = 'Abril'";
$smtp = $conn->prepare($query);
$smtp->execute();
$horaMesAbril = $smtp->fetchAll();

///Select Mês Maio
$horaMesMaio = [];
$query = "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( hora ) ) ),'%H:%i')  FROM dados WHERE alocacao = '$usuario' AND mes = 'Maio'";
$smtp = $conn->prepare($query);
$smtp->execute();
$horaMesMaio = $smtp->fetchAll();

///Select Mês junho
$horaMesJunho = [];
$query = "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( hora ) ) ),'%H:%i')  FROM dados WHERE alocacao = '$usuario' AND mes = 'Junho'";
$smtp = $conn->prepare($query);
$smtp->execute();
$horaMesJunho = $smtp->fetchAll();

///Select Mês julho
$horaMesJulho = [];
$query = "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( hora ) ) ),'%H:%i')  FROM dados WHERE alocacao = '$usuario' AND mes = 'Julho'";
$smtp = $conn->prepare($query);
$smtp->execute();
$horaMesJulho = $smtp->fetchAll();

///Select Mês Agosto
$horaMesAgosto = [];
$query = "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( hora ) ) ),'%H:%i')  FROM dados WHERE alocacao = '$usuario' AND mes = 'Agosto'";
$smtp = $conn->prepare($query);
$smtp->execute();
$horaMesAgosto = $smtp->fetchAll();

///Select Mês Setembro
$horaMesSetembro = [];
$query = "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( hora ) ) ),'%H:%i')  FROM dados WHERE alocacao = '$usuario' AND mes = 'Setembro'";
$smtp = $conn->prepare($query);
$smtp->execute();
$horaMesSetembro = $smtp->fetchAll();

///Select Mês Outubro
$horaMesOutubro = [];
$query = "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( hora ) ) ),'%H:%i')  FROM dados WHERE alocacao = '$usuario' AND mes = 'Outubro'";
$smtp = $conn->prepare($query);
$smtp->execute();
$horaMesOutubro = $smtp->fetchAll();

///Select Mês Novembro
$horaMesNovembro = [];
$query = "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( hora ) ) ),'%H:%i')  FROM dados WHERE alocacao = '$usuario' AND mes = 'Novembro'";
$smtp = $conn->prepare($query);
$smtp->execute();
$horaMesNovembro = $smtp->fetchAll();

///Select Mês Dezembro
$horaMesDezembro = [];
$query = "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( hora ) ) ),'%H:%i')  FROM dados WHERE alocacao = '$usuario' AND mes = 'Dezembro'";
$smtp = $conn->prepare($query);
$smtp->execute();
$horaMesDezembro = $smtp->fetchAll();




?>