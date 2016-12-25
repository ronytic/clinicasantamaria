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
	
	$pq=$prequirurgico->mostrarTodo("fechaconsulta LIKE '$fechaconsulta' and codpaciente IN(SELECT codpaciente FROM paciente WHERE nombres LIKE '%$nombres%' and paterno LIKE '%$paterno%' and materno LIKE '%$materno%' and ci LIKE '$ci%')");
    
    $enlaces=array("Reporte Prequirugico"=>"prequirugico.php",
                "Form.de Internación"=>"internacion.php",
                "Hist. Clinica"=>"historiaclinica.php",
                "Hoja Eva."=>"hojaevaluacion.php",
                "Hoja Eva. 2"=>"hojaevaluacion2.php",
                "Pap. Orden "=>"papeleta.php",
                "Operación"=>"operacion.php",
                "Epicrisis"=>"epicrisis.php",
                "Hoja Enfermera"=>"enfermera.php",
                );
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
	//listadoTabla($titulo,$datos,1,"","","",$enlaces);
}
?>
<table class="tablalistado">
    <thead>
	<tr class="cabecera">
	<td>Nº</td>
		<td>Nombres</td>
		<td>Paterno</td>
		<td>Materno</td>
		<td>C.I.</td>
		<td>Celular</td>
		<td>Sexo</td>
		<td>Estado Civil</td>
		<td>Fecha de Consulta</td>
		</tr>
	</thead>
    <?php $i=0;foreach($datos as $d){$i++;
    ?>
    <tr class="contenido">
	    <td><?php echo $i;?></td>
		<td><?php echo $d['nombres']?></td>
		<td><?php echo $d['paterno']?></td>
		<td><?php echo $d['materno']?></td>
		<td><?php echo $d['ci']?></td>
		<td><?php echo $d['celular']?></td>
		<td><?php echo $d['sexo']?></td>
		<td><?php echo $d['estadocivil']?></td>
		<td><?php echo $d['fechaconsulta']?></td>
        <td>
            <!--<a href="prequirugico.php?id=<?php echo $d['codprequirurgico']?>" class="boton" target="_blank">Reporte Prequirugico</a>
            <a href="internacion.php?id=<?php echo $d['codprequirurgico']?>" class="boton" target="_blank">Form.de Internación</a>-->
            <a href="historiaclinica.php?id=<?php echo $d['codprequirurgico']?>" class="boton" target="_blank">Hist. Clinica</a>
            <a href="hojaevaluacion.php?id=<?php echo $d['codprequirurgico']?>" class="boton" target="_blank">Hoja Eva.</a>
            <a href="hojaevaluacion2.php?id=<?php echo $d['codprequirurgico']?>" class="boton" target="_blank">Hoja Eva. 2</a>
            <a href="papeleta.php?id=<?php echo $d['codprequirurgico']?>" class="boton" target="_blank">Pap. Orden </a>
            <a href="operacion.php?id=<?php echo $d['codprequirurgico']?>" class="boton" target="_blank">Operación</a>
            <a href="epicrisis.php?id=<?php echo $d['codprequirurgico']?>" class="boton" target="_blank">Epicrisis</a>
            <a href="enfermera.php?id=<?php echo $d['codprequirurgico']?>" class="boton" target="_blank">Hoja Enfermera</a>
           
        </td>
		</tr>
    <?php    
    }?>
</table>