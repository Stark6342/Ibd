<?php

/**
 * Created by PhpStorm.
 * User: beta
 * Date: 29/07/16
 * Time: 10:49 PM
 */
class Empleados extends conec
{
    public function __construct(){
        parent::__construct();
    }


  public function get_empleado(){
        $result = $this->_db->query('SELECT * FROM empleadosvista');
        $art = $result->fetch_all(MYSQLI_ASSOC);
        return $art;
    }

    public function Get_empleado_por_ID($id){
        $result = $this->_db->query("SELECT * FROM empleadosvista where codigoempleado=".$id.";");
        $art = $result->fetch_all(MYSQLI_ASSOC);
        return $art;
    }

 public function AnadirDepartamento($ok){
        $result = $this->_db->query("call AddDepartamentoEmpleado(".$ok['id'].",".$ok['d1'].");");
        return $result;
    }


    public function Alta($ok){
        $result = $this->_db->query("call addempleado('".$ok['d1']."','".$ok['d2']."','".$ok['d3']."',".$ok['d4'].",'".$ok['d5']."','".$ok['d6']."',".$ok['d7'].",'".$ok['d8']."','".$ok['d9']."',".$ok['d10'].")");
        return $result;
    }

    public function Cambio($ok){
        $result = $this->_db->query("call editarempleado(".$ok['id'].",'".$ok['d1']."','".$ok['d2']."','".$ok['d3']."',".$ok['d4'].",'".$ok['d5']."','".$ok['d6']."',".$ok['d7'].",'".$ok['d8']."','".$ok['d9']."',".$ok['d10'].")");
        return $result;
    }

    public function Baja($ok){
        $result = $this->_db->query("call eliminarempleado(".$ok.")");
        return $result;
    }

}