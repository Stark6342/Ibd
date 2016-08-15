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
        <p>¡Bienvenido al sistema óptimo de gestión de la empresa!
            Disfrute usted de la excelente interfaz de usuario que se le muestra que a la vez es intuitiva y responsiva.
            Es un Sistema de aplicación encargado de automatizar los procesos que se llevan a cabo en una empresa tomando en cuenta muchos factores que influyen en el comportamiento de esta misma.
            En este sistema usted podrá gestionar empleados, clientes y pedidos de una manera efectiva.
            Nosotros quienes desarrollamos este proyecto formamos parte de un grupo de trabajo destinado a la planeación y desarrollo de sistemas de información aprovechando conocimientos de varias herramientas tecnológicas, lenguajes de programación y sistema gestor de base de datos. Para entregar un trabajo que cumpla con todas las expectativas y niveles que el cliente demande.
            Gracias por utilizar el sistema si tiene problemas por favor contacte al administrador.</p>
        <br>
        <h5 class="center">Integrantes</h5>
        <br><hr><br>
    </div>
</div>

    <div class="row">
        <div class="col s3 m7">
            <div class="card hoverable">
                <div class="card-image">
                    <img src="Arael.jpg">
                </div>
                <div class="card-content">
                    <p>Betancourt Flores José Arael. Alumno de la Universidad Politecnica de Victoria</p>
                </div>
            </div>
        </div>
        <div class="col s3 ">
            <div class="card hoverable">
                <div class="card-image">
                    <img src="Perlita.jpeg">
                </div>
                <div class="card-content">
                    <p>Gamez Mercado perla Maribel. Alumno de la Universidad Politecnica de Victoria</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col s3 m7">
            <div class="card hoverable">
                <div class="card-image">
                    <img src="Gloria.jpeg">
                    <span class="card-title"></span>
                </div>
                <div class="card-content">
                    <p>Gloria Vazquez Victor Manuel. Alumno de la Universidad Politecnica de Victoria</p>
                </div>
            </div>
        </div>
        <div class="col s3 ">
            <div class="card hoverable ">
                <div class="card-image">
                    <img src="Lalo.jpeg">
                </div>
                <div class="card-content">
                    <p>Torres Montalvo José Eduardo.Alumno de la Universidad Politecnica de Victoria</p>
                </div>
            </div>
        </div>
    </div>
<?php } } ?>