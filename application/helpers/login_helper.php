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