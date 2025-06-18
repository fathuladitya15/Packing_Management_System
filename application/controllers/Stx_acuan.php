<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stx_acuan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Stx_acuan_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('m_general');
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

        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'stx_acuan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'stx_acuan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'stx_acuan/index.html';
            $config['first_url'] = base_url() . 'stx_acuan';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['base_url'] = base_url().'trx_karyawan';
        $config['total_rows'] = $this->Stx_acuan_model->total_rows($q);
        $stx_acuan = $this->Stx_acuan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'stx_acuan_data' => $stx_acuan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $x['content']=$this->load->view('stx_acuan/stx_acuan_list', $data,TRUE);
        $this->load->view('template',$x);
    }

    public function read($id) 
    {
        $row = $this->Stx_acuan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'acuan_id' => $row->acuan_id,
		'acuan_nama' => $row->acuan_nama,
		'acuan_status' => $row->acuan_status,
		'acuan_userinput' => $row->acuan_userinput,
		'acuan_tglinput' => $row->acuan_tglinput,
	    );
            $x['content']=$this->load->view('stx_acuan/stx_acuan_read', $data,TRUE);
            $this->load->view('template',$x);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('stx_acuan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('stx_acuan/create_action'),
	    'acuan_id' => set_value('acuan_id'),
	    'acuan_nama' => set_value('acuan_nama'),
	    'acuan_status' => set_value('acuan_status'),
	    'acuan_userinput' => set_value('acuan_userinput'),
	    'acuan_tglinput' => set_value('acuan_tglinput'),
	);
        $x['content']=$this->load->view('stx_acuan/stx_acuan_form', $data,TRUE);
        $this->load->view('template',$x);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
             if($this->input->post('acuan_status')=="Aktif") $acuan_status='Aktif'; else $acuan_status='Tidak Aktif';
            $data = array(
		'acuan_nama' => $this->input->post('acuan_nama',TRUE),
		'acuan_status' => $acuan_status,
		'acuan_userinput' => $this->input->post('acuan_userinput',TRUE),
		'acuan_tglinput' => $this->input->post('acuan_tglinput',TRUE),
	    );

            $this->Stx_acuan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('stx_acuan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Stx_acuan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('stx_acuan/update_action'),
		'acuan_id' => set_value('acuan_id', $row->acuan_id),
		'acuan_nama' => set_value('acuan_nama', $row->acuan_nama),
		'acuan_status' => set_value('acuan_status', $row->acuan_status),
		'acuan_userinput' => set_value('acuan_userinput', $row->acuan_userinput),
		'acuan_tglinput' => set_value('acuan_tglinput', $row->acuan_tglinput),
	    );

        $x['content']=$this->load->view('stx_acuan/stx_acuan_form', $data,TRUE);
        $this->load->view('template',$x);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('stx_acuan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('acuan_id', TRUE));
        } else {
             if($this->input->post('acuan_status')=="Aktif") $acuan_status='Aktif'; else $acuan_status='Tidak Aktif';
            $data = array(
		'acuan_nama' => $this->input->post('acuan_nama',TRUE),
		'acuan_status' => $acuan_status,
		'acuan_userinput' => $this->input->post('acuan_userinput',TRUE),
		'acuan_tglinput' => $this->input->post('acuan_tglinput',TRUE),
	    );

            $this->Stx_acuan_model->update($this->input->post('acuan_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('stx_acuan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Stx_acuan_model->get_by_id($id);

        if ($row) {
            $this->Stx_acuan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('stx_acuan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('stx_acuan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('acuan_nama', 'acuan nama', 'trim|required');
	$this->form_validation->set_rules('acuan_status', 'acuan status', 'trim');
	$this->form_validation->set_rules('acuan_userinput', 'acuan userinput', 'trim');
	$this->form_validation->set_rules('acuan_tglinput', 'acuan tglinput', 'trim');

	$this->form_validation->set_rules('acuan_id', 'acuan_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Stx_acuan.php */
/* Location: ./application/controllers/Stx_acuan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-04 14:45:35 */
/* http://harviacode.com */
