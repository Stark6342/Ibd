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

 public function get_departamento(){
        $result = $this->_db->query('SELECT * FROM departamento where   codigodepartamento!=0');
        $art = $result->fetch_all(MYSQLI_ASSOC);
        return $art;
    }


    public function get_poblacion(){
        $result = $this->_db->query('SELECT * FROM poblacion;');
        $art = $result->fetch_all(MYSQLI_ASSOC);
        return $art;
    }

   public function get_CDT(){
        $result = $this->_db->query('SELECT * FROM centrodetrabajo;');
        $art = $result->fetch_all(MYSQLI_ASSOC);
        return $art;
    }


    public function get_clientes(){
        $result = $this->_db->query('SELECT * FROM clientesselect;');
        $art = $result->fetch_all(MYSQLI_ASSOC);
        return $art;
    }



      public function get_direcciones(){
        $result = $this->_db->query('SELECT * FROM direcionesselect;');
        $art = $result->fetch_all(MYSQLI_ASSOC);
        return $art;
    }
 
      public function get_articulos(){
        $result = $this->_db->query('SELECT * FROM articulo;');
        $art = $result->fetch_all(MYSQLI_ASSOC);
        return $art;
    }

          public function get_empleados(){
        $result = $this->_db->query('SELECT * FROM empeladoselect;');
        $art = $result->fetch_all(MYSQLI_ASSOC);
        return $art;
    }
 


}