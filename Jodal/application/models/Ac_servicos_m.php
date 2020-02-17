<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ac_categoria_m
 *
 * @author Iuri
 */
class Ac_servicos_m extends CI_Model {

    //put your code here
    function insert($dados) {
        $this->db->trans_start();
        $this->db->insert('ac_servicos', $dados);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    function remove($id) {
        return $this->db->delete('ac_servicos', array('id' => $id));
    }

    function get_all() {
        $query = $this->db->query("select ac_servicos.id, ac_servicos.nome, ac_categorias.nome as categoria from ac_servicos
	inner join ac_categorias
	on ac_servicos.categoria = ac_categorias.id order by ac_categorias.nome asc");

        return $query->result();
    }
    
    public function getAllServicos($limit, $start) {
        $this->db->limit($limit, $start);
        //$this->db->select('ac_servicos.id, ac_servicos.nome, ac_servicos.desc_curta, ac_servicos.estilo, img.path');
        //$this->db->from('ac_servicos');
        //$this->db->join('ac_servicos_img img', 'ac_servicos.id=img.id_servico and img.order=0', 'inner');
        $this->db->order_by('ac_servicos.nome', 'asc');
        
        $query = $this->db->get('ac_servicos');
        return $query;
    }

    function getServico($id) {

        $query = $this->db->get_where('ac_servicos', array('id' => $id));

        return $query->row();
    }
    
    function getServicosCateg($categ) {

        //$this->db->select('ac_servicos.id, ac_servicos.nome, ac_servicos.desc_curta, ac_servicos.estilo, img.path');
        //$this->db->from('ac_servicos');
        //$this->db->join('ac_servicos_img img', 'ac_servicos.id=img.id_servico and ac_servicos.categoria='.$categ.' and img.order=0', 'inner');

        $this->db->order_by('ac_servicos.nome', 'asc');
        $query = $this->db->get_where('ac_servicos', array('categoria' => $categ));
        //$query = $this->db->get();
        return $query->result();

    }

    public function updateServ($id, $data) {

        $this->db->where('id', $id);
        $this->db->update('ac_servicos', $data);

        if ($this->db->affected_rows() > 0) {
            // Code here after successful insert
            return true; // to the controller
        }

        return FALSE;
    }

}
