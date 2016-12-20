<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Modificar Datos del Paciente";
$id=$_GET['id'];
include_once '../../class/paciente.php';
$paciente=new paciente;
$pac=array_shift($paciente->mostrar($id));

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
						<td><?php campos("Nombres","nombres","text",$pac['nombres'],1,array("required"=>"required"));?></td>
                        <td><?php campos("Ap. Paterno","paterno","text",$pac['paterno']);?></td>
                        <td><?php campos("Ap. Materno","materno","text",$pac['materno']);?></td>
					</tr>
					<tr>
						<td><?php campos("Sexo","sexo","select",array("F"=>"Femenino","M"=>"Masculino"),0,"",$pac['sexo']);?></td>
                        <td><?php campos("Edad","edad","text",$pac['edad']);?></td>
                        <td><?php campos("C.I.","ci","text",$pac['ci']);?></td>
					</tr>
                    <tr>
                        <td><?php campos("Ocupación","ocupacion","text",$pac['ocupacion']);?></td>
                        <td><?php campos("Estado Civil","estadocivil","select",array("Soltero"=>"Soltero","Casado"=>"Casado","Divorciado"=>"Divorciado","Divorciado"=>"Divorciado","Viudo"=>"Viudo"),0,"",$pac['estadocivil']);?></td>
						<td><?php campos("Dirección","direccion","text",$pac['direccion']);?></td>
					</tr>
                    <tr>
                        <td><?php campos("Teléfono Fijo","telefonofijo","text",$pac['telefonofijo']);?></td>
                        <td><?php campos("Celular","celular","text",$pac['celular']);?></td>
						<td><?php campos("Email","email","text",$pac['email']);?></td>
					</tr>
                    <tr>
						<td><?php campos("Fecha de Registro","fecharegistro","date",$pac['fecharegistro'],0,array("required"=>"required"));?></td>
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