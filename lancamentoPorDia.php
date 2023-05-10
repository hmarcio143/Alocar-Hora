<?php

require_once("templetes/header.php"); 
require_once("globals.php");
require_once("./bd.php");
require_once("models/Message.php");
require_once("models/User.php"); 
require_once("dao/UserDao.php");
$dado = $_GET;
$userDao = new UserDao($conn, $BASE_URL);
$userData = $userDao->verifyToken(true);

$message = new Message($BASE_URL);
$user = new User();
$usuario = $user->getFullName($userData);

    $empresa = filter_input(INPUT_GET, "empresa");
    $mes = filter_input(INPUT_GET, "mes");
    $dia = filter_input(INPUT_GET, "dia");


    $buscaPorDia = [];
    $query = "SELECT * from dados WHERE empresa = '$empresa' AND mes = '$mes' AND dia = '$dia' ORDER BY dia";
    $smtp = $conn->prepare($query);
    $smtp->execute();
    $buscaPorDia = $smtp->fetchAll();


?>


<?php if($user->getProfile($userData) == 1):?>

<main class="main-container">
<h2>Horas lançadas na empresa <?= $dado['empresa']?> no mês de <?= $dado['mes']?> no dia <?= $dado['dia']?> </h2>

<!-- Tabela detalha hora do mês -->
<div class="table-view">
<table>
<thead>
<tr class="head-table">
    <th>Empresa</th>
    <th>Dia</th>
    <th>Mês</th>
    <th>Horas</th>
    <th>Colaborador</th>
</tr>
</thead>
<tbody>

    <?php foreach($buscaPorDia as $dia): ?>
    <tr>     
        <td><?= $dia['empresa']?></td>
        <td><?= $dia['dia']?></td>
        <td><?= $dia['mes']?></td>
        <td><?= $dia['hora']?></td>
        <td><?= $dia['alocacao']?></td>
    </tr>

    <?php endforeach; ?>

</tbody>

</table>

</div>


<?php else:?>
        <?php $message->setMessage("Você não tem permissão para acessar essa pagina!!","erro" ,"painel.php");?>
        

<?php require_once("templetes/footer.php") ?>
<?php endif; ?>