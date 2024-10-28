var usu_id = $('#usu_idx').val();

$(document).ready(function(){

    $.post("/GestionDocente/controller/usuario.php?opc=total_Profesores", { usu_id : usu_id }, function (data) {
        data = JSON.parse(data);
        $('#lbltotalProfesores').html(data.total);
    });

    $.post("/GestionDocente/controller/usuario.php?opc=total_Programas", { usu_id : usu_id }, function (data) {
        data = JSON.parse(data);
        $('#lbltotalProgramas').html(data.total);
    });

    
});




