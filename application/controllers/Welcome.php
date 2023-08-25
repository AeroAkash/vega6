<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Welcome_model');
		$this->load->database();
	}

	public function index(){
		$this->load->view('login');
	}

	public function signup_page(){
		$this->load->view("sign_up");
	}

	public function sign_in(){
		$result = $this->Welcome_model->sign_in();

		if(!empty($result)){
			$data      = $result;
      $id        = $data['id'];
      $name      = $data['name'];
      $email     = $data['email'];
			$image     = $data['image'];
      
      
      $sesdata = array(
        'user_id'  => $id,
        'name'     => $name,
        'email'    => $email,
				'image'    => $image,
        'logged_in'    =>TRUE,
        );

			$this->session->set_userdata($sesdata);
			$this->session->set_flashdata('msg','Sucess'); 
			
			echo json_encode([
				'status' => true
			]);
		}
		else{
			echo json_encode([
				'status' => false
			]);
		}
	}

	public function sign_up(){
		$this->Welcome_model->sign_up();
	}

	public function dashboard(){
		$this->load->view('dashboard');
	}
}