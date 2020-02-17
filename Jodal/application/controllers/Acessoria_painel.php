<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Acessoria_painel
 *
 * @author Iuri
 */
class Acessoria_painel extends CI_Controller {

//put your code here
    function __construct() {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('acesso_restrito');
        }
        date_default_timezone_set('America/Sao_Paulo');
    }

    public function index() {

        $dados = array(
            'header' => 'Gerenciamento de acessoria'
        );

        $this->load->model('ac_servicos_m');

        $array = array(
            'servicos' => $this->ac_servicos_m->get_all()
        );

        $this->load->view('restrito/painel', $dados);
        $this->load->view('restrito/acessoria/index');
        $this->load->view('restrito/acessoria/servicos', $array);
        $this->load->view('restrito/footer');
    }

    public function categorias() {
        $dados = array(
            'header' => 'Gerenciamento de acessoria'
        );
        $this->load->model('ac_categoria_m');

        $categ = $this->ac_categoria_m->getAllCategs();

        $array = array(
            "categorias" => $categ
        );

        $this->load->view('restrito/painel', $dados);
        $this->load->view('restrito/acessoria/index');
        $this->load->view('restrito/acessoria/categorias', $array);
        $this->load->view('restrito/footer');
    }

    public function servico_novo() {
        $dados = array(
            'header' => 'Gerenciamento de acessoria'
        );

        $this->load->model('ac_categoria_m');

        $categ = $this->ac_categoria_m->getAllCategs();

        $array = array(
            "categorias" => $categ
        );


        $this->load->view('restrito/painel', $dados);
        $this->load->view('restrito/acessoria/index');
        $this->load->view('restrito/acessoria/servico_novo', $array);
        $this->load->view('restrito/footer');
    }

    public function servico_editar($id) {
        $dados = array(
            'header' => 'Gerenciamento de acessoria'
        );

        $this->load->model('ac_servicos_m');
        $this->load->model('ac_categoria_m');

        $serv = $this->ac_servicos_m->getServico($id);
        $categ = $this->ac_categoria_m->getAllCategs();

        $array = array(
            "servico" => $serv,
            "categorias" => $categ
        );


        $this->load->view('restrito/painel', $dados);
        $this->load->view('restrito/acessoria/index');
        $this->load->view('restrito/acessoria/servico_editar', $array);
        $this->load->view('restrito/footer');
    }

    public function serv_novo_submit() {
        if ($this->input->post('categoria') && $this->input->post('nome')) {
            $categ = $this->input->post('categoria');

            $nome = $this->input->post('nome');
            $desc_curta = $this->input->post('desc_curta');
            $desc_completa = $this->input->post('desc_completa');
            $estilo = $this->input->post('estilo');

            $config1['upload_path'] = FCPATH . 'uploads/acessoria/servico';
            $config1['allowed_types'] = 'gif|jpg|png';
            $config1['max_size'] = 0;

            $config['upload_path'] = FCPATH . 'uploads/acessoria/grades';
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = 0;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('arquivo')) {
                $arquivo = NULL;
            } else {
                $arquivo = $this->upload->data('file_name');
            }

            $this->upload->initialize($config1);
            if (!$this->upload->do_upload('selo')) {
                $selo = NULL;
            } else {
                $selo = $this->upload->data('file_name');
            }

            $data['categoria'] = $categ;
            $data['nome'] = $nome;
            $data['desc_curta'] = $desc_curta;
            $data['desc_completa'] = $desc_completa;
            $data['estilo'] = $estilo;
            $data['arquivo'] = $arquivo;
            $data['selo'] = $selo;

            $this->load->model('ac_servicos_m');

            $id_servico = $this->ac_servicos_m->insert($data);
            if ($id_servico > 0) {
                $this->session->set_flashdata('success', 'Serviço cadastrado com sucesso!');
                redirect('acessoria_painel/servico_editar/' . $id_servico);
            } else {
                $this->session->set_flashdata('error', 'Erro ao inserir serviço no Banco de dados!');
                redirect('acessoria_painel/servico_novo');
            }
        } else {
            $this->session->set_flashdata('error', 'Campos nome e categoria são obrigatórios!');
            redirect('acessoria_painel/servico_novo');
        }
    }

    public function serv_editar_submit() {
        if ($this->input->post('id_servico') && $this->input->post('nome')) {

            $id_servico = $this->input->post('id_servico');
            $categ = $this->input->post('categoria');
//$categ = $this->input->post('categ');
            $nome_prod_pt = $this->input->post('nome');
            $desc_curta_pt = $this->input->post('desc_curta');
            $desc_longa_pt = $this->input->post('desc_completa');
            $estilo = $this->input->post('estilo');

            $config1['upload_path'] = FCPATH . 'uploads/acessoria/servico';
            $config1['allowed_types'] = 'gif|jpg|png';
            $config1['max_size'] = 0;

            $config['upload_path'] = FCPATH . 'uploads/acessoria/grades';
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = 0;

            $this->load->library('upload', $config);

            $this->load->model('ac_servicos_m');
            $serv = $this->ac_servicos_m->getServico($id_servico);

            if ($_FILES['arquivo']['size'] == 0 && $_FILES['arquivo']['error'] == 4) {
                // cover_image is empty (and not an error)

                $arquivo = $serv->arquivo;
            } else {
                if (!$this->upload->do_upload('arquivo')) {
                    $this->session->set_flashdata('unchecked', '<strong>ATENÇÃO!</strong> Erro ao carregar arquivo, veifique e tente novamente.');
                    redirect('acessoria_painel/servico_editar/' . $id_servico);
                } else {
                    $arquivo = $this->upload->data('file_name');
                    if (is_file(FCPATH . 'uploads/acessoria/grades/' . $serv->arquivo)) {
                        unlink(FCPATH . 'uploads/acessoria/grades/' . $serv->arquivo);
                    }
                }
            }

            if ($_FILES['selo']['size'] == 0 && $_FILES['selo']['error'] == 4) {
                // cover_image is empty (and not an error)

                $selo = $serv->selo;
            } else {
                $this->upload->initialize($config1);
                if (!$this->upload->do_upload('selo')) {
                    $this->session->set_flashdata('unchecked', '<strong>ATENÇÃO!</strong> Erro ao carregar selo, veifique e tente novamente.');
                    redirect('acessoria_painel/servico_editar/' . $id_servico);
                } else {
                    $selo = $this->upload->data('file_name');
                    if (is_file(FCPATH . 'uploads/acessoria/servico/' . $serv->selo)) {
                        unlink(FCPATH . 'uploads/acessoria/servico/' . $serv->selo);
                    }
                }
            }



            $data['nome'] = $nome_prod_pt;
            $data['desc_curta'] = $desc_curta_pt;
            $data['desc_completa'] = $desc_longa_pt;
            $data['categoria'] = $categ;
            $data['estilo'] = $estilo;
            $data['arquivo'] = isset($arquivo) ? $arquivo : NULL;
            $data['selo'] = $selo;

            if ($this->ac_servicos_m->updateServ($id_servico, $data)) {
                $this->session->set_flashdata('success', 'Serviço editado com sucesso!');
                redirect('acessoria_painel/servico_editar/' . $id_servico);
            } else {
                $this->session->set_flashdata('error', 'Erro ao editar serviço! Verifique os campos digitados.');
                redirect('acessoria_painel/servico_editar/' . $id_servico);
            }
        } else {
            $this->session->set_flashdata('error', 'Erro ao editar serviço! Verifique os campos digitados.');
            redirect('acessoria_painel/servico_editar/' . $id_servico);
        }
    }

    public function servico_excluir() {
        if ($this->input->post('id')) {
            $id = $this->input->post('id');

            $this->load->model('ac_servicos_m');
            //$this->load->model('ac_servicos_img_m');

            $serv = $this->ac_servicos_m->getServico($id);
            //$imagens = $this->ac_servicos_img_m->getImagens($id);

            if ($this->ac_servicos_m->remove($id)) {
                //foreach ($imagens as $img) {
                unlink(FCPATH . 'uploads/acessoria/servico/' . $serv->selo);
                // unlink(FCPATH . 'uploads/acessoria/servico/thumbs/' . $img->path);
                //}
                if ($serv->arquivo != NULL) {
                    unlink(FCPATH . 'uploads/acessoria/grades/' . $serv->arquivo);
                }
//unlink(FCPATH . 'uploads/produtos/thumbs/' . $produto->grade_curso_pt);
                echo json_encode(array('msg' => TRUE));
            } else {
                echo json_encode(array('msg' => FALSE));
            }
        } else {
            echo json_encode(array('msg' => FALSE));
        }
    }

    public function categ_novo_submit() {
        if ($this->input->post('categoria')) {
            $nome_categ = $this->input->post('categoria');

            $config['upload_path'] = FCPATH . 'uploads/acessoria/categoria';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 0;

            $config1['upload_path'] = FCPATH . 'uploads/acessoria/categoria/home';
            $config1['allowed_types'] = 'gif|jpg|png';
            $config1['max_size'] = 0;
            
            $this->load->library('upload', $config);

            if ($_FILES['banner']['size'] != 0 && $_FILES['banner']['error'] != 4) {
                if (!$this->upload->do_upload('banner')) {
                    $this->session->set_flashdata('error', '<strong>ATENÇÃO!</strong> Erro ao carregar banner da categoria.');
                    redirect(site_url('acessoria_painel/categoria_novo'));
                } else {
                    $banner = $this->upload->data('file_name');
                }
            }
            
            if ($_FILES['banner_home']['size'] != 0 && $_FILES['banner_home']['error'] != 4) {
                $this->upload->initialize($config1);
                if (!$this->upload->do_upload('banner_home')) {
                    $this->session->set_flashdata('error', '<strong>ATENÇÃO!</strong> Erro ao carregar logo da categoria.');
                    redirect(site_url('acessoria_painel/categoria_novo'));
                } else {
                    $banner_home = $this->upload->data('file_name');
                }
            }
            $categ = array(
                'nome' => $nome_categ,
                'banner' => $banner,
                'banner_home' => $banner_home
            );

            $this->load->model('ac_categoria_m');
            if ($this->ac_categoria_m->insert($categ)) {
                $this->session->set_flashdata('success', 'Categoria cadastrada com sucesso.');
                redirect(site_url('acessoria_painel/categorias'));
            } else {
                $this->session->set_flashdata('error', '<strong>ERRO!</strong> Erro ao cadastrar categoria no banco de dados.');
                redirect(site_url('acessoria_painel/categoria_novo'));
            }
        } else {
//erro, não pode cadastrar categoria sem nome
            $this->session->set_flashdata('error', '<strong>ERRO!</strong> Preencha o nome da categoria.');
            redirect(site_url('acessoria_painel/categoria_novo'));
        }
    }

    public function categoria_novo() {
        $dados = array(
            'header' => 'Gerenciamento de acessoria'
        );

        $this->load->view('restrito/painel', $dados);
        $this->load->view('restrito/acessoria/index');
        $this->load->view('restrito/acessoria/categ_novo');
        $this->load->view('restrito/footer');
    }

    public function categoria_editar($id) {
        $this->load->model('ac_categoria_m');

        $dados = array(
            'header' => 'Gerenciamento de acessoria'
        );

        $categ = $this->ac_categoria_m->getCateg($id);

        $array = array(
            "categoria" => $categ
        );

        $this->load->view('restrito/painel', $dados);
        $this->load->view('restrito/acessoria/index');
        $this->load->view('restrito/acessoria/categ_editar', $array);
        $this->load->view('restrito/footer');
    }

    public function categ_editar_submit() {
        if ($this->input->post('id_categ')) {
            $id_categ = $this->input->post('id_categ');
            $nome_categ = $this->input->post('categoria');

            $config['upload_path'] = FCPATH . 'uploads/acessoria/categoria';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 0;
            
            $config1['upload_path'] = FCPATH . 'uploads/acessoria/categoria/home';
            $config1['allowed_types'] = 'gif|jpg|png';
            $config1['max_size'] = 0;

            $this->load->library('upload', $config);
            $this->load->model('ac_categoria_m');
            $categ = $this->ac_categoria_m->getCateg($id_categ);

            $dados = array();
            if ($_FILES['banner']['size'] != 0 && $_FILES['banner']['error'] != 4) {
                if (!$this->upload->do_upload('banner')) {
                    $this->session->set_flashdata('error', '<strong>ATENÇÃO!</strong> Erro ao carregar banner da categoria.');
                    redirect(site_url('acessoria_painel/categoria_editar/' . $id_categ));
                } else {
                    $dados['banner'] = $this->upload->data('file_name');
                    if (is_file(FCPATH . 'uploads/acessoria/categoria/' . $categ->banner)) {
                        unlink(FCPATH . 'uploads/acessoria/categoria/' . $categ->banner);
                    }
                }
            }
            
            if ($_FILES['banner_home']['size'] != 0 && $_FILES['banner_home']['error'] != 4) {
                $this->upload->initialize($config1);
                if (!$this->upload->do_upload('banner_home')) {
                    $this->session->set_flashdata('error', '<strong>ATENÇÃO!</strong> Erro ao carregar logo da categoria.');
                    redirect(site_url('acessoria_painel/categoria_editar/' . $id_categ));
                } else {
                    $dados['banner_home'] = $this->upload->data('file_name');
                    if (is_file(FCPATH . 'uploads/acessoria/categoria/home/' . $categ->banner_home)) {
                        unlink(FCPATH . 'uploads/acessoria/categoria/home/' . $categ->banner_home);
                    }
                }
            }
            
            $dados['nome'] = $nome_categ;

            $this->load->model('ac_categoria_m');
            if ($this->ac_categoria_m->update($id_categ, $dados)) {
                $this->session->set_flashdata('success', 'Categoria editada com sucesso.');
                redirect(site_url('acessoria_painel/categorias'));
            } else {
                $this->session->set_flashdata('error', '<strong>ERRO!</strong> Erro ao editar categoria no banco de dados.');
                redirect(site_url('acessoria_painel/categoria_editar/' . $id_categ));
            }
        } else {
//erro, não pode cadastrar categoria sem nome
            $this->session->set_flashdata('error', '<strong>ERRO!</strong> Preencha o nome da categoria.');
            redirect(site_url('acessoria_painel/categoria_editar/' . $id_categ));
        }
    }

    public function categ_excluir() {
        if ($this->input->post('id')) {
            $id = $this->input->post('id');

            $this->load->model('ac_categoria_m');

            $categ = $this->ac_categoria_m->getCateg($id);

            if ($this->ac_categoria_m->remove($id)) {
                if (is_file(FCPATH . 'uploads/acessoria/categoria/' . $categ->banner)) {
                    unlink(FCPATH . 'uploads/acessoria/categoria/' . $categ->banner);
                }
                if (is_file(FCPATH . 'uploads/acessoria/categoria/home/' . $categ->banner_home)) {
                    unlink(FCPATH . 'uploads/acessoria/categoria/home/' . $categ->banner_home);
                }
                echo json_encode(array('msg' => TRUE));
            } else {
                echo json_encode(array('msg' => FALSE));
            }
        } else {
            echo json_encode(array('msg' => FALSE));
        }
    }

    public function do_upload() {
        $upload_path_url = base_url() . 'uploads/acessoria/servico/';

        $config['upload_path'] = FCPATH . 'uploads/acessoria/servico/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = '60000';

        $this->load->library('upload', $config);
        $id = $this->input->post('id_produto');
        $this->load->model('ac_servicos_img_m');
        $this->load->model('ac_servicos_m');
        if (!$this->upload->do_upload()) {
            $imgs = $this->ac_servicos_img_m->getImagens($id);
//print_r($imgs);
//$error = array('error' => $this->upload->display_errors());
//$this->load->view('upload', $error);
//Load the list of existing files in the upload directory
            $existingFiles = get_dir_file_info($config['upload_path']);
            $foundFiles = array();
            $f = 0;
            foreach ($imgs as $img) {
                foreach ($existingFiles as $fileName => $info) {
                    if ($fileName != 'thumbs') {//Skip over thumbs directory
//set the data for the json array  
                        if ($img->path == $fileName) {
                            $foundFiles[$f]['id'] = $img->id;
                            $foundFiles[$f]['name'] = $fileName;
                            $foundFiles[$f]['size'] = $info['size'];
                            $foundFiles[$f]['url'] = $upload_path_url . $fileName;
                            $foundFiles[$f]['thumbnailUrl'] = $upload_path_url . 'thumbs/' . $fileName;
                            $foundFiles[$f]['deleteUrl'] = base_url() . 'index.php/acessoria_painel/deleteImage/' . $fileName . '/' . $id;
                            $foundFiles[$f]['deleteType'] = 'DELETE';
                            $foundFiles[$f]['error'] = null;

                            $f++;
                        }
                    }
                }
            }

            $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(array('files' => $foundFiles)));
        } else {
            $data = $this->upload->data();
            /*
             * Array
              (
              [file_name] => png1.jpg
              [file_type] => image/jpeg
              [file_path] => /home/ipresupu/public_html/uploads/
              [full_path] => /home/ipresupu/public_html/uploads/png1.jpg
              [raw_name] => png1
              [orig_name] => png.jpg
              [client_name] => png.jpg
              [file_ext] => .jpg
              [file_size] => 456.93
              [is_image] => 1
              [image_width] => 1198
              [image_height] => 1166
              [image_type] => jpeg
              [image_size_str] => width="1198" height="1166"
              )
             */
// to re-size for thumbnail images un-comment and set path here and in json array
            $config = array();
            $config['image_library'] = 'gd2';
            $config['source_image'] = $data['full_path'];
            $config['create_thumb'] = TRUE;
            $config['new_image'] = $data['file_path'] . 'thumbs/';
            $config['maintain_ratio'] = TRUE;
            $config['thumb_marker'] = '';
            $config['width'] = 75;
            $config['height'] = 50;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();


//set the data for the json array
            $info = new StdClass;
            $info->name = $data['file_name'];
            $info->size = $data['file_size'] * 1024;
            $info->type = $data['file_type'];
            $info->url = $upload_path_url . $data['file_name'];
// I set this to original file since I did not create thumbs.  change to thumbnail directory if you do = $upload_path_url .'/thumbs' .$data['file_name']
            $info->thumbnailUrl = $upload_path_url . 'thumbs/' . $data['file_name'];
            $info->deleteUrl = base_url() . 'index.php/acessoria_painel/deleteImage/' . $data['file_name'] . '/' . $id;
            $info->deleteType = 'DELETE';
            $info->error = null;




            $array = array('id_servico' => $id, 'path' => $data['file_name'], 'order' => $this->ac_servicos_img_m->getCountImagens($id));
            $img_id = $this->ac_servicos_img_m->insert($array);
            $info->id = $img_id;
            $files[] = $info;
//this is why we put this in the constants to pass only json data
//
            //$produto = $this->produtos_m->getProdutoDetail($id);
//if (is_null($produto->imagem) || $produto->imagem == "") {
//     $this->produtos_m->updateImg($id, $data['file_name']);
// }
            if ($this->input->is_ajax_request()) {
                echo json_encode(array("files" => $files));
//this has to be the only data returned or you will get an error.
//if you don't give this a json array it will give you a Empty file upload result error
//it you set this without the if(IS_AJAX)...else... you get ERROR:TRUE (my experience anyway)
// so that this will still work if javascript is not enabled
            } else {
                $file_data['upload_data'] = $this->upload->data();
                $this->load->view('upload/upload_success', $file_data);
            }
        }
    }

    public function deleteImage($file, $id) {//gets the job done but you might want to add error checking and security
        $success = unlink(FCPATH . 'uploads/acessoria/servico/' . $file);
        $success = unlink(FCPATH . 'uploads/acessoria/servico/thumbs/' . $file);
//info to see if it is doing what it is supposed to
        $info = new StdClass;
        $info->sucess = $success;
        $info->path = base_url() . 'uploads/acessoria/servico/' . $file;
        $info->file = is_file(FCPATH . 'uploads/acessoria/servico/' . $file);

        $this->load->model('ac_servicos_img_m');
        $this->ac_servicos_img_m->delete($id, $file);


        if ($this->input->is_ajax_request()) {
//I don't think it matters if this is set but good for error checking in the console/firebug
            echo json_encode(array($info));
        } else {
//here you will need to decide what you want to show for a successful delete        
            $file_data['delete_data'] = $file;
            $this->load->view('admin/delete_success', $file_data);
        }
    }

}
