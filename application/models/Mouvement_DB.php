<?php
    if (!defined('BASEPATH')) exit('No direct script access allowed');
    class Mouvement_DB extends CI_Model{
        // CONSTRUCTOR
        public function __construct(){
          parent::__construct();
        }

        // public function findAll(){
        //   return $this->db->get('product')->result();
        // }
        //
        // public function update($admins){
        //   $this->db->update('product', $admins);
        // }
        //
        public function save($admins){
          $this->db->insert('movement', $admins);
        }

        public function getStock($id=""){
          if($id != ""){
            $this->db->where('idproduct', $id);
          }
          return $this->db->get('stock')->result();
        }

        public function getStockProduit(){
          return $this->db->get('stockproduit')->result();
        }

        public function evolutionVente(){
          return $this->db->get('evolutionvente')->result();
        }

        public function getDataToExport(){
          return $this->db->select('idstation, idproduct, entry, sell, datemovement')
                         ->from('movement')
                         ->get()->result_array();
        }

        public function insertAll($insert){
          $this->db->insert_batch('movement', $insert);
        }

        public function isImported($idstation, $date){
          $result = $this->db->where('idstation', $idstation)
                              ->where('datemovement', $date)
                              ->get('movement');
          if($result->num_rows() > 0){
            return true;
          }else {
            return false;
          }
        }

        public function StatParStation(){
          return $this->db->get('totalvente')->result();
        }

        public function statParDate($station){
          return $this->db->where('idstation', $station)
                          ->get('totalventeparjour')->result();
        }

        public function statParProduit($date, $station){
          return $this->db->where('idstation', $station)
                          ->where('datemovement', $date)
                          ->get('totalventeparproduit')->result();
        }

        public function recapTotalParProduit(){
          return $this->db->get('recaptotalparproduit')->result();
        }

        public function beneficeProduit(){
          return $this->db->get('beneficeparproduit')->result();
        }

        public function beneficeTotal(){
          return $this->db->get('beneficetotal')->row();
        }

        // public function getById($id){
        //   return $this->db->where('idproduct', $id)
        //                   ->get('product')->row();
        // }
        //
        // public function delete($id){
        //   $this->db->where('idadmin', $id);
        //   $this->db->delete('admins');
        // }
        //
        // public function login($username, $password){
        //   $this->db->where('username', $username)
        //             ->where('password', sha1($password));
        //   return $this->db->get('users')->row();
        // }
    }
?>
