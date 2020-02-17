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
class Empresa_painel extends CI_Controller {

    //put your code here
    function __construct() {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('acesso_restrito');
        }
    }

    public function index() {
        $dados = array(
            'header' => 'Controle da página Empresa'
        );

        $this->load->model('empresa_m');
        $empresa = $this->empresa_m->get()->row();
        $array['empresa'] = $empresa;

        $this->load->view('restrito/painel', $dados);
        $this->load->view('restrito/empresa/novo', $array);
        $this->load->view('restrito/footer');
    }

    public function salvar() {

        $nome = $this->input->post('nome');
        $endereco = $this->input->post('endereco');
        $telefone = $this->input->post('telefone');
        $email = $this->input->post('email');
        $descricao = $this->input->post('descricao');

        $array = array();

        if ($this->input->post('nome')) {
            $array['nome'] = $this->input->post('nome');
        } else {
            $array['nome'] = NULL;
        }
        if ($this->input->post('endereco')) {
            $array['endereco'] = $this->input->post('endereco');
        } else {
            $array['endereco'] = NULL;
        }
        if ($this->input->post('telefone')) {
            $array['telefone'] = $this->input->post('telefone');
        } else {
            $array['telefone'] = NULL;
        }
        if ($this->input->post('email')) {
            $array['email'] = $this->input->post('email');
        } else {
            $array['email'] = NULL;
        }
        if ($this->input->post('descricao')) {
            $array['descricao'] = $this->input->post('descricao');
        } else {
            $array['descricao'] = NULL;
        }

        $this->load->model('empresa_m');

        if ($this->empresa_m->update($array)) {
            //$this->index($array);
            $this->session->set_flashdata('success', 'Dados da empresa editados com sucesso!');
            redirect(site_url('empresa_painel'));
        } else {
            $this->session->set_flashdata('error', 'Erro ao editar dados da empresa, tente novamente.');
            redirect(site_url('empresa_painel'));
        }
    }

    function do_upload() {
        $upload_path_url = base_url() . 'uploads/empresa/';

        $config['upload_path'] = FCPATH . 'uploads/empresa/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = '60000';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            //$error = array('error' => $this->upload->display_errors());
            //$this->load->view('upload', $error);
            //Load the list of existing files in the upload directory
            $existingFiles = get_dir_file_info($config['upload_path']);
            $foundFiles = array();
            $f = 0;
            foreach ($existingFiles as $fileName => $info) {
                if ($fileName != 'thumbs') {//Skip over thumbs directory
                    //set the data for the json array   
                    $foundFiles[$f]['name'] = $fileName;
                    $foundFiles[$f]['size'] = $info['size'];
                    $foundFiles[$f]['url'] = $upload_path_url . $fileName;
                    $foundFiles[$f]['thumbnailUrl'] = $upload_path_url . 'thumbs/' . $fileName;
                    $foundFiles[$f]['deleteUrl'] = base_url() . 'index.php/empresa_painel/deleteImage/' . $fileName;
                    $foundFiles[$f]['deleteType'] = 'DELETE';
                    $foundFiles[$f]['error'] = null;

                    //print_r($foundFiles[$f]['deleteUrl']);
                    $f++;
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
            $info->deleteUrl = base_url() . 'index.php/empresa_painel/deleteImage/' . $data['file_name'];
            $info->deleteType = 'DELETE';
            $info->error = null;

            $this->load->model('empresa_m');
            $imagem_empresa = array('imagem' => $data['file_name']);
            $this->empresa_m->insert_img($imagem_empresa);

            $files[] = $info;
            //this is why we put this in the constants to pass only json data
            if (IS_AJAX) {
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

    public function deleteImage($file) {//gets the job done but you might want to add error checking and security
        $success = unlink(FCPATH . 'uploads/empresa/' . $file);
        $success = unlink(FCPATH . 'uploads/empresa/thumbs/' . $file);
        //info to see if it is doing what it is supposed to
        $info = new StdClass;
        $info->sucess = $success;
        $info->path = base_url() . 'uploads/empresa/' . $file;
        $info->file = is_file(FCPATH . 'uploads/empresa/' . $file);

        $this->load->model('empresa_m');
        $this->slides_m->delete_img($file);

        /* if (IS_AJAX) {
          //I don't think it matters if this is set but good for error checking in the console/firebug
          echo json_encode(array($info));
          } else {
          //here you will need to decide what you want to show for a successful delete
          $file_data['delete_data'] = $file;
          $this->load->view('admin/delete_success', $file_data);
          } */
        redirect(site_url('empresa_painel'));
    }

}
