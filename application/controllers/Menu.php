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
        $data['title']  = 'Menu Management';
        $data['user']   = $this->menu->user();
        $data['menu']   = $this->db->get('user_menu')->result_array();
        
        $this->form_validation->set_rules('menu', 'Menu', 'required');
        if ($this->form_validation->run() == FALSE){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        }else{
            $this->menu->addMenu();
            $this->session->set_flashdata('menu', 'ditambahkan');
            redirect('menu');
        }
    }

    public function editMenu($id)
    {
        $data['title']  = 'Menu Management';
        $data['user']   = $this->menu->user();
        $data['menuId']   = $this->menu->menuId($id);

        $this->form_validation->set_rules('menu', 'Menu', 'required');
        if ($this->form_validation->run() == FALSE){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/edit-menu', $data);
            $this->load->view('templates/footer');
        }else{
            $this->menu->editMenu();
            $this->session->set_flashdata('menu', 'diedit');
            redirect('menu');
        }
    }

    public function hapusMenu($id)
    {
        $this->menu->hapusMenu($id);
        $this->session->set_flashdata('menu', 'dihapus');
        redirect('menu');
    }

    public function addSubmenu()
    {
        $data['title']  = 'Submenu Management';
        $data['user']   = $this->menu->user();
        $data['menu']   = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');
        if ($this->form_validation->run() == FALSE){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/tambah-submenu', $data);
            $this->load->view('templates/footer');
        }else{
            $this->menu->addSubmenu();
            $this->session->set_flashdata('menu', 'ditambahkan');
            redirect('menu/subMenu');
        }
    }
    // datatable submenu
    public function subMenu()
    {
        $data['title']  = 'Submenu Management';
        $data['user']   = $this->menu->user();
        $data['num'] = $this->menu->count_filtered_data();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/submenu', $data);
        $this->load->view('templates/footer');
    }

    public function getData()
    {
        $result = $this->menu->getDataTable();
        $data = [];
        $no = $_POST['start'];
        foreach( $result as $r ){
            $row = [];
            $row[] = ++$no;
            $row[] = $r['menu'];
            $row[] = $r['title'];
            $row[] = $r['url'];
            $row[] = $r['icon'];
            $row[] = $r['is_active'];
            $row[] = '<a href="'. base_url('menu/editSubmenu/').$r['id'] . '" class="badge badge-success">Edit</a> <a href="'. base_url('menu/hapus/').$r['id'] . '" class="badge badge-danger" onclick="'. "return confirm('yakin')".'">Hapus</a>';
            $data[] = $row;
        }
        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->menu->count_all_data(),
            "recordsFiltered" => $this->menu->count_filtered_data(),
            "data" => $data,
        ];

        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function hapus($id)
    {
        $this->menu->hapusSubMenu($id);
        $this->session->set_flashdata('menu', 'dihapus');
        redirect('menu/subMenu');
    }

    public function editSubmenu($id)
    {
        $data['title']      = 'Submenu Management';
        $data['user']       = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['subMenuId']  = $this->menu->subMenuId($id);
        $data['menu']       = $this->db->get('user_menu')->result_array();        

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
            $this->menu->editSubmenu();
            $this->session->set_flashdata('menu', 'diedit');
            redirect('menu/subMenu');
        }
    }
}