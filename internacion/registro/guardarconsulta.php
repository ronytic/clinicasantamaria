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
"fechaoperacionreal"=>"'$fechaoperacionreal'",
"numerohabitacion"=>"'$numerohabitacion'",
"pa"=>"'$pa'",
"fc"=>"'$fc'",


"fr"=>"'$fr'",
"t"=>"'$t'",
"peso"=>"'$peso'",
"coddoctorrevision"=>"'$codmedicoreal'",

);

/*echo "<pre>";
print_r($valores);
echo "</pre>";*/
include_once '../../class/internacion.php';
$internacion=new internacion;
$internacion->actualizar($valores,$id);
$mensaje[]="SE REGISTRO LA INTERNACIÓN CORRECTAMENTE";
$nuevo=1;
$listar=1;
$botones=array("listar.php?"=>"Realizar otra Internación","../general/verreporte.php?codprequirurgico=$codprequirurgico"=>"Ver Reporte Internación");

$titulo="Mensaje de Respuesta";
$folder="../../";
include_once '../../mensajeresultado.php';
?>