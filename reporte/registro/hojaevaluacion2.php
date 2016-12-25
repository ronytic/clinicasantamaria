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

$pdf->SetXY(40,40);

$pdf->CuadroCuerpoPersonalizado(100,$pac['paterno']." ".$pac['materno']." ".$pac['nombres'],0,"L",$borde,"",11);
$pdf->CuadroCuerpoPersonalizado(25,"Edad: ".$pac['edad'],0,"R",$borde,"",11);
$pdf->CuadroCuerpoPersonalizado(25,"Sexo: ".$pac['sexo'],0,"R",$borde,"",11);
$pdf->SetXY(40,50);
$pdf->CuadroCuerpoPersonalizado(90,$int['numerohabitacion'],0,"L",0,"B",10);
$pdf->CuadroCuerpoPersonalizado(65,"Dr.: ".$docope['paterno']." ".$docope['materno']." ".$docope['nombre'],0,"C",0,"B",10);
$pdf->Ln(7);

$pdf->SetXY(10,65);
$pdf->CuadroCuerpoPersonalizado(25,$int['fecha'],0,"L",$borde,"",10);
$pdf->CuadroCuerpoPersonalizado(155,"VALORACION PREANESTESICA",0,"C",$borde,"",10);
$pdf->Ln();
$pdf->SetXY(10,71);
$pdf->CuadroCuerpoPersonalizado(25,$con['turnooperacion']=="M"?'10:05':'18:05',0,"L",$borde,"",10);
$pdf->CuadroCuerpoMulti(155,("  ANTECEDENTES PATOLÓGICOS: Ninguno de importancia"),0,"L",$borde,"",9);
$pdf->CuadroCuerpoPersonalizado(25,"",0,"L",$borde,"B",10);
$pdf->CuadroCuerpoMulti(155,("  ANTECEDENTES QUIRÚRGICOS: No refiere"),0,"L",$borde,"",9);

$pdf->CuadroCuerpoPersonalizado(25,"",0,"L",$borde,"B",10);
$pdf->CuadroCuerpoMulti(155,("  ALERGIAS MEDICAMENTOSAS: No refiere"),0,"L",$borde,"",9);

$pdf->CuadroCuerpoPersonalizado(25,"",0,"L",$borde,"B",10);
$pdf->CuadroCuerpoMulti(155,("  MEDICAMENTOS ACTUALES: No refiere"),0,"L",$borde,"",9);

$pdf->CuadroCuerpoPersonalizado(25,"",0,"L",$borde,"",8);
$pdf->CuadroCuerpoPersonalizado(35,"SIGNOS VITALES:",0,"L",$borde,"",8);
$pdf->CuadroCuerpoPersonalizado(25,"PA:".$int['pa'],0,"L",$borde,"",8);
$pdf->CuadroCuerpoPersonalizado(25,"FC:".$int['fc'],0,"L",$borde,"",8);
$pdf->CuadroCuerpoPersonalizado(25,"FR:".$int['fr'],0,"L",$borde,"",8);
$pdf->CuadroCuerpoPersonalizado(25,"Tº:".$int['t'],0,"L",$borde,"",8);
$pdf->CuadroCuerpoPersonalizado(25,"Peso:".$int['peso'],0,"L",$borde,"",8);
$pdf->ln();
$pdf->CuadroCuerpoPersonalizado(25,"",0,"L",$borde,"B",10);
$pdf->CuadroCuerpoMulti(155,("Examen físico. Buen estado general, cardiopulmonar normal, resto del examen normal."),0,"L",$borde,"",9);
$pdf->CuadroCuerpoPersonalizado(25,"",0,"L",$borde,"B",10);
$pdf->CuadroCuerpoMulti(155,("Laboratorios dentro de parámetros normales."),0,"L",$borde,"",9);
$pdf->CuadroCuerpoPersonalizado(25,"",0,"L",$borde,"B",10);
$pdf->CuadroCuerpoMulti(155,("Estado físico:       I        "),0,"L",$borde,"",9);


$pdf->CuadroCuerpoPersonalizado(25,$int['fecha'],0,"L",$borde,"",10);
$pdf->CuadroCuerpoPersonalizado(155,"NOTA  POSTOPERATORIA",0,"C",$borde,"",10);
$pdf->Ln();

$pdf->CuadroCuerpoPersonalizado(25,$con['turnooperacion']=="M"?'11:00':'19:00',0,"L",$borde,"",10);
$pdf->CuadroCuerpoMulti(155,("  Paciente en postoperatorio inmediato , con signos vitales estables , sometido a cirugia rinoplastía, bajo anestesia local  y sedacion, cirugia sin complicaciones , pasa a sala una vez recuperado de efectos anestésicos"),0,"L",$borde,"",9);

$pdf->Ln(6);

$pdf->CuadroCuerpoPersonalizado(25,$int['fecha'],0,"L",$borde,"",10);
$pdf->CuadroCuerpoPersonalizado(155,"RECUPERACION",0,"C",$borde,"",10);
$pdf->Ln();

$pdf->CuadroCuerpoPersonalizado(25,$con['turnooperacion']=="M"?'11:05':'19:05',0,"L",$borde,"",10);
$pdf->CuadroCuerpoMulti(155,("  PACIENTE  RECUPERADO DE EFECTOS ANESTESICOS SIGNOS VITALES ESTABLES PASA A SALA"),0,"L",$borde,"",9);


$pdf->Ln(6);

$pdf->CuadroCuerpoPersonalizado(25,$con['turnooperacion']=="M"?$int['fecha']:date("Y-m-d",strtotime ( '+1 day' , strtotime ( $int['fecha']))),0,"L",$borde,"",10);
$pdf->CuadroCuerpoPersonalizado(155,"S      PACIENTE CON  DOLOR LEVE EN REGION OPERATORIA",0,"L",$borde,"",10);
$pdf->Ln();

$pdf->CuadroCuerpoPersonalizado(25,$con['turnooperacion']=="M"?'17:00':'07:00',0,"L",$borde,"",10);
$pdf->CuadroCuerpoMulti(155,("O       ESCASO SANGRADO DE  FOSAS NASALES POSTERIOR A RETIRO DE TAPONES"),0,"L",$borde,"",9);
$pdf->CuadroCuerpoPersonalizado(25,'',0,"L",$borde,"",10);
$pdf->CuadroCuerpoMulti(155,("A       EVOLUCION FAVORABLE EN CONDICIONES DE ALTA"),0,"L",$borde,"",9);
$pdf->CuadroCuerpoPersonalizado(25,'',0,"L",$borde,"",10);
$pdf->CuadroCuerpoMulti(155,("P       ALTA HOSPITALARIA Y MANEJO AMBULATORIO"),0,"L",$borde,"",9);

$pdf->Output("Historia Clinica","I");
?>