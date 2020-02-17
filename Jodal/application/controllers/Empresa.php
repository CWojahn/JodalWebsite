<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of empresa
 *
 * @author Usuário
 */
class Empresa extends CI_Controller {

    //put your code here
    public function index() {
        $this->load->model('slides_m');

        $all_slides = $this->slides_m->select();

        $data = array(
            "title" => "Jodal - A Empresa",
            "header" => "Conheça nossa Empresa",
            "slides" => $all_slides
        );
        
        $this->load->model('empresa_m');
        $empresa = $this->empresa_m->get()->row();
        $array['empresa'] = $empresa;
        $array['imagens'] = $this->empresa_m->select_img();
        
        $this->load->view('template/header', $data);
        $this->load->view('empresa/empresa', $array);
        $this->load->view('template/footer');
    }

}
