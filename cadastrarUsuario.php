<?php

require_once("templetes/header.php"); 
require_once("models/User.php"); 
require_once("dao/userDao.php"); 

 $user = new User();
 $message = new Message($BASE_URL);
 $userDao = new UserDao($conn, $BASE_URL);
$userData = $userDao->verifyToken(true);

///Buscar usuarios no banco de dados
    $listaUsuarios = [];
    $query = "SELECT * FROM usuario";
    $SMTP = $conn->prepare($query);
    $SMTP->execute();
    $listaUsuarios = $SMTP->fetchAll();
?>

<?php if($user->getProfile($userData) == 1):?>

    <main class="main-container">
        <h1>Cadastre usuario</h1>
        <div class="form">
            <form method="post" action="login_process.php">
                <input type="hidden" name="type" value="registro">
                <div class="div-input">
                    <input type="text" name="name" placeholder="Digite o nome do usuario" required>
                </div>
                <div class="div-input">
                    <input type="text" name="lastname" placeholder="Digite o sobrenome do usuario" required>
                </div>
                <div class="div-input">
                    <input type="email" name="email" placeholder="Digite seu E-mail" required>
                </div>
                <div class="div-input">
                    <input type="password" name="password" placeholder="digite a senha do usuario" required>
                </div>
                <div class="div-input">
                    <input type="password" name="confirmPassword" placeholder="Confirme a senha do usuario" required>
                </div>
                <div class="div-input">
                    <select name="departamento">
                        <option value="Contabilidade">Contabilidade</option>
                        <option value="Fiscal">Fiscal</option>
                        <option value="Financeiro">Financeiro</option>
                        <option value="Departamento Pessoal">Departamento Pessoal</option>
                        <option value="Legalização">Legalização</option>
                    </select>
                </div>
                <div class="div-input">
                    <select name="profile">
                        <option value="2">Padrão - usuario</opition>
                        <option value="1">Adiministrador</opition>
                        <option value="3">Departamento pessoal</opition>
                    </select>
                </div>
                <div class="div-input">
                    <input type="submit" value="Cadastrar">
                </div>
            </form>
        </div>

        <!-- Barra de pesquisa de usuario -->
        <div>
            <h2>Pesquisar Usuario</h2>

            <div class="div-input">

            <form method="get" action="pesquisarUsuario.php">
                <label>Pesquisa Usuario</labe>
                <input type="text" name="name_usuario" placeholder="Digite o nome da empresa" required>
                <input type="submit" value="Pesquisar Usuario">
            </form>
        </div>

        <div>
        <h2>Usuarios Cadastrados</h2>
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

                <?php foreach($listaUsuarios as $usuario):?>
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
                            <a class="link-table" href="<?=$BASE_URL?>atribuirEmpresa.php?id=<?=$usuario['id']?>">Atribuir Empresas</a>
                            
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




