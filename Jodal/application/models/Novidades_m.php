<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Novidades_m extends CI_Model {
    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */

    public function getArtigos() {
        $query = $this->db->get('novidades');

        return $query->result();
    }
    
    public function getArtigosPublicos() {
        $this->db->select('novidades.id, novidades.nome, novidades.desc_curta, img.path');
        $this->db->from('novidades');
        $this->db->join('novidades_img img', 'novidades.id=img.id_novidade and img.order=0', 'inner');

        $query = $this->db->get();
        return $query->result();
    }
    
    public function getArtigosPrivados() {
        $this->db->select('novidades.id, novidades.nome, novidades.desc_curta, img.path');
        $this->db->from('novidades');
        $this->db->join('novidades_img img', 'novidades.id=img.id_artigo and novidades.privado=1 and img.order=0', 'inner');

        $query = $this->db->get();
        return $query->result();
    }

    public function getArtigoDetail($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('novidades');

        return $query->row();
    }

    public function updateImg($id, $imagem) {
        $data = array(
            'imagem' => $imagem
        );

        $this->db->where('id', $id);
        $this->db->update('novidades', $data);
    }

    public function insert($data) {
        //$this->db->insert('servicos', $data);
        //if ($this->db->affected_rows() > 0) {
        //    return true;
        //}

        $this->db->trans_start();
        $this->db->insert('novidades', $data);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    public function delete($id) {
        $this->db->delete('novidades', array('id' => $id));

        if ($this->db->affected_rows() > 0) {
            // Code here after successful insert
            return true; // to the controller
        }

        return FALSE;
    }

    public function updateArtigo($id, $data) {

        $this->db->where('id', $id);
        $this->db->update('novidades', $data);

        if ($this->db->affected_rows() > 0) {
            // Code here after successful insert
            return true; // to the controller
        }

        return FALSE;
    }
    
    public function getRestritoDestaques() {

        
        $this->db->select('novidades.id, novidades.nome, novidades.desc_curta');
        $this->db->from('novidades');
        $this->db->where('destaque', 1);
        
        $query = $this->db->get();
        return $query->result();
        
    }
    
    public function getArtigosDestaques() {

        $this->db->select('novidades.id, novidades.nome, novidades.desc_curta, imagens.path');
        $this->db->from('novidades');
        $this->db->join('novidades_img imagens', 'novidades.id=imagens.id_novidade and imagens.order=0 and novidades.destaque=1', 'inner');

        
        $query = $this->db->get();
        return $query->result();
        
    }



}
