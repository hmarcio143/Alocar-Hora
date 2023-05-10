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
    $query = "SELECT * FROM dados WHERE alocacao = '$usuario' AND mes = '$dado[mes]' ORDER BY dia";
    $smtp = $conn->prepare($query);
    $smtp->execute();
    $buscaMes = $smtp->fetchAll();

    //Pegar os dias do mês
    $buscarDia = [];
    $queryDia = "SELECT DISTINCT dia FROM dados WHERE mes = '$dado[mes]'  AND alocacao ='$usuario' ORDER BY dia";
    $smtp = $conn->prepare($queryDia);
    $smtp->execute();
    $buscarDia = $smtp->fetchAll();

    //Pegar por empresa
    $buscarEmpresa = [];
    $queryEmpresa = "SELECT DISTINCT empresa FROM dados WHERE mes = '$dado[mes]'  AND alocacao ='$usuario' ORDER BY empresa";
    $smtp = $conn->prepare($queryEmpresa);
    $smtp->execute();
    $buscarEmpresa = $smtp->fetchAll();

    





?>

<main class="main-container">

<div class="select_head">
        <form method="get" action="tabelaHoraMes.php">
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

<div>
    
<h2>Tabela detalhada do mês de <?= $dado ['mes'] ?></h2>
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
    
<h2>Tabela detalhada dos dias do mês de <?= $dado ['mes'] ?></h2>
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
                $query1 = "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( hora ) ) ),'%H:%i')  FROM dados WHERE alocacao = '$usuario' AND mes = '$dado[mes]' AND dia = $dia[dia]";   
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
    
<h2>Tabela detalhada das horas por empresa do mês de <?= $dado ['mes'] ?></h2>
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
                $query2 = "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( hora ) ) ),'%H:%i')  FROM dados WHERE alocacao = '$usuario' AND mes = '$dado[mes]' AND empresa='$empresa[empresa]';";   
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

</main>