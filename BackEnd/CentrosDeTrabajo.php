<?php

/**
 * Created by PhpStorm.
 * User: beta
 * Date: 29/07/16
 * Time: 10:50 PM
 */
class CentrosDeTrabajo extends conec
{
    public function __construct(){
        parent::__construct();
    }

    public function get_CentrosDeTraajo(){
        $result = $this->_db->query("SELECT * FROM CentrosDeTrabajoVista");
        $art = $result->fetch_all(MYSQLI_ASSOC);
        return $art;
    }

  public  function alta($ok){
        $result = $this->_db->query("call addcentrodetrabajo('".$ok['p1']."',".$ok['p2'].",'".$ok['p3']."','".$ok['p4']."','".$ok['p5']."',".$ok['p6'].")");
        return $result;
    }

  public  function Cambio($ok){
        $result = $this->_db->query("call editarcentrodetrabajo(".$ok['id'].",'".$ok['p1']."',".$ok['p2'].",'".$ok['p3']."','".$ok['p4']."','".$ok['p5']."',".$ok['p6'].")");
        return $result;
    }


    public function Baja($ok){
        $result = $this->_db->query("call EliminarCentroDeTrabajo(".$ok.")");
        return $result;
        //call ProyectoBaseDatos.EliminarCentroDeTrabajo(1);
    }


   public function Get_CDT_por_ID($id){
        $result = $this->_db->query("SELECT * FROM centrosdetrabajovista where codigocdt=".$id.";");
        $art = $result->fetch_all(MYSQLI_ASSOC);
        return $art;
    }


}