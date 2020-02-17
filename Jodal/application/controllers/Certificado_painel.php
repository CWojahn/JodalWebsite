<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Certificado_painel
 *
 * @author iuri.londero
 */
class Certificado_painel extends CI_Controller {

    //put your code here
    function __construct() {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('acesso_restrito');
        }
        date_default_timezone_set('America/Sao_Paulo');
    }

    public function index($array = array()) {
        $this->load->model('certificado_m');
        $dados = array(
            'header' => 'Controle de Certificados'
        );

        $certificados = $this->certificado_m->get_all();

        $array['certificados'] = $certificados;
        $this->load->view('restrito/painel', $dados);
        $this->load->view('restrito/certificados/principal', $array);
        $this->load->view('restrito/footer');
    }

    public function novo() {

        $this->load->model('treinamento_m');
        $this->load->model('certificado_m');
        
        $dados = array(
            'header' => 'Controle de Certificados'
        );
        $treinamentos = $this->treinamento_m->get_all();
        $dados1 = array(
            'treinamentos' => $treinamentos,
            'next' => $this->certificado_m->getNextID()
        );
        $this->load->view('restrito/painel', $dados);
        $this->load->view('restrito/certificados/novo', $dados1);
        $this->load->view('restrito/footer');
    }

    public function editar($id = '') {
        $dados = array(
            'header' => 'Controle de Certificados'
        );
        $this->load->model('treinamento_m');
        $this->load->model('certificado_m');
        $certificado = $this->certificado_m->get_certificado($id);

        $treinamentos = $this->treinamento_m->get_all();
        $dados1 = array(
            'treinamentos' => $treinamentos,
            'certificado' => $certificado->row()
        );

        $this->load->view('restrito/painel', $dados);
        $this->load->view('restrito/certificados/editar', $dados1);
        $this->load->view('restrito/footer');
    }

    public function excluir() {
        if ($this->input->post('id')) {
            $id = $this->input->post('id');

            $this->load->model('certificado_m');

            if ($this->certificado_m->remove($id)) {
                echo json_encode(array('msg' => TRUE));
            } else {
                echo json_encode(array('msg' => FALSE));
            }
        } else {
            echo json_encode(array('msg' => FALSE));
        }
    }

    public function salvar() {
        $numero = $this->input->post('numero');
        $treinamento = $this->input->post('treinamento');
        $horas = $this->input->post('horas');
        $aluno = $this->input->post('aluno');
        $data = $this->input->post('data');
        $rg = $this->input->post('rg');
        $cpf = $this->input->post('cpf');
        $obs = $this->input->post('observacao');

        $certificado = array(
            'id' => $numero,
            'treinamento' => $treinamento,
            'horas' => $horas,
            'aluno_nome' => $aluno,
            'data' => $data,
            'aluno_rg' => $rg,
            'aluno_cpf' => $cpf,
            'observacao' => $obs
        );
        $this->load->model('certificado_m');

        if ($this->certificado_m->insert($certificado)) {
            $this->session->set_flashdata('success', 'Certificado cadastrado com sucesso para o aluno <strong>' . $aluno . '</strong>!');
            redirect(site_url('certificado_painel'));
        } else {
            $this->session->set_flashdata('unchecked', TRUE);
            redirect(site_url('certificado_painel/novo'));
        }
    }

    public function salvar_edit() {
        $numero = $this->input->post('numero');
        $treinamento = $this->input->post('treinamento');
        $horas = $this->input->post('horas');
        $aluno = $this->input->post('aluno');
        $data = $this->input->post('data');
        $rg = $this->input->post('rg');
        $cpf = $this->input->post('cpf');
        $obs = $this->input->post('observacao');

        $certificado = array(
            //'id' => $numero,
            'treinamento' => $treinamento,
            'horas' => $horas,
            'aluno_nome' => $aluno,
            'data' => $data,
            'aluno_rg' => $rg,
            'aluno_cpf' => $cpf,
            'observacao' => $obs
        );
        $this->load->model('certificado_m');

        if ($this->certificado_m->update($certificado, $numero)) {
            $this->session->set_flashdata('success', 'Certificado modificado com sucesso para o aluno <strong>' . $aluno . '</strong>!');
            redirect(site_url('certificado_painel'));
        } else {
            $this->session->set_flashdata('unchecked', '<strong>ATENÇÃO!</strong> Erro ao editar certificado, verfique os dados e tente novamente.');
            redirect(site_url('certificado_painel/editar/' . $numero));
        }
    }

}
