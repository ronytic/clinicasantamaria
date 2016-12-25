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

$pdf->SetXY(10,25);
$pdf->CuadroCuerpoPersonalizado(35,$pac['paterno'],0,"L",$borde,"",11);

$pdf->SetXY(50,25);
$pdf->CuadroCuerpoPersonalizado(35,$pac['materno'],0,"L",$borde,"",11);

$pdf->SetXY(90,25);
$pdf->CuadroCuerpoPersonalizado(35,$pac['nombres'],0,"L",$borde,"",11);



$pdf->SetXY(190,30);
$pdf->CuadroCuerpoPersonalizado(15,$int['numerohabitacion'],0,"L",$borde,"B",10);


/*
$pdf->CuadroCuerpoPersonalizado(65,"Dr.: ".$docope['paterno']." ".$docope['materno']." ".$docope['nombre'],0,"C",0,"B",10);
$pdf->Ln(7);*/

$pdf->SetXY(12,65);
$pdf->CuadroCuerpoPersonalizado(18,$int['fecha'],0,"L",$borde,"",9);
$pdf->CuadroCuerpoPersonalizado(18,$con['turnooperacion']=="M"?'10:00':'18:00',0,"R",$borde,"",10);
$pdf->CuadroCuerpoPersonalizado(80,"Ingreso",0,"C",$borde,"",10);
$pdf->CuadroCuerpoMulti(70,("  Paciente ingresa a la clínica caminando en compañía de sus familiares, con el diagnóstico de Rinocifoescoliosis. 
Porta hoja de internación del médico tratante: "."Dr.: ".$docope['paterno']." ".$docope['materno']." ".$docope['nombre']),0,"L",$borde,"",9);
$pdf->Ln(6);



$pdf->CuadroCuerpoPersonalizado(36,"",0,"L",$borde,"",8);
$pdf->CuadroCuerpoPersonalizado(35,"SIGNOS VITALES:",0,"L",$borde,"",8);
$pdf->CuadroCuerpoPersonalizado(25,"PA:".$int['pa'],0,"L",$borde,"",8);
$pdf->CuadroCuerpoPersonalizado(25,"FC:".$int['fc'],0,"L",$borde,"",8);
$pdf->CuadroCuerpoPersonalizado(25,"FR:".$int['fr'],0,"L",$borde,"",8);
$pdf->CuadroCuerpoPersonalizado(25,"Tº:".$int['t'],0,"L",$borde,"",8);
$pdf->CuadroCuerpoPersonalizado(25,"Peso:".$int['peso'],0,"L",$borde,"",8);
$pdf->ln(6);
$pdf->CuadroCuerpoPersonalizado(36,"",0,"L",$borde,"",8);
$pdf->CuadroCuerpoPersonalizado(80,"Valoración médica:".$int['pa'],0,"L",$borde,"",8);
$pdf->CuadroCuerpoPersonalizado(70,"Realizada por el médico de guardia.",0,"L",$borde,"",8);
$pdf->ln(6);
$pdf->CuadroCuerpoPersonalizado(36,"",0,"L",$borde,"",8);
$pdf->CuadroCuerpoPersonalizado(80,"Hoja de consentimiento informado:".$int['pa'],0,"L",$borde,"",8);
$pdf->CuadroCuerpoPersonalizado(70,"Paciente y familiares firman el consentimiento informado.",0,"L",$borde,"",8);
$pdf->ln(6);

$pdf->CuadroCuerpoPersonalizado(18,"",0,"L",$borde,"",9);
$pdf->CuadroCuerpoPersonalizado(18,$con['turnooperacion']=="M"?'10:40':'18:10',0,"R",$borde,"",10);
$pdf->CuadroCuerpoPersonalizado(80,"Traslado a quirófano",0,"C",$borde,"",10);
$pdf->CuadroCuerpoMulti(70,("  Paciente es trasladado a quirófano en camilla."),0,"L",$borde,"",9);
$pdf->Ln(6);

$pdf->CuadroCuerpoPersonalizado(18,"",0,"L",$borde,"",9);
$pdf->CuadroCuerpoPersonalizado(18,$con['turnooperacion']=="M"?'11:10':'19:10',0,"R",$borde,"",10);
$pdf->CuadroCuerpoPersonalizado(80,"Traslado a pieza DC via",0,"C",$borde,"",10);
$pdf->CuadroCuerpoMulti(70,("  Paciente es trasladado a pieza en camilla orientado, consciente y se descontinúa vía venosa."),0,"L",$borde,"",9);

$pdf->CuadroCuerpoPersonalizado(18,"",0,"L",$borde,"",9);
$pdf->CuadroCuerpoPersonalizado(18,"",0,"R",$borde,"",10);
$pdf->CuadroCuerpoPersonalizado(80,"Terapirol 1g. + Dexametasona 8 mg (IM)",0,"C",$borde,"",10);
$pdf->CuadroCuerpoMulti(70,("  Se administra."),0,"L",$borde,"",9);
$pdf->Ln(6);
$pdf->CuadroCuerpoPersonalizado(18,"",0,"L",$borde,"",9);
$pdf->CuadroCuerpoPersonalizado(18,$con['turnooperacion']=="M"?'12:42':'20:42',0,"R",$borde,"",10);
$pdf->CuadroCuerpoPersonalizado(80,"Control por enfermería",0,"C",$borde,"",10);
$pdf->CuadroCuerpoMulti(70,(" Paciente se encuentra en su unidad estable y consciente en posición semifowler, en compañía de sus familiares."),0,"L",$borde,"",9);
$pdf->Ln(6);
$pdf->CuadroCuerpoPersonalizado(18,$con['turnooperacion']=="M"?$int['fecha']:date("Y-m-d",strtotime ( '+1 day' , strtotime ( $int['fecha']))),0,"L",$borde,"",9);
$pdf->CuadroCuerpoPersonalizado(18,$con['turnooperacion']=="M"?'14:00':'23:47',0,"R",$borde,"",10);
$pdf->CuadroCuerpoPersonalizado(80,"Control por enfermería",0,"C",$borde,"",10);
$pdf->CuadroCuerpoMulti(70,(" Paciente en su unidad sin molestias, escaso sangrado, se cambia bigotera."),0,"L",$borde,"",9);
$pdf->Ln(6);
$pdf->CuadroCuerpoPersonalizado(18,"",0,"L",$borde,"",9);
$pdf->CuadroCuerpoPersonalizado(18,$con['turnooperacion']=="M"?'15:00':'02:00',0,"R",$borde,"",10);
$pdf->CuadroCuerpoPersonalizado(80,"Valoración médica",0,"C",$borde,"",10);
$pdf->CuadroCuerpoMulti(70,(" Realizada por el médico de guardia."),0,"L",$borde,"",9);
$pdf->Ln(6);

$pdf->CuadroCuerpoPersonalizado(18,"",0,"L",$borde,"",9);
$pdf->CuadroCuerpoPersonalizado(18,$con['turnooperacion']=="M"?'16:00':'03:00',0,"R",$borde,"",10);
$pdf->CuadroCuerpoPersonalizado(80,"Control por enfermería",0,"C",$borde,"",10);
$pdf->CuadroCuerpoMulti(70,(" Paciente en su unidad sin molestias, escaso sangrado, se cambia bigotera.							"),0,"L",$borde,"",9);
$pdf->Ln(6);

$pdf->CuadroCuerpoPersonalizado(18,"",0,"L",$borde,"",9);
$pdf->CuadroCuerpoPersonalizado(18,$con['turnooperacion']=="M"?'17:00':'07:00',0,"R",$borde,"",10);
$pdf->CuadroCuerpoPersonalizado(80,"Valoración médica",0,"C",$borde,"",10);
$pdf->CuadroCuerpoMulti(70,(" Realizada por el médico de guardia."),0,"L",$borde,"",9);
$pdf->Ln(6);

$pdf->CuadroCuerpoPersonalizado(18,"",0,"L",$borde,"",9);
$pdf->CuadroCuerpoPersonalizado(18,$con['turnooperacion']=="M"?'17:30':'07:30',0,"R",$borde,"",10);
$pdf->CuadroCuerpoPersonalizado(80,"Egreso",0,"C",$borde,"",10);
$pdf->CuadroCuerpoMulti(70,(" Paciente se retira de la clínica."),0,"L",$borde,"",9);
$pdf->Ln(6);

$pdf->Output("Historia Clinica","I");
?>