<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Users extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		//$this->load->library(array('form_validation', 'Recaptcha'));
		$this->load->helper(array('captcha','date','text_helper','form','url'));
		$this->load->library('pagination');
		$this->load->model('m_general');
		$this->load->model('m_users');
		//$this->load->helper(array('captcha','url'));
		//session_start();
	}

	public function index(){
		$id_group=$this->session->userdata('user_akses_level');
		$priv=$this->m_general->get_privilage($id_group,'users');
		$x['priv_count']=$this->m_general->cek_privilage($id_group,'users');
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
		
		/*tampil_data($nama_tabel,$parameter_urut,$jns_urut, $sampai,$dari)*/
		$x['jumlahpost']=$this->m_general->total_data('trx_user','','');
	    $config['base_url'] = base_url().'users/index';
	    $config['total_rows'] = $x['jumlahpost'];
	    $config['per_page'] = 20; 
	    //config for bootstrap pagination class integration
	    $config['full_tag_open'] = '<ul class="pagination">';
	    $config['full_tag_close'] = '</ul>';
	    $config['first_link'] = false;
	    $config['last_link'] = false;
	    $config['first_tag_open'] = '<li>';
	    $config['first_tag_close'] = '</li>';
	    $config['prev_link'] = '&laquo';
	    $config['prev_tag_open'] = '<li class="prev">';
	    $config['prev_tag_close'] = '</li>';
	    $config['next_link'] = '&raquo';
	    $config['next_tag_open'] = '<li>';
	    $config['next_tag_close'] = '</li>';
	    $config['last_tag_open'] = '<li>';
	    $config['last_tag_close'] = '</li>';
	    $config['cur_tag_open'] = '<li class="active"><a href="#">';
	    $config['cur_tag_close'] = '</a></li>';
	    $config['num_tag_open'] = '<li>';
	    $config['num_tag_close'] = '</li>'; 
	    $dari = $this->uri->segment('3');
	    $this->pagination->initialize($config);
	    $cari=$this->input->post('cari');

		$x['data']=$this->m_users->tampil_data('group_name','desc',$cari,$config['per_page'],$dari);
		$x['content']=$this->load->view('users/view_data_users',$x,true);
		$this->load->view('template',$x);
	}

	public function form(){
		$id_group=$this->session->userdata('user_akses_level');
		$priv=$this->m_general->get_privilage($id_group,'users');
		$x['priv_count']=$this->m_general->cek_privilage($id_group,'users');
		$x['add']='N';
		$x['update']='N';
		$x['delete']='N';
		$x['comment1']='N';
		$x['report']='N';
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
		
		/*tampil_data_perfield($nama_tabel,$key,$key_value)*/
		$users_id=$this->uri->segment(3);
		$x['username1']=$users_id;
		$x['id_group']="";
		$data=$this->m_general->tampil_data_perfield('trx_user','username',$users_id);
		foreach ($data as $d) {
			# code...
			$x['username']=$users_id;
			$x['id_group']=$d['id_group'];
			$x['user_password']=$d['user_password'];
			$x['user_fullname']=$d['user_fullname'];
			$x['user_email']=$d['user_email'];
			$x['user_telp']=$d['user_telp'];
			$x['user_address']=$d['user_address'];
			$x['user_status']=$d['user_status'];
			$x['user_photo']=$d['user_photo'];
		}
		$x['group']=$this->m_general->tampil_data_perfield('stx_group','status','Active');
		$x['supervisor']=$this->m_general->tampil_data_perfield('trx_user','user_status','Active');
		$x['content']=$this->load->view('users/view_form_users',$x,true);
		$this->load->view('template',$x);
	}

	public function save(){
		$username1=$this->input->post('username1');
		$x['usename1']=$username1;
		if(!empty($username1)) {
            $username=$this->input->post('username1');
            $key_val=$username;
            $new_hash=$this->input->post('user_password');
        }
        else 
        {
            $username=$this->input->post('username');
            $hash_1st=md5($this->input->post('user_password'));
            $key=substr($hash_1st, 5, 5);
            $new_hash=md5($key .$hash_1st .$key);
            $this->form_validation->set_rules('user_email','user_email','required|valid_email|is_unique[trx_user.user_email]');
        	$this->form_validation->set_rules('username','username','required|is_unique[trx_user.username]');
        }

        if ($this->input->post('id_group') == '5'){
        	$username=$this->input->post('username');
        }else{

        	$username =$this->input->post('user_supervisor');
        }

		$data=array(
			'username'=>$username,
			'user_password'=>$new_hash,
			'id_group'=>$this->input->post('id_group'),
			'user_supervisor'=>$username,
			'user_fullname'=>$this->input->post('user_fullname'),
			'user_email'=>$this->input->post('user_email'),
			'user_telp'=>$this->input->post('user_telp'),
			'user_address'=>$this->input->post('user_address'),
			'user_status'=>$this->input->post('user_status'),
			'user_photo'=>$this->input->post('user_photo')
		);

		if(!empty($username1)) {
            $this->m_general->save('trx_user', $data, 'username', $username1);
			$messege= array(
				'messege'=> "Data Berhasil Disimpan"
			);
			$this->session->set_flashdata('success',$messege);
			header('location:'.base_url().'users');
        }else{
        	if($this->form_validation->run() != false){
				$this->m_general->save('trx_user', $data, 'username', $username1);
				$messege= array(
					'messege'=> "Data Berhasil Disimpan"
				);
				$this->session->set_flashdata('success',$messege);
				header('location:'.base_url().'users');
	        }else{
	        	$error = validation_errors();
					//echo $error;
					
				//$sess_data['error_validasi'] = $error;
	        	echo $error;
	        	$messege= array(
					'messege'=> $error
				);
				$this->session->set_flashdata('message',$messege);
				header('location:'.base_url().'users/form');
	        }
        }
		//header('location:'.base_url().'users');
		
	}

	public function remove(){
		$username=$this->uri->segment(3);
		$this->m_general->remove('trx_user','username',$username);
		$messege= array(
			'messege'=> "Data Berhasil Dihapus"
		);
		$this->session->set_flashdata('success',$messege);
		header('location:'.base_url().'users');
	}

	public function reset_password(){
		$username=$this->uri->segment(3);
		$new_pass=$this->m_users->randomPassword();
		$hash_1st=md5($new_pass);
        $key=substr($hash_1st, 5,5);
        $new_hash=md5($key .$hash_1st .$key);

		
		$data=array('user_password'=>$new_hash);
		$this->m_general->save('trx_user',$data,'username',$username);
		$pesan="Password untuk user " .$username ." Berhasil di reset<br>" ."Password baru " .$new_pass;
		$messege= array(
			'messege'=> $pesan
		);
		$this->session->set_flashdata('success',$messege);
		header('location:'.base_url().'users');
	}
}

/* End of file admin.php */
/* Location: ./application/controllers/assesmen.php */
