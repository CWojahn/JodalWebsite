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
class Clientes_m extends CI_Model {

    //put your code here

    function insert($cliente) {
        return $this->db->insert('clientes', $cliente);
    }

    function remove($id) {
        return $this->db->delete('clientes', array('id' => $id));
    }

    function update($array, $id) {

        $this->db->where('id', $id);
        $this->db->update('clientes', $array);

        if ($this->db->affected_rows() > 0) {
            // Code here after successful insert
            return true; // to the controller
        }

        return FALSE;
    }

    function get_all() {
        $query = $this->db->query("select * from clientes order by empresa asc");

        return $query->result();
    }
    
    function get_cliente($id) {

        $query = $this->db->get_where('clientes', array('id' => $id));

        return $query;
    }

}
