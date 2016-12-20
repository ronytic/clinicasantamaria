<?php 
include_once '../../login/check.php';
if (!empty($_POST)) {
	$folder="../../";
	include_once '../../class/paciente.php';
	extract($_POST);

	$paciente=new paciente;
	$pac=$paciente->mostrarTodo("nombres LIKE '%$nombres%' and paterno LIKE '%$paterno%' and materno LIKE '%$materno%' and ci LIKE '$ci%'");
	$titulo=array("nombres"=>"Nombres","paterno"=>"Paterno","materno"=>"Materno","ci"=>"C.I.","celular"=>"Celular","sexo"=>"Sexo","estadocivil"=>"Estado Civil");
	listadoTabla($titulo,$pac,1,"modificar.php","eliminar.php","");
}
?>