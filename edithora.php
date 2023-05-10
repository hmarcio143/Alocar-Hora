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

$idHora = $_GET;



$lancamento = [];
$queryuser = "SELECT * from dados WHERE id='$idHora[id]'";
$smtp = $conn->prepare($queryuser);
$smtp->execute();
$lancamento = $smtp->fetch();


$listaEmpresas = [];
      $query = "SELECT * FROM empresa ORDER BY nome";
      $SMTP = $conn->prepare($query);
      $SMTP->execute();
      $listaEmpresas = $SMTP->fetchAll();


      //Buscar os usuarios cadastrados no sistema
$buscarUsuarios = [];
$query = "SELECT CONCAT(name,' ' ,lastname) FROM usuario";
$smtp = $conn->prepare($query);
$smtp->execute();
$buscarUsuarios = $smtp->fetchAll();


?>

<?php if($user->getProfile($userData) == 1):?>

    <div class="main-container">
        <h2>O que foi lançado</h2>

    <div class="table-view">
      <table>
<thead>
<tr class="head-table">
  <th>Empresa</th>
  <th>Colaborador</th>
  <th>Hora</th>
  <th>Departamento</th>
  <th>Dia</th>
  <th>Mês</th>
  
</tr>
</thead>
<tbody>

  
 
 
  <tr>     
      <td><?=$lancamento['empresa']?></td>
      <td><?=$lancamento['alocacao']?></td>
      <td><?=$lancamento['hora']?></td>
      <td><?=$lancamento['departamento']?></td>
      <td><?=$lancamento['dia']?></td>
      <td><?=$lancamento['mes']?></td>
      
      

  </tr>

</tbody>

</table>
</div>
</div>

<main class="main-container">
        
            <form method="post" action="processo_dados.php">

                <input type="hidden" name="type" value="update">
                <input type="hidden" name="id" value="<?=$lancamento['id']?>">
                <h3>Empresa</h3>
                <div class="div-input">
                    
                <select name="empresa">
                <?php foreach($listaEmpresas as $empresa):?>
                <option value="<?=$empresa["nome"]?>"><?=$empresa["nome"]?></option>
                <?php endforeach ?>
                </select>
                </div>
                <h3>Colaborador</h3>
                <div class="div-input">
                
                    <select name="nome">
                        <?php foreach($buscarUsuarios as $user):?>
                            <option value="<?=$user[0] ?>"><?=$user[0] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <h3>Hora</h3>
                <div class="div-input">
                    <input type="text" name="hora"  value="<?= $lancamento['hora']?>" >
                        </div>
                        <h3>Departamento</h3>
                <div class="div-input">
                        <select name="departamento">
                            <option>Contabilidade</option>
                            <option>Fiscal</option>
                            <option>Departamento Pessoal</option>
                            <option>Serviço Extra</option>
                            <option>BPO Financeiro</option>
                        </select>
                    </div>
                    <h3>Dia e Mês</h3>
                <div class="div-input">
                    <input type="number" name="dia"  value="<?= $lancamento['dia']?>" >
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
                        </div>
                <div class="div-input">
                <input type="submit" value="Editar usuario">
                        </div>
                
            </form>

          
            <div class="div-userDelete">
            <a class="link-table" href="<?=$BASE_URL?>deleteLancamento.php?id=<?=$idHora['id']?>">Deletar Lançamento</a>
            </div>
        </div>
    </main>

    <?php else:?>
    <?php $message->setMessage("Você não tem permissão para acessar essa pagina!!","erro" ,"painel.php");?>
    

<?php require_once("templetes/footer.php") ?>
<?php endif; ?>