<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stx_jabatan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Stx_jabatan_model');
        $this->load->library('form_validation');
        $this->load->library('session');    
        $this->load->model('m_general');
        $this->load->model('Stx_menu');
            if(!$this->session->userdata('username')){
            redirect('akses/login');
            
        }
  
    }

    public function index()
    {
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
        $this->Stx_menu->menu();
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'stx_jabatan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'stx_jabatan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'stx_jabatan/index.html';
            $config['first_url'] = base_url() . 'stx_jabatan';
        }

        $config['per_page'] = 25;
        $config['page_query_string'] = TRUE;
        $config['base_url'] = base_url().'stx_jabatan';
        $config['total_rows'] = $this->Stx_jabatan_model->total_rows($q);
        $config['uri_segment'] = 3;
        $stx_jabatan = $this->Stx_jabatan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'stx_jabatan_data' => $stx_jabatan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $x['content']=$this->load->view('stx_jabatan/stx_jabatan_list', $data,true);
        $this->load->view('template',$x);
    }

    public function read($id) 
    {
        
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

        $row = $this->Stx_jabatan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'jabatan_id' => $row->jabatan_id,
		'jabatan_nama' => $row->jabatan_nama,
		'jabatan_status' => $row->jabatan_status,
		'jabatan_info1' => $row->jabatan_info1,
		'jabatan_info2' => $row->jabatan_info2,
	    );
            $x['content']=$this->load->view('stx_jabatan/stx_jabatan_read', $data,true);
            $this->load->view('template',$x);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('stx_jabatan'));
        }
    }

    public function create() 
    {
        
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

        $data = array(
            'button' => 'Create',
            'action' => site_url('stx_jabatan/create_action'),
	    'jabatan_id' => set_value('jabatan_id'),
	    'jabatan_nama' => set_value('jabatan_nama'),
	    'jabatan_status' => set_value('jabatan_status'),
	    'jabatan_info1' => set_value('jabatan_info1'),
	    'jabatan_info2' => set_value('jabatan_info2'),
	);
        
        $x['content']=$this->load->view('stx_jabatan/stx_jabatan_form', $data,true);
         $this->load->view('template',$x);


    }
    
    public function create_action() 
    {
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
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            if($this->input->post('jabatan_status')=="Aktif") $jabatan_status='Aktif'; else $jabatan_status='Tidak Aktif';
            $data = array(
		'jabatan_nama' => $this->input->post('jabatan_nama',TRUE),
		'jabatan_status' => $jabatan_status,
		'jabatan_info1' => $this->input->post('jabatan_info1',TRUE),
		'jabatan_info2' => $this->input->post('jabatan_info2',TRUE),
	    );

            $this->Stx_jabatan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('stx_jabatan'));
        }
    }
    
    public function update($id) 
    {
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
        $row = $this->Stx_jabatan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('stx_jabatan/update_action'),
		'jabatan_id' => set_value('jabatan_id', $row->jabatan_id),
		'jabatan_nama' => set_value('jabatan_nama', $row->jabatan_nama),
		'jabatan_status' => set_value('jabatan_status', $row->jabatan_status),
		'jabatan_info1' => set_value('jabatan_info1', $row->jabatan_info1),
		'jabatan_info2' => set_value('jabatan_info2', $row->jabatan_info2),
	    );
           
        
        $x['content']=$this->load->view('stx_jabatan/stx_jabatan_form', $data,true);
        $this->load->view('template',$x);
    
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('stx_jabatan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('jabatan_id', TRUE));
        } else {
        if($this->input->post('jabatan_status')=="Aktif") $jabatan_status='Aktif'; else $jabatan_status='Tidak Aktif';
            $data = array(

		'jabatan_nama' => $this->input->post('jabatan_nama',TRUE),
		'jabatan_status' => $jabatan_status,
		'jabatan_info1' => $this->input->post('jabatan_info1',TRUE),
		'jabatan_info2' => $this->input->post('jabatan_info2',TRUE),
	    );

            $x['content']=$this->Stx_jabatan_model->update($this->input->post('jabatan_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('stx_jabatan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Stx_jabatan_model->get_by_id($id);

        if ($row) {
            $this->Stx_jabatan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('stx_jabatan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('stx_jabatan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('jabatan_nama', 'jabatan nama', 'trim|required');
	$this->form_validation->set_rules('jabatan_info1', 'jabatan info1', 'trim');
	$this->form_validation->set_rules('jabatan_info2', 'jabatan info2', 'trim');
	$this->form_validation->set_rules('jabatan_id', 'jabatan_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

