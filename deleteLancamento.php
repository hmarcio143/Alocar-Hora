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


$deleteLancamento = [];
$queryuser = "SELECT * from dados WHERE id='$idUser'";
$usuarios = $conn->prepare($queryuser);
$usuarios->execute();
$deleteLancamento = $usuarios->fetch();


?>
<?php if($user->getProfile($userData) == 1):?>

<main class="main-container">
        <h1>Tem certeza que deseja deletar esse usuario?</h1>
        <div class="form">
            <form method="post" action="processo_dados.php">
                <input type="hidden" name="type" value="deleteLancamento">
                <input type="hidden" name="id" value="<?=$deleteLancamento['id']?>">
                <div class="div-input">
                <input type="text" name="empresa" value="<?= $deleteLancamento['empresa']?>" disabled="">
                </div>
                <div class="div-input">
                <input type="text" name="alocacao" value="<?= $deleteLancamento['alocacao']?>" disabled="">
                </div>
                <div class="div-input">
                <input type="email" name="hora"  value="<?= $deleteLancamento['hora']?>" disabled="">
                </div>

                <div class="div-input">
                <input type="email" name="departamento"  value="<?= $deleteLancamento['departamento']?>" disabled="">
                </div>

                <div class="div-input">
                <input type="email" name="dia"  value="<?= $deleteLancamento['dia']?>" disabled="">
                </div>

                <div class="div-input">
                <input type="email" name="mes"  value="<?= $deleteLancamento['mes']?>" disabled="">
                </div>
                <div class="div-input">
                <input type="submit" value="Deletar Lançamento">
                </div>
            </form>
        </div>
    </main>


    <?php else:?>
        <?php $message->setMessage("Você não tem permissão para acessar essa pagina!!","erro" ,"painel.php");?>
        

<?php require_once("templetes/footer.php") ?>
<?php endif; ?>