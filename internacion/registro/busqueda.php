<?php 
include_once '../../login/check.php';
if (!empty($_POST)) {
	$folder="../../";
	include_once '../../class/confirmacioncirugia.php';
	$confirmacioncirugia=new confirmacioncirugia;
    include_once '../../class/paciente.php';
	$paciente=new paciente;
    extract($_POST);
    //print_r($_SESSION);
    $idusuario=$_SESSION['idusuario'];
	$estado=$_POST['estado']==1?" and fechaconsultareal!='0000-00-00'":"and fechaconsultareal='0000-00-00'";
    //if($_POST['estado']==""){$estado="";}
    
	$pq=$confirmacioncirugia->mostrarTodo("fechaoperacion LIKE '$fechaoperacion' and codpaciente IN(SELECT codpaciente FROM paciente WHERE nombres LIKE '%$nombres%' and paterno LIKE '%$paterno%' and materno LIKE '%$materno%' and ci LIKE '$ci%')");
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

        $datos[$i]['fechaoperacion']=$p['fechaoperacion'];
        $datos[$i]['estado']=$p['fechaconsultareal']!="0000-00-00"?'Revisado':'Pendiente';
    }
	$titulo=array("nombres"=>"Nombres","paterno"=>"Paterno","materno"=>"Materno","ci"=>"C.I.","celular"=>"Celular","sexo"=>"Sexo","estadocivil"=>"Estado Civil","fechaoperacion"=>"Fecha de la Operación");
	listadoTabla($titulo,$datos,1,"","","",array("Registrar Internación"=>"consulta.php"));
}
?>