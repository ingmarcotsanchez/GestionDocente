var usu_id = $('#usu_idx').val();

function init(){
    $("#docente_form").on("submit",function(e){
        guardaryeditar(e);
    });

}

function guardaryeditar(e){
    //console.log("prueba");
    e.preventDefault();
    var formData = new FormData($("#docente_form")[0]);
    console.log(formData);
    var totalfiles = $('#fileElem').val().length;
        for (var i = 0; i < totalfiles; i++) {
            formData.append("files[]", $('#fileElem')[0].files[i]);
        }
    $.ajax({
        url: "/GestionDocente/controller/profesor.php?opc=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(data){
            console.log(data);
            $('#docente_data').DataTable().ajax.reload();
            $('#modalcrearDocente').modal('hide');

            Swal.fire({
                title: 'Correcto!',
                text: 'Se Registro Correctamente',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            })
        }
    });
}

$(".doc_image").change(function(){

	var imagen = this.files[0];
	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png" && imagen["type"] != "image/jpg"){

  		$(".doc_image").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){

  		$(".doc_image").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizar").attr("src", rutaImagen);

  		})

  	}
})

$(document).ready(function(){
    $('#prog_id').select2({
        dropdownParent: $('#modalcrearDocente')
    });
    $('#mod_id').select2({
        dropdownParent: $('#modalcrearDocente')
    });
    $('#esc_id').select2({
        dropdownParent: $('#modalcrearDocente')
    });

    combo_programas();
    combo_modalidad();
    combo_escalfon();

    $('input#doc_dni').keypress(function (event) {
        if (event.which < 48 || event.which > 57 || this.value.length === 10) {
          return false;
        }
    });

    $("#doc_dni").on("keyup", function() {
        var doc_dni = $("#doc_dni").val(); //CAPTURANDO EL VALOR DE INPUT CON ID CEDULA
        var longitudCedula = $("#doc_dni").val().length; //CUENTO LONGITUD
      
      //Valido la longitud 
        if(longitudCedula >= 8){
            var dataString = 'doc_dni=' + doc_dni;
      
            $.ajax({
                url: '/GestionDocente/views/js/verificarCedula.php',
                type: "GET",
                data: dataString,
                dataType: "JSON",
      
                success: function(datos){
      
                    if( datos.success == 1){
      
                        $("#respuesta").html(datos.message);
      
                        $("input").attr('disabled',true);
                        $("select").attr('disabled',true);
                        $("input#doc_dni").attr('disabled',false);
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
              

    $('#docente_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"/GestionDocente/controller/profesor.php?opc=listar",
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
    $('#titulo_modal').html('Nuevo Profesor');
    $('#docente_form')[0].reset();
    $('#modalcrearDocente').modal('show');
}

function editar(doc_id){
    $.post("/GestionDocente/controller/profesor.php?opc=mostrar",{doc_id:doc_id},function (data){
        data = JSON.parse(data);
        //console.log(data);
        $('#doc_id').val(data.doc_id);
        $('#doc_dni').val(data.doc_dni);
        $('#doc_nom').val(data.doc_nom);
        $('#doc_ape').val(data.doc_ape);
        $('#doc_correo').val(data.doc_correo);
        $('#doc_correo2').val(data.doc_correo2);
        $('#doc_niv').val(data.doc_niv);
        $('#doc_sex').val(data.doc_sex);
        $('#doc_telf').val(data.doc_telf);
        $('#esc_id').val(data.esc_id).trigger('change');
        $('#doc_fecini').val(data.doc_fecini);
        $('#doc_fecfin').val(data.doc_fecfin);
        $('#doc_cvlac').val(data.doc_cvlac);
        $('#doc_orcid').val(data.doc_orcid);
        $('#doc_google').val(data.doc_google);
        $('#doc_est').val(data.doc_est);
        $('#prog_id').val(data.prog_id).trigger('change');
        $('#mod_id').val(data.mod_id).trigger('change');
        
    });
    $('#titulo_modal').html('Editar Profesor');
    $('#modalcrearDocente').modal('show');
}

function doc_act(doc_id){
    $.post("/GestionDocente/controller/profesor.php?opc=activo",{doc_id:doc_id},function (data){
        $('#docente_data').DataTable().ajax.reload();
       // data = JSON.parse(data);
    });
}

function doc_ina(doc_id){
    $.post("/GestionDocente/controller/profesor.php?opc=inactivo",{doc_id:doc_id},function (data){
        $('#docente_data').DataTable().ajax.reload();
       // data = JSON.parse(data);
    });
}


function eliminar(doc_id){
    Swal.fire({
        title: 'Eliminar!',
        text: 'Desea eleminar el Registro?',
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    }).then((result)=>{
        if(result.value){
            $.post("/GestionDocente/controller/profesor.php?opc=eliminar",{doc_id:doc_id},function (data){
                $('#profesor_data').DataTable().ajax.reload();
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

function combo_programas(){
    $.post("/GestionDocente/controller/programa.php?opc=combo", function (data) {
        $('#prog_id').html(data);
    });
}
function combo_modalidad(){
    $.post("/GestionDocente/controller/modalidad.php?opc=combo", function (data) {
        $('#mod_id').html(data);
    });
}
function combo_escalfon(){
    $.post("/GestionDocente/controller/escalafon.php?opc=combo", function (data) {
        $('#esc_id').html(data);
    });
}

$(document).on("click", "#btnplantilla", function () {
    $('#modalProfesor').modal('show');
});

var ExcelToJSON = function() {
    this.parseExcel = function(file) {
        var reader = new FileReader();

        reader.onload = function(e) {
            var data = e.target.result;
            var workbook = XLSX.read(data, {
                type: 'binary'
            });
            //TODO: Recorrido a todas las pestañas
            workbook.SheetNames.forEach(function(sheetName) {
                // Here is your object
                var XL_row_object = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
                var json_object = JSON.stringify(XL_row_object);
                ProfesorList = JSON.parse(json_object);

                console.log(ProfesorList)
                for (i = 0; i < ProfesorList.length; i++) {

                    var columns = Object.values(ProfesorList[i])

                    $.post("/GestionDocente/controller/profesor.php?opc=guardar_desde_excel",{
                        doc_dni : columns[0],
                        doc_nom : columns[1],
                        doc_ape : columns[2],
                        doc_correo : columns[3],
                        doc_correo2 : columns[4],
                        doc_nivel : columns[5],
                        doc_sex : columns[6],
                        doc_telf :columns[7],
                        esc_id :columns[8],
                        doc_fecini : columns[9],
                        doc_fecfin : columns[10],
                        doc_cvlac : columns[11],
                        doc_orcid : columns[12],
                        doc_google : columns[13],
                        doc_est : columns[14],
                        mod_id : columns[15],
                        prog_id : columns[16]
                    }, function (data) {
                        console.log(data);
                    });

                }
                /* TODO:Despues de subir la informacion limpiar inputfile */
                document.getElementById("upload").value=null;

                /* TODO: Actualizar Datatable JS */
                $('#profesor_data').DataTable().ajax.reload();
                $('#modalProfesor').modal('hide');
            })
        };
        reader.onerror = function(ex) {
            console.log(ex);
        };

        reader.readAsBinaryString(file);
    };
};

function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object
    var xl2json = new ExcelToJSON();
    xl2json.parseExcel(files[0]);
}

document.getElementById('upload').addEventListener('change', handleFileSelect, false);

function detalle_profesor(doc_id){
    console.log(doc_id);
    window.open('detalle_profesor.php?doc_id='+doc_id+'');
}


init();