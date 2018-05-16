<?php
/**
 * Created by PhpStorm.
 * User: doit
 * Date: 2/3/18
 * Time: 10:09 PM
 */
?>
<h2>Horario</h2>
<form id="agregarHorarioNuevo" class="from-horizontal" method="post">
    <div class="form-group">
        <label for="semestre" class="control-label col-md-2">Semestre</label>
        <select name="semestre" id="semestre" class="add smg">
        </select>
    </div>
    <div class="form-group">
        <label for="grupo" class="control-label col-md-2">Grupo</label>
        <select name="grupo" id="grupo" class="add smg">
        </select>
        <span style="padding-left: 20px" class="text-danger noDisponible problemaGrupo" id="problemaGrupo"><strong>Este grupo tiene clase en este horario.</strong></span>
    </div>
    <div class="form-group">
        <label for="materia" class="control-label col-md-2">Materia</label>
        <select name="materia" id="materia" class="materia add smg">
        </select>
        <span style="padding-left: 20px" class="text-danger noDisponible problemaCarga" id="problemaCarga"><strong>Carga horaria x horas.</strong></span>
    </div>
    <div class="form-group">
        <label for="dia" class="control-label col-md-2">Dia</label>
        <select name="dia" id="dia" class="add">
            <option value="Lunes">Lunes</option>
            <option value="Martes">Martes</option>
            <option value="Miercoles">Miercoles</option>
            <option value="Jueves">Jueves</option>
            <option value="Viernes">Viernes</option>
            <option value="Sabado">Sabado</option>
        </select>
    </div>
    <div class="form-group">
        <label for="hora" class="control-label col-md-2">Hora</label>
        <select name="hora" id="hora" class="add">
        </select>
    </div>
    <div class="form-group">
        <label for="profesor" class="control-label col-md-2">Profesor</label>
        <select name="profesor" id="profesor" class="add ">
        </select>
        <span style="padding-left: 20px" class="text-danger noDisponible problemaProfesor" id="problemaProfesor"><strong>Profesor tiene clase en este horario.</strong></span>
    </div>
    <div class="form-group">
        <label for="salon" class="control-label col-md-2">salon</label>
        <select name="salon" id="salon" class="add">
        </select>
        <span style="padding-left: 20px" class="text-danger noDisponible problemaSalon" id="problemaSalon"><strong>Salon ocupado en este horario.</strong></span>
    </div>
</form>
<button id="btnAdd" class="btn btn-success btnAdd">+ Agregar</button>
<div class="container" style="overflow: scroll">
    <table class="table table-bordered table-responsive" style="margin-top: 20px">
        <thead>
        <tr>
            <td>Semestre</td>
            <td>Grupo</td>
            <td>Materia</td>
            <td>Profesor</td>
            <td>Dia</td>
            <td>Hora</td>
            <td>Salon</td>
            <td>Opciones</td>
        </tr>
        </thead>
        <tbody id="showdata">
        </tbody>
    </table>
</div>

<!--Modal para modificar horario -->
<div id="editModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title text-danger"></h4>
            </div>
            <div class="modal-body">
                <form id="editarHorarioForm" class="from-horizontal" method="post">

                    <div class="form-group">
                        <label for="semestreEdit" class="control-label col-md-3">Semestre</label>
                        <input name="semestre" id="semestreEdit" class="edit" hidden>
                        <span id="semestreNumero"></span>
                    </div>
                    <div class="form-group">
                        <label for="grupoEdit" class="control-label col-md-3">Grupo</label>
                        <input name="grupo" id="grupoEdit" class="edit" hidden>
                        <span id="grupoLetra"></span>
                        <span style="padding-left: 20px" class="text-danger noDisponible problemaGrupo" id="problemaGrupo"><strong>Este grupo tiene clase.</strong></span>
                    </div>
                    <div class="form-group">
                        <label for="materiaEdit" class="control-label col-md-3">Materia</label>
                        <input name="materia" id="materiaEdit" class="materia edit" hidden>
                        <span id="nombreMateria"></span>
                        <span style="padding-left: 20px" class="text-danger noDisponible problemaCarga" id="problemaCarga"><strong>Carga horaria x horas.</strong></span>
                    </div>

                    <div class="form-group">
                        <label for="diaEdit" class="control-label col-md-3">Dia</label>
                        <select name="dia" id="diaEdit" class="edit">
                            <option value="Lunes">Lunes</option>
                            <option value="Martes">Martes</option>
                            <option value="Miercoles">Miercoles</option>
                            <option value="Jueves">Jueves</option>
                            <option value="Viernes">Viernes</option>
                            <option value="Sabado">Sabado</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="horaEdit" class="control-label col-md-3">Hora</label>
                        <select name="hora" id="horaEdit" class="edit">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="profesorEdit" class="control-label col-md-3">Profesor</label>
                        <select name="profesor" id="profesorEdit" class="edit">
                        </select>
                        <span style="padding-left: 20px" class="text-danger noDisponible problemaProfesor" id="problemaProfesorEdit"><strong>Profesor tiene clase.</strong></span>
                    </div>
                    <div class="form-group">
                        <label for="salonEdit" class="control-label col-md-3">salon</label>
                        <select name="salon" id="salonEdit" class="edit">
                        </select>
                        <span style="padding-left: 20px" class="text-danger noDisponible problemaSalon" id="problemaSalonEdit"><strong>Salon ocupado en este horario.</strong></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="btnAddEdit">Actualizar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--Modal para borrar una fila del horario-->
