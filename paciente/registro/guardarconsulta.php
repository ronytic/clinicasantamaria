<?php
include_once("../../login/check.php");
if(!empty($_POST)):
include_once("../../class/prequirurgico.php");
$prequirurgico=new prequirurgico;

extract($_POST);
$valores=array(	"codpaciente"=>"'$id'",
				"nhc"=>"'$ci'",
				"fechaconsulta"=>"'$fechaconsulta'",
				"coddoctor"=>"'$coddoctor'",
				);

$prequirurgico->insertar($valores);

$mensaje[]="LOS CONSULTA MEDICA SE GUARDARON CORRECTAMENTE";



$titulo="Mensaje de Respuesta";
$folder="../../";
include_once '../../mensajeresultado.php';
endif;?>