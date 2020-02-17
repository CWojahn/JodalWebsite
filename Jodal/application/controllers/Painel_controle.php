<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of painel_controle
 *
 * @author Iuri
 */
class Painel_controle extends CI_Controller {

    //put your code here
//put your code here
    function __construct() {
        parent::__construct();
        
        //ini_set('default_charset', 'UTF-8');

        if (!$this->session->userdata('logged_in')) {
            redirect('acesso_restrito');
        }
    }

    public function index() {
        //echo 'Painel de controle';
        $dados = array(
            'header' => 'Painel de Controle',
            'body' => 'Utilize o menu superior para gerenciar as informações do site'
        );
        $this->load->view('restrito/painel', $dados);
        $this->load->view('restrito/footer');
        
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('painel_controle');
    }

    /*public function upload() {
        $output_dir = "img/";
        //echo $output_dir;
        if (isset($_FILES["myfile"])) {
            $ret = array();

//	This is for custom errors;	
            /* 	$custom_error= array();
              $custom_error['jquery-upload-file-error']="File already exists";
              echo json_encode($custom_error);
              die();
             */
        /*    $error = $_FILES["myfile"]["error"];
            //You need to handle  both cases
            //If Any browser does not support serializing of multiple files using FormData() 
            if (!is_array($_FILES["myfile"]["name"])) { //single file
                $fileName = $_FILES["myfile"]["name"];
                move_uploaded_file($_FILES["myfile"]["tmp_name"], $output_dir . $fileName);
                $ret[] = $fileName;
            } else {  //Multiple files, file[]
                $fileCount = count($_FILES["myfile"]["name"]);
                for ($i = 0; $i < $fileCount; $i++) {
                    $fileName = $_FILES["myfile"]["name"][$i];
                    move_uploaded_file($_FILES["myfile"]["tmp_name"][$i], $output_dir . $fileName);
                    $ret[] = $fileName;
                }
            }
            echo json_encode($ret);
        }
    }*/

}
