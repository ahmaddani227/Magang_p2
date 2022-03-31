<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model{

    public function user()
    {
        return $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    }

    public function addMenu()
    {
        $this->db->insert('user_menu', ['menu' =>  htmlspecialchars($this->input->post('menu', true))]);
    }

    public function menuId($id)
    {
        return $this->db->get_where('user_menu', ['id' => $id])->row_array();
    }

    public function editMenu()
    {
        $idH = $this->input->post('idH');
        $menu = $this->input->post('menu');

        $this->db->set('menu', htmlspecialchars($menu, true) );
        $this->db->where('id', $idH);
        $this->db->update('user_menu');
    }

    public function hapusMenu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_menu');
    }

    // datatable submenu
    var $table = 'user_sub_menu'; //nama tabel di database
    var $column_order = ['id', 'menu', 'title', 'url', 'icon', 'is_active']; //order di table
    var $order = ['id', 'menu', 'title', 'url', 'icon', 'is_active']; //show &search

    private function _get_data_query()
    {
        $this->db->select('user_sub_menu.*, user_menu.menu');
        $this->db->from($this->table);
        $this->db->join('user_menu',  'user_menu.id  = menu_id');
        
        if( isset($_POST['search']['value']) ){
            $this->db->like('menu', $_POST['search']['value']);
            $this->db->or_like('title', $_POST['search']['value']);
            $this->db->or_like('url',   $_POST['search']['value']);
            $this->db->or_like('icon',  $_POST['search']['value']);
            $this->db->or_like('is_active', $_POST['search']['value']);
        }

        if( isset($_POST['order']) ){
            $this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }else{
            $this->db->order_by('menu', 'ASC');
        }
    }

    public function getDataTable()
    {
        $this->_get_data_query();
        if( $_POST['length'] != -1 ){
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function count_filtered_data()
    {
        $this->_get_data_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_data()
    {
        $this->db->from($this->table);
        $this->db->join('user_menu',  'user_menu.id  = menu_id');
        $this->db->count_all_results();
    }
    // akhir datatable submenu

    public function addSubmenu()
    {
        $data = [
            'menu_id'   => $this->input->post('menu', true),
            'title'     => htmlspecialchars($this->input->post('title',true )),
            'url'       => htmlspecialchars($this->input->post('url',true)),
            'icon'      => htmlspecialchars($this->input->post('icon',true)),
            'is_active' => $this->input->post('active')
        ];
        $this->db->insert('user_sub_menu', $data);

    }

    public function hapusSubMenu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_sub_menu');
    }

    public function subMenuId($id)
    {
        return $this->db->get_where('user_sub_menu', ['id' => $id])->row_array();
    }

    public function editSubmenu()
    {
        $idH    = $this->input->post('id');
        
        $data = [
            'menu_id'   => htmlspecialchars($this->input->post('menu',true)),
            'title'     => htmlspecialchars($this->input->post('title', true)),
            'url'       => htmlspecialchars($this->input->post('url', true)),
            'icon'      => htmlspecialchars($this->input->post('icon', true)),
            'is_active' => htmlspecialchars($this->input->post('active'))
        ];
        
        $this->db->where('id', $idH);
        $this->db->update('user_sub_menu', $data);
    }
}