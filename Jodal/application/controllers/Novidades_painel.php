<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of servicos_painel
 *
 * @author iuri.londero
 */
class Novidades_painel extends CI_Controller {

    //put your code here
    function __construct() {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('acesso_restrito');
        }
    }

    public function index() {
        $dados = array(
            'header' => 'Gerenciamento de Novidades do site'
        );

        $this->load->model('novidades_m');
        $artigos = $this->novidades_m->getArtigos();

        $array['artigos'] = $artigos;

        $this->load->view('restrito/painel', $dados);
        //$this->load->view('restrito/artigos/index');
        $this->load->view('restrito/novidades/artigos', $array);
        $this->load->view('restrito/footer');
    }

    public function artigo_novo() {
        $dados = array(
            'header' => 'Gerenciamento de novidades do site'
        );

        $this->load->view('restrito/painel', $dados);
        $this->load->view('restrito/novidades/artigo_novo');
        $this->load->view('restrito/footer');
    }

    public function submit() {
        if ($this->input->post('nome') && $this->input->post('desc_completa')) {

            //$tipo = $this->input->post('tipo');
            $nome = $this->input->post('nome');
            $desc_curta = $this->input->post('desc_curta');
            $desc_completa = $this->input->post('desc_completa');
            //$arquivo = $this->input->post('arquivo');
            //$file = $this->input->post('file');

            

            $data = array(
                'nome' => $nome,
                'desc_curta' => $desc_curta,
                'desc_completa' => $desc_completa
            );

            $this->load->model('novidades_m');

            //print_r($data);
            $id_artigo = $this->novidades_m->insert($data);
            if ($id_artigo > 0) {
                //echo json_encode(array('msg' => TRUE, 'id' => $id_artigo));
                $this->session->set_flashdata('success', 'Novidade salva com sucesso! Insira as imagens da novidade na parte inferior do site.');
                redirect('novidades_painel/artigo_editar/' . $id_artigo);
            } else {
                $this->session->set_flashdata('error', 'Erro ao inserir novidade no banco de dados.');
                redirect('novidades_painel/artigo_novo');
            }
        } else {
            $this->session->set_flashdata('error', 'Erro ao salvar novidade, verifique se os campos nome e texto da novidade foram preenchidos.');
            redirect('novidades_painel/artigo_novo');
        }
    }

    public function artigo_editar($id_artigo) {
        $dados = array(
            'header' => 'Gerenciamento de novidades do site'
        );

        $this->load->model('novidades_m');

        $categs['id_artigo'] = $id_artigo;
        $categs['artigo'] = $this->novidades_m->getArtigoDetail($id_artigo);


        $this->load->view('restrito/painel', $dados);
        $this->load->view('restrito/novidades/artigo_editar', $categs);
        $this->load->view('restrito/footer');
    }

    public function submit_editar() {
        $id_artigo = $this->input->post('id_artigo');

        if ($this->input->post('nome') && $this->input->post('desc_completa')) {

            $nome = $this->input->post('nome');
            $desc_curta = $this->input->post('desc_curta');
            $desc_completa = $this->input->post('desc_completa');
            
            $this->load->model('novidades_m');
            
            $data['nome'] = $nome;
            $data['desc_curta'] = $desc_curta;
            $data['desc_completa'] = $desc_completa;

            //print_r($data);
            if ($this->novidades_m->updateArtigo($id_artigo, $data)) {
                $this->session->set_flashdata('success', 'Novidade editada com sucesso!');
                redirect('novidades_painel/artigo_editar/' . $id_artigo);
            } else {
                $this->session->set_flashdata('error', 'Erro ao editar novidade! Verifique os campos digitados.');
                redirect('novidades_painel/artigo_editar/' . $id_artigo);
            }
        } else {
            $this->session->set_flashdata('error', 'Erro ao editar novidade!');
            redirect('novidades_painel/artigo_editar/' . $id_artigo);
        }
    }

    public function artigo_excluir() {
        if ($this->input->post('id')) {
            $id = $this->input->post('id');

            $this->load->model('novidades_m');
            $this->load->model('novidades_img_m');

            $imagens = $this->novidades_img_m->getImagens($id);

            if ($this->novidades_m->delete($id)) {
                foreach ($imagens as $img) {
                    unlink(FCPATH . 'uploads/novidades/' . $img->path);
                    unlink(FCPATH . 'uploads/novidades/thumbs/' . $img->path);
                }
                //unlink(FCPATH . 'uploads/produtos/' . $produto->selo_pt);
                //unlink(FCPATH . 'uploads/produtos/thumbs/' . $produto->grade_curso_pt);
                echo json_encode(array('msg' => TRUE));
            } else {
                echo json_encode(array('msg' => FALSE));
            }
        } else {
            echo json_encode(array('msg' => FALSE));
        }
    }

    public function do_upload() {
        $upload_path_url = base_url() . 'uploads/novidades/';

        $config['upload_path'] = FCPATH . 'uploads/novidades/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = '60000';

        $this->load->library('upload', $config);
        $id = $this->input->post('id_artigo');
        $this->load->model('novidades_img_m');
        $this->load->model('novidades_m');
        if (!$this->upload->do_upload()) {
            $imgs = $this->novidades_img_m->getImagens($id);
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
                            $foundFiles[$f]['deleteUrl'] = base_url() . 'index.php/novidades_painel/deleteImage/' . $fileName . '/' . $id;
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
            $info->deleteUrl = base_url() . 'index.php/novidades_painel/deleteImage/' . $data['file_name'] . '/' . $id;
            $info->deleteType = 'DELETE';
            $info->error = null;




            $array = array('id_novidade' => $id, 'path' => $data['file_name'], 'order' => $this->novidades_img_m->getCountImagens($id));
            $img_id = $this->novidades_img_m->insert($array);
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
        $success = unlink(FCPATH . 'uploads/novidades/' . $file);
        $success = unlink(FCPATH . 'uploads/novidades/thumbs/' . $file);
        //info to see if it is doing what it is supposed to
        $info = new StdClass;
        $info->sucess = $success;
        $info->path = base_url() . 'uploads/novidades/' . $file;
        $info->file = is_file(FCPATH . 'uploads/novidades/' . $file);

        $this->load->model('novidades_img_m');
        $this->novidades_img_m->delete($id, $file);


        if ($this->input->is_ajax_request()) {
            //I don't think it matters if this is set but good for error checking in the console/firebug
            echo json_encode(array($info));
        } else {
            //here you will need to decide what you want to show for a successful delete        
            $file_data['delete_data'] = $file;
            $this->load->view('admin/delete_success', $file_data);
        }
    }

    public function order_imgs() {

        $ids = $this->input->post("sectionsid");
        //print_r($ids);
        //$order = array();
        foreach ($ids as $key => $value) {
            $order[] = array(
                "id" => $value,
                "order" => $key
            );
        }
        $this->load->model("novidades_img_m");

        $this->novidades_img_m->update_order($order);

        print_r($order);
    }
    
    public function destaques() {
        $this->load->model('novidades_m');
        $dados = array(
            'header' => 'Controle de novidades em destaque'
        );

        $servicos = $this->novidades_m->getArtigos();

        $result_destaque = $this->novidades_m->getRestritoDestaques();

        $data = array('artigos_disp' => $servicos, 'artigos_dest' => $result_destaque);

        $this->load->view('restrito/painel', $dados);
        $this->load->view('restrito/novidades/destaques', $data);
        $this->load->view('restrito/footer');
    }

    public function set_destaque() {
        $id = $this->input->post("id");
        $data = array(
            'destaque' => TRUE
        );

        $this->load->model('novidades_m');

        if ($this->novidades_m->updateArtigo($id, $data)) {

            $result_destaque = $this->novidades_m->getRestritoDestaques();
            $data = array('artigos_dest' => $result_destaque);
            $this->load->view('restrito/novidades/art_destaques', $data);
        } else {
            echo 'destaque';
        }
    }

    public function remove_destaque() {
        $id = $this->input->post("id");
        $data = array(
            'destaque' => FALSE
        );

        $this->load->model('novidades_m');

        if ($this->novidades_m->updateArtigo($id, $data)) {

            $result_destaque = $this->novidades_m->getRestritoDestaques();
            $data = array('artigos_dest' => $result_destaque);
            $this->load->view('restrito/novidades/art_destaques', $data);
        } else {
            echo 'destaque';
        }
    }

}
