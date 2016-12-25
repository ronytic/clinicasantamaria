<?php
include_once("../../login/check.php");
include_once("../../impresion/pdf.php");

extract($_GET);
class PDF extends PPDF{
	function Cabecera(){
		
	}	
}

include_once("../../class/paciente.php");
include_once("../../class/prequirurgico.php");
include_once("../../class/internacion.php");
include_once("../../class/confirmacioncirugia.php");
include_once("../../class/usuarios.php");
$paciente=new paciente;
$prequirurgico=new prequirurgico;
$internacion=new internacion;
$confirmacioncirugia=new confirmacioncirugia;
$usuarios=new usuarios;

$pre=array_shift($prequirurgico->mostrar($id));
//print_r($pre);
$pac=array_shift($paciente->mostrar($pre['codpaciente']));
//print_r($pac);
$con=array_shift($confirmacioncirugia->mostrarTodo("codprequirurgico=".$id));
//print_r($con);
$int=array_shift($internacion->mostrarTodo("codprequirurgico=".$id));
//print_r($int);

$docope=array_shift($usuarios->mostrar($con['coddoctor']));
$pdf=new PDF("P","mm","letter");
$borde=0;
$pdf->AddPage();

$pdf->SetXY(50,54);
$pdf->CuadroCuerpoPersonalizado(92,$pac['paterno']." ".$pac['materno']." ".$pac['nombres'],0,"L",$borde,"",11);
$pdf->CuadroCuerpoPersonalizado(25,$pac['edad'],0,"R",$borde,"",11);
$pdf->CuadroCuerpoPersonalizado(25,$pac['sexo'],0,"R",$borde,"",11);

$pdf->SetXY(50,60);
$pdf->CuadroCuerpoPersonalizado(70,$int['numerohabitacion'],0,"L",$borde,"B",10);
$pdf->CuadroCuerpoPersonalizado(65,"Dr.: ".$docope['paterno']." ".$docope['materno']." ".$docope['nombre'],0,"C",$borde,"B",10);
$pdf->Ln(7);

$pdf->SetXY(10,77);
$pdf->CuadroCuerpoPersonalizado(20,$int['fecha'],0,"R",$borde,"",10);
$pdf->CuadroCuerpoPersonalizado(20,"",0,"R",$borde,"",10);
$pdf->CuadroCuerpoPersonalizado(155,"INDICACIONES POST OPERATORIAS",0,"C",$borde,"",10);
$pdf->Ln();
$pdf->SetXY(10,83);
$pdf->CuadroCuerpoPersonalizado(20,$con['turnooperacion']=="M"?'11:05':'19:05',0,"R",$borde,"",10);
$pdf->CuadroCuerpoPersonalizado(20,"",0,"R",$borde,"",10);
$pdf->CuadroCuerpoMulti(155,("  1.- Dieta líquida en 6 horas de acuerdo a tolerancia"),0,"L",$borde,"",9);
$pdf->CuadroCuerpoPersonalizado(20,"",0,"L",$borde,"B",10);
$pdf->CuadroCuerpoPersonalizado(20,"",0,"R",$borde,"",10);
$pdf->CuadroCuerpoMulti(155,("  2.- csv  por turno"),0,"L",$borde,"",9);

$pdf->CuadroCuerpoPersonalizado(20,"",0,"L",$borde,"B",10);
$pdf->CuadroCuerpoPersonalizado(20,"",0,"R",$borde,"",10);
$pdf->CuadroCuerpoMulti(155,("  3.- DC venoclisis al concluir"),0,"L",$borde,"",9);

$pdf->CuadroCuerpoPersonalizado(20,"",0,"L",$borde,"B",10);
$pdf->CuadroCuerpoPersonalizado(20,"",0,"R",$borde,"",10);
$pdf->CuadroCuerpoMulti(155,("  4.- Dexametasona 8 mg IM stat y al momento de alta del paciente"),0,"L",$borde,"",9);

$pdf->CuadroCuerpoPersonalizado(20,"",0,"L",$borde,"B",10);
$pdf->CuadroCuerpoPersonalizado(20,"",0,"R",$borde,"",10);
$pdf->CuadroCuerpoMulti(155,("  5.- Terapirol 1g IM stat y prn"),0,"L",$borde,"",9);

