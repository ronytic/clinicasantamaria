<?php
include_once("../../login/check.php");
if(!empty($_POST)):
include_once("../../class/paciente.php");
$paciente=new paciente;
extract($_POST);
//empieza la copia de archivos
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
				$paciente->actualizar($valores,$id);
$botones=array("consulta.php?p=$id"=>"Nuevo Consulta Médica");
				$mensaje[]="LOS DATOS DEL PACIENTE SE GUARDARON CORRECTAMENTE";


$titulo="Mensaje de Respuesta";
$folder="../../";
include_once '../../mensajeresultado.php';
endif;?>