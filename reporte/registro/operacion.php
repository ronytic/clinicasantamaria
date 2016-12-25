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
$docins=array_shift($usuarios->mostrar($con['codinstrumentadora']));
$docane=array_shift($usuarios->mostrar($con['codanestesista']));


$pdf=new PDF("P","mm","letter");
$borde=0;
$pdf->AddPage();

$pdf->SetXY(10,38);
$pdf->CuadroCuerpoPersonalizado(35,$pac['paterno'],0,"L",$borde,"",11);

$pdf->SetXY(50,38);
$pdf->CuadroCuerpoPersonalizado(35,$pac['materno'],0,"L",$borde,"",11);

$pdf->SetXY(90,38);
$pdf->CuadroCuerpoPersonalizado(55,$pac['nombres'],0,"L",$borde,"",11);

$pdf->SetXY(145,38);
$pdf->CuadroCuerpoPersonalizado(35,"Edad:".$pac['edad']." "." SEXO:".$pac['sexo'],0,"L",$borde,"",11);

$pdf->SetXY(195,41);
$pdf->CuadroCuerpoPersonalizado(15,$int['numerohabitacion'],0,"L",$borde,"B",10);


$pdf->SetXY(25,60);
$pdf->CuadroCuerpoPersonalizado(10,date("d",strtotime($int['fecha'])),0,"L",$borde,"B",10);


$pdf->SetXY(40,60);
$pdf->CuadroCuerpoPersonalizado(10,date("m",strtotime($int['fecha'])),0,"L",$borde,"B",10);

$pdf->SetXY(55,60);
$pdf->CuadroCuerpoPersonalizado(10,date("Y",strtotime($int['fecha'])),0,"L",$borde,"B",10);

$pdf->SetXY(90,60);
$pdf->CuadroCuerpoPersonalizado(25,$con['turnooperacion']=="M"?'11:00':'19:00',0,"L",$borde,"",10);



if($pre['rinocifosis']=="si"){$diagnostico="RINOCIFOSIS";}
if($pre['rinocifoescoliosis']=="si"){$diagnostico="RINOCOFOESCOLIOSIS";}
if($pre['septorrinoescoliosis']=="si"){$diagnostico="Septorrinoescoliosis";}
if($pre['desvioseptalc']=="si"){$diagnostico="Desvío Septal";}
if($pre['hipertrofiaturbinaldiagnostico']=="si"){$diagnostico.="Hipertrofia Turbinal";}
if($pre['narizsecundaria']=="si"){$diagnostico="Nariz Secundaria";}
if($pre['sinequiaturbino']=="si"){$diagnostico="Sinequia Turbino Septal";}
if($pre['rinitisalergica']=="si"){$diagnostico="Rinitis Alergica";}
if($pre['diagnosticootro']!=""){$diagnostico=$pre['diagnosticootro'];}

$pdf->SetXY(170,60);
$pdf->CuadroCuerpoPersonalizado(25,$diagnostico,0,"L",$borde,"",10);



$pdf->SetXY(90,80);
$pdf->CuadroCuerpoPersonalizado(6,"X",0,"L",$borde,"",10);






$pdf->SetXY(30,90);
$pdf->CuadroCuerpoPersonalizado(65,"Dr.: ".$docope['paterno']." ".$docope['materno']." ".$docope['nombre'],0,"C",0,"",10);


$pdf->SetXY(135,90);
$pdf->CuadroCuerpoPersonalizado(65,"Dr.: ".$docins['paterno']." ".$docins['materno']." ".$docins['nombre'],0,"C",0,"",10);


$pdf->SetXY(135,96);
$pdf->CuadroCuerpoPersonalizado(65,"DE TURNO ",0,"L",0,"",10);

$pdf->SetXY(135,103);
$pdf->CuadroCuerpoPersonalizado(65,"Dr.: ".$docane['paterno']." ".$docane['materno']." ".$docane['nombre'],0,"C",0,"",10);


$pdf->SetXY(103,119);
$pdf->CuadroCuerpoPersonalizado(6,"X",0,"L",$borde,"",10);



$pdf->SetXY(70,125);
$pdf->CuadroCuerpoPersonalizado(130,$cir['nombre'],0,"L",$borde,"",10);


$pdf->SetXY(35,141);
$pdf->CuadroCuerpoPersonalizado(70,"EL CIRUJANO",0,"C",$borde,"",10);


$pdf->SetXY(80,174);
$pdf->CuadroCuerpoPersonalizado(25,$diagnostico,0,"L",$borde,"",10);

$pdf->SetXY(60,190);
$pdf->CuadroCuerpoPersonalizado(45,"45 MINUTOS",0,"L",$borde,"",10);
$pdf->CuadroCuerpoPersonalizado(55,"INICIO DE CIRUGÍA:    ".($con['turnooperacion']=="M"?'10:15':'18:15'),0,"L",$borde,"",10);
$pdf->ln(6);
$pdf->CuadroCuerpoPersonalizado(95,"",0,"L",$borde,"",10);
$pdf->CuadroCuerpoPersonalizado(55,"FIN  DE CIRUGÍA:        ".($con['turnooperacion']=="M"?'11:00':'19:00'),0,"L",$borde,"",10);




$pdf->SetXY(30,203);
$pdf->CuadroCuerpoMulti(155,("  ANSISEPSIA Y ASEPSIA DE REGION OPERATORIA , SE REALIZA TRICOTOMIA , INCISION ENDOVESTIBULAR BILATERAL Y TRANSFIXIANTE , LUEGO INCISIONES EN FONDO DE SALCO HASTA IDENTIFICAR CARTILAGO ALAR INFERIOR , SE PROCEDE A RESECCION DE BORDE CEFALICO BILATERAL DE ESTOS Y BORDE CAUDAL  DE CARTILAGO SEPTAL; DECOLACION DE DORSO NASAL Y RESECCION DE GIBA OSTEOCARTILAGINOSA CON LA AYUDADE ESCOPLO DE CITELLI, SE REGULARIZAN BORDES OSEOS CON RASPA , OSTEOTOMIAS MEDIAS Y LATERALES (PERCUTANEAS), SE ALINEA DORSO NASAL  Y HEMOSTASIA COMPRESIVA."),0,"L",$borde,"",9);

$pdf->SetXY(30,245);
$pdf->CuadroCuerpoMulti(155,(" CIERRE DE INCISIONES TAPONES NASALES FERULA NASAL , ACTO QUIRUGICO SIN COMPLICACIONES, "),0,"L",$borde,"",9);



$pdf->Output("Historia Clinica","I");
?>