<?php
include_once("../../login/check.php");
if(!empty($_POST)):
include_once("../../class/paciente.php");
$paciente=new paciente;

extract($_POST);
//empieza la copia de archivos
/*
if(($_FILES['curriculum']['type']=="application/pdf" || $_FILES['curriculum']['type']=="application/msword" || $_FILES['curriculum']['type']=="application/vnd.openxmlformats-officedocument.wordprocessingml.document") && $_FILES['curriculum']['size']<="500000000"){
	@$curriculum=$_FILES['curriculum']['name'];
	@copy($_FILES['curriculum']['tmp_name'],"../curriculum/".$_FILES['curriculum']['name']);
}else{
	//mensaje que no es valido el tipo de archivo	
	$mensaje[]="Archivo no válido del curriculum. Verifique e intente nuevamente";
}
*/
$valores=array(	"nombres"=>"'$nombres'",
				"paterno"=>"'$paterno'",
				"materno"=>"'$materno'",
				"sexo"=>"'$sexo'",
				"edad"=>"'$edad'",
				"ci"=>"'$ci'",
                "ocupacion"=>"'$ocupacion'",
                "estadocivil"=>"'$estadocivil'",
                "direccion"=>"'$direccion'",
                "telefonofijo"=>"'$telefonofijo'",
                "celular"=>"'$celular'",
                "email"=>"'$email'",
                "fecharegistro"=>"'$fecharegistro'",
				);

$paciente->insertar($valores);
$ultimo=$paciente->last_id();
$botones=array("consulta.php?p=$ultimo"=>"Nuevo Consulta Médica");
				$mensaje[]="LOS DATOS DEL PACIENTE SE GUARDARON CORRECTAMENTE";



$titulo="Mensaje de Respuesta";
$folder="../../";
include_once '../../mensajeresultado.php';
endif;?>