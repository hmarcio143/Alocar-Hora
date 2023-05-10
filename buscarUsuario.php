<?php
require_once("templetes/header.php");
require_once("globals.php");
require_once("./bd.php");
require_once("models/Message.php");
require_once("selectsHoraMes.php");
require_once("models/User.php"); 
require_once("dao/UserDao.php");

$userDao = new UserDao($conn, $BASE_URL);
$userData = $userDao->verifyToken(true);



$message = new Message($BASE_URL);
$user = new User();
$usuario = $user->getFullName($userData);

//Buscar os usuarios cadastrados no sistema
$buscarUsuarios = [];
$query = "SELECT CONCAT(name,' ' ,lastname) FROM usuario";
$smtp = $conn->prepare($query);
$smtp->execute();
$buscarUsuarios = $smtp->fetchAll();

$dado = $_GET;
    if(isset($dado['usuario'])){
    $buscaMes = [];
    $query = "SELECT * FROM dados WHERE alocacao = '$dado[usuario]'";
    $smtp = $conn->prepare($query);
    $smtp->execute();
    $buscaMes = $smtp->fetchAll();

    }

    if(isset($dado['usuario'])){
    ///Select Mês janeiro
$horaMesJaneiro = [];
$query = "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( hora ) ) ),'%H:%i')  FROM dados WHERE alocacao = '$dado[usuario]' AND mes = 'Janeiro'";
$smtp = $conn->prepare($query);
$smtp->execute();
$horaMesJaneiro = $smtp->fetchAll();

///Select Mês Fevereiro
$horaMesFevereiro = [];
$query = "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( hora ) ) ),'%H:%i')  FROM dados WHERE alocacao = '$dado[usuario]' AND mes = 'Fevereiro'";
$smtp = $conn->prepare($query);
$smtp->execute();
$horaMesFevereiro = $smtp->fetchAll();

///Select Mês Março
$horaMesMarco = [];
$query = "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( hora ) ) ),'%H:%i')  FROM dados WHERE alocacao = '$dado[usuario]' AND mes = 'Março'";
$smtp = $conn->prepare($query);
$smtp->execute();
$horaMesMarco = $smtp->fetchAll();

///Select Mês Abril
$horaMesAbril = [];
$query = "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( hora ) ) ),'%H:%i')  FROM dados WHERE alocacao = '$dado[usuario]' AND mes = 'Abril'";
$smtp = $conn->prepare($query);
$smtp->execute();
$horaMesAbril = $smtp->fetchAll();

///Select Mês Maio
$horaMesMaio = [];
$query = "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( hora ) ) ),'%H:%i')  FROM dados WHERE alocacao = '$dado[usuario]' AND mes = 'Maio'";
$smtp = $conn->prepare($query);
$smtp->execute();
$horaMesMaio = $smtp->fetchAll();

///Select Mês junho
$horaMesJunho = [];
$query = "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( hora ) ) ),'%H:%i')  FROM dados WHERE alocacao = '$dado[usuario]' AND mes = 'Junho'";
$smtp = $conn->prepare($query);
$smtp->execute();
$horaMesJunho = $smtp->fetchAll();

///Select Mês julho
$horaMesJulho = [];
$query = "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( hora ) ) ),'%H:%i')  FROM dados WHERE alocacao = '$dado[usuario]' AND mes = 'Julho'";
$smtp = $conn->prepare($query);
$smtp->execute();
$horaMesJulho = $smtp->fetchAll();

///Select Mês Agosto
$horaMesAgosto = [];
$query = "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( hora ) ) ),'%H:%i')  FROM dados WHERE alocacao = '$dado[usuario]' AND mes = 'Agosto'";
$smtp = $conn->prepare($query);
$smtp->execute();
$horaMesAgosto = $smtp->fetchAll();

///Select Mês Setembro
$horaMesSetembro = [];
$query = "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( hora ) ) ),'%H:%i')  FROM dados WHERE alocacao = '$dado[usuario]' AND mes = 'Setembro'";
$smtp = $conn->prepare($query);
$smtp->execute();
$horaMesSetembro = $smtp->fetchAll();

///Select Mês Outubro
$horaMesOutubro = [];
$query = "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( hora ) ) ),'%H:%i')  FROM dados WHERE alocacao = '$dado[usuario]' AND mes = 'Outubro'";
$smtp = $conn->prepare($query);
$smtp->execute();
$horaMesOutubro = $smtp->fetchAll();

///Select Mês Novembro
$horaMesNovembro = [];
$query = "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( hora ) ) ),'%H:%i')  FROM dados WHERE alocacao = '$dado[usuario]' AND mes = 'Novembro'";
$smtp = $conn->prepare($query);
$smtp->execute();
$horaMesNovembro = $smtp->fetchAll();

///Select Mês Dezembro
$horaMesDezembro = [];
$query = "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( hora ) ) ),'%H:%i')  FROM dados WHERE alocacao = '$dado[usuario]' AND mes = 'Dezembro'";
$smtp = $conn->prepare($query);
$smtp->execute();
$horaMesDezembro = $smtp->fetchAll();

    }


?>

<?php if($user->getProfile($userData) == 1):?>

<main class="main-container">

<h2>Buscar dados por usuario</h2>

<div class="select_head">
        <form method="get">
            <label>Buscar por usuario</label>
            <select name="usuario">
                <?php foreach($buscarUsuarios as $user):?>
                   <option><?=$user[0] ?></option>
                <?php endforeach ?>
            </select>
            <input type="submit" value="Pesquisar">
        </form>

