<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('Admin_model', 'admin');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->admin->user();
        $data['jmlUser'] = $this->admin->jmlUser();
        $data['jmlMenu'] = $this->admin->jmlMenu();
        $data['jmlSubmenu'] = $this->admin->jmlSubmenu();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function role()
    {
        $data['title']  = 'Role';
        $data['user']   = $this->admin->user();
        $data['role']   = $this->admin->role();

        $this->form_validation->set_rules('role', 'Role', 'required');
        if ($this->form_validation->run() == FALSE){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        }else{
            $this->admin->tambahRole();
            $this->session->set_flashdata('admin', 'ditambahkan');
            redirect('admin/role');
        }
    }

    public function roleAkses($role_id)
    {
        $data['title']  = 'Role';
        $data['user']   = $this->admin->user();
        $data['roleId'] = $this->admin->roleId($role_id);
        $data['menu']   = $this->admin->menu();

        $this->form_validation->set_rules('role', 'Role', 'required');
        if ($this->form_validation->run() == FALSE){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role-akses', $data);
            $this->load->view('templates/footer');
        }else{
            $this->admin->editRole();
            $this->session->set_flashdata('admin', 'diedit');
            redirect('admin/role');
        }
    }

    public function ubahAkses()
    {
        $this->admin->ubahAkses();

        $this->session->set_flashdata('admin', 'diubah');
    }

    public function hapusRole($id)
    {
        $this->db->delete('user_role', ['id' => $id]);
        $this->session->set_flashdata('admin', 'dihapus');
        redirect('admin/role');
    }
    
}