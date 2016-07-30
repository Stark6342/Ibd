<?php

/**
 * Created by PhpStorm.
 * User: beta
 * Date: 30/07/16
 * Time: 03:45 PM
 */
require_once "conec.php";
class CargaSelect extends conec
{
    public function __construct(){
        parent::__construct();
    }
    public function get_provedor(){
        $result = $this->_db->query('SELECT * FROM proveedor');
        $art = $result->fetch_all(MYSQLI_ASSOC);
        return $art;
    }
}