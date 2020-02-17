<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Material_painel
 *
 * @author iuri.londero
 */
class Material_painel extends CI_Controller {

    //put your code here
    function __construct() {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('acesso_restrito');
        }
    }

    public function index() {
        $dados = array(
            'header' => 'Controle de Material de Apoio'
        );

        $this->load->model('material_m');
        $materiais = $this->material_m->get_all();
        $array['materiais'] = $materiais;

        $this->load->view('restrito/painel', $dados);
        $this->load->view('restrito/material/principal', $array);
        $this->load->view('restrito/footer');
    }

    public function novo() {
        $dados = array(
            'header' => 'Controle de Material de Apoio'
        );

        $this->load->view('restrito/painel', $dados);
        $this->load->view('restrito/material/novo');
        $this->load->view('restrito/footer');
    }

    public function editar($id) {

        $dados = array(
            'header' => 'Controle de Material de Apoio'
        );
        if ($id <> '') {
            $id_material = $id;
        }

        $this->load->model('material_m');
        $material = $this->material_m->get_material($id_material);


        $array['material'] = $material->row();

        $this->load->view('restrito/painel', $dados);
        $this->load->view('restrito/material/editar', $array);
        $this->load->view('restrito/footer');
    }

    public function salvar() {
        $config['upload_path'] = FCPATH . 'uploads/acessoria/material';
        $config['allowed_types'] = 'doc|docx|xls|xlsx|pdf';
        $config['max_size'] = 0;

        $this->load->library('upload', $config);

        $array = array();

        if (!$this->upload->do_upload('imagem')) {
            $this->session->set_flashdata('error', 'Erro ao carregar material de apoio, tente novamente.');
            redirect(site_url('material_painel/novo'));
        } else {
            $imagem = $this->upload->data('file_name');
            $nome = $this->input->post('nome');
            //$descricao = $this->input->post('site');

            $array['arquivo'] = $imagem;
            $array['nome'] = $nome;
            //$array['site'] = $descricao;

            $this->load->model('material_m');

            if ($this->material_m->insert($array)) {
                //$this->index($array);
                $this->session->set_flashdata('success', 'Empresa <strong>' . $nome . '</strong> cadastrada com sucesso!');
                redirect(site_url('material_painel'));
            } else {
                $this->session->set_flashdata('error', 'Erro ao salvar novo material, tente novamente.');
                redirect(site_url('material_painel/novo'));
            }
        }
    }

    public function salvar_edit() {
        $config['upload_path'] = FCPATH . 'uploads/acessoria/material';
        $config['allowed_types'] = 'doc|docx|xls|xlsx|pdf';
        $config['max_size'] = 0;

        $this->load->library('upload', $config);

        $array = array();
        $id = $this->input->post('id');

        $this->load->model('material_m');

        $material = $this->material_m->get_material($id)->row();

        if ($_FILES['imagem']['size'] == 0 && $_FILES['imagem']['error'] == 4) {
            // cover_image is empty (and not an error)
                $imagem = $material->arquivo;

        } else {
            if (!$this->upload->do_upload('imagem')) {
                $this->session->set_flashdata('error', '<strong>ATENÇÃO!</strong> Erro ao carregar material de apoio, verifique e tente novamente.');
                redirect(site_url('material_painel/editar/' . $id));
            } else {
                $imagem = $this->upload->data('file_name');
                if (is_file(FCPATH . 'uploads/acessoria/material/' . $material->arquivo)) {
                    unlink(FCPATH . 'uploads/acessoria/material/' . $material->arquivo);
                }
            }
        }

        $nome = $this->input->post('nome');
        //$site = $this->input->post('site');

        $array['arquivo'] = $imagem;
        $array['nome'] = $nome;
        //$array['site'] = $site;


        if ($this->material_m->update($id, $array)) {
            //$this->index($array);
            $this->session->set_flashdata('success', 'Material editado com sucesso!');
            redirect(site_url('material_painel'));
        } else {
            $this->session->set_flashdata('error', '<strong>ATENÇÃO!</strong> Erro ao editar material, verfique os dados e tente novamente.');
            redirect(site_url('material_painel/editar/' . $id));
        }
    }

    public function excluir() {
        if ($this->input->post('id')) {
            $id = $this->input->post('id');

            $this->load->model('material_m');
            $material = $this->material_m->get_material($id)->row();

            if ($this->material_m->remove($id)) {
                unlink(FCPATH . 'uploads/acessoria/material/' . $material->arquivo);
                echo json_encode(array('msg' => TRUE));
            } else {
                echo json_encode(array('msg' => FALSE));
            }
        } else {
            echo json_encode(array('msg' => FALSE));
        }
    }

}
