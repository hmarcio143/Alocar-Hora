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
$dado = $_GET;

//pegar os usuarios que lançaram hora na empresa
$colaboradorEmresa = [];
$query = "SELECT DISTINCT alocacao FROM dados WHERE empresa = '$dado[empresa]'";
$smtp = $conn->prepare($query);
$smtp->execute();
$colaboradorEmresa = $smtp->fetchAll();



?>

<?php if($user->getProfile($userData) == 1):?>

<main class="main-container">
    <div><h2>Horas totais dos Calaboradores que lançaram horas na empresa <?= $dado["empresa"]?></h2></div>

    <div class="table-view">
    <table>
        <thead>
            <tr class="head-table">
                <th>Colaborador</th>
                <th>Total de Hora</th>
            </td>
        </thead>
        <tbody>
            <?php foreach($colaboradorEmresa as $colaborador):?>
                <?php 
                    $totalHorasEmpresa = [];
                    $query1 = "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( hora ) ) ),'%H:%i')  FROM dados WHERE alocacao = '$colaborador[alocacao]' AND empresa = '$dado[empresa]'";   
                    $smtp = $conn->prepare($query1);
                    $smtp->execute(); 
                    $totalHorasEmpresa = $smtp->fetchAll();

                ?> 
            <tr>
                <td><?= $colaborador['alocacao']?></td>
                <td><?=$totalHorasEmpresa[0][0]?></td>

                </form>
            </td>
            <?php endforeach?>
        </tbody>
    </table>
    </div>

    </main>

<?php else:?>
        <?php $message->setMessage("Você não tem permissão para acessar essa pagina!!","erro" ,"painel.php");?>
        

<?php require_once("templetes/footer.php") ?>
<?php endif; ?>