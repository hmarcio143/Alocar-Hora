<?php
require_once("templetes/header.php");

$dado = $_GET["name_usuario"];


$listaUsuario = [];
$query = "SELECT id,name,lastname,email,profile,departamento FROM usuario WHERE name LIKE '%$dado%'";
$SMTP = $conn->prepare($query);
$SMTP->execute();
$listaUsuario = $SMTP->fetchAll();


?>
<?php if($user->getProfile($userData) == 1):?>
<main class="main-container">

 <!-- Barra de pesquisa de usuario -->
 <div>
            <h2>Resultados da busca por: <?=$dado?></h2>

            <div class="div-input">

            <form method="get" action="pesquisarUsuario.php">
                <label>Pesquisa Usuario</labe>
                <input type="text" name="name_usuario" placeholder="Digite o nome da empresa" required>
                <input type="submit" value="Pesquisar Usuario">
            </form>
        </div>
<div class="table-view">
            <table>
                <thead>
                    <tr class="head-table">
                        <th>Colaborador</th>
                        <th>E-mail</th>
                        <th>Departamento</th>
                        <th>Perfil</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>

                <?php foreach($listaUsuario as $usuario):?>
                    <tr>
                        <td><?=$usuario['name']?> <?=$usuario['lastname']?></td>
                        <td><?=$usuario['email']?></td>
                        <td><?=$usuario['departamento']?></td>
                       
                            <?php if($usuario["profile"] == 1): ?>
                                <td>Administrador</td>  
                            <?php elseif($usuario["profile"] == 3): ?>
                                <td>Funcionario DP</td> 
                            <?php else:?>
                                <td>Usuario Padrão</td> 
                            <?php endif;?>

                        
                         <td>

                            <a class="link-table" href="<?=$BASE_URL?>editUser.php?id=<?=$usuario['id']?>">Editar Usuario</a>
                            
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
