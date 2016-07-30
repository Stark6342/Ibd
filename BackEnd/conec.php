<?php
/**
 * Created by PhpStorm.
 * User: beta
 * Date: 28/07/16
 * Time: 03:07 PM
 */

define('DB_HOST','localhost');
define('DB_USER','ibduser');
define('DB_PASS','ibdMaster123');
define('DB_NAME','ProyectoBaseDatos');
define('DB_CHARSET','utf-8');

class conec
{
    protected $_db;

    public function __construct()
    {
        $this->_db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ( $this->_db->connect_errno )
        {
            echo "Fallo al conectar a MySQL: ". $this->_db->connect_error;
            return;
        }

        $this->_db->set_charset(DB_CHARSET);
    }
}
?>