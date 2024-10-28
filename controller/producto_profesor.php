<?php
    require_once("../config/conexion.php");
    require_once("../models/Producto_profesor.php");
    $producto_profesor = new Producto_profesor();

    switch($_GET["opc"]){
        
        case "guardaryeditar":
            if(empty($_POST["prod_prof__id"])){
                $producto_profesor->insert_producto_profesor($_POST["prod_prof_nom"],$_POST["prod_prof_tipo"],$_POST["prod_prof_anno"],$_POST["prof_id"]);
            }else{
                $producto_profesor->update_producto_profesor($_POST["prod_prof_id"],$_POST["prod_prof_nom"],$_POST["prod_prof_tipo"],$_POST["prod_prof_anno"],$_POST["prof_id"]);
            }
            break;
        case "mostrar":
            $datos = $producto_profesor->producto_id($_POST["prod_prof_id"]);
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){
                    $output["prod_prof_id"] = $row["prod_prof_id"];
                    $output["prod_prof_nom"] = $row["prod_prof_nom"];
                    $output["prod_prof_tipo"] = $row["prod_prof_tipo"];
                    $output["prod_prof_anno"] = $row["prod_prof_anno"];
                    $output["prof_id"] = $row["prof_id"];
                }
                echo json_encode($output);
            }
            break;
        case "eliminar":
            $producto_profesor->delete_producto($_POST["prod_prof_id"]);
            break;
        case "listar":
            $datos = $producto_profesor->productos();
            $data = array();
            foreach ($datos as $row) {
                $sub_array = array();
                // columnas de las tablas a mostrar segun select del modelo
                $sub_array[] = $row["prod_prof_nom"];
                if($row["prod_prof_tipo"] == 'AD'){
                    $sub_array[] = "Artículo Divulgativo";
                }elseif ($row["prod_prof_tipo"] == 'AC'){
                    $sub_array[] = "Artículo Cientifico";
                }elseif ($row["prod_prof_tipo"] == 'AS'){
                    $sub_array[] = "Artículo Scopus";
                }elseif ($row["prod_prof_tipo"] == 'DS'){
                    $sub_array[] = "Desarrollo de Software";
                }elseif ($row["prod_prof_tipo"] == 'PI'){
                    $sub_array[] = "Ponencia Interna";
                }elseif ($row["prod_prof_tipo"] == 'PE'){
                    $sub_array[] = "Ponencia Externa";
                }elseif ($row["prod_prof_tipo"] == 'CL'){
                    $sub_array[] = "Capitulo Libro";
                }elseif ($row["prod_prof_tipo"] == 'LI'){
                    $sub_array[] = "Libro";
                }else{
                    $sub_array[] = "Sin Categoría";
                }
                $sub_array[] = $row["prod_prof_anno"];
                $sub_array[] = $row["prof_nom"] ." ". $row["prof_apep"] ." ". $row["prof_apem"];
                $sub_array[] = '<button type="button" onClick="editar(' .$row["prod_prof_id"]. ');"  id="' .$row["prod_prof_id"] . '" class="btn btn-outline-success btn-icon"><i class="bx bx-edit-alt"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar(' .$row["prod_prof_id"]. ');"  id="' .$row["prod_prof_id"] . '" class="btn btn-outline-danger btn-icon"><i class="bx bx-trash"></i></button>';
                
                $data[] = $sub_array;
            }
            
            // Formatea los datos en el formato requerido por DataTable
            $results = array(
                "draw" => 1,
                "recordsTotal" => count($data),
                "recordsFiltered" => count($data),
                "data" => $data
            );
        
            echo json_encode($results);
            break;
            
        
            
     
    }
?>