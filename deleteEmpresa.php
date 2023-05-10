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

$idHora = $_GET;



$empresa = [];
$queryuser = "SELECT * from empresa WHERE id='$idHora[id]'";
$smtp = $conn->prepare($queryuser);
$smtp->execute();
$empresa = $smtp->fetch();

?>

<?php if($user->getProfile($userData) == 1):?>

<main class="main-container">
            <div><h2>Tem certeza que deseja excluir essa empresa?</h2></div>
        
            <div class="div-input">
            <form method="post" action="processo_dados.php">
                <input type="hidden" name="type" value="deleteEmpresa">
                <input type="hidden" name="id" value="<?= $empresa["id"]?>">
                <input type="text"  value="<?=$empresa['nome']?>" readonly>
                <input class="btn-alocar" type="submit" value="Deletar Empresa">
            </form> 
            </div>
    </main>

    <?php else:?>
    <?php $message->setMessage("Você não tem permissão para acessar essa pagina!!","erro" ,"painel.php");?>
    

<?php require_once("templetes/footer.php") ?>
<?php endif; ?>