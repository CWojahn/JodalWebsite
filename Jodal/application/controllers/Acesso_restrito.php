<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of acesso_restrito
 *
 * @author Iuri
 */
class Acesso_restrito extends CI_Controller {

    //put your code here
    function __construct() {
        parent::__construct();
        //ini_set('default_charset', 'UTF-8');
    }

    public function index() {
        $this->load->view('restrito/login');
    }

}
