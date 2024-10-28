<?php
    require_once("../config/conexion.php");
    require_once("../models/Modalidad.php");
    $modalidad = new Modalidad();
    //$prof = $profesor->get_profesorDetallexid($_GET['prof_id']);

    switch($_GET["opc"]){
        case "guardaryeditar":
            
                if(empty($_POST["mod_id"])){
                    $modalidad->insert_modalidad($_POST["mod_codigo"],$_POST["mod_nom"]);
                    
                }else{
                    $modalidad->update_modalidad($_POST["mod_id"],$_POST["mod_codigo"], $_POST["mod_nom"]);
                }
                break;
        case "mostrar":
                $datos = $modalidad->modalidades_id($_POST["mod_id"]);
                if(is_array($datos)==true and count($datos)<>0){
                    foreach($datos as $row){
                        $output["mod_id"] = $row["mod_id"];
                        $output["mod_codigo"] = $row["mod_codigo"];
                        $output["mod_nom"] = $row["mod_nom"];
                    }
                    echo json_encode($output);
                }
                break;
        case "eliminar":
                $modalidad->delete_modalidad($_POST["mod_id"]);
                break;
        case "listar":
                $datos=$modalidad->modalidades();
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    //columnas de las tablas a mostrar segun select del modelo
                    $sub_array[] = $row["mod_codigo"];
                    $sub_array[] = $row["mod_nom"];
                    if($row["est"] == '1'){
                        $sub_array[] = "<button type='button' onClick='modalidad_ina(".$row["mod_id"].");' class='btn btn-info btn-sm'>Activo</button>";
                    }else{
                        $sub_array[] = "<button type='button' onClick='modalidad_act(".$row["mod_id"].");' class='btn btn-danger btn-sm'>Inactivo</button>";
                    }
                    $sub_array[] = '<button type="button" onClick="editar('.$row["mod_id"].');"  id="'.$row["mod_id"].'" class="btn btn-outline-success btn-icon btn-sm"><i class="bx bx-edit-alt"></i></button>';
                    $sub_array[] = '<button type="button" onClick="eliminar('.$row["mod_id"].');"  id="'.$row["mod_id"].'" class="btn btn-outline-danger btn-icon btn-sm"><i class="bx bx-trash"></i></button>';
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
        case "combo":
            $datos=$modalidad->modalidades();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['mod_id']."'>".$row['mod_codigo']."-".$row['mod_nom']."</option>";
                }
                echo $html;
            }
            break;
        case "activo":
            $modalidad->update_estadoActivo($_POST["mod_id"]);
            break;
        case "inactivo":
            $modalidad->update_estadoInactivo($_POST["mod_id"]);
            break; 
               
     
    }
?>