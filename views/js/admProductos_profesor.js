var usu_id = $('#usu_idx').val();

function init(){
    $("#productos_profesor_form").on("submit",function(e){
        guardaryeditar(e);
    });

}

function guardaryeditar(e){
    //console.log("prueba");
    e.preventDefault();
    var formData = new FormData($("#productos_profesor_form")[0]);
    //console.log(formData);
    $.ajax({
        url: "/GestionDocente/controller/producto_profesor.php?opc=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(data){
            console.log(data);
            $('#productos_profesor_data').DataTable().ajax.reload();
            $('#modalcrearProducto_profesor').modal('hide');

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
    $('#prof_id').select2({
        dropdownParent: $("#modalcrearProducto_profesor")
    });

    select_profesor();

    $('#productos_profesor_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"/GestionDocente/controller/producto_profesor.php?opc=listar",
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
    $('#titulo_modal').html('Nuevo Producto');
    $('#productos_profesor_form')[0].reset();
    $('#modalcrearProducto_profesor').modal('show');
}

function editar(prod_prof_id){
    $.post("/GestionDocente/controller/producto_profesor.php?opc=mostrar",{prod_prof_id:prod_prof_id},function (data){
        data = JSON.parse(data);
        //console.log(data);
        $('#prod_prof_id').val(data.prod_prof_id);
        $('#prod_prof_nom').val(data.prod_prof_nom);
        $('#prod_prof_tipo').val(data.prod_prof_tipo);
        $('#prod_prof_anno').val(data.prod_prof_anno);
        $('#prof_id').val(data.prof_id).trigger('change');
    });
    $('#titulo_modal').html('Editar Producto');
    $('#modalcrearProducto_profesor').modal('show');
}

function eliminar(prod_prof_id){
    Swal.fire({
        title: 'Eliminar!',
        text: 'Desea eleminar el Registro?',
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    }).then((result)=>{
        if(result.value){
            $.post("/GestionDocente/controller/producto_profesor.php?opc=eliminar",{prod_prof_id:prod_prof_id},function (data){
                $('#productos_profesor_data').DataTable().ajax.reload();
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
function select_profesor(){
    $.post("/GestionDocente/controller/profesor.php?opc=combo",function (data){
        $('#prof_id').html(data);
    });
}

init();