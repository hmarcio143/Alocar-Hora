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
        <h1>Editar usuario</h1>
        <div class="form">
            <form method="post" action="processo_dados.php">
                <input type="hidden" name="type" value="updateUsuario">
                <input type="hidden" name="id" value="<?=$userAll['id']?>">
                <div class="div-input">
                <h4>Nome</h4>
                    <input type="text" name="name" value="<?= $userAll['name']?>">
                <div>
                <div class="div-input">
                <h4>Sobrenome</h4>
                    <input type="text" name="lastname" value="<?= $userAll['lastname']?>">
                <div>
                <div class="div-input">
                <h4>E-mail</h4>
                    <input type="email" name="email"  value="<?= $userAll['email']?>">
                </div>
                <div class="div-input">
                <h4>Senha</h4>
                    <input type="text" name="password"  value="<?= $userAll['password']?>" >
                </div>
                <div class="div-input">
                <h4>Confirmar Senha</h4>
                <input type="text" name="confirmPassword"  value="<?= $userAll['password']?>" >
                </div >
                <div class="div-input">
                <h4>Departamento</h4>
                    <select name="departamento">
                        <option value="Contabilidade">Contabilidade</option>
                        <option value="Fiscal">Fiscal</option>
                        <option value="Financeiro">Financeiro</option>
                        <option value="Departamento Pessoal">Departamento Pessoal</option>
                        <option value="Legalização">Legalização</option>
                    </select>
                </div>
                <div class="div-input">
                <h4>Perfil</h4>
                <select name="profile">
                    <option value="2">Padrão - usuario</opition>
                    <option value="1">Adiministrador</opition>
                    <option value="3">Funcionario DP</opition>
                </select>
                </div>
                <div class="div-input">
                    <input type="submit" value="Editar usuario">
                </div>
                
            </form>

            <div class="div-userDelete">
            <a class="link-table" href="<?=$BASE_URL?>confirmDelete.php?id=<?=$userAll['id']?>">Deletar Usuario</a>
            </div>

          
           
        </div>
    </main>

    <?php else:?>
        <?php $message->setMessage("Você não tem permissão para acessar essa pagina!!","erro" ,"painel.php");?>
        

<?php require_once("templetes/footer.php") ?>
<?php endif; ?>