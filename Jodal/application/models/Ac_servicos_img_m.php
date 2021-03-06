<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of imagens_m
 *
 * @author Iuri
 */
class Ac_servicos_img_m extends CI_Model {

    //put your code here

    public function getImagens($id_servico) {
        $this->db->where('id_servico', $id_servico);
        $this->db->order_by("order", "asc"); 

        $query = $this->db->get('ac_servicos_img');

        return $query->result();
    }
    
    public function getCountImagens($id_servico) {
        $this->db->where('id_servico', $id_servico);
        //$this->db->order_by("order", "asc"); 

        $query = $this->db->get('ac_servicos_img');

        return $query->num_rows();
    }

    public function insert($data) {
        
        
        $this->db->trans_start();
        $this->db->insert('ac_servicos_img', $data);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }
    
    public function delete($id, $path) {
        $this->db->delete('ac_servicos_img', array('id_servico' => $id, 'path' =>$path));

        if ($this->db->affected_rows() > 0) {
            // Code here after successful insert
            return true; // to the controller
        }

        return FALSE;
    }
    
    public function update_order($data) {
        $this->db->update_batch('ac_servicos_img', $data, 'id'); 
    }
}
