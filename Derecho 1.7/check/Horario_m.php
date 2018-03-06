<?php
/**
 * Created by PhpStorm.
 * User: doit
 * Date: 2/4/18
 * Time: 12:55 AM
 */


defined('BASEPATH') OR exit('No direct script access allowed');

class Horario_m extends CI_Model{


    public function getValues($table = NULL, $columns = NULL, $where = NULL) /* get single column value from table */ 
    {
        if ($table != null && $where != NULL && $columns == NULL) {
            $query = $this->db->get_where($table, $where);
        } else {
            if($table != null && $where != NULL && $columns != NULL) {
            $query = $this->db->select($columns)->from($table)->where($where)->get();
            }
            else {
                $query = $this->db->select($columns)->from($table)->get();
            }
        }
        $res   = !empty($query->result());
        $resF   = $query->result();
        if ($res) {
            return $resF;
        } else {
            return NULL;
        }
    }

    public function getHoras(){
        $query = $this->db->get('hora');
        if($query->num_rows() > 0){
            return $query->result();
        } else{
            return false;
        }
    }

    public function getProfesores(){
        $query = $this->db->get('profesor');
        if($query->num_rows() > 0){
            return $query->result();
        } else{
            return false;
        }
    }

    public function getSemestres(){
        $query = $this->db->select('semestremat')->from('materia')->distinct()->order_by('semestremat', 'ASC')->get();
        if($query->num_rows() > 0){
            return $query->result();
        } else{
            return false;
        }
    }

    public function getHorarioGrupo(){

        $field = array(
            'ANIOPERIODOACA'=>'2018',
            'SUBSEMESTREPERIODOACA'=>'1',
            'GRUPO'=>$this->input->post('grupo'),
            'IDMATERIA'=>$this->input->post('materia')
        );
        $query = $this->db->get_where('bloquehorario', $field);

        if($query->num_rows() > 0){
            return $query->result();
        } else{
            return false;
        }
    }

    public function getSalones(){
        $query = $this->db->get('salon');
        if($query -> num_rows() > 0){
            return $query->result();
        } else {
            return false;
        }
    }

    public function getMaterias(){
        $query = $this->db->get('materia');
        if($query->num_rows() > 0){
            return $query->result();
        } else{
            return false;
        }
    }

    public function getGruposEstudiantes(){
        $query = $this->db->get('grupoestudiantes');
        if($query -> num_rows() > 0){
            return $query->result();
        } else {
            return false;
        }
    }

    public function getEstadoProfesor(){
        $field = array(
            'CORREOPROF'=>$this->input->post('profesor'),
            'HORASBLOQUE'=>$this->input->post('hora'),
            'DIABLOQUE'=>$this->input->post('dia')
        );
        $query = $this->db->get_where('bloquehorario', $field);
        if($query -> num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }

    public function getEstadoSalon(){
        $field = array(
            'NUMEROSALON'=>$this->input->post('salon'),
            'HORASBLOQUE'=>$this->input->post('hora'),
            'DIABLOQUE'=>$this->input->post('dia')
        );
        $query = $this->db->get_where('bloquehorario    ', $field);
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }

    public function getEstadoGrupo(){
        $field = array(
            'SEMESTREGRUPO'=>$this->input->post('semestre'),
            'GRUPO'=>$this->input->post('grupo'),
            'DIABLOQUE'=>$this->input->post('dia'),
            'HORASBLOQUE'=>$this->input->post('hora'),
        );
        $query = $this->db->get_where('bloquehorario', $field);
        if($query -> num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }

    public function getHorarioCompleto(){
        $query = $this->db->query("SELECT bloquehorario.IDBLOQUEHO, bloquehorario.SEMESTREGRUPO, bloquehorario.GRUPO, materia.NOMBREMAT, bloquehorario.CORREOPROF, bloquehorario.NUMEROSALON, bloquehorario.DIABLOQUE, bloquehorario.IDMATERIA,bloquehorario.HORASBLOQUE FROM bloquehorario JOIN materia USING (IDMATERIA)");
        $arra = $query->result();
        for ($i=0; $i < count($arra); $i++) {
            $this->db->select('profesor.NOMBREPROF');
            $this->db->from('profesor');
            $this->db->where('profesor.CORREOPROF',$arra[$i]->CORREOPROF);
            $quer=$this->db->get();
            $prof= $quer->result();
            $arra[$i]->CORREOPROF =  $prof;
        }
        if($query -> num_rows() > 0){
            return $query->result();
        } else {
            return false;
        }
    }

    public function delHorario(){
        $field = array(
            'IDBLOQUEHO'=>$this->input->post('idbloqueho')
        );

        $query =  $this->db->delete('bloquehorario', $field);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function remove_schedule_row(){
        $field = array(
            'IDBLOQUEHO'=>$this->input->post('idbloqueho')
        );

        $query =  $this->db->delete('bloquehorario', $field);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    //----------------------------------



    public function getGruposSemestre(){
        $SEMESTRE = $this->input->post('semestre');
        $field = array(
            'SEMESTREGRUPO'=>$this->input->post('semestre')
        );
        $query = $this->db->get_where('GRUPOESTUDIANTES',array('SEMESTREGRUPO' => $SEMESTRE));
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }







    public function getHorarios(){
        $query = $this->db->get('bloquehorario');
        if($query -> num_rows() > 0){
            return $query->result();
        } else {
            return false;
        }

    }

    public function getAdministradores(){
        $query = $this->db->get('administrador');
        if($query -> num_rows() > 0){
            return $query->result();
        } else {
            return false;
        }

    }




     public function addHorario(){
        $field = array(
            'GRUPO'=>$this->input->post('grupo'),
            'SEMESTREGRUPO'=>$this->input->post('semestre'),
            'NUMEROSALON'=>$this->input->post('salon'),
            'HORASBLOQUE'=>$this->input->post('hora'),
            'DIABLOQUE'=>$this->input->post('dia'),
            'CORREOPROF'=>$this->input->post('profesor'),
            'IDMATERIA'=>$this->input->post('materia'),
            'ANIOPERIODOACA'=>'2018',
            'SUBSEMESTREPERIODOACA'=>'1'
        );
       
        $query =  $this->db->insert('BLOQUEHORARIO', $field);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function getFormulario(){
        $field = array(
            'GRUPO'=>$this->input->post('grupo'),
            'SEMESTREGRUPO'=>$this->input->post('semestre'),
            'NUMEROSALON'=>$this->input->post('salon'),
            'HORASBLOQUE'=>$this->input->post('hora'),
            'DIABLOQUE'=>$this->input->post('dia'),
            'CORREOPROF'=>$this->input->post('profesor'),
            'IDMATERIA'=>$this->input->post('materia'),
            'ANIOPERIODOACA'=>'2018',
            'SUBSEMESTREPERIODOACA'=>'1'
        );
       
        $query =  $this->db->get_where('BLOQUEHORARIO', $field);
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }

    

    


    public function getHorasGrupo(){
        $field = array(
            'GRUPO'=>$this->input->post('grupo'),
            'SEMESTREGRUPO'=>$this->input->post('semestre'),
            'HORASBLOQUE'=>$this->input->post('hora'),
            'DIABLOQUE'=>$this->input->post('dia'),
            'IDMATERIA'=>$this->input->post('materia')

        );

        $query = $this->db->select('HORASBLOQUE')->from('BLOQUEHORARIO')->where( $field)->get();
        // $query = $this->db->get_where('BLOQUEHORARIO', $field);


        if($this->db->affected_rows() > 0){
            return $query->result();
        }else{
            return "Sin horas registradas";
        }
    }
}



