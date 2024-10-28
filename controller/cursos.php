<?php
    /* llamada a las clases necesarias */
    require_once("../config/conexion.php");
    require_once("../models/Cursos.php");
    $cursos_profesor = new Cursos_profesor();
    require_once("../models/Documento.php");
    $documentos = new Documento();
    /*TODO: opciones del controlador */
    switch($_GET["opc"]){
        /* manejo de json para poder listar en el datatable, formato de json segun documentacion */
        case "guardaryeditar":
            if(empty($_POST["prod_prof__id"])){
                $datos=$cursos_profesor->insert_cursos_profesor($_POST["cur_prof_nom"],$_POST["tipo_id"],$_POST["cur_prof_anno"],$_POST["doc_id"]);
                if (is_array($datos)==true and count($datos)>0){
                    foreach ($datos as $row){
                        $output["doc_id"] = $row["doc_id"];
                        if (empty($_FILES['files']['name'])){
    
                        }else{
                            $countfiles = count($_FILES['files']['name']);
                            $ruta = "../document/cursos/".$output["doc_id"]."/";
                            $files_arr = array();
    
                            if (!file_exists($ruta)) {
                                mkdir($ruta, 0777, true);
                            }
    
                            for ($index = 0; $index < $countfiles; $index++) {
                                $doc1 = $_FILES['files']['tmp_name'][$index];
                                $destino = $ruta.$_FILES['files']['name'][$index];
                                $documentos->insert_documento( $output["doc_id"],$_FILES['files']['name'][$index]);
                                move_uploaded_file($doc1,$destino);
                            }
                        }
                    }
                }
                echo json_encode($datos); 
            }else{
                $cursos_profesor->update_cursos_profesor($_POST["cur_prof_id"],$_POST["cur_prof_nom"],$_POST["tipo_id"],$_POST["cur_prof_anno"],$_POST["doc_id"]);
                if (empty($_FILES['files']['name'])){

                }else{
                    $countfiles = count($_FILES['files']['name']);
                    $ruta = "../document/documentos/".$_POST["doc_id"]."/";
                    

                    if (!file_exists($ruta)) {
                        mkdir($ruta, 0777, true);
                    }

                    for ($index = 0; $index < $countfiles; $index++) {
                        $doc1 = $_FILES['files']['tmp_name'][$index];
                        $destino = $ruta.$_FILES['files']['name'][$index];
                        $documentos->insert_documento( $_POST["doc_id"],$_FILES['files']['name'][$index]);
                        move_uploaded_file($doc1,$destino);
                    }
                }
            }
            break; 
        case "mostrar":
            $datos = $cursos_profesor->cursos_profesor_id($_POST["cur_prof_id"]);
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){
                    $output["cur_prof_id"] = $row["cur_prof_id"];
                    $output["cur_prof_nom"] = $row["cur_prof_nom"];
                    $output["tipo_id"] = $row["tipo_id"];
                    $output["cur_prof_anno"] = $row["cur_prof_anno"];
                    $output["doc_id"] = $row["doc_id"];
                }
                echo json_encode($output);
            }
            break;
        case "eliminar":
            $cursos_profesor->delete_cursos_profesor($_POST["cur_prof_id"]);
            break;
        case "listar":
            $datos=$cursos_profesor->get_cursos_x_profesor();
            var_dump($datos);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["cur_prof_nom"];
                $sub_array[] = $row["tipo_nom"];
                $sub_array[] = $row["cur_prof_anno"];
                $sub_array[] = $row["doc_nom"] ." ". $row["prof_ape"];
                $sub_array[] = '<a href="../document/cursos/'.$_POST["doc_id"].'/'.$row["cur_nom"].'" target="_blank">'.$row["cur_nom"].'</a>';
                /* TODO: Formato HTML para abrir el documento o descargarlo en una nueva ventana */
                $sub_array[] = '<a type="button" href="../document/cursos/'.$_POST["doc_id"].'/'.$row["cur_nom"].'" target="_blank" class="btn btn-inline btn-primary btn-sm"><i class="fa fa-eye"></i></a>';
                $sub_array[] = '<button type="button" onClick="editar(' .$row["cur_prof_id"]. ');"  id="' .$row["cur_prof_id"] . '" class="btn btn-outline-success btn-icon"><i class="bx bx-edit-alt"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar(' .$row["cur_prof_id"]. ');"  id="' .$row["cur_prof_id"] . '" class="btn btn-outline-danger btn-icon"><i class="bx bx-trash"></i></button>';
                
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
