<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Parceiros
 *
 * @author iuri.londero
 */
class Parceiros extends CI_Controller{
    //put your code here
    public function index() {
        $this->load->model('slides_m');

        $all_slides = $this->slides_m->select();
        $data = array(
            "title" => "Jodal - Clientes",
            "header" => "Clientes",
            "slides" => $all_slides
        );
        
        $this->load->model('parceiros_m');
        $parceiros = $this->parceiros_m->get_all();
        $array['parceiros'] = $parceiros;        
        
        $this->load->view('template/header', $data);
        $this->load->view('parceiros/parceiros', $array);
        $this->load->view('template/footer');
    }
}
