<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ofertas extends CI_Controller {
    
    const SOCIAL_TWITTER = 'twitter';
    const SOCIAL_FACEBOOK = 'facebook';

    public function __construct() {
		parent:: __construct();
		$this->load->model('backend/ofertas_m');
	}	
	
	//Get todas las ofertas y slider
	public function index()
	{
		//Comprobamos que existe una sesión
  	if( !$this->session->userdata('login') ) {
  		redirect('/admin/login', 'refresh');
  	}

  	//Get all ofertas
		$data["all_ofertas"] = $this->ofertas_m->get_ofertas();

		$this->load->view('theme/backend/head_top');
		$this->load->view('theme/backend/head_middle');
		$this->load->view('theme/backend/head_bottom');
		$this->load->view('backend/ofertas_v', $data);
	}


	//Pagina de inicio Login
	public function login()
	{	
		//Comprobamos que existe una sesión
  	if( $this->session->userdata('login') ) {
  		redirect('/backend', 'refresh');
  	}

		//Comprobamos que se envio el formulario
		if( array_key_exists( 'login', $_POST ) ) 
		{
			//Cargamos el modelo en la base de datos
			$this->load->model('backend/login_m');
			$username = $this->security->xss_clean( strip_tags($this->input->post('username')) );
			$password = md5( $this->security->xss_clean( strip_tags($this->input->post('password')) ) );
			$this->login_m->login($username, $password);
		}

		$this->load->view('theme/backend/head_top');
		$this->load->view('theme/backend/head_middle');
		$this->load->view('backend/login_v');
	}

	//Logout
	public function logout()
	{
		$this->session->sess_destroy();
		return redirect('/admin', 'refresh');
	}


	//Add new oferta DB
	public function add_ofertas()
	{
		//$this->output->enable_profiler(TRUE);
		//Comprobamos que se envio el formulario
  	if( !$this->session->userdata('login') ) {
  		redirect('/admin/login', 'refresh');
  	}

  	//Get all category
		$data['category'] = $this->ofertas_m->get_category();

		//Get all label
		$data["label"] = $this->ofertas_m->get_label();

		$this->load->view('theme/backend/head_top');
		$this->load->view('theme/backend/head_middle');
		$this->load->view('theme/backend/head_bottom');
		$this->load->view('backend/add_ofertas_v', $data);

		if( array_key_exists('agregar', $_POST) ) {

		//Subimos la imagen
		$config = array(
	                'upload_path'   => './assets/images/banner/ofertas/',
	                'allowed_types' => 'jpg|png|jpeg|gif',
	                'overwrite'     => FALSE,
	                'max_size'      => 2000,
	                'encrypt_name'  => 50
	                );
		//Cargamos la libreria
    $this->load->library('upload', $config);


    if ( !$this->upload->do_upload('image') ) {

      $datos['error'] = $this->upload->display_errors();
      $datos['titulo'] = "Upload file Codeigniter";
      $this->load->view('theme/backend/head_top');
			$this->load->view('theme/backend/head_middle');
			$this->load->view('theme/backend/head_bottom');
			$this->load->view('backend/add_ofertas_v', $datos);
    } 
    else {

      $nombre = $this->upload->data();
      $datos['nombre']  = $nombre['file_name'];
      $datos['titulo'] = "Upload file completed!";
      $this->load->view('theme/backend/head_top');
			$this->load->view('theme/backend/head_middle');
			$this->load->view('theme/backend/head_bottom');
			$this->load->view('backend/add_ofertas_v', $datos);
      //End file funtion

				/**
				 * Insertamos valores en al base de datos
				 * Obtenemos el id y el nombre de la categoria 
				 */
				$category = $this->input->post('category');
				$category = explode("-",$category);

				$data = array (
												'id_category' 						=> $category[0],
												'name_category'						=> $category[1],
												'tags'										=> implode(",", $this->input->post('tags') ),
												'label_image'							=> $this->input->post('label'),
												'title'										=> $this->input->post('title'),
												'resumen'									=> $this->input->post('resumen'),
												'description'							=> $this->input->post('description'),
												'image'										=> $nombre['file_name'],
												'type'										=> $this->input->post('type_anuncio'),
												'link' 										=> '#',
												'terms' 									=> $this->input->post('terms'),
												'external_link' 					=> $this->input->post('external_link'),
												'share' => !empty($this->input->post('share')) ? true : false,
												'facebook' 								=> '#',
												'twitter' 								=> '#',
												'youtube' 								=> '#',
												'bar_offert_title'				=> $this->input->post('bar_offert_title'),
												'bar_offert_description'	=> $this->input->post('bar_offert_description'),
												'create'									=> $this->input->post('create'),
												'create_strtotime'				=> strtotime( $this->input->post('create') ),
												'expira'									=> $this->input->post('expira'),
												'expira_strtotime'				=> strtotime( $this->input->post('expira') ),
												'update'									=> '0000-00-00 00:00:00',
												'status' 									=> '1'
											);			
				//echo "<pre>"; print_r( $this->input->post() );
				$this->ofertas_m->insert_oferta($data);
				header('Location: /backend');
			}

		}
	}


	//Eliminar oferta
	public function delete_oferta() 
	{
		//Comprobamos si la petición is AJAX
		if( !$this->input->is_ajax_request() ) {
			show_404();
		}

		$id_clean = $this->security->xss_clean( $this->input->post('id_user') );
		$statusQuery = $this->ofertas_m->delete_oferta_model($id_clean);
	}


	//Editar ofertas
	public function update_ofertas()
	{
		//Comprobamos que el usuario haya iniciado sesión
  	if( !$this->session->userdata('login') ) {
  		redirect('/admin/login', 'refresh');
  	}

  	//Muestra todas las categorias de la base de datos
  	$data['category'] = $this->ofertas_m->get_category();

  	//Get all label
		$data["label"] = $this->ofertas_m->get_label();

  	//Get ID desde la URL
  	$id = $this->security->xss_clean( strip_tags( $this->uri->segment(4) ) );
    $rsOferta = $this->ofertas_m->get_info_editar_ofertas($id);
    $data['oferta'] = ($rsOferta == false) ? new stdClass() : $rsOferta;

		$this->load->view('theme/backend/head_top');
		$this->load->view('theme/backend/head_middle');
		$this->load->view('theme/backend/head_bottom');
		$this->load->view('backend/editar_ofertas_v', $data);


		/**
		 * (Send Form)
		 * Si se envía el formulario 
		 */
		if( array_key_exists('update_btn', $_POST) ) { 
			
			//Si el usuario actualiza la imagen
			if($_FILES['image']['size'] > 0) {

				//Subimos la imagen
				$config = array(
			                'upload_path'   => './assets/images/banner/ofertas/',
			                'allowed_types' => 'jpg|png|jpeg|gif',
			                'overwrite'     => FALSE,
			                'max_size'      => 2000,
			                'encrypt_name'  => 50
			                );
				//Cargamos la libreria
		    $this->load->library('upload', $config);

		    if ( !$this->upload->do_upload('image') ) {

		      $datos['error'] = $this->upload->display_errors();
		      $datos['titulo'] = "Upload file Codeigniter";
		      $this->load->view('theme/backend/head_top');
					$this->load->view('theme/backend/head_middle');
					$this->load->view('theme/backend/head_bottom');
					$this->load->view('backend/editar_ofertas_v', $datos);
		    } else {
		      $nombre = $this->upload->data();
		      $datos['nombre']  = $nombre['file_name'];
		      $datos['titulo'] = "Upload file completed!";
		      $this->load->view('theme/backend/head_top');
					$this->load->view('theme/backend/head_middle');
					$this->load->view('theme/backend/head_bottom');
					$this->load->view('backend/editar_ofertas_v', $datos);
		      //End file funtion

						/**
						 * Insertamos valores en la base de datos
						 * Obtenemos el id y el nombre de la categoria 
						 */
						$category = $this->input->post('category');
						$category = explode("-",$category);

						$data = array (
                            'id_category' 			=> $category[0],
                            'name_category'			=> $category[1],
                            'tags'							=> implode(",", $this->input->post('tags') ),
                            'label_image'				=> $this->input->post('label'),
                            'title'							=> $this->input->post('title'),
                            'resumen'						=> $this->input->post('resumen'),
                            'description'				=> $this->input->post('description'),
                            'image'							=> $nombre['file_name'],
                            'type'							=> $this->input->post('type_anuncio'),
                            'link' 							=> '#',
                            'terms' 						=> $this->input->post('terms'),
                            'external_link' 		=> $this->input->post('external_link'),
                            'share' => !empty($this->input->post('share')) ? true : false,
                            'facebook' 					=> '#',
                            'twitter' 					=> '#',
                            'youtube' 					=> '#',
                            'bar_offert_title'				=> $this->input->post('bar_offert_title'),
                            'bar_offert_description'	=> $this->input->post('bar_offert_description'),
                            'create'						=> $this->input->post('create'),
                            'create_strtotime'	=> strtotime( $this->input->post('create') ),
                            'expira'						=> $this->input->post('expira'),
                            'expira_strtotime'	=> strtotime( $this->input->post('expira') ),
                            'update'						=> '0000-00-00 00:00:00',
                            'status' 						=> '1'
                        );
						
						//Get ID desde la URL
  					$id = $this->security->xss_clean( strip_tags( $this->uri->segment(4) ) );

						$this->ofertas_m->editar_ofertas_model($id, $data);
						header('Location: /backend');
					}//End else

				}//End if( $_FILES['image']['size'] )
				else{
						/**
						 * Si el usuario no selecciona subir una imagen
						 * Se actualiza todo el contenido y se mantiene la misma imgagen en la DB
						 * Insertamos valores en la base de datos
						 * Obtenemos el id y el nombre de la categoria 
						 */
						$category = $this->input->post('category');
						$category = explode("-",$category);

						$fecha = $this->input->post('create');

						$data = array (
                            'id_category' 			=> $category[0],
                            'name_category'			=> $category[1],
                            'tags'							=> implode(",", $this->input->post('tags') ),
                            'label_image'				=> $this->input->post('label'),
                            'title'							=> $this->input->post('title'),
                            'resumen'						=> $this->input->post('resumen'),
                            'description'				=> $this->input->post('description'),
                            'type'							=> $this->input->post('type_anuncio'),
                            'link' 							=> '#',
                            'terms' 						=> $this->input->post('terms'),
                            'external_link' 		=> $this->input->post('external_link'),
                            'share' => !empty($this->input->post('share')) ? true : false,
                            'facebook' 					=> '#',
                            'twitter' 					=> '#',
                            'youtube' 					=> '#',
                            'bar_offert_title'				=> $this->input->post('bar_offert_title'),
                            'bar_offert_description'	=> $this->input->post('bar_offert_description'),
                            'create'						=> $fecha,
                            'create_strtotime'	=> strtotime( $fecha ),
                            'expira'						=> $this->input->post('expira'),
                            'expira_strtotime'	=> strtotime( $this->input->post('expira') ),
                            'update'						=> '0000-00-00 00:00:00',
                            'status' 						=> '1'
                        );
						
						//Get ID desde la URL
  					$id = $this->security->xss_clean( strip_tags( $this->uri->segment(4) ) );

						$this->ofertas_m->editar_ofertas_model($id, $data);
						header('Location: /backend');
				}
		}
	}
    

}