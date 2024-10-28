var usu_id = $('#usu_idx').val();

function init(){
    $("#cursos_profesor_form").on("submit",function(e){
        guardaryeditar(e);
    });

}

function guardaryeditar(e){
    //console.log("prueba");
    e.preventDefault();
    var formData = new FormData($("#cursos_profesor_form")[0]);
    console.log(formData);
    var totalfiles = $('#fileElem').val().length;
        for (var i = 0; i < totalfiles; i++) {
            formData.append("files[]", $('#fileElem')[0].files[i]);
        }
    $.ajax({
        url: "/GestionDocente/controller/cursos.php?opc=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(data){
            console.log(data);
            $('#cursos_profesor_data').DataTable().ajax.reload();
            $('#modalcrearCurso_profesor').modal('hide');

            Swal.fire({
                title: 'Correcto!',
                text: 'Se Registro Correctamente',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            })
        }
    });
}

$(document).ready(function(){
    $('#tipo_id').select2({
        dropdownParent: $("#modalcrearCurso_profesor")
    });
    
    $('#doc_id').select2({
        dropdownParent: $("#modalcrearCurso_profesor")
    });

    select_tipo();

    select_instructor();

    
    $('#cursos_profesor_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"/GestionDocente/controller/cursos.php?opc=listar",
            type:"post"
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 15,
        "order": [[ 0, "desc" ]],
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
    });

});

function nuevo(){
    $('#titulo_modal').html('Nuevo Curso');
    $('#cursos_profesor_form')[0].reset();
     select_tipo();
     select_instructor();
    $('#modalcrearCurso_profesor').modal('show');
}

function editar(cur_id){
    $.post("/GestionDocente/controller/cursos.php?opc=mostrar",{cur_id:cur_id},function (data){
        data = JSON.parse(data);
        //console.log(data);
        $('#cur_prof_id').val(data.cur_prof_id);
        $('#cur_prof_nom').val(data.cur_prof_nom);
        $('#tipo_id').val(data.tipo_id).trigger('change');
        $('#cur_prof_anno').val(data.cur_prof_anno);
        $('#prof_id').val(data.prof_id).trigger('change');
    });
    $('#titulo_modal').html('Editar Curso');
    $('#modalcrearCurso_profesor').modal('show');
}

function eliminar(cur_id){
    Swal.fire({
        title: 'Eliminar!',
        text: 'Desea eleminar el Registro?',
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    }).then((result)=>{
        if(result.value){
            $.post("/GestionDocente/controller/cursos.php?opc=eliminar",{cur_id:cur_id},function (data){
                $('#cursos_profesor_data').DataTable().ajax.reload();
                Swal.fire({
                    title: 'Correcto!',
                    text: 'Se Elimino Correctamente',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                })
            });
        }
    });

}



function select_tipo(){
    $.post("/GestionDocente/controller/tipo.php?opc=inputselect",function (data){
        $('#tipo_id').html(data);
    });
}

function select_instructor(){
    $.post("/GestionDocente/controller/profesor.php?opc=combo",function (data){
        $('#doc_id').html(data);
    });
}

init();