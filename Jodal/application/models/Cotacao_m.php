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
class Cotacao_m extends CI_Model {

    //put your code here

    function insert($cotacao) {
        return $this->db->insert('cotacao', $cotacao);
    }

    function insert_orcamento($orcamento) {
        return $this->db->insert('orcamentos', $orcamento);
    }

    function getNroOrcamento() {
        $query = $this->db->query("SELECT COALESCE(max(id),0) nro_orc from orcamentos");

        return $query->row();
    }

    function getOrcamentos() {
        $query = $this->db->query("select orcamentos.id, clientes.empresa, clientes.email, orcamentos.data, orcamentos.valor_total, orcamentos.path_pdf from orcamentos
	inner join clientes
	on orcamentos.id_cliente = clientes.id order by orcamentos.id desc");
        return $query->result();
    }

    function remove_orc($id) {
        return $this->db->delete('orcamentos', array('id' => $id));
    }

    function getPdfOrcamento($id) {
        $this->db->select('path_pdf');
        $this->db->where('id', $id);

        $query = $this->db->get('orcamentos');

        if (!$query) {
            return;
        }
        if ($query->num_rows() > 0) {
            return $query->row();
        }
    }

    function getOrcamentoById($id) {
        $query = $this->db->query("select orcamentos.id, treinamentos.nome_pt, treinamentos.grade_curso_pt, clientes.empresa, clientes.email, clientes.responsavel, orcamentos.data, orcamentos.path_pdf from orcamentos
	inner join treinamentos
	on orcamentos.id_treinamento = treinamentos.id
	inner join clientes
	on orcamentos.id_cliente = clientes.id and orcamentos.id=$id");
        return $query->row();
    }

    function insertOrc($dados_orc, $dados_trein) {
        $this->db->trans_begin();

        $this->db->insert('orcamentos', $dados_orc);
        $this->db->insert_batch('orcamentos_treinamentos', $dados_trein);

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
        $this->db->update('orcamentos', $array);

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
