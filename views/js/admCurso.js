var usu_id = $('#usu_idx').val();

function init(){
    $("#cursos_form").on("submit",function(e){
        guardaryeditar(e);
    });

}

function guardaryeditar(e){
    //console.log("prueba");
    e.preventDefault();
    var formData = new FormData($("#cursos_form")[0]);
    //console.log(formData);
    $.ajax({
        url: "/ISUM/controller/curso.php?opc=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(data){
            console.log(data);
            $('#cursos_data').DataTable().ajax.reload();
            $('#modalcrearCurso').modal('hide');

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
    $('#id_categoria').select2({
        dropdownParent: $("#modalcrearCurso")
    });
    
    $('#profesor').select2({
        dropdownParent: $("#modalcrearCurso")
    });

    select_categoria();

    select_instructor();

    
    $('#cursos_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"/ISUM/controller/curso.php?opc=listar",
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
    $('#cursos_form')[0].reset();
     select_categoria();
     select_instructor();
    $('#modalcrearCurso').modal('show');
}

function editar(cur_id){
    $.post("/ISUM/controller/curso.php?opc=mostrar",{cur_id:cur_id},function (data){
        data = JSON.parse(data);
        //console.log(data);
        $('#cur_id').val(data.cur_id);
        $('#nombre').val(data.curso);
        $('#descripcion').val(data.descripcion);
        $('#fecha_ini').val(data.fecha_ini);
        $('#fecha_fin').val(data.fecha_fin);
        $('#id_categoria').val(data.id_categoria).trigger('change');
        $('#profesor').val(data.profesor).trigger('change');
    });
    $('#titulo_modal').html('Editar Curso');
    $('#modalcrearCurso').modal('show');
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
            $.post("/ISUM/controller/curso.php?opc=eliminar",{cur_id:cur_id},function (data){
                $('#cursos_data').DataTable().ajax.reload();
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



function select_categoria(){
    $.post("/ISUM/controller/categoria.php?opc=inputselect",function (data){
        $('#id_categoria').html(data);
    });
}

function select_instructor(){
    $.post("/ISUM/controller/instructor.php?opc=combo",function (data){
        $('#profesor').html(data);
    });
}

init();