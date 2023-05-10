<?php

require_once("models/User.php");
require_once("models/Message.php");
require_once("dao/UserDao.php");
require_once("globals.php");
require_once("bd.php");

$message = new Message($BASE_URL);
$userDao = new UserDao($conn, $BASE_URL);

// $file = $_FILES["arquivo"];
// var_dump($file);

if(!empty($_FILES["arquivo"]["tmp_name"])){

    $document = new DomDocument();
    $document->load($_FILES["arquivo"]["tmp_name"]);



    
    $linhas = $document->getElementsByTagName("alocar");
   //  var_dump($linhas);

    

    foreach($linhas as $linha){

            
         if(is_object($linha->getElementsByTagName("empresa")->item(0))){
            $empresa = $linha->getElementsByTagName("empresa")->item(0)->nodeValue;
         }
         if(is_object($linha->getElementsByTagName("alocacao")->item(0))){
            $alocacao = $linha->getElementsByTagName("alocacao")->item(0)->nodeValue; 
         }
         if(is_object($linha->getElementsByTagName("hora")->item(0))){
            $hora = $linha->getElementsByTagName("hora")->item(0)->nodeValue;   
         }

         if(is_object($linha->getElementsByTagName("minutos")->item(0))){
            $minutos = $linha->getElementsByTagName("minutos")->item(0)->nodeValue;   
         }
         if(is_object($linha->getElementsByTagName("departamento")->item(0))){
            $departamento = $linha->getElementsByTagName("departamento")->item(0)->nodeValue;  
         }

         if(is_object($linha->getElementsByTagName("mes")->item(0))){
            $mes = $linha->getElementsByTagName("mes")->item(0)->nodeValue;  
         }
         if(is_object($linha->getElementsByTagName("dia")->item(0))){
            $dia = $linha->getElementsByTagName("dia")->item(0)->nodeValue;  
         }

         

      
         $formatarHora = $hora.":".$minutos.":"."00";

           //Inserir informação no BD direto do excel
          $query = "INSERT INTO dados (empresa,alocacao,hora,departamento,mes,dia) VALUES('$empresa','$alocacao','$formatarHora','$departamento','$mes','$dia')";
           $smtp = $conn->prepare($query);
           $smtp->execute();


         

    }


      $message->setMessage("dados adicionados com sucesso", "sucess", "horaPessoa.php");

}else{
    $message->setMessage("Nenhum arquivo foi selecionado", "error", "painel.php");
}


?>

