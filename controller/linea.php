<?php
    require_once("../config/conexion.php");
    require_once("../models/Linea.php");
    $linea = new Linea();
    //$prof = $profesor->get_profesorDetallexid($_GET['prof_id']);

    switch($_GET["opc"]){
        case "guardaryeditar":
            
                if(empty($_POST["lin_id"])){
                    $linea->insert_linea($_POST["lin_nom"]);
                    
                }else{
                    $linea->update_linea($_POST["lin_id"], $_POST["lin_nom"]);
                }
                break;
        case "mostrar":
                $datos = $linea->lineas_id($_POST["lin_id"]);
                if(is_array($datos)==true and count($datos)<>0){
                    foreach($datos as $row){
                        $output["lin_id"] = $row["lin_id"];
                        $output["lin_nom"] = $row["lin_nom"];
                    }
                    echo json_encode($output);
                }
                break;
        case "eliminar":
                $linea->delete_linea($_POST["lin_id"]);
                break;
        case "listar":
                $datos=$linea->lineas();
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    //columnas de las tablas a mostrar segun select del modelo
                    $sub_array[] = $row["lin_nom"];
                    if($row["est"] == '1'){
                        $sub_array[] = "<button type='button' onClick='linea_ina(".$row["lin_id"].");' class='btn btn-info btn-sm'>Activo</button>";
                    }else{
                        $sub_array[] = "<button type='button' onClick='linea_act(".$row["lin_id"].");' class='btn btn-danger btn-sm'>Inactivo</button>";
                    }
                    $sub_array[] = '<button type="button" onClick="editar('.$row["lin_id"].');"  id="'.$row["lin_id"].'" class="btn btn-outline-success btn-icon btn-sm"><i class="bx bx-edit-alt"></i></button>';
                    $sub_array[] = '<button type="button" onClick="eliminar('.$row["lin_id"].');"  id="'.$row["lin_id"].'" class="btn btn-outline-danger btn-icon btn-sm"><i class="bx bx-trash"></i></button>';
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
            $datos=$linea->lineas();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['lin_id']."'>".$row['lin_nom']."</option>";
                }
                echo $html;
            }
            break;
        case "activo":
            $linea->update_estadoActivo($_POST["lin_id"]);
            break;
        case "inactivo":
            $linea->update_estadoInactivo($_POST["lin_id"]);
            break; 
               
     
    }
?>