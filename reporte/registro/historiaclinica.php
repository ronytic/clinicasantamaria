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

$pdf->SetXY(80,15);

$pdf->CuadroCuerpoPersonalizado(65,"HISTORIA CLINICA",0,"C",0,"B",14);
$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado(85,"MÉDICO TRATANTE",0,"R",0,"B",10);
$pdf->CuadroCuerpoPersonalizado(65,"Dr.: ".$docope['paterno']." ".$docope['materno']." ".$docope['nombre'],0,"L",0,"B",10);
$pdf->Ln(7);
$pdf->CuadroCuerpoPersonalizado(35,"Nombre:",0,"L",$borde,"B",10);
$pdf->CuadroCuerpoPersonalizado(55,$pac['paterno']." ".$pac['materno']." ".$pac['nombres'],0,"L",$borde,"",11);
$pdf->CuadroCuerpoPersonalizado(25,"Edad:",0,"L",$borde,"B",10);
$pdf->CuadroCuerpoPersonalizado(25,$pac['edad'],0,"L",$borde,"",11);

$pdf->CuadroCuerpoPersonalizado(15,"Sexo:",0,"L",$borde,"B",10);
$pdf->CuadroCuerpoPersonalizado(25,$pac['sexo'],0,"L",$borde,"",11);
$pdf->Ln(17);
$pdf->CuadroCuerpoPersonalizado(30,"FECHA DE INT:",0,"L",$borde,"B",10);
$pdf->CuadroCuerpoPersonalizado(25,$int['fecha'],0,"L",$borde,"",11);
$pdf->CuadroCuerpoPersonalizado(25,"HORA DE INT:",0,"L",$borde,"B",10);
$pdf->CuadroCuerpoPersonalizado(25,"10:00",0,"L",$borde,"",11);
$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado(35,"SIGNOS VITALES:",0,"L",$borde,"",8);
$pdf->CuadroCuerpoPersonalizado(25,"PA:".$int['pa'],0,"L",$borde,"",8);
$pdf->CuadroCuerpoPersonalizado(25,"FC:".$int['fc'],0,"L",$borde,"",8);
$pdf->CuadroCuerpoPersonalizado(25,"FR:".$int['fr'],0,"L",$borde,"",8);
$pdf->CuadroCuerpoPersonalizado(25,"Tº:".$int['t'],0,"L",$borde,"",8);
$pdf->CuadroCuerpoPersonalizado(25,"Peso:".$int['peso'],0,"L",$borde,"",8);
$pdf->Ln(8);
$pdf->CuadroCuerpoPersonalizado(45,"MOTIVO DE INTERNACION:",0,"L",$borde,"B",9);
$pdf->CuadroCuerpoPersonalizado(45,mb_strtoupper($pre['motivo']=="otro"?$pre['motivootro']:$pre['motivo']),0,"L",$borde,"",9);
$pdf->Ln(8);
$pdf->CuadroCuerpoPersonalizado(45,"ENFERMEDAD ACTUAL:",0,"L",$borde,"B",9);
$pdf->CuadroCuerpoPersonalizado(45,mb_strtoupper("Paciente con  deformidad nasal, acude para resolución quirúrgica.","utf8"),0,"L",$borde,"",9);


$pdf->Ln(8);
$pdf->CuadroCuerpoPersonalizado(55,"ANTECEDENTES PERSONALES:",0,"L",$borde,"B",9);
$pdf->CuadroCuerpoPersonalizado(45,("NO PATOLOGICO:          Dieta balanceada, no fuma, bebe ocasionalmente."),0,"L",$borde,"",9);
$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado(55,"",0,"L",$borde,"B",9);
$pdf->CuadroCuerpoPersonalizado(45,("QUIRÚRGICOS:              ".$pre['cirugiaotro']),0,"L",$borde,"",9);
$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado(55,"",0,"L",$borde,"B",9);
$pdf->CuadroCuerpoPersonalizado(45,("PATOLÓGICOS:              Ninguno de importancia"),0,"L",$borde,"",9);
$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado(55,"",0,"L",$borde,"B",9);
$pdf->CuadroCuerpoPersonalizado(45,("MEDICAMENTOS ACTUALES:    ".$pre['medicamentosotro']),0,"L",$borde,"",9);
$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado(55,"",0,"L",$borde,"B",9);
$pdf->CuadroCuerpoPersonalizado(45,("ALERGIAS MEDICAMENTOSAS:  No refiere"),0,"L",$borde,"",9);
$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado(55,"ANTECEDENTES FAMILIARES:",0,"L",$borde,"B",9);
$pdf->CuadroCuerpoPersonalizado(45,("No refiere."),0,"L",$borde,"",9);
$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado(55,"ANAMNESIS POR SISTEMAS:",0,"L",$borde,"B",9);
$pdf->CuadroCuerpoPersonalizado(45,("No refiere."),0,"L",$borde,"",9);
$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado(55,"EXAMEN FISICO:",0,"L",$borde,"B",9);
$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado(55,"ESTADO GENERAL:",0,"L",$borde,"B",9);
$pdf->CuadroCuerpoPersonalizado(45,("Paciente en buen estado general, lúcido, afebril, piel y mucosas hidratadas y normocoloreadas."),0,"L",$borde,"",9);
$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado(55,"CABEZA Y CUELLO:",0,"L",$borde,"B",9);
$pdf->CuadroCuerpoPersonalizado(45,("CABEZA: Sin alteraciones"),0,"L",$borde,"",9);
$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado(55,"",0,"L",$borde,"B",9);
$pdf->CuadroCuerpoPersonalizado(45,("CUELLO: Sin alteraciones, no se palpan adenomegalias."),0,"L",$borde,"",9);
$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado(55,"",0,"L",$borde,"B",9);
$pdf->CuadroCuerpoPersonalizado(45,("OROSCOPIA: Sin particularidades"),0,"L",$borde,"",9);
$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado(55,"",0,"L",$borde,"B",9);
$pdf->CuadroCuerpoPersonalizado(45,("OTOSCOPIA: Sin signos de infección ni inflamación."),0,"L",$borde,"",9);
$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado(55,"",0,"L",$borde,"B",9);
$pdf->CuadroCuerpoPersonalizado(45,("RINOSCOPIA: Giba en dorso nasal, punta muy  caída y asimétrica. Laterorrinia"),0,"L",$borde,"",9);
$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado(55,"TÓRAX:",0,"L",$borde,"B",9);
$pdf->CuadroCuerpoMulti(115,("Movimientos respiratorios conservados, ruidos cardiacos normorrítmicos y normofonéticos. Murmullo vesicular conservado."),0,"L",$borde,"",9);

