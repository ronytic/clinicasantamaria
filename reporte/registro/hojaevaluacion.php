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
$pdf->CuadroCuerpoPersonalizado(155,"NOTA DE INTERNACION",0,"C",$borde,"",10);
$pdf->Ln();
$pdf->SetXY(10,71);
$pdf->CuadroCuerpoPersonalizado(25,$con['turnooperacion']=="M"?'10:00':'18:00',0,"L",$borde,"B",10);
$pdf->CuadroCuerpoMulti(155,("PACIENTE CON CUADRO DE LARGA EVOLUCION CARACTERIZADO POR DEFORMIDAD NASAL,  QUE SE INTERNA PARA RESOLUCION QUIRURGICA"),0,"L",$borde,"",9);
$pdf->ln();

$pdf->CuadroCuerpoPersonalizado(25,"",0,"L",$borde,"B",10);
$pdf->CuadroCuerpoMulti(155,("APP: Ninguno de importancia"),0,"L",$borde,"",9);
$pdf->CuadroCuerpoPersonalizado(25,"",0,"L",$borde,"B",10);
$pdf->CuadroCuerpoMulti(155,("APNP: No refiere    ANTECEDENTES QUIRÚRGICOS: No refiere"),0,"L",$borde,"",9);
$pdf->CuadroCuerpoPersonalizado(25,"",0,"L",$borde,"B",10);
$pdf->CuadroCuerpoMulti(155,("APF: No refiere       ALERGIAS MEDICAMENTOSAS: No refiere"),0,"L",$borde,"",9);
$pdf->CuadroCuerpoPersonalizado(25,"",0,"L",$borde,"B",10);
$pdf->CuadroCuerpoMulti(155,("APGO: No refiere    MEDICAMENTOS ACTUALES: No refiere"),0,"L",$borde,"",9);
$pdf->CuadroCuerpoPersonalizado(25,"",0,"L",$borde,"B",10);
$pdf->CuadroCuerpoMulti(155,("APP: No refiere"),0,"L",$borde,"",9);

$pdf->CuadroCuerpoPersonalizado(25,"",0,"L",$borde,"",8);
$pdf->CuadroCuerpoPersonalizado(35,"SIGNOS VITALES:",0,"L",$borde,"",8);
$pdf->CuadroCuerpoPersonalizado(25,"PA:".$int['pa'],0,"L",$borde,"",8);
$pdf->CuadroCuerpoPersonalizado(25,"FC:".$int['fc'],0,"L",$borde,"",8);
$pdf->CuadroCuerpoPersonalizado(25,"FR:".$int['fr'],0,"L",$borde,"",8);
$pdf->CuadroCuerpoPersonalizado(25,"Tº:".$int['t'],0,"L",$borde,"",8);
$pdf->CuadroCuerpoPersonalizado(25,"Peso:".$int['peso'],0,"L",$borde,"",8);
$pdf->ln();
$pdf->CuadroCuerpoPersonalizado(25,"",0,"L",$borde,"B",10);
$pdf->CuadroCuerpoMulti(155,("RINOSCOPIA: LATERORRINIA, PUNTA POCO CAÍDA Y GIBA DE DORSO NASAL"),0,"L",$borde,"",9);
$pdf->CuadroCuerpoPersonalizado(25,"",0,"L",$borde,"B",10);
$pdf->CuadroCuerpoMulti(155,("O."),0,"L",$borde,"",9);
$pdf->CuadroCuerpoPersonalizado(25,"",0,"L",$borde,"B",10);
$pdf->CuadroCuerpoMulti(155,("OTOSCOPIA:                   SIN PARTICULARIDADES"),0,"L",$borde,"",9);
$pdf->CuadroCuerpoPersonalizado(25,"",0,"L",$borde,"B",10);
$pdf->CuadroCuerpoMulti(155,("OROSCOPIA:                   SIN PARTICULARIDADES"),0,"L",$borde,"",9);
$pdf->CuadroCuerpoPersonalizado(25,"",0,"L",$borde,"B",10);
$pdf->CuadroCuerpoMulti(155,("CUELLO:                          SIN PARTICULARIDADES"),0,"L",$borde,"",9);
$pdf->CuadroCuerpoPersonalizado(25,"",0,"L",$borde,"B",10);
$pdf->CuadroCuerpoMulti(155,("CORAZON:                      SIN PARTICULARIDADES"),0,"L",$borde,"",9);
$pdf->CuadroCuerpoPersonalizado(25,"",0,"L",$borde,"B",10);
$pdf->CuadroCuerpoMulti(155,("PULMONES:                    SIN PARTICULARIDADES"),0,"L",$borde,"",9);
$pdf->CuadroCuerpoPersonalizado(25,"",0,"L",$borde,"B",10);
$pdf->CuadroCuerpoMulti(155,("ABDOMEN:                      SIN PARTICULARIDADES"),0,"L",$borde,"",9);
$pdf->CuadroCuerpoPersonalizado(25,"",0,"L",$borde,"B",10);
$pdf->CuadroCuerpoMulti(155,("EXTREMIDADES:            SIN PARTICULARIDADES"),0,"L",$borde,"",9);
$pdf->CuadroCuerpoPersonalizado(25,"",0,"L",$borde,"B",10);
$pdf->CuadroCuerpoMulti(155,(""),0,"L",$borde,"",9);
$pdf->CuadroCuerpoPersonalizado(25,"",0,"L",$borde,"B",10);
$pdf->CuadroCuerpoMulti(155,("DX. RINOCIFOESCOLIOSIS"),0,"L",$borde,"",9);


