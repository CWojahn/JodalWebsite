<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user_painel
 *
 * @author Iuri
 */
class User_painel extends CI_Controller {

    //put your code here
    function __construct() {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('acesso_restrito');
        }
    }

    function index() {
        $this->load->model('user');

        $dados = array(
            'header' => 'Usuários'
        );

        $result = $this->user->getUsers();
        $data = array(
            'usuarios' => $result
        );

        $this->load->view('restrito/painel', $dados);
        $this->load->view('restrito/usuario/usuarios', $data);
        $this->load->view('restrito/footer');
    }

    public function novo() {
        $dados = array(
            'header' => 'Cadastrar novo usuário'
        );
        $this->load->view('restrito/painel', $dados);
        $this->load->view('restrito/usuario/cadastrar');
        $this->load->view('restrito/footer');
    }

    public function submit() {
        $username = $this->input->post('username');
        $senha = $this->input->post('senha');

        $this->load->model('user');

        $user = array(
            'username' => $username,
            'senha' => sha1($senha)
        );

        if ($this->user->insert($user)) {
            $this->session->set_flashdata('success', 'Usuário ' . $username . ' cadastrado com sucesso!');
            redirect(site_url('user_painel'));
        } else {
            $this->session->set_flashdata('error', '<strong>ATENÇÃO!</strong> Erro ao cadastrar usuário ' . $username . '. Tente novamente.');
            redirect(site_url('user_painel'));
        }
    }

    public function excluir() {
        if ($this->input->post('id')) {
            $id = $this->input->post('id');

            $this->load->model('user');

            if ($this->user->remove($id)) {
                echo json_encode(array('msg' => TRUE));
            } else {
                echo json_encode(array('msg' => FALSE));
            }
        } else {
            echo json_encode(array('msg' => FALSE));
        }
    }
    
    

}
