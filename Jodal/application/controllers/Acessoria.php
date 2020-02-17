<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Home
 *
 * @author Usuário
 */
class Acessoria extends CI_Controller {

    //put your code here
    public function index() {


        $data = array(
            "title" => "Jodal - Acessoria",
            "header" => "Conheça nossos Serviços"
        );

        $this->load->model('ac_categoria_m');
        $categorias = $this->ac_categoria_m->getAllCategs();
        $array = array(
            'categorias' => $categorias
        );

        $this->load->view('template/header_c', $data);
        $this->load->view('home/home_c', $array);
        $this->load->view('template/footer_c');
    }

    public function categoria($id = 0) {
        $this->load->model('ac_servicos_m');
        $this->load->model('ac_categoria_m');

        $data = array(
            "title" => "Jodal - Acessoria",
            "header" => "Conheça nossos Serviços"
        );
        $array = array();
        

        $aux = new stdClass();
        $aux->categoria = $this->ac_categoria_m->getCateg(2);
        $aux->servicos = $this->ac_servicos_m->getServicosCateg(2);
        $array[] = $aux;

        $aux = new stdClass();
        $aux->categoria = $this->ac_categoria_m->getCateg(4);
        $aux->servicos = $this->ac_servicos_m->getServicosCateg(4);
        $array[] = $aux;
        
        $aux = new stdClass();
        $aux->categoria = $this->ac_categoria_m->getCateg(3);
        $aux->servicos = $this->ac_servicos_m->getServicosCateg(3);
        $array[] = $aux;
        
        $aux = new stdClass();
        $aux->categoria = $this->ac_categoria_m->getCateg(1);
        $aux->servicos = $this->ac_servicos_m->getServicosCateg(1);
        $array[] = $aux;
        
        $dados = array(
            'menu' => $array,
            'categoria' => $this->ac_categoria_m->getCateg($id),
            'servicos' => $this->ac_servicos_m->getServicosCateg($id)
        );

        $this->load->view('template/header_c', $data);
        $this->load->view('ac_servicos/servicos', $dados);
        $this->load->view('template/footer_c');
    }

