<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ofertas_m extends CI_Model {

	public function __construct() {
		parent:: __construct();
	}

	//Get all slider
	public function get_slider()
	{
		$this->db->where('status', '1');
		$condiciones = array('slider');
		$this->db->where_in('name_category', $condiciones);

		$this->db->order_by('id', 'desc');
		$query = $this->db->get('ofertas');

		if( $query->num_rows() > 0 ) {

			return $query->result();
		} 
		else {
			return false;
		}
	}


	//Get all ofertas
	public function get_ofertas()
	{
		$this->db->where('status', '1');
		$condiciones = array('standart', 'special');
		$this->db->where_in('type', $condiciones);

		$this->db->order_by('id', 'desc');
		$query = $this->db->get('ofertas');

		if( $query->num_rows() > 0 ) {

			return $query->result();
		} 
		else {
			return false;
		}
	}


	//Get detalle oferta
	public function get_detalle_oferta($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('ofertas');

		if( $query->num_rows() > 0 ) {

			return $query->row();
		} 
		else {
			return false;
		}
	}


	//Get ofertas rand
	public function get_ofertas_rand()
	{
		$this->db->select('id, name_category, title, description, image, type, status');
		$this->db->where('status', '1');

		$condiciones = array('slider', 'special');
		$this->db->where_not_in('type', $condiciones);

		$this->db->order_by('id', 'random');
		$this->db->limit(4);
		$query = $this->db->get('ofertas');

		if( $query->num_rows() > 0 ) {

			return $query->result();
		} 
		else {
			return false;
		}
	}

}