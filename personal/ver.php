<?php
include_once("../impresion/pdf.php");
$narchivo="usuarios";
include_once("../class/".$narchivo.".php");
${$narchivo}=new $narchivo;
extract($_GET);
$dato=array_shift(${$narchivo}->mostrar($id));
$titulo="Datos de Personal";
class PDF extends PPDF{
	
}
$pdf=new PDF("P","mm","letter");
$pdf->AddPage();
switch($dato['nivel']){
case 1:{$nivel="";}break;
case 2:{$nivel="Gerente";}break;	
case 3:{$nivel="Doctor";}	break;
case 4:{$nivel="Secretaria";}	break;
case 5:{$nivel="Enfermera";}	break;
}
mostrarI(array("Usuario"=>$dato['usuario'],
				"Nombres"=>$dato['nombre'],
				"Apellido Paterno"=>$dato['paterno'],
				"Apellido Materno"=>$dato['materno'],
				"C.I."=>$dato['ci'],
				"Dirección"=>$dato['direccion'],
                "Especialidad"=>$dato['especialidad'],
                "Cargo"=>$dato['cargo'],
				"Teléfono"=>$dato['telefono'],
				"Email"=>$dato['email'],
				"Nivel de Usuario:"=>$nivel,
				"Observaciones"=>$dato['obs'],
			));

$pdf->Output();
?>