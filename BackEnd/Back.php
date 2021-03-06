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
require_once "Hijos.php";
require_once "Proveedores.php";
require_once "Direccion.php";
require_once "Respaldo.php";
require_once "Habilidad.php";


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
                $res=$cdt->alta($_POST['atributos']);
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
            case "GetCdtPorId":
                $cdt=new CentrosDeTrabajo();
                $ok=json_encode($cdt->Get_CDT_por_ID($_POST['id']));
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

           case "Departamento":
        switch ($_POST['Metodo']){
            case "GetDepartamentosPorId":
                $depa = new Departamento();
                $ok=json_encode($depa->Get_Departamento_por_ID($_POST['id']));
                echo $ok;
                unset($depa);
                break;
            case "GetDepartamentos":
                $depa = new Departamento();
                $ok=json_encode($depa->get_departamento());
                echo $ok;
                unset($depa);
                break;
            case "Alta":
                $depa=new Departamento();
                $ok=$depa->Alta($_POST['atributos']);
                echo $ok;
                unset($depa);
                break;
            case "Baja":
                $depa=new Departamento();
                $ok=$depa->Baja($_POST['id']);
                echo $ok;
                unset($depa);
                break;
            case "Cambio":
                $depa=new Departamento();
                $ok=$depa->Cambio($_POST['atributos']);
                echo $ok;
                unset($depa);
                break;

        }
        break;


           case "Empleado":
        switch ($_POST['Metodo']){
            case "GetEmpleadosPorId":
                $empl = new Empleados();
                $ok=json_encode($empl->Get_empleado_por_ID($_POST['id']));
                echo $ok;
                unset($empl);
                break;
             case "DepartamentoNuevo":
                $empl = new Empleados();
                $ok=json_encode($empl->AnadirDepartamento($_POST['atributos']));
                echo $ok;
                unset($empl);
                break;   
            case "GetEmpleados":
                $empl = new Empleados();
                $ok=json_encode($empl->get_empleado());
                echo $ok;
                unset($empl);
                break;

            case "Alta":
                $empl=new Empleados();
                $ok=$empl->Alta($_POST['atributos']);
                echo $ok;
                unset($empl);
                break;
            case "Baja":
                $empl=new Empleados();
                $ok=$empl->Baja($_POST['id']);
                echo $ok;
                unset($empl);
                break;
            case "Cambio":
                $empl=new Empleados();
                $ok=$empl->Cambio($_POST['atributos']);
                echo $ok;
                unset($empl);
                break;

        }
        break;

         case "Proveedor":
        switch ($_POST['Metodo']){
            case "GetProveedoresPorId":
                $prov = new Proveedores();
                $ok=json_encode($prov->Get_proveedor_por_ID($_POST['id']));
                echo $ok;
                unset($prov);
                break;
            case "GetProveedores":
                $prov = new Proveedores();
                $ok=json_encode($prov->get_proveedor());
                echo $ok;
                unset($prov);
                break;
            case "Alta":
                $prov=new Proveedores();
                $ok=$prov->Alta($_POST['atributos']);
                echo $ok;
                unset($prov);
                break;
            case "Baja":
                $prov=new Proveedores();
                $ok=$prov->Baja($_POST['id']);
                echo $ok;
                unset($prov);
                break;
            case "Cambio":
                $prov=new Proveedores();
                $ok=$prov->Cambio($_POST['atributos']);
                echo $ok;
                unset($prov);
                break;

        }
        break;

         case "Pedido":
        switch ($_POST['Metodo']){
            case "GetPedidosPorId":
                $pedi = new Pedidos();
                $ok=json_encode($pedi->Get_Pedido_por_ID($_POST['id']));
                echo $ok;
                unset($pedi);
                break;
            case "GetPedidos":
                $pedi = new Pedidos();
                $ok=json_encode($pedi->get_pedido());
                echo $ok;
                unset($pedi);
                break;
            case "Alta":
                $pedi=new Pedidos();
                $ok=$pedi->Alta($_POST['atributos']);
                echo $ok;
                unset($pedi);
                break;
            case "Baja":
                $pedi=new Pedidos();
                $ok=$pedi->Baja($_POST['id']);
                echo $ok;
                unset($pedi);
                break;
            case "Cambio":
                $pedi=new Pedidos();
                $ok=$pedi->Cambio($_POST['atributos']);
                echo $ok;
                unset($pedi);
                break;

        }
        break;


case "Hijo":
        switch ($_POST['Metodo']){
            case "GetHijosPorId":
                $hij = new Hijos();
                $ok=json_encode($hij->Get_hijo_por_ID($_POST['id']));
                echo $ok;
                unset($hij);
                break;
            case "GetHijos":
                $hij = new Hijos();
                $ok=json_encode($hij->get_hijo());
                echo $ok;
                unset($hij);
                break;
            case "Alta":
                $hij=new Hijos();
                $ok=$hij->Alta($_POST['atributos']);
                echo $ok;
                unset($hij);
                break;
            case "Baja":
                $hij=new Hijos();
                $ok=$hij->Baja($_POST['id']);
                echo $ok;
                unset($hij);
                break;
            case "Cambio":
                $hij=new Hijos();
                $ok=$hij->Cambio($_POST['atributos']);
                echo $ok;
                unset($hij);
                break;

        }
        break;


case "Direcciones":
        switch ($_POST['Metodo']){
            case "GetDireccionesPorId":
                $dir = new Direccion();
                $ok=json_encode($dir->Get_direccion_por_ID($_POST['id']));
                echo $ok;
                unset($dir);
                break;
            case "GetDirecciones":
                $dir = new Direccion();
                $ok=json_encode($dir->get_direccion());
                echo $ok;
                unset($dir);
                break;
            case "Alta":
                $dir=new Direccion();
                $ok=$dir->Alta($_POST['atributos']);
                echo $ok;
                unset($dir);
                break;
            case "Baja":
                $dir=new Direccion();
                $ok=$dir->Baja($_POST['id']);
                echo $ok;
                unset($dir);
                break;
            case "Cambio":
                $dir=new Direccion();
                $ok=$dir->Cambio($_POST['atributos']);
                echo $ok;
                unset($dir);
                break;

        }
        break;

        case "Respaldos":
        switch ($_POST['Metodo']){
            case "GetRespaldos":
                    $res = new Respaldo();
                $ok=json_encode($res->get_respaldo());
                echo $ok;
                unset($res);
                break;
    

        }
        break;

        case "Habilidades":
        switch ($_POST['Metodo']){
            case "GetHabilidades":
                $hab = new Habilidad();
                $ok=json_encode($hab->get_habilidad());
                echo $ok;
                unset($hab);
                break;
            case "Alta":
                $hab=new Habilidad();
                $ok=$hab->Alta($_POST['atributos']);
                echo $ok;
                unset($hab);
                break;
            case "Baja":
                $hab=new Habilidad();
                $ok=$hab->Baja($_POST['id']);
                echo $ok;
                unset($hab);
                break;


        }
        break;

}
