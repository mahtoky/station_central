<?php
    if (!defined('BASEPATH')) exit('No direct script access allowed');
    class Product_DB extends CI_Model{
        // CONSTRUCTOR
        public function __construct(){
          parent::__construct();
        }

        public function findAll(){
          return $this->db->get('product')->result();
        }

        public function findAllToExport(){
          return $this->db->get('product')->result_array();
        }

        public function update($admins){
          $this->db->update('product', $admins);
        }
        //
        public function save($admins){
          $this->db->insert('product', $admins);
        }

        public function getById($id){
          return $this->db->where('idproduct', $id)
                          ->get('product')->row();
        }
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
