<?php
include_once '../../login/check.php';
/*echo "<pre>";
print_r($_POST);
echo "</pre>";*/
extract($_POST);
$fechaconsultareal=date("Y-m-d");
$horaconsultareal=date("H:i:s");
$codmedicoreal=$_SESSION['idusuario'];
$valores=array(
"fechaoperacion"=>"'$fechaoperacion'",
"horaoperacion"=>"'horaoperacion'",
"turnooperacion"=>"'$turnooperacion'",
"coddoctor"=>"'$coddoctor'",
"codinstrumentadora"=>"'$codinstrumentadora'",


"codanestesista"=>"'$codanestesista'",
"cancelado"=>"'$cancelado'",
"fotocopiaci"=>"'$fotocopiaci'",
"laboratorio"=>"'$laboratorio'",
"valoracioncardiologica"=>"'$valoracioncardiologica'",

);

/*echo "<pre>";
print_r($valores);
echo "</pre>";*/
include_once '../../class/confirmacioncirugia.php';
$confirmacioncirugia=new confirmacioncirugia;
$confirmacioncirugia->actualizar($valores,$id);
$mensaje[]="EL REGISTRO DE CONFIRMACIÓN DE CIRUGIA FUE REALIZADO CORRECTAMENTE";
$nuevo=1;
$listar=1;
$botones=array("listar.php?"=>"Realizar otra Confirmación de Cirugía");

$titulo="Mensaje de Respuesta";
$folder="../../";
include_once '../../mensajeresultado.php';
?>