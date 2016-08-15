<?php

/**
 * Created by PhpStorm.
 * User: beta
 * Date: 29/07/16
 * Time: 10:49 PM
 */
class Habilidad extends conec
{
    public function __construct(){
        parent::__construct();
    }


    public function get_habilidad(){
        $result = $this->_db->query("SELECT * FROM empeladohabilidadvista");
        $art = $result->fetch_all(MYSQLI_ASSOC);
        return $art;
    }

  public  function Alta($ok){
        $result = $this->_db->query("call agregarhabilidadempleado(".$ok['p1'].",".$ok['p2'].")");
        return $result;
    }

    public function Baja($ok){
        $result = $this->_db->query("call quitarhabilidadempleado(".$ok.")");
        return $result;
    }



}

