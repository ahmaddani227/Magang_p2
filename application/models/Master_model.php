<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_model extends CI_Model{

    public function user()
    {
        return $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    }

    // datatable data user
    var $table = 'user'; //nama tabel di database
    var $column_order = ['id', 'name', 'email', 'role', 'is_active', 'date_created']; //order di table
    var $order = ['id', 'name', 'email', 'role', 'is_active', 'date_created']; //show &search

    private function _get_data_query()
    {
        $this->db->select('user.*, user_role.role');
        $this->db->from($this->table);
        $this->db->join('user_role',  'user_role.id  = role_id');

        if( isset($_POST['search']['value']) ){
            $this->db->like('name', $_POST['search']['value']);
            $this->db->or_like('email', $_POST['search']['value']);
            $this->db->or_like('role', $_POST['search']['value']);
            $this->db->or_like('is_active', $_POST['search']['value']);
        }

        if( isset($_POST['order']) ){
            $this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }else{
            $this->db->order_by('role', 'ASC');
        }
    }

    public function getDataTable()
    {
        $this->_get_data_query();
        if( $_POST['length'] != -1 ){
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function count_filtered_data()
    {
        $this->_get_data_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_data()
    {
        $this->db->from($this->table);
        $this->db->join('user_role',  'user_role.id  = role_id');
        $this->db->count_all_results();
    }

    public function tahunMaster()
    {
        // $this->db->select('tahun_db');
        return $this->db->get('tahun')->result_array();
    }

    // UNTUK EXPORT EXCEL ADMIN
    public function dataIuran2()
    {
        $tahun = date('Y', time());
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
                  WHERE `tahun_db` = $tahun
                   ORDER BY `tgl_bayar` ASC
                 ";
        return $this->db->query($query)->result_array();
    }

    public function rows()
    {
        return $this->db->get('data_iuran')->num_rows();
    }

    // datatable data iuran(lunas)
    var $table2 = 'data_iuran';
    var $column_order2 = ['id', 'name', 'data_iuran.nominal', 'bulan', 'tahun_db', 'metode_db', 'status', 'tgl_bayar']; //order di table
    var $order2 = ['id', 'name', 'data_iuran.nominal', 'bulan', 'tahun_db', 'metode_db', 'status', 'tgl_bayar']; //show &search

    private function _get_data_query2()
    {
        $tahun = date('Y', time());
        $where = [
            'tahun_db'  => $tahun,
            'status'    => 'Lunas'
        ];
        $this->db->select('data_iuran.*, user.name, bulan.bulan, tahun.tahun_db, metode_pembayaran.metode_db');
        $this->db->from($this->table2);
        $this->db->join('user',  'user.id  = user_id');
        $this->db->join('bulan', 'bulan.id = bulan_id');
        $this->db->join('tahun', 'tahun.id = tahun_id');
        $this->db->join('metode_pembayaran', 'metode_pembayaran.id = metode_id');
        $this->db->where($where);

        if( isset($_POST['search']['value']) ){
            $this->db->group_start();
            $this->db->like('name', $_POST['search']['value']);
            $this->db->or_like('data_iuran.nominal', $_POST['search']['value']);
            $this->db->or_like('bulan',    $_POST['search']['value']);
            $this->db->or_like('tahun_db', $_POST['search']['value']);
            $this->db->or_like('metode_db',$_POST['search']['value']);
            $this->db->or_like('status',   $_POST['search']['value']);
            $this->db->or_like('tgl_bayar',$_POST['search']['value']);
            $this->db->group_end();
        }

        if( isset($_POST['order']) ){
            $this->db->order_by($this->order2[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }else{
            $this->db->order_by('id', 'DESC');
        }
    }

    public function getDataTable2()
    {
        $this->_get_data_query2();
        if( $_POST['length'] != -1 ){
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function count_filtered_data2()
    {
        $this->_get_data_query2();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_data2()
    {
        $this->db->from($this->table2);
        $this->db->join('user',  'user.id  = user_id');
        $this->db->join('bulan', 'bulan.id = bulan_id');
        $this->db->join('tahun', 'tahun.id = tahun_id');
        $this->db->join('metode_pembayaran', 'metode_pembayaran.id = metode_id');
        $this->db->count_all_results();
    }

    // datatable data iuran(!= lunas)
    var $table3 = 'data_iuran';
    var $column_order3 = ['id', 'name', 'data_iuran.nominal', 'bulan', 'tahun_db', 'metode_db', 'status', 'tgl_bayar']; //order di table
    var $order3 = ['id', 'name', 'data_iuran.nominal', 'bulan', 'tahun_db', 'metode_db', 'status', 'tgl_bayar']; //show &search

    private function _get_data_query3()
    {
        $this->db->select('data_iuran.*, user.name, bulan.bulan, tahun.tahun_db, metode_pembayaran.metode_db');
        $this->db->from($this->table3);
        $this->db->join('user',  'user.id  = user_id');
        $this->db->join('bulan', 'bulan.id = bulan_id');
        $this->db->join('tahun', 'tahun.id = tahun_id');
        $this->db->join('metode_pembayaran', 'metode_pembayaran.id = metode_id');
        $this->db->where('status !=', 'Lunas'); 

        if( isset($_POST['search']['value']) ){
            $this->db->group_start();
            $this->db->like('name', $_POST['search']['value']);
            $this->db->or_like('data_iuran.nominal', $_POST['search']['value']);
            $this->db->or_like('bulan', $_POST['search']['value']);
            $this->db->or_like('tahun_db', $_POST['search']['value']);
            $this->db->or_like('metode_db', $_POST['search']['value']);
            $this->db->or_like('status', $_POST['search']['value']);
            $this->db->or_like('tgl_bayar', $_POST['search']['value']);
            $this->db->group_end();
        }

        if( isset($_POST['order']) ){
            $this->db->order_by($this->order3[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }else{
            $this->db->order_by('tgl_bayar', 'DESC');
        }
    }

    public function getDataTable3()
    {
        $this->_get_data_query3();
        if( $_POST['length'] != -1 ){
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function count_filtered_data3()
    {
        $this->_get_data_query3();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_data3()
    {
        $this->db->from($this->table3);
        $this->db->join('user',  'user.id  = user_id');
        $this->db->join('bulan', 'bulan.id = bulan_id');
        $this->db->join('tahun', 'tahun.id = tahun_id');
        $this->db->join('metode_pembayaran', 'metode_pembayaran.id = metode_id');
        $this->db->count_all_results();
    }

    public function setuju($id)
    {
        $dI = $this->db->get_where('data_iuran', ['id' => $id])->row_array();
        $pB = $this->db->get_where('pendapatan_bulan', [
              'bulan_id' => $dI['bulan_id'],
              'tahun_id' => $dI['tahun_id']
        ])->row_array();
        $tH = $this->db->get_where('tahun', ['id' => $dI['tahun_id']])->row_array();
        
        // update data iuran
        $this->db->set('status', 'Lunas');
        $this->db->where('id', $id);
        $this->db->update('data_iuran');

        // update pendapatan iuran(bulan)
        $this->db->set('pendapatan', $pB['pendapatan'] + $dI['nominal']);
        $this->db->where('id', $pB['id']);
        $this->db->update('pendapatan_bulan');

        // update pendapatan iuran(tahun)
        $this->db->set('pendapatan', $tH['pendapatan'] + $dI['nominal']);
        $this->db->where('id', $tH['id']);
        $this->db->update('tahun');
    }
}