$pdf->CuadroCuerpoPersonalizado(20,"",0,"L",$borde,"B",10);
$pdf->CuadroCuerpoPersonalizado(20,"",0,"R",$borde,"",10);
$pdf->CuadroCuerpoMulti(155,("  6.- meloxicam 15 mg  VO cada dia durante 7 días"),0,"L",$borde,"",9);

$pdf->CuadroCuerpoPersonalizado(20,"",0,"L",$borde,"B",10);
$pdf->CuadroCuerpoPersonalizado(20,"",0,"R",$borde,"",10);
$pdf->CuadroCuerpoMulti(155,("  7.- cotrimoxazol 800/160mg VO cada 12 horas durante 7 días"),0,"L",$borde,"",9);

$pdf->CuadroCuerpoPersonalizado(20,"",0,"L",$borde,"B",10);
$pdf->CuadroCuerpoPersonalizado(20,"",0,"R",$borde,"",10);
$pdf->CuadroCuerpoMulti(155,("  8.- Alta hospitalaria previo retiro de tapones "),0,"L",$borde,"",9);

$pdf->CuadroCuerpoPersonalizado(20,"",0,"L",$borde,"B",10);
$pdf->CuadroCuerpoPersonalizado(20,"",0,"R",$borde,"",10);
$pdf->CuadroCuerpoMulti(155,("  9.- Comunicar cambios"),0,"L",$borde,"",9);

$pdf->ln(6);

$pdf->CuadroCuerpoPersonalizado(20,$int['fecha'],0,"R",$borde,"",10);
$pdf->CuadroCuerpoPersonalizado(20,"",0,"R",$borde,"",10);
$pdf->CuadroCuerpoPersonalizado(155,"INDICACIONES RECUPERACIÓN",0,"C",$borde,"",10);
$pdf->Ln(6);

$pdf->CuadroCuerpoPersonalizado(20,$con['turnooperacion']=="M"?'11:05':'19:05',0,"R",$borde,"",10);
$pdf->CuadroCuerpoPersonalizado(20,"",0,"R",$borde,"",10);
$pdf->CuadroCuerpoMulti(155,("  1.- Alta de recuperación"),0,"L",$borde,"",9);
$pdf->CuadroCuerpoPersonalizado(20,"",0,"R",$borde,"",10);
$pdf->CuadroCuerpoPersonalizado(20,"",0,"R",$borde,"",10);
$pdf->CuadroCuerpoMulti(155,("  2.- DC soluciones"),0,"L",$borde,"",9);
$pdf->CuadroCuerpoPersonalizado(20,"",0,"R",$borde,"",10);
$pdf->CuadroCuerpoPersonalizado(20,"",0,"R",$borde,"",10);
$pdf->CuadroCuerpoMulti(155,("  3.- Pasa a sala"),0,"L",$borde,"",9);

$pdf->Ln(6);



$pdf->Ln(6);

$pdf->CuadroCuerpoPersonalizado(20,$con['turnooperacion']=="M"?$int['fecha']:date("Y-m-d",strtotime ( '+1 day' , strtotime ( $int['fecha']))),0,"R",$borde,"",10);
$pdf->CuadroCuerpoPersonalizado(20,"",0,"R",$borde,"",10);
$pdf->CuadroCuerpoPersonalizado(155," 1.- Alta hospitalaria",0,"L",$borde,"",10);
$pdf->Ln();

$pdf->CuadroCuerpoPersonalizado(20,$con['turnooperacion']=="M"?'17:00':'07:00',0,"R",$borde,"",10);
$pdf->CuadroCuerpoPersonalizado(20,"",0,"R",$borde,"",10);
$pdf->CuadroCuerpoMulti(155,("2.- lleva Meloxicam y Cotrimoxazol VO para 1 semana"),0,"L",$borde,"",9);
$pdf->CuadroCuerpoPersonalizado(20,'',0,"L",$borde,"",10);
$pdf->CuadroCuerpoPersonalizado(20,"",0,"R",$borde,"",10);
$pdf->CuadroCuerpoMulti(155,"3.- control dia                   ".date("Y-m-d",strtotime ( '+7 day' , strtotime ( $int['fecha']))),0,"L",$borde,"",9);

$pdf->Output("Historia Clinica","I");
?>