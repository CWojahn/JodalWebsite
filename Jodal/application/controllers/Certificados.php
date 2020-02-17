<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Certificados
 *
 * @author Usuário
 */
class Certificados extends CI_Controller {

    //put your code here

    public function index() {
        $this->load->model('slides_m');

        $all_slides = $this->slides_m->select();

        $data = array(
            "title" => "Jodal - Certificados",
            "header" => "Certificados",
            "slides" => $all_slides
        );

        $this->load->view('template/header', $data);
        $this->load->view('certificados/principal');
        $this->load->view('template/footer');
    }

    public function buscar() {
        $this->load->model('certificado_m');
        
        if ($this->input->post('rit')) {
            $rit = $this->input->post('rit');
            
            $certificados = $this->certificado_m->getByRit($rit);

            if ($certificados->num_rows() > 0) {
                $dados['sucesso'] = TRUE;
                $dados['rows'] = $certificados->num_rows();
                $dados['certificados'] = $certificados->result();
                $this->load->view('certificados/lista', $dados);
            } else {
                $dados['sucesso'] = FALSE;
                $dados['msg'] = "Nenhum resultado encontrado";
                $this->load->view('certificados/lista', $dados);
            }
        }else if ($this->input->post('aluno')) {
            $nome_aluno = $this->input->post('aluno');

            $certificados = $this->certificado_m->getByName($nome_aluno);

            if ($certificados->num_rows() > 0) {
                $dados['sucesso'] = TRUE;
                $dados['rows'] = $certificados->num_rows();
                $dados['certificados'] = $certificados->result();
                $this->load->view('certificados/lista', $dados);
            } else {
                $dados['sucesso'] = FALSE;
                $dados['msg'] = "Nenhum resultado encontrado";
                $this->load->view('certificados/lista', $dados);
            }
        /*} else if ($this->input->post('cpf')) {
            $cpf = $this->input->post('cpf');
            
            $certificados = $this->certificado_m->getByCpf($cpf);

            if ($certificados->num_rows() > 0) {
                $dados['sucesso'] = TRUE;
                $dados['rows'] = $certificados->num_rows();
                $dados['certificados'] = $certificados->result();
                $this->load->view('certificados/lista', $dados);
            } else {
                $dados['sucesso'] = FALSE;
                $dados['msg'] = "Nenhum resultado encontrado";
                $this->load->view('certificados/lista', $dados);
            }*/
        } else {
            $dados['sucesso'] = FALSE;
            $dados['msg'] = "Preencha pelo menos um campo, depois clique em buscar!";
            $this->load->view('certificados/lista', $dados);
        }
    }
    
    public function buscar_cert() {
        $this->load->model('certificado_m');
        $id = $this->input->post('cod');
        
        $certificado = $this->certificado_m->getById($id);
        //print_r($certificado);
        $this->load->view('certificados/certificado', $certificado);
    }

}
