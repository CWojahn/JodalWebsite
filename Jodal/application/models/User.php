<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user
 *
 * @author Iuri
 */
Class User extends CI_Model {

    function login($username, $password) {
        $this->db->select('id, username, senha');
        $this->db->from('usuarios');
        $this->db->where('username', $username);
        $this->db->where('senha', sha1($password));
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function getUsers() {
        $query = $this->db->get('usuarios');

        return $query->result();
    }

    function insert($user) {
        return $this->db->insert('usuarios', $user);
    }

    function remove($id) {
        return $this->db->delete('usuarios', array('id' => $id));
    }

}
