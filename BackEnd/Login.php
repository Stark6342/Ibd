<?php

/**
 * Created by PhpStorm.
 * User: beta
 * Date: 6/08/16
 * Time: 12:13 PM
 */
include_once "conec.php";
class Login extends conec{
    public function __construct(){
        parent::__construct();
    }
    public function login($u,$p){
        $ok=$this->_db->query("call login('".$u."','".$p."')");
        $art = $ok->fetch_all(MYSQLI_ASSOC);
        return $art;
    }
}