<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

    public function export(){
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        $style_col = [
            'font'      => ['bold' => true],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, 
                'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER 
            ],
            'borders' => [
                'top'    => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], 
                'right'  => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], 
                'left'   => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] 
            ]
        ];

        $style_row = [
          'alignment' => [
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER 
          ],
          'borders' => [
            'top'    => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], 
            'right'  => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  
            'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], 
            'left'   => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] 
          ]
        ];

        // judul di excel
        $sheet->setCellValue('A1', "Data Iuran Member"); 
        $sheet->mergeCells('A1:E1');
        $sheet->getStyle('A1')->getFont()->setBold(true);
        
        $sheet->setCellValue('A3', "No"); 
        $sheet->setCellValue('B3', "Tahun"); 
        $sheet->setCellValue('C3', "Bulan"); 
        $sheet->setCellValue('D3', "Nominal");
        $sheet->setCellValue('E3', "Metode");  
        $sheet->setCellValue('F3', "Status");  
        $sheet->setCellValue('G3', "Tanggal Bayar"); 

        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);
        $sheet->getStyle('F3')->applyFromArray($style_col);
        $sheet->getStyle('G3')->applyFromArray($style_col);
        
        $data = $this->iuran->dataIuranUser2();

        $no = 1; 
        $numrow = 4; 
        foreach($data as $d){ 
          $sheet->setCellValue('A'.$numrow, $no);
          $sheet->setCellValue('B'.$numrow, $d['tahun_db']);
          $sheet->setCellValue('C'.$numrow, $d['bulan']);
          $sheet->setCellValue('D'.$numrow, "Rp" . $d['nominal']);
          $sheet->setCellValue('E'.$numrow, $d['metode_db']);
          $sheet->setCellValue('F'.$numrow, $d['status']);
          $sheet->setCellValue('G'.$numrow, $d['tgl_bayar']);
                    
          $sheet->getStyle('A'.$numrow)->applyFromArray($style_row);
          $sheet->getStyle('B'.$numrow)->applyFromArray($style_row);
          $sheet->getStyle('C'.$numrow)->applyFromArray($style_row);
          $sheet->getStyle('D'.$numrow)->applyFromArray($style_row);
          $sheet->getStyle('E'.$numrow)->applyFromArray($style_row);
          $sheet->getStyle('F'.$numrow)->applyFromArray($style_row);
          $sheet->getStyle('G'.$numrow)->applyFromArray($style_row);
          
          $no++; 
          $numrow++;
        }

        // lebar kolom
        $sheet->getColumnDimension('A')->setWidth(5); 
        $sheet->getColumnDimension('B')->setWidth(7); 
        $sheet->getColumnDimension('C')->setWidth(20); 
        $sheet->getColumnDimension('D')->setWidth(17); 
        $sheet->getColumnDimension('E')->setWidth(13); 
        $sheet->getColumnDimension('F')->setWidth(13); 
        $sheet->getColumnDimension('G')->setWidth(15); 
               
        $sheet->getDefaultRowDimension()->setRowHeight(-1);
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $sheet->setTitle("Data Iuran");

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Data Iuran.xlsx"'); 

        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
      }
}