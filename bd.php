<?php

    $host = "localhost";
    $db = "alocar_hora";
    $user = "root";
    $pwd = "";


    $conn = new PDO("mysql: host=$host;dbname=$db", $user, $pwd);


    //habilitar erro

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

?>