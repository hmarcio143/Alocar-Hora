<?php
    require_once("templetes/header.php");


    $listaEmpresas = [];
    $query = "SELECT * FROM empresa";
    $SMTP = $conn->prepare($query);
    $SMTP->execute();
    $listaEmpresas = $SMTP->fetchAll();


    $data = $_GET;

?>




<?php if($user->getProfile($userData) == 1):?>
<main class="main-container">

<h2>Cadastrar Empresa</h2>

<div class="div-input">

        <form method="post" action="processo_dados.php">
            <label>Nome da empresa</labe>
            <input type="text" name="name_empresa" placeholder="Digite o nome da empresa" required>
            <input type="submit" value="Cadastrar Empresa">
        </form>
</div>

    <div>
        <h2>Empresas Cadastradas</h2>

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

                <?php foreach($listaEmpresas as $empresa):?>
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
