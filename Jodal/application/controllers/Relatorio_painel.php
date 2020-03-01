<?php



/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



/**
 *
 * @author Carlos.Wojahn
 */

class Relatorio_painel extends CI_Controller {



    //put your code here

    function __construct() {

        parent::__construct();



        if (!$this->session->userdata('logged_in')) {

            redirect('acesso_restrito');

        }

    }


// ok
    public function index($array = array()) {

        $this->load->model('relatorios_m'); 

        $dados = array(

            'header' => 'Controle de Relatórios'

        );



        //$orcamentos = $this->cotacao_m->getOrcamentos();

        //$certificados = $this->certificado_m->get_all();

        //$array['relatorios'] = $this->relatorios_m->getRelatorios();

        $this->load->view('restrito/painel', $dados);

        $this->load->view('restrito/relatorios/principal', $array);

        $this->load->view('restrito/footer');

    }


// ok
    public function novo() {

        $this->load->model('relatorios_m');
        $this->load->model('clientes_m');

        $dados = array(

            'header' => 'Controle de Relatórios'

        );
        $_SESSION['number'] = 0;

        $clientes = $this->clientes_m->get_all();

        $dados1 = array(

            'clientes' => $clientes

        );

        $this->load->view('restrito/painel', $dados);

        $this->load->view('restrito/relatorios/novo', $dados1);

        $this->load->view('restrito/footer');

    }


// revisar **** */
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

        $this->load->view('restrito/relatorios/editar', $dados1);

        $this->load->view('restrito/footer');

    }
//**** */


// ok
    public function excluir() {

        if ($this->input->post('id')) {

            $id = $this->input->post('id');


            $this->load->model('relatorio_m');

            $result = $this->relatorio_m->getPdfRelatorio($id);


            if (!empty($result->path_pdf)) {

                $file = $result->path_pdf;

                unlink(FCPATH . 'uploads/relatorios/' . $file);

            }

            if ($this->relatorio_m->remove_relatorio($id)) {

                echo json_encode(array('msg' => TRUE));

            } else {

                echo json_encode(array('msg' => FALSE));

            }

        } else {

            echo json_encode(array('msg' => FALSE));

        }

    }


    public function salvarImagens() {

        $config['upload_path'] = FCPATH . 'uploads/relatorios';

        $config['allowed_types'] = 'gif|jpg|png';

        $config['max_size'] = 0;

        $this->load->library('upload', $config);


        $array = array();



        if (!$this->upload->do_upload('imagem')) {

            $this->session->set_flashdata('error', 'Erro ao carregar imagem do relatorio, tente novamente.');

            redirect(site_url('relatorio_painel/novo'));

        } else {

            $imagem = $this->upload->data('file_name');

            $descricao = $this->input->post('descricao');


            $array['imagem'] = $imagem;


            $array['descricao'] = $descricao;


            $this->load->model('relatorios_m');

            if ($this->relatorios_m->insert($array)) {

                //$this->index($array);

                $this->session->set_flashdata('success', '|Imagem adicionada com sucesso!');

                redirect(site_url('relatorios_painel'));

            } else {

                $this->session->set_flashdata('error', 'Erro ao salvar nova imagem, tente novamente.');

                redirect(site_url('relatorios_painel/novo'));

            }

        }

    }


    public function salvar() {
        $dados = array(
            'id_cliente' => $this->input->post('cliente'),
            'obra' => $this->input->post('obra'),
            'data' => $this->input->post('data'),
            'local' => $this->input->post('local'),
            'tst_name' => $this->input->post('tst'),
            'observacoes' => $this->input->post('obs'),
        );

        $this->load->model('relatorios_m');
        $this->relatorios_m->insert($dados);
        // if ($this->input->post('dados')){
        //     //$relatorio= json_decode($relatorio);
        //     //$this->relatorios_m->insert($dados);
        //     echo TRUE;
        // }
    }


