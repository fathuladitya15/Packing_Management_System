<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Group extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		//$this->load->library(array('form_validation', 'Recaptcha'));
		$this->load->helper(array('captcha','date','text_helper','form','url'));
		$this->load->library('pagination');
		$this->load->model('m_general');
		$this->load->model('m_group');
		//$this->load->helper(array('captcha','url'));
		//session_start();
	}

	public function index(){
		$x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
		$username=$this->session->userdata('username');

		$id_group=$this->session->userdata('user_akses_level');
		$priv=$this->m_general->get_privilage($id_group,'group');
		$x['priv_count']=$this->m_general->cek_privilage($id_group,'group');
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

		/*tampil_data($nama_tabel,$parameter_urut,$jns_urut, $sampai,$dari)*/
		$x['jumlahpost']=$this->m_general->total_data('stx_group','','');
	    $config['base_url'] = base_url().'group/index';
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

		$x['data']=$this->m_group->tampil_data('id_group','desc',$cari,$config['per_page'],$dari);
		$x['content']=$this->load->view('group/view_data_group',$x,true);
		$this->load->view('template',$x);
	}

	public function form(){
		$id_group=$this->session->userdata('user_akses_level');
		$priv=$this->m_general->get_privilage($id_group,'group');
		$x['priv_count']=$this->m_general->cek_privilage($id_group,'group');
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
		$stx_group_id=$this->uri->segment(3);
		$x['akses']=$this->m_group->privilage($stx_group_id);
		$x['nav']=$this->m_general->tampil_data('stx_nav','parent_idx','','','');
		$x['hak_akses']=$this->m_group->hak_akses($stx_group_id);
		$data=$this->m_general->tampil_data_perfield('stx_group','id_group',$stx_group_id);
		foreach ($data as $d) {
			# code...
			$x['id_group']=$stx_group_id;
			$x['group_name']=$d['group_name'];
			$x['status']=$d['status'];
			$x['admin']=$d['admin'];
		}
		$x['content']=$this->load->view('group/view_form_group',$x,true);
		$this->load->view('template',$x);
	}

	public function save(){
		$id_group=$this->input->post('id_group');
		if($this->input->post('status')=="Active") $status='Active'; else $status='Non Active';
		if($this->input->post('admin')=="Y") $admin='Y'; else $admin='N';
		$data=array(
			'group_name'=>$this->input->post('group_name'),
			'status'=>$status,
			'admin'=>$admin
		);

		$this->m_general->save('stx_group', $data, 'id_group', $id_group);

		$nav=$this->input->post('nav');
		
        $i=0;
        //$this->db->where('id_nav',$nav[$key]);
		//$this->db->where('id_group',$id_group);
		//$this->db->delete('stx_nav_group');
        foreach ($nav as $key => $j) {
            $i++;

            $id_nav=$this->input->post('id_nav' .$nav[$key]);
	        $add=$this->input->post('add' .$nav[$key]);
	        $update=$this->input->post('update' .$nav[$key]);
	        $delete=$this->input->post('delete' .$nav[$key]);
	        $comment1=$this->input->post('comment' .$nav[$key]);
	        $report1=$this->input->post('report' .$nav[$key]);

            if($id_nav=='Y') $id_nav1='Y'; else $id_nav1='N';
            if($add=='Y') $add1='Y'; else $add1='N';
	        if($update=='Y') $update1='Y'; else $update1='N';
	        if($delete=='Y') $delete1='Y'; else $delete1='N';
	        if($comment1=='Y') $comment='Y'; else $comment='N';
	        if($report1=='Y') $report='Y'; else $report='N';
	       
            if($id_nav1=='Y'){
            	//Jika Checkbox Navigasi dicentang Lakukan proses Insert atau update 
            	
	            $data= array(
	                'id_nav'=>$nav[$key],
	                'id_group'=>$id_group,
	                'add1' 	 => $add1,
	                'update1' => $update1,
	                'delete1' => $delete1,
	                'comment1' => $comment,
	                'report1' => $report
	            );
	            $this->db->select('*');
	            $this->db->from('stx_nav_group');
	            $this->db->where('id_nav',$nav[$key]);
	            $this->db->where('id_group',$id_group);
	            $q=$this->db->get();
		        if($q->num_rows() >0){
		            //Jika Sudah ada data id_nav untuk group lakukan proses update hak akses
		        	$this->db->where('id_nav',$nav[$key]);
		        	$this->db->where('id_group',$id_group);
		        	$this->db->update('stx_nav_group',$data);
		        	//echo "Update Privilage" .$nav[$key] ."<br>";
		        	//echo "Add " .$add1 ."<br>";
		        	//echo "Update " .$update1 ."<br>";
		        	//echo "Delete " .$delete1 ."<br>";
		        	//echo "Report " .$report ."<br><hr>";
		        }else{
		            //Jika Belum ada data id_nav untuk group lakukan proses tambah hak akses
		            $this->db->insert('stx_nav_group',$data);
		            //echo "Insert Privilage" .$nav[$key]  ."<br>";
		            //echo "Add " .$add1 ."<br>";
		        	//echo "Update " .$update1 ."<br>";
		        	//echo "Delete " .$delete1 ."<br>";
		        	//echo "report " .$report ."<br><hr>";

		        }
            }else{
            	$this->db->where('id_nav',$nav[$key]);
		        $this->db->where('id_group',$id_group);
		        $this->db->delete('stx_nav_group');
		        //echo "Delete Privilage" ." " .$nav[$key] ."<br>";
		        //echo "Add " .$add1 ."<br>";
		        //echo "Update " .$update1 ."<br>";
		        //echo "Delete " .$delete1 ."<br>";
		        //echo "report " .$report ."<br><hr>";
            }
            
        }

		$messege= array(
			'messege'=> "Data Berhasil Disimpan"
		);
		$this->session->set_flashdata('success',$messege);
		header('location:'.base_url().'group');
	}

	public function remove(){
		$id_group=$this->uri->segment(3);
		$this->m_general->remove('stx_group','id_group',$id_group);
		$messege= array(
			'messege'=> "Data Berhasil Dihapus"
		);
		$this->session->set_flashdata('success',$messege);
		header('location:'.base_url().'group');
	}
}

/* End of file admin.php */
/* Location: ./application/controllers/assesmen.php */
