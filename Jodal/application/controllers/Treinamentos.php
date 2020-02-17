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
class Treinamentos extends CI_Controller {

    //put your code here
    public function index() {
        $this->load->model('slides_m');

        $all_slides = $this->slides_m->select();

        $data = array(
            "title" => "Jodal - Treinamentos",
            "header" => "Conheça nossos treinamentos",
            "slides" => $all_slides
        );

        $this->load->model('treinamento_m');
        $treinamentos = $this->treinamento_m->get_all();
        $array_treinam = array(
            'treinamentos' => $treinamentos
        );

        $this->load->view('template/header', $data);
        $this->load->view('treinamentos/treinamentos', $array_treinam);
        $this->load->view('template/footer');
    }

    public function pt() {
        $this->load->model('slides_m');

        $all_slides = $this->slides_m->select();

        $data = array(
            "title" => "Jodal - Treinamentos",
            "header" => "Conheça nossos treinamentos disponíveis em português",
            "slides" => $all_slides
        );

        $this->load->model('treinamento_m');
        $treinamentos = $this->treinamento_m->get_all_pt();
        $array_treinam = array(
            'treinamentos' => $treinamentos
        );

        $this->load->view('template/header', $data);
        $this->load->view('treinamentos/treinamentos', $array_treinam);
        $this->load->view('template/footer');
    }

    public function en() {
        $this->load->model('slides_m');

        $all_slides = $this->slides_m->select_en();

        $data = array(
            "title" => "Jodal - Training",
            "header" => "Training in English",
            "slides" => $all_slides,
            "en" => TRUE
        );

        $this->load->model('treinamento_m');
        $treinamentos = $this->treinamento_m->get_all_en();
        $array_treinam = array(
            'treinamentos' => $treinamentos
        );

        $this->load->view('template/header', $data);
        $this->load->view('treinamentos/treinamentos_en', $array_treinam);
        $this->load->view('template/footer');
    }

    public function detalhes($id, $idioma = 'pt') { //quando clicar no saiba mais
        $this->load->model('slides_m');

        if ($idioma == 'en') {
            $data["en"] = TRUE;
            $all_slides = $this->slides_m->select_en();

            $data = array(
                "title" => "Jodal - Training",
                "header" => "",
                "slides" => $all_slides,
                "en" => TRUE
            );
        } else {
            $all_slides = $this->slides_m->select();

            $data = array(
                "title" => "Jodal - Treinamentos",
                "header" => "",
                "slides" => $all_slides
            );
        }

        $this->load->model('treinamento_m');
        //$treinamentos = $this->treinamento_m->get_treinamento();
        $array_treinam = array(
            'treinamento_detail' => $this->treinamento_m->get_treinamento($id)->row(),
            'idioma' => $idioma
        );

        $this->load->view('template/header', $data);
        $this->load->view('treinamentos/detalhes', $array_treinam);
        $this->load->view('template/footer');
    }

    public function cotacao($id = -1, $idioma = 'pt') {
        $this->load->model('slides_m');

        if ($idioma == 'en') {
            $data["en"] = TRUE;
            $all_slides = $this->slides_m->select_en();

            $data = array(
                "title" => "Jodal - Training",
                "header" => "",
                "slides" => $all_slides,
                "en" => TRUE
            );
        } else {
            $all_slides = $this->slides_m->select();

            $data = array(
                "title" => "Jodal - Treinamentos",
                "header" => "",
                "slides" => $all_slides
            );
        }
        $this->load->model('treinamento_m');
        //$treinamentos = $this->treinamento_m->get_treinamento();
        $treinam = array();
        if ($id != -1) {
            $treinam['treinamento_detail'] = $this->treinamento_m->get_treinamento($id)->row();
        }

        if ($idioma == 'pt') {
            $treinam['all_treinamentos'] = $this->treinamento_m->get_all();
        } else {
            $treinam['all_treinamentos'] = $this->treinamento_m->get_all_en();
        }
        $treinam['idioma'] = $idioma;

        $this->load->view('template/header', $data);
        $this->load->view('treinamentos/cotacao', $treinam);
        $this->load->view('template/footer');
    }