    public function servicos() {
        $this->load->model('ac_servicos_m');
        $this->load->model('ac_servicos_img_m');
        $this->load->model('ac_categoria_m');

        $data = array(
            "title" => "Jodal - Acessoria",
            "header" => "Conheça nossos Serviços"
        );
        
        $array = array();
        

        $aux = new stdClass();
        $aux->categoria = $this->ac_categoria_m->getCateg(2);
        $aux->servicos = $this->ac_servicos_m->getServicosCateg(2);
        $array[] = $aux;

        $aux = new stdClass();
        $aux->categoria = $this->ac_categoria_m->getCateg(4);
        $aux->servicos = $this->ac_servicos_m->getServicosCateg(4);
        $array[] = $aux;
        
        $aux = new stdClass();
        $aux->categoria = $this->ac_categoria_m->getCateg(3);
        $aux->servicos = $this->ac_servicos_m->getServicosCateg(3);
        $array[] = $aux;
        
        $aux = new stdClass();
        $aux->categoria = $this->ac_categoria_m->getCateg(1);
        $aux->servicos = $this->ac_servicos_m->getServicosCateg(1);
        $array[] = $aux;
        
        $this->load->library('pagination');

        $config['base_url'] = site_url('acessoria/servicos');
        $config['total_rows'] = $this->ac_servicos_m->getAllServicos(0, 0)->num_rows();
        $config['per_page'] = "12";
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = round($choice);

        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $dados['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $dados['servicos'] = $this->ac_servicos_m->getAllServicos($config["per_page"], $dados['page'])->result();
        $dados['pagination'] = $this->pagination->create_links();
        $dados['menu'] = $array;
        
        $categoria = new stdClass();
        $categoria->id = 0;
        $categoria->banner = 'banner.png';
        $categoria->nome = 'Todos os Serviços';
        $dados['categoria'] = $categoria;
        //$dados = array(
            //'menu' => $array,
        //    'categoria' => $this->ac_categoria_m->getCateg($id),
            //'servicos' => ($id > 0) ? $array[$id - 1]->servicos : NULL
        //);

        $this->load->view('template/header_c', $data);
        $this->load->view('ac_servicos/servicos', $dados);
        $this->load->view('template/footer_c');       
        
    }
    
    public function servico($id) {
        $this->load->model('ac_servicos_m');
        $this->load->model('ac_servicos_img_m');
        $this->load->model('ac_categoria_m');

        $data = array(
            "title" => "Jodal - Acessoria",
            "header" => "Conheça nossos Serviços"
        );

        $array = array();
        
        $aux = new stdClass();
        $aux->categoria = $this->ac_categoria_m->getCateg(2);
        $aux->servicos = $this->ac_servicos_m->getServicosCateg(2);
        $array[] = $aux;


        $aux = new stdClass();
        $aux->categoria = $this->ac_categoria_m->getCateg(4);
        $aux->servicos = $this->ac_servicos_m->getServicosCateg(4);
        $array[] = $aux;
        
        $aux = new stdClass();
        $aux->categoria = $this->ac_categoria_m->getCateg(3);
        $aux->servicos = $this->ac_servicos_m->getServicosCateg(3);
        $array[] = $aux;
        
        $aux = new stdClass();
        $aux->categoria = $this->ac_categoria_m->getCateg(1);
        $aux->servicos = $this->ac_servicos_m->getServicosCateg(1);
        $array[] = $aux;

        $servico = $this->ac_servicos_m->getServico($id);


        $dados = array(
            'menu'      => $array,
            'categoria' => $this->ac_categoria_m->getCateg($servico->categoria),
            'servico'   => $servico,
            //'serv_imgs' => $this->ac_servicos_img_m->getImagens($id)
        );

        $this->load->view('template/header_c', $data);
        $this->load->view('ac_servicos/detalhes', $dados);
        $this->load->view('template/footer_c');
    }
    
    public function material() {
        
        $data = array(
            "title" => "Jodal - Material de Apoio",
            "header" => "Material de Apoio"
        );
        
        $this->load->model('material_m');
        $materiais = $this->material_m->get_all();
        $array['materiais'] = $materiais;        
        
        $this->load->view('template/header_c', $data);
        $this->load->view('material/material', $array);
        $this->load->view('template/footer_c');
    }
    
    public function clientes() {
        
        $data = array(
            "title" => "Jodal - Clientes",
            "header" => "Clientes"
        );
        
        $this->load->model('parceiros_m');
        $parceiros = $this->parceiros_m->get_all();
        $array['parceiros'] = $parceiros;        
        
        $this->load->view('template/header_c', $data);
        $this->load->view('parceiros/parceiros', $array);
        $this->load->view('template/footer_c');
    }

    public function contato() {
        $data = array(
            "title" => "Jodal - Acessoria",
            "header" => "Conheça nossos Serviços"
        );

        $this->load->model('empresa_m');
        $empresa = $this->empresa_m->get()->row();
        $array['empresa'] = $empresa;

        $this->load->view('template/header_c', $data);
        $this->load->view('contato/contato_c', $array);
        $this->load->view('template/footer_c');
    }
    
    public function empresa() {
        
        $data = array(
            "title" => "Jodal - A Empresa",
            "header" => "Conheça nossa Empresa"
        );
        
        $this->load->model('empresa_m');
        $empresa = $this->empresa_m->get()->row();
        $array['empresa'] = $empresa;
        $array['imagens'] = $this->empresa_m->select_img();
        
        $this->load->view('template/header_c', $data);
        $this->load->view('empresa/empresa_c', $array);
        $this->load->view('template/footer_c');
    }
    
    public function novidades() {


        $dados = array(
            "title" => "Jodal - Novidades",
            "header" => "Novidades Jodal"
        );

        $this->load->model('novidades_m');
        
        $array = array(
            "novidades" => $this->novidades_m->getArtigosPublicos()
        );


        $this->load->view('template/header_c', $dados);
        $this->load->view('ac_novidades/listar', $array);
        $this->load->view('template/footer_c');
    }
    
    public function novidade($id) {
        $dados = array(
            "title" => "Jodal - Novidades",
            "header" => "Conheça nossos treinamentos"
        );

        $this->load->model('novidades_m');
        $this->load->model('novidades_img_m');

        $array['imagens'] = $this->novidades_img_m->getImagens($id);
        $array['novidade'] = $this->novidades_m->getArtigoDetail($id);


        $this->load->view('template/header_c', $dados);
        $this->load->view('ac_novidades/novidade', $array);
        $this->load->view('template/footer_c');
    }
    
    public function submit_cotacao() {

        if ($this->input->post('nome') && $this->input->post('email') && $this->input->post('id_prod')) {

            $nome = $this->input->post('nome');
            $endereco = $this->input->post('endereco');
            $telefone = $this->input->post('telefone');
            $email = $this->input->post('email');
            //$produto= $this->input->post('produto');
            $id = $this->input->post('id_prod');
            $mensagem = $this->input->post('mensagem');

            $email_config = Array(
                'mailtype' => 'html',
                'starttls' => true,
                'newline' => "\r\n",
                'charset' => 'utf-8',
                'wordwrap' => TRUE
            );

            
            $this->load->model('ac_servicos_m');
            $servico = $this->ac_servicos_m->getServico($id);

            
            $dados = array(
                'produto' => $servico->nome,
                'email' => $email,
                'telefone' => $telefone,
                'endereco' => $endereco,
                'nome' => $nome,
                'mensagem' => $mensagem
            );

            $contato = $this->load->view('email/cotacao_c', $dados, TRUE);

            $this->load->library('email', $email_config);

            $this->email->from('site@jodaltreinamentos.com', 'Jodal');
            //$this->email->to('cotacao@jodaltreinamentos.com');
            $this->email->to('londero.iuri@gmail.com');
            $this->email->subject('COTAÇÃO ACESSORIA - ' . $servico->nome);
            $this->email->message($contato);

            if ($this->email->send()) {
                echo json_encode(array('sucesso' => TRUE, 'msg' => 'Pedido de cotação enviado com sucesso! Aguarde que a empresa Jodal entrará em contato.'));
            } else {
                echo json_encode(array('sucesso' => FALSE, 'msg' => 'Erro ao pedir cotação, verifique os dados!'));
            }
        } else {
            echo json_encode(array('sucesso' => FALSE, 'msg' => 'Atenção! Nome e email são obrigatórios'));
        }
    }

}
