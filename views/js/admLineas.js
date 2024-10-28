var usu_id = $('#usu_idx').val();

function init(){
    $("#linea_form").on("submit",function(e){
        guardaryeditar(e);
    });

}

function guardaryeditar(e){
    //console.log("prueba");
    e.preventDefault();
    var formData = new FormData($("#linea_form")[0]);
    //console.log(formData);
    $.ajax({
        url: "/GestionDocente/controller/linea.php?opc=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(data){
            console.log(data);
            $('#linea_data').DataTable().ajax.reload();
            $('#modalcrearLinea').modal('hide');

            Swal.fire({
                title: 'Correcto!',
                text: 'Se Registro la Línea Correctamente',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            })
        }
    });
}

$(document).ready(function(){
    
    $('#linea_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"/GestionDocente/controller/linea.php?opc=listar",
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
    $('#titulo_modal').html('Nueva Línea de Acción');
    $('#linea_form')[0].reset();
    $('#modalcrearLinea').modal('show');
}

function editar(lin_id){
    $.post("/GestionDocente/controller/linea.php?opc=mostrar",{lin_id:lin_id},function (data){
        data = JSON.parse(data);
        //console.log(data);
        $('#lin_id').val(data.lin_id);
        $('#lin_nom').val(data.lin_nom);
    });
    $('#titulo_modal').html('Editar Línea de Acción');
    $('#modalcrearLinea').modal('show');
}

function linea_act(lin_id){
    $.post("/GestionDocente/controller/linea.php?opc=activo",{lin_id:lin_id},function (data){
        $('#linea_data').DataTable().ajax.reload();
       // data = JSON.parse(data);
    });
}

function linea_ina(lin_id){
    $.post("/GestionDocente/controller/linea.php?opc=inactivo",{lin_id:lin_id},function (data){
        $('#linea_data').DataTable().ajax.reload();
    });
}


function eliminar(lin_id){
    Swal.fire({
        title: 'Eliminar!',
        text: 'Desea eleminar el Registro?',
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    }).then((result)=>{
        if(result.value){
            $.post("/GestionDocente/controller/linea.php?opc=eliminar",{lin_id:lin_id},function (data){
                $('#linea_data').DataTable().ajax.reload();
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