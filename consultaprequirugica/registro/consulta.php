<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Formulario de Consulta Prequirugica";
$id=$_GET['id'];
include_once '../../class/prequirurgico.php';
$prequirurgico=new prequirurgico;
$pre=array_shift($prequirurgico->mostrar($id));
include_once '../../class/paciente.php';
$paciente=new paciente;
$pac=array_shift($paciente->mostrar($pre['codpaciente']));

include_once("../../class/cirugia.php");
$cirugia=new cirugia;
$cir=todolista($cirugia->mostrarTodo(""),"codcirugia","nombre","");

include_once '../../funciones/funciones.php';
include_once '../../cabecerahtml.php';
?>
<script type="text/javascript" language="javascript">
$(document).on("ready",function(){
    $(".cotro").change(function(e) {
        var c=$(this).attr("rel");
        //alert($(this,":checked").val());
        if($(this,":checked").val()=="otro") {  
            $("."+c).removeAttr("readonly");
        } else {  

            $("."+c).attr({"readonly":"readonly"});
        } 
    }); 
    $(".csi").change(function(e) {
        var c=$(this).attr("rel");
        //alert($(this,":checked").val());
        if($(this,":checked").val()=="si") {  
            $("."+c).removeAttr("readonly");
        } else {  

            $("."+c).attr({"readonly":"readonly"});
        } 
    }); 
    $(".cm").change(function(e) {
        var c=$(this).attr("rel");
        //alert($(this,":checked").val());
        if($(this,":checked").val()=="irregular") {  
            $("."+c).removeAttr("readonly");
        } else {  

            $("."+c).attr({"readonly":"readonly"});
        } 
    });   
    $(".desvioseptal").change(function(e) {
        var c=$(this).attr("rel");
        //alert($(this,":checked").val());
        if($(this,":checked").val()=="si") {  
            $("."+c).removeAttr("readonly");
        } else {  

            $("."+c).attr({"readonly":"readonly"});
        } 
    });
     $(".hipertrofiaturbinal").change(function(e) {
        var c=$(this).attr("rel");
        //alert($(this,":checked").val());
        if($(this,":checked").val()=="otro") {  
            $("."+c).removeAttr("readonly");
        } else {  

            $("."+c).attr({"readonly":"readonly"});
        } 
    });  
    $(".dimension").change(function(e) {
        var c=$(this).attr("rel");
        //alert($(this,":checked").val());
        if($(this,":checked").val()=="otro") {  
            $("."+c).removeAttr("readonly");
        } else {  

            $("."+c).attr({"readonly":"readonly"});
        } 
    });   
})
</script>
<?php include_once '../../cabecera.php';?>
<div class="grid_12">
	<div class="contenido imagenfondo">
    	<div class="prefix_0 grid_11 ">
			<fieldset>
				<div class="titulo"><?php echo $titulo?></div>
                <form action="guardarconsulta.php" method="post" enctype="multipart/form-data">
                <?php campos("","id","hidden",$id);?>
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
                <table>
                    <tr>
                        <td><strong>Motivo de la Consulta:</strong> 
                        <?php campos("Estetica","motivo","radio","estetica",0,array("class"=>"cotro","rel"=>"c1"));?>
                        <?php campos("Funcional","motivo","radio","funcional",0,array("class"=>"cotro","rel"=>"c1"));?>
                        <?php campos("Otro","motivo","radio","otro",0,array("class"=>"cotro","rel"=>"c1"));?>
                        <?php campos("","motivootro","text","",0,array("readonly"=>"readonly","class"=>"c1"));?></td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Antecedente Personales No Patológicos:</strong><br>
                            <strong>Bebidas Alcoholicas:</strong>
                            <?php campos("Si","bebidaalcoholica","radio","si",0,array("class"=>"cotro","rel"=>"c1"));?>
                            <?php campos("No","bebidaalcoholica","radio","no",0,array("class"=>"cotro","rel"=>"c1"));?>
                            <?php campos("Ocasionalmente","bebidaalcoholica","radio","ocasionalmente",0,array("class"=>"cotro","rel"=>"c1"));?>
                            <br>
                            <strong>Fuma:</strong>
                            <?php campos("Si","fuma","radio","si",0,array("class"=>"cotro","rel"=>"c2"));?>
                            <?php campos("No","fuma","radio","no",0,array("class"=>"cotro","rel"=>"c2"));?>
                            <?php campos("Ocasionalmente","fuma","radio","ocasionalmente",0,array("class"=>"cotro","rel"=>"c2"));?>
                            <?php campos("Otros","fuma","radio","otro",0,array("class"=>"cotro","rel"=>"c2"));?>
                            <?php campos("","fumaotro","text","",0,array("readonly"=>"readonly","class"=>"c2"));?>
                            
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Antecedente Personales Patológicos:</strong>
                            <?php campos("Si","patologico","radio","si",0,array("class"=>"cotro","rel"=>"c3"));?>
                            <?php campos("No","patologico","radio","no",0,array("class"=>"cotro","rel"=>"c3"));?>
                            

                        
                            <br>
                            <strong>Consume Medicamentos:</strong>
                            <?php campos("No","medicamentos","radio","no",0,array("class"=>"csi","rel"=>"c4"));?>
                            <?php campos("Si","medicamentos","radio","si",0,array("class"=>"csi","rel"=>"c4"));?>
                            
                            <?php campos("","medicamentosotro","text","",0,array("readonly"=>"readonly","class"=>"c4"));?>
                            
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <strong>Alergias:</strong>
                            <?php campos("No","alergia","radio","no",0,array("class"=>"csi","rel"=>"c5"));?>
                            <?php campos("Si","alergia","radio","si",0,array("class"=>"csi","rel"=>"c5"));?>
                            
                            <?php campos("","alergiaotro","text","",0,array("readonly"=>"readonly","class"=>"c5"));?>
                            <strong>Cirugias:</strong>
                            <?php campos("No","cirugia","radio","no",0,array("class"=>"csi","rel"=>"c6"));?>
                            <?php campos("Si","cirugia","radio","si",0,array("class"=>"csi","rel"=>"c6"));?>
                            
                            <?php campos("","cirugiaotro","text","",0,array("readonly"=>"readonly","class"=>"c6"));?>
                        </td>
                    </tr>
                    <?php if($pac['sexo']=="M"){echo "<!--";}?>
                    <tr>
                        <td>
                            <strong>Antecedentes GinecoObstreticos:</strong><br>
                            <?php campos("Menarca","menarca","text","",0,array(""=>"","class"=>""));?><br>
                            <?php campos("Fecha de Última Menstruación","fum","number","",0,array(""=>"","class"=>""));?><br>
                            <?php campos("Fecha de Último Parto","fup","text","",0,array(""=>"","class"=>""));?><br>
                            <strong>Categoría Menstruación: </strong>
                            <?php campos("Normal","catmenstruacion","radio","normal",0,array("class"=>"cm","rel"=>"c7"));?>
                            <?php campos("Irregular","catmenstruacion","radio","irregular",0,array("class"=>"cm","rel"=>"c7"));?>
                            <?php campos("","catmenstruacionotro","text","",0,array("readonly"=>"readonly","class"=>"c7"));?><br>
                            <?php campos("Gesta","gesta","number","",0,array("style"=>"width:100px;","class"=>""));?>
                            <?php campos("Partos","partos","number","",0,array("style"=>"width:100px;","class"=>""));?>
                            <?php campos("Cesarea","cesarea","number","",0,array("style"=>"width:100px;","class"=>""));?>
                            <?php campos("Abortos","abortos","number","",0,array("style"=>"width:100px;","class"=>""));?><br>
                        </td>
                    </tr>
                    <?php if($pac['sexo']=="M"){echo "-->";}?>
                    <tr>
                        <td><strong>Exámen Rinológico</strong><br>
                        <?php campos("Base:","base","text","",0,array("style"=>"","class"=>""));?>
                        <?php campos("Dorso:","dorso","text","",0,array("style"=>"","class"=>""));?><br>
                        <?php campos("Punta:","punta","text","",0,array("style"=>"","class"=>""));?>
                        <?php campos("Columena:","columena","text","",0,array("style"=>"","class"=>""));?>
                        <br>
                        <strong>Narinas:</strong>
                        <?php campos("Simetrica:","narinas","radio","simetrica",0,array("style"=>"","class"=>""));?>
                        <?php campos("Asimetrica:","narinas","radio","asimetrica",0,array("style"=>"","class"=>""));?>
                        <br>
                        <strong>Fascies:</strong>
                        <?php campos("Simetrica:","fascies","radio","simetrica",0,array("style"=>"","class"=>""));?>
                        <?php campos("Asimetrica:","fascies","radio","asimetrica",0,array("style"=>"","class"=>""));?>
                        <br>
                        <strong>Laterorrinia:</strong>
                        <?php campos("No:","laterorrinia","radio","no",0,array("rel"=>"c8","class"=>"late"));?>
                        <?php campos("Si:","laterorrinia","radio","si",0,array("rel"=>"c8","class"=>"late"));?>
                        (<?php campos("Izq:","laterorriniasi","radio","izq",0,array("readonly"=>"readonly","class"=>"c8"));?>
                        <?php campos("Der:","laterorriniasi","radio","der",0,array("readonly"=>"readonly","class"=>"c8"));?>)
                        <br>
                        <strong>Desvio Septal:</strong>
                        <?php campos("No:","desvioseptal","radio","no",0,array("rel"=>"c9","class"=>"desvioseptal"));?>
                        <?php campos("Si:","desvioseptal","radio","si",0,array("rel"=>"c9","class"=>"desvioseptal"));?>
                        (Derecho: <?php campos("Area:","desevioseptalderarea","text","",0,array("readonly"=>"c9","class"=>"c9"));?> 
                        <?php campos("Grado:","desevioseptaldergrado","text","",0,array("readonly"=>"readonly","class"=>"c9"));?> <br>
                        Izq: <?php campos("Area:","desevioseptalizqarea","text","",0,array("readonly"=>"c9","class"=>"c9"));?> 
                        <?php campos("Grado:","desevioseptalizqgrado","text","",0,array("readonly"=>"c9","class"=>"c9"));?>)
                        <br>
                        <strong>Desvio Septal:</strong>
                        <?php campos("No:","hipertrofiaturbinal","radio","no",0,array("rel"=>"c10","class"=>"desvioseptal"));?>
                        <?php campos("Si:","hipertrofiaturbinal","radio","si",0,array("rel"=>"c10","class"=>"desvioseptal"));?>
                        <?php campos("Otro:","hipertrofiaturbinal","radio","otro",0,array("rel"=>"c11","class"=>"hipertrofiaturbinal"));?>
                        <br>
                        (Derecho: <?php campos("Grado:","hipertrofiaturbinalder","text","",0,array("readonly"=>"c9","class"=>"c10"));?> 
                        Izquierdo: <?php campos("Grado:","hipertrofiaturbinalizq","text","",0,array("readonly"=>"readonly","class"=>"c10"));?> )
                        
                        
                       <?php campos("Otro:","hipertrofiaturbinalotro","text","",0,array("readonly"=>"readonly","class"=>"c11"));?>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Mediciones:</strong><br>
                        <?php campos("Ancho:","medicionancho","text","",0,array(""=>"","class"=>""));?>
                        <?php campos("Fosas:","medicionfosas","text","",0,array(""=>"","class"=>""));?>
                        <?php campos("Corumela:","medicioncorumela","text","",0,array(""=>"","class"=>""));?>
                        <br>
                        <?php campos("Angulo 1:","angulo1","text","",0,array(""=>"","class"=>""));?>
                        <?php campos("Angulo 2:","angulo2","text","",0,array(""=>"","class"=>""));?>
                        <?php campos("Angulo 3:","angulo3","text","",0,array(""=>"","class"=>""));?>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Dimensiones de la Nariz:</strong><br>
                        <?php campos("No:","dimension","radio","no",0,array("rel"=>"c12","class"=>"dimension"));?>
                        <?php campos("Si:","dimension","radio","si",0,array("rel"=>"c12","class"=>"dimension"));?>
                        <br>
                        <?php campos("Ancho nasal:","anchonasal","text","",0,array(""=>"","class"=>""));?>mm.<br>
                        <?php campos("Ancho Alar:","anchoalar","text","",0,array(""=>"","class"=>""));?>mm.<br>
                        <?php campos("Longitud:","longitud","text","",0,array(""=>"","class"=>""));?>mm.<br>
                        <?php campos("Proyección:","proyeccion","text","",0,array(""=>"","class"=>""));?>mm.<br>
                        <?php campos("Altura Puente:","alturapuente","text","",0,array(""=>"","class"=>""));?>mm.<br>
                        <?php campos("Angulo Naso Labial:","angulolabial","text","",0,array(""=>"","class"=>""));?>º<br>
                        <?php campos("Angulo Naso Frontal:","angulofrontal","text","",0,array(""=>"","class"=>""));?>º<br>
                        <?php campos("Relación Alar-Columenla:","relacionalar","text","",0,array(""=>"","class"=>""));?>mm.<br>

                        
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Diagnostico</strong><br>
                           <?php campos("Rinocifosis:","rinocifosis","checkbox","si",0,array(""=>"","class"=>""));?><br>
                           <?php campos("Rinocifoescoliosis:","rinocifoescoliosis","checkbox","si",0,array(""=>"","class"=>""));?><br>
                           <?php campos("Septorrinoescoliosis:","septorrinoescoliosis","checkbox","si",0,array(""=>"","class"=>""));?><br>
                           <?php campos("Desvío Septal:","desvioseptalc","checkbox","si",0,array(""=>"","class"=>""));?><br>
                           <?php campos("Hipertrofia Turbinal:","hipertrofiaturbinal","checkbox","si",0,array(""=>"","class"=>""));?><br>
                           <?php campos("Nariz Secundaria:","narizsecundaria","checkbox","si",0,array(""=>"","class"=>""));?><br>
                           <?php campos("Sinequia Turbino Septal:","sinequiaturbino","checkbox","si",0,array(""=>"","class"=>""));?><br> 
                           <?php campos("Rinitis Alergica:","rinitisalergica","checkbox","si",0,array(""=>"","class"=>""));?><br> 
                            <?php campos("Diagnostico Otro:","diagnosticootro","text","",0,array(""=>"","class"=>""));?><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Incisión</strong><br>
                           <?php campos("Marginal:","marginal","checkbox","si",0,array(""=>"","class"=>""));?><br>
                           <?php campos("Endovestibular:","Endovestibular","checkbox","si",0,array(""=>"","class"=>""));?><br>
                           <?php campos("Hemitransfixiante:","hemitransfixiante","checkbox","si",0,array(""=>"","class"=>""));?><br>
                           <?php campos("Transfixiante:","transfixiante","checkbox","si",0,array(""=>"","class"=>""));?><br>
                           <?php campos("Abierto:","abierto","checkbox","si",0,array(""=>"","class"=>""));?><br>
                           <?php campos("Incisión Otro:","incisionotro","text","",0,array(""=>"","class"=>""));?><br>
                        </td>
                    </tr>
                    <tr>
                        <td><br>
                            <strong>Plan Quirugico:</strong><br>
                            <strong>Borde Cefaico de Cartilagos Alares:</strong>
                            <?php campos("No:","planquirurgico1","radio","no",0,array("rel"=>"","class"=>""));?>
                            <?php campos("Si:","planquirurgico1","radio","si",0,array("rel"=>"","class"=>""));?>
                            <br>
                            <strong>Resección de Dorso Osteocarilagionoso:</strong>
                            <?php campos("No:","planquirurgico2","radio","no",0,array("rel"=>"","class"=>""));?>
                            <?php campos("Si:","planquirurgico2","radio","si",0,array("rel"=>"","class"=>""));?>
                            <br>
                            <strong>Resección de Borde Caudal Cartilago Cuadrangular:</strong>
                            <?php campos("No:","planquirurgico3","radio","no",0,array("rel"=>"","class"=>""));?>
                            <?php campos("Si:","planquirurgico3","radio","si",0,array("rel"=>"","class"=>""));?>
                            <br>
                            <strong>Osetotomias Medias y Laterales:</strong>
                            <?php campos("No:","planquirurgico4","radio","no",0,array("rel"=>"","class"=>""));?>
                            <?php campos("Si:","planquirurgico4","radio","si",0,array("rel"=>"","class"=>""));?>
                            <br>
                            <strong>Aumento de la Rotación de la Punta:</strong>
                            <?php campos("No:","planquirurgico5","radio","no",0,array("rel"=>"","class"=>""));?>
                            <?php campos("Si:","planquirurgico5","radio","si",0,array("rel"=>"","class"=>""));?>
                            <br>
                            <strong>Injertos en Punta(Escudo de Sheen):</strong>
                            <?php campos("No:","planquirurgico6","radio","no",0,array("rel"=>"","class"=>""));?>
                            <?php campos("Si:","planquirurgico6","radio","si",0,array("rel"=>"","class"=>""));?>
                            <br>
                            <strong>Injertos en Dorso:</strong>
                            <?php campos("No:","planquirurgico7","radio","no",0,array("rel"=>"","class"=>""));?>
                            <?php campos("Si:","planquirurgico7","radio","si",0,array("rel"=>"","class"=>""));?>
                            <br>
                            <strong>Sutura Interdomal y Reborde Cefálico:</strong>
                            <?php campos("No:","planquirurgico8","radio","no",0,array("rel"=>"","class"=>""));?>
                            <?php campos("Si:","planquirurgico8","radio","si",0,array("rel"=>"","class"=>""));?>
                            <br>
                            <strong>Corección de SeptoNasal(Septoplastia):</strong>
                            <?php campos("No:","planquirurgico9","radio","no",0,array("rel"=>"","class"=>""));?>
                            <?php campos("Si:","planquirurgico9","radio","si",0,array("rel"=>"","class"=>""));?>
                            <br>
                            <strong>Tubinoplastia:</strong>
                            <?php campos("No:","planquirurgico10","radio","no",0,array("rel"=>"","class"=>""));?>
                            <?php campos("Si:","planquirurgico10","radio","si",0,array("rel"=>"","class"=>""));?>
                            <br>
                            <strong>Injerto(Strut Columelar):</strong>
                            <?php campos("No:","planquirurgico11","radio","no",0,array("rel"=>"","class"=>""));?>
                            <?php campos("Si:","planquirurgico11","radio","si",0,array("rel"=>"","class"=>""));?>
                            <br>
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Cirugía a Realizar:</strong><br>
                            <?php campos("","codcirugia","select",$cir,0,array(""=>"","class"=>"readonly"));?>
                        </td>
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