<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model{

    public function jmlUser(){
        return $this->db->get('user')->num_rows();
    }

    public function jmlMenu(){
        return $this->db->get('user_menu')->num_rows();
    }

    public function jmlSubmenu(){
        return $this->db->get('user_sub_menu')->num_rows();
    }
}