<?php

/**
 * Created by PhpStorm.
 * User: beta
 * Date: 29/07/16
 * Time: 10:49 PM
 */
class Departamento extends conec
{
    public function __construct(){
        parent::__construct();
    }


    public function get_departamento(){
        $result = $this->_db->query("SELECT * FROM departamentovista");
        $art = $result->fetch_all(MYSQLI_ASSOC);
        return $art;
    }

  public  function alta($ok){
        $result = $this->_db->query("call adddepartamento('".$ok['p1']."',".$ok['p2'].",".$ok['p3'].")");
        return $result;
    }

  public  function Cambio($ok){
        $result = $this->_db->query("call editardepartamento(".$ok['id'].",'".$ok['p1']."',".$ok['p2'].",".$ok['p3'].")");
        return $result;
    }


    public function Baja($ok){
        $result = $this->_db->query("call eliminardepartamento(".$ok.")");
        return $result;
    }


   public function Get_Departamento_por_ID($id){
        $result = $this->_db->query("SELECT * FROM departamentovista where codigodepartamento=".$id.";");
        $art = $result->fetch_all(MYSQLI_ASSOC);
        return $art;
    }

}