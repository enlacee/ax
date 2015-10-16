<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ofertas extends CI_Controller {

	public function __construct() {
		parent:: __construct();
		$this->load->model('ofertas_m');
		$this->load->helper('security');
	}	
	
	//Get todas las ofertas y slider
	public function index()
	{
		//Get all slider
		$datos['slider'] = $this->ofertas_m->get_slider();
		$datos['ofertas'] = $this->ofertas_m->get_ofertas();

		$this->load->view('theme/front-end/header.php');
		$this->load->view('ofertas_v.php', $datos);
		$this->load->view('theme/front-end/footer.php');
	}


	//Get oferta detail
	public function detalle($id)
	{
		//Clean ID
		$id_clean = $this->security->xss_clean($id);

		//Get detalle oferta
		$datos['detalle'] = $this->ofertas_m->get_detalle_oferta($id_clean);

		//Geet ofertas random
		$datos['ofertas_rand'] = $this->ofertas_m->get_ofertas_rand();

		//Check exists record
		if($datos['detalle'] === FALSE) {
			show_404();
		}

		$this->load->view('theme/front-end/header.php');
		$this->load->view('oferta_detalle_v.php', $datos);
		$this->load->view('theme/front-end/footer.php');
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */