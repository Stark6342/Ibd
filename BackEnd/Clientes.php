<?php

/**
 * Created by PhpStorm.
 * User: beta
 * Date: 29/07/16
 * Time: 10:48 PM
 */

require_once "conec.php";

class Clientes extends conec
{
    public function __construct(){
        parent::__construct();
    }

    public function get_client(){
        $result = $this->_db->query('SELECT * FROM ClienteVista');
        $art = $result->fetch_all(MYSQLI_ASSOC);
        return $art;
    }

    public function Get_Cl_por_ID($id){
        $result = $this->_db->query("SELECT * FROM ClienteParaObtenerResultados where CodCli=".$id.";");
        $art = $result->fetch_all(MYSQLI_ASSOC);
        return $art;
    }

    public function Alta($ok){
        $result = $this->_db->query("call AddCliente('".$ok['d1']."','".$ok['d2']."','".$ok['d3']."',".$ok['d4'].",'".$ok['d5']."','".$ok['d6']."','".$ok['d7']."',".$ok['d8'].",'".$ok['d9']."',".$ok['d10'].",".$ok['d11'].",".$ok['d12'].")");
        return $result;
    }
    public function Cambio($ok){
        $result = $this->_db->query("call EditarCliente(".$ok['id'].",'".$ok['d1']."','".$ok['d2']."','".$ok['d3']."',".$ok['d4'].",'".$ok['d5']."','".$ok['d6']."','".$ok['d7']."',".$ok['d8'].",'".$ok['d9']."',".$ok['d10'].",".$ok['d11'].",".$ok['d12'].")");
        return $result;
    }
    public function Baja($ok){
        $result = $this->_db->query("call EliminarCliente(".$ok.")");
        return $result;
    }

}