<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('Menu_model', 'menu');
    }
    public function index()
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        
        $this->form_validation->set_rules('menu', 'Menu', 'required');
        if ($this->form_validation->run() == FALSE){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        }else{
            $this->menu->addMenu();
            // FLASHDATA
            redirect('menu');
        }
    }
    
    public function subMenu()
    {
        $data['title'] = 'Submenu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        
        //pagination
        $this->load->library('pagination');
        
        // config
        $config['base_url'] = 'http://localhost/Magang_p2/menu/submenu';
        $config['total_rows'] = $this->menu->rows();
        // $config['total_rows'] = $this->db->count_all('user_sub_menu');
        $config['per_page'] = 6;
        // $config['num_links'] = 2; jumlah digit angka kanan-kiri

        // initialize
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $data['submenu'] = $this->menu->Submenu($config['per_page'], 0);
        
        $this->form_validation->set_rules('menu', 'Menu', 'required');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');
        if ($this->form_validation->run() == FALSE){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        }else{
            $this->menu->addSubmenu();
            // FLASHSDATA
            redirect('menu/subMenu');
        }
    }

    public function hapus($id)
    {
        $this->menu->hapusSubMenu($id);
        redirect('menu/subMenu');
    }

    public function editSubmenu($id)
    {
        $data['title'] = 'Submenu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['subMenuId'] = $this->menu->subMenuId($id);
        $data['menu'] = $this->db->get('user_menu')->result_array();        

        $this->form_validation->set_rules('menu', 'Menu', 'required');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');
        if ($this->form_validation->run() == FALSE){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/edit-submenu', $data);
            $this->load->view('templates/footer');
        }else{
            
        }
    }
}