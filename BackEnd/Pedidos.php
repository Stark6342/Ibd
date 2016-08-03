<?php

/**
 * Created by PhpStorm.
 * User: beta
 * Date: 29/07/16
 * Time: 10:50 PM
 */
class Pedidos extends conec
{
    public function __construct(){
        parent::__construct();
    }


  public function get_pedido(){
        $result = $this->_db->query('SELECT * FROM pedidovista');
        $art = $result->fetch_all(MYSQLI_ASSOC);
        return $art;
    }

    public function Get_Pedido_por_ID($id){
        $result = $this->_db->query("SELECT * FROM pedidovista where codigopedido=".$id.";");
        $art = $result->fetch_all(MYSQLI_ASSOC);
        return $art;
    }

    public function Alta($ok){
        $result = $this->_db->query("call addpedido(".$ok['d1'].",".$ok['d2'].",'".$ok['d3']."','".$ok['d4']."',".$ok['d5'].",".$ok['d6'].")");
        return $result;
    }

    public function Cambio($ok){
        $result = $this->_db->query("call editarpedido(".$ok['id'].",".$ok['d1'].",".$ok['d2'].",'".$ok['d3']."','".$ok['d4']."',".$ok['d5'].",".$ok['d6'].")");
        return $result;
    }

    public function Baja($ok){
        $result = $this->_db->query("call eliminarpedido(".$ok.")");
        return $result;
    }

}