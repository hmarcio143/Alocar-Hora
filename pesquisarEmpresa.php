<?php
require_once("templetes/header.php");

$dado = $_GET["name_empresa"];


$listaEmpresa = [];
$query = "SELECT id,nome FROM empresa WHERE nome LIKE '%$dado%'";
$SMTP = $conn->prepare($query);
$SMTP->execute();
$listaEmpresa = $SMTP->fetchAll();


?>
<?php if($user->getProfile($userData) == 1):?>
<main class="main-container">


<div>
<h2>Resultados da busca por: <?=$dado?></h2>

        <div class="div-input">

        <form method="get" action="pesquisarEmpresa.php">
            <label>Pesquisa Empresa</labe>
            <input type="text" name="name_empresa" placeholder="Digite o nome da empresa" required>
            <input type="submit" value="Pesquisar Empresa">
        </form>
</div>
        <div class="table-view">
            <table>
                <thead>
                    <tr class="head-table">
                        <th>Empresa</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>

                <?php foreach($listaEmpresa as $empresa):?>
                    <tr>
                        <td><?=$empresa['nome']?></td>
                        <td>
                            
                            <a class="link-table" href="<?=$BASE_URL?>editaEmpresa.php?id=<?=$empresa['id']?>">Editar Empresa</a>
                            <a class="link-table" href="<?=$BASE_URL?>deleteEmpresa.php?id=<?=$empresa['id']?>">Deletar Empresa</a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>



</main>

<?php else:?>
        <?php $message->setMessage("Você não tem permissão para acessar essa pagina!!","erro" ,"painel.php");?>
        

<?php require_once("templetes/footer.php") ?>
<?php endif; ?>
