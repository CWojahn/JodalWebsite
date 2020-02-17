<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Servicos_m
 *
 * @author iuri.londero
 */
class Servicos_m extends CI_Model {

    //put your code here
    function insert($servico) {
        return $this->db->insert('servicos', $servico);
    }

    function get_all() {
        $this->db->order_by('nome', 'asc');
        $query = $this->db->get('servicos');

        return $query->result();
    }

    function get_servico($id) {
        
        $query = $this->db->get_where('servicos', array('id' => $id));

        return $query;
    }

    function update($id, $array) {
        
        $this->db->where('id', $id);
        $this->db->update('servicos', $array);

        if ($this->db->affected_rows() > 0) {
            // Code here after successful insert
            return true; // to the controller
        }

        return FALSE;
    }

    function remove($id) {
        return $this->db->delete('servicos', array('id' => $id));
    }
}
