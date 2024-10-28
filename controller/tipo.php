<?php
    require_once("../config/conexion.php");
    require_once("../models/Tipo.php");
    $tipo = new Tipo();
    //$prof = $profesor->get_profesorDetallexid($_GET['prof_id']);

    switch($_GET["opc"]){
        case "guardaryeditar":
            
                if(empty($_POST["tipo_id"])){
                    $tipo->insert_tipo($_POST["tipo_nom"]);
                    
                }else{
                    $tipo->update_tipo($_POST["tipo_id"], $_POST["tipo_nom"]);
                }
                break;
        case "mostrar":
                $datos = $tipo->tipos_id($_POST["tipo_id"]);
                if(is_array($datos)==true and count($datos)<>0){
                    foreach($datos as $row){
                        $output["tipo_id"] = $row["tipo_id"];
                        $output["tipo_nom"] = $row["tipo_nom"];
                    }
                    echo json_encode($output);
                }
                break;
        case "eliminar":
                $tipo->delete_tipo($_POST["tipo_id"]);
                break;
        case "listar":
                $datos=$tipo->tipos();
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    //columnas de las tablas a mostrar segun select del modelo
                    $sub_array[] = $row["tipo_nom"];
                    if($row["est"] == '1'){
                        $sub_array[] = "<button type='button' onClick='tipo_ina(".$row["tipo_id"].");' class='btn btn-info btn-sm'>Activo</button>";
                    }else{
                        $sub_array[] = "<button type='button' onClick='tipo_act(".$row["tipo_id"].");' class='btn btn-danger btn-sm'>Inactivo</button>";
                    }
                    $sub_array[] = '<button type="button" onClick="editar('.$row["tipo_id"].');"  id="'.$row["tipo_id"].'" class="btn btn-outline-success btn-icon btn-sm"><i class="bx bx-edit-alt"></i></button>';
                    $sub_array[] = '<button type="button" onClick="eliminar('.$row["tipo_id"].');"  id="'.$row["tipo_id"].'" class="btn btn-outline-danger btn-icon btn-sm"><i class="bx bx-trash"></i></button>';
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
            $datos=$tipo->tipos();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['tipo_id']."'>".$row['tipo_nom']."</option>";
                }
                echo $html;
            }
            break;
        case "activo":
            $tipo->update_estadoActivo($_POST["tipo_id"]);
            break;
        case "inactivo":
            $tipo->update_estadoInactivo($_POST["tipo_id"]);
            break; 
               
     
    }
?>