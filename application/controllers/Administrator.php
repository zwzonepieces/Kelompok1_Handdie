<?php
class Administrator extends CI_Controller{
    function __construct(){
        parent:: __construct();
        $this->load->model('m_login');
    }
    function index(){
        $this->load->view('admin/v_login');
    }
    function register(){
        $this->load->view('admin/v_register');
    }
    function auth(){
        $username=strip_tags(str_replace("'", "", $this->input->post('username',TRUE)));
        $password=strip_tags(str_replace("'", "", $this->input->post('password',TRUE)));
        $cadmin=$this->m_login->cekadmin($username,$password);
        if($cadmin->num_rows() > 0){
            $xcadmin=$cadmin->row_array();
            $newdata = array(
                'idadmin'   => $xcadmin['pengguna_id'],
                'username'  => $xcadmin['pengguna_username'],
                'nama'      => $xcadmin['pengguna_nama'],
                'level'     => $xcadmin['pengguna_level'],
                'logged_in' => TRUE
            );

            $this->session->set_userdata($newdata);
            if($xcadmin['pengguna_level']=='1')
            redirect('admin/dashboard');
            if($xcadmin['pengguna_level']=='2')
            redirect('admin/produk/super'); 
            
        }else{
            redirect('administrator/gagallogin'); 
        }
    }


    function gagallogin(){
        $url=site_url('/administrator');
        echo $this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button> Username Atau Password Salah</div>');
        redirect($url);
    }

    function logout(){
        $this->session->sess_destroy();
        $url=site_url('/administrator');
        redirect($url);
    }
}