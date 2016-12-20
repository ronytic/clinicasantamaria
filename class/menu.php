<?php 
include_once("bd.php");
class menu extends bd{
	var $tabla="menu";
	function mostrarMenu($Nivel){
		$this->campos=array("*");
		switch ($Nivel) {
			case 1:{return $this->getRecords("superadmin=1 and activo=1","orden");}break;
			case 2:{return $this->getRecords("gerente=1 and activo=1","orden");}break;
			case 3:{return $this->getRecords("doctor=1 and activo=1","orden");}break;
			case 4:{return $this->getRecords("secretaria=1 and activo=1","orden");}break;
            case 5:{return $this->getRecords("enfermera=1 and activo=1","orden");}break;
		}
	}
}
?>