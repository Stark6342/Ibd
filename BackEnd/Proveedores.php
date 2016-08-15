<?php

/**
 * Created by PhpStorm.
 * User: beta
 * Date: 29/07/16
 * Time: 10:49 PM
 */
class Proveedores extends conec
{
    public function __construct(){
        parent::__construct();
    }



  public function get_proveedor(){
        $result = $this->_db->query('SELECT * FROM proveedorvista');
        $art = $result->fetch_all(MYSQLI_ASSOC);
        return $art;
    }

    public function Get_proveedor_por_ID($id){
        $result = $this->_db->query("SELECT * FROM proveedorvista where codigoproveedor=".$id.";");
        $art = $result->fetch_all(MYSQLI_ASSOC);
        return $art;
    }

    public function Alta($ok){
        $result = $this->_db->query("call addproveedor('".$ok['d1']."','".$ok['d2']."',".$ok['d3'].")");
        return $result;
    }

    public function Cambio($ok){
        $result = $this->_db->query("call editarproveedor(".$ok['id'].",'".$ok['d1']."','".$ok['d2']."',".$ok['d3'].")");
        return $result;
    }

    public function Baja($ok){
        $result = $this->_db->query("call eliminarproveedor(".$ok.")");
        return $result;
    }

}
