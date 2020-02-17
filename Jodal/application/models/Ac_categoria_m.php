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
class Ac_categoria_m extends CI_Model {

    //put your code here
    function insert($categoria) {
        return $this->db->insert('ac_categorias', $categoria);
    }
    
    function remove($id) {
        return $this->db->delete('ac_categorias', array('id' => $id));
    }
    
    
    function getCateg($id) {

        $query = $this->db->get_where('ac_categorias', array('id' => $id));

        return $query->row();
    }
    
    function getAllCategs() {

        $this->db->order_by('nome', 'asc');
        $query = $this->db->get('ac_categorias');

        return $query->result();
    }
    
    function update($id, $array) {

        $this->db->where('id', $id);
        $this->db->update('ac_categorias', $array);

        if ($this->db->affected_rows() > 0) {
            // Code here after successful insert
            return true; // to the controller
        }

        return FALSE;
    }

}
