<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Empresa_m
 *
 * @author iuri.londero
 */
class Empresa_m extends CI_Model {

    //put your code here
    function get() {

        $query = $this->db->get_where('empresa', array('id' => 1));

        return $query;
    }

    function update($array) {

        $this->db->where('id', 1);
        $this->db->update('empresa', $array);

        if ($this->db->affected_rows() > 0) {
            // Code here after successful insert
            return true; // to the controller
        }

        return FALSE;
    }

    public function insert_img($data) {
        $this->db->insert('empresa_img', $data);

        if ($this->db->affected_rows() > 0) {
            // Code here after successful insert
            return true; // to the controller
        }

        return FALSE;
    }

    public function delete_img($file) {
        $this->db->delete('empresa_img', array('imagem' => $file));
    }

    public function select_img() {
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('empresa_img');

        return $query->result();
    }

}
