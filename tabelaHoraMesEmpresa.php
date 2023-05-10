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

    //Pegar as empresas cadastradas no sistema 
    $empresasCadastradas = [];
    $query = "SELECT * FROM empresa ORDER BY nome";
    $smtp = $conn->prepare($query);
    $smtp->execute();
    $empresasCadastradas = $smtp->fetchAll();



    //Pegar a empresa e o mes
    $empresaMes = [];
    $query = "SELECT DISTINCT empresa,mes from dados WHERE empresa = '$dado[empresa]' AND mes='$dado[mes]'";
    $smtp = $conn->prepare($query);
    $smtp->execute();
    $empresaMes = $smtp->fetchAll();

    //Buscar por dia
    $buscarDia = [];
    $queryDia = "SELECT DISTINCT dia FROM dados WHERE mes = '$dado[mes]'  AND empresa ='$dado[empresa]' ORDER BY dia";
    $smtp = $conn->prepare($queryDia);
    $smtp->execute();
    $buscarDia = $smtp->fetchAll();

    //buscar por colaborador
    $buscarColaborador = [];
    $queryColaboador = "SELECT DISTINCT alocacao FROM dados WHERE mes = '$dado[mes]'  AND empresa ='$dado[empresa]'";
    $smtp = $conn->prepare($queryColaboador);
    $smtp->execute();
    $buscarColaborador  = $smtp->fetchAll();




?>




<?php if($user->getProfile($userData) == 1):?>


    <main class="main-container">

    <div class="select_head">
        <form method="get" action="tabelaHoraMesEmpresa.php">
            <label>Buscar por Mês</label>
            <select class="select-text" name="mes">
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

            <label>Buscar por Empresa</label>
            <select class="select-text" name="empresa">
                <?php foreach($empresasCadastradas as $empresas):?>
                    <option  value="<?=$empresas['nome']?>"><?= $empresas['nome']?></option>
                <?php endforeach ?>

            </select>

            <input type="submit" value="Pesquisar">
        </form>

</div>


<h2>Horas lançadas da empresa <?= $dado['empresa']?> no mês de <?= $dado['mes']?></h2>
<div class="table-view">
    

    <table>
<thead>
<tr class="head-table">
    <th>Empresa</th>
    <th>Total de horas lançadas no mês</th>
    
</tr>
</thead>
<tbody>

    <?php foreach($empresaMes as $empresa): ?>

        <?php 
                $totalHoras = [];
                $query1 = "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( hora ) ) ),'%H:%i') 
                 FROM dados WHERE empresa = '$empresa[empresa]' AND mes='$empresa[mes]'";   
                $smtp = $conn->prepare($query1);
                $smtp->execute(); 
                $totalHoras = $smtp->fetchAll();
        ?>   
    <tr>     
        <td><?= $empresa['empresa']?></td>
        <td><?= $totalHoras[0][0]?></td>

    </tr>

    <?php endforeach; ?>

</tbody>

</table>
</div>
<h2>Horas lançadas na empresa <?=$dado['empresa']?> Por dia no mês de <?= $dado['mes']?></h2>
<div class="table-view">
    


    <table>
<thead>
<tr class="head-table">
    <th>dia</th>
    <th>Total de horas lançadas no mês</th>
    <th>Ações</th>
    
</tr>
</thead>
<tbody>

    <?php foreach($buscarDia  as $dia): ?>

        <?php 
                $diaDoMes = [];
                $query1 = "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( hora ) ) ),'%H:%i')  FROM dados WHERE empresa = '$empresa[empresa]' AND mes = '$empresa[mes]' AND dia = $dia[dia]";   
                $smtp = $conn->prepare($query1);
                $smtp->execute(); 
                $diaDoMes = $smtp->fetchAll();
        ?>   
   
    <tr>     
        <td><?= $dia['dia']?></td>
        <td><?= $diaDoMes[0][0]?></td>
        <td>
            <form action="lancamentoPorDia.php">
                <input type="hidden" name="empresa" value="<?=$dado['empresa']?>">
                <input type="hidden" name="mes" value="<?=$dado['mes']?>">
                <input type="hidden" name="dia" value="<?= $dia['dia']?>">

                <input type="submit" value='Lançamentos do dia <?= $dia['dia']?>'>
            </form>
        </td>
        

    </tr>

    <?php endforeach; ?>

</tbody>

</table>
</div>
<h2>Horas lançadas no mes de <?=$dado['mes']?> na empresa <?=$dado['empresa']?> por colaborador</h2>
<div class="table-view">
      


        <table>
<thead>
<tr class="head-table">
    <th>Colaborador</th>
    <th>Total de horas lançadas no mês</th>
    
</tr>
</thead>
<tbody>

    <?php foreach($buscarColaborador as $colaborador): ?>

        <?php 
                $diaDoMes = [];
                $query1 = "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( hora ) ) ),'%H:%i') 
                 FROM dados WHERE empresa = '$empresa[empresa]' AND mes = '$empresa[mes]' AND alocacao = '$colaborador[alocacao]'";   
                $smtp = $conn->prepare($query1);
                $smtp->execute(); 
                $diaDoMes = $smtp->fetchAll();
        ?>   
   
    <tr>     
        <td><?= $colaborador['alocacao']?></td>
        <td><?= $diaDoMes[0][0]?></td>
        

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