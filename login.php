<?php
/**
 * Created by PhpStorm.
 * User: beta
 * Date: 6/08/16
 * Time: 12:13 PM
 */
include_once "BackEnd/Login.php";


if(!isset($_GET['username'])&&!isset($_GET['password']))
    echo "No llego nada";
else{
    $ok=new Login();
    $_pro=$ok->login($_GET['username'],$_GET['password']);
    foreach ($_pro as $row){
        if($row['count(usuario)']==1){
            session_start();
            $_SESSION["Validado"]="aceptado";
            header('Location: FrontEnd/Bienvenida.php');
        }
        else
            header('Location: /Ibd');
    }
}


