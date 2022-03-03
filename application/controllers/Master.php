<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('Master_model', 'master');
    }

    public function index()
    {
        $data['title'] = 'Data User';
        $data['user'] = $this->master->user();
        $data['users'] = $this->master->allUser();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('master/index', $data);
        $this->load->view('templates/footer');
    }

    public function data_iuran()
    {
        $data['title'] = 'Data Iuran';
        $data['user'] = $this->master->user();
        $data['tahunMaster'] = $this->master->tahunMaster();
        $data['dataIuran'] = $this->master->dataIuran(); 

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('master/data_iuran', $data);
        $this->load->view('templates/footer');
    }

    public function excel()
    {
        $data['dataIuran'] = $this->master->dataIuran();

        require ( APPPATH.'PHPExcel-1.8/Classes/PHPExcel.php' );
        require ( APPPATH.'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php' );

        $objeck = new PHPExcel();
        $objeck->getProperties()->setCreator("Turbo Coding");
        $objeck->getProperties()->setLastModifiedBy("TurboCoding");
        $objeck->getProperties()->setTitle("Data Iuran");

        $objeck->setActiveSheetIndex(0);

        $objeck->getActiveSheet()->setCellValue('A1', 'No');
        $objeck->getActiveSheet()->setCellValue('B1', 'Nama User');
        $objeck->getActiveSheet()->setCellValue('C1', 'Nominal');
        $objeck->getActiveSheet()->setCellValue('D1', 'Bulan');
        $objeck->getActiveSheet()->setCellValue('E1', 'Tahun');
        $objeck->getActiveSheet()->setCellValue('F1', 'Metode');
        $objeck->getActiveSheet()->setCellValue('G1', 'Status');
        $objeck->getActiveSheet()->setCellValue('H1', 'Tgl Bayar');
        
        $baris = 2;
        $no = 1;

        foreach( $data['dataIuran'] as $d ){
            $objeck->getActiveSheet()->setCellValue('A'.$baris, $no++);
            $objeck->getActiveSheet()->setCellValue('B'.$baris, $d['name']);
            $objeck->getActiveSheet()->setCellValue('C'.$baris, $d['nominal']);
            $objeck->getActiveSheet()->setCellValue('D'.$baris, $d['bulan']);
            $objeck->getActiveSheet()->setCellValue('E'.$baris, $d['tahun_db']);
            $objeck->getActiveSheet()->setCellValue('F'.$baris, $d['metode_db']);
            $objeck->getActiveSheet()->setCellValue('G'.$baris, $d['status']);
            $objeck->getActiveSheet()->setCellValue('H'.$baris, $d['tgl_bayar']);

            $baris++;
        }

        $filename = "Data Iuran PerTahun".'xlsx';
        $objeck->getActiveSheet()->setTitle('Data Iuran');

        header('Contect-Type : application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Contect-Disposition : attachment; filename = "'.$filename.'"');
        header('Cache-Control : max-age = 0');

        $writter = PHPExcel_IOFactory::createWriter($objeck, 'Excel2007');
        $writter->save('php://output');

        exit;
    }
}