<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title text-danger"></h4>
            </div>
            <div class="modal-body">
                <h4>¿Está seguro de que desea borrar este horario?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-danger" id="btnDeleteRow" >Si</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    let addBtnState = 0;
    let smgState = 0;
    // Inicialización de la aplicación

    // Cargar formulario para editar una fila del horario: hora, dia o profesor.

    function cargarFormularioEdicion(data) {
        const schedule_id = $(data).parents("tr").attr("id");
        const semestre = $('#semestre-' + schedule_id).text();
        const grupo = $('#grupo-' + schedule_id).text();
        const materia = $('#materia-' + schedule_id);

        // Agregar valores a campos input
        $('#semestreNumero').text(semestre);
        $('#semestreEdit').val(semestre);
        $('#grupoLetra').text(grupo);
        $('#grupoEdit').val(grupo);
        $('#nombreMateria').text(materia.text());
        $('#materiaEdit').val($(materia).attr('name'));
        $('#editModal').modal('show').find('.modal-title').text('Editar horario:');
        addBtnState = 0;
        smgState = 0;
        recargarDiasHoras('#editarHorarioForm','#horaEdit');
        estadoBtnAdd('#editarHorarioForm');
        smgStateValidator('#editarHorarioForm');

        // Cargar los profesores en la lista desplegable
        const profesores = obtProfesores();
        let mostrarProfesores = '';
        for (let i = 0; i < profesores.length; i++) {
            mostrarProfesores += '<option value=' + profesores[i].CORREOPROF + '>' + profesores[i].NOMBREPROF + '</option>';
        }
        $('#profesorEdit').html(mostrarProfesores);

        // Cargar los salones en la lista desplegable
        const salones = obtSalones();
        let mostrarSalones = '';
        for (let i = 0; i < salones.length; i++) {
            mostrarSalones += '<option value=' + salones[i].NUMEROSALON + '>' + salones[i].NUMEROSALON + '</option>';
        }
        $('#salonEdit').html(mostrarSalones);
    }
    


    // Llena los campos desplegables del formulario desde la base de datos
    
        // Devuelve numero de horas deacuerdo al ID de horas

    

    // Estas funciones leen en la base de datos las horas, profesores, salones, materias, grupos y semestres, con el fin de cargar la informacion en las listas desplegables
    
    
    function recargarDiasHoras(form, hor) {
      let caso = '';
      // Obtener horario para el grupo
      const dat = $(form).serialize();
      const horarioG = horarioGrupo(dat);
      // console.log(horarioG);
      let a = 0;
      //Determinando que hacer con los horarios
      if (horarioG === false) {
        caso = 0; //no horarios asignados
      }
      else {
        horarioG.forEach(function (element) {
          if (horasHora(element.HORASBLOQUE) === 4) {
            caso = 1; // 1 horario 4 horas
          } else {
            caso = 2; // 1 horario 2 horas
            a += 1;
            if (a === 2) {
              caso = 3; // 2 horarios 2 horas
            }
          }

        }, this);
      }
      if (form === '#agregarHorarioNuevo') {
        switch (caso) {
          case 0:
            $(hor).prop('disabled', false);
            break;
          case 2:
            $(hor).prop('disabled', false);
            quitarHoras4(hor);
            break;
          default:
            $(hor).prop('disabled', 'disabled');
            addBtnState = 1;
            smgState = 1;
        }
      }
      if (form === '#editarHorarioForm') {
        switch (caso) {
          case 3:
            $(hor).prop('disabled', false);
            quitarHoras4(hor);
            break;
          default:
            $(hor).prop('disabled', false);

        }
      }
    }

    // Verificar disponibilidad al cambiar algún valor en las listas de selección

    $(".add").change(
        function () {
            addBtnState = 0;
            disponibilidad('#agregarHorarioNuevo');
            estadoBtnAdd('#agregarHorarioNuevo');
        }
    );

    $(".edit").change(
        function(){
            addBtnState = 0;
            disponibilidad('#editarHorarioForm');
            estadoBtnAdd('#editarHorarioForm');
        }
    );

    // Esta función verifica cuando se cambia el semestre, luego carga los grupos disponibles y las materias que pertenecen a ese semestre.

    $("#semestre").change(
        function () {
            addBtnState = 0;
            smgState = 0;
            semestreSeleccionado = $('#semestre').val();
            if (semestreSeleccionado === '-1') {
                actualizarEstadoFormulario();
            }
            else {
                actualizarEstadoFormulario();

                // Mostrar los grupos disponibles para el semestre seleccionado

                const gruposE = obtGruposEstudiantes();
                let grupo = [];
                for (let i = 0; i < gruposE.length; i++) {
                    if (gruposE[i].SEMESTREGRUPO === semestreSeleccionado) {
                        grupo.push(gruposE[i].GRUPO);
                    }
                }
                let mostrarGrupos = '';
                for (let i = 0; i < grupo.length; i++) {
                    mostrarGrupos += '<option value=' + grupo[i] + '>' + grupo[i] + '</option>';
                }
                $('#grupo').html(mostrarGrupos);

                // Mostrar las materias disponibles para el semestre seleccionado

                let materiasFull = obtMaterias();
                let materia = [];
                for (let i = 0; i < materiasFull.length; i++) {
                    if (materiasFull[i].SEMESTREMAT === semestreSeleccionado) {
                        materia.push([materiasFull[i].NOMBREMAT, materiasFull[i].IDMATERIA]);
                    }
                }
                let mostrarMaterias = '';
                for (let i = 0; i < materia.length; i++) {
                    mostrarMaterias += '<option value=' + materia[i][1] + '>' + materia[i][0] + '</option>';
                }
                $('#materia').html(mostrarMaterias);

                //Verificar disponibilidad salón, profesor y grupo.
                
                disponibilidad('#agregarHorarioNuevo');
                recargarDiasHoras('#agregarHorarioNuevo','#hora');
                smgStateValidator('#agregarHorarioNuevo');
                
                
            }
            estadoBtnAdd('#agregarHorarioNuevo');
        }
    );

    function cargarFormulario() {
      // Cargar los semestres en la lista desplegable
      const semestres = obtSemestres();
      let mostrarSemestres = '';
      mostrarSemestres += '<option value=-1>NINGUNO</option>';
      for (let i = 0; i < semestres.length; i++) {
        mostrarSemestres += '<option value=' + semestres[i].semestremat + '>' + semestres[i].semestremat + '</option>';
      }
      $('#semestre').html(mostrarSemestres);

      // Cargar las horas en la lista desplegable
      const horas = obtHoras();
      let mostrarHoras = '';
      for (let i = 0; i < horas.length; i++) {
        mostrarHoras += '<option value=' + horas[i].IDHORA + '>' + horas[i].HORAS + '</option>';
      }
      $('#hora').html(mostrarHoras);

      // Cargar los profesores en la lista desplegable
      const profesores = obtProfesores();
      let mostrarProfesores = '';
      for (let i = 0; i < profesores.length; i++) {
        mostrarProfesores += '<option value=' + profesores[i].CORREOPROF + '>' + profesores[i].NOMBREPROF + '</option>';
      }
      $('#profesor').html(mostrarProfesores);

      // Cargar los salones en la lista desplegable
      const salones = obtSalones();
      let mostrarSalones = '';
      for (let i = 0; i < salones.length; i++) {
        mostrarSalones += '<option value=' + salones[i].NUMEROSALON + '>' + salones[i].NUMEROSALON + '</option>';
      }
      $('#salon').html(mostrarSalones);

      actualizarEstadoFormulario();
    }

</script>