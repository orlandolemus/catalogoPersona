<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PersonaModel extends CI_Model {

	function PersonaModel(){
        parent::__construct();
		date_default_timezone_set('America/El_Salvador');
    }

    function save($persona){

    	$data = array(
    		'nombres' => $persona->nombres,
    		'apellidos' => $persona->apellidos,
    		'genero' => $persona->genero,
    		'fecha_nacimiento' => $this->fecha_amd($persona->fecha_nacimiento),
		);

		if(isset($persona->id) && $persona->id != null && $persona->id != "" ){
			$this->db->where('id', $persona->id);
			$this->db->update('persona',$data);
		}else{
    		$this->db->insert('persona',$data);
		}
		
		if( $this->db->_error_message() != FALSE OR $this->db->_error_message() != "" OR $this->db->_error_message() != NULL ){
			$res = "Error al Almacenar los datos. 
				<br>No se registro el formulario. 
				<br>Error _PERS_SAVE: 
				<br>".$this->db->_error_message(); // Debug
		}
		else{
			$res = TRUE;
		}
		
		return $res;
    }


    function delete($persona_id){
    	$this->db->delete( 'persona', array('id' => $persona_id) );	
		if( $this->db->_error_message() != FALSE OR $this->db->_error_message() != "" OR $this->db->_error_message() != NULL ){
			return "Error al eliminar registro.  
				<br>Error PERS_DELETE: 
				<br>".$this->db->_error_message(); // Debug
		}
		else{
			return TRUE;
		}
    }

    function get($persona_id){
    	$this->db->from("persona");
		$this->db->where("id", $persona_id);
		$query = $this->db->get();
        $row = $query->row();

		if(isset($row)){
			return $row;
		}else{
			return false;
		}
    }

    function listAll(){
		$today = new \DateTime('now'); $today = $today->format('Y-m-d');
		$edad = "TRUNCATE( datediff('".$today."',fecha_nacimiento) / 365, 0 ) as edad";

		$query = "SELECT id, CONCAT(nombres,' ',apellidos) as nombre, genero, DATE_FORMAT(fecha_nacimiento,'%d/%m/%Y') as fecha_nacimiento, ".$edad. " FROM persona";
		$result = $this->db->query($query);	

		return $result->result_array();
    }


    /**************************************************************************
	***************************************************************************/
	function fecha_amd($fecha){
		/*********************************************************
		**	convertir formato de entrada:						**
		**	dd/mm/aaaa, dd/mmm/aaaa, dd/nombreMes/aaaa			**
		**	a formato de salida de base de datos 				**
		**	aaaa-mm-dd											**
		*********************************************************/
		
		$primer_separ = strpos($fecha,'/') | strpos($fecha,'-');
		$segund_separ = strrpos($fecha,'/') | strrpos($fecha,'-');
		$dia = substr($fecha, 0, 2);
		$mes   = substr($fecha, ($primer_separ+1), ( $segund_separ-($primer_separ+1) ) );
		$ano = substr($fecha, ($segund_separ+1), 4);

		$mesF=""; 
		switch(strtolower($mes)){
			case "ene": case "enero": case "01":
				$mesF="01";
				break;
			case "feb": case "febrero": case "02":
				$mesF="02";
				break;
			case "mar": case "marzo": case "03":
				$mesF="03";
				break;
			case "abr": case "abril": case "04":
				$mesF="04";
				break;
			case "may": case "mayo": case "05":
				$mesF="05";
				break;
			case "jun": case "junio": case "06":
				$mesF="06";
				break;
			case "jul": case "julio": case "07":
				$mesF="07";
				break;
			case "ago": case "agosto": case "08":
				$mesF="08";
				break;
			case "sep": case "septiembre": case "09":
				$mesF="09";
				break;
			case "oct": case "octubre": case "10":
				$mesF="10";
				break;
			case "nov": case "noviembre": case "11":
				$mesF="11";
				break;
			case "dic": case "diciembre": case "12":
				$mesF="12";
				break;
			default: return false;		
		}
		return $ano."-".$mesF."-".$dia;
	}

}