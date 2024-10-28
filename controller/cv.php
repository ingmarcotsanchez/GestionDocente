<?php
    /* llamada a las clases necesarias */
    require_once("../config/conexion.php");
    require_once("../models/Cv.php");
    $cv = new Cv();

    /*TODO: opciones del controlador */
    switch($_GET["opc"]){
        /* manejo de json para poder listar en el datatable, formato de json segun documentacion */
        case "listar":
            $datos=$cv->get_cv_x_profesor($_POST["doc_id"]);
            var_dump($datos);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = '<a href="../document/cv/'.$_POST["doc_id"].'/'.$row["cv_nom"].'" target="_blank">'.$row["cv_nom"].'</a>';
                /* TODO: Formato HTML para abrir el documento o descargarlo en una nueva ventana */
                $sub_array[] = '<a type="button" href="../document/cv/'.$_POST["doc_id"].'/'.$row["cv_nom"].'" target="_blank" class="btn btn-inline btn-primary btn-sm"><i class="fa fa-eye"></i></a>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
        break;
    }
?>
