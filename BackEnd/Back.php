<?php
/**
 * Created by PhpStorm.
 * User: beta
 * Date: 28/07/16
 * Time: 08:42 PM
 */
require_once "Articulos.php";
switch ($_POST['action']){
    case "articulos":
        switch ($_POST['Metodo']) {
            case "alta":
                $art = new Articulos();
                $ok = $_POST['atributos'];
                if ($ok['n'] != "" && $ok['p1'] != "" && $ok['p2'] != "" && $ok['p3'] != "") {
                    $hola=$art->alta($ok);
                    echo $hola;
                } else
                    echo "No";
                unset($art);
                break;
            case "GetFila":
                $art=new Articulos();
                $ok=$art->get_articulos_por_ID($_POST['id']);
                $res=json_encode($ok);
                unset($art);
                echo $res;
                break;
            case "GetArticulos":
                $art=new Articulos();
                $ok=$art->get_articulos();
                $res=json_encode($ok);
                unset($art);
                echo $res;
                break;
            case "Baja":
                $art=new Articulos();
                $id=$_POST['atributos'];
                $ok=$art->Baja($id);
                $res=json_encode($ok);
                unset($art);
                echo $res;
                break;
            case "Cambio":
                $art = new Articulos();
                $ok = $_POST['atributos'];
                if ($ok['id']!=""&&$ok['n'] != "" && $ok['p1'] != "" && $ok['p2'] != "" && $ok['p3'] != "") {
                    $hola=$art->Cambio($ok);
                    echo $hola;
                } else
                    echo "No";
                unset($art);
                break;
        }
    break;
}