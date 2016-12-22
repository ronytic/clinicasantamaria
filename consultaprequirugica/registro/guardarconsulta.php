<?php
include_once '../../login/check.php';
/*echo "<pre>";
print_r($_POST);
echo "</pre>";*/
extract($_POST);
$fechaconsultareal=date("Y-m-d");
$horaconsultareal=date("H:i:s");
$codmedicoreal=$_SESSION['idusuario'];
$valores=array(
"motivo"=>"'$motivo'",
"motivootro"=>"'$motivootro'",
"bebidaalcoholica"=>"'$bebidaalcoholica'",
"fuma"=>"'$fuma'",
"fumaotro"=>"'$fumaotro'",
"patologico"=>"'$patologico'",
"medicamentos"=>"'$medicamentos'",
"medicamentosotro"=>"'$medicamentosotro'",
"alergia"=>"'$alergia'",
"alergiaotro"=>"'$alergiaotro'",
"cirugia"=>"'$cirugia'",
"cirugiaotro"=>"'$cirugiaotro'",
"menarca"=>"'$menarca'",
"fum"=>"'$fum'",
"fup"=>"'$fup'",
"catmenstruacion"=>"'$catmenstruacion'",
"catmenstruacionotro"=>"'$catmenstruacionotro'",
"gesta"=>"'$gesta'",
"partos"=>"'$partos'",
"cesarea"=>"'$cesarea'",
"abortos"=>"'$abortos'",
"base"=>"'$base'",
"dorso"=>"'$dorso'",
"punta"=>"'$punta'",
"columena"=>"'$columena'",
"narinas"=>"'$narinas'",
"fascies"=>"'$fascies'",
"laterorrinia"=>"'$laterorrinia'",
"laterorriniasi"=>"'$laterorriniasi'",
"desvioseptal"=>"'$desvioseptal'",
"desevioseptalderarea"=>"'$desevioseptalderarea'",
"desevioseptaldergrado"=>"'$desevioseptaldergrado'",
"desevioseptalizqarea"=>"'$desevioseptalizqarea'",
"desevioseptalizqgrado"=>"'$desevioseptalizqgrado'",
"hipertrofiaturbinal"=>"'$hipertrofiaturbinal'",
"hipertrofiaturbinalder"=>"'$hipertrofiaturbinalder'",
"hipertrofiaturbinalizq"=>"'$hipertrofiaturbinalizq'",
"hipertrofiaturbinalotro"=>"'$hipertrofiaturbinalotro'",
"medicionancho"=>"'$medicionancho'",
"medicionfosas"=>"'$medicionfosas'",
"medicioncorumela"=>"'$medicioncorumela'",
"angulo1"=>"'$angulo1'",
"angulo2"=>"'$angulo2'",
"angulo3"=>"'$angulo3'",
"dimension"=>"'$dimension'",
"anchonasal"=>"'$anchonasal'",
"anchoalar"=>"'$anchoalar'",
"longitud"=>"'$longitud'",
"proyeccion"=>"'$proyeccion'",
"alturapuente"=>"'$alturapuente'",
"angulolabial"=>"'$angulolabial'",
"angulofrontal"=>"'$angulofrontal'",
"relacionalar"=>"'$relacionalar'",
"rinocifosis"=>"'$rinocifosis'",
"rinocifoescoliosis"=>"'$rinocifoescoliosis'",
"septorrinoescoliosis"=>"'$septorrinoescoliosis'",
"desvioseptalc"=>"'$desvioseptalc'",
"narizsecundaria"=>"'$narizsecundaria'",
"sinequiaturbino"=>"'$sinequiaturbino'",
"rinitisalergica"=>"'$rinitisalergica'",
"diagnosticootro"=>"'$diagnosticootro'",
"marginal"=>"'$marginal'",
"endovestibular"=>"'$Endovestibular'",
"hemitransfixiante"=>"'$hemitransfixiante'",
"transfixiante"=>"'$transfixiante'",
"abierto"=>"'$abierto'",
"incisionotro"=>"'$incisionotro'",
"planquirurgico1"=>"'$planquirurgico1'",
"planquirurgico2"=>"'$planquirurgico2'",
"planquirurgico3"=>"'$planquirurgico3'",
"planquirurgico4"=>"'$planquirurgico4'",
"planquirurgico5"=>"'$planquirurgico5'",
"planquirurgico6"=>"'$planquirurgico6'",
"planquirurgico7"=>"'$planquirurgico7'",
"planquirurgico8"=>"'$planquirurgico8'",
"planquirurgico9"=>"'$planquirurgico9'",
"planquirurgico10"=>"'$planquirurgico10'",
"planquirurgico11"=>"'$planquirurgico11'",

"codcirugia"=>"'$codcirugia'",
"fechaconsultareal"=>"'$fechaconsultareal'",
"horaconsultareal"=>"'$horaconsultareal'",
"codmedicoreal"=>"'$codmedicoreal'",
);

/*echo "<pre>";
print_r($valores);
echo "</pre>";*/
include_once '../../class/prequirurgico.php';
$prequirurgico=new prequirurgico;
$prequirurgico->actualizar($valores,$id);
$mensaje[]="LOS CONSULTA PREQUIRUGICA SE GUARDO CORRECTAMENTE";
$nuevo=1;
$listar=1;
$botones=array("listar.php?"=>"Revisar otra consulta Prequirugica","../general/verreporte.php?a=1"=>"Ver Reporte Prequirugico");

$titulo="Mensaje de Respuesta";
$folder="../../";
include_once '../../mensajeresultado.php';
?>