//ver com o fazer o vetor de todas as imagens e observações
    public function salvar_edit() {


        $numero = $this->input->post('numero');

        $clienteid = $this->input->post('clienteid');

        $obra = $this->input->post('obra');

        $cidade = $this->input->post('cidade');

        $tst = $this->input->post('tst');
    }



    public function carregar_header() {
        $id_cliente = $this->input->post('id');
        $tipo_relatorio = $this->input->post('tipo');
        //console.log($id_cliente, $tipo_relatorio);

        $this->load->model('clientes_m');
        $this->load->model('relatorios_m');

        $nro_relatorio = $this->relatorios_m->getNroRelatorio()->nro_relatorio;
        $nro_relatorio = $nro_relatorio + 1;

        $dados = array(
            'sel_cliente' => $this->clientes_m->get_cliente($id_cliente)->row(),
            'nro_relatorio' => $nro_relatorio,
            'data' => date('Y-m-d')
        );

        if ($tipo_relatorio == 0){
            $this->load->view('restrito/relatorios/header_pcmat', $dados);
            $this->load->view('restrito/relatorios/novo_pcmat', $dados);
        } elseif ($tipo_relatorio ==1) {
            $this->load->view('restrito/relatorios/header_ris', $dados);
        } elseif ($tipo_relatorio ==2) {
            $this->load->view('restrito/relatorios/header_apr', $dados);
        } elseif ($tipo_relatorio ==3) {
            $this->load->view('restrito/relatorios/header_dst', $dados);
        }
    }


    public function acrescentar_imagem(){

        $upload_path_url = base_url() . 'uploads/relatorios/';



        $config['upload_path'] = FCPATH . 'uploads/relatorios/';

        $config['allowed_types'] = 'jpg|jpeg|png|gif';

        $config['max_size'] = '60000';


        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {

            $existingFiles = get_dir_file_info($config['upload_path']);

            $foundFiles = array();

            $f = 0;

            foreach ($existingFiles as $fileName => $info) {

                if ($fileName != 'thumbs') {

                    $foundFiles[$f]['name'] = $fileName;

                    $foundFiles[$f]['size'] = $info['size'];

                    $foundFiles[$f]['url'] = $upload_path_url . $fileName;

                    $foundFiles[$f]['thumbnailUrl'] = $upload_path_url . 'thumbs/' . $fileName;

                    $foundFiles[$f]['error'] = null;

                    $f++;

                }

            }

            $this->output

                    ->set_content_type('application/json')

                    ->set_output(json_encode(array('files' => $foundFiles)));

        } else {

            $data = $this->upload->data();

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

            $info->error = null;

            if (IS_AJAX) {

                echo json_encode(array("files" => $files));
            } else {

                $file_data['upload_data'] = $this->upload->data();

                $this->load->view('upload/upload_success', $file_data);

            }

        }

    }




    // function do_upload(){
    //     $config['upload_path']= FCPATH . 'uploads/relatorios';
    //     $config['allowed_types']='gif|jpg|png';
    //     $config['encrypt_name'] = TRUE;
         
    //     $this->load->library('upload',$config);

    //     if($this->upload->do_upload('file')){
    //         $data = array('upload_data' => $this->upload->data());
 
    //         $descricao= $this->input->post('descricao');
    //         $image= $data['upload_data']['file_name']; 
             
    //         //$result= $this->load->view('restrito/relatorios/novo_image_table', $descricao, $image, true);
    //         $result= $this->upload_model->save_upload($descricao,$image);
    //         echo json_decode($result);
    //     }
 
    //  }


     function do_upload(){
        $config['upload_path']= FCPATH . 'uploads/relatorios';
        $config['allowed_types']='gif|jpg|png';
        $config['max_size'] = 0;
        $config['encrypt_name'] = TRUE;
         
        $this->load->library('upload', $config);
        $dados1 = array();

        if($this->upload->do_upload('imagem')){

            $imagem = $this->upload->data('file_name');
            $descricao = $this->input->post('descricao');
            $number = $_SESSION['number'];
            $number++;
            $_SESSION['number'] = $number;
            $dados1['imagem'] = $imagem;
            $dados1['descricao'] = $descricao;
            $dados1['ids'] = $number;
            //$result= $this->upload_model->save_upload($title,$image);
            $dados = $this->load->view('restrito/relatorios/novo_image_table', $dados1, true);
            
            
            echo $dados;
            
        }
 
     }


    public function gerar_relatorio() {

        if ($this->input->post('relatorio') &&
            $this->input->post('cliente')) {

            $this->load->model('relatorios_m');
            $this->load->model('clientes_m');


            $id_relatorio = $this->input->post('relatorio');

            $id_cliente = $this->input->post('cliente');

            $count_relatorio = $this->input->post('count_relatorio');

            $nro_relatorio = $this->cotacao_m->getNroRelatorio()->nro_relatorio;

            $nro_relatorio = $nro_relatorio + 1;

            $sel_relatorio = $this->relatorios_m->get_relatorio($id_relatorio)->row();

            $dados = array(

                'sel_cliente' => $this->clientes_m->get_cliente($id_cliente)->row(),

                'sel_relatorio' => $sel_relatorio,
            );

            $result['id_relatorio'] = $sel_relatorio->id;

            $result['page'] = $this->load->view('restrito/relatorios/novo_relatorio', $dados, true);

            $result['msg'] = TRUE;

            echo json_encode($result);
        } else {
            $result['msg'] = FALSE;
            echo json_encode($result);
        }

    }



    public function salvar_relatorio() {

        $this->load->model('relatorios_m');

        $this->load->model('clientes_m');

        $array_obj = $this->input->post('json_relatorio');

        $clienteid = $this->input->post('clienteid');

        $obra = $this->input->post('obra');

        $cidade = $this->input->post('cidade');

        $tst = $this->input->post('tst');

        $array_relatorio = json_decode($array_obj);



        $nro_relatorio = $this->relatorios_m->getNroRelatorio()->nro_relatorio;

        $nro_relatorio = $nro_relatorio + 1;



        for ($index = 0; $index < count($array_relatorio); $index++) {

            $array_relatorio[$index]->id_relatorio = $nro_relatorio;

        }

        $dados_relatorio = array(

            'id' => $nro_relatorio,

            'id_cliente' => $cliente,

            'obra' => $obra,

            'cidade' => $cidade,

            'tst' => $tst,

            'data' => date('Y-m-d'),

            'observacao' => $observ

        );

        $dados_rel1 = new stdClass();

        $dados_rwl1->id = $nro_orc;

        $dados_rel1->id_cliente = $cliente;

        $dados_rel1->obra = $obra;

        $dados_rel1->cidade = $cidade;

        $dados_rel1->tst = $tst;

        $dados_rel1->data = date('Y-m-d');

        $dados_rel1->observacao = $observ;

        



        if ($this->relatorios_m->insert_pcmat($dados_orc, $array_orc)) {



            $array_all = array(

                'array_orc' => $array_orc,

                'orcamento' => $dados_orc1,

                'cliente' => $this->clientes_m->get_cliente($cliente)->row()

            );



            //print_r($array_all);

           $nome_pdf = date('Y-m-d') . "-ORC-" . $nro_orc . ".pdf";

            $pdfFilePath = FCPATH . "uploads/orcamentos/" . $nome_pdf;



            if (file_exists($pdfFilePath) == FALSE) {

                ini_set('memory_limit', '64M'); // boost the memory limit if it's low <img src="http://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley firstChild">

                $html = $this->load->view('restrito/cotacao/pdf_orcamento', $array_all, true); // render the view into HTML



                $this->load->library('pdf');

                $pdf = $this->pdf->load();

                $pdf->SetDisplayMode('fullpage');

                //$img = base_url() .'images/portalwiditec.png';

                //$pdf->SetHTMLHeader('<div><img src="'.$img.'" alt="layout" id="xxx" width="300" height="80"></div>');

                $pdf->SetFooter($_SERVER['HTTP_HOST'] . '|{PAGENO}|' . date(DATE_RFC822)); // Add a footer for good measure <img src="http://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley lastChild">

                //$pdf->SetJS('this.print();');

                $pdf->WriteHTML($html); // write the HTML into the PDF

                $pdf->Output($pdfFilePath, 'F'); // save to file because we can

                //print_r($pdf);

                

                $this->cotacao_m->update($nro_orc, array('path_pdf' => $nome_pdf));

                $this->session->set_flashdata('success', 'Orçamento gerado com sucesso!');

                

                echo TRUE;

            } else {

                echo FALSE;

            }

        } else {

            echo FALSE;

        }

        /* if ($this->input->post('alunos') && $this->input->post('treinamento') && $this->input->post('cliente')) {
          $nro_alunos = $this->input->post('alunos');
          $id_treinam = $this->input->post('treinamento');
          $id_cliente = $this->input->post('cliente');
          $this->load->model('treinamento_m');
          $this->load->model('clientes_m');
          $this->load->model('cotacao_m');
          $treinamento = $this->treinamento_m->get_treinamento($id_treinam)->row();
          $dados = array(
          'sel_treinamento' => $treinamento,
          'nro_alunos' => $nro_alunos
          );
          // As PDF creation takes a bit of memory, we're saving the created file in /downloads/reports/
          $hora = date("H-i-s");
          //$dia = date("d-m-Y", strtotime($data));
          $nome_pdf = "ORC-" . $nro_orc . "-" . date('y') . ".pdf";
          $pdfFilePath = FCPATH . "uploads/orcamentos/" . $nome_pdf;
          //$data['page_title'] = 'RelatÃ³rio'; // pass data to the view
          $orc_bd = array(
          'id' => $nro_orc,
          'id_treinamento' => $id_treinam,
          'id_cliente' => $id_cliente,
          'nro_alunos' => $nro_alunos,
          'custo' => $nro_alunos * $treinamento->valor_aluno,
          'data' => date('Y-m-d'),
          'path_pdf' => $nome_pdf
          );
          if (file_exists($pdfFilePath) == FALSE) {
          ini_set('memory_limit', '64M'); // boost the memory limit if it's low <img src="http://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley firstChild">
          $html = $this->load->view('restrito/cotacao/pdf_orcamento', $dados, true); // render the view into HTML
          $this->cotacao_m->insert_orcamento($orc_bd);
          $this->load->library('pdf');
          $pdf = $this->pdf->load();
          $pdf->SetDisplayMode('fullpage');
          //$img = base_url() .'images/portalwiditec.png';
          //$pdf->SetHTMLHeader('<div><img src="'.$img.'" alt="layout" id="xxx" width="300" height="80"></div>');
          $pdf->SetFooter($_SERVER['HTTP_HOST'] . '|{PAGENO}|' . date(DATE_RFC822)); // Add a footer for good measure <img src="http://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley lastChild">
          //$pdf->SetJS('this.print();');
          $pdf->WriteHTML($html); // write the HTML into the PDF
          $pdf->Output($pdfFilePath, 'F'); // save to file because we can
          //print_r($pdf);
          }
          //redirect("/uploads/orcamentos/ORC-" . $hora . ".pdf");
          //echo base_url("/uploads/orcamentos/" . $nome_pdf);
          $this->session->set_flashdata('success', 'Orçamento gerado com sucesso!');
          //redirect(site_url('cotacao_painel'));
          $result['msg'] = TRUE;
          echo json_encode($result);
          //$total = $treinamento->valor_aluno * $nro_alunos;
          //$this->load->view('restrito/cotacao/novo_orcamento', $dados);
          } else {
          $result['msg'] = FALSE;
          echo json_encode($result);
          } */

    }



    public function enviar_email() {

        if ($this->input->post('id')) {

            $id = $this->input->post('id');



            $this->load->model('cotacao_m');



            $orcamento = $this->cotacao_m->getOrcamentoById($id);





            $email_config = Array(

                'mailtype' => 'html',

                'starttls' => true,

                'newline' => "\r\n",

                'charset' => 'utf-8',

                'wordwrap' => TRUE

            );





            $contato = 'Segue em anexo Orçamento referente ao treinamento ' . strip_tags($orcamento->nome_pt);



            $this->load->library('email', $email_config);



            $this->email->from('site@jodaltreinamentos.com', 'Jodal');

            $this->email->to($orcamento->email);

            $this->email->reply_to('contato@jodaltreinamentos.com', 'Jodal Treinamentos');

            $this->email->subject('Orçamento Jodal Treinamentos');

            $this->email->message($contato);

            $this->email->attach(FCPATH . "uploads/orcamentos/" . $orcamento->path_pdf);

            $this->email->attach(FCPATH . "uploads/grades/" . $orcamento->grade_curso_pt);



            if ($this->email->send()) {

                echo json_encode(array('msg' => TRUE));

            } else {

                echo json_encode(array('msg' => FALSE));

            }

        }

    }



}