    public function submit_cotacao() {
        date_default_timezone_set("America/Sao_Paulo");

        if ($this->input->post('empresa') && $this->input->post('responsavel') && $this->input->post('endereco') && $this->input->post('telefone') && $this->input->post('email') && $this->input->post('curso') && $this->input->post('alunos') && $this->input->post('resp_curso')) {

            $empresa = $this->input->post('empresa');
            $responsavel = $this->input->post('responsavel');
            $endereco = $this->input->post('endereco');
            $telefone = $this->input->post('telefone');
            $email = $this->input->post('email');
            $curso = $this->input->post('curso');
            $alunos = $this->input->post('alunos');
            $resp_curso = $this->input->post('resp_curso');

            $email_config = Array(
                'mailtype' => 'html',
                'starttls' => true,
                'newline' => "\r\n",
                'charset' => 'utf-8',
                'wordwrap' => TRUE
            );

            $this->load->model('treinamento_m');
            $this->load->model('cotacao_m');            

            $treinamento = $this->treinamento_m->get_treinamento($curso)->row();

            $dados = array(
                'curso' => $treinamento->nome_pt,
                'empresa' => $empresa,
                'email' => $email,
                'telefone' => $telefone,
                'endereco' => $endereco,
                'responsavel' => $responsavel,
                'alunos' => $alunos,
                'resp_curso' => $resp_curso
            );
            
            $cotacao = array(
                'id_treinamento' => $curso,
                'empresa' => $empresa,
                'email' => $email,
                'telefone' => $telefone,
                'endereco' => $endereco,
                'responsavel' => $responsavel,
                'alunos' => $alunos
            );
            
            $contato = $this->load->view('email/cotacao', $dados, TRUE);

            $this->load->library('email', $email_config);

            $this->email->from('site@jodaltreinamentos.com', 'Jodal');
            $this->email->to('cotacao@jodaltreinamentos.com');
            //$this->email->to('londero.iuri@gmail.com');
            $this->email->subject('COTAÇÃO SITE - ' . $treinamento->nome_pt);
            $this->email->message($contato);

            $this->cotacao_m->insert($cotacao);
            
            if ($this->email->send()) {
                echo json_encode(array('sucesso' => TRUE, 'msg' => 'Pedido de cotação enviado com sucesso! Aguarde que a empresa Jodal entrará contato.'));
            } else {
                echo json_encode(array('sucesso' => FALSE, 'msg' => 'Erro ao pedir cotação, verifique os dados!'));
            }
        } else {
            echo json_encode(array('sucesso' => FALSE, 'msg' => 'Atenção! Todos os campos são obrigatórios'));
        }
    }

    public function pesquisar() {
        if ($this->input->post('pesquisar')) {
            $campo = $this->input->post('pesquisar');
            $this->load->model('treinamento_m');
            if ($this->treinamento_m->getTreinamentosLike($campo)->num_rows() > 0) {
                $this->load->model('slides_m');

                $all_slides = $this->slides_m->select();

                $data = array(
                    "title" => "Jodal - Treinamentos",
                    "header" => "Treinamentos encontrados - " . $this->treinamento_m->getTreinamentosLike($campo)->num_rows(),
                    "slides" => $all_slides
                );


                $treinamentos = $this->treinamento_m->getTreinamentosLike($campo)->result();
                $array_treinam = array(
                    'treinamentos' => $treinamentos
                );

                $this->load->view('template/header', $data);
                $this->load->view('treinamentos/treinamentos', $array_treinam);
                $this->load->view('template/footer');
            } else {
                $this->load->model('slides_m');

                $all_slides = $this->slides_m->select();

                $data = array(
                    "title" => "Jodal - Treinamentos",
                    "header" => "Nenhum treinamento encontrado",
                    "slides" => $all_slides
                );


                $treinamentos = $this->treinamento_m->getTreinamentosLike($campo)->result();
                $array_treinam = array(
                    'treinamentos' => $treinamentos
                );

                $this->load->view('template/header', $data);
                $this->load->view('treinamentos/treinamentos', $array_treinam);
                $this->load->view('template/footer');
            }
        } else {
            redirect(site_url('treinamentos'));
        }
    }

}
