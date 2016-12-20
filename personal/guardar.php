<?php
include_once("../login/check.php");
if(!empty($_POST)):
$narchivo="usuarios";
include_once("../class/".$narchivo.".php");
${$narchivo}=new $narchivo;
extract($_POST);
$valores=array("usuario"=>"'$usuario'",
			"password"=>"MD5('$password')",
			"nombre"=>"'$nombres'",
			"paterno"=>"'$paterno'",
			"materno"=>"'$materno'",
			"nivel"=>"'$nivel'",
			"ci"=>"'$ci'",
			"direccion"=>"'$direccion'",
			"telefono"=>"'$telefono'",
			"email"=>"'$email'",
			"obs"=>"'$observacion'",
            "especialidad"=>"'$especialidad'",
            "cargo"=>"'$cargo'"
			);
${$narchivo}->insertar($valores);
$codinsercion=${$narchivo}->last_id();
$mensaje[]="EL PERSONAL SE GUARDO CORRECTAMENTE";
$titulo="Confirmación de Guardado";
$folder="../";
include_once '../mensajeresultado.php';
endif;?>