</div>
</div>

<?php if(isset($dado['usuario'])):?>
<h2>Horas lançadas por <?= $dado['usuario']?>  </h2>

<!-- Tabelas da soma das horas meses -->
<div class="table-view">
<table >
<thead>
<tr class="head-table">
    <th>Mês</th>
    <th>Total de horas</th>   
    <th>Ações</th>
   
</tr>
</thead>
<tbody>
    <tr>
        <td>Janeiro</td>
        <td><?= $horaMesJaneiro[0][0]?></td>
        <td>
            <form action="buscarUsuarioMes.php">
                <input type="hidden" name="usuario" value="<?=$dado['usuario']?>">
                <input type="hidden" name="mes" value="Janeiro">
                <input type="submit" value='Detalhes de Janeiro'>
            </form>
        </td>
    </tr>

    <tr>
        <td>Fevereiro</td>
        <td><?= $horaMesFevereiro[0][0]?></td>
        
        <td>
            <form action="buscarUsuarioMes.php">
                <input type="hidden" name="usuario" value="<?=$dado['usuario']?>">
                <input type="hidden" name="mes" value="Fevereiro">
                <input type="submit" value='Detalhes de Fevereiro'>
            </form>
        </td>

    </tr>

    <tr>
        <td>Março</td>
        <td><?= $horaMesMarco[0][0]?></td>
        <td>
            <form action="buscarUsuarioMes.php">
                <input type="hidden" name="usuario" value="<?=$dado['usuario']?>">
                <input type="hidden" name="mes" value="Março">
                <input type="submit" value='Detalhes de Março'>
            </form>
        </td>
    </tr>

    <tr>
        <td>Abril</td>
        <td><?= $horaMesAbril[0][0]?></td>
        <td>
            <form action="buscarUsuarioMes.php">
                <input type="hidden" name="usuario" value="<?=$dado['usuario']?>">
                <input type="hidden" name="mes" value="Abril">
                <input type="submit" value='Detalhes de Abril'>
            </form>
        </td>
    </tr>

    <tr>
        <td>Maio</td>
        <td><?= $horaMesMaio[0][0]?></td>
        <td>
            <form action="buscarUsuarioMes.php">
                <input type="hidden" name="usuario" value="<?=$dado['usuario']?>">
                <input type="hidden" name="mes" value="Maio">
                <input type="submit" value='Detalhes de Maio'>
            </form>
        </td>

    </tr>

    <tr>
        <td>Junho</td>
        <td><?= $horaMesJunho[0][0]?></td>
        <td>
            <form action="buscarUsuarioMes.php">
                <input type="hidden" name="usuario" value="<?=$dado['usuario']?>">
                <input type="hidden" name="mes" value="Junho">
                <input type="submit" value='Detalhes de Junho'>
            </form>
        </td>
    </tr>

    <tr>
        <td>Julho</td>
        <td><?= $horaMesJulho[0][0]?></td>
        <td>
            <form action="buscarUsuarioMes.php">
                <input type="hidden" name="usuario" value="<?=$dado['usuario']?>">
                <input type="hidden" name="mes" value="Julho">
                <input type="submit" value='Detalhes de Julho'>
            </form>
        </td>
    </tr>

    <tr>
        <td>Agosto</td>
        <td><?= $horaMesAgosto[0][0]?></td>
        <td>
            <form action="buscarUsuarioMes.php">
                <input type="hidden" name="usuario" value="<?=$dado['usuario']?>">
                <input type="hidden" name="mes" value="Agosto">
                <input type="submit" value='Detalhes de Agosto'>
            </form>
        </td>
    </tr>

    <tr>
        <td>Setembro</td>
        <td><?= $horaMesSetembro[0][0]?></td>
         <td>
            <form action="buscarUsuarioMes.php">
                <input type="hidden" name="usuario" value="<?=$dado['usuario']?>">
                <input type="hidden" name="mes" value="Setembro">
                <input type="submit" value='Detalhes de Setembro'>
            </form>
        </td>
    </tr>

    <tr>
        <td>Outubro</td>
        <td><?= $horaMesOutubro[0][0]?></td>
        <td>
            <form action="buscarUsuarioMes.php">
                <input type="hidden" name="usuario" value="<?=$dado['usuario']?>">
                <input type="hidden" name="mes" value="outubro">
                <input type="submit" value='Detalhes de Outubro'>
            </form>
        </td>
    </tr>

    <tr>
        <td>Novembro</td>
        <td><?= $horaMesNovembro[0][0]?></td>
        <td>
            <form action="buscarUsuarioMes.php">
                <input type="hidden" name="usuario" value="<?=$dado['usuario']?>">
                <input type="hidden" name="mes" value="Novembro">
                <input type="submit" value='Detalhes de Novembro'>
            </form>
        </td>
    </tr>

    <tr>
        <td>Dezembro</td>
        <td><?= $horaMesDezembro[0][0]?></td>
        <td>
            <form action="buscarUsuarioMes.php">
                <input type="hidden" name="usuario" value="<?=$dado['usuario']?>">
                <input type="hidden" name="mes" value="Dezembro">
                <input type="submit" value='Detalhes de Dezembro'>
            </form>
        </td>
    </tr>

</tbody>

</table>
</div>
<?php endif;?>




</main>

    <?php else:?>
        <?php $message->setMessage("Você não tem permissão para acessar essa pagina!!","erro" ,"painel.php");?>


<?php require_once("templetes/footer.php") ?>
<?php endif; ?>




