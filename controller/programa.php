<?php
    require_once("../config/conexion.php");
    require_once("../models/Programa.php");
    $programa = new Programa();
    //$prof = $profesor->get_profesorDetallexid($_GET['prof_id']);

    switch($_GET["opc"]){
        case "guardaryeditar":
            
                if(empty($_POST["prog_id"])){
                    $programa->insert_programa($_POST["prog_codigo"],$_POST["prog_nom"],$_POST["prog_sigla"]);
                    
                }else{
                    $programa->update_programa($_POST["prog_id"],$_POST["prog_codigo"], $_POST["prog_nom"],$_POST["prog_sigla"]);
                }
                break;
        case "mostrar":
                $datos = $programa->programas_id($_POST["prog_id"]);
                if(is_array($datos)==true and count($datos)<>0){
                    foreach($datos as $row){
                        $output["prog_id"] = $row["prog_id"];
                        $output["prog_codigo"] = $row["prog_codigo"];
                        $output["prog_nom"] = $row["prog_nom"];
                        $output["prog_sigla"] = $row["prog_sigla"];
                    }
                    echo json_encode($output);
                }
                break;
        case "eliminar":
                $programa->delete_programa($_POST["prog_id"]);
                break;
        case "listar":
                $datos=$programa->programas();
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    //columnas de las tablas a mostrar segun select del modelo
                    $sub_array[] = $row["prog_codigo"];
                    $sub_array[] = $row["prog_nom"];
                    $sub_array[] = $row["prog_sigla"];
                    if($row["est"] == '1'){
                        $sub_array[] = "<button type='button' onClick='programa_ina(".$row["prog_id"].");' class='btn btn-info btn-sm'>Activo</button>";
                    }else{
                        $sub_array[] = "<button type='button' onClick='programa_act(".$row["prog_id"].");' class='btn btn-danger btn-sm'>Inactivo</button>";
                    }
                    $sub_array[] = '<button type="button" onClick="editar('.$row["prog_id"].');"  id="'.$row["prog_id"].'" class="btn btn-outline-success btn-icon btn-sm"><i class="bx bx-edit-alt"></i></button>';
                    $sub_array[] = '<button type="button" onClick="eliminar('.$row["prog_id"].');"  id="'.$row["prog_id"].'" class="btn btn-outline-danger btn-icon btn-sm"><i class="bx bx-trash"></i></button>';
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
            $datos=$programa->programas();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['prog_id']."'>".$row['prog_nom']."-".$row['prog_sigla']."</option>";
                }
                echo $html;
            }
            break;
        case "activo":
            $programa->update_estadoActivo($_POST["prog_id"]);
            break;
        case "inactivo":
            $programa->update_estadoInactivo($_POST["prog_id"]);
            break; 
               
     
    }
?>