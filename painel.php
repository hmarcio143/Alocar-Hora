<?php
 require_once("templetes/header.php"); 
 require_once("models/User.php"); 
 require_once("dao/userDao.php"); 
 require_once("bd.php");


      $listaEmpresas = [];
      $query = "SELECT * FROM empresa ORDER BY nome";
      $SMTP = $conn->prepare($query);
      $SMTP->execute();
      $listaEmpresas = $SMTP->fetchAll();

?>


<main class="main-container">
   
      
      <form method="post" action="processo_dados.php">
         <input type="hidden" name = "type" value="alocar">

         <div class="div-input">
            <h4>Empresa</h4>
            <select name="empresa" required="required">
            <option value="">Selecione a empresa</option>  
            <?php foreach($listaEmpresas as $empresa):?>
               <option value="<?=$empresa["nome"]?>"><?=$empresa["nome"]?></option>
            <?php endforeach ?>
         </div>
       
         
         <div class="div-input">
            </select>
            <h4>Colaborador</h4>
            <input type="text" name="locador" value="<?=$user->getFullName($userData)?>" Readonly>
            </div>
            
        <div class="div-input">
        <h4>Horas trabalhadas</h4>
          <input type="number"  name="hora" placeholder="Digite as horas" required>
          <input type="number"  name="minuto" placeholder="Digite os minutos" required>
         </div>

            
         <div class="div-input">
         <h4>Departamento</h4>
         <select name="departamento" required="required">
         <option value="">Selecione o Departamento</option>
            <option>Contabilidade</option>
            <option>Fiscal</option>
            <option>Departamento Pessoal</option>
            <option>Serviço Extra</option>
            <option>BPO Financeiro</option>
            
         </select>
         </div>

         <div class="div-input">
         <h4>Dia e mês trabalhado</h4>
         <select name="dia" required="required">
         <option value="">Selecione o Dia</option>
            <?php for($dia = 1; $dia <= 31; $dia++):?>
                     <option value="<?= $dia ?>" ><?=$dia?></option>
            <?php endfor;?>
         </select>
   
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
            <input type="submit" value="Adicionar">
         </div>
      </form>
      </div>



   <div class="div-input">
            <form method="post" action="viewDadosXml.php" enctype="multipart/form-data">
               <label>Importar excel</label>
               <input type="file" name="arquivo">
               <input type="submit" value="Vizualisar Dados Antes de Lançar">
            </form>
   </div>
</main>
