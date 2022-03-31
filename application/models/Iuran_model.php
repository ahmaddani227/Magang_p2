<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Iuran_model extends CI_Model{
    
    public function user()
    {
       return $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    }

    public function bulan()
    {
        return $this->db->get('bulan')->result_array();
    }

    public function tahun()
    { 
        $tahun_now = date('Y', time()); 
        $query = $this->db->get_where('tahun', ['tahun_db' => $tahun_now]);
        if( $query == false ){
            $this->db->insert('tahun', ['tahun_db' => $tahun_now]);
        }
        return $query->result_array();
    }

    public function metBay()
    {
        return $this->db->get('metode_pembayaran')->result_array();
    }

    public function tambahDataIuran()
    {
        if( $this->input->post('metBay') == 2 ){
            $this->_bayarOf();
        }else{
            $this->_bayarOn();
        }
    }

    private function _bayarOf()
    {
        $id      = $this->user()['id'];
        $bulanId = $this->input->post('bulan');
        $nominal = $this->input->post('nominal');
        $bulanId = $this->input->post('bulan'); 
        $tahunId = $this->input->post('tahun');
        
        $data    = [
            'user_id'   => $this->user()['id'] ,
            'nominal'   => $nominal,
            'bulan_id'  => $bulanId,
            'tahun_id'  => $tahunId,
            'metode_id' => $this->input->post('metBay'),
            'status'    => 'Pengajuan',
            'tgl_bayar' => date('Y-m-d', time())
        ]; 

        $bulanNow = $this->db->get_where('bulan', ['bulan' => date('F', time())])->row_array();
        $query   = $this->db->get_where('data_iuran', [
                    'user_id' => $id,
                    'bulan_id' => $bulanId,
                    'tahun_id' => $tahunId
        ])->row_array();

        if( $bulanId == $bulanNow['id'] ){
            if( $query == false ){
                $this->db->insert('data_iuran', $data);
                $this->session->set_flashdata('iuran', 'Pengajuan Iuran');
                redirect('iuran');
            }else{
                $this->session->set_flashdata('iuran', 'gagal');
                redirect('iuran/bayar');
            }
        }else{
            $this->session->set_flashdata('iuran', 'gagal');
            redirect('iuran/bayar');
        }
        
    }

    private function _bayarOn()
    {
        $nominal = $this->input->post('nominal');
        $bulanId = $this->input->post('bulan'); 
        $tahunId = $this->input->post('tahun');
        $id      = $this->user()['id'];

        $bulanNow = $this->db->get_where('bulan', ['bulan' => date('F', time())])->row_array();
        $query   = $this->db->get_where('data_iuran', [
            'user_id' => $id,
            'bulan_id' => $bulanId,
            'tahun_id' => $tahunId
        ])->row_array();
        
        if( $bulanId == $bulanNow['id'] ){
            if( $query == false ){
                $data    = [
                    'user_id'   => $id ,
                    'nominal'   => $nominal,
                    'bulan_id'  => $bulanId,
                    'tahun_id'  => $tahunId,
                    'metode_id' => $this->input->post('metBay'),
                    'status'    => 'Lunas',
                    'tgl_bayar' => date('Y-m-d', time())
                ]; 
                // insert data ke tabel data_iuran
                $this->db->insert('data_iuran', $data);
                
                /* cek pada tabel pendapatan_bulan( record dengan bulan & tahun yang diinputkan user ) */
                $data2 = [
                    'bulan_id' => $bulanId,
                    'tahun_id' => $tahunId
                ];
                $query = $this->db->get_where('pendapatan_bulan', $data2);
                // jika tidak ada insert
                if( $query->num_rows() < 1 ){
                    $this->db->insert('pendapatan_bulan', [
                        'bulan_id'      => $bulanId,
                        'tahun_id'      => $tahunId,
                        'pendapatan'    => $nominal
                    ]);
                }
                // jika ada update
                $this->db->set('pendapatan', $query->row_array()['pendapatan'] + $nominal);
                $this->db->where('id', $query->row_array()['id']);
                $this->db->update('pendapatan_bulan');
                
                // update field pendapatan pada tabel tahun
                $tahun = $this->db->get_where('tahun', ['id' => $tahunId ])->row_array();
                $this->db->set('pendapatan', $tahun['pendapatan'] + $nominal);
                $this->db->where('id', $tahunId);
                $this->db->update('tahun');
    
                $this->session->set_flashdata('iuran', 'Pembayaran Iuran');
                redirect('iuran');
            }else{
                $this->session->set_flashdata('iuran', 'gagal');
                redirect('iuran/bayar');
            }
        }else{
            $this->session->set_flashdata('iuran', 'gagal');
            redirect('iuran/bayar');
        }
    }

    public function tahunIndex()
    {
        return $this->db->get('tahun')->result_array();
    }

    public function dataIuranUser()
    {
        $id    = $this->user()['id'];
        $tahun = date('Y', time());
        $query = "SELECT `data_iuran`.*,
                         `bulan`.`bulan`,
                         `tahun`.`tahun_db`,
                         `metode_pembayaran`.`metode_db`
                  FROM `data_iuran` 
                  INNER JOIN `bulan` ON `bulan`.`id` = `data_iuran`.`bulan_id`
                  INNER JOIN `tahun` ON `tahun`.`id` = `data_iuran`.`tahun_id`
                  INNER JOIN `metode_pembayaran` ON `metode_pembayaran`.`id` = `data_iuran`.`metode_id`
                  WHERE `user_id` = $id AND `tahun_db` = $tahun ORDER BY `bulan`.`id` ASC
                ";
        return $this->db->query($query)->result_array();
    }

    // UNTUK EXPORT EXCEL
    public function dataIuranUser2()
    {
        $id    = $this->user()['id'];
        $tahun = date('Y', time());
        $query = "SELECT `data_iuran`.*,
                         `bulan`.`bulan`,
                         `tahun`.`tahun_db`,
                         `metode_pembayaran`.`metode_db`
                  FROM `data_iuran` 
                  INNER JOIN `bulan` ON `bulan`.`id` = `data_iuran`.`bulan_id`
                  INNER JOIN `tahun` ON `tahun`.`id` = `data_iuran`.`tahun_id`
                  INNER JOIN `metode_pembayaran` ON `metode_pembayaran`.`id` = `data_iuran`.`metode_id`
                  WHERE `user_id` = $id AND `tahun_db` = $tahun ORDER BY `tgl_bayar` ASC
                ";
        return $this->db->query($query)->result_array();
    }
}