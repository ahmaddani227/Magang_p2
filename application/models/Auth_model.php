<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model{

    public function registration()
    {
        $data = [
            'name'          => htmlspecialchars( $this->input->post('name', true) ),
            'email'         => htmlspecialchars( $this->input->post('email', true) ),
            'image'         => 'default.png',
            'password'      => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            'role_id'       => 2,
            'is_active'     => 1,
            'date_created'  => time()
        ];

        $this->db->insert('user', $data);
    }

}