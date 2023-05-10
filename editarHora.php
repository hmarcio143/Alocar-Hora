<?php
require_once("templetes/header.php"); 
require_once("globals.php");
require_once("./bd.php");
require_once("models/Message.php");
require_once("models/User.php"); 
require_once("dao/UserDao.php");
require_once("selectsHoraMes.php");




$userDao = new UserDao($conn, $BASE_URL);
$userData = $userDao->verifyToken(true);

$message = new Message($BASE_URL);
$user = new User();
$usuario = $user->getFullName($userData);

?>



<?php if($user->getProfile($userData) == 1):?>
    <main class="main-container">

<div>
    <form method="get" action="tabelaLancamentos.php">
     <label>Buscar por Dia</label>
        <select name="dia">
            <?php for($i= 1; $i <= 31;$i++):?>
                <option  value="<?=$i?>"><?= $i?></option>
            <?php endfor ?>

        </select>

        <label>Buscar por Mês</label>
        <select name="mes">
            <option>Janeiro</option>
            <option>Fevereiro</option>
            <option>Março</option>
            <option>Abril</option>
            <option>Maio</option>
            <option>Junho</option>
            <option>Julho</option>
            <option>Agosto</option>
            <option>Setembro</option>
            <option>Outubro</option>
            <option>Novembro</option>
            <option>Dezembro</option>
        </select>

        <input type="submit" value="Pesquisar">
    </form>

  

</div>

<main>

</main>

<?php else:?>
    <?php $message->setMessage("Você não tem permissão para acessar essa pagina!!","erro" ,"painel.php");?>
    

<?php require_once("templetes/footer.php") ?>
<?php endif; ?>
