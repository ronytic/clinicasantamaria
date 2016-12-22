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

include_once '../../class/internacion.php';
$internacion=new internacion;
$int=array_shift($internacion->mostrarTodo("codprequirurgico=".$id));
//print_r($cc);

include_once '../../class/confirmacioncirugia.php';
$confirmacioncirugia=new confirmacioncirugia;
$cc=array_shift($confirmacioncirugia->mostrarTodo("codprequirurgico=".$id));

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
                <?php campos("","codprequirurgico","text",$id);?>
                <?php campos("","id","text",$int['codinternacion']);?>
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
                        <td>Fecha de la Operación Programada</td>
                        <td>Fecha de la Operación</td>
                        <td>Número de Habitación</td>
                    </tr>
                    <tr>
                        <td><?php campos("","fechaoperacion","date",$cc['fechaoperacion'],0,array("rel"=>"c1","readonly"=>"readonly"));?></td>
                        <td><?php campos("","fechaoperacionreal","date",date("Y-m-d"),0,array("rel"=>"c1","required"=>"required"));?></td>
                        <td><?php campos("","numerohabitacion","text","",0,array(""=>"","rel"=>"c1"));?></td>
                       
                    </tr>
                    

                </table>
                <table class="tablareg">
                    <tr class="resaltar">
                        <td>Signos Vitales</td>
                    </tr>
                    <tr>
                        <td><?php campos("PA:","pa","text","120/80",0,array(""=>"","style"=>"width:70px"));?></td>
                        <td><?php campos("FC:","fc","text","60",0,array(""=>"","style"=>"width:70px"));?></td>
                        <td><?php campos("FR:","fr","text","20",0,array(""=>"","style"=>"width:70px"));?></td>
                        <td><?php campos("Tº:","t","text","36.00",0,array(""=>"","style"=>"width:70px"));?></td>
                        <td><?php campos("Peso:","peso","text","65",0,array(""=>"","style"=>"width:70px"));?></td>
                        
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