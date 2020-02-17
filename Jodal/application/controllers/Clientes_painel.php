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
class Clientes_painel extends CI_Controller {

    //put your code here
    function __construct() {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('acesso_restrito');
        }
    }

    public function index($array = array()) {
        $this->load->model('clientes_m');
        $dados = array(
            'header' => 'Controle de Clientes'
        );

        $clientes = $this->clientes_m->get_all();

        $array['clientes'] = $clientes;
        $this->load->view('restrito/painel', $dados);
        $this->load->view('restrito/clientes/principal', $array);
        $this->load->view('restrito/footer');
    }

    public function novo() {

        $dados = array(
            'header' => 'Controle de Clientes'
        );
        


        $this->load->view('restrito/painel', $dados);
        $this->load->view('restrito/clientes/novo');
        $this->load->view('restrito/footer');
    }

    public function editar($id = '') {
        $dados = array(
            'header' => 'Controle de Clientes'
        );
        $this->load->model('clientes_m');
        $certificado = $this->clientes_m->get_cliente($id);

        $dados1 = array(
            'cliente' => $certificado->row()
        );

        $this->load->view('restrito/painel', $dados);
        $this->load->view('restrito/clientes/editar', $dados1);
        $this->load->view('restrito/footer');
    }

    public function excluir() {
        if ($this->input->post('id')) {
            $id = $this->input->post('id');

            $this->load->model('clientes_m');

            if ($this->clientes_m->remove($id)) {
                echo json_encode(array('msg' => TRUE));
            } else {
                echo json_encode(array('msg' => FALSE));
            }
        } else {
            echo json_encode(array('msg' => FALSE));
        }
    }

    public function salvar() {

        $res = $this->input->post();
        
        $this->load->model('clientes_m');
        
        if($this->clientes_m->insert($res)){
            $this->session->set_flashdata('success', 'Cliente ' . $res['empresa']. ' cadastrado com sucesso!');
            redirect(site_url('clientes_painel'));
        } else {
            $this->session->set_flashdata('unchecked', TRUE);
            redirect(site_url('clientes_painel/novo'));
        }
        /*
          $numero = $this->input->post('numero');
          $treinamento = $this->input->post('treinamento');
          $horas = $this->input->post('horas');
          $aluno = $this->input->post('aluno');
          $cpf = $this->input->post('cpf');

          $certificado = array(
          'id' => $numero,
          'treinamento' => $treinamento,
          'horas' => $horas,
          'aluno_nome' => $aluno,
          'aluno_cpf' => $cpf
          );
          $this->load->model('certificado_m');

          if ($this->certificado_m->insert($certificado)) {
          $this->session->set_flashdata('success', 'Certificado cadastrado com sucesso para o aluno <strong>' . $aluno . '</strong>!');
          redirect(site_url('certificado_painel'));
          } else {
          $this->session->set_flashdata('unchecked', TRUE);
          redirect(site_url('certificado_painel/novo'));
          } */
    }

    private function limpaCPF_CNPJ($valor) {
        $valor = trim($valor);
        $valor = str_replace(".", "", $valor);
        $valor = str_replace(",", "", $valor);
        $valor = str_replace("-", "", $valor);
        $valor = str_replace("/", "", $valor);
        return $valor;
    }

    public function salvar_edit() {
        $cliente = $this->input->post();
        $id = $this->input->post('id');
        
        unset($cliente['id']);
        
        $this->load->model('clientes_m');

        if ($this->clientes_m->update($cliente, $id)) {
            $this->session->set_flashdata('success', 'Cliente editado com sucesso!');
            redirect(site_url('clientes_painel'));
        } else {
            $this->session->set_flashdata('unchecked', '<strong>ATENÇÃO!</strong> Erro ao editar cliente, verfique os dados e tente novamente.');
            redirect(site_url('clientes_painel/editar/' . $id));
        }
    }

}
