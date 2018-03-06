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
    <select name="semestre" id="semestre"></select>
  </div>
  <div class="form-group">
    <label for="grupo" class="control-label col-md-2">Grupo</label>
    <select name="grupo" id="grupo" class="add"></select>
    <span style="padding-left: 20px" class="text-danger noDisponible problemaGrupo" id="problemaGrupo"><strong>Este grupo tiene clase en este horario.</strong></span>
  </div>
  <div class="form-group">
    <label for="materia" class="control-label col-md-2">Materia</label>
    <select name="materia" id="materia" class="materia add"></select>
    <span style="padding-left: 20px" class="text-danger problemaCarga" id="problemaCargaAdd"><strong></strong></span>
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
    <select name="hora" id="hora" class="add"></select>
  </div>
  <div class="form-group">
    <label for="profesor" class="control-label col-md-2">Profesor</label>
    <select name="profesor" id="profesor" class="add"></select>
    <span style="padding-left: 20px" class="text-danger noDisponible problemaProfesor" id="problemaProfesor"><strong>Profesor tiene clase en este horario.</strong></span>
  </div>
  <div class="form-group">
    <label for="salon" class="control-label col-md-2">salon</label>
    <select name="salon" id="salon" class="add"></select>
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
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
              aria-hidden="true">&times;</span>
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
            <span style="padding-left: 20px" class="text-danger problemaCarga" id="problemaCargaEdit"><strong></strong></span>
          </div>
          <div class="form-group">
            <label for="diaEdit" class="control-label col-md-3">Dia</label>
            <select name="dia" id="diaEdit" class="edit"></select>
          </div>
          <div class="form-group">
            <label for="horaEdit" class="control-label col-md-3">Hora</label>
            <select name="hora" id="horaEdit" class="edit"></select>
          </div>
          <div class="form-group">
            <label for="profesorEdit" class="control-label col-md-3">Profesor</label>
            <select name="profesor" id="profesorEdit" class="edit"></select>
            <span style="padding-left: 20px" class="text-danger noDisponible problemaProfesor"
                  id="problemaProfesorEdit"><strong>Profesor tiene clase.</strong></span>
          </div>
          <div class="form-group">
            <label for="salonEdit" class="control-label col-md-3">salon</label>
            <select name="salon" id="salonEdit" class="edit"></select>
            <span style="padding-left: 20px" class="text-danger noDisponible problemaSalon"
                  id="problemaSalonEdit"><strong>Salon ocupado en este horario.</strong></span>
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
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
              aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title text-danger"></h4>
      </div>
      <div class="modal-body">
        <h4>¿Está seguro de que desea borrar este horario?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-danger" id="btnDeleteRow">Si</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>

  // Inicialización de la aplicación

  mostrarHorarioCompleto();
  cargarFormulario();
  // Ocultar span con errores de disponibilidad

  $(".noDisponible").css("visibility", "hidden");
  // Fin inicializacion

  // Eliminar una fila del horario permanentemente.

  function delete_row(data) {
    const remove_schedule_id = $(data).parents("tr").attr("id");
    $('#deleteModal').modal('show').find('.modal-title').text('Borrar horario');
    $('#btnDeleteRow').prop('name', remove_schedule_id);
  }

  $('#btnDeleteRow').click(function () {
    const remove_schedule_id = this.name;
    $('#' + remove_schedule_id).remove();
    $('#deleteModal').modal('hide');
    $.post('<?php echo base_url('horario/remove_schedule_row') ?>', {idbloqueho: remove_schedule_id}, function (data) {
      if (data === 'true') {
        console.log('Removed');
      }
      else {
        console.log('Not Removed');
      }
    });
  });

  // Llena los campos desplegables del formulario desde la base de datos

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

  // Cargar formulario para editar una fila del horario: hora, salón, dia o profesor.

  function cargarFormularioEdicion(data) {
    const schedule_id = $(data).parents("tr").attr("id");
    const hora = $('#hora-' + schedule_id).attr('name');
    const semestre = $('#semestre-' + schedule_id).text();
    const salon = $('#salon-' + schedule_id).text();
    const dia = $('#dia-' + schedule_id).text();
    const grupo = $('#grupo-' + schedule_id).text();
    const materia = $('#materia-' + schedule_id);
    const profesor = $('#profesor-' + schedule_id).attr('name');

    // Agregar valores a campos input
    $('#semestreNumero').text(semestre);
    $('#semestreEdit').val(semestre);
    $('#grupoLetra').text(grupo);
    $('#grupoEdit').val(grupo);
    $('#nombreMateria').text(materia.text());
    $('#materiaEdit').val($(materia).attr('name'));
    $('#editModal').modal('show').find('.modal-title').text('Editar horario:');
    $('#diaEdit').html(
        '<option value=' + dia + ' selected>' + dia + '</option>' +
        '<option value="Lunes">Lunes</option>\n' +
        '<option value="Martes">Martes</option>\n' +
        '<option value="Miercoles">Miercoles</option>\n' +
        '<option value="Jueves">Jueves</option>\n' +
        '<option value="Viernes">Viernes</option>\n' +
        '<option value="Sabado">Sabado</option>'
    );

    // Cargar las horas en la lista desplegable
    const horas = obtHoras();
    let mostrarHoras = '';
    mostrarHoras += '<option value=' + hora + '>' + formatoHora(hora) + '</option>';
    for (let i = 0; i < horas.length; i++) {
      mostrarHoras += '<option value=' + horas[i].IDHORA + '>' + horas[i].HORAS + '</option>';
    }
    $('#horaEdit').html(mostrarHoras);

    // Cargar los profesores en la lista desplegable
    const profesores = obtProfesores();
    let mostrarProfesores = '';
    for (let i = 0; i < profesores.length; i++) {
      if (profesor === profesores[i].NOMBREPROF) {
        mostrarProfesores += '<option value=' + profesores[i].CORREOPROF + ' selected>' + profesores[i].NOMBREPROF + '</option>';
      }
      mostrarProfesores += '<option value=' + profesores[i].CORREOPROF + '>' + profesores[i].NOMBREPROF + '</option>';
    }
    $('#profesorEdit').html(mostrarProfesores);

    // Cargar los salones en la lista desplegable
    const salones = obtSalones();

    let mostrarSalones = '<option value=' + salon + ' selected>' + salon + '</option>';
    for (let i = 0; i < salones.length; i++) {
      mostrarSalones += '<option value=' + salones[i].NUMEROSALON + '>' + salones[i].NUMEROSALON + '</option>';
    }
    $('#salonEdit').html(mostrarSalones);
    disponibilidad('#editarHorarioForm');
  }


  // Se verifica si se ha seleccionado un semestre, de ser así se habilita el formulario, en caso contrario, el formulario permanece deshabilitado

  function actualizarEstadoFormulario() {
    const semestreSeleccionado = $("#semestre").val();
    if (semestreSeleccionado === '-1') {
      $('#profesor').prop('disabled', 'disabled');
      $('#dia').prop('disabled', 'disabled');
      $("#hora").prop('disabled', 'disabled');
      $('#salon').prop('disabled', 'disabled');
      $('#grupo').prop('disabled', 'disabled');
      $('#materia').prop('disabled', 'disabled');
      $('#btnAdd').prop('disabled', 'disabled');
    }
    else {
      $('#profesor').prop('disabled', false);
      $('#dia').prop('disabled', false);
      $("#hora").prop('disabled', false);
      $('#salon').prop('disabled', false);
      $('#grupo').prop('disabled', false);
      $('#materia').prop('disabled', false);
    }
  }

  // Despliega el horario guardado en la base de datos actualmente

  function mostrarHorarioCompleto() {
    $.ajax({
      type: 'ajax',
      url: '<?php echo base_url()?>horario/getHorarioCompleto',
      async: false,
      dataType: 'json',
      success: function (data) {
        let html = '';
        for (let i = 0; i < data.length; i++) {
          html += '<tr id="' + data[i].IDBLOQUEHO + '">' +
              '<td id="semestre-' + data[i].IDBLOQUEHO + '">' + data[i].SEMESTREGRUPO + '</td >' +
              '<td id="grupo-' + data[i].IDBLOQUEHO + '">' + data[i].GRUPO + '</td>' +
              '<td id="materia-' + data[i].IDBLOQUEHO + '" name="' + data[i].IDMATERIA + '">' + data[i].NOMBREMAT + '</td>' +
              '<td id="profesor-' + data[i].IDBLOQUEHO + '" name="' + data[i].CORREOPROF[0].NOMBREPROF + '">' + data[i].CORREOPROF[0].NOMBREPROF + '</td>' +
              '<td id="dia-' + data[i].IDBLOQUEHO + '">' + data[i].DIABLOQUE + '</td>' +
              '<td id="hora-' + data[i].IDBLOQUEHO + '" name="' + data[i].HORASBLOQUE + '">' + formatoHora(data[i].HORASBLOQUE) + '</td>' +
              '<td id="salon-' + data[i].IDBLOQUEHO + '">' + data[i].NUMEROSALON + '</td>' +
              '<td>' +
              '<a href="javascript:;" id="btnEdit-' + data[i].IDBLOQUEHO + '" class="btn btn-info" onclick="cargarFormularioEdicion(this)">Editar</a>' +
              '<a href="javascript:;" id="btnDelete-' + data[i].IDBLOQUEHO + '" class="btn btn-danger" onclick="delete_row(this)">Eliminar</a>' +
              '</td>' +
              '</tr>';
          //btnId = 1 + btnId;
        }
        $('#showdata').html(html);
      },
      error: function () {
        alert('No se puede conectar a la base de datos.');
      }
    });
  }

  // Da formato a la hora obtenida desde la base de datos, se espera un numero entre 0 y 12

  function formatoHora(idHora) {
    let horaTexto = '';
    switch (parseInt(idHora)) {
      case 0:
        horaTexto = 'Ninguna';
        break;
      case 1:
        horaTexto = '7:00A.M. - 9:00A.M.';
        break;
      case 2:
        horaTexto = '7:00A.M. - 11:00A.M.';
        break;
      case 3:
        horaTexto = '9:00A.M. - 11:00A.M.';
        break;
      case 4:
        horaTexto = '8:00A.M. - 10:00A.M.';
        break;
      case 5:
        horaTexto = '8:00A.M. - 12:00M.';
        break;
      case 6:
        horaTexto = '10:00A.M. - 12:00M.';
        break;
      case 7:
        horaTexto = '11:00A.M. - 1:00P.M.';
        break;
      case 8:
        horaTexto = '2:00P.M. - 4:00P.M.';
        break;
      case 9:
        horaTexto = '4:00P.M. - 6:00P.M.';
        break;
      case 10:
        horaTexto = '6:00P.M. - 8:00P.M.';
        break;
      case 11:
        horaTexto = '6:00P.M. - 10:00P.M.';
        break;
      case 12:
        horaTexto = '8:00P.M. - 10:00P.M.';
        break;
      default:
        horaTexto = 'Ninguna';
    }
    return horaTexto;
  }

  function numeroDeHoras(idHora) {
    let horas = '';
    switch (parseInt(idHora)) {
      case 0:
        horas = 0;
        break;
      case 1:
        horas = 2;
        break;
      case 2:
        horas = 4;
        break;
      case 3:
        horas = 2;
        break;
      case 4:
        horas = 2;
        break;
      case 5:
        horas = 4;
        break;
      case 6:
        horas = 2;
        break;
      case 7:
        horas = 2;
        break;
      case 8:
        horas = 2;
        break;
      case 9:
        horas = 2;
        break;
      case 10:
        horas = 2;
        break;
      case 11:
        horas = 4;
        break;
      case 12:
        horas = 2;
        break;
      default:
        horas = 0;
    }
    return horas;
  }

  // Estas funciones leen en la base de datos las horas, profesores, salones, materias, grupos y semestres, con el fin de cargar la informacion en las listas desplegables

  function horarioGrupo(dat) {
    let info = '';
    $.ajax({
      type: 'ajax',
      method: 'post',
      url: '<?php echo base_url()?>horario/getHorarioGrupo',
      data: dat,
      async: false,
      dataType: 'json',
      success: function (data) {
        info = data;
      },
      error: function () {
        alert('No se ha podido conectar a la base de datos.');
      }
    });
    return info;
  }

  function obtHoras() {
    let info = '';
    $.ajax({
      type: 'ajax',
      url: '<?php echo base_url()?>horario/getHoras',
      async: false,
      dataType: 'json',
      success: function (data) {
        info = data;
      },
      error: function () {
        alert('No se puede obtener datos desde la base de datos');
      }
    });
    return info;
  }

  function obtProfesores() {
    let info = '';
    $.ajax({
      type: 'ajax',
      url: '<?php echo base_url()?>horario/getProfesores',
      async: false,
      dataType: 'json',
      success: function (data) {
        info = data;
      },
      error: function () {
        alert('No se puede obtener datos desde la base de datos');
      }
    });
    return info;
  }

  function obtSemestres() {
    let info = '';
    $.ajax({
      type: 'ajax',
      url: '<?php echo base_url()?>horario/getSemestres',
      async: false,
      dataType: 'json',
      success: function (data) {
        info = data;
      },
      error: function () {
        alert('No se puede obtener datos desde la base de datos');
      }
    });
    return info;
  }

  function obtSalones() {
    let info = '';
    $.ajax({
      type: 'ajax',
      url: '<?php echo base_url()?>horario/getSalones',
      async: false,
      dataType: 'json',
      success: function (data) {
        info = data;
      },
      error: function () {
        alert('No se puede obtener datos desde la base de datos');
      }
    });
    return info;
  }

  function obtMaterias() {
    let info = '';
    $.ajax({
      type: 'ajax',
      url: '<?php echo base_url()?>horario/getMaterias',
      async: false,
      dataType: 'json',
      success: function (data) {
        info = data;
      },
      error: function () {
        alert('No se puede obtener datos desde la base de datos');
      }
    });
    return info;
  }

  function obtGruposEstudiantes() {
    let info = '';
    $.ajax({
      type: 'ajax',
      url: '<?php echo base_url()?>horario/getGruposEstudiantes',
      async: false,
      dataType: 'json',
      success: function (data) {
        info = data;
      },
      error: function () {
        alert('No se puede obtener datos desde la base de datos');
      }
    });
    return info;
  }

  // Devuelve una lista del horario del dia de un profesor

  function estadoProfesor(dat) {
    let info = '';
    $.ajax({
      type: 'ajax',
      method: 'post',
      url: '<?php echo base_url()?>horario/getEstadoProfesor',
      data: dat,
      async: false,
      dataType: 'json',
      success: function (data) {
        info = data;
      },
      error: function () {
        alert('No se ha podido conectar a la base de datos.');
      }
    });
    return info;
  }

  // Devuelve una lista del horario del dia de un salon

  function estadoSalon(dat) {
    let info = '';
    $.ajax({
      type: 'ajax',
      method: 'post',
      url: '<?php echo base_url()?>horario/getEstadoSalon',
      data: dat,
      async: false,
      dataType: 'json',
      success: function (data) {
        info = data;
      },
      error: function () {
        alert('No se ha podido conectar a la base de datos.');
      }
    });
    return info;
  }

  // Devuelve una lista del horario del dia de un grupo

  function estadoGrupo(dat) {
    let info = '';
    $.ajax({
      type: 'ajax',
      method: 'post',
      url: '<?php echo base_url()?>horario/getEstadoGrupo',
      data: dat,
      async: false,
      dataType: 'json',
      success: function (data) {
        info = data;
      },
      error: function () {
        alert('No se ha podido conectar a la base de datos');
      }
    });
    return info;
  }

  // Verificar si un elemento esta ocupado

  function ocupadoONo(elemento, horaSeleccionada) {
    let elementoOcupado = 0;
    for (let i = 0; i < elemento.length; i++) {
      horaEnBaseDeDatos = parseInt(elemento[i].HORASBLOQUE);
      switch (horaSeleccionada) {
        case 1:
          if (horaEnBaseDeDatos === 1 || horaEnBaseDeDatos === 2 || horaEnBaseDeDatos === 4 || horaEnBaseDeDatos === 5) {
            elementoOcupado = 1;
          }
          break;
        case 2:
          if (horaEnBaseDeDatos === 2 || horaEnBaseDeDatos === 1 || horaEnBaseDeDatos === 3 || horaEnBaseDeDatos === 4 || horaEnBaseDeDatos === 5 || horaEnBaseDeDatos === 6) {
            elementoOcupado = 1;
          }
          break;
        case 3:
          if (horaEnBaseDeDatos === 3 || horaEnBaseDeDatos === 2 || horaEnBaseDeDatos === 4 || horaEnBaseDeDatos === 5 || horaEnBaseDeDatos === 6) {
            elementoOcupado = 1;
          }
          break;
        case 4:
          if (horaEnBaseDeDatos === 4 || horaEnBaseDeDatos === 1 || horaEnBaseDeDatos === 2 || horaEnBaseDeDatos === 3 || horaEnBaseDeDatos === 5) {
            elementoOcupado = 1;
          }
          break;
        case 5:
          if (horaEnBaseDeDatos === 5 || horaEnBaseDeDatos === 1 || horaEnBaseDeDatos === 2 || horaEnBaseDeDatos === 3 || horaEnBaseDeDatos === 4 || horaEnBaseDeDatos === 6 || horaEnBaseDeDatos === 7) {
            elementoOcupado = 1;
          }
          break;
        case 6:
          if (horaEnBaseDeDatos === 6 || horaEnBaseDeDatos === 2 || horaEnBaseDeDatos === 3 || horaEnBaseDeDatos === 5 || horaEnBaseDeDatos === 7) {
            elementoOcupado = 1;
          }
          break;
        case 7:
          if (horaEnBaseDeDatos === 7 || horaEnBaseDeDatos === 5 || horaEnBaseDeDatos === 6) {
            elementoOcupado = 1;
          }
          break;
        case 8:
          if (horaEnBaseDeDatos === 8) {
            elementoOcupado = 1;
          }
          break;
        case 9:
          if (horaEnBaseDeDatos === 9) {
            elementoOcupado = 1;
          }
          break;
        case 10:
          if (horaEnBaseDeDatos === 10 || horaEnBaseDeDatos === 11) {
            elementoOcupado = 1;
          }
          break;
        case 11:
          if (horaEnBaseDeDatos === 10 || horaEnBaseDeDatos === 11 || horaEnBaseDeDatos === 12) {
            elementoOcupado = 1;
          }
          break;
        case 12:
          if (horaEnBaseDeDatos === 11 || horaEnBaseDeDatos === 12) {
            elementoOcupado = 1;
          }
          break;
        default:
          elementoOcupado = 0;
          break;
      }

    }
    return elementoOcupado;
  }

  // Verificar la disponibilidad de salones, profesores y grupos.

  function disponibilidad(form) {

    // Auxiliar para habilitar o deshabilitar el boton add
    let addBtnState = 0;
    let $hora = '';
    // Verificar si la hora no es ninguna

    if (form === '#agregarHorarioNuevo') {
      $hora = $("#hora");

      const horaSeleccionada = $hora.val();
      if (horaSeleccionada === '0') {
        addBtnState = 1;
      }

    }
    else {
      $hora = $("#horaEdit");
      recargarDiasHoras(form, $hora);
      const horaSeleccionada = $hora.val();
      if (horaSeleccionada === '0') {
        addBtnState = 1;
      }
    }

    // Verificar si el profesor está ocupado
    const dat = $(form).serialize();
    const libreOcupadoProfesor = estadoProfesor(dat);
    const horaSeleccionada = parseInt($hora.val());
    let profesorOcupado = ocupadoONo(libreOcupadoProfesor, horaSeleccionada);
    if (profesorOcupado === 1) {
      $(form + " .problemaProfesor").css("visibility", "visible");
      addBtnState = 1;
    }
    else {
      $(form + " .problemaProfesor").css("visibility", "hidden");
    }

    // Verificar si el salón esta ocupado

    const libreOcupadoSalon = estadoSalon(dat);
    let salonOcupado = ocupadoONo(libreOcupadoSalon, horaSeleccionada);
    if (salonOcupado === 1) {
      $(form + " .problemaSalon").css("visibility", "visible");
      addBtnState = 1;
    }
    else {
      $(form + " .problemaSalon").css("visibility", "hidden");
    }

    // Verificar si el grupo tiene otra clase

    const libreOcupadoGrupo = estadoGrupo(dat);
    let grupoOcupado = ocupadoONo(libreOcupadoGrupo, horaSeleccionada);
    if (grupoOcupado === 1) {
      $(form + " .problemaGrupo").css("visibility", "visible");
      addBtnState = 1;
    }
    else {
      $(form + " .problemaGrupo").css("visibility", "hidden");
    }

    // Habilitar o deshabilitar el boton agregar
    addButtonState(form, addBtnState);
    recargarDiasHoras(form, $hora);
  }

  // Verifica si se debe o no deshabilitar el boton de agregar horario
  function addButtonState(form, btnState) {
    if (form === '#agregarHorarioNuevo') {
      if (btnState === 1) {
        $("#btnAdd").prop('disabled', 'disabled');
      }
      else {
        $("#btnAdd").prop('disabled', false);
      }
    }
    else {
      if (btnState === 1) {
        $("#btnAddEdit").prop('disabled', 'disabled');
      }
      else {
        $("#btnAddEdit").prop('disabled', false);
      }
    }
  }

  // Verificar disponibilidad al cambiar algún valor en las listas de selección

  $(".add").change(
      function () {
        disponibilidad('#agregarHorarioNuevo');
      }
  );

  $(".edit").change(
      function () {
        disponibilidad('#editarHorarioForm');
      }
  );

  // Esta función verifica cuando se cambia el semestre, luego carga los grupos disponibles y las materias que pertenecen a ese semestre.

  $("#semestre").change(function () {
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
    }
  });

  // Agregar un nuevo horario
  $('#btnAdd').click(function () {
    const formulario = obtFormulario();
    if (formulario.length > 0) {
      alert("Ya existe este horario");
    }
    else {
      const data = $('#agregarHorarioNuevo').serialize();
      $.ajax({
        type: 'ajax',
        method: 'post',
        url: '<?php echo base_url()?>horario/addHorario',
        data: data,
        async: false,
        dataType: 'json',
        success: function (data) {
          mostrarHorarioCompleto();
        },
        error: function () {
          alert('No se pueden agregar los datos');
        }
      });
    }
    disponibilidad('#agregarHorarioNuevo', '#hora');
  });

  function obtFormulario() {
    let datos = '';
    const data2 = $('#agregarHorarioNuevo').serialize();
    $.ajax({
      type: 'ajax',
      method: 'post',
      url: '<?php echo base_url()?>horario/getFormulario',
      data: data2,
      async: false,
      dataType: 'json',
      success: function (data) {
        datos = data;
      },
      error: function () {
        alert('No se puede conectar a la base de datos');
      }
    });
    return datos;
  }

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
        if (numeroDeHoras(element.HORASBLOQUE) === 4) {
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
    const $problemaCarga = $(form + ' .problemaCarga');
    switch (caso) {
      case 0:
        $problemaCarga.text('Carga horaria: 0 horas');
        quitarHoras4(hor, 0);
        break;
      case 2:
        quitarHoras4(hor, 1);
        $problemaCarga.text('Carga horaria: 2 horas');
        break;
      default:
        if (form === '#agregarHorarioNuevo') {
          addButtonState(form, 1);
        }
        $problemaCarga.text('Carga horaria: 4 horas');
    }
  }

  // Recarga dias y horas deacuerdo al semestre, grupo y materia seleccionado
  let cuatroHoras = [];

  function quitarHoras4(formhora, show) {
    const selhora = $(formhora);
    const op = Array.from(selhora[0].options);
    op.forEach(function (element) {
          if (numeroDeHoras(element.value) === 4 && show === 1) {
            $(element).hide();
            cuatroHoras.push(element);
          } else if (show === 0) {
            for (let i = 0; i < cuatroHoras.length; i++) {
              $(cuatroHoras[i]).show();
            }
            cuatroHoras = [];
          }
        }, this
    );
  }
</script>