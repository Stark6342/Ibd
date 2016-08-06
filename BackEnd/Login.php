<?php

/**
 * Created by PhpStorm.
 * User: beta
 * Date: 6/08/16
 * Time: 10:54 AM
 */

define('DB_HOST','localhost');
define('DB_USER','ibduser');
define('DB_PASS','ibdMaster123');
define('DB_NAME','ProyectoBaseDatos');

$ok=new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$arael=$ok->query("call login('admin','admin')");
if ( $ok->connect_errno )
{
    echo "Fallo al conectar a MySQL: ". $ok->connect_error;
}
//echo $arael."Hola";