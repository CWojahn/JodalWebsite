<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of servicos
 *
 * @author Usuário
 */
class Servicos extends CI_Controller {
    //put your code here
    public function index() {
        $this->load->model('slides_m');

        $all_slides = $this->slides_m->select();
        $data = array(
            "title" => "Jodal - Serviços",
            "header" => "Serviços",
            "slides" => $all_slides
        );
        
        $this->load->model('servicos_m');
        $servicos = $this->servicos_m->get_all();
        $array['servicos'] = $servicos;        
        
        $this->load->view('template/header', $data);
        $this->load->view('servicos/servicos', $array);
        $this->load->view('template/footer');
    }
}
