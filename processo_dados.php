<?php


require_once("models/User.php");
require_once("models/Message.php");
require_once("dao/UserDao.php");
require_once("globals.php");
require_once("bd.php");

$message = new Message($BASE_URL);
$userDao = new UserDao($conn, $BASE_URL);


///Resgatar o type do formulario
$type = filter_input(INPUT_POST,"type");

if($type == "cadastro_empresa"){

    $nomeEmpresa = filter_input(INPUT_POST, "name_empresa");
    //Verificar se tem essa empresa cadastrada
    

    $query = "INSERT INTO empresa (nome) VALUES ('$nomeEmpresa')";
    $smtp = $conn->prepare($query);
    $smtp->execute();
    $message->setMessage("Empresa cadastrada com sucesso", "sucess", "painel.php");
}else if($type == "deleteEmpresa"){

    $idEmpresa = filter_input(INPUT_POST, "id");

    $query = "DELETE FROM empresa WHERE id = '$idEmpresa'";
    $smtp = $conn->prepare($query);
    $smtp->execute();
    $message->setMessage("Empresa Deletada com sucesso", "sucess", "cadastrarEmpresa.php");
}else if($type == "deleteUsuario"){
    $idUsuario = filter_input(INPUT_POST, "id");

    $query = "DELETE FROM usuario WHERE id = '$idUsuario'";
    $smtp = $conn->prepare($query);
    $smtp->execute();
    $message->setMessage("usuario Deletada com sucesso", "sucess", "cadastrarUsuario.php");


}else if($type == "alocar"){
///Receber os dados da alocação

$empresa = filter_input(INPUT_POST, "empresa");
$locador = filter_input(INPUT_POST, "locador");
$hora = filter_input(INPUT_POST, "hora");
$minuto = filter_input(INPUT_POST, "minuto");
$departamento = filter_input(INPUT_POST, "departamento");
$dia = filter_input(INPUT_POST, "dia");
$mes = filter_input(INPUT_POST, "mes");


$horario = $hora.":".$minuto.":"."00";

//Inserir dado no sistema
$query = "INSERT INTO dados (empresa,alocacao,hora,departamento,mes,dia)VALUES('$empresa','$locador','$horario','$departamento','$mes','$dia')";
$smtp = $conn->prepare($query);
$smtp->execute();
$message->setMessage("Dados adicionados com sucesso", "sucess", "horaPessoa.php");




}else if($type === "update"){
    

    //Receber os dados
    $id = filter_input(INPUT_POST, "id");
    $empresa = filter_input(INPUT_POST, "empresa");
    $nome = filter_input(INPUT_POST, "nome");
    $hora = filter_input(INPUT_POST, "hora");
    $departamento = filter_input(INPUT_POST, "departamento");
    $dia = filter_input(INPUT_POST, "dia");
    $mes = filter_input(INPUT_POST, "mes");


        $query = "UPDATE dados SET empresa='$empresa', alocacao='$nome', hora='$hora',departamento='$departamento',dia='$dia',
        mes='$mes' WHERE id='$id'";
        $userData = $conn->prepare($query);
        $userData->execute();
        $message->setMessage("Dados atualizados com sucesso!!","sucess" ,"editarHora.php");


}else if($type === "updateEmpresa"){

    $empresa = filter_input(INPUT_POST, "empresa");
    $id = filter_input(INPUT_POST, "id");
    $nameAntigo = filter_input(INPUT_POST, "nomeAntigo");

    //mudar o nome da empresa na tabela dados
    $queryNome = "UPDATE dados SET empresa = '$empresa' WHERE empresa = '$nameAntigo'";
    $smtp = $conn->prepare($queryNome);
    $smtp->execute();

        $query = "UPDATE empresa SET nome='$empresa' WHERE id='$id'";
        $userData = $conn->prepare($query);
        $userData->execute();
        $message->setMessage("Empresa atualizada com sucesso!!","sucess" ,"cadastrarEmpresa.php");
    
}else if($type =="deleteUser"){

    $idUsuario = filter_input(INPUT_POST, "id");

    $query = "DELETE FROM usuario WHERE id = '$idUsuario'";
    $smtp = $conn->prepare($query);
    $smtp->execute();
    $message->setMessage("Usuario Deletado com sucesso", "sucess", "cadastrarUsuario.php");
}else if($type == "updateUsuario" ){

    //Receber os dados
    $id = filter_input(INPUT_POST, "id");
    $name = filter_input(INPUT_POST, "name");
    $lastname = filter_input(INPUT_POST, "lastname");
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");
    $confirmPassword = filter_input(INPUT_POST, "confirmPassword");
    $departamento = filter_input(INPUT_POST, "departamento");
    $profile = filter_input(INPUT_POST, "profile");

    $nameAntigo = filter_input(INPUT_POST, "primeiroNomeAntigo");
    $sobreNomeAntigo = filter_input(INPUT_POST, "sobrenomeAntigo");

     //Resgatar os dados do usuario
    $query = "SELECT * FROM usuario WHERE id='$id'";
    $userData = $conn->prepare($query);
    $userData->execute();


    //Verificar se as senhas batem
    if($password === $confirmPassword){

        $nomeAtual = $name." ".$lastname ;
        $nomeAntigo = $nameAntigo." ".$sobreNomeAntigo;

        //Pegar o nome atual no banco dados
        $queryNome = "UPDATE dados SET alocacao = '$nomeAtual' WHERE alocacao = '$nomeAntigo'";
        $smtp = $conn->prepare($queryNome);
        $smtp->execute();


        ///Atuaizar nome de usuario
        $query = "UPDATE usuario SET name='$name',lastname='$lastname',email='$email',
        password='$password', departamento = '$departamento'  ,profile='$profile' WHERE id='$id'";
        $userData = $conn->prepare($query);
        $userData->execute();
        $message->setMessage("Dados atualizados com sucesso!!","sucess" ,"cadastrarUsuario.php");



    }else{

        $message->setMessage("Senhas não batem", "error", "CadastrarUsuario.php");
    }

}else if($type == "deleteLancamento"){

    //Receber os dados
    $idLancamento = filter_input(INPUT_POST, "id");
   
    $queryLancamento = "DELETE FROM dados WHERE id = '$idLancamento'";
    $smtp = $conn->prepare($queryLancamento);
    $smtp->execute();
    $message->setMessage("Lançamento Deletado com sucesso", "sucess", "editarHora.php");
}





?>