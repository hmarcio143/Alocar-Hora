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

 $usuarioId = $user->getIdUser($userData);


      $listaEmpresasAtribuidas = [];
      $query = "SELECT empresa_id FROM atribuicao WHERE usuario_id = '$usuarioId' ";
      $SMTP = $conn->prepare($query);
      $SMTP->execute();
      $listaEmpresasAtribuidas = $SMTP->fetchAll();


      $listaStatus = [];
      $query = "SELECT * FROM status";
      $SMTP = $conn->prepare($query);
      $SMTP->execute();
      $listaStatus  = $SMTP->fetchAll();

?>

<?php if($user->getDepartamento($userData) === "Contabilidade" || $user->getProfile($userData) == 1):?>


<main class="main-container">
   
      
      <form method="post" action="controle_process.php">
         <input type="hidden" name = "type" value="alocar">

          <div class="div-input">
            <h4>Empresa</h4>
            <select name="empresa" required="required">
            <option value="">Selecione a empresa</option>  
            <?php foreach($listaEmpresasAtribuidas as $empresa):?>
               <?php $nomeEmpresa = [];
               $query = "SELECT nome FROM empresa WHERE id = '$empresa[0]'";
               $smtp = $conn->prepare($query);
               $smtp->execute();
               $nomeEmpresa = $smtp->fetchAll();
            ?>

                <option value="<?= $nomeEmpresa[0][0]?>"><?= $nomeEmpresa[0][0]?></option> 
            <?php endforeach ?>
         </div> 
       
         
         <div class="div-input">
            </select>
            <h4>Responsavel</h4>
            <input type="text" name="locador" value="<?=$user->getFullName($userData)?>" Readonly>
            </div>
            

            
         <div class="div-input">
         <h4>Status</h4>
         <select name="status" required="required">
         <option value="">Selecione o status </option> 
            <?php foreach($listaStatus as $status):?>
               <option value="<?=$status["tipo"]?>"><?=$status["tipo"]?></option>
            <?php endforeach ?>
         </select>
         </div>

         <div class="div-input">
         <h4>Mês</h4>
         <select name="mes" required="required">
         <option value="">Selecione o Mês</option>
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

         <div class="div-input">
            <h4>Comentario</h4>
                <textarea class="comentario" rows="5" cols="33" >Escreva um comentário sobre a mudança de status ...</textarea>
            </div>

         <div class="div-input">
         <input type="submit" value="Atualizar controle">
            </div>
      </form>
      </div>



</main>
<?php else:?>
        <?php $message->setMessage("Acesso somente ao departamento contabil!!","erro" ,"painel.php");?>
        
<?php require_once("templetes/footer.php") ?>
<?php endif; ?>