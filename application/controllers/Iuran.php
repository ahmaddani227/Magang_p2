<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Iuran extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('Iuran_model', 'iuran');
        
    }
    
    public function index()
    {
        $data['title'] = 'Pembayaran Iuran';
        $data['user'] = $this->iuran->user();
        $data['tahunIndex'] = $this->iuran->tahunIndex();
        $data['data_iuran'] = $this->iuran->dataIuranUser();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('iuran/index', $data);
        $this->load->view('templates/footer');
    }

    public function bayar()
    {
        $data['title'] = 'Pembayaran Iuran';
        $data['user'] = $this->iuran->user();
        $data['nominal'] = $this->iuran->nominal();
        $data['bulan'] = $this->iuran->bulan();
        $data['tahun'] = $this->iuran->tahun();
        $data['metBay'] = $this->iuran->metBay();
        $data['data_iuran'] = $this->iuran->dataIuranUser();

        $this->form_validation->set_rules('bulan', 'Bulan', 'required');
        $this->form_validation->set_rules('nominal', 'Nominal', 'required');
        $this->form_validation->set_rules('tahun', 'Tahun', 'required');
        $this->form_validation->set_rules('metBay', 'Matode Pembayran', 'required');
        if ($this->form_validation->run() == FALSE){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('iuran/bayar', $data);
            $this->load->view('templates/footer');
        }else{
            $this->iuran->tambahDataIuran();
        }
    }
}