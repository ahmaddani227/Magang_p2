<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        if( $this->session->userdata('email') ){
            redirect('user');
        }

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email',[
            
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if ($this->form_validation->run() == FALSE){
            $data['title'] = 'Page Login';
            $this->load->view('templates/auth_header',$data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        }else{
            $this->_login();
        }
    }
    
    public function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        
        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        if( $user ){
            
            if( $user['is_active'] == 1 ){
                if( password_verify($password, $user['password']) ){
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);

                    if( $user['role_id'] == 1 ){
                        redirect('admin');
                    }else{
                        redirect('user');
                    }
                }else{
                    $this->session->set_flashdata('app', '<div class="alert alert-danger" role="alert">password yang anda masukkan  salah</div>');
                    redirect('auth'); 
                }
            }else{
                $this->session->set_flashdata('app', '<div class="alert alert-danger" role="alert">akun anda belum di aktivasi</div>');
                redirect('auth'); 
            }
            
        }else{
            $this->session->set_flashdata('app', '<div class="alert alert-danger" role="alert">Akun anda belum registrasi</div>');
            redirect('auth');
        }
        
    }
    
    public function registration()
    {
        if( $this->session->userdata('email') ){
            redirect('user');
        }

        $this->form_validation->set_rules('name', 'Namw', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]',[
            
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|matches[password2]|min_length[3]|max_length[12]', [

        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        if ($this->form_validation->run() == FALSE){
            $data['title'] = 'Page Registration';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        }else{
            $this->load->model('Auth_model', 'auth');
            $this->auth->registration();

            $this->session->set_flashdata('app', '<div class="alert alert-success" role="alert">Akun anda berhasil di registrasi</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('app', '<div class="alert alert-success" role="alert">anda telah logout</div>');
        redirect('auth');
    }

    public function blocked()
    {
        $this->load->view('auth/blocked');
    }
}