<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_m extends CI_Model 
{
	public function __construct() {
		parent:: __construct();
	}

	//Acceso de usuarios
	public function login($username, $password)
	{
		//Comprobamos que el usuario existe en al base de datos
		$this->db->where('username', $username)
					   ->from('users');
		$query = $this->db->get();
		
		//Si existe
		if( $query->num_rows() > 0 ) {

			//Comprobamos que el usuario y la contraseña son iguales
			$this->db->where('username', $username)
							 ->where('password', $password);
			$this->db->from('users');
			$query = $this->db->get();			
			
			if( $query->num_rows() > 0 ) {

				$query = $query->row();
				//reamos la sesión
				$this->session->set_userdata( 'login', $query->username );
				redirect('/backend', 'refresh');
			}
			else{
				return $this->session->set_flashdata('error', 'La contraseña es incorrecta.');
			}
		} 
		else {
			return $this->session->set_flashdata('error', 'El usuario no existe en al base de datos.');
		}
	}

}