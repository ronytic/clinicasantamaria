<?php
include_once("../../login/check.php");
$titulo="Internación - Listado de Cirugias Programadas";
$folder="../../";

include_once("../../funciones/funciones.php");
include_once "../../cabecerahtml.php";
?>
<?php include_once "../../cabecera.php";?>
<div class="grid_12">
	<div class="contenido imagenfondo">
    	<div class="grid_8 prefix_1 alpha">
        	<fieldset>
        	<div class="titulo"><?php echo $titulo?> - Criterio de Búsqueda</div>
            <form id="busqueda" action="busqueda.php" method="post" >
                <table class="tablabus">
                    <tr>
                        <td><?php campos("Nombre","nombres","text","",1,array("size"=>15));?></td>
                        <td><?php campos("Paterno","paterno","text","",1,array("size"=>15));?></td>
                        <td><?php campos("Materno","Materno","text","",1,array("size"=>15));?></td>
                        <td><?php campos("C.I./NHC","ci","text","",1,array("size"=>15));?></td>
                    </tr>
                    <tr>
                        <!--<td><?php campos("Fecha de la Consulta","fechaconsulta","date",date("Y-m-d"),1,array("size"=>15,"required"=>"required"));?></td>-->
                        <td><?php campos("Fecha de la Cirugía","fechaoperacion","date",date("Y-m-d"),1,array("size"=>15,"required"=>"required"));?></td>
                            <td><?php campos("Buscar","enviar","submit","",0,array("size"=>15));?></td>
                            <td colspan="2">Solo se lista las Cirugías Programas y confirmadas</td>
                    </tr>
                </table>
            </form>
            </fieldset>
        </div>
        <div class="clear"></div>
        <div id="respuesta"></div>
    </div>
</div>
<?php include_once "../../piepagina.php";?>
