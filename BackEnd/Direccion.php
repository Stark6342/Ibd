<?php

/**
 * Created by PhpStorm.
 * User: beta
 * Date: 29/07/16
 * Time: 10:48 PM
 */

require_once "conec.php";

class Direccion extends conec
{
    public function __construct(){
        parent::__construct();
    }

    public function get_direccion(){
        $result = $this->_db->query('SELECT * FROM direccionesvista');
        $art = $result->fetch_all(MYSQLI_ASSOC);
        return $art;
    }

    public function Get_direccion_por_ID($id){
        $result = $this->_db->query("SELECT * FROM direccionesvista where codigodireccion=".$id.";");
        $art = $result->fetch_all(MYSQLI_ASSOC);
        return $art;
    }

    public function Alta($ok){
        $result = $this->_db->query("call adddireccion('".$ok['d1']."','".$ok['d2']."','".$ok['d3']."',".$ok['d4'].",".$ok['d5'].");");
        return $result;
    }
    public function Cambio($ok){
        $result = $this->_db->query("call editardireccion(".$ok['id'].",'".$ok['d1']."','".$ok['d2']."','".$ok['d3']."',".$ok['d4'].",".$ok['d5'].");");
        return $result;
    }
    public function Baja($ok){
        $result = $this->_db->query("call eliminardireccion(".$ok.")");
        return $result;
    }

}