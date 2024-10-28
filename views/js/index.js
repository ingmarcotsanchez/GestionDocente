function init(){
 
}

$(document).ready(function(){

});

$(document).on("click","#btnUsu",function() {
    if($('#rol_id').val()=='1'){

        $('#titulo').html("Acceso Admon");
        $('#btnUsu').html("Acceso Estudiante");
        $('#rol_id').val(2);
    }else{
        $('#titulo').html("Acceso Estudiantes");
        $('#btnUsu').html("Acceso Admon"); 
        $('#rol_id').val(1); 
    }
    
});

init();