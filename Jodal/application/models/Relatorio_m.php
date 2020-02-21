<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Relatorio_m
 *
 * @author Carlos.Wojahn
 */
class Relatorio_m extends CI_Model {

    //put your code here

    function insert($relatorio) {
        return $this->db->insert('relatorio', $relatorio);
    }

    function insert_relatorio($relatorio) {
        return $this->db->insert('relatorios', $relatorio);
    }

    function getNroRelatorio() {
        $query = $this->db->query("SELECT COALESCE(max(id),0) nro_relatorio FROM relatorio");

        return $query->row();
    }

    function getRelatorio() {
        $query = $this->db->query("SELECT relatorios.id, clientes.empresa, clientes.email,
                                    relatorios.data, relatorios.obra, relatorios.local,
                                    relatorios.tst_name, relatorios.path_pdf, clientes.responsavel
                                   FROM relatorios
	                               INNER JOIN clientes
	                               ON relatorios.id_cliente = clientes.id 
                                   ORDER BY relatorios.id DESC");
        return $query->result();
    }

    function remove_rel($id) {
        return $this->db->delete('relatorios', array('id' => $id));
    }

    function getPdfRelatorio($id) {
        $this->db->select('path_pdf');
        $this->db->where('id', $id);

        $query = $this->db->get('relatorios');

        if (!$query) {
            return;
        }
        if ($query->num_rows() > 0) {
            return $query->row();
        }
    }

    function getRelatorioById($id) {
        $query = $this->db->query("SELECT relatorios.id, clientes.empresa, clientes.email,
                                    relatorios.data, relatorios.obra, relatorios.local, relatorios.tst_name, relatorios.path_pdf,
                                    clientes.responsavel
                                   FROM relatorios
	                               INNER JOIN clientes
	                               ON relatorios.id_cliente = clientes.id AND relatorios.id=$id");
        return $query->row();
    }

    function getRelatorioByCliente($cliente){
        $query = $this->db->query("SELECT relatorios.id, clientes.empresa, clientes.email,
                                    relatorios.data, relatorios.obra, relatorios.local, relatorios.tst_name, relatorios.path_pdf,
                                    clientes.responsavel
                                   FROM relatorios
	                               INNER JOIN clientes
	                               ON relatorios.id_cliente = clientes.id AND relatorios.id_cliente=%cliente");
        return $query->row();
    }

    function getRelatorioByObra($obra) {
        $query = $this->db->query("SELECT relatorios.id, clientes.empresa, clientes.email,
                                    relatorios.data, relatorios.obra, relatorios.local, relatorios.tst_name, relatorios.path_pdf,
                                    clientes.responsavel
                                   FROM relatorios
	                               INNER JOIN clientes
	                               ON relatorios.id_cliente = clientes.id AND relatorios.obra like '%$obra%'");
        return $query->row();
    }

    function insertRel($dados_rel, $dados_obs) {
        $this->db->trans_begin();

        $this->db->insert('relatorios', $dados_rel);
        $this->db->insert_batch('observacoes_relatorios', $dados_obs);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    function update($id, $array) {

        $this->db->where('id', $id);
        $this->db->update('relatorios', $array);

        if ($this->db->affected_rows() > 0) {
            // Code here after successful insert
            return true; // to the controller
        }

        return FALSE;
    }

    /*
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
      } */
}
