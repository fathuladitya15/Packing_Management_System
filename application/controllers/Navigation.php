<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Navigation extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		//$this->load->library(array('form_validation', 'Recaptcha'));
		$this->load->helper(array('captcha','date','text_helper','form','url'));
		$this->load->library('pagination');
		$this->load->model('m_general');
		$this->load->model('m_navigation');
		//$this->load->helper(array('captcha','url'));
		//session_start();
	}

	public function index(){
		$id_group=$this->session->userdata('user_akses_level');
		$priv=$this->m_general->get_privilage($id_group,'navigation');
		$x['priv_count']=$this->m_general->cek_privilage($id_group,'navigation');
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
		$x['jumlahpost']=$this->m_general->total_data('stx_nav','','');
	    $config['base_url'] = base_url().'navigation/index';
	    $config['total_rows'] = $x['jumlahpost'];
	    $config['per_page'] = 25; 
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

		$x['data']=$this->m_navigation->tampil_data('parent_idx','asc',$cari,$config['per_page'],$dari);
		$x['content']=$this->load->view('navigation/view_data_navigation',$x,true);
		$this->load->view('template',$x);
	}

	public function form(){
		$id_group=$this->session->userdata('user_akses_level');
		$priv=$this->m_general->get_privilage($id_group,'navigation');
		$x['priv_count']=$this->m_general->cek_privilage($id_group,'navigation');
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
		
		/*tampil_data_perfield($nama_tabel,$key,$key_value)*/
		$stx_nav_id=$this->uri->segment(3);
		$data=$this->m_general->tampil_data_perfield('stx_nav','id_nav',$stx_nav_id);
		$x['fit_add']='N';
		$x['fit_update']='N';
		$x['fit_delete']='N';
		$x['fit_comment']='N';
		$x['fit_report']='N';
		foreach ($data as $d) {
			# code...
			$x['id_nav']=$stx_nav_id;
			$x['nav_title']=$d['nav_title'];
			$x['nav_url']=$d['nav_url'];
			$x['parent_idx']=$d['parent_idx'];
			$x['child_idx']=$d['child_idx'];
			$x['status']=$d['status'];
			$x['fit_add']=$d['fit_add'];
			$x['fit_update']=$d['fit_update'];
			$x['fit_delete']=$d['fit_delete'];
			$x['fit_comment']=$d['fit_comment'];
			$x['fit_report']=$d['fit_report'];
			$x['status']=$d['status'];
		}
		$x['content']=$this->load->view('navigation/view_form_navigation',$x,true);
		$this->load->view('template',$x);
	}

	public function save(){
		$id_nav=$this->input->post('id_nav');
		if($this->input->post('status')=="Active") $status='Active'; else $status='Non Active';
		if($this->input->post('fit_add')=="Y") $fit_add='Y'; else $fit_add='N';
		if($this->input->post('fit_update')=="Y") $fit_update='Y'; else $fit_update='N';
		if($this->input->post('fit_delete')=="Y") $fit_delete='Y'; else $fit_delete='N';
		if($this->input->post('fit_comment')=="Y") $fit_comment='Y'; else $fit_comment='N';
		if($this->input->post('fit_report')=="Y") $fit_report='Y'; else $fit_report='N';
		$data=array(
			'nav_title'=>$this->input->post('nav_title'),
			'nav_url'=>$this->input->post('nav_url'),
			'parent_idx'=>$this->input->post('parent_idx'),
			'child_idx'=>$this->input->post('child_idx'),
			'fit_add'=>$fit_add,
			'fit_update'=>$fit_update,
			'fit_delete'=>$fit_delete,
			'fit_comment'=>$fit_comment,
			'fit_report'=>$fit_report,
			'status'=>$status
		);
		$this->m_general->save('stx_nav', $data, 'id_nav', $id_nav);
		$messege= array(
			'messege'=> "Data Berhasil Disimpan"
		);
		$this->session->set_flashdata('success',$messege);
		header('location:'.base_url().'navigation');
	}

	public function remove(){
		$id_nav=$this->uri->segment(3);
		$this->m_general->remove('stx_nav','id_nav',$id_nav);
		$messege= array(
			'messege'=> "Data Berhasil Dihapus"
		);
		$this->session->set_flashdata('success',$messege);
		header('location:'.base_url().'navigation');
	}
}

/* End of file admin.php */
/* Location: ./application/controllers/assesmen.php */
