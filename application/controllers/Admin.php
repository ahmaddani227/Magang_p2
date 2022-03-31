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
        $data['title']      = 'Dashboard';
        $data['user']       = $this->admin->user();
        $data['jmlUser']    = $this->admin->jmlUser();
        $data['jmlMenu']    = $this->admin->jmlMenu();
        $data['jmlIuran']   = $this->admin->jmlIuran();
        $data['numP']       = $this->admin->numPengajuan();
        $data['tahun']      = $this->db->get('tahun')->result_array();
        $data['chartTahun'] = $this->admin->chartT();
        $data['chartBulan'] = $this->admin->chartB();
        $data['chartThnn']  = $this->admin->chartThnn();

        $this->load->view('templates/header',   $data);
        $this->load->view('templates/sidebar',  $data);
        $this->load->view('templates/topbar',   $data);
        $this->load->view('admin/index',        $data);
        $this->load->view('templates/footer',   $data);
    }

    public function select2()
    {
        isset($_POST["tahun"]) ? $tahun1 = $_POST["tahun"] : $tahun1 = "";
        $pendapatan = "";
        $bulan = "";
        $bar_graph = "";

        $queryThnn = $this->admin->chartThnn();
        
        $getData = $queryThnn->result_array();
        $rowcount = $queryThnn->num_rows();

        if( $rowcount > 0 ){
            foreach( $getData as $gD ){
                $pendapatan .= '"'. $gD["pendapatan"] .'",';
                $bulan      .= '"'. $gD["bulan"] .'",';
            }
        }

        $p = substr($pendapatan, 0, -1);
        $b = substr($bulan, 0, -1);
        $bar_graph = '
        <canvas id="graph" data-settings=\'{
        "type": "bar",
        "data": {
            "labels": ['. $b .'],
            "datasets": [{
                "label": "pendapaatan '. $tahun1 .'",
                "backgroundColor": "rgba(0, 153, 255, 1)",
                "data": ['. $p .']
            }]
        },
        "options":
        {
            "legend":
            {
                "display": true
            }
        }
        }\'></canvas>';

        echo $bar_graph;
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