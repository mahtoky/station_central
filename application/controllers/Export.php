<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Export extends CI_Controller {

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
   public function exportProductsToCsv(){
     $input = $this->Product_DB->findAllToExport();
     $keys = array('idproduct', 'produit', 'prix de vente', 'prix de revient', 'evaporation');
     $filename = 'station_Produit_'.date('Y-m-d').'.csv';
     header("Content-Description: File Transfer");
     header("Content-Disposition: attachement; filename=$filename");
     header("Content-Type: application/csv; ");
     $file = fopen('php://output', 'w');
     fputcsv($file, $keys);
     foreach ($input as $value) {
       // code...
       fputcsv($file, $value);
     }
     fclose($file);
     exit;
   }

   public function importMovementsCSV(){
      $config['upload_path'] = './uploads/';
      $config['allowed_types'] = 'csv';
      $config['max_size'] = '1000';
      $config['overwrite'] = true;
      $this->load->library('upload', $config);


      // If upload failed, display error
      if (!$this->upload->do_upload('csvfile')) {
          $data['error'] = $this->upload->display_errors();
      }else {
        $file_data = $this->upload->data();
        $file_path =  './uploads/'.$file_data['file_name'];
        $name = $file_data['file_name'];
        $array = explode("_", $name);
        $id = $array[1];
        $date = explode('.', $array[2])[0];
        // var_dump($date);
        // echo $this->Mouvement_DB->isImported($id, $date);
        if(!$this->Mouvement_DB->isImported($id, $date)){
          $fp = fopen($file_path,'r');
          $i = 0;
          while(!feof($fp)){
            $data_array = fgetcsv($fp, 1024);
            if($i > 0){
              if($data_array != false){
                $insert[] = array(
                  'idstation'=>$data_array[0],
                  'idproduct'=>$data_array[1],
                  'entry'=>$data_array[2],
                  'sell'=>$data_array[3],
                  'valuesell'=>$data_array[4],
                  'datemovement'=>$data_array[5]
                );
              }
            }
            $i++;
          }
          fclose($fp);
          $this->Mouvement_DB->insertAll($insert);
          redirect('/produits');
        }
      }
    }
}
