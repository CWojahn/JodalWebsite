<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of slides_m
 *
 * @author Iuri
 */
class Slides_m extends CI_Model {

    //put your code here
    public function insert($data) {
        $this->db->insert('slides', $data);

        if ($this->db->affected_rows() > 0) {
            // Code here after successful insert
            return true; // to the controller
        }

        return FALSE;
    }
    
    public function delete($file) {
        $this->db->delete('slides', array('imagem' => $file)); 
    }
    
    public function select() {
        $this->db->order_by('id', 'asc');
        $this->db->where('idioma', 'pt');
        $query = $this->db->get('slides');
        
        return $query->result();
    }
    
    public function select_en() {
        $this->db->order_by('id', 'asc');
        $this->db->where('idioma', 'en');
        $query = $this->db->get('slides');
        
        return $query->result();
    }

}
