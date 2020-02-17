<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Servicos_painel
 *
 * @author iuri.londero
 */
class Servicos_painel extends CI_Controller {

    //put your code here
    function __construct() {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('acesso_restrito');
        }
    }

    public function index() {
        $dados = array(
            'header' => 'Controle de Serviços'
        );

        $this->load->model('servicos_m');
        $servicos = $this->servicos_m->get_all();
        $array['servicos'] = $servicos;

        $this->load->view('restrito/painel', $dados);
        $this->load->view('restrito/servicos/principal', $array);
        $this->load->view('restrito/footer');
    }

    public function novo() {
        $dados = array(
            'header' => 'Controle de Serviços'
        );
        $this->load->view('restrito/painel', $dados);
        $this->load->view('restrito/servicos/novo');
        $this->load->view('restrito/footer');
    }
    
    public function editar($id = '') {

        $dados = array(
            'header' => 'Controle de Parceiros'
        );
        if ($this->input->post('radio')) {
            $id_servico = $this->input->post('radio');
        }
        if ($id <> '') {
            $id_servico = $id;
        }

        $this->load->model('servicos_m');
        $parceiro = $this->servicos_m->get_servico($id_servico);


        $array['servico'] = $parceiro->row();

        $this->load->view('restrito/painel', $dados);
        $this->load->view('restrito/servicos/editar', $array);
        $this->load->view('restrito/footer');
    }

    public function salvar() {
        $config['upload_path'] = FCPATH . 'uploads/servicos';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 0;

        $this->load->library('upload', $config);

        $array = array();

        if (!$this->upload->do_upload('imagem')) {
            $this->session->set_flashdata('error', 'Erro ao carregar imagem do serviço, tente novamente.');
            redirect(site_url('servicos_painel/novo'));
        } else {
            $imagem = $this->upload->data('file_name');

            $nome = $this->input->post('nome');
            $descricao = $this->input->post('descricao');

            $array['imagem'] = $imagem;
            $array['nome'] = $nome;
            $array['descricao'] = $descricao;

            $this->load->model('servicos_m');

            if ($this->servicos_m->insert($array)) {
                //$this->index($array);
                $this->session->set_flashdata('success', 'Serviço <strong>' . $nome . '</strong> cadastrado com sucesso!');
                redirect(site_url('servicos_painel'));
            } else {
                $this->session->set_flashdata('error', 'Erro ao salvar novo serviço, tente novamente.');
                redirect(site_url('servicos_painel/novo'));
            }
        }
    }
    
    public function salvar_edit() {
        $config['upload_path'] = FCPATH . 'uploads/servicos';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 0;

        $this->load->library('upload', $config);

        $array = array();
        $id = $this->input->post('id');

        $this->load->model('servicos_m');

        $servico = $this->servicos_m->get_servico($id)->row();

        if ($_FILES['imagem']['size'] == 0 && $_FILES['imagem']['error'] == 4) {
            // cover_image is empty (and not an error)
                $imagem = $servico->imagem;

        } else {
            if (!$this->upload->do_upload('imagem')) {
                $this->session->set_flashdata('error', '<strong>ATENÇÃO!</strong> Erro ao carregar imagem do serviço, verifique e tente novamente.');
                redirect(site_url('parceiros_painel/editar/' . $id));
            } else {
                $imagem = $this->upload->data('file_name');
                if (is_file(FCPATH . 'uploads/servicos/' . $servico->imagem)) {
                    unlink(FCPATH . 'uploads/servicos/' . $servico->imagem);
                }
            }
        }

        $nome = $this->input->post('nome');
        $descricao = $this->input->post('descricao');

        $array['imagem'] = $imagem;
        $array['nome'] = $nome;
        $array['descricao'] = $descricao;


        if ($this->servicos_m->update($id, $array)) {
            //$this->index($array);
            $this->session->set_flashdata('success', 'Serviço editado com sucesso!');
            redirect(site_url('servicos_painel'));
        } else {
            $this->session->set_flashdata('error', '<strong>ATENÇÃO!</strong> Erro ao editar serviço, verfique os dados e tente novamente.');
            redirect(site_url('servicos_painel/editar/' . $id));
        }
    }

    public function excluir() {
        if ($this->input->post('id')) {
            $id = $this->input->post('id');

            $this->load->model('servicos_m');
            $servico = $this->servicos_m->get_servico($id)->row();

            if ($this->servicos_m->remove($id)) {
                unlink(FCPATH . 'uploads/servicos/' . $servico->imagem);
                echo json_encode(array('msg' => TRUE));
            } else {
                echo json_encode(array('msg' => FALSE));
            }
        } else {
            echo json_encode(array('msg' => FALSE));
        }
    }

}
