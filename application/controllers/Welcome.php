<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Product_DB');
		$this->load->model('Mouvement_DB');
	}

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
	 public function index()
 	{
 		$data['contents'] = 'templates/login';
 		$uri = uri_string();
 		if($uri == 'login'){
 			$data['label'] = 'Se connecter';
 			$data['form_url'] = site_url('admin_login');
 		}elseif($uri == 'register'){
 			$data['label'] = "S'inscire";
 			$data['form_url'] = site_url('admin_register');
 		} else {
 			$data['label'] = 'Se connecter';
 			$data['form_url'] = site_url('admin_login');
 		}
 		$this->load->view('templates/template', $data);
 	}

	public function ajout(){
		$logged = $this->session->userdata('loggedAdmin');
		if($logged != NULL){
			$data['contents'] = 'templates/ajoutProduit';
			$this->load->view('templates/template', $data);
		}else{
			redirect('/');
		}
	}

	public function update($id){
		$logged = $this->session->userdata('loggedAdmin');
		if($logged != NULL){
			$data['produit'] = $this->Product_DB->getById($id);
			$data['contents'] = 'templates/ajoutProduit';
			$this->load->view('templates/template', $data);
		}else{
			redirect('/');
		}
	}

	public function accueil(){
		$logged = $this->session->userdata('loggedAdmin');
		if($logged != NULL){
			$data['contents'] = 'templates/produits';
			$data['produits'] = $this->Product_DB->findAll();
			$this->load->view('templates/template', $data);
		}else{
			redirect('/');
		}
	}

	public function importData(){
		$logged = $this->session->userdata('loggedAdmin');
		if($logged != NULL){
			$data['contents'] = 'templates/import';
			$this->load->view('templates/template', $data);
		}else{
			redirect('/');
		}
	}

	public function getStatParStation(){
		$logged = $this->session->userdata('loggedAdmin');
		if($logged != NULL){
			$data['stat'] = $this->Mouvement_DB->StatParStation();
			$data['contents'] = 'templates/stat';
			$this->load->view('templates/template', $data);
		}else{
			redirect('/');
		}
	}

	public function getStatParDate($station){
		$logged = $this->session->userdata('loggedAdmin');
		if($logged != NULL){
			$data['stat'] = $this->Mouvement_DB->StatParDate($station);
			$data['contents'] = 'templates/statPerStation';
			$this->load->view('templates/template', $data);
		}else{
			redirect('/');
		}
	}

	public function getStatParProduit($station, $date){
		$logged = $this->session->userdata('loggedAdmin');
		if($logged != NULL){
			$data['stat'] = $this->Mouvement_DB->StatParProduit($date, $station);
			$data['contents'] = 'templates/statPerDate';
			$this->load->view('templates/template', $data);
		}else{
			redirect('/');
		}
	}

	public function getBenefice(){
		$logged = $this->session->userdata('loggedAdmin');
		if($logged != NULL){
			$evol = $this->Mouvement_DB->evolutionVente();
			foreach ($evol as $value) {
				// code...
				$data['label'][] = $value->datemovement;
				$data['data'][] = $value->totalvente;
			}
			$data['chart_data'] = json_encode($data);
			$data['beneficeproduit'] = $this->Mouvement_DB->beneficeProduit();
			$data['beneficeTotal'] = $this->Mouvement_DB->beneficeTotal();
			$data['contents'] = 'templates/benefice';
			$this->load->view('templates/template', $data);
		}else{
			redirect('/');
		}
	}

	public function graphic(){
		$logged = $this->session->userdata('loggedAdmin');
		if($logged != NULL){
			$venteParProduit = $this->Mouvement_DB->recapTotalParProduit();
			foreach ($venteParProduit as $value) {
				// code...
				$data['label'][] = $value->productname;
				$data['data'][] = $value->totalvente;
			}
			$data['chart_data'] = json_encode($data);
			$data['contents'] = 'templates/graphic';
			$this->load->view('templates/template', $data);
		}else{
			redirect('/');
		}
	}

	public function stockParProduit(){
		$logged = $this->session->userdata('loggedAdmin');
		if($logged != NULL){
			$data['stock'] = $this->Mouvement_DB->getStock();
			$data['stockProduit'] = $this->Mouvement_DB->getStockProduit();
			$data['contents'] = 'templates/stock';
			$this->load->view('templates/template', $data);
		}else{
			redirect('/');
		}
	}
}
