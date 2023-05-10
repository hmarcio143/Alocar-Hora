<?php

require_once("models/User.php");
require_once("models/Message.php");
require_once("dao/UserDao.php");
require_once("globals.php");
require_once("bd.php");

$message = new Message($BASE_URL);
$userDao = new UserDao($conn, $BASE_URL);

//tabela atribuição
$empresaAll = [];
$query = "SELECT empresa_id FROM atribuicao";
$smtp = $conn->prepare($query);
$smtp->execute();
$empresaAll = $smtp->fetchAll();

// print_r($empresaAll);exit;


///Resgatar o type do formulario
$type = filter_input(INPUT_POST,"type");


if($type == "atribuir"){

    $idUser = filter_input(INPUT_POST,"IdUser");
    $empresaId = filter_input(INPUT_POST,"empresa");

    //Verificar se o usuario já tem essa empresa atribuida
    // $empresaAll = [];
    // $query = "SELECT COUNT(empresa_id) FROM atribuicao WHERE id = '$empresaId'";
    // $smtp = $conn->prepare($query);
    // $smtp->execute();
    // $empresaAll = $smtp->fetch();
    // $empresaQtd = intval($empresaAll[0]);

    // echo COUNT($empresaQtd);exit;

    // if($empresaQtd > 0){
        // $message->setMessage("Empresa já está Atribuida ao usuario", "error", "CadastrarUsuario.php");

    // }else{
        //Atribuir a empresa ao usuario
    $query = "INSERT INTO atribuicao (usuario_id, empresa_id) VALUES( '$idUser','$empresaId')";
    $smtp = $conn->prepare($query);
    $smtp->execute();
    $message->setMessage("Empresa Atribuida ao usuario", "sucess", "CadastrarUsuario.php");

    // }



    
    

}else if($type == "deleteAtribuicao"){

    //Receber os dados
    $idAtribuicao = filter_input(INPUT_POST, "id");

   
    $queryLancamento = "DELETE FROM atribuicao WHERE id = '$idAtribuicao'";
    $smtp = $conn->prepare($queryLancamento);
    $smtp->execute();
    $message->setMessage("Atribuição deletada com sucesso", "sucess", "CadastrarUsuario.php");
}

?>