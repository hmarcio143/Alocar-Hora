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

    //Pegar pela data
    $buscarData = [];
    $query = "SELECT * FROM dados WHERE dia = '$dado[dia]' AND mes = '$dado[mes]' ORDER BY dia";
    $smtp = $conn->prepare($query);
    $smtp->execute();
    $buscarData = $smtp->fetchAll();

    





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

<div class="table-view">
<table >
<thead>
<tr class="head-table">
    <th>Empresa</th>
    <th>Alocação</th>
    <th>Hora</th>
    <th>Departamento</th>
    <th>Dia</th>
    <th>Mês</th>
    <th>Ações</th>

</tr>
</thead>
<tbody>

    <?php foreach($buscarData as $data): ?>

    <tr>     
       
        <td><?= $data['empresa']?></td>
        <td><?= $data['alocacao']?></td>
        <td><?= $data['hora']?></td>
        <td><?= $data['departamento']?></td>
        <td><?= $data['dia']?></td>
        <td><?= $data['mes']?></td>
        <td>
            <a class="link-table" href="<?=$BASE_URL?>edithora.php?id=<?=$data['id']?>">Editar Lançamento</a>
        </td>
        </td>
        
    </tr>

    <?php endforeach; ?>

</tbody>

</table>

</div>

</main>

<?php else:?>
    <?php $message->setMessage("Você não tem permissão para acessar essa pagina!!","erro" ,"painel.php");?>
    

<?php require_once("templetes/footer.php") ?>
<?php endif; ?>