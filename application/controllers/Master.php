<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
    
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('master/index', $data);
      $this->load->view('templates/footer');
    }

    public function getData()
    {
        $result = $this->master->getDataTable();
        $data = [];
        $no = $_POST['start'];
        foreach( $result as $r ){
            $row = [];
            $row[] = ++$no;
            $row[] = $r['name'];
            $row[] = $r['email'];
            $row[] = $r['role'];
            $row[] = $r['is_active'];
            $row[] = date('d F Y', $r['date_created']);
            $data[] = $row;
        }
        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->master->count_all_data(),
            "recordsFiltered" => $this->master->count_filtered_data(),
            "data" => $data,
        ];

        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function data_iuran()
    {
        $data['title'] = 'Data Iuran';
        $data['user']  = $this->master->user();
        $data['tahunMaster'] = $this->master->tahunMaster();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('master/data_iuran', $data);
        $this->load->view('templates/footer');
    }

    public function getData2()
    {
        $result = $this->master->getDataTable2();
        $data = [];
        $no = $_POST['start'];
        foreach( $result as $r ){
            $row = [];
            $row[] = ++$no;
            $row[] = $r['name'];
            $row[] = $r['nominal'];
            $row[] = $r['bulan'];
            $row[] = $r['tahun_db'];
            $row[] = $r['metode_db'];
            $row[] = $r['status'];
            $row[] = $r['tgl_bayar'];
            $data[] = $row;
        }
        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->master->count_all_data2(),
            "recordsFiltered" => $this->master->count_filtered_data2(),
            "data" => $data,
        ];
        
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function exportExcel(){
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
      $sheet->setCellValue('A1', "Data Iuran"); 
      $sheet->mergeCells('A1:E1');
      $sheet->getStyle('A1')->getFont()->setBold(true);
      
      $sheet->setCellValue('A3', "No"); 
      $sheet->setCellValue('B3', "Nama"); 
      $sheet->setCellValue('C3', "Nominal");
      $sheet->setCellValue('D3', "Bulan"); 
      $sheet->setCellValue('E3', "Tahun");
      $sheet->setCellValue('F3', "Metode");  
      $sheet->setCellValue('G3', "Status");  
      $sheet->setCellValue('H3', "Tanggal Bayar"); 
      
      $sheet->getStyle('A3')->applyFromArray($style_col);
      $sheet->getStyle('B3')->applyFromArray($style_col);
      $sheet->getStyle('C3')->applyFromArray($style_col);
      $sheet->getStyle('D3')->applyFromArray($style_col);
      $sheet->getStyle('E3')->applyFromArray($style_col);
      $sheet->getStyle('F3')->applyFromArray($style_col);
      $sheet->getStyle('G3')->applyFromArray($style_col);
      $sheet->getStyle('H3')->applyFromArray($style_col);
      
      $data = $this->master->dataIuran2();
      
      $no = 1; 
      $numrow = 4; 
      foreach($data as $d){ 
        $sheet->setCellValue('A'.$numrow, $no);
        $sheet->setCellValue('B'.$numrow, $d['name']);
        $sheet->setCellValue('C'.$numrow, "Rp" . $d['nominal']);
        $sheet->setCellValue('D'.$numrow, $d['bulan']);
        $sheet->setCellValue('E'.$numrow, $d['tahun_db']);
        $sheet->setCellValue('F'.$numrow, $d['metode_db']);
        $sheet->setCellValue('G'.$numrow, $d['status']);
        $sheet->setCellValue('H'.$numrow, $d['tgl_bayar']);
        
        $sheet->getStyle('A'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('B'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('C'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('D'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('E'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('F'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('G'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('H'.$numrow)->applyFromArray($style_row);
                  
        $no++; 
        $numrow++;
      }
                
      // lebar kolom
      $sheet->getColumnDimension('A')->setWidth(5); 
      $sheet->getColumnDimension('B')->setWidth(15); 
      $sheet->getColumnDimension('C')->setWidth(17); 
      $sheet->getColumnDimension('D')->setWidth(20); 
      $sheet->getColumnDimension('E')->setWidth(12); 
      $sheet->getColumnDimension('F')->setWidth(13); 
      $sheet->getColumnDimension('G')->setWidth(13); 
      $sheet->getColumnDimension('H')->setWidth(15); 
      
      $sheet->getDefaultRowDimension()->setRowHeight(-1);
      $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
      $sheet->setTitle("Data Iuran");
                
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment; filename="Admin Data Iuran .xlsx"'); 
      
      header('Cache-Control: max-age=0');
      $writer = new Xlsx($spreadsheet);
      $writer->save('php://output');
    }
              
    public function pengajuan()
    {
        $data['title'] = 'Pengajuan Iuran';
        $data['user']  = $this->master->user();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('master/pengajuan', $data);
        $this->load->view('templates/footer');
    }

    public function getData3()
    {
      $result = $this->master->getDataTable3();
      $data = [];
      $no = $_POST['start'];
      foreach( $result as $r ){
          $row = [];
          $row[] = ++$no;
          $row[] = $r['name'];
          $row[] = "Rp. " . $r['nominal'];
          $row[] = $r['bulan'];
          $row[] = $r['tahun_db'];
          $row[] = $r['metode_db'];
          $row[] = $r['status'];
          $row[] = $r['tgl_bayar'];
          $row[] = '<a href="'. base_url('master/setuju/') . $r['id'] .'" class="badge badge-info">Setuju</a>';
          $data[] = $row;
      }
      $output = [
        "draw" => $_POST['draw'],
        "recordsTotal" => $this->master->count_all_data3(),
        "recordsFiltered" => $this->master->count_filtered_data3(),
        "data" => $data,
      ];

      $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function setuju($id)
    {
      $this->master->setuju($id);
      redirect('master/data_iuran');
    }
}