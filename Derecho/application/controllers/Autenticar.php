<?php
/*
 *
 * Sistema de horarios facultad de derecho Unicauca
 * Autenticar.php, controlador para validar el inicio de sesión.
 *
 * Author: Andrés Fernando Foronda Espinal <andresforonda.af@gmail.com>
 * Date:   Mayo 12, 2018
 */

 
defined('BASEPATH') OR exit('No direct script access allowed');

class Autenticar extends CI_Controller {
    public function __construct(){
        parent:: __construct();
        $this->load->model('model_usuario','model_usuario');
        $this->load->helper('url');
        $this->load->helper('security');
    }

    function index(){
        //$this->load->library('form_validation');
        $this->form_validation->set_message('required','Campo %s es obligatorio.');
        $this->form_validation->set_rules('email','E-mail','trim|required');
        $this->form_validation->set_message('required','Campo %s es obligatorio.');
        $data = $this->form_validation->set_rules('password','Contraseña','trim|required|callback_check_database');
        foreach ($data as $key => $value) {
            echo $key;
            foreach ($value as $keys => $values) {
                echo $values;
                # code...
            }
            # code...
        }
        if($this->form_validation->run() == FALSE){
            $this->load->view('view_login');
        } else {
            //redirect('home/dashboard','refresh');
        }    
    }

    function check_database($password){
        $login = $this->input->post('email');
        $result = $this->model_usuario->login($login, $password);
        $idUsuario = '';
        $nombreUsuario = '';
        if ($result){
            foreach ($result as $key ) {
                $datos['idUsuario'] = $key->id;
                $datos['nombreUsuario'] = $key->nombre;
            }
            return $datos;
        } else {
            $this->form_validation->set_message('check_database','
                Ops, algo salió mal, verifica tus credenciales.
            ');
            return FALSE;
        }
    }    
}