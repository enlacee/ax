<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ofertas_m extends CI_Model 
{
	public function __construct() {
		parent:: __construct();
	}


	//Get all offert
	public function get_ofertas()
	{
		$this->db->order_by('id', 'desc');
		$query = $this->db->get('ofertas');

		if( $query->num_rows() > 0 ) {

			return $query->result();
		}
		else {

			return false;
		}
	}


	//Get all category
	public function get_category()
	{
		$this->db->select('id, name');
		$this->db->order_by('id', 'asc');
		$query = $this->db->get('category');

		if( $query->num_rows() > 0 ) {

			return $query->result();
		}
		else {

			return false;
		}
	}

	/**
	 * Get all label
	 * Label en las ofertas
	 */
	public function get_label()
	{
		$this->db->order_by('id', 'desc');
		$query = $this->db->get('label');

		if( $query->num_rows() > 0 ) {

			return $query->result();
		}
		else {

			return false;
		}
	}

	//Add oferta
	public function insert_oferta ($data)
	{
		$this->db->insert( 'ofertas', $data);

		if($this->db->affected_rows() > 0) {
			return true;
		}	
		else {
			return false;
		}
	} 


	//Eliminar registros
	public function delete_oferta_model($id)
	{	
		//sleep(1);
		$this->db->delete('ofertas', array('id' => $id));

		if( $this->db->affected_rows() > 0 ) {
			$datos = array(
										"respuesta" => TRUE,
										"mensaje" 	=> '<div class="alert alert-success" role="alert">¡EL REGISTRO SE HA ELIMINADO!</div>');
			echo json_encode($datos);
		}
		else{
			$datos = array(
										"respuesta" => FALSE,
										"mensaje" 	=> 'El registro no se pudo eliminar, ppor favor intentelo mas tarde.');
			echo json_encode($datos);
		}
	}
	

	//Get info editar ofertas
	public function get_info_editar_ofertas($id)
	{
		$this->db->where('id', $id);
		$this->db->from('ofertas');
		$query = $this->db->get();

		if( $query->num_rows() > 0 ) {
			return $query->row();
		}
		else{
			return false;
		}
	}


	//Editar ofertas
	public function editar_ofertas_model($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('ofertas', $data);
	} 

}