<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Parceiros_painel
 *
 * @author iuri.londero
 */
class Parceiros_painel extends CI_Controller {

    //put your code here
    function __construct() {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('acesso_restrito');
        }
    }

    public function index() {
        $dados = array(
            'header' => 'Controle de Parceiros'
        );

        $this->load->model('parceiros_m');
        $parceiros = $this->parceiros_m->get_all();
        $array['parceiros'] = $parceiros;

        $this->load->view('restrito/painel', $dados);
        $this->load->view('restrito/parceiros/principal', $array);
        $this->load->view('restrito/footer');
    }

    public function novo() {
        $dados = array(
            'header' => 'Controle de Parceiros'
        );

        $this->load->view('restrito/painel', $dados);
        $this->load->view('restrito/parceiros/novo');
        $this->load->view('restrito/footer');
    }

    public function editar($id) {

        $dados = array(
            'header' => 'Controle de Parceiros'
        );
        if ($id <> '') {
            $id_parceiro = $id;
        }

        $this->load->model('parceiros_m');
        $parceiro = $this->parceiros_m->get_parceiro($id_parceiro);


        $array['parceiro'] = $parceiro->row();

        $this->load->view('restrito/painel', $dados);
        $this->load->view('restrito/parceiros/editar', $array);
        $this->load->view('restrito/footer');
    }

    public function salvar() {
        $config['upload_path'] = FCPATH . 'uploads/parceiros';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 0;

        $this->load->library('upload', $config);

        $array = array();

        if (!$this->upload->do_upload('imagem')) {
            $this->session->set_flashdata('error', 'Erro ao carregar imagem da empresa, tente novamente.');
            redirect(site_url('parceiros_painel/novo'));
        } else {
            $imagem = $this->upload->data('file_name');
            $nome = $this->input->post('nome');
            $descricao = $this->input->post('site');

            $array['logo'] = $imagem;
            $array['nome'] = $nome;
            $array['site'] = $descricao;

            $this->load->model('parceiros_m');

            if ($this->parceiros_m->insert($array)) {
                //$this->index($array);
                $this->session->set_flashdata('success', 'Empresa <strong>' . $nome . '</strong> cadastrada com sucesso!');
                redirect(site_url('parceiros_painel'));
            } else {
                $this->session->set_flashdata('error', 'Erro ao salvar novo parceiro, tente novamente.');
                redirect(site_url('parceiros_painel/novo'));
            }
        }
    }

    public function salvar_edit() {
        $config['upload_path'] = FCPATH . 'uploads/parceiros';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 0;

        $this->load->library('upload', $config);

        $array = array();
        $id = $this->input->post('id');

        $this->load->model('parceiros_m');

        $parceiro = $this->parceiros_m->get_parceiro($id)->row();

        if ($_FILES['imagem']['size'] == 0 && $_FILES['imagem']['error'] == 4) {
            // cover_image is empty (and not an error)
                $imagem = $parceiro->logo;

        } else {
            if (!$this->upload->do_upload('imagem')) {
                $this->session->set_flashdata('error', '<strong>ATENÇÃO!</strong> Erro ao carregar imagem da empresa, verifique e tente novamente.');
                redirect(site_url('parceiros_painel/editar/' . $id));
            } else {
                $imagem = $this->upload->data('file_name');
                if (is_file(FCPATH . 'uploads/parceiros/' . $parceiro->logo)) {
                    unlink(FCPATH . 'uploads/parceiros/' . $parceiro->logo);
                }
            }
        }

        $nome = $this->input->post('nome');
        $site = $this->input->post('site');

        $array['logo'] = $imagem;
        $array['nome'] = $nome;
        $array['site'] = $site;


        if ($this->parceiros_m->update($id, $array)) {
            //$this->index($array);
            $this->session->set_flashdata('success', 'Parceiro editado com sucesso!');
            redirect(site_url('parceiros_painel'));
        } else {
            $this->session->set_flashdata('error', '<strong>ATENÇÃO!</strong> Erro ao editar parceiro, verfique os dados e tente novamente.');
            redirect(site_url('parceiros_painel/editar/' . $id));
        }
    }

    public function excluir() {
        if ($this->input->post('id')) {
            $id = $this->input->post('id');

            $this->load->model('parceiros_m');
            $parceiro = $this->parceiros_m->get_parceiro($id)->row();

            if ($this->parceiros_m->remove($id)) {
                unlink(FCPATH . 'uploads/parceiros/' . $parceiro->logo);
                echo json_encode(array('msg' => TRUE));
            } else {
                echo json_encode(array('msg' => FALSE));
            }
        } else {
            echo json_encode(array('msg' => FALSE));
        }
    }

}
