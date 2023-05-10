<?php
require_once("templetes/header.php"); 



$dado = $_GET["name_empresa"];

print($dado);




//Pesquisar empresas cadastradas no sistema 
$EmpresaHora = [];
$queryA = "SELECT id,nome FROM empresa WHERE nome LIKE '%$dado%' ";
$smtp = $conn->prepare($queryA);
$smtp->execute();
$EmpresaHora = $smtp->fetchAll();




?>


<?php if($user->getProfile($userData) == 1):?>

    <main class="main-container">
    

 

 <!-- Barra de pesquisa de empresa -->
 <div>
 <h2>Resultados da busca por: <?=$dado?></h2>

            <div class="div-input">

            <form method="get" action="pesquisarEmpresaHora.php">
                <label>Pesquisa Empresa</labe>
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

        <?php foreach($EmpresaHora  as $empresas): ?>

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
