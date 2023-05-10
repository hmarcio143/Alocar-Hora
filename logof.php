<?php
        require_once("templetes/header.php");


        if($userDao){

            $userDao->destroyToken();
        }


?>