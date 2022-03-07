<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model{

    public function user()
    {
        return $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    }
    
    public function jmlUser(){
        return $this->db->get('user')->num_rows();
    }

    public function jmlMenu(){
        return $this->db->get('user_menu')->num_rows();
    }

    public function jmlSubmenu(){
        return $this->db->get('user_sub_menu')->num_rows();
    }

    public function role()
    {
        return $this->db->get('user_role')->result_array();
    }

    public function tambahRole()
    {
        $data = [
            'role' => htmlspecialchars($this->input->post('role', true))
        ];
        $this->db->insert('user_role', $data);
    }

    public function roleId($role_id)
    {
        return $this->db->get_where('user_role', ['id' => $role_id])->row_array();
    }

    public function menu()
    {
        // $this->db->where('menu !=', 'Admin'); atau
        $this->db->where('id !=', 1);
        $this->db->order_by('menu ASC');
        return $this->db->get_where('user_menu')->result_array();
    }

    public function editRole()
    {
        $id = $this->input->post('idH');
        $role = $this->input->post('role');

        $this->db->set('role', $role);
        $this->db->where('id', $id);
        $this->db->update('user_role');
    }

    public function ubahAkses()
    {
        $role_id = $this->input->post('roleId');
        $menu_id = $this->input->post('menuId');

        $data = [
            'role_id'   => $role_id,
            'menu_id'   => $menu_id
        ];
        $result = $this->db->get_where('user_access_menu', $data);

        if( $result->num_rows() < 1 ){
            $this->db->insert('user_access_menu', $data);
        }else{
            $this->db->delete('user_access_menu', $data);
        }
    }
   
}