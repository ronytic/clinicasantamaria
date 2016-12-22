<?php 
include_once '../../login/check.php';
if (!empty($_POST)) {
	$folder="../../";
	include_once '../../class/prequirurgico.php';
	$prequirurgico=new prequirurgico;
    include_once '../../class/paciente.php';
	$paciente=new paciente;
    extract($_POST);
    //print_r($_SESSION);
    $idusuario=$_SESSION['idusuario'];
	
	$pq=$prequirurgico->mostrarTodo("fechaconsulta LIKE '$fechaconsulta' and coddoctor=$idusuario and codpaciente IN(SELECT codpaciente FROM paciente WHERE nombres LIKE '%$nombres%' and paterno LIKE '%$paterno%' and materno LIKE '%$materno%' and ci LIKE '$ci%')");
    $datos=array();
    $i=0;
    foreach($pq as $p){$i++;
        $pac=$paciente->mostrar($p['codpaciente']);
        $pac=array_shift($pac);
        $datos[$i]['codprequirurgico']=$p['codprequirurgico'];
        $datos[$i]['nombres']=$pac['nombres'];
        $datos[$i]['paterno']=$pac['paterno'];
        $datos[$i]['materno']=$pac['materno'];
        $datos[$i]['ci']=$pac['ci'];
        $datos[$i]['celular']=$pac['celular'];
        $datos[$i]['sexo']=$pac['sexo'];
        $datos[$i]['estadocivil']=$pac['estadocivil'];
        $datos[$i]['fechaconsulta']=$p['fechaconsulta'];
    }
	$titulo=array("nombres"=>"Nombres","paterno"=>"Paterno","materno"=>"Materno","ci"=>"C.I.","celular"=>"Celular","sexo"=>"Sexo","estadocivil"=>"Estado Civil","fechaconsulta"=>"Fecha de Consulta");
	listadoTabla($titulo,$datos,1,"","","",array("Revisar Reporte"=>"reporte.php"));
}
?>