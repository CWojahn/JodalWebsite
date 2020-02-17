<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of destaques_painel
 *
 * @author Usuário
 */
class Destaques_painel extends CI_Controller {

    //put your code here

    function __construct() {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('acesso_restrito');
        }
    }
    
    public function index() {
        $this->load->model('treinamento_m');
        $dados = array(
            'header' => 'Controle de Treinamentos em destaque'
        );

        $treinamentos = $this->treinamento_m->get_all();

        $result_destaque = $this->treinamento_m->getTreinamentosDestaques();

        $data = array('treinamentos_disp' => $treinamentos, 'treinamentos_dest' => $result_destaque);

        $this->load->view('restrito/painel', $dados);
        $this->load->view('restrito/destaques/destaques', $data);
        $this->load->view('restrito/footer');
    }

    public function set_destaque() {
        $id = $this->input->post("id");
        $data = array(
            'destaque' => TRUE
        );

        $this->load->model('treinamento_m');

        if ($this->treinamento_m->update($id, $data)) {

            $result_destaque = $this->treinamento_m->getTreinamentosDestaques();
            $data = array('treinamentos_dest' => $result_destaque);
            echo $this->load->view('restrito/destaques/treinam_destaques', $data);
        } else {
            echo 'destaque';
        }
    }

    public function remove_destaque() {
        $id = $this->input->post("id");
        $data = array(
            'destaque' => FALSE
        );

        $this->load->model('treinamento_m');
        
        if ($this->treinamento_m->update($id, $data)) {

            $result_destaque = $this->treinamento_m->getTreinamentosDestaques();
            $data = array('treinamentos_dest' => $result_destaque);
            echo $this->load->view('restrito/destaques/treinam_destaques', $data);
        } else {
            echo 'destaque';
        }
    }

}
