<?php
/**
 * Created by PhpStorm.
 * User: beta
 * Date: 6/08/16
 * Time: 12:48 PM
 */
session_start();
if(!isset($_SESSION["Validado"])) {
    header("location:../");
}
else {
if($_SESSION['Validado']=="aceptado"){
include "BarNav.php";
require_once "imports2.php";
?>

<head>
    <title>Bienvenida</title>
    <meta charset="utf-8" />
</head>
<!--PArte prinsipal de la pagina Muestra botones y tabla-->
<div class="row">
    <div class="col l10 offset-l1 m12 s12">
        <br>
        <h5 class="center">Bienvenida</h5>
        <br><hr><br>
    </div>
</div


<?php } } ?>