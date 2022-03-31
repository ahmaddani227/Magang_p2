<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        
    }

    public function index()
    {
        $data['title']  = 'Profile Saya';
        $data['user']   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function editProfile()
    {
        $data['title']  = 'Edit Profile';
        $data['user']   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Nama Lengkap', 'required|trim');
        if ($this->form_validation->run() == FALSE){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        }else{
            $name   = $this->input->post('name');
            $email  = $this->input->post('email');

            // CEK JIKA ADA GAMBAR YANG DIUPLOAD
            $image = $_FILES['image']['name'];
            if( $image ){
                $config['upload_path']      = './assets/img/profile/';
                $config['allowed_types']    = 'jpg|png|jpeg';
                $config['max_size']         = '2048';

                $this->load->library('upload', $config);

                if( $this->upload->do_upload('image') ){
                    $gambar_lama = $data['user']['image'];
                    if( $gambar_lama !== 'default.png' ){
                        unlink(FCPATH . 'assets/img/profile/' . $gambar_lama );
                    }

                    $image_baru = $this->upload->data('file_name');
                    $this->db->set('image', $image_baru);
                }else{
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');


            // flasdata
            $this->session->set_flashdata('app', '<div class="alert alert-success" role="alert">Profil Anda telah diperbarui</div>');
            redirect('user');
        }
    }

    public function ubahSandi()
    {
        $data['title']  = 'Ubah Sandi';
        $data['user']   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('sandiLama', 'Sandi Lama', 'required|trim');
        $this->form_validation->set_rules('sandiBaru', 'Sandi Baru', 'required|trim|matches[konfirmasi]|min_length[3]|max_length[12]');
        $this->form_validation->set_rules('konfirmasi', 'Konfirmasi', 'required|trim|matches[sandiBaru]');
        if ($this->form_validation->run() == FALSE){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/ubahsandi', $data);
            $this->load->view('templates/footer');
        }else{
            $sandiLama = $this->input->post('sandiLama');
            $sandiBaru = $this->input->post('sandiBaru');
            
            if( !password_verify($sandiLama, $data['user']['password']) ){
                $this->session->set_flashdata('app', '<div class="alert alert-danger" role="alert">sandi yang anda masukkan salah</div>');
                redirect('user/ubahSandi');
            }else{
                if( $sandiBaru == $sandiLama ){
                    $this->session->set_flashdata('app', '<div class="alert alert-danger" role="alert">sandi yang anda masukkan sama dengan Sandi saat ini</div>');
                    redirect('user/ubahSandi');
                }else{
                    $hash = password_hash($sandiBaru, PASSWORD_DEFAULT);

                    $this->db->set('password', $hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');
                    $this->session->set_flashdata('app', '<div class="alert alert-success" role="alert">sandi berhasil diubah</div>');
                    redirect('user/ubahSandi');
                }
            }
        }
    }
}