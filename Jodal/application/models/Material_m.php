<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Material_m
 *
 * @author iuri.londero
 */
class Material_m extends CI_Model {

    //put your code here
    function insert($material) {
        return $this->db->insert('material', $material);
    }

    function get_all() {
        $this->db->order_by('nome', 'asc');
        $query = $this->db->get('material');

        return $query->result();
    }
    
    function get_material($id) {
        
        $query = $this->db->get_where('material', array('id' => $id));

        return $query;
    }

    function update($id, $array) {
        
        $this->db->where('id', $id);
        $this->db->update('material', $array);

        if ($this->db->affected_rows() > 0) {
            // Code here after successful insert
            return true; // to the controller
        }

        return FALSE;
    }

    function remove($id) {
        return $this->db->delete('material', array('id' => $id));
    }

}
