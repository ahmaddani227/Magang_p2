<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_model extends CI_Model{

    public function user()
    {
        return $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    }

    public function allUser()
    {
        $query = "SELECT `user`.*, `user_role`.`role`
                  FROM `user` JOIN `user_role` 
                  ON `role_id` = `user_role`.`id`
                  ORDER BY `user`.`id` ASC ";
        return $this->db->query($query)->result_array();
    }

    public function tahunMaster()
    {
        return $this->db->get('tahun')->result_array();
    }

    public function dataIuran()
    {
        $tahun = $this->input->post('tahunMaster');
        $query = "SELECT `data_iuran`.*,
                         `user`.`name`,
                         `bulan`.`bulan`,
                         `tahun`.`tahun_db`,
                         `metode_pembayaran`.`metode_db`
                  FROM `data_iuran`
                  INNER JOIN `user` ON `user`.`id` = `data_iuran`.`user_id`
                  INNER JOIN `bulan` ON `bulan`.`id` = `data_iuran`.`bulan_id`
                  INNER JOIN `tahun` ON `tahun`.`id` = `data_iuran`.`tahun_id`
                  INNER JOIN `metode_pembayaran` ON `metode_pembayaran`.`id` = `data_iuran`.`metode_id`
                --   WHERE `tahun_id` = '$tahun'
                   ORDER BY `name` ASC
                 ";
        return $this->db->query($query)->result_array();
    }

}