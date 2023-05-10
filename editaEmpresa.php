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
        
            <form method="post" action="processo_dados.php">

                <input type="hidden" name="type" value="updateEmpresa">
                <input type="hidden" name="id" value="<?=$empresa['id']?>">
                <input type="hidden" name="nomeAntigo" value="<?=$empresa['nome']?>">
                <h3>Empresa</h3>
                <div class="div-input">
                    <input type="text" name="empresa" value="<?=$empresa['nome']?>">
                    <input type="submit" value="Editar Empresa">
                </div>
                
            </form>

          
           
        </div>
</main>

    <?php else:?>
    <?php $message->setMessage("Você não tem permissão para acessar essa pagina!!","erro" ,"painel.php");?>
    

<?php require_once("templetes/footer.php") ?>
<?php endif; ?>