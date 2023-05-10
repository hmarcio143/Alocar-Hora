<?php

require_once("templetes/header.php") ;
require_once("templetes/header.php"); 
require_once("models/User.php"); 
require_once("dao/userDao.php"); 

 $user = new User();
 $message = new Message($BASE_URL);
 $userDao = new UserDao($conn, $BASE_URL);
$userData = $userDao->verifyToken(true);
?>

<?php if($user->getProfile($userData) == 1):?>

    <main>
        <h1>Cadastre usuario</h1>
        <div>
            <form method="post" action="login_process.php">
                <input type="hidden" name="type" value="registro">
                <input type="text" name="name" placeholder="Digite o nome do usuario" required>
                <input type="text" name="lastname" placeholder="Digite o sobrenome do usuario" required>
                <input type="email" name="email" placeholder="Digite seu E-mail" required>
                <input type="password" name="password" placeholder="digite a senha do usuario" required>
                <input type="password" name="confirmPassword" placeholder="Confirme a senha do usuario" required>
                <label>Perfil do usuario:</label>
                <select name="profile">
                    <option value="2">Padrão - usuario</opition>
                    <option value="1">Adiministrador</opition>
                </select>
                <input type="submit" value="entrar">
            </form>
        </div>

    </main>

    <?php else:?>
        <?php $message->setMessage("Você não tem permissão para acessar essa pagina!!","erro" ,"painel.php");?>
        

<?php require_once("templetes/footer.php") ?>
<?php endif; ?>