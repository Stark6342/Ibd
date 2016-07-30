<?php

/**
 * Created by PhpStorm.
 * User: beta
 * Date: 28/07/16
 * Time: 03:08 PM
 */
require_once "conec.php";


class Articulos extends conec
{
    public function __construct(){
        parent::__construct();
    }
    public function get_articulos()
    {
        $result = $this->_db->query('SELECT * FROM VistaArticulos');
        $art = $result->fetch_all(MYSQLI_ASSOC);
        return $art;
    }

    public function get_articulos_por_ID($id)
    {
        $result = $this->_db->query("SELECT * FROM Articulo where CodigoArticulo='".$id."'");
        $art = $result->fetch_all(MYSQLI_ASSOC);
        return $art;
    }

    public  function alta($ok){
        $result = $this->_db->query("call AddArticulo('".$ok['n']."','".$ok['p1']."',".$ok['p2'].",".$ok['p3'].")");
        return $result;
    }

    public function Baja($ok){
        $result = $this->_db->query("call EliminarArticulo('".$ok."')");
        return $result;
    }

    public function Cambio($ok){
        $result = $this->_db->query("call EditarArticulo('".$ok['id']."','".$ok['n']."','".$ok['p1']."',".$ok['p2'].",".$ok['p3'].")");
        return $result;
    }
}