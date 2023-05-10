<?php


    //Limpar buffet
    ob_start();
    require_once("bd.php");
    require_once("models/Message.php");
    $message = new Message($BASE_URL);

    //select dos dias do mês
    $query = "SELECT empresa,alocacao,hora,departamento,mes,dia FROM dados ORDER BY dia";
    $smtp = $conn->prepare($query);
    $smtp->execute();

    //select dos dias do mês
    // $queryuser = "SELECT CONCAT(name,' ',lastname) from usuario";
    // $usuarios = $conn->prepare($queryuser);
    // $usuarios->execute();


    if(($smtp) && ($smtp->rowCount() != 0)){

        //Aceita texto ou CSV
        header('Content-Type: text/csv; charset=UTF-8');
        //Nome do arquivo
        header('Content-Disposition: attachment; Filename=Relatorio-BD.csv');
        //Gravar no buffet
        $resultado = fopen("php://output", 'w');
        
        //criar cabeçalho do excel - Converter caracter especiais
        $cabecalho = ["Empresa","alocacao","hora","departamento", mb_convert_encoding("mes", "ISO-8859-1", "UTF-8"), "Dia"];

        //Escrever Cabeçalho no arquivo
        fputcsv($resultado, $cabecalho, ";");
        
        //Ler registros do banco de dados
        while($row_usuario = $smtp->fetch(PDO::FETCH_ASSOC))
        {

            //Extrair os dados do array para imprimir através do nome da coluna
            // extract($row_usuario);

            //Escrever conteúdo no arquivo
            fputcsv($resultado, $row_usuario, ";");
        }

            
        //fechar o arquivo
        fclose($resultado);
        


    }else{
       $_SESSION['msg-error-excel'] =  $message->setMessage("Não há registro no banco de dados", "error", "horaPorEmpresa.php");
    }

?>