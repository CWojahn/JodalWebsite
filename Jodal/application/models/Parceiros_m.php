<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Parceiros_m
 *
 * @author iuri.londero
 */
class Parceiros_m extends CI_Model {

    //put your code here
    function insert($parceiro) {
        return $this->db->insert('parceiros', $parceiro);
    }

    function get_all() {
        $this->db->order_by('nome', 'asc');
        $query = $this->db->get('parceiros');

        return $query->result();
    }
    
    function get_parceiro($id) {
        
        $query = $this->db->get_where('parceiros', array('id' => $id));

        return $query;
    }

    function update($id, $array) {
        
        $this->db->where('id', $id);
        $this->db->update('parceiros', $array);

        if ($this->db->affected_rows() > 0) {
            // Code here after successful insert
            return true; // to the controller
        }

        return FALSE;
    }

    function remove($id) {
        return $this->db->delete('parceiros', array('id' => $id));
    }

}
