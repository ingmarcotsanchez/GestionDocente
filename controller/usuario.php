<?php
    require_once("../config/conexion.php");
    require_once("../models/Usuario.php");
    $usuario = new Usuario();

    switch($_GET["opc"]){
        case "guardaryeditar":
            if(empty($_POST["usu_id"])){
                $usuario->insert_usuario($_POST["usu_nom"],$_POST["usu_ape"],$_POST["usu_correo"],$_POST["usu_pass"],$_POST["usu_rol"]);
            }else{
                $usuario->update_usuario($_POST["usu_id"],$_POST["usu_nom"],$_POST["usu_ape"],$_POST["usu_pass"],$_POST["usu_rol"]);
            }
            break;
            
        case "crear":
            $usuario->insert_usuario($_POST["usu_nom"],$_POST["usu_ape"],$_POST["usu_correo"],$_POST["usu_pass"],$_POST["usu_rol"]);
            break;

        case "mostrar":
            $datos = $usuario->usuario_id($_POST["usu_id"]);
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){
                    $output["usu_id"] = $row["usu_id"];
                    $output["usu_nom"] = $row["usu_nom"];
                    $output["usu_ape"] = $row["usu_ape"];
                    $output["usu_correo"] = $row["usu_correo"];
                    $output["usu_pass"] = $row["usu_pass"];
                    $output["usu_rol"] = $row["usu_rol"];
                    $output["est"] = $row["est"];
                }
                echo json_encode($output);
            }
            break;
        case "eliminar":
            $usuario->delete_usuario($_POST["usu_id"]);
            break;

        case "listar":
            $datos=$usuario->listar();
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                //columnas de las tablas a mostrar segun select del modelo
                $sub_array[] = $row["usu_nom"];
                $sub_array[] = $row["usu_ape"];
                $sub_array[] = $row["usu_correo"];
                $sub_array[] = $row["usu_rol"];
                $sub_array[] = $row["fech_crea"];
                $sub_array[] = $row["fech_mod"];
                if($row["est"] == '1'){
                    $sub_array[] = "<button type='button' onClick='usu_ina(".$row["usu_id"].");' class='btn btn-primary btn-sm'>Activo</button>";
                }else{
                    $sub_array[] = "<button type='button' onClick='usu_act(".$row["usu_id"].");' class='btn btn-danger btn-sm'>Inactivo</button>";
                }
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["usu_id"].');"  id="'.$row["usu_id"].'" class="btn btn-outline-danger btn-icon"><i class="bx bx-trash"></i></button>';
                
                $data[] = $sub_array;
            }
            /*Formato del datatable, se usa siempre*/
            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;
       
        case "editPerfil":
            $usuario->update_perfil($_POST["usu_id"],$_POST["usu_pass"]);
            break;

        case "total_Profesores":
            $datos=$usuario->total_profesores();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["total"] = $row["total"];
                }
                echo json_encode($output);
            }
            break;
        case "total_Programas":
            $datos=$usuario->total_programas();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["total"] = $row["total"];
                }
                echo json_encode($output);
            }
            break;
        case "combo";
            $datos = $usuario->usuario_x_rol();
            if(is_array($datos)==true and count($datos)>0){
                $html.= "<option label='Seleccionar'></option>";
                foreach($datos as $row)
                {
                   
                    $html.= "<option value='".$row['usu_id']."'>".$row['usu_nom']." ".$row['usu_apep']." - ".$row['usu_rol']."</option>";
                }
                echo $html;
            }
            break;

        case "activo":
            $usuario->update_estadoActivo($_POST["usu_id"]);
            break;
        case "inactivo":
            $usuario->update_estadoInactivo($_POST["usu_id"]);
            break;
        
        
       
    }
?>