
<?php
//require_once("../../config/conexion.php");
$cedula    = $_REQUEST['prog_codigo'];
$usuario  = "root";
$password = "";
$servidor = "localhost";
$basededatos = "gestion";
$con = mysqli_connect($servidor, $usuario, $password,$basededatos) or die("No se ha podido conectar al Servidor");

//Verificando si existe algun cliente en bd ya con dicha cedula asignada
//Preparamos un arreglo que es el que contendrá toda la información
$jsonData = array();
$selectQuery   = ("SELECT prog_codigo FROM programas WHERE prog_codigo='".$cedula."' ");
$query         = mysqli_query($con, $selectQuery);
$totalCliente  = mysqli_num_rows($query);

  //Validamos que la consulta haya retornado información
  if( $totalCliente <= 0 ){
    $jsonData['success'] = 0;
    $jsonData['message'] = 'No existe el Código ' .$cedula;
    $jsonData['message'] = '';
} else{
    //Si hay datos entonces retornas algo
    $jsonData['success'] = 1;
    $jsonData['message'] = '<p style="color:red;">Ya existe el Código <strong>(' .$cedula.')<strong></p>';
  }

//Mostrando mi respuesta en formato Json
header('Content-type: application/json; charset=utf-8');
echo json_encode( $jsonData );
?>