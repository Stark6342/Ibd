<?php
/**
 * Created by PhpStorm.
 * User: beta
 * Date: 28/07/16
 * Time: 08:42 PM
 */
require_once "Articulos.php";
require_once "CentrosDeTrabajo.php";
require_once "Clientes.php";
require_once "Departamento.php";
require_once "Empleados.php";
require_once "Pedidos.php";
require_once "Proveedores.php";


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
    case "CentroTrabajo":
        switch ($_POST['Metodo']){
            Case "Alta":
                $cdt =new CentrosDeTrabajo();
                $res=$cdt->Alta($_POST['atributos']);
                echo $res;
                Break;
            Case "Cambio":
                $cdt =new CentrosDeTrabajo();
                $res=$cdt->Cambio($_POST['atributos']);
                echo $res;
                Break;
            Case "Baja":
                $cdt =new CentrosDeTrabajo();
                $res=$cdt->Baja($_POST['id']);
                echo $res;
                Break;
            case "GetCdt":
                $cdt=new CentrosDeTrabajo();
                $ok=json_encode($cdt->get_CentrosDeTraajo());
                echo $ok;
                unset($cdt);
                break;
        }
        break;
    case "Cliente":
        switch ($_POST['Metodo']){
            case "Registro":
                $cli = new Clientes();
                $ok=json_encode($cli->Get_Cl_por_ID($_POST['id']));
                echo $ok;
                unset($cli);
                break;
            case "CargaTabla":
                $cli = new Clientes();
                $ok=json_encode($cli->get_client());
                echo $ok;
                unset($cli);
                break;
            case "Alta":
                $cli=new Clientes();
                $ok=$cli->Alta($_POST['atributos']);
                echo $ok;
                unset($cli);
                break;
            case "Baja":
                $cli=new Clientes();
                $ok=$cli->Baja($_POST['id']);
                echo $ok;
                unset($cli);
                break;
            case "Cambio":
                $cli=new Clientes();
                $ok=$cli->Cambio($_POST['atributos']);
                echo $ok;
                unset($cli);
                break;

        }
        break;
}
