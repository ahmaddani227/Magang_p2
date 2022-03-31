<?php

function cek_login()
{
    $ci = get_instance();
    $email = $ci->session->userdata('email');
    $role = $ci->session->userdata('role_id');
    if( !$email ){
        redirect('auth');
    }else{
        $menu = $ci->uri->segment(1);
        $query = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
        $menuId = $query['id'];

        $access = $ci->db->get_where('user_access_menu', [
                  'role_id' => $role,
                  'menu_id' => $menuId
        ]);

        if( $access->num_rows() < 1 ){
            redirect('auth/blocked');
        }


    }
}

function cek_akses($role_id, $menu_id)
{
    $ci = get_instance();

    $result = $ci->db->get_where('user_access_menu', [
        'role_id'   => $role_id,
        'menu_id'   => $menu_id
    ]);

    if( $result->num_rows() > 0 ){
        return "checked='checked'";
    }
}

function pB(){
    $ci = get_instance();

    $bulanNow = date('F', time());
    $tahunNow = date('Y', time());
    $qB = $ci->db->get_where('bulan', ['bulan' => $bulanNow])->row_array();
    $qT = $ci->db->get_where('tahun', ['tahun_db' => $tahunNow])->row_array();
    
    if( $qT == false ){
        $data1 = [
            'tahun_db' => $tahunNow,
            'pendapatan' => ''
        ];
        $ci->db->insert('tahun', $data1);
    }

    $qPB = $ci->db->get_where('pendapatan_bulan', [
           'bulan_id' => $qB['id'],
           'tahun_id' => $qT['id'] ])->row_array();
    if( $qPB == false ){
        $data = [
            'pendapatan' => '',
            'bulan_id'   => $qB['id'],
            'tahun_id'   => $qT['id']
        ];
        $ci->db->insert('pendapatan_bulan', $data);
    }
}