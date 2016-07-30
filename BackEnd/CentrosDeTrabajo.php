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

    public function Alta(){

    }

}