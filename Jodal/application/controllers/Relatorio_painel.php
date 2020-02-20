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

        $this->load->model('relatorio_m'); 

        $dados = array(

            'header' => 'Controle de Relatórios'

        );



        //$orcamentos = $this->cotacao_m->getOrcamentos();

        //$certificados = $this->certificado_m->get_all();

        $array['relatorios'] = $this->relatorio_m->getRelatorios();

        $this->load->view('restrito/painel', $dados);

        $this->load->view('restrito/relatorios/principal', $array);

        $this->load->view('restrito/footer');

    }


// ok
    public function novo() {

        $this->load->model('clientes_m');

        $dados = array(

            'header' => 'Controle de Relatórios'

        );

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

        $this->load->view('restrito/certificados/editar', $dados1);

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



    public function salvar() {

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

        }

    }



    public function salvar_edit() {

        $numero = $this->input->post('numero');

        $treinamento = $this->input->post('treinamento');

        $horas = $this->input->post('horas');

        $aluno = $this->input->post('aluno');

        $cpf = $this->input->post('cpf');



        $certificado = array(

            //'id' => $numero,

            'treinamento' => $treinamento,

            'horas' => $horas,

            'aluno_nome' => $aluno,

            'aluno_cpf' => $cpf

        );

        $this->load->model('certificado_m');



        if ($this->certificado_m->update($certificado, $numero)) {

            $this->session->set_flashdata('success', 'Certificado modificado com sucesso para o aluno <strong>' . $aluno . '</strong>!');

            redirect(site_url('certificado_painel'));

        } else {

            $this->session->set_flashdata('unchecked', '<strong>ATENÇÃO!</strong> Erro ao editar certificado, verfique os dados e tente novamente.');

            redirect(site_url('certificado_painel/editar/' . $numero));

        }

    }



    public function carregar_header() {

        $id_cliente = $this->input->post('id');



        $this->load->model('clientes_m');

        $this->load->model('cotacao_m');



        $nro_orc = $this->cotacao_m->getNroOrcamento()->nro_orc;

        $nro_orc = $nro_orc + 1;



        $dados = array(

            'sel_cliente' => $this->clientes_m->get_cliente($id_cliente)->row(),

            'nro_orc' => $nro_orc,

            'data' => date('Y-m-d')

        );

        $this->load->view('restrito/cotacao/header', $dados);

    }



    public function gerar_cotacao() {

        //$nro_alunos = $this->input->post('alunos');

        //$id_treinam = $this->input->post('treinamento');

        //$id_cliente = $this->input->post('cliente');

        if ($this->input->post('alunos') && $this->input->post('treinamento') && $this->input->post('cliente')) {

            $this->load->model('treinamento_m');

            $this->load->model('clientes_m');

            $this->load->model('cotacao_m');



            $nro_alunos = $this->input->post('alunos');

            $id_treinam = $this->input->post('treinamento');

            $id_cliente = $this->input->post('cliente');

            $count_orc = $this->input->post('count_orc');



            //$cliente = $this->clientes_m->get_cliente($id_cliente)->row();

            //$treinamento = $this->treinamento_m->get_treinamento($id_treinam)->row();

            $nro_orc = $this->cotacao_m->getNroOrcamento()->nro_orc;

            $nro_orc = $nro_orc + 1;



            $sel_treinam = $this->treinamento_m->get_treinamento($id_treinam)->row();

            $dados = array(

                'sel_cliente' => $this->clientes_m->get_cliente($id_cliente)->row(),

                'sel_treinamento' => $sel_treinam,

                'nro_alunos' => $nro_alunos,

                'count_orc' => $count_orc + 1

            );



            $dados1 = array(

                'sel_treinamento' => $sel_treinam,

            );





            //$total = $treinamento->valor_aluno * $nro_alunos;



            $result['id_treinamento'] = $sel_treinam->id;

            $result['alunos'] = $nro_alunos;

            $result['valor_aluno'] = money_format("%.2n", $sel_treinam->valor_aluno);

            $result['total'] = money_format("%.2n", $sel_treinam->valor_aluno * $nro_alunos);





            $result['header'] = $this->load->view('restrito/cotacao/novo_selo', $dados1, true);

            $result['page'] = $this->load->view('restrito/cotacao/novo_orcamento', $dados, true);

            $result['msg'] = TRUE;

            

            echo json_encode($result);

        } else {

            $result['msg'] = FALSE;

            //$result['page'] = '<div class="alert alert-danger alert-dismissible" role="alert">

            //<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            //Erro! Verifique se os campos do formulário foram preenchidos.

        //</div>';

            //echo '<div class="alert alert-danger alert-dismissible" role="alert">

            //<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            //Erro! Verifique se os campos do formulário foram preenchidos.

            //</div>';

            echo json_encode($result);

        }

    }



    public function salvar_orcamento() {

        $this->load->model('cotacao_m');

        $this->load->model('treinamento_m');

        $this->load->model('clientes_m');



        $array_obj = $this->input->post('json_orc');

        $cliente = $this->input->post('cliente');

        $valor_total = $this->input->post('total');

        $observ = $this->input->post('observacao');

        $array_orc = json_decode($array_obj);



        $nro_orc = $this->cotacao_m->getNroOrcamento()->nro_orc;

        $nro_orc = $nro_orc + 1;



        for ($index = 0; $index < count($array_orc); $index++) {

            $array_orc[$index]->id_orcamento = $nro_orc;

        }



        $dados_orc = array(

            'id' => $nro_orc,

            'id_cliente' => $cliente,

            'valor_total' => $valor_total,

            'data' => date('Y-m-d'),

            'observacao' => $observ

        );

        $dados_orc1 = new stdClass();

        $dados_orc1->id = $nro_orc;

        $dados_orc1->id_cliente = $cliente;

        $dados_orc1->valor_total = $valor_total;

        $dados_orc1->data = date('Y-m-d');

        $dados_orc1->observacao = $observ;

        



        if ($this->cotacao_m->insertOrc($dados_orc, $array_orc)) {

            for ($index = 0; $index < count($array_orc); $index++) {

                $sel_treinam = $this->treinamento_m->get_treinamento($array_orc[$index]->id_treinamento)->row();

                $array_orc[$index]->treinamento = $sel_treinam->nome_pt;

                $array_orc[$index]->selo = $sel_treinam->selo_pt;

                $array_orc[$index]->valor_aluno = money_format("%.2n", $sel_treinam->valor_aluno);

            }



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

