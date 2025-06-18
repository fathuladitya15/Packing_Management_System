<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Home extends CI_Controller {
	
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
		$id_group=$this->session->userdata('user_akses_level');
		$priv=$this->m_general->get_privilage($id_group,'home');
		$priv_count=$this->m_general->cek_privilage($id_group,'home');
		$x['add']='N';
		$x['update']='N';
		$x['delete']='N';
		$x['comment1']='N';
		$x['report']='N';
		foreach ($priv as $a) {
			$x['add']=$a['add1'];
			$x['update']=$a['update1'];
			$x['delete']=$a['delete1'];
			$x['comment1']=$a['comment1'];
			$x['report']=$a['report1'];
		}

		$x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
		$username=$this->session->userdata('username');
		$x['messege']=$this->m_general->total_pesan($username,'Unread');
		$x['messege_det']=$this->m_general->detail_pesan($username,'Unread');
		$x['schedule_count']=$this->m_general->schedule_count_byday($username,'Active');
		$x['schedule_detail']=$this->m_general->schedule_detail($username,'Active');
		if($priv_count>0){
		$x['content']="<marquee><h1>Welcome " .$this->session->userdata('user_nama_lengkap') ."</h1></marquee>";
		}else{
			$x['content']=$this->load->view('access_denied',$x,true);
		}
		//echo "User Nama" .$this->session->userdata('user_nama_lengkap');
		$this->load->view('template',$x);
	}
}

/* End of file admin.php */
/* Location: ./application/controllers/assesmen.php */
