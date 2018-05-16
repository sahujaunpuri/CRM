<?php
/*
 *
 * Sistema de horarios facultad de derecho Unicauca
 * Model_usuario.php, modelo para validar el inicio de sesión.
 *
 * Author: Andrés Fernando Foronda Espinal <andresforonda.af@gmail.com>
 * Date:   Mayo 14, 2018
 */

 
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_usuario extends CI_Model {
    
    public function login($email, $password){
        $this->db->select('id ,nombre');
        $this->db->from('administradores');
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $this->db->where('estado', '1');
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1){
            return $query->result();
        } else {
            return FALSE;
        }
    }
}
