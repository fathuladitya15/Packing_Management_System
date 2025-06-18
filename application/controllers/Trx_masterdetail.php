<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trx_masterdetail extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Trx_masterdetail_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'trx_masterdetail/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'trx_masterdetail/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'trx_masterdetail/index.html';
            $config['first_url'] = base_url() . 'trx_masterdetail/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Trx_masterdetail_model->total_rows($q);
        $trx_masterdetail = $this->Trx_masterdetail_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'trx_masterdetail_data' => $trx_masterdetail,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('trx_masterdetail/trx_masterdetail_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Trx_masterdetail_model->get_by_id($id);
        if ($row) {
            $data = array(
		'masterdetail_id' => $row->masterdetail_id,
		'masterdetail_master_id' => $row->masterdetail_master_id,
		'masterdetail_karyawan_id' => $row->masterdetail_karyawan_id,
		'masterdetail_mulai' => $row->masterdetail_mulai,
		'masterdetail_selesai' => $row->masterdetail_selesai,
		'masterdetail_jamkerja' => $row->masterdetail_jamkerja,
		'masterdetail_istirahat' => $row->masterdetail_istirahat,
		'masterdetail_totalkerja' => $row->masterdetail_totalkerja,
		'masterdetail_box' => $row->masterdetail_box,
		'masterdetail_jumlahstiker' => $row->masterdetail_jumlahstiker,
		'masterdetail_jumlahkrat' => $row->masterdetail_jumlahkrat,
		'masterdetail_upah' => $row->masterdetail_upah,
		'masterdetail_userinput' => $row->masterdetail_userinput,
		'masterdetail_tglinput' => $row->masterdetail_tglinput,
	    );
            $this->load->view('trx_masterdetail/trx_masterdetail_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_masterdetail'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('trx_masterdetail/create_action'),
	    'masterdetail_id' => set_value('masterdetail_id'),
	    'masterdetail_master_id' => set_value('masterdetail_master_id'),
	    'masterdetail_karyawan_id' => set_value('masterdetail_karyawan_id'),
	    'masterdetail_mulai' => set_value('masterdetail_mulai'),
	    'masterdetail_selesai' => set_value('masterdetail_selesai'),
	    'masterdetail_jamkerja' => set_value('masterdetail_jamkerja'),
	    'masterdetail_istirahat' => set_value('masterdetail_istirahat'),
	    'masterdetail_totalkerja' => set_value('masterdetail_totalkerja'),
	    'masterdetail_box' => set_value('masterdetail_box'),
	    'masterdetail_jumlahstiker' => set_value('masterdetail_jumlahstiker'),
	    'masterdetail_jumlahkrat' => set_value('masterdetail_jumlahkrat'),
	    'masterdetail_upah' => set_value('masterdetail_upah'),
	    'masterdetail_userinput' => set_value('masterdetail_userinput'),
	    'masterdetail_tglinput' => set_value('masterdetail_tglinput'),
	);
        $this->load->view('trx_masterdetail/trx_masterdetail_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'masterdetail_master_id' => $this->input->post('masterdetail_master_id',TRUE),
		'masterdetail_karyawan_id' => $this->input->post('masterdetail_karyawan_id',TRUE),
		'masterdetail_mulai' => $this->input->post('masterdetail_mulai',TRUE),
		'masterdetail_selesai' => $this->input->post('masterdetail_selesai',TRUE),
		'masterdetail_jamkerja' => $this->input->post('masterdetail_jamkerja',TRUE),
		'masterdetail_istirahat' => $this->input->post('masterdetail_istirahat',TRUE),
		'masterdetail_totalkerja' => $this->input->post('masterdetail_totalkerja',TRUE),
		'masterdetail_box' => $this->input->post('masterdetail_box',TRUE),
		'masterdetail_jumlahstiker' => $this->input->post('masterdetail_jumlahstiker',TRUE),
		'masterdetail_jumlahkrat' => $this->input->post('masterdetail_jumlahkrat',TRUE),
		'masterdetail_upah' => $this->input->post('masterdetail_upah',TRUE),
		'masterdetail_userinput' => $this->input->post('masterdetail_userinput',TRUE),
		'masterdetail_tglinput' => $this->input->post('masterdetail_tglinput',TRUE),
	    );

            $this->Trx_masterdetail_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('trx_masterdetail'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Trx_masterdetail_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('trx_masterdetail/update_action'),
		'masterdetail_id' => set_value('masterdetail_id', $row->masterdetail_id),
		'masterdetail_master_id' => set_value('masterdetail_master_id', $row->masterdetail_master_id),
		'masterdetail_karyawan_id' => set_value('masterdetail_karyawan_id', $row->masterdetail_karyawan_id),
		'masterdetail_mulai' => set_value('masterdetail_mulai', $row->masterdetail_mulai),
		'masterdetail_selesai' => set_value('masterdetail_selesai', $row->masterdetail_selesai),
		'masterdetail_jamkerja' => set_value('masterdetail_jamkerja', $row->masterdetail_jamkerja),
		'masterdetail_istirahat' => set_value('masterdetail_istirahat', $row->masterdetail_istirahat),
		'masterdetail_totalkerja' => set_value('masterdetail_totalkerja', $row->masterdetail_totalkerja),
		'masterdetail_box' => set_value('masterdetail_box', $row->masterdetail_box),
		'masterdetail_jumlahstiker' => set_value('masterdetail_jumlahstiker', $row->masterdetail_jumlahstiker),
		'masterdetail_jumlahkrat' => set_value('masterdetail_jumlahkrat', $row->masterdetail_jumlahkrat),
		'masterdetail_upah' => set_value('masterdetail_upah', $row->masterdetail_upah),
		'masterdetail_userinput' => set_value('masterdetail_userinput', $row->masterdetail_userinput),
		'masterdetail_tglinput' => set_value('masterdetail_tglinput', $row->masterdetail_tglinput),
	    );
            $this->load->view('trx_masterdetail/trx_masterdetail_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_masterdetail'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('masterdetail_id', TRUE));
        } else {
            $data = array(
		'masterdetail_master_id' => $this->input->post('masterdetail_master_id',TRUE),
		'masterdetail_karyawan_id' => $this->input->post('masterdetail_karyawan_id',TRUE),
		'masterdetail_mulai' => $this->input->post('masterdetail_mulai',TRUE),
		'masterdetail_selesai' => $this->input->post('masterdetail_selesai',TRUE),
		'masterdetail_jamkerja' => $this->input->post('masterdetail_jamkerja',TRUE),
		'masterdetail_istirahat' => $this->input->post('masterdetail_istirahat',TRUE),
		'masterdetail_totalkerja' => $this->input->post('masterdetail_totalkerja',TRUE),
		'masterdetail_box' => $this->input->post('masterdetail_box',TRUE),
		'masterdetail_jumlahstiker' => $this->input->post('masterdetail_jumlahstiker',TRUE),
		'masterdetail_jumlahkrat' => $this->input->post('masterdetail_jumlahkrat',TRUE),
		'masterdetail_upah' => $this->input->post('masterdetail_upah',TRUE),
		'masterdetail_userinput' => $this->input->post('masterdetail_userinput',TRUE),
		'masterdetail_tglinput' => $this->input->post('masterdetail_tglinput',TRUE),
	    );

            $this->Trx_masterdetail_model->update($this->input->post('masterdetail_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('trx_masterdetail'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Trx_masterdetail_model->get_by_id($id);

        if ($row) {
            $this->Trx_masterdetail_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('trx_masterdetail'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_masterdetail'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('masterdetail_master_id', 'masterdetail master id', 'trim|required');
	$this->form_validation->set_rules('masterdetail_karyawan_id', 'masterdetail karyawan id', 'trim|required');
	$this->form_validation->set_rules('masterdetail_mulai', 'masterdetail mulai', 'trim|required');
	$this->form_validation->set_rules('masterdetail_selesai', 'masterdetail selesai', 'trim|required');
	$this->form_validation->set_rules('masterdetail_jamkerja', 'masterdetail jamkerja', 'trim|required');
	$this->form_validation->set_rules('masterdetail_istirahat', 'masterdetail istirahat', 'trim|required');
	$this->form_validation->set_rules('masterdetail_totalkerja', 'masterdetail totalkerja', 'trim|required');
	$this->form_validation->set_rules('masterdetail_box', 'masterdetail box', 'trim|required');
	$this->form_validation->set_rules('masterdetail_jumlahstiker', 'masterdetail jumlahstiker', 'trim|required');
	$this->form_validation->set_rules('masterdetail_jumlahkrat', 'masterdetail jumlahkrat', 'trim|required');
	$this->form_validation->set_rules('masterdetail_upah', 'masterdetail upah', 'trim|required|numeric');
	$this->form_validation->set_rules('masterdetail_userinput', 'masterdetail userinput', 'trim|required');
	$this->form_validation->set_rules('masterdetail_tglinput', 'masterdetail tglinput', 'trim|required');

	$this->form_validation->set_rules('masterdetail_id', 'masterdetail_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Trx_masterdetail.php */
/* Location: ./application/controllers/Trx_masterdetail.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-04 14:45:35 */
/* http://harviacode.com */
