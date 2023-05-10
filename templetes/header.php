<?php
require_once("globals.php");
require_once("./bd.php");
require_once("models/Message.php");
require_once("models/User.php"); 
require_once("dao/UserDao.php");

$userDao = new UserDao($conn, $BASE_URL);
$userData = $userDao->verifyToken(true);

$message = new Message($BASE_URL);
$user = new User();

    $flassMensage = $message->getMessage();


     if(!empty($flassMensage["msg"])){

         $message->clearMesager();
     }

?>


<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=$BASE_URL?>css/home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <title>Alocar Horas</title>
</head>
<body>
    <div class="container-logo">Usuario: <?=$user->getFullName($userData)?> | Departamento: <?= $user->getDepartamento($userData)?></div>

    <nav class="nav-header">

        <?php if($user->getProfile($userData) == 1):?>
                        <a href="<?=$BASE_URL?>painel.php">Inicio</a>
                        <a href="<?=$BASE_URL?>CadastrarEmpresa.php">Cadastrar Empresa</a>
                        <a href="<?=$BASE_URL?>CadastrarUsuario.php">Cadastrar Usuario</a>
                        <a href="<?=$BASE_URL?>horaPessoa.php">Hora Pessoa</a>
                        <a href="<?=$BASE_URL?>horaPorEmpresa.php">Hora Empresa</a>
                        <a href="<?=$BASE_URL?>buscarUsuario.php">Ver dados usuarios</a>
                        <a href="<?=$BASE_URL?>editarHora.php">Editar Lançamentos</a>
                        <a href="<?=$BASE_URL?>controleFechamento.php">Controle Fechamento</a>
                        <a href="<?=$BASE_URL?>logof.php">Sair da conta</a>
        <?php elseif($user->getProfile($userData) == 3):?>
                        <a href="<?=$BASE_URL?>painel.php">Inicio</a>
                        <a href="<?=$BASE_URL?>horaPessoa.php">Hora Pessoa</a>
                        <a href="<?=$BASE_URL?>buscarUsuarioDp.php">Ver dados usuarios</a>
                        <a href="<?=$BASE_URL?>logof.php">Sair da conta</a>
        <?php elseif($user->getDepartamento($userData) === "Contabilidade"):?>
                        <a href="<?=$BASE_URL?>painel.php">Inicio</a>
                        <a href="<?=$BASE_URL?>horaPessoa.php">Hora Pessoa</a>
                        <a href="<?=$BASE_URL?>controleFechamento.php">Controle Fechamento</a>
                        <a href="<?=$BASE_URL?>logof.php">Sair da conta</a>
                    
                        <?php else: ?>
                        <a href="<?=$BASE_URL?>painel.php">Inicio</a>
                        <a href="<?=$BASE_URL?>horaPessoa.php">Hora Pessoa</a>
                        <a href="<?=$BASE_URL?>logof.php">Sair da conta</a>
                                
            <?php endif?>

    </nav>



<?php if(!empty($flassMensage["msg"])):?>

<div class="msg-container">
    <p class="msg-<?= $flassMensage["type"] ?>"><?= $flassMensage["msg"] ?></p>
</div>


<?php endif ?>