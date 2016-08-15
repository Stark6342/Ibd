<?php
/**
 * Created by PhpStorm.
 * User: beta
 * Date: 6/08/16
 * Time: 12:35 PM
 */

session_start();
unset($_SESSION["Validado"]);
header('Location: /Ibd');
?>