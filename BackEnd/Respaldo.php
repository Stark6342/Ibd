<?php

/**
 * Created by PhpStorm.
 * User: beta
 * Date: 29/07/16
 * Time: 10:49 PM
 */
class Respaldo extends conec
{
    public function __construct(){
        parent::__construct();
    }



  public function get_respaldo(){
        $result = $this->_db->query('SELECT * FROM respaldo');
        $art = $result->fetch_all(MYSQLI_ASSOC);
        return $art;
    }

}      
