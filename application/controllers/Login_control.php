<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_control extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->model('Admin_DB');
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
   public function config(){
     $this->load->library('form_validation');
     $config = array(
        array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required',
                'errors' => array(
                  'required' => 'Veillez remplir le champ {field}'
                )
        ),
        array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required',
                'errors' => array(
                  'required' => 'Veuillez remplir le champ {field}',
                ),
        )
      );
      $this->form_validation->set_rules($config);
      $error = array();
      if($this->form_validation->run() == FALSE){
        $error = array(
          'username_error' => form_error('username'),
          'password_error' => form_error('password')
        );
      }
      return $error;
   }

   public function login(){
     $errors = $this->config();
     if(count($errors) == 0){
       $log = $this->input->post(NULL, TRUE);
       $logged = $this->Admin_DB->login($log['username'], $log['password']);
       if($logged == ''){
         $data['login_error'] = 'Utilisateur non trouve';
         $data['contents'] = 'templates/login';
         $this->load->view('templates/template', $data);
       } else{
         $this->session->set_userdata('loggedAdmin', $logged);
         redirect('produits');
       }
     }else{
       $data['contents'] = 'templates/login';
       $data['label'] = 'login';
       $data['form_url'] = site_url('user_login');
       $data['form_errors'] = $errors;
       $this->load->view('templates/template', $data);
     }
   }

   public function register(){
     $errors = $this->config();
     if(count($errors) == 0){
       $add = $this->input->post(NULL, TRUE);
       $this->Admin_DB->save($add);
       redirect('/');
     }else{
       $data['contents'] = 'templates/login';
       $data['label'] = 'register';
       $data['form_url'] = site_url('user_register');
       $data['form_errors'] = $errors;
       $this->load->view('templates/template', $data);
     }
   }

   public function logout(){
     $this->session->unset_userdata('loggedAdmin');
     redirect('/');
   }
}
