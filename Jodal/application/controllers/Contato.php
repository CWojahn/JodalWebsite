<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of servicos
 *
 * @author Usuário
 */
class Contato extends CI_Controller {

    //put your code here
    public function index() {
        $this->load->model('slides_m');

        $all_slides = $this->slides_m->select();

        $data = array(
            "title" => "Jodal - Contato",
            "header" => "Fale conosco",
            "slides" => $all_slides
        );
        $this->load->model('empresa_m');
        $empresa = $this->empresa_m->get()->row();
        $array['empresa'] = $empresa;

        $this->load->view('template/header', $data);
        $this->load->view('contato/contato', $array);
        $this->load->view('template/footer');
    }

    public function enviar() {
        date_default_timezone_set("America/Sao_Paulo");
        if (($this->input->post('responsavel')) && 
                ($this->input->post('empresa')) && 
                ($this->input->post('email')) && 
                ($this->input->post('telefone')) && 
                ($this->input->post('mensagem'))) {
            $email_config = Array(
                'mailtype' => 'html',
                'starttls' => true,
                'newline' => "\r\n",
                'charset' => 'utf-8',
                'wordwrap' => TRUE
            );
            $responsavel = $this->input->post('responsavel');
            $empresa = $this->input->post('empresa');
            $email = $this->input->post('email');
            $telefone = $this->input->post('telefone');
            $mensagem = $this->input->post('mensagem');

            $dados = array(
                'responsavel' => $responsavel,
                'empresa' => $empresa,
                'email' => $email,
                'telefone' => $telefone,
                'mensagem' => $mensagem
            );

            $contato = $this->load->view('email/contato', $dados, TRUE);

            $this->load->library('email', $email_config);

            $this->email->from('site@jodaltreinamentos.com', 'Jodal');
            $this->email->to('contato@jodaltreinamentos.com.br');
            $this->email->reply_to($email, $responsavel);
            $this->email->subject('CONTATO SITE - ' . $empresa);
            $this->email->message($contato);

            if ($this->email->send()) {
                echo json_encode(array('sucesso' => TRUE, 'msg' => 'Mensagem enviada com sucesso!'));
            } else {
                echo json_encode(array('sucesso' => FALSE, 'msg' => 'Erro ao enviar mensagem!'));
            }
        } else {
            echo json_encode(array('sucesso' => FALSE, 'msg' => 'Atenção! Todos os campos são obrigatórios'));
        }
    }

}
