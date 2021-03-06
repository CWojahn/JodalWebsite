<?php

/**
 *
 * @author Carlos.Wojahn
 */

class Relatorio_painel extends CI_Controller {


    function __construct() {

        parent::__construct();



        if (!$this->session->userdata('logged_in')) {

            redirect('acesso_restrito');

        }

    }

    public function index($array = array()) {

        $this->load->model('relatorios_m'); 
        $this->load->model('clientes_m');

        $dados = array(

            'header' => 'Controle de Relatórios'

        );



        //$orcamentos = $this->cotacao_m->getOrcamentos();

        //$certificados = $this->certificado_m->get_all();

        $array['relatorios'] = $this->relatorios_m->getRelatorios();
        $array['clientes'] = $this->clientes_m->get_all();

        $this->load->view('restrito/painel', $dados);

        $this->load->view('restrito/relatorios/principal', $array);

        $this->load->view('restrito/footer');

    }

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

    public function carregar_clientes(){
        $id_cliente = $this->input->post('id');

        $this->load->model('clientes_m');

        $dados = array(
            'sel_cliente' => $this->clientes_m->get_cliente($id_cliente)->row()
        ); 
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
            $this->load->view('restrito/relatorios/novo_ris', $dados);
        } elseif ($tipo_relatorio ==2) {
            $this->load->view('restrito/relatorios/header_apr', $dados);
            $this->load->view('restrito/relatorios/novo_apr', $dados);
        } elseif ($tipo_relatorio ==3) {
            $this->load->view('restrito/relatorios/header_dst', $dados);
            $this->load->view('restrito/relatorios/novo_dst', $dados);
        }
    }

    public function filter() {
        $id_cliente = $this->input->post('id');
        $tipo_relatorio = $this->input->post('tipo');
        $this->load->model('relatorios_m');
        
        if ($tipo_relatorio == -1){
            $array['relatorios'] = $this->relatorios_m->getRelatorioByCliente($id_cliente);
        }else {
            if ($tipo_relatorio == 0 ){
                $tipo = 'PGR';
            }elseif ($tipo_relatorio == 1 ){
                $tipo = 'RIS';
            }elseif ($tipo_relatorio == 2 ){
                $tipo = 'APR';
            }elseif ($tipo_relatorio == 3 ){
                $tipo = 'DDS';
            };
            $array['relatorios'] = $this->relatorios_m->getRelatorioByClienteAndType($id_cliente, $tipo);
        }

        

        $dados = $this->load->view('restrito/relatorios/filtrados', $array, true);
        echo $dados;
    }
    

    public function excluir() {
        if ($this->input->post('id')) {
            $id = $this->input->post('id');
            $this->load->model('relatorios_m');
            if ($this->relatorios_m->remove_relatorio($id)) {
                echo json_encode(array('msg' => TRUE));
            } else {
                echo json_encode(array('msg' => FALSE));
            }
        } else {
            echo json_encode(array('msg' => FALSE));
        }
    }

    public function enviar_email() {
        if ($this->input->post('id')) {
            $id = $this->input->post('id');
            $email_cliente = $this->input->post('email_prompt');
            $this->load->model('relatorios_m');

            $relatorio = $this->relatorios_m->getRelatorioById($id);

            $email_config = Array(
                'mailtype' => 'html',
                'starttls' => true,
                'newline' => "\r\n",
                'charset' => 'utf-8',
                'wordwrap' => TRUE
            );

            $corpo = 'Segue em anexo relatório referente a obra ' . $relatorio->obra;
            $this->load->library('email', $email_config);
            $this->email->from('site@jodaltreinamentos.com', 'Jodal');
            $this->email->to($email_cliente);
            $this->email->reply_to('contato@jodaltreinamentos.com', 'Jodal Treinamentos');
            $this->email->subject('Relatorio Jodal - '. $relatorio->obra);
            $this->email->message($corpo);
            $this->email->attach(FCPATH . "uploads/relatorios/pdf/" . $relatorio->path_pdf);

            if ($this->email->send()) {
                echo json_encode(array('msg' => TRUE));
            } else {
                echo json_encode(array('msg' => FALSE));
            }
        }
    }

    public function salvar() {

        $this->load->model('relatorios_m');

        $nro_relatorio = $this->relatorios_m->getNroRelatorio()->nro_relatorio;
        $nro_relatorio = $nro_relatorio + 1;
        $id_cliente = $this->input->post('cliente');
        $obra = $this->input->post('obra');
        $data_rel = $this->input->post('data');
        $local = $this->input->post('local');
        $tst_name = $this->input->post('tst');
        $obs = $this->input->post('obs');
        $tiporel = $this->input->post('tipo');

        $dados = array(
            'id' => $nro_relatorio,
            'id_cliente' => $id_cliente,
            'obra' => $obra,
            'data' => $data_rel,
            'local' => $local,
            'tst_name' => $tst_name,
            'observacoes' => $obs,
            'tipo' => $tiporel
        );
        
        $this->load->model('relatorios_m');
        $insert = $this->relatorios_m->createData($dados);
        echo json_encode($nro_relatorio);
    }
    
 
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


            $dados = $this->load->view('restrito/relatorios/novo_image_table', $dados1, true);
            // if ($relatorio->tipo == 'PGR'){
            //     $dados = $this->load->view('restrito/relatorios/novo_image_table', $dados1, true);
            // }elseif ($relatorio->tipo == 'RIS') {
            //     $dados = $this->load->view('restrito/relatorios/novo_image_table_ris', $dados1, true);
            // }
            // elseif ($relatorio->tipo == 'APR') {
            //     $dados = $this->load->view('restrito/relatorios/novo_image_table_apr', $dados1, true);
            // }      
            
            echo $dados;
            
        }

    }

    public function gerar_relatorio() {
            $id = $this->input->post('id');
            $tipo = $this->input->post('tipo');
            $this->load->model('relatorios_m');
            $relatorio = $this->relatorios_m->getRelatorioById($id);

            if ($tipo == 'PGR') {
                $imagensrelatorios = $this->relatorios_m->getPcmatImagesById($id);
                $dados1 = array(
                    'array_images' => $imagensrelatorios,
                    'relatorio' => $relatorio    
                );
            }elseif ($tipo == 'RIS') {
                $imagensrelatorios = $this->relatorios_m->getPcmatImagesById($id);
                $dadosris = $this->relatorios_m->getAuxRisById($id);
                $dados1 = array(
                    'array_images' => $imagensrelatorios,
                    'array_info' => $dadosris,
                    'relatorio' => $relatorio    
                );
            }elseif ($tipo == 'APR') {
                $dadosapr = $this->relatorios_m->getAuxAprById($id);
                $dados1 = array(
                    'array_info' => $dadosapr,
                    'relatorio' => $relatorio    
                );
            }elseif ($tipo == 'DDS') {
                $dadospart = $this->relatorios_m->getAuxDSTById($id);
                $imagensrelatorios = $this->relatorios_m->getPcmatImagesById($id);
                $dadosassunto = $this->relatorios_m->getAuxDST2ById($id);
                $dados1 = array(
                    'array_images' => $imagensrelatorios,
                    'array_info' => $dadosassunto,
                    'array_part' => $dadospart,
                    'relatorio' => $relatorio    
                );
            }

            
            $nome_pdf = date('Y-m-d') . "-REL-" . $id . ".pdf";
            $pdfFilePath = FCPATH . "uploads/relatorios/pdf/" . $nome_pdf;

           // if (file_exists($pdfFilePath) == FALSE) {
                ini_set('memory_limit', '64M'); 

                if ($tipo == 'PGR'){
                    $html = $this->load->view('restrito/relatorios/pdf_pcmat_pgst', $dados1, true);
                }elseif($tipo == 'RIS') {
                    $html = $this->load->view('restrito/relatorios/pdf_ris', $dados1, true);
                }elseif ($tipo == 'APR') {
                    $html = $this->load->view('restrito/relatorios/pdf_apr', $dados1, true);
                }elseif ($tipo == 'DDS') {
                    $html = $this->load->view('restrito/relatorios/pdf_dst', $dados1, true);
                }

                $this->load->library('pdf');
                $pdf = $this->pdf->load();
                $pdf->SetDisplayMode('fullpage');
                $pdf->AddPage();
                $pdf->SetHTMLFooter('
                <table width="100%">
                    <tr>
                        <td style="border: none;
                                text-align: left;
                                width: 33%">http://www.jodaltreinamentos.com
                        </td>
                        <td style="border: none;
                                width: 33%">{PAGENO}/{nbpg}</td>
                        <td style="border: none;
                                text-align: right;
                                width: 33%">{DATE j/m/Y}
                        </td>
                    </tr>
                </table>', 'O');
                //$pdf->SetFooter($_SERVER['HTTP_HOST'] . '|{PAGENO}|' . date(DATE_RFC822));
                $pdf->WriteHTML($html);
                $pdf->Output($pdfFilePath, 'F');
                //$pdf->Output();

                //echo json_encode($pdf);

                $this->relatorios_m->update_relatorio($id, array('path_pdf' => $nome_pdf));
                echo $nome_pdf;

            // } else {
            //     echo $nome_pdf;
            // }
    
    }

    //vai ser para o PCMAT,Ris no relatorio geral
    public function salvar_edit_pcmat(){
        $this->load->model('relatorios_m');

        $idrel = $this->input->post('idrel');
        $idcliente = $this->input->post('cliente');;
        $obra = $this->input->post('obra');
        $local = $this->input->post('local');
        $obs = $this->input->post('obs');
        $tst = $this->input->post('nometst');
        $datarel = $this->input->post('data_rel');

        //$dados['id'] = $idrel;
        $dados = array(
            'id_cliente'=> $idcliente,
            'obra'=> $obra,
            'local'=> $local,
            'observacoes'=> $obs,
            'tst_name'=> $tst,
            'data'=> $datarel,
        );

            $result = $this->relatorios_m->update_relatorio($idrel, $dados);
            echo json_encode(array('msg' => $result));

    } //vai ser para o PCMAT, RIS


   //vai ser para o PCMAT, RIS e APR
    public function excluir_imagempcmat(){
        if ($this->input->post('id')) {
            $id = $this->input->post('id');
            $this->load->model('relatorios_m');
            if ($this->relatorios_m->remove_imagemPcmat($id)) {
                echo json_encode(array('msg' => TRUE));
            } else {
                echo json_encode(array('msg' => FALSE));
            }
        } else {
            echo json_encode(array('msg' => FALSE));
        }
    } //vai ser para o PCMAT, RIS e APR

    //vai ser para o PCMAT, RIS e APR
    public function salvarImagensPcmat(){
        $this->load->model('relatorios_m');
        $nro_pcmat = $this->relatorios_m->getNroRelatorioPcmat()->nro_relatorio;
        $nro_pcmat = $nro_pcmat+1;
        $id_relatorio = $this->input->post('id_relatorio');
        $image_path = $this->input->post('image_path');
        $observacao = $this->input->post('observacao');

        $dados = array(
            'id' => $nro_pcmat,
            'id_relatorio' => $id_relatorio,
            'image_path' => $image_path,
            'observacao' => $observacao
        );
        $insert = $this->relatorios_m->insert_pcmat($dados);
        echo json_encode($insert);
    }//vai ser para o PCMAT, RIS e APR





    //********** Exclusivo PCMAT ***********/
    public function editar_pcmat($id = '') {
        $dados = array(
            'header' => 'Controle de Relatórios'
        );
        
        $this->load->model('relatorios_m');
        $this->load->model('clientes_m');

        $relatorio = $this->relatorios_m->getRelatorioById($id);
        $imagensrelatorios = $this->relatorios_m->getPcmatImagesById($id);
        $clientes = $this->clientes_m->get_all();

        $dados1 = array(
            'imagens' => $imagensrelatorios,
            'clientes' => $clientes,
            'relatorio' => $relatorio

        );
        $this->load->view('restrito/painel', $dados);
        $this->load->view('restrito/relatorios/editar_pcmat', $dados1);
        $this->load->view('restrito/footer');
    }

    //********** Exclusivo RIS ***********/
    public function salvar_ris(){
        $this->load->model('relatorios_m');
        $nro_aux_ris = $this->relatorios_m->getNroRelatorioAuxRis()->nro_relatorio;
        $nro_aux_ris = $nro_aux_ris+1;
        $id_relatorio = $this->input->post('id_relatorio');
        $email = $this->input->post('email');
        $recomendacoes = $this->input->post('recomendacoes');
        $data_prazo = $this->input->post('data_prazo');
        $asp_legal = $this->input->post('asp_legal');

        $dados = array(
            'id' => $nro_aux_ris,
            'id_relatorio' => $id_relatorio,
            'email' => $email,
            'recomendacoes' => $recomendacoes,
            'data_prazo' => $data_prazo,
            'asp_legal' => $asp_legal
        );
        $insert = $this->relatorios_m->insert_ris($dados);
        echo json_encode($insert);
    }

    public function editar_ris($id = '') {
        $dados = array(
            'header' => 'Controle de Relatórios'
        );
        
        $this->load->model('relatorios_m');
        $this->load->model('clientes_m');

        $relatorio = $this->relatorios_m->getRelatorioById($id);
        $imagensrelatorios = $this->relatorios_m->getPcmatImagesById($id);
        $dadosaux = $this->relatorios_m->getAuxRisById($id);
        $clientes = $this->clientes_m->get_all();

        $dados1 = array(
            'imagens' => $imagensrelatorios,
            'dadosauxiliares' => $dadosaux,
            'clientes' => $clientes,
            'relatorio' => $relatorio

        );
        $this->load->view('restrito/painel', $dados);
        $this->load->view('restrito/relatorios/editar_ris', $dados1);
        $this->load->view('restrito/footer');
    }

    public function salvar_edit_ris(){
        $this->load->model('relatorios_m');

        $idrel = $this->input->post('idrel');
        $email = $this->input->post('email');
        $recomendacoes = $this->input->post('recomendacoes');
        $data_prazo = $this->input->post('data_prazo');
        $asp_legal = $this->input->post('asp_legal');
        $idrel = $this->input->post('idrel');

        //$dados['id'] = $idrel;
        $dados = array(
            'email' => $email,
            'recomendacoes' => $recomendacoes,
            'data_prazo' => $data_prazo,
            'asp_legal' => $asp_legal
        );

            $result = $this->relatorios_m->update_ris($idrel, $dados);
            echo json_encode(array('msg' => $result));

    }

    
    //********** Exclusivo APR ***********/
    public function salvar_apr(){
        $this->load->model('relatorios_m');
        $nro_aux_ris = $this->relatorios_m->getNroRelatorioAuxApr()->nro_relatorio;
        $nro_aux_ris = $nro_aux_ris+1;
        $id_relatorio = $this->input->post('id_relatorio');
        $aprov_area = $this->input->post('aprov_area');
        $aprov_seg = $this->input->post('aprov_seg');
        $rev = $this->input->post('rev');
        $atividades = $this->input->post('atividades');
        $riscos = $this->input->post('riscos');
        $medidas = $this->input->post('medidas');

        $dados = array(
            'id' => $nro_aux_ris,
            'id_relatorio' => $id_relatorio,
            'aprov_area' => $aprov_area,
            'aprov_seg' => $aprov_seg,
            'rev' => $rev,
            'atividades' => $atividades,
            'riscos' => $riscos,
            'medidas' => $medidas
        );
        $insert = $this->relatorios_m->insert_apr($dados);
        echo json_encode($insert);
    }

    public function editar_apr($id = '') {
        $dados = array(
            'header' => 'Controle de Relatórios'
        );
        
        $this->load->model('relatorios_m');
        $this->load->model('clientes_m');

        $relatorio = $this->relatorios_m->getRelatorioById($id);
        $dadosaux = $this->relatorios_m->getAuxAprById($id);
        $clientes = $this->clientes_m->get_all();

        $dados1 = array(
            'array_info' => $dadosaux,
            'clientes' => $clientes,
            'relatorio' => $relatorio
        );
        $this->load->view('restrito/painel', $dados);
        $this->load->view('restrito/relatorios/editar_apr', $dados1);
        $this->load->view('restrito/footer');
    }

    public function salvar_edit_apr(){
        $this->load->model('relatorios_m');

        $idrel = $this->input->post('idrel');
        $aprov_area = $this->input->post('aprov_area');
        $aprov_seg = $this->input->post('aprov_seg');
        $rev = $this->input->post('rev');
        $atividades = $this->input->post('atividades');
        $riscos = $this->input->post('riscos');
        $medidas = $this->input->post('medidas');

        //$dados['id'] = $idrel;
        $dados = array(
            'aprov_area' => $aprov_area,
            'aprov_seg' => $aprov_seg,
            'rev' => $rev,
            'atividades' => $atividades,
            'riscos' => $riscos,
            'medidas' => $medidas
        );

            $result = $this->relatorios_m->update_apr($idrel, $dados);
            echo json_encode(array('msg' => $result));

    }


    //********** Exclusivo DST ***********/
    public function salvar_dst(){
        $this->load->model('relatorios_m');
        $nro_aux_ris = $this->relatorios_m->getNroRelatorioAuxDst()->nro_relatorio;
        $nro_aux_ris = $nro_aux_ris+1;
        $id_relatorio = $this->input->post('id_relatorio');
        $nome = $this->input->post('nome');
        $funcao = $this->input->post('funcao');

        $dados = array(
            'id' => $nro_aux_ris,
            'id_relatorio' => $id_relatorio,
            'nome' => $nome,
            'funcao' => $funcao
        );
        $insert = $this->relatorios_m->insert_dst($dados);
        echo json_encode($insert);
    }

    public function salvarassunto(){
        $this->load->model('relatorios_m');
        $nro_aux_ris = $this->relatorios_m->getNroRelatorioAux2Dst()->nro_relatorio;
        $nro_aux_ris = $nro_aux_ris+1;
        $id_relatorio = $this->input->post('id_relatorio');
        $as_1 = $this->input->post('as_1');
        $as_2 = $this->input->post('as_2');
        $as_3 = $this->input->post('as_3');
        $as_4 = $this->input->post('as_4');
        $as_5 = $this->input->post('as_5');
        $as_6 = $this->input->post('as_6');
        $as_7 = $this->input->post('as_7');
        $as_8 = $this->input->post('as_8');
        $as_9 = $this->input->post('as_9');
        $as_10 = $this->input->post('as_10');
        $as_11 = $this->input->post('as_11');
        $as_12 = $this->input->post('as_12');
        $as_13 = $this->input->post('as_13');
        $as_14 = $this->input->post('as_14');
        $as_15 = $this->input->post('as_15');
        $as_16 = $this->input->post('as_16');
        $outros = $this->input->post('outros');

        $dados = array(
            'id' => $nro_aux_ris,
            'id_relatorio' => $id_relatorio,
            'as_1' => $as_1,
            'as_2' => $as_2,
            'as_3' => $as_3,
            'as_4' => $as_4,
            'as_5' => $as_5,
            'as_6' => $as_6,
            'as_7' => $as_7,
            'as_8' => $as_8,
            'as_9' => $as_9,
            'as_10' => $as_10,
            'as_11' => $as_11,
            'as_12' => $as_12,
            'as_13' => $as_13,
            'as_14' => $as_14,
            'as_15' => $as_15,
            'as_16' => $as_16,
            'outros' => $outros
            
        );
        $insert = $this->relatorios_m->insert_assunto($dados);
        echo json_encode($insert);
    }

    public function editar_dst($id = '') {
        $dados = array(
            'header' => 'Controle de Relatórios'
        );
        
        $this->load->model('relatorios_m');
        $this->load->model('clientes_m');

        $relatorio = $this->relatorios_m->getRelatorioById($id);
        $dadosaux = $this->relatorios_m->getAuxDST2ById($id);
        $clientes = $this->clientes_m->get_all();

        $dados1 = array(
            'array_info' => $dadosaux,
            'clientes' => $clientes,
            'relatorio' => $relatorio
        );
        $this->load->view('restrito/painel', $dados);
        $this->load->view('restrito/relatorios/editar_dst', $dados1);
        $this->load->view('restrito/footer');
    }

    public function salvar_edit_dst(){
        $this->load->model('relatorios_m');

        $idrel = $this->input->post('idrel');
        $nome = $this->input->post('nome');
        $funcao = $this->input->post('funcao');

        //$dados['id'] = $idrel;
        $dados = array(
            'nome' => $nome,
            'funcao' => $funcao,
        );

            $result = $this->relatorios_m->update_dst($idrel, $dados);
            echo json_encode(array('msg' => $result));

    }

    public function salvar_edit_assunto(){
        $this->load->model('relatorios_m');

        $idrel = $this->input->post('idrel');
        $as_1 = $this->input->post('as_1');
        $as_2 = $this->input->post('as_2');
        $as_3 = $this->input->post('as_3');
        $as_4 = $this->input->post('as_4');
        $as_5 = $this->input->post('as_5');
        $as_6 = $this->input->post('as_6');
        $as_7 = $this->input->post('as_7');
        $as_8 = $this->input->post('as_8');
        $as_9 = $this->input->post('as_9');
        $as_10 = $this->input->post('as_10');
        $as_11 = $this->input->post('as_11');
        $as_12 = $this->input->post('as_12');
        $as_13 = $this->input->post('as_13');
        $as_14 = $this->input->post('as_14');
        $as_15 = $this->input->post('as_15');
        $as_16 = $this->input->post('as_16');
        $outros = $this->input->post('outros');

        //$dados['id'] = $idrel;
        $dados = array(
            'as_1' => $as_1,
            'as_2' => $as_2,
            'as_3' => $as_3,
            'as_4' => $as_4,
            'as_5' => $as_5,
            'as_6' => $as_6,
            'as_7' => $as_7,
            'as_8' => $as_8,
            'as_9' => $as_9,
            'as_10' => $as_10,
            'as_11' => $as_11,
            'as_12' => $as_12,
            'as_13' => $as_13,
            'as_14' => $as_14,
            'as_15' => $as_15,
            'as_16' => $as_16,
            'outros' => $outros
        );

            $result = $this->relatorios_m->update_assunto($idrel, $dados);
            echo json_encode(array('msg' => $result));

    }





    //****************  não utilizados  *******************//


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




}