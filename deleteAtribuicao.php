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

$idUser = $_GET;



$atribuicao = [];
$query = "SELECT * FROM atribuicao WHERE id = '$idUser[id]'";
$smtp = $conn->prepare($query);
$smtp->execute();
$atribuicao = $smtp->fetch();

$nomeEmpresa = [];
$query = "SELECT nome FROM empresa WHERE id = '$atribuicao[empresa_id]'";
$smtp = $conn->prepare($query);
$smtp->execute();
$nomeEmpresa = $smtp->fetch();   

$nomeusario = [];
$query = "SELECT CONCAT(name,' ' ,lastname) FROM usuario WHERE id = '$atribuicao[usuario_id]'";
$smtp = $conn->prepare($query);
$smtp->execute();
$nomeusario = $smtp->fetch();            
              


?>

<?php if($user->getProfile($userData) == 1):?>

<main class="main-container">
            <div><h2>Tem certeza que deseja excluir essa Atribuição?</h2></div>
        
            <div class="div-input">
            <form method="post" action="controle_process.php">
                <input type="hidden" name="type" value="deleteAtribuicao">
                <input type="hidden" name="id" value="<?= $atribuicao["id"]?>">
                <input type="text"  value="<?=$nomeusario[0]?>" readonly>
                <input type="text"  value="<?= $nomeEmpresa[0]?>" readonly>
                <input class="btn-alocar" type="submit" value="Deletar Empresa">
            </form> 
            </div>
    </main>

    <?php else:?>
    <?php $message->setMessage("Você não tem permissão para acessar essa pagina!!","erro" ,"painel.php");?>
    

<?php require_once("templetes/footer.php") ?>
<?php endif; ?>