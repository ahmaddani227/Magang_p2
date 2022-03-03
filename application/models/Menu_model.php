<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model{

    public function addMenu()
    {
        $this->db->insert('user_menu', ['menu' =>  $this->input->post('menu')]);
        // FLASHDATA
        redirect('menu');
    }

    public function Submenu($limit, $start)
    {
        $querySubmenu = "SELECT `user_sub_menu`.* , `user_menu`.`menu`
                         FROM `user_sub_menu` JOIN `user_menu` 
                         ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                         LIMIT $start, $limit";
        return $this->db->query($querySubmenu)->result_array();
    }

    public function rows()
    {
        return $this->db->get('user_sub_menu')->num_rows();
    }

    public function addSubmenu()
    {
        $data = [
            'menu_id'   => $this->input->post('menu'),
            'title'     => $this->input->post('title'),
            'url'       => $this->input->post('url'),
            'icon'      => $this->input->post('icon'),
            'is_active' => $this->input->post('active')
        ];
        $this->db->insert('user_sub_menu', $data);

        // FLASHSDATA
        redirect('menu/subMenu');
    }

    public function hapusSubMenu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_sub_menu');
    }

}