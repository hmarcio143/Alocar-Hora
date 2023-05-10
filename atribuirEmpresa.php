<?php
require_once("globals.php");
require_once("./bd.php");
require_once("models/Message.php");
require_once("models/User.php"); 
require_once("dao/UserDao.php");
require_once("templetes/header.php");

if(isset($_GET["id"])){

    $idUser = $_GET["id"];
}



$userDao = new UserDao($conn, $BASE_URL);
$userData = $userDao->verifyToken(true);

$message = new Message($BASE_URL);
$user = new User();


$buscarUsuario = [];
$query = "SELECT id,CONCAT(name,' ' ,lastname) FROM usuario WHERE id = '$idUser'";
$smtp = $conn->prepare($query);
$smtp->execute();
$buscarUsuario = $smtp->fetch();

$listaEmpresas = [];
      $query = "SELECT * FROM empresa ORDER BY nome";
      $SMTP = $conn->prepare($query);
      $SMTP->execute();
      $listaEmpresas = $SMTP->fetchAll();

$atribuicao = [];
$query = "SELECT empresa_id,id FROM atribuicao WHERE usuario_id = '$idUser'";
$smtp = $conn->prepare($query);
$smtp->execute();
$atribuicao = $smtp->fetchAll();



?>
<?php if($user->getProfile($userData) == 1):?>

    <main class="main-container">
        <form method="post" action="controle_process.php">
            <input type="hidden"  name="type" value="atribuir">
            <input type="hidden"  name="IdUser" value="<?=$buscarUsuario[0]?>">
        
    
            <div class="div-input">
                    <h4>Colaborador</h4>
                <input type="text" name="locador" value="<?=$buscarUsuario[1]?>" Readonly>
            </div> 

            <div class="div-input">
                    <h4>Atribuir Empresa</h4>
                    <div class="div-input">
                <select name="empresa" required="required">
                <option value="">Selecione a empresa</option>  
                <?php foreach($listaEmpresas as $empresa):?>
                <option value="<?=$empresa["id"]?>"><?=$empresa["nome"]?></option>
                <?php endforeach ?>
            </div>

            <div class="div-input">
                <input type="submit" value="Adicionar">
            </div>
        
        </form>

        <div class="table-view">
<table>
<thead>
<tr class="head-table">
    <th>Empresa Atribuidas ao usuario <?=$buscarUsuario[1]?> </th>
    <th>Ações</th>
</tr>
</thead>

    <?php foreach($atribuicao as $atribuir) :?>

        <?php $nomeEmpresa = [];
              $query = "SELECT nome FROM empresa WHERE id = '$atribuir[0]'";
              $smtp = $conn->prepare($query);
              $smtp->execute();
              $nomeEmpresa = $smtp->fetchAll();     
        ?>
    <tbody>
        <td><?= $nomeEmpresa[0][0]?></td>
        <td> <a class="link-table" href="<?=$BASE_URL?>deleteAtribuicao.php?id=<?=$atribuir['id']?>">Deletar Atribuição</a></td>
    </tbody>

    <?php endforeach?>


</table>

</div>
        

    </main>

    <?php else:?>
        <?php $message->setMessage("Você não tem permissão para acessar essa pagina!!","erro" ,"painel.php");?>
        

<?php require_once("templetes/footer.php") ?>
<?php endif; ?>