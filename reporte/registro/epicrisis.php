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
include_once("../../class/cirugia.php");
$paciente=new paciente;
$cirugia=new cirugia;
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
$cir=array_shift($cirugia->mostrarTodo("codcirugia=".$pre['codcirugia']));
$docope=array_shift($usuarios->mostrar($con['coddoctor']));
$pdf=new PDF("P","mm","letter");
$borde=0;
$pdf->AddPage();

$pdf->SetXY(20,54);

$pdf->CuadroCuerpoPersonalizado(103,$pac['paterno']." ".$pac['materno']." ".$pac['nombres'],0,"L",$borde,"",11);
$pdf->CuadroCuerpoPersonalizado(10,$pac['edad'],0,"R",$borde,"",11);
$pdf->CuadroCuerpoPersonalizado(10,$pac['sexo'],0,"R",$borde,"",11);
$pdf->CuadroCuerpoPersonalizado(10,substr($pac['estadocivil'],0,3),0,"R",$borde,"",11);
$pdf->CuadroCuerpoPersonalizado(45,($pac['ocupacion']),0,"C",$borde,"",11);
$pdf->SetXY(168,38);
$pdf->CuadroCuerpoPersonalizado(50,$pac['ci'],0,"L",0,"B",10);
$pdf->Ln(7);

if($pre['rinocifosis']=="si"){$diagnostico="RINOCIFOSIS";}
if($pre['rinocifoescoliosis']=="si"){$diagnostico="RINOCOFOESCOLIOSIS";}
if($pre['septorrinoescoliosis']=="si"){$diagnostico="Septorrinoescoliosis";}
if($pre['desvioseptalc']=="si"){$diagnostico="Desvío Septal";}
if($pre['hipertrofiaturbinaldiagnostico']=="si"){$diagnostico.="Hipertrofia Turbinal";}
if($pre['narizsecundaria']=="si"){$diagnostico="Nariz Secundaria";}
if($pre['sinequiaturbino']=="si"){$diagnostico="Sinequia Turbino Septal";}
if($pre['rinitisalergica']=="si"){$diagnostico="Rinitis Alergica";}
if($pre['diagnosticootro']!=""){$diagnostico=$pre['diagnosticootro'];}

$pdf->SetXY(20,68);
$pdf->CuadroCuerpoPersonalizado(50,$int['fecha'],0,"C",$borde,"",10);
$pdf->CuadroCuerpoPersonalizado(85,$diagnostico,0,"C",$borde,"",10);
$pdf->CuadroCuerpoPersonalizado(45,"8 HORAS",0,"C",$borde,"",10);
$pdf->Ln();


$pdf->SetXY(20,85);
$pdf->CuadroCuerpoPersonalizado(50,$int['fecha'],0,"C",$borde,"",10);
$pdf->CuadroCuerpoPersonalizado(85,$diagnostico,0,"C",$borde,"",10);
$pdf->CuadroCuerpoPersonalizado(45,"",0,"C",$borde,"",10);
$pdf->Ln();

$pdf->SetXY(20,105);
$pdf->CuadroCuerpoMulti(175,mb_strtoupper($pre['motivo']." ".$pre['motivootro'],"utf8"),0,"C",$borde,"",9);

$pdf->SetXY(20,125);
$pdf->CuadroCuerpoMulti(175,mb_strtoupper("Dentro  de parámetros normales","utf8"),0,"C",$borde,"",9);

$pdf->SetXY(20,147);
$pdf->CuadroCuerpoMulti(175,mb_strtoupper("Dentro  de parámetros normales","utf8"),0,"C",$borde,"",9);


$pdf->SetXY(40,165);
$pdf->CuadroCuerpoMulti(150,mb_strtoupper("Dr.: ".$docope['paterno']." ".$docope['materno']." ".$docope['nombre'],"utf8"),0,"C",$borde,"",9);
$pdf->SetXY(40,171);
$pdf->CuadroCuerpoMulti(150,mb_strtoupper("".$cir['nombre'],"utf8"),0,"C",$borde,"",9);


$pdf->SetXY(40,193);
$pdf->CuadroCuerpoMulti(150,mb_strtoupper("FAVORABLE                                             SIN COMPLICACIONES","utf8"),0,"C",$borde,"",9);

$pdf->SetXY(40,215);
$pdf->CuadroCuerpoMulti(150,mb_strtoupper("BUENAS 
CONTROL POR CONSULTORIO","utf8"),0,"L",$borde,"",9);


$pdf->Output("Historia Clinica","I");
?>