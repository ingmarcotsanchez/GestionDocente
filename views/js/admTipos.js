var usu_id = $('#usu_idx').val();

function init(){
    $("#tipo_form").on("submit",function(e){
        guardaryeditar(e);
    });

}

function guardaryeditar(e){
    //console.log("prueba");
    e.preventDefault();
    var formData = new FormData($("#tipo_form")[0]);
    //console.log(formData);
    $.ajax({
        url: "/GestionDocente/controller/tipo.php?opc=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(data){
            console.log(data);
            $('#tipo_data').DataTable().ajax.reload();
            $('#modalcrearTipo').modal('hide');

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
    
    $('#tipo_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"/GestionDocente/controller/tipo.php?opc=listar",
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
    $('#titulo_modal').html('Nuevo Tipo de formación');
    $('#tipo_form')[0].reset();
    $('#modalcrearTipo').modal('show');
}

function editar(tipo_id){
    $.post("/GestionDocente/controller/tipo.php?opc=mostrar",{tipo_id:tipo_id},function (data){
        data = JSON.parse(data);
        //console.log(data);
        $('#tipo_id').val(data.tipo_id);
        $('#tipo_nom').val(data.tipo_nom);
    });
    $('#titulo_modal').html('Editar Tipo de formación');
    $('#modalcrearTipo').modal('show');
}

function tipo_act(tipo_id){
    $.post("/GestionDocente/controller/tipo.php?opc=activo",{tipo_id:tipo_id},function (data){
        $('#tipo_data').DataTable().ajax.reload();
       // data = JSON.parse(data);
    });
}

function tipo_ina(tipo_id){
    $.post("/GestionDocente/controller/tipo.php?opc=inactivo",{tipo_id:tipo_id},function (data){
        $('#tipo_data').DataTable().ajax.reload();
    });
}


function eliminar(tipo_id){
    Swal.fire({
        title: 'Eliminar!',
        text: 'Desea eleminar el Registro?',
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    }).then((result)=>{
        if(result.value){
            $.post("/GestionDocente/controller/tipo.php?opc=eliminar",{tipo_id:tipo_id},function (data){
                $('#tipo_data').DataTable().ajax.reload();
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

init();