$pdf->CuadroCuerpoPersonalizado(25,"",0,"L",$borde,"B",10);
$pdf->CuadroCuerpoMulti(155,("PLAN DE INTERNACION"),0,"L",$borde,"",9);

$pdf->CuadroCuerpoPersonalizado(25,"",0,"L",$borde,"B",10);
$pdf->CuadroCuerpoMulti(155,("      1.- NPO"),0,"L",$borde,"",9);
$pdf->CuadroCuerpoPersonalizado(25,"",0,"L",$borde,"B",10);
$pdf->CuadroCuerpoMulti(155,("      2.- CSV X TURNO"),0,"L",$borde,"",9);
$pdf->CuadroCuerpoPersonalizado(25,"",0,"L",$borde,"B",10);
$pdf->CuadroCuerpoMulti(155,("      3.- SOLICITAR EXPEDIENTE CLINICO"),0,"L",$borde,"",9);
$pdf->CuadroCuerpoPersonalizado(25,"",0,"L",$borde,"B",10);
$pdf->CuadroCuerpoMulti(155,("      4.- PASA A QUIROFANO A SOLICITUD"),0,"L",$borde,"",9);
$pdf->CuadroCuerpoPersonalizado(25,"",0,"L",$borde,"B",10);
$pdf->CuadroCuerpoMulti(155,("      5.- VISITA PREANESTESICA"),0,"L",$borde,"",9);

$pdf->CuadroCuerpoPersonalizado(25,"",0,"L",$borde,"B",10);
$pdf->CuadroCuerpoMulti(155,("PLAN QUIRURGICO"),0,"L",$borde,"",9);
$pdf->CuadroCuerpoPersonalizado(25,"",0,"L",$borde,"B",10);
$pdf->CuadroCuerpoMulti(155,("INCISION ENDOVESTIBULAR BILATERAL Y TRANSFIXIANTE , LUEGO INCISIONES EN FONDO DE SACO, RESECCION DE BORDE CEFALICO BILATERAL DE ESTOS Y BORDE CAUDAL  DE CARTILAGO SEPTAL; RESECCION DE GIBA OSTEOCARTILAGINOSA DE ACUERDO A REQUERIMIENTO, OSTEOTOMIAS MEDIAS Y LATERALES (PERCUTANEAS)."),0,"L",$borde,"",8);
$pdf->Output("Historia Clinica","I");
?>