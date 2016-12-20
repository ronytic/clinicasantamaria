<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Registro de Nuevo Paciente";

include_once '../../funciones/funciones.php';
include_once '../../cabecerahtml.php';
?>
<?php include_once '../../cabecera.php';?>
<div class="grid_12">
	<div class="contenido imagenfondo">
    	<div class="prefix_2 grid_4 alpha">
			<fieldset>
				<div class="titulo"><?php echo $titulo?></div>
                <form action="guardar.php" method="post" enctype="multipart/form-data">
				<table class="tablareg">
					<tr>
						<td><?php campos("Nombres","nombres","text","",1,array("required"=>"required"));?></td>
                        <td><?php campos("Ap. Paterno","paterno","text");?></td>
                        <td><?php campos("Ap. Materno","materno","text");?></td>
					</tr>
					<tr>
						<td><?php campos("Sexo","sexo","select",array("F"=>"Femenino","M"=>"Masculino"));?></td>
                        <td><?php campos("Edad","edad","text");?></td>
                        <td><?php campos("C.I.","ci","text");?></td>
					</tr>
                    <tr>
                        <td><?php campos("Ocupación","ocupacion","text");?></td>
                        <td><?php campos("Estado Civil","estadocivil","select",array("Soltero"=>"Soltero","Casado"=>"Casado","Divorciado"=>"Divorciado","Divorciado"=>"Divorciado","Viudo"=>"Viudo"));?></td>
						<td><?php campos("Dirección","direccion","text");?></td>
					</tr>
                    <tr>
                        <td><?php campos("Teléfono Fijo","telefonofijo","text");?></td>
                        <td><?php campos("Celular","celular","text");?></td>
						<td><?php campos("Email","email","text");?></td>
					</tr>
                    <tr>
						<td><?php campos("Fecha de Registro","fecharegistro","date",date("Y-m-d"),0,array("required"=>"required"));?></td>
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