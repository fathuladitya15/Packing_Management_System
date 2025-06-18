<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Akses extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		//$this->load->library(array('form_validation', 'Recaptcha'));
		$this->load->helper(array('captcha','date','text_helper','form','url'));
		$this->load->model('m_general');
		
		//$this->load->helper(array('captcha','url'));
		//session_start();
	}
	
	

	public function index(){
		header('location:'.base_url().'akses/login');
	}
	
	public function login(){
        $this->load->view('view_login');   
    }

    public function cekuser(){
        $data_login=$this->m_general->cek_user($this->input->post('username'),$this->input->post('user_password'),'Active');   
        $count=0;
        foreach($data_login as $row){
            $count=$count+1;
            $info_user = array(
                'username'          => $row['username'],
                'user_password'     => $this->input->post('user_password'),
                'user_nama_lengkap' => $row['user_fullname'],
                'user_supervisor' => $row['user_supervisor'],
                'user_akses_level'  => $row['id_group'],
                'user_photo'        => $row['user_photo'],
                'admin'				=> $row['admin'],
                'dasboard_type'     => $row['dasboard_type'],
                'group_client'      => $row['group_client']
            );
            $this->session->set_userdata($info_user);
            header("location:".base_url()."dasboard");
            /*if($row['admin']=='Y'){
            	header("location:".base_url()."dasboard");
            }else{
            	header("location:".base_url()."home");
            }*/
            
        }
        if($count==0){
            echo "<script>alert('Tidak Berhak Akses'); document.location.href='" .base_url() ."akses';</script>";
        }
    }

    public function log_out(){
		$this->session->sess_destroy();
		header('location:'.base_url().'akses');

	}
	
}

/* End of file admin.php */
/* Location: ./application/controllers/assesmen.php */
