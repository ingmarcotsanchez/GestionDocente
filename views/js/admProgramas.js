var usu_id = $('#usu_idx').val();

function init(){
    $("#programa_form").on("submit",function(e){
        guardaryeditar(e);
    });

}

function guardaryeditar(e){
    //console.log("prueba");
    e.preventDefault();
    var formData = new FormData($("#programa_form")[0]);
    //console.log(formData);
    $.ajax({
        url: "/GestionDocente/controller/programa.php?opc=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(data){
            console.log(data);
            $('#programa_data').DataTable().ajax.reload();
            $('#modalcrearPrograma').modal('hide');

            Swal.fire({
                title: 'Correcto!',
                text: 'Se Registro el Programa Correctamente',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            })
        }
    });
}

$(document).ready(function(){

    $('input#prog_codigo').keypress(function (event) {
        if (event.which < 48 || event.which > 57 || this.value.length === 10) {
          return false;
        }
    });

    $("#prog_codigo").on("keyup", function() {
        var prog_codigo = $("#prog_codigo").val(); //CAPTURANDO EL VALOR DE INPUT CON ID CEDULA
        var longitudCedula = $("#prog_codigo").val().length; //CUENTO LONGITUD
      
      //Valido la longitud 
        if(longitudCedula >= 8){
            var dataString = 'prog_codigo=' + prog_codigo;
      
            $.ajax({
                url: '/GestionDocente/views/js/verificarCodigo.php',
                type: "GET",
                data: dataString,
                dataType: "JSON",
      
                success: function(datos){
      
                    if( datos.success == 1){
      
                        $("#respuesta").html(datos.message);
      
                        $("input").attr('disabled',true);
                        $("select").attr('disabled',true);
                        $("input#prog_codigo").attr('disabled',false);
                        $("button").attr('disabled',true);
      
                    }else{
      
                        $("#respuesta").html(datos.message);
      
                        $("input").attr('disabled',false);
                        $("select").attr('disabled',false);
                        $("button").attr('disabled',false);
      
                    }
                }
            });
        }
    });
    
    
    $('#programa_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"/GestionDocente/controller/programa.php?opc=listar",
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
    $('#titulo_modal').html('Nuevo Programa');
    $('#programa_form')[0].reset();
    $('#modalcrearPrograma').modal('show');
}

function editar(prog_id){
    $.post("/GestionDocente/controller/programa.php?opc=mostrar",{prog_id:prog_id},function (data){
        data = JSON.parse(data);
        //console.log(data);
        $('#prog_id').val(data.prog_id);
        $('#prog_codigo').val(data.prog_codigo);
        $('#prog_nom').val(data.prog_nom);
        $('#prog_sigla').val(data.prog_sigla);
    });
    $('#titulo_modal').html('Editar Programa');
    $('#modalcrearPrograma').modal('show');
}

function programa_act(prog_id){
    $.post("/GestionDocente/controller/programa.php?opc=activo",{prog_id:prog_id},function (data){
        $('#programa_data').DataTable().ajax.reload();
       // data = JSON.parse(data);
    });
}

function programa_ina(prog_id){
    $.post("/GestionDocente/controller/programa.php?opc=inactivo",{prog_id:prog_id},function (data){
        $('#programa_data').DataTable().ajax.reload();
    });
}


function eliminar(prog_id){
    Swal.fire({
        title: 'Eliminar!',
        text: 'Desea eleminar el Registro?',
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    }).then((result)=>{
        if(result.value){
            $.post("/GestionDocente/controller/programa.php?opc=eliminar",{prog_id:prog_id},function (data){
                $('#programa_data').DataTable().ajax.reload();
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