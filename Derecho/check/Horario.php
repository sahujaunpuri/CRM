<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Horario extends CI_Controller {
    function __construct(){
        parent:: __construct();
        $this->load->model('horario_m', 'm');
    }

    public function index()
    {
        $this->load->view('layout/header');
        $this->load->view('horario/index');
        $this->load->view('layout/footer');
    }

    public function getHoras(){
        $result = $this->m->getHoras();
        echo json_encode($result);
    }

    public function getProfesores(){
        $result = $this->m->getProfesores();
        echo json_encode($result);
    }

    public function getSemestres(){
        $result = $this->m->getSemestres();
        echo json_encode($result);
    }

    public function getSalones(){
        $result = $this->m->getSalones();
        echo json_encode($result);
    }

    public function getMaterias(){
        $result = $this->m->getMaterias();
        echo json_encode($result);
    }

    public function getGruposEstudiantes(){
        $result = $this->m->getGruposEstudiantes();
        echo json_encode($result);
    }

    public function getHorarioGrupo(){
        $result = $this->m->getHorarioGrupo();
        echo json_encode($result);
    }
    
    public function getEstadoProfesor(){
        $result = $this->m->getEstadoProfesor();
        echo json_encode($result);
    }

    public function getEditEstadoProfesor(){
        $result = $this->m->getEstadoProfesor();
        echo json_encode($result);
    }
    
    public function getEstadoSalon(){
        $result = $this->m->getEstadoSalon();
        echo json_encode($result);
    }

    public function getEditEstadoSalon(){
        //$result = $this->m->getEditEstadoSalon();
        //echo json_encode($result);
        echo json_encode('estado salon');
    }

    public function getEstadoGrupo(){
        $result = $this->m->getEstadoGrupo();
        echo json_encode($result);
    }

    public function getEditEstadoGrupo(){
        //$result = $this->m->getEditEstadoGrupo();
        //echo json_encode($result);
        echo json_encode('estado grupo');
    }

    public function getHorarioCompleto(){
        $result = $this->m->getHorarioCompleto();
        echo json_encode($result);
    }

    public function remove_schedule_row(){
        $result = $this->m->remove_schedule_row();
        echo json_encode($result);
    }


    //------------------------
  

    public function getHorarios(){
        $result = $this->m->getHorarios();
        echo json_encode($result);
    }

    public function getAdministradores(){
        $result = $this->m->getAdministradores();
        echo json_encode($result);
    }



    public function getHorasGrupo(){
        $result = $this->m->getHorasGrupo();
        echo json_encode($result);
    }
    
    public function getGruposSemestre(){
        $result = $this->m->getGruposSemestre();
        echo json_encode($result);
    }

    public function getFormulario(){
        $result = $this->m->getFormulario();
        echo json_encode($result);
    }


    public function addHorario(){
        $result = $this->m->addHorario();
        $msg['success'] = false;
        if($result){
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }



}