$pdf->CuadroCuerpoPersonalizado(55,"ABDOMEN:",0,"L",$borde,"B",9);
$pdf->CuadroCuerpoMulti(115,("Blando, depresible, no doloroso a la palpación superficial ni profunda, ruidos hidroaéreos conservados."),0,"L",$borde,"",9);

$pdf->CuadroCuerpoPersonalizado(55,"GENITO URINARIO:",0,"L",$borde,"B",9);
$pdf->CuadroCuerpoMulti(115,("De características normales."),0,"L",$borde,"",9);

$pdf->CuadroCuerpoPersonalizado(55,"MIEMBROS:",0,"L",$borde,"B",9);
$pdf->CuadroCuerpoMulti(115,("Tono y trofismo conservado, no edemas."),0,"L",$borde,"",9);
if($pre['rinocifosis']=="si"){
$pdf->CuadroCuerpoPersonalizado(55,"PRESUNCIÓN DIAGNÓSTICA:",0,"L",$borde,"B",9);
$pdf->CuadroCuerpoMulti(115,('RINOCIFOSIS'),0,"L",$borde,"",9);
}
if($pre['rinocifoescoliosis']=="si"){
$pdf->CuadroCuerpoPersonalizado(55,"",0,"L",$borde,"B",9);
$pdf->CuadroCuerpoMulti(115,('RINOCOFOESCOLIOSIS'),0,"L",$borde,"",9);
}
if($pre['septorrinoescoliosis']=="si"){
$pdf->CuadroCuerpoPersonalizado(55,"",0,"L",$borde,"B",9);
$pdf->CuadroCuerpoMulti(115,mb_strtoupper('Septorrinoescoliosis'),0,"L",$borde,"",9);
}
if($pre['desvioseptalc']=="si"){
$pdf->CuadroCuerpoPersonalizado(55,"",0,"L",$borde,"B",9);
$pdf->CuadroCuerpoMulti(115,mb_strtoupper('Desvío Septal'),0,"L",$borde,"",9);
}
if($pre['hipertrofiaturbinaldiagnostico']=="si"){
$pdf->CuadroCuerpoPersonalizado(55,"",0,"L",$borde,"B",9);
$pdf->CuadroCuerpoMulti(115,mb_strtoupper('Hipertrofia Turbinal'),0,"L",$borde,"",9);
}
if($pre['narizsecundaria']=="si"){
$pdf->CuadroCuerpoPersonalizado(55,"",0,"L",$borde,"B",9);
$pdf->CuadroCuerpoMulti(115,mb_strtoupper('Nariz Secundaria'),0,"L",$borde,"",9);
}
if($pre['sinequiaturbino']=="si"){
$pdf->CuadroCuerpoPersonalizado(55,"",0,"L",$borde,"B",9);
$pdf->CuadroCuerpoMulti(115,mb_strtoupper('Sinequia Turbino Septal'),0,"L",$borde,"",9);
}
if($pre['rinitisalergica']=="si"){
$pdf->CuadroCuerpoPersonalizado(55,"",0,"L",$borde,"B",9);
$pdf->CuadroCuerpoMulti(115,mb_strtoupper('Rinitis Alergica'),0,"L",$borde,"",9);
}
if($pre['diagnosticootro']!=""){
$pdf->CuadroCuerpoPersonalizado(55,"",0,"L",$borde,"B",9);
$pdf->CuadroCuerpoMulti(115,mb_strtoupper($pre['diagnosticootro']),0,"L",$borde,"",9);
}

$pdf->CuadroCuerpoPersonalizado(55,"EXAMENES COMPLEMENTARIOS:",0,"L",$borde,"B",9);
$pdf->CuadroCuerpoMulti(115,("Hemograma, glicemia y coagulograma dentro de parámetros normales sin contraindicación para cirugía."),0,"L",$borde,"",9);

$pdf->CuadroCuerpoPersonalizado(55,"RADIOGRAFÍA:",0,"L",$borde,"B",9);
$pdf->CuadroCuerpoMulti(115,("Giba nasal, cavidades paranasales neumatizadas, desvío septal fosa nasal derecha."),0,"L",$borde,"",9);
$pdf->Output("Historia Clinica","I");
?>