<?php
require_once("globals.php");
require_once("./bd.php");
require_once("models/Message.php");
require_once("models/User.php"); 
require_once("dao/UserDao.php");
require_once("templetes/header.php");


$idUser = $_GET["id"];

$userDao = new UserDao($conn, $BASE_URL);
$userData = $userDao->verifyToken(true);

$message = new Message($BASE_URL);
$user = new User();


$userAll = [];
// $queryuser = "SELECT CONCAT(name,' ',lastname) from usuario";
$queryuser = "SELECT * from usuario WHERE id='$idUser'";
$usuarios = $conn->prepare($queryuser);
$usuarios->execute();
$userAll = $usuarios->fetch();

?>
<?php if($user->getProfile($userData) == 1):?>

<main class="main-container">
        <h1>Tem certeza que deseja deletar esse usuario?</h1>
        <div class="form">
            <form method="post" action="processo_dados.php">
                <input type="hidden" name="type" value="deleteUser">
                <input type="hidden" name="id" value="<?=$userAll['id']?>">
                <div class="div-input">
                <input type="text" name="name" value="<?= $userAll['name']?>" disabled="">
                </div>
                <div class="div-input">
                <input type="text" name="lastname" value="<?= $userAll['lastname']?>" disabled="">
                </div>
                <div class="div-input">
                <input type="email" name="email"  value="<?= $userAll['email']?>" disabled="">
                </div>
                <div class="div-input">
                <input type="submit" value="Deletar usuario">
                </div>
            </form>
        </div>
    </main>


    <?php else:?>
        <?php $message->setMessage("Você não tem permissão para acessar essa pagina!!","erro" ,"painel.php");?>
        

<?php require_once("templetes/footer.php") ?>
<?php endif; ?>