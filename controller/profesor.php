<?php
    require_once("../config/conexion.php");
    require_once("../models/Profesor.php");
    $docente = new Docente();
    require_once("../models/Cv.php");
    $cv = new Cv();

    switch($_GET["opc"]){
        case "guardaryeditar":
            
                if(empty($_POST["doc_id"])){
                    $r=__DIR__."/..";
                    if(isset($_FILES["doc_image"]["tmp_name"])){
                        list($ancho, $alto) = getimagesize($_FILES["doc_image"]["tmp_name"]);
                        $nuevoAncho = 500;
                        $nuevoAlto = 500;
                        $directorio = $r."/images/profesor/".$_POST["doc_ape"]."".$_POST["doc_dni"];
                        //var_dump($directorio);
                        mkdir($directorio, 0777);
                        if($_FILES["doc_image"]["type"] == "image/jpeg"){
                            $aleatorio = mt_rand(100,999);
                            $ruta = "/images/profesor/".$_POST["doc_ape"].$_POST["doc_dni"]."/".$aleatorio.".jpg";
                            $origen = imagecreatefromjpeg($_FILES["doc_image"]["tmp_name"]);						
                            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                            imagejpeg($destino, $r.$ruta);
                        }
                        if($_FILES["doc_image"]["type"] == "image/png"){
                            $aleatorio = mt_rand(100,999);
                            $ruta ="/images/profesor/".$_POST["doc_ape"].$_POST["doc_dni"]."/".$aleatorio.".jpg";
                            $origen = imagecreatefrompng($_FILES["doc_image"]["tmp_name"]);
                            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                            imagepng($destino, $r.$ruta);
                        }
                    }
                    
                    $datos=$docente->insert_docentes($ruta,$_POST["doc_dni"],$_POST["doc_nom"],$_POST["doc_ape"],$_POST["doc_correo"],$_POST["doc_correo2"],$_POST["doc_niv"],$_POST["doc_sex"],$_POST["doc_telf"],$_POST["esc_id"],date('Y-m-d',strtotime($_POST["doc_fecini"])),date('Y-m-d',strtotime($_POST["doc_fecfin"])),$_POST["doc_cvlac"],$_POST["doc_orcid"],$_POST["doc_google"],$_POST["doc_est"],$_POST["prog_id"],$_POST["mod_id"]);
                    if (is_array($datos)==true and count($datos)>0){
                        foreach ($datos as $row){
                            $output["doc_id"] = $row["doc_id"];
                            if (empty($_FILES['files']['name'])){
        
                            }else{
                                $countfiles = count($_FILES['files']['name']);
                                $ruta = "../document/cv/".$output["doc_id"]."/";
                                $files_arr = array();
        
                                if (!file_exists($ruta)) {
                                    mkdir($ruta, 0777, true);
                                }
        
                                for ($index = 0; $index < $countfiles; $index++) {
                                    $doc1 = $_FILES['files']['tmp_name'][$index];
                                    $destino = $ruta.$_FILES['files']['name'][$index];
                                    $cv->insert_cv( $output["doc_id"],$_FILES['files']['name'][$index]);
                                    move_uploaded_file($doc1,$destino);
                                }
                            }
                        }
                    }
                    echo json_encode($datos);
                }else{
                    $r=__DIR__."/..";
                    if(isset($_FILES["doc_image"]["tmp_name"])){
                        list($ancho, $alto) = getimagesize($_FILES["doc_image"]["tmp_name"]);
                        $nuevoAncho = 500;
                        $nuevoAlto = 500;
                        $directorio = $r."/images/profesor/".$_POST["doc_ape"].$_POST["doc_dni"];
                        if(is_dir($directorio) == false){
                            mkdir($directorio, 0777);
                        }
                        
                        
                        if($_FILES["doc_image"]["type"] == "image/jpeg"){
                            $aleatorio = mt_rand(100,999);
                            $ruta = "/images/profesor/".$_POST["doc_ape"].$_POST["doc_dni"]."/".$aleatorio.".jpg";
                            $origen = imagecreatefromjpeg($_FILES["doc_image"]["tmp_name"]);						
                            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                            imagejpeg($destino, $r.$ruta);
                        }
                        if($_FILES["doc_image"]["type"] == "image/png"){
                            $aleatorio = mt_rand(100,999);
                            $ruta = "/images/profesor/".$_POST["doc_ape"].$_POST["doc_dni"]."/".$aleatorio.".jpg";
                            $origen = imagecreatefrompng($_FILES["doc_image"]["tmp_name"]);
                            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                            imagepng($destino, $r.$ruta);
                        }
                        if($_FILES["doc_image"]["type"] == "image/jpg"){
                            $aleatorio = mt_rand(100,999);
                            $ruta = "/images/profesor/".$_POST["doc_ape"].$_POST["doc_dni"]."/".$aleatorio.".jpg";
                            $origen = imagecreatefrompng($_FILES["doc_image"]["tmp_name"]);
                            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                            imagepng($destino, $r.$ruta);
                        }
                       
                    }
                    $docente->update_docentes($_POST["doc_id"], $ruta,$_POST["doc_dni"],$_POST["doc_nom"],$_POST["doc_ape"],$_POST["doc_correo"],$_POST["doc_correo2"],$_POST["doc_niv"],$_POST["doc_sex"],$_POST["doc_telf"],$_POST["esc_id"],date('Y-m-d',strtotime($_POST["doc_fecini"])),date('Y-m-d',strtotime($_POST["doc_fecfin"])),$_POST["doc_cvlac"],$_POST["doc_orcid"],$_POST["doc_google"],$_POST["doc_est"],$_POST["prog_id"],$_POST["mod_id"]);
                    
                    if (empty($_FILES['files']['name'])){

                    }else{
                        $countfiles = count($_FILES['files']['name']);
                        $ruta = "../document/cv/".$_POST["doc_id"]."/";
                        

                        if (!file_exists($ruta)) {
                            mkdir($ruta, 0777, true);
                        }

                        for ($index = 0; $index < $countfiles; $index++) {
                            $doc1 = $_FILES['files']['tmp_name'][$index];
                            $destino = $ruta.$_FILES['files']['name'][$index];
                            $cv->insert_cv( $_POST["doc_id"],$_FILES['files']['name'][$index]);
                            move_uploaded_file($doc1,$destino);
                        }
                    }
                
                }
                break;
        case "mostrar":
                $datos = $docente->docentes_id($_POST["doc_id"]);
                if(is_array($datos)==true and count($datos)<>0){
                    foreach($datos as $row){
                        $output["doc_id"] = $row["doc_id"];
                        $output["doc_image"] = $row["doc_image"];
                        $output["doc_dni"] = $row["doc_dni"];
                        $output["doc_nom"] = $row["doc_nom"];
                        $output["doc_ape"] = $row["doc_ape"];
                        $output["doc_correo"] = $row["doc_correo"];
                        $output["doc_correo2"] = $row["doc_correo2"];
                        $output["doc_niv"] = $row["doc_niv"];
                        $output["doc_sex"] = $row["doc_sex"];
                        $output["doc_telf"] = $row["doc_telf"];
                        $output["esc_id"] = $row["esc_id"];
                        $output["doc_fecini"] = $row["doc_fecini"];
                        $output["doc_fecfin"] = $row["doc_fecfin"];
                        if($row["doc_fecfin"] == "1970-01-01"){
                            $output["doc_fecfin"] = "Actualmente";
                        }
                        
                        $output["doc_cvlac"] = $row["doc_cvlac"];
                        $output["doc_orcid"] = $row["doc_orcid"];
                        $output["doc_google"] = $row["doc_google"];
                        $output["doc_est"] = $row["doc_est"];
                        $output["prog_id"] = $row["prog_id"];
                        $output["mod_id"] = $row["mod_id"];
                        
                    }
                    echo json_encode($output);
                }
                break;
        case "eliminar":
                $docente->delete_docentes($_POST["doc_id"]);
                break;
        case "listar":
                $datos=$docente->docentes2();
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    $imgDatos = $row["doc_image"];
                    /* header("Content-type: image/jpg"); 
                    if($row["doc_image"] == ""){
                        $sub_array[] = "<img src='../public/img/carousel/' class='img-circle'>";
                    }else{
                        $sub_array[] = "<img src='".$row["carousel_image"]."' class='img-responsive' width='50px'>";
                    } */
                    //columnas de las tablas a mostrar segun select del modelo
                    $sub_array[] = "<img src='../".$row["doc_image"]."' class='img-responsive' width='30px'>";
                    //$sub_array[] = $row["doc_image"];
                    $sub_array[] = $row["doc_dni"];
                    $sub_array[] = $row["doc_nom"] ." ". $row["doc_ape"];
                    //$sub_array[] = $row["prof_correo"];
                    /* if($row["doc_niv"] == 'P'){
                        $sub_array[] = "Pregrado";
                    }elseif ($row["doc_niv"] == 'E'){
                        $sub_array[] = "Especialista";
                    }elseif ($row["doc_niv"] == 'M'){
                        $sub_array[] = "Magister";
                    }elseif ($row["doc_niv"] == 'D'){
                        $sub_array[] = "Doctor";
                    }else{
                        $sub_array[] = "Sin escalafón";
                    } */
                    $sub_array[] = $row["doc_telf"];
                    
                    $sub_array[] = $row["esc_nombre"];
                    if($row["doc_est"] == '1'){
                        $sub_array[] = "<button type='button' onClick='doc_ina(".$row["doc_id"].");' class='btn btn-outline-info btn-sm'>Activo</button>";
                    }else{
                        $sub_array[] = "<button type='button' onClick='doc_act(".$row["doc_id"].");' class='btn btn-danger btn-sm'>Inactivo</button>";
                    }
                    $sub_array[] = $row["prog_nom"];
                    $sub_array[] = $row["mod_nom"];
                    $sub_array[] = '<button type="button" onClick="editar('.$row["doc_id"].');"  id="'.$row["doc_id"].'" class="btn btn-outline-success btn-icon btn-sm"><i class="bx bx-edit-alt"></i></button>';
                    $sub_array[] = '<button type="button" onClick="eliminar('.$row["doc_id"].');"  id="'.$row["doc_id"].'" class="btn btn-outline-danger btn-icon btn-sm"><i class="bx bx-trash"></i></button>';
                    $sub_array[] = '<button type="button" onClick="detalle_profesor('.$row["doc_id"].');"  id="'.$row["doc_id"].'" class="btn btn-outline-dark btn-icon btn-sm"><i class="bx bx-book-content"></i></button>';
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
            $datos=$docente->docentes();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['doc_id']."'>".$row['doc_nom']." ".$row['doc_ape']."</option>";
                }
                echo $html;
            }
            break;
        case "guardar_desde_excel":
            $docente->insert_docentes($ruta,$_POST["doc_dni"],$_POST["doc_nom"],$_POST["doc_ape"],$_POST["doc_correo"],$_POST["doc_correo2"],$_POST["doc_niv"],$_POST["doc_sex"],$_POST["doc_telf"],$_POST["esc_id"],date('Y-m-d',strtotime($_POST["doc_fecini"])),date('Y-m-d',strtotime($_POST["doc_fecfin"])),$_POST["doc_cvlac"],$_POST["doc_orcid"],$_POST["doc_google"],$_POST["doc_est"],$_POST["prog_id"],$_POST["mod_id"]);
            break;
        
        case "activo":
            $docente->update_estadoActivo($_POST["doc_id"]);
            break;
        case "inactivo":
            $docente->update_estadoInactivo($_POST["doc_id"]);
            break; 
               
     
    }
?>