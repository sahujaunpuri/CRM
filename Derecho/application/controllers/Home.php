<?php
/*
 *
 * Sistema de horarios facultad de derecho Unicauca
 * Home.php, controlador de inicio
 *
 * Author: Andrés Fernando Foronda Espinal <andresforonda.af@gmail.com>
 * Date:   Mayo 12, 2018
 */

 
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('form');
        date_default_timezone_set('America/Bogota');
    }
	public function index()
	{
        redirect('login');
    }
    
    public function dashboard(){
        $this->load->view('view_home');
    }
}
