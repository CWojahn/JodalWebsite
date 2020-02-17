<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Treinamento_m
 *
 * @author Usuário
 */
class Treinamento_m extends CI_Model {

    //put your code here

    function insert($treinamento) {
        return $this->db->insert('treinamentos', $treinamento);
    }

    function get_all() {
        $this->db->order_by('nome_pt', 'asc');
        $query = $this->db->get('treinamentos');

        return $query->result();
    }

    function get_all_pt() {
        $this->db->order_by('nome_pt', 'asc');
        $query = $this->db->get_where('treinamentos', array('versao_pt' => TRUE));

        return $query->result();
    }

    function get_all_en() {
        $this->db->order_by('nome_en', 'asc');
        $query = $this->db->get_where('treinamentos', array('versao_en' => TRUE));

        return $query->result();
    }

    function get_treinamento($id) {

        $query = $this->db->get_where('treinamentos', array('id' => $id));

        return $query;
    }

    function update($id, $array) {

        $this->db->where('id', $id);
        $this->db->update('treinamentos', $array);

        if ($this->db->affected_rows() > 0) {
            // Code here after successful insert
            return true; // to the controller
        }

        return FALSE;
    }

    function remove($id) {
        return $this->db->delete('treinamentos', array('id' => $id));
    }

    function getTreinamentosDestaques() {
        $query = $this->db->get_where('treinamentos', array('destaque' => TRUE));

        return $query->result();
    }

    function getTreinamentosLike($campo) {
        $this->db->like('nome_pt', $campo);
        $this->db->or_like('nome_en', $campo);
        
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('treinamentos');
        
        return $query;
    }

}
