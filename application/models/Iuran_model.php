<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Iuran_model extends CI_Model{
    
    public function user()
    {
       return $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    }

    public function nominal()
    {
        $bulan = date('F', time());
        $query = "SELECT `nominal` FROM `bulan`
                  WHERE `bulan` = '$bulan'
                ";
        return $this->db->query($query)->result_array();
    }

    public function bulan()
    {
        return $this->db->get('bulan')->result_array();
    }

    public function tahun()
    { 
        $tahun_now = date('Y', time()); 
        $query = "SELECT * FROM `tahun`
                  WHERE `tahun_db` = $tahun_now
                 ";
        return $this->db->query($query)->result_array();
    }

    public function metBay()
    {
        return $this->db->get('metode_pembayaran')->result_array();
    }

    public function tambahDataIuran()
    {
        if( $this->input->post('metBay') == 1 ){
            $data  = [
                'user_id' => $this->user()['id'] ,
                'nominal'   => $this->input->post('nominal'),
                'bulan_id'  => $this->input->post('bulan'),
                'tahun_id'  => $this->input->post('tahun'),
                'metode_id' => $this->input->post('metBay'),
                'status'    => 'Lunas',
                'tgl_bayar' => date('Y-m-d', time())
            ];
            $this->db->insert('data_iuran', $data);
            redirect('iuran');
        }else{
            echo 'tunggu';
        }
    }

    public function tahunIndex()
    {
        return $this->db->get('tahun')->result_array();
    }

    public function dataIuranUser()
    {
        $id = $this->user()['id'];
        $tahun = $this->input->post('tahunIndex');
        $query = "SELECT `data_iuran`.*,
                         `bulan`.`bulan`,
                         `tahun`.`tahun_db`,
                         `metode_pembayaran`.`metode_db`
                  FROM `data_iuran` 
                  INNER JOIN `bulan` ON `bulan`.`id` = `data_iuran`.`bulan_id`
                  INNER JOIN `tahun` ON `tahun`.`id` = `data_iuran`.`tahun_id`
                  INNER JOIN `metode_pembayaran` ON `metode_pembayaran`.`id` = `data_iuran`.`metode_id`
                  WHERE `user_id` = $id ORDER BY `bulan` DESC
                ";
                // tambahkan AND WHERE diatas untuk tahun
        return $this->db->query($query)->result_array();
    }
}