<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of treinamento_painel
 *
 * @author Usuário
 */
class Treinamento_painel extends CI_Controller {

    //put your code here
    function __construct() {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('acesso_restrito');
        }
    }

    public function index($array = array()) {
        $this->load->model('treinamento_m');
        $dados = array(
            'header' => 'Controle de Treinamentos'
        );

        $treinamentos = $this->treinamento_m->get_all();

        $array['treinamentos'] = $treinamentos;
        $this->load->view('restrito/painel', $dados);
        $this->load->view('restrito/treinamentos/principal', $array);
        $this->load->view('restrito/footer');
    }

    public function editar($id = '') {

        $dados = array(
            'header' => 'Controle de Treinamentos'
        );
        //if ($this->input->post('radio')) {
        //    $id_treinamento = $this->input->post('radio');
        //}
        if ($id <> '') {
            $id_treinamento = $id;
        

        $this->load->model('treinamento_m');
        $treinamentos = $this->treinamento_m->get_treinamento($id_treinamento);


        $array['treinamentos'] = $treinamentos->row();

        $this->load->view('restrito/painel', $dados);
        $this->load->view('restrito/treinamentos/editar', $array);
        $this->load->view('restrito/footer');
        } else {
            
        }
        
    }

    public function novo($array = array()) {
        $dados = array(
            'header' => 'Controle de Treinamentos'
        );
        $this->load->view('restrito/painel', $dados);
        $this->load->view('restrito/treinamentos/novo', $array);
        $this->load->view('restrito/footer');
    }

    public function excluir() {
        if ($this->input->post('id')) {
            $id = $this->input->post('id');

            $this->load->model('treinamento_m');
            $treinamento = $this->treinamento_m->get_treinamento($id)->row();

            if ($this->treinamento_m->remove($id)) {
                if ($treinamento->versao_en) {
                    unlink(FCPATH . 'uploads/selos/' . $treinamento->selo_en);
                    unlink(FCPATH . 'uploads/grades/' . $treinamento->grade_curso_en);
                }
                unlink(FCPATH . 'uploads/selos/' . $treinamento->selo_pt);
                unlink(FCPATH . 'uploads/grades/' . $treinamento->grade_curso_pt);
                echo json_encode(array('msg' => TRUE));
            } else {
                echo json_encode(array('msg' => FALSE));
            }
        } else {
            echo json_encode(array('msg' => FALSE));
        }
    }

    public function salvar() {
        $config['upload_path'] = FCPATH . 'uploads/selos';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 0;

        $config1['upload_path'] = FCPATH . 'uploads/grades';
        $config1['allowed_types'] = 'pdf';
        $config1['max_size'] = 0;

        $this->load->library('upload', $config);

        $array = array();
        if ($this->input->post('check_pt')) {

            if (!$this->upload->do_upload('selo_pt')) {
                //echo $config['upload_path'];
                //echo '<br>erro img1';
            } else {
                $selo_pt = $this->upload->data('file_name');

                //$this->load->library('upload', $config);
                $this->upload->initialize($config1);
                if (!$this->upload->do_upload('grade_pt')) {
                    //echo $this->upload->display_errors();
                } else {
                    //echo 'deu certo ';
                    $grade_pt = $this->upload->data('file_name');
                    $nome_pt = $this->input->post('nome_pt');
                    $desc_curta_pt = $this->input->post('desc_curta_pt');
                    $desc_completa_pt = $this->input->post('desc_completa_pt');

                    $array['selo_pt'] = $selo_pt;
                    $array['nome_pt'] = $nome_pt;
                    $array['descricao_curta_pt'] = $desc_curta_pt;
                    $array['descricao_pt'] = $desc_completa_pt;
                    $array['grade_curso_pt'] = $grade_pt;
                    $array['versao_pt'] = 1;

                    //print_r($array);
                }
            }
        }
        if ($this->input->post('check_en')) {
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('selo_en')) {
                //echo $this->upload->display_errors();
            } else {
                $selo_en = $this->upload->data('file_name');
                $this->upload->initialize($config1);
                if (!$this->upload->do_upload('grade_en')) {
                    //echo $this->upload->display_errors();
                } else {
                    //echo 'deu certo ';
                    $grade_en = $this->upload->data('file_name');

                    $nome_en = $this->input->post('nome_en');
                    $desc_curta_en = $this->input->post('desc_curta_en');
                    $desc_completa_en = $this->input->post('desc_completa_en');

                    $array['selo_en'] = $selo_en;
                    $array['nome_en'] = $nome_en;
                    $array['descricao_curta_en'] = $desc_curta_en;
                    $array['descricao_en'] = $desc_completa_en;
                    $array['grade_curso_en'] = $grade_en;
                    $array['versao_en'] = 1;
                }
            }
        }
        if ($this->input->post('check_pt') || $this->input->post('check_en')) {
            $this->load->model('treinamento_m');
            if ($this->treinamento_m->insert($array)) {
                //$this->index($array);
                if ($this->input->post('check_pt')) {
                    $this->session->set_flashdata('success', 'Treinamento <strong>' . $nome_pt . '</strong> cadastrado com sucesso!');
                } else {
                    $this->session->set_flashdata('success', 'Treinamento <strong>' . $nome_en . '</strong> cadastrado com sucesso!');
                }

                $result = TRUE;
            } else {
                $this->novo($array);
            }
        } else {
            $this->session->set_flashdata('unchecked', TRUE);
            $result = FALSE;
        }

        if ($result) {
            redirect(site_url('treinamento_painel'));
        } else {
            redirect(site_url('treinamento_painel/novo'));
        }
    }

    public function salvar_edit() {
        $config['upload_path'] = FCPATH . 'uploads/selos';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 0;

        $config1['upload_path'] = FCPATH . 'uploads/grades';
        $config1['allowed_types'] = 'pdf';
        $config1['max_size'] = 0;

        $this->load->library('upload', $config);

        $array = array();
        $id = $this->input->post('id');
        $custo = $this->input->post('custo');
        $this->load->model('treinamento_m');
        $treinamentos = $this->treinamento_m->get_treinamento($id)->row();


        if ($this->input->post('check_pt')) {

            if ($_FILES['selo_pt']['size'] == 0 && $_FILES['selo_pt']['error'] == 4) {
                // cover_image is empty (and not an error)

                if (!$treinamentos->versao_pt) {
                    $this->session->set_flashdata('unchecked', '<strong>ATENÇÃO!</strong> É obrigatório definir um selo para o treinamento.');
                    redirect(site_url('treinamento_painel/editar/' . $id));
                } else {
                    $selo_pt = $treinamentos->selo_pt;
                }
            } else {
                if (!$this->upload->do_upload('selo_pt')) {
                    $this->session->set_flashdata('unchecked', '<strong>ATENÇÃO!</strong> Erro ao carregar selo do treinamento, verifique e tente novamente.');
                    redirect(site_url('treinamento_painel/editar/' . $id));
                } else {
                    $selo_pt = $this->upload->data('file_name');
                    if ($treinamentos->versao_pt) {
                        if (is_file(FCPATH . 'uploads/selos/' . $treinamentos->selo_pt)) {
                            unlink(FCPATH . 'uploads/selos/' . $treinamentos->selo_pt);
                        }
                    }
                }
            }

            if ($_FILES['grade_pt']['size'] == 0 && $_FILES['grade_pt']['error'] == 4) {
                // cover_image is empty (and not an error)

                if (!$treinamentos->versao_pt) {
                    $this->session->set_flashdata('unchecked', '<strong>ATENÇÃO!</strong> É obrigatório definir uma grade para o treinamento.');
                    redirect(site_url('treinamento_painel/editar/' . $id));
                } else {
                    $grade_pt = $treinamentos->grade_curso_pt;
                }
            } else {
                $this->upload->initialize($config1);
                if (!$this->upload->do_upload('grade_pt')) {
                    $this->session->set_flashdata('unchecked', '<strong>ATENÇÃO!</strong> Erro ao carregar grade do treinamento, veifique e tente novamente.');
                    redirect(site_url('treinamento_painel/editar/' . $id));
                } else {
                    $grade_pt = $this->upload->data('file_name');
                    if ($treinamentos->versao_pt) {
                        if (is_file(FCPATH . 'uploads/grades/' . $treinamentos->grade_curso_pt)) {
                            unlink(FCPATH . 'uploads/grades/' . $treinamentos->grade_curso_pt);
                        }
                    }
                }
            }


            $nome_pt = $this->input->post('nome_pt');
            $desc_curta_pt = $this->input->post('desc_curta_pt');
            $desc_completa_pt = $this->input->post('desc_completa_pt');

            $array['selo_pt'] = $selo_pt;
            $array['nome_pt'] = $nome_pt;
            $array['descricao_curta_pt'] = $desc_curta_pt;
            $array['descricao_pt'] = $desc_completa_pt;
            $array['grade_curso_pt'] = $grade_pt;
            $array['versao_pt'] = 1;
        } else {
            $array['versao_pt'] = 0;
            if ($treinamentos->versao_pt) {
                if (is_file(FCPATH . 'uploads/selos/' . $treinamentos->selo_pt)) {
                    unlink(FCPATH . 'uploads/selos/' . $treinamentos->selo_pt);
                }
                if (is_file(FCPATH . 'uploads/grades/' . $treinamentos->grade_curso_pt)) {
                    unlink(FCPATH . 'uploads/grades/' . $treinamentos->grade_curso_pt);
                }
                $array['selo_pt'] = NULL;
                $array['grade_curso_pt'] = NULL;
            }
        }

        if ($this->input->post('check_en')) {
            $this->upload->initialize($config);

            if ($_FILES['selo_en']['size'] == 0 && $_FILES['selo_en']['error'] == 4) {
                // cover_image is empty (and not an error)
                if (!$treinamentos->versao_en) {
                    $this->session->set_flashdata('unchecked', '<strong>ATENÇÃO!</strong> É obrigatório definir um selo para o treinamento.');
                    redirect(site_url('treinamento_painel/editar/' . $id));
                } else {
                    $selo_en = $treinamentos->selo_en;
                }
            } else {
                if (!$this->upload->do_upload('selo_en')) {
                    $this->session->set_flashdata('unchecked', '<strong>ATENÇÃO!</strong> Erro ao carregar selo do treinamento, verifique e tente novamente.');
                    redirect(site_url('treinamento_painel/editar/' . $id));
                } else {
                    $selo_en = $this->upload->data('file_name');
                    if ($treinamentos->versao_en) {
                        if (is_file(FCPATH . 'uploads/selos/' . $treinamentos->selo_en)) {
                            unlink(FCPATH . 'uploads/selos/' . $treinamentos->selo_en);
                        }
                    }
                }
            }

            if ($_FILES['grade_en']['size'] == 0 && $_FILES['grade_en']['error'] == 4) {
                // cover_image is empty (and not an error)
                if (!$treinamentos->versao_en) {
                    $this->session->set_flashdata('unchecked', '<strong>ATENÇÃO!</strong> É obrigatório definir uma grade para o treinamento.');
                    redirect(site_url('treinamento_painel/editar/' . $id));
                } else {
                    $grade_en = $treinamentos->grade_curso_en;
                }
            } else {
                $this->upload->initialize($config1);
                if (!$this->upload->do_upload('grade_en')) {
                    $this->session->set_flashdata('unchecked', '<strong>ATENÇÃO!</strong> Erro ao carregar grade do treinamento, veifique e tente novamente.');
                    redirect(site_url('treinamento_painel/editar/' . $id));
                } else {
                    $grade_en = $this->upload->data('file_name');
                    if ($treinamentos->versao_en) {
                        if (is_file(FCPATH . 'uploads/grades/' . $treinamentos->grade_curso_en)) {
                            unlink(FCPATH . 'uploads/grades/' . $treinamentos->grade_curso_en);
                        }
                    }
                }
            }


            $nome_en = $this->input->post('nome_en');
            $desc_curta_en = $this->input->post('desc_curta_en');
            $desc_completa_en = $this->input->post('desc_completa_en');

            $array['selo_en'] = $selo_en;
            $array['nome_en'] = $nome_en;
            $array['descricao_curta_en'] = $desc_curta_en;
            $array['descricao_en'] = $desc_completa_en;
            $array['grade_curso_en'] = $grade_en;

            $array['versao_en'] = 1;
        } else {
            $array['versao_en'] = 0;
            if ($treinamentos->versao_en) {
                if (is_file(FCPATH . 'uploads/grades/' . $treinamentos->grade_curso_en)) {
                    unlink(FCPATH . 'uploads/grades/' . $treinamentos->grade_curso_en);
                }
                if (is_file(FCPATH . 'uploads/selos/' . $treinamentos->selo_en)) {
                    unlink(FCPATH . 'uploads/selos/' . $treinamentos->selo_en);
                }
                $array['selo_en'] = NULL;
                $array['grade_curso_en'] = NULL;
            }
        }
        if ($this->input->post('check_pt') || $this->input->post('check_en')) {
            $this->load->model('treinamento_m');
            $array['valor_aluno'] = $custo;
            if ($this->treinamento_m->update($id, $array)) {
                //$this->index($array);
                $this->session->set_flashdata('success', 'Treinamento editado com sucesso!');
                redirect(site_url('treinamento_painel'));
            } else {
                $this->session->set_flashdata('unchecked', '<strong>ATENÇÃO!</strong> Erro ao editar treinamento, verfique os dados e tente novamente.');
                redirect(site_url('treinamento_painel/editar/' . $id));
            }
        } else {
            $this->session->set_flashdata('unchecked', '<strong>ATENÇÃO!</strong> É necessário selecionar pelo menos um idioma.');
            redirect(site_url('treinamento_painel/editar/' . $id));
        }
    }

}
