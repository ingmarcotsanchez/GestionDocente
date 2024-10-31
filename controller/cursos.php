<?php
    /* llamada a las clases necesarias */
    require_once("../config/conexion.php");
    require_once("../models/Cursos.php");
    $cursos_profesor = new Cursos_profesor();
    require_once("../models/Certificado.php");
    $certificado = new Certificado();
    /*TODO: opciones del controlador */
    switch($_GET["opc"]){
        /* manejo de json para poder listar en el datatable, formato de json segun documentacion */
        case "guardaryeditar":
            if(empty($_POST["cur_prof_id"])){
                $r=__DIR__."/..";
                if(isset($_FILES["cur_image"]["tmp_name"])){
                    list($ancho, $alto) = getimagesize($_FILES["cur_image"]["tmp_name"]);
                    $nuevoAncho = 500;
                    $nuevoAlto = 500;
                    $directorio = $r."/images/cursos/".$_POST["cur_prof_nom"]."".$_POST["cur_prof_anno"];
                    //var_dump($directorio);
                    mkdir($directorio, 0777);
                    if($_FILES["cur_image"]["type"] == "image/jpeg"){
                        $aleatorio = mt_rand(100,999);
                        $ruta = "/images/cursos/".$_POST["cur_prof_nom"].$_POST["cur_prof_anno"]."/".$aleatorio.".jpg";
                        $origen = imagecreatefromjpeg($_FILES["cur_image"]["tmp_name"]);						
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        imagejpeg($destino, $r.$ruta);
                    }
                    if($_FILES["cur_image"]["type"] == "image/png"){
                        $aleatorio = mt_rand(100,999);
                        $ruta ="/images/cursos/".$_POST["cur_prof_nom"].$_POST["cur_prof_anno"]."/".$aleatorio.".jpg";
                        $origen = imagecreatefrompng($_FILES["cur_image"]["tmp_name"]);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        imagepng($destino, $r.$ruta);
                    }
                }
                $datos=$cursos_profesor->insert_cursos_profesor($ruta,$_POST["cur_prof_nom"],$_POST["tipo_id"],$_POST["cur_prof_anno"],$_POST["doc_id"]);
              
                if (is_array($datos)==true and count($datos)>0){
                    foreach ($datos as $row){
                        $output["cur_prof_id"] = $row["cur_prof_id"];
                        if (empty($_FILES['files']['name'])){
    
                        }else{
                            $countfiles = count($_FILES['files']['name']);
                            $ruta = "../document/certificaos/".$output["doc_id"]."/";
                            $files_arr = array();
    
                            if (!file_exists($ruta)) {
                                mkdir($ruta, 0777, true);
                            }
    
                            for ($index = 0; $index < $countfiles; $index++) {
                                $doc1 = $_FILES['files']['tmp_name'][$index];
                                $destino = $ruta.$_FILES['files']['name'][$index];
                                $certificado->insert_certificado( $output["doc_id"],$_FILES['files']['name'][$index]);
                                move_uploaded_file($doc1,$destino);
                            }
                        }
                    }
                }
                echo json_encode($datos); 
            }else{
                $r=__DIR__."/..";
                if(isset($_FILES["cur_image"]["tmp_name"])){
                    list($ancho, $alto) = getimagesize($_FILES["cur_image"]["tmp_name"]);
                    $nuevoAncho = 500;
                    $nuevoAlto = 500;
                    $directorio = $r."/images/cursos/".$_POST["cur_prof_nom"].$_POST["cur_prof_anno"];
                    if(is_dir($directorio) == false){
                        mkdir($directorio, 0777);
                    }
                    
                    
                    if($_FILES["doc_image"]["type"] == "image/jpeg"){
                        $aleatorio = mt_rand(100,999);
                        $ruta = "/images/cursos/".$_POST["cur_prof_nom"].$_POST["cur_prof_anno"]."/".$aleatorio.".jpg";
                        $origen = imagecreatefromjpeg($_FILES["doc_image"]["tmp_name"]);						
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        imagejpeg($destino, $r.$ruta);
                    }
                    if($_FILES["doc_image"]["type"] == "image/png"){
                        $aleatorio = mt_rand(100,999);
                        $ruta = "/images/cursos/".$_POST["cur_prof_nom"].$_POST["cur_prof_anno"]."/".$aleatorio.".jpg";
                        $origen = imagecreatefrompng($_FILES["doc_image"]["tmp_name"]);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        imagepng($destino, $r.$ruta);
                    }
                    if($_FILES["doc_image"]["type"] == "image/jpg"){
                        $aleatorio = mt_rand(100,999);
                        $ruta = "/images/cursos/".$_POST["cur_prof_nom"].$_POST["cur_prof_anno"]."/".$aleatorio.".jpg";
                        $origen = imagecreatefrompng($_FILES["doc_image"]["tmp_name"]);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        imagepng($destino, $r.$ruta);
                    }
                    
                }
                $cursos_profesor->update_cursos_profesor($_POST["cur_prof_id"],$_POST["cur_prof_nom"],$_POST["tipo_id"],$_POST["cur_prof_anno"],$_POST["doc_id"]);
                if (empty($_FILES['files']['name'])){

                }else{
                    $countfiles = count($_FILES['files']['name']);
                    $ruta = "../document/certificado/".$_POST["doc_id"]."/";
                    

                    if (!file_exists($ruta)) {
                        mkdir($ruta, 0777, true);
                    }

                    for ($index = 0; $index < $countfiles; $index++) {
                        $doc1 = $_FILES['files']['tmp_name'][$index];
                        $destino = $ruta.$_FILES['files']['name'][$index];
                        $certificado->insert_certificado( $_POST["doc_id"],$_FILES['files']['name'][$index]);
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
                    $output["cur_image"] = $row["cur_image"];
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
            $datos=$cursos_profesor->get_cursos2();
            //var_dump($datos);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $imgDatos = $row["cur_image"];
                $sub_array[] = "<img src='../".$row["cur_image"]."' class='img-responsive' width='30px'>";
                $sub_array[] = $row["cur_prof_nom"];
                $sub_array[] = $row["tipo_nom"];
                $sub_array[] = $row["cur_prof_anno"];
                $sub_array[] = $row["doc_nom"] ." ". $row["prof_ape"];
                //$sub_array[] = '<a href="../document/certificados/'.$_POST["doc_id"].'/'.$row["cur_prof_nom"].'" target="_blank">'.$row["cur_prof_nom"].'</a>';
                /* TODO: Formato HTML para abrir el documento o descargarlo en una nueva ventana */
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
