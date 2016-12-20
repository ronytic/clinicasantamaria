<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Asignación de Nueva Consulta";
$id=$_GET['p'];
include_once '../../class/paciente.php';
$paciente=new paciente;
$pac=array_shift($paciente->mostrar($id));
include_once("../../class/usuarios.php");
$usuarios=new usuarios;
$doc=todolista($usuarios->mostrarTodo("nivel=3"),"codusuarios","paterno,materno,nombres","");

include_once '../../funciones/funciones.php';
include_once '../../cabecerahtml.php';
?>
<?php include_once '../../cabecera.php';?>
<div class="grid_12">
	<div class="contenido imagenfondo">
    	<div class="prefix_2 grid_4 alpha">
			<fieldset>
				<div class="titulo"><?php echo $titulo?></div>
                <form action="actualizar.php" method="post" enctype="multipart/form-data">
                <?php campos("","id","hidden",$id);?>
				<table class="tablareg">
					<tr>
						<td><?php campos("Nombres","nombres","text",$pac['nombres'],1,array("required"=>"required","readonly"=>"readonly"));?></td>
                        <td><?php campos("Ap. Paterno","paterno","text",$pac['paterno'],0,array("readonly"=>"readonly"));?></td>
                        <td><?php campos("Ap. Materno","materno","text",$pac['materno'],0,array("readonly"=>"readonly"));?></td>
					</tr>
					<tr>
						<td><?php campos("Sexo","sexo","select",array("F"=>"Femenino","M"=>"Masculino"),0,array("readonly"=>"readonly","class"=>"readonly"),$pac['sexo']);?></td>
                        <td><?php campos("Edad","edad","text",$pac['edad'],0,array("readonly"=>"readonly"));?></td>
                        <td><?php campos("C.I.","ci","text",$pac['ci'],0,array("readonly"=>"readonly"));?></td>
					</tr>
                    <tr>
                        <td><?php campos("Ocupación","ocupacion","text",$pac['ocupacion'],0,array("readonly"=>"readonly"));?></td>
                        <td><?php campos("Estado Civil","estadocivil","select",array("Soltero"=>"Soltero","Casado"=>"Casado","Divorciado"=>"Divorciado","Divorciado"=>"Divorciado","Viudo"=>"Viudo"),0,array("readonly"=>"readonly"),$pac['estadocivil']);?></td>
						<td><?php campos("Dirección","direccion","text",$pac['direccion'],0,array("readonly"=>"readonly"));?></td>
					</tr>
                    <tr>
                        <td><?php campos("Teléfono Fijo","telefonofijo","text",$pac['telefonofijo'],0,array("readonly"=>"readonly"));?></td>
                        <td><?php campos("Celular","celular","text",$pac['celular'],0,array("readonly"=>"readonly"));?></td>
						<td><?php campos("Email","email","text",$pac['email'],0,array("readonly"=>"readonly"));?></td>
					</tr>
                    <tr>
						<td><?php campos("Fecha de Registro","fecharegistro","date",$pac['fecharegistro'],0,array("required"=>"required","readonly"=>"readonly"));?></td>
                        
                        <td><?php campos("Fecha de Consulta","fechaconsulta","date",$pac['fecharegistro'],0,array("required"=>"required",));?></td>
                        <td><?php campos("Doctor para Consulta","coddoctor","select",$doc,0,array("readonly"=>"readonly","class"=>"readonly"));?></td>
					</tr>
					<tr><td><?php campos("Guardar","guardar","submit");?></td></tr>
				</table>
                </form>
			</fieldset>
		</div>
    	<div class="clear"></div>
    </div>
</div>
<?php include_once '../../piepagina.php';?>