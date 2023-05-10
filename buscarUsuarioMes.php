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
    //Pegar por mês
    $buscaMes = [];
    $query = "SELECT * FROM dados WHERE alocacao = '$dado[usuario]' AND mes = '$dado[mes]' ORDER BY dia";
    $smtp = $conn->prepare($query);
    $smtp->execute();
    $buscaMes = $smtp->fetchAll();

    //Pegar os dias do mês
    $buscarDia = [];
    $queryDia = "SELECT DISTINCT dia FROM dados WHERE mes = '$dado[mes]'  AND alocacao ='$dado[usuario]' ORDER BY dia";
    $smtp = $conn->prepare($queryDia);
    $smtp->execute();
    $buscarDia = $smtp->fetchAll();

    //Pegar por empresa
    $buscarEmpresa = [];
    $queryEmpresa = "SELECT DISTINCT empresa FROM dados WHERE mes = '$dado[mes]'  AND alocacao ='$dado[usuario]' ORDER BY empresa";
    $smtp = $conn->prepare($queryEmpresa);
    $smtp->execute();
    $buscarEmpresa = $smtp->fetchAll();

    

//Buscar os usuarios cadastrados no sistema
$buscarUsuarios = [];
$query = "SELECT CONCAT(name,' ' ,lastname) FROM usuario";
$smtp = $conn->prepare($query);
$smtp->execute();
$buscarUsuarios = $smtp->fetchAll();

?>

<?php if($user->getProfile($userData) == 1):?>

<main class="main-container">

<h2>Buscar dados por usuario</h2>

<div class="select_head">
        <form method="get">
            <label>Buscar por usuario</label>
            <input type="hidden" name="mes" value="<?= $dado ['mes'] ?>">
            <select name="usuario">
                <?php foreach($buscarUsuarios as $user):?>
                   <option><?=$user[0] ?></option>
                <?php endforeach ?>
            </select>
            <input type="submit" value="Pesquisar">
        </form>

</div>
</div>

<div>
    
<h2>Tabela detalhada do mês de <?= $dado ['mes'] ?> de <?=$dado['usuario']?></h2>
</div>

<!-- Tabela detalha hora do mês -->
<div class="table-view">
<table>
<thead>
<tr class="head-table">
    <th>Empresa</th>
    <th>Dia</th>
    <th>Mês</th>
    <th>Horas</th>
</tr>
</thead>
<tbody>

    <?php foreach($buscaMes as $mes): ?>
    <tr>     
        <td><?= $mes['empresa']?></td>
        <td><?= $mes['dia']?></td>
        <td><?= $mes['mes']?></td>
        <td><?= $mes['hora']?></td>
    </tr>

    <?php endforeach; ?>

</tbody>

</table>

</div>

<div>
    
<h2>Tabela detalhada dos dias do mês de <?= $dado ['mes']?> de <?=$dado['usuario']?></h2>
</div>


<!-- Tabela detalha hora por dia do mês -->
<div class="table-view">
<table>
<thead>
<tr class="head-table">
    <th>Dia</th>
    <th>Total de horas trabalhadas</th>
</tr>
</thead>
<tbody>

    <?php foreach($buscarDia as $dia): ?>

         <?php 
                $diaDoMes = [];
                $query1 = "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( hora ) ) ),'%H:%i')  FROM dados WHERE alocacao = '$dado[usuario]' AND mes = '$dado[mes]' AND dia = $dia[dia]";   
                $smtp = $conn->prepare($query1);
                $smtp->execute(); 
                $diaDoMes = $smtp->fetchAll();
        ?>   



    <tr>     
       
        <td><?= $dia['dia']?></td>
         <td><?= $diaDoMes[0][0]?></td>
        
    </tr>

    <?php endforeach; ?>

</tbody>

</table>

</div>




<div>
    
<h2>Tabela detalhada das horas por empresa do mês de <?= $dado ['mes'] ?> de <?=$dado['usuario']?></h2>
</div>


<!-- Tabela detalha hora por dia do mês -->
<div class="table-view">
<table>
<thead>
<tr class="head-table">
    <th>Empresa</th>
    <th>Total de horas trabalhadas</th>
</tr>
</thead>
<tbody>

    <?php foreach($buscarEmpresa  as $empresa): ?>

         <?php 
                $horaEmpresa = [];
                $query2 = "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( hora ) ) ),'%H:%i')  FROM dados WHERE alocacao = '$dado[usuario]' AND mes = '$dado[mes]' AND empresa='$empresa[empresa]';";   
                $smtp = $conn->prepare($query2);
                $smtp->execute(); 
                $horaEmpresa = $smtp->fetchAll();

               
        ?>   



    <tr>     
       
        <td><?= $empresa['empresa']?></td>
        <td><?= $horaEmpresa[0][0]?></td>  
        
    </tr>

    <?php endforeach; ?>

</tbody>

</table>

</div>

<?php else:?>
        <?php $message->setMessage("Você não tem permissão para acessar essa pagina!!","erro" ,"painel.php");?>
        

<?php require_once("templetes/footer.php") ?>
<?php endif; ?>