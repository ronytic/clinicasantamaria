<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Formulario de Confirmación de Cirugía";
$id=$_GET['id'];
include_once '../../class/prequirurgico.php';
$prequirurgico=new prequirurgico;
$pre=array_shift($prequirurgico->mostrar($id));
include_once '../../class/paciente.php';
$paciente=new paciente;
$pac=array_shift($paciente->mostrar($pre['codpaciente']));

include_once '../../class/confirmacioncirugia.php';
$confirmacioncirugia=new confirmacioncirugia;
$cc=array_shift($confirmacioncirugia->mostrarTodo("codprequirurgico=".$id));
//print_r($cc);

include_once("../../class/usuarios.php");
$usuarios=new usuarios;
$doc=todolista($usuarios->mostrarTodo("nivel=3"),"codusuarios","paterno,materno,nombre,especialidad","");
$turno=array("M"=>"Mañana","T"=>"Tarde");
$sino=array("0"=>"No","1"=>"Si");

include_once '../../funciones/funciones.php';
include_once '../../cabecerahtml.php';
?>
<script type="text/javascript" language="javascript">
</script>
<?php include_once '../../cabecera.php';?>
<div class="grid_12">
	<div class="contenido imagenfondo">
    	<div class="prefix_0 grid_11 ">
			<fieldset>
				<div class="titulo"><?php echo $titulo?></div>
                <form action="guardarconsulta.php" method="post" enctype="multipart/form-data">
                <?php campos("","codprequirurgico","hidden",$id);?>
                <?php campos("","id","hidden",$cc['codconfirmacioncirugia']);?>
                <table class="tablareg">
                    <tr class="titulo2">
                    	<td>Nombres</td>
                    	<td>Ap. Paterno</td>
                        <td>Ap. Materno</td>
                        <td>Sexo</td>
                        <td>Edad</td>
                        <td>C.I./NHC</td>
                        <td>Ocupación</td>
                    </tr>
                    <tr class="subtitulo2">
                        <td><?php echo $pac['nombres']?></td>
                        <td><?php echo $pac['paterno']?></td>
                        <td><?php echo $pac['materno']?></td>
                        <td><?php echo $pac['sexo']?></td>
                        <td><?php echo $pac['edad']?></td>
                        <td><?php echo $pac['ci']?></td>
                        <td><?php echo $pac['ocupacion']?></td>
                    </tr>
                    <tr class="titulo2">
                    	<td>Estado Civil</td>
                    	<td>Dirección</td>
                        <td>Teléfono Fijo</td>
                        <td>Celular</td>
                        <td>Email</td>
                        <td>Fecha de Registro</td>
                        <td>Fecha de Consulta</td>
                    </tr>
                    <tr class="subtitulo2">
                        <td><?php echo $pac['estadocivil']?></td>
                        <td><?php echo $pac['direccion']?></td>
                        <td><?php echo $pac['telefonofijo']?></td>
                        <td><?php echo $pac['celular']?></td>
                        <td><?php echo $pac['email']?></td>
                        <td><?php echo $pac['fecharegistro']?></td>
                        <td><?php echo $pre['fechaconsulta']?></td>
                    </tr>
                </table>
                <table class="tablareg">
                    <tr class="resaltar">
                        <td>Fecha de la Operación</td>
                        <td>Hora de la Operación</td>
                        <td>Turno de la Operación</td>
                    </tr>
                    <tr>
                        <td><?php campos("","fechaoperacion","date",date("Y-m-d"),0,array("rel"=>"c1","required"=>"required"));?></td>
                        <td><?php campos("","horaoperacion","text","",0,array(""=>"","rel"=>"c1"));?></td>
                        <td><?php campos("","turnooperacion","select",$turno,0,array("required"=>"required","class"=>"readonly"));?></td>
                    </tr>
                    <tr class="resaltar">
                        <td>Doctor</td>
                        <td>Instrumentadora</td>
                        <td>Anestesista</td>
                    </tr>
                    <tr>
                        <td><?php campos("","coddoctor","select",$doc,0,array(""=>"","class"=>""));?></td>
                        <td><?php campos("","codinstrumentadora","select",$doc,0,array(""=>"","class"=>""));?></td>
                        <td><?php campos("","codanestesista","select",$doc,0,array(""=>"","class"=>""));?></td>
                    </tr>
                    <tr class="resaltar">
                        <td>Cancelado</td>
                        <td>Fotocopia C.I.</td>
                        <td>Laboratorio</td>
                        <td>Valoración Cardiológica</td>
                    </tr>
                    <tr>
                        <td><?php campos("","cancelado","select",array("Campana"=>"Campaña","Normal"=>"Normal"),0,array(""=>"","class"=>""));?></td>
                        <td><?php campos("","fotocopiaci","select",$sino,0,array(""=>"","class"=>""));?></td>
                        <td><?php campos("","laboratorio","select",$sino,0,array(""=>"","class"=>""));?></td>
                        <td><?php campos("","valoracioncardiologica","select",$sino,0,array(""=>"","class"=>""));?></td>
                    </tr>
                </table>
                
                
                
                
                
                
                
                
                
                
                
                
                
                

				<table class="tablareg">
					<tr><td><?php campos("Guardar","guardar","submit");?></td></tr>
				</table>
                </form>
			</fieldset>
		</div>
    	<div class="clear"></div>
    </div>
</div>
<?php include_once '../../piepagina.php';?>