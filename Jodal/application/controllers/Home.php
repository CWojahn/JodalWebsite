<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Home
 *
 * @author Usuário
 */
class Home extends CI_Controller {

    //put your code here
    public function index() {
        $this->load->model('slides_m');
        
        $all_slides = $this->slides_m->select();
        
        $data = array(
            "title" => "Jodal - Home",
            "header" => "Conheça nossos treinamentos",
            "slides" => $all_slides
        );

        $this->load->model('treinamento_m');
        $treinamentos = $this->treinamento_m->getTreinamentosDestaques();
        $array_treinam = array(
            'treinamentos' => $treinamentos
        );

        $this->load->view('template/header', $data);
        $this->load->view('home/home', $array_treinam);
        $this->load->view('template/footer');
    }

}
