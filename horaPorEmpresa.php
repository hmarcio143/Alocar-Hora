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

//Pegar as empresas cadastradas no sistema 
$empresasCadastradas = [];
$query = "SELECT * FROM empresa ORDER BY nome";
$smtp = $conn->prepare($query);
$smtp->execute();
$empresasCadastradas = $smtp->fetchAll();



?>


<?php if($user->getProfile($userData) == 1):?>

    <main class="main-container">


    <div class="btn-relatorio"><a  href="csv_bd.php">Gerar Relatorio</a></div>
    
<br>
<div class="select_head">
        <form method="get" action="tabelaHoraMesEmpresa.php">
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
            <br>
            <br>
            <label>Buscar por Empresa</label>
            <select class="select-text" name="empresa">
                <?php foreach($empresasCadastradas as $empresas):?>
                    <option  value="<?=$empresas['nome']?>"><?= $empresas['nome']?></option>
                <?php endforeach ?>

            </select>

            <input type="submit" value="Pesquisar">
        </form>

</div>

 <!-- Barra de pesquisa de empresa -->
 <div>
            <h2>Pesquisar Usuario</h2>

            <div class="div-input">

            <form method="get" action="pesquisarEmpresaHora.php">
                <label>Pesquisa Empresa</label>
                <input type="text" name="name_empresa" placeholder="Digite o nome da empresa" required>
                <input type="submit" value="Pesquisar Empresa">
            </form>
        </div>

    <h2>Horas Totais Lançadas por Empresa</h2>

<div>

<div class="table-view">
    <table>
    <thead>
    <tr class="head-table">
        <th>Empresa</th>
        <th>Total de horas lançadas</th>
        <th>Ações</th>
    </tr>
    </thead>
    <tbody>

        <?php foreach($empresasCadastradas as $empresas): ?>

            <?php 
                    $totalHoras = [];
                    $query1 = "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( hora ) ) ),'%H:%i')  FROM dados WHERE empresa = '$empresas[nome]'";   
                    $smtp = $conn->prepare($query1);
                    $smtp->execute(); 
                    $totalHoras = $smtp->fetchAll();
            ?>   
        <tr>     
            <td><?= $empresas['nome']?></td>
            <td><?= $totalHoras[0][0]?></td>
            <td>
                <form method="get" action="detalhesEmpresas.php">
                    <input type="hidden" name="empresa" value="<?= $empresas['nome']?>">
                <input type="submit" value="Detalhes">

                </form>
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
