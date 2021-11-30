<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->model('Product_DB');
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
                'field' => 'productname',
                'label' => 'Nom du produit',
                'rules' => 'required',
                'errors' => array(
                  'required' => 'Veuillez remplir le champ {field}'
                )
        ),
        array(
                'field' => 'evaporation',
                'label' => "Pourcentage d'evaporation",
                'rules' => 'required',
                'errors' => array(
                  'required' => 'Veuillez remplir le champ {field}',
                ),
        ),
        array(
                'field' => 'returnprice',
                'label' => "Prix de revient",
                'rules' => 'required',
                'errors' => array(
                  'required' => 'Veuillez remplir le champ {field}',
                ),
        ),
        array(
                'field' => 'sellprice',
                'label' => "Prix de vente",
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
          'name_error' => form_error('productname'),
          'evaporation_error' => form_error('evaporation'),
          'rPrice_error' => form_error('returnprice'),
          'vPrive_error' => form_error('sellprice')
        );
      }
      return $error;
   }

   public function addProduct(){
     $errors = $this->config();
     if(count($errors) == 0){
       $add = $this->input->post(NULL, true);
       if(isset($add['idproduct'])){
         $this->Product_DB->update($add);
       }else{
         $this->Product_DB->save($add);
       }
       redirect('/produits');
     }else{
       $data['contents'] = 'templates/ajoutProduit';
       $data['form_errors'] = $errors;
       $this->load->view('templates/template', $data);
     }
   }
}
