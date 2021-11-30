<?php
    if (!defined('BASEPATH')) exit('No direct script access allowed');
    class Admin_DB extends CI_Model{
        // CONSTRUCTOR
        public function __construct(){
          parent::__construct();
        }

        public function findAll(){
          return $this->db->get('admins')->result();
        }

        public function update($admins, $id){
          $this->db->where('idadmin', $id);
          $this->db->update('users', $admins);
        }

        public function save($admins){
          $admins['password'] = sha1($admins['password']);
          $this->db->insert('admins', $admins);
        }

        public function delete($id){
          $this->db->where('idadmin', $id);
          $this->db->delete('admins');
        }

        public function login($username, $password){
          $this->db->where('username', $username)
                    ->where('password', sha1($password));
          return $this->db->get('admins')->row();
        }
    }
?>
