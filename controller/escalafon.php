<?php
    require_once("../config/conexion.php");
    require_once("../models/Escalafon.php");
    $escalafon = new Escalafon();

    switch($_GET["opc"]){
        case "guardaryeditar":
                if(empty($_POST["esc_id"])){
                    //$curso es la variable que tenemos inicializada, los metodos son los que creamos en el archivo de models
                    $escalafon->insert_escalafon($_POST["esc_nombre"]);
                }else{
                    $escalafon->update_escalafon($_POST["esc_id"], $_POST["esc_nombre"]);
                }
                break;
        case "mostrar":
                $datos = $escalafon->escalafon_id($_POST["esc_id"]);
                if(is_array($datos)==true and count($datos)<>0){
                    foreach($datos as $row){
                        $output["esc_id"] = $row["esc_id"];
                        $output["esc_nombre"] = $row["esc_nombre"];
                    }
                    echo json_encode($output);
                }
                break;
        case "eliminar":
                $escalafon->delete_escalafon($_POST["esc_id"]);
                break;
        case "listar":
                $datos=$escalafon->escalafon();
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    //columnas de las tablas a mostrar segun select del modelo
                    $sub_array[] = $row["esc_nombre"];
                    $sub_array[] = '<button type="button" onClick="editar('.$row["esc_id"].');"  id="'.$row["esc_id"].'" class="btn btn-outline-success btn-icon"><i class="bx bx-edit-alt"></i></button>';
                    $sub_array[] = '<button type="button" onClick="eliminar('.$row["esc_id"].');"  id="'.$row["esc_id"].'" class="btn btn-outline-danger btn-icon"><i class="bx bx-trash"></i></button>';
                    
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
            $datos=$escalafon->escalafon();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['esc_id']."'>".$row['esc_nombre']."</option>";
                }
                echo $html;
            }
            break;
            
     
    }
?>