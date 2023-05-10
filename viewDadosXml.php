<?php
require_once("templetes/header.php"); 
require_once("models/User.php");
require_once("models/Message.php");
require_once("dao/UserDao.php");
require_once("globals.php");
require_once("bd.php");

$message = new Message($BASE_URL);
$userDao = new UserDao($conn, $BASE_URL);

 $file = $_FILES["arquivo"];
// var_dump($file);

if(!empty($_FILES["arquivo"]["tmp_name"])){

    $document = new DomDocument();
    $document->load($_FILES["arquivo"]["tmp_name"]);

    
    $linhas = $document->getElementsByTagName("alocar");


}else{
    $message->setMessage("Nenhum arquivo foi selecionado", "error", "painel.php");
}


?>

<!-- Exibir para o usuario os seus lançamentos -->

<main class="main-container">
    <h2>As Horas lançadas Estão corretas?</h2>

    <div class="table-view">
        <table>
            <thead>
                <tr class="head-table">
                    <th>Empresa</th>
                    <th>Horas</th>
                    <th>Minutos</th>
                    <th>Departamento</th>
                    <th>Dia</th>
                    <th>Mês</th>
                    <th>Colaborador</th>
                </tr>
            </thead>
            <tbody>
            
            <?php
                $empresaAdd = []; 
                $horaAdd = []; 
                $minutosAdd = []; 
                $departamentoAdd = [];
                $diaAdd = [];
                $mesAdd = [];
                $alocacaoAdd = [];
            ?>

                <?php foreach($linhas as $linha):?>
                    <?php array_push($empresaAdd, $linha->getElementsByTagName("empresa")->item(0)->nodeValue)?>
                    <?php array_push($horaAdd, $linha->getElementsByTagName("hora")->item(0)->nodeValue)?>
                    <?php array_push($minutosAdd, $linha->getElementsByTagName("minutos")->item(0)->nodeValue)?>
                    <?php array_push($departamentoAdd, $linha->getElementsByTagName("departamento")->item(0)->nodeValue)?>
                    <?php array_push($diaAdd , $linha->getElementsByTagName("dia")->item(0)->nodeValue)?>
                    <?php array_push($mesAdd, $linha->getElementsByTagName("mes")->item(0)->nodeValue)?>
                    <?php array_push($alocacaoAdd, $linha->getElementsByTagName("alocacao")->item(0)->nodeValue)?>
                    
                    <tr>
                        <td><?= $linha->getElementsByTagName("empresa")->item(0)->nodeValue;?></td>
                        <td><?= $linha->getElementsByTagName("hora")->item(0)->nodeValue;?></td>
                        <td><?= $linha->getElementsByTagName("minutos")->item(0)->nodeValue;?></td>
                        <td><?= $linha->getElementsByTagName("departamento")->item(0)->nodeValue;?></td>
                        <td><?= $linha->getElementsByTagName("dia")->item(0)->nodeValue;?></td>
                        <td><?= $linha->getElementsByTagName("mes")->item(0)->nodeValue;?></td>
                        <td><?= $linha->getElementsByTagName("alocacao")->item(0)->nodeValue;?></td>  
                    </tr>
                    
                <?php endforeach;?>
            
                
                
            </tbody>
        </table>
    </div>

<?php 
$array = array(

    array("empresas", $empresaAdd),
    array("horas", $horaAdd),
    array("minutos", $minutosAdd),
    array("departamento", $departamentoAdd),
    array("dia", $diaAdd),
    array("mes", $mesAdd),
    array("alocacao", $alocacaoAdd),

);

?>

<div class="div-import">
        <h3>Importe os dados</h3>
        <div class="div-input">
            <form method="post" action="upexcel.php" enctype="multipart/form-data">
               <label>Escolha o mesmo arquivo para exportar</label>
               <input type="file" name="arquivo">
               <input type="submit" value="Enviar">
            </form>
</div>
</div>
</main>


