<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Certificado_m
 *
 * @author iuri.londero
 */
class Certificado_m extends CI_Model {

    //put your code here

    function insert($certificado) {
        return $this->db->insert('certificados', $certificado);
    }

    function remove($id) {
        return $this->db->delete('certificados', array('id' => $id));
    }

    function update($array, $id) {

        $this->db->where('id', $id);
        $this->db->update('certificados', $array);

        if ($this->db->affected_rows() > 0) {
            // Code here after successful insert
            return true; // to the controller
        }

        return FALSE;
    }

    function get_all() {
        $query = $this->db->query("select certificados.id, certificados.aluno_nome, treinamentos.nome_pt from certificados
	inner join treinamentos on certificados.treinamento = treinamentos.id order by certificados.aluno_nome asc");

        return $query->result();
    }
    
    function getByName($aluno){
        $query = $this->db->query("select certificados.id, certificados.aluno_nome, treinamentos.nome_pt from certificados
	inner join treinamentos on certificados.treinamento = treinamentos.id and certificados.aluno_nome like '%$aluno%' order by certificados.aluno_nome asc");

        return $query;
    }
    function getByCpf($cpf){
        $query = $this->db->query("select certificados.id, certificados.aluno_nome, treinamentos.nome_pt from certificados
	inner join treinamentos on certificados.treinamento = treinamentos.id and certificados.aluno_cpf='$cpf' order by certificados.aluno_nome asc");

        return $query;
    }
    
    function getById($codigo) {
        $query =  $this->db->query("select certificados.id, certificados.aluno_nome,certificados.aluno_rg, certificados.aluno_cpf, certificados.observacao,certificados.data, certificados.horas, treinamentos.versao_pt,treinamentos.nome_pt, treinamentos.selo_pt,treinamentos.versao_en,treinamentos.nome_en, treinamentos.selo_en from certificados
	inner join treinamentos on certificados.treinamento = treinamentos.id and certificados.id='$codigo'");
        
        return $query->row();
    }
    
    function getByRit($codigo) {
        $query =  $this->db->query("select certificados.id, certificados.aluno_nome,certificados.aluno_rg, certificados.aluno_cpf, certificados.observacao, certificados.data, certificados.horas, treinamentos.versao_pt,treinamentos.nome_pt, treinamentos.selo_pt,treinamentos.versao_en,treinamentos.nome_en, treinamentos.selo_en from certificados
	inner join treinamentos on certificados.treinamento = treinamentos.id and certificados.id='$codigo'");
        
        return $query;
    }

    function get_certificado($id) {

        $query = $this->db->get_where('certificados', array('id' => $id));

        return $query;
    }
    
    function getNextID() {
        $query = $this->db->query("select (COALESCE(MAX(id), 0) + 1) as next from certificados");
        return $query->row()->next;
    }

}
