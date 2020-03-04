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
class Relatorios_m extends CI_Model {

    //put your code here

    function createData($data) {
       $query= $this->db->insert('relatorios', $data);
       return $query;
    }

    function insert_pcmat($data) {
        $query = $this->db->insert('relatorio_pcmat', $data);
        return $query;
    }

    // **** Alterar ****
    // Outro tipo de relatorio
    // function insert_pcmat($relatorio) {
    //     return $this->db->insert('relatorio_pcmat', $relatorio);
    // }

    function getNroRelatorio() {
        $query = $this->db->query("SELECT COALESCE(max(id),0) nro_relatorio FROM relatorios");
        return $query->row();
    }

    function getNroRelatorioPcmat() {
        $query = $this->db->query("SELECT COALESCE(max(id),0) nro_relatorio FROM relatorio_pcmat");
        return $query->row();
    }

    function getRelatorios() {
        $query = $this->db->query("select relatorios.id, 
                                    relatorios.data, relatorios.obra, relatorios.local,clientes.empresa,
                                    relatorios.tipo, clientes.email, relatorios.tipo
                                   from relatorios
	                               inner join clientes
	                               on relatorios.id_cliente = clientes.id 
                                   order by relatorios.data desc");
        return $query->result();
    }

    function remove_relatorio($id) {
        return $this->db->delete('relatorios', array('id' => $id));
    }

    function remove_imagemPcmat($id) {
        return $this->db->delete('relatorio_pcmat', array('id' => $id));
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

    function getPcmatImagesById($id){
        return $this->db->get_where('relatorio_pcmat', array('id_relatorio' =>$id))->result();
    }

    function getRelatorioById($id) {
        //$this->db->select('id','id_cliente', 'obra', 'data', 'local');
        $query = $this->db->query("SELECT relatorios.id, relatorios.id_cliente,
                                        relatorios.obra, relatorios.data, relatorios.local, relatorios.tst_name,
                                        relatorios.observacoes
                                    FROM relatorios
                                    where relatorios.id=$id");
        return $query->row();
    }

    function getRelatorioByCliente($cliente){
        $query = $this->db->query("SELECT relatorios.id, clientes.empresa, clientes.email,
                                    relatorios.data, relatorios.obra, relatorios.local, relatorios.tst_name, relatotios.observacoes, relatorios.path_pdf,
                                    clientes.responsavel
                                   FROM relatorios
	                               INNER JOIN clientes
	                               ON relatorios.id_cliente = clientes.id AND relatorios.id_cliente=%cliente");
        return $query->row();
    }

    function getRelatorioByObra($obra) {
        $query = $this->db->query("SELECT relatorios.id, clientes.empresa, clientes.email,
                                    relatorios.data, relatorios.obra, relatorios.local, relatorios.tst_name, relatotios.observacoes, relatorios.path_pdf,
                                    clientes.responsavel
                                   FROM relatorios
	                               INNER JOIN clientes
	                               ON relatorios.id_cliente = clientes.id AND relatorios.obra like '%$obra%'");
        return $query->row();
    }

    function insertPcmat($dados_rel, $dados_obs) {
        $this->db->trans_begin();

        $this->db->insert('relatorios', $dados_rel);
        $this->db->insert_batch('relatorio_pcmat', $dados_obs);

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
