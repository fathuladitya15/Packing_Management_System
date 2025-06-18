<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stx_module extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Stx_module_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'stx_module/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'stx_module/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'stx_module/index.html';
            $config['first_url'] = base_url() . 'stx_module/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Stx_module_model->total_rows($q);
        $stx_module = $this->Stx_module_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'stx_module_data' => $stx_module,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('stx_module/stx_module_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Stx_module_model->get_by_id($id);
        if ($row) {
            $data = array(
		'module_id' => $row->module_id,
		'module_nama' => $row->module_nama,
		'module_group' => $row->module_group,
		'module_status' => $row->module_status,
		'module_userinput' => $row->module_userinput,
		'module_tglinput' => $row->module_tglinput,
	    );
            $this->load->view('stx_module/stx_module_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('stx_module'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('stx_module/create_action'),
	    'module_id' => set_value('module_id'),
	    'module_nama' => set_value('module_nama'),
	    'module_group' => set_value('module_group'),
	    'module_status' => set_value('module_status'),
	    'module_userinput' => set_value('module_userinput'),
	    'module_tglinput' => set_value('module_tglinput'),
	);
        $this->load->view('stx_module/stx_module_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'module_nama' => $this->input->post('module_nama',TRUE),
		'module_group' => $this->input->post('module_group',TRUE),
		'module_status' => $this->input->post('module_status',TRUE),
		'module_userinput' => $this->input->post('module_userinput',TRUE),
		'module_tglinput' => $this->input->post('module_tglinput',TRUE),
	    );

            $this->Stx_module_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('stx_module'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Stx_module_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('stx_module/update_action'),
		'module_id' => set_value('module_id', $row->module_id),
		'module_nama' => set_value('module_nama', $row->module_nama),
		'module_group' => set_value('module_group', $row->module_group),
		'module_status' => set_value('module_status', $row->module_status),
		'module_userinput' => set_value('module_userinput', $row->module_userinput),
		'module_tglinput' => set_value('module_tglinput', $row->module_tglinput),
	    );
            $this->load->view('stx_module/stx_module_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('stx_module'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('module_id', TRUE));
        } else {
            $data = array(
		'module_nama' => $this->input->post('module_nama',TRUE),
		'module_group' => $this->input->post('module_group',TRUE),
		'module_status' => $this->input->post('module_status',TRUE),
		'module_userinput' => $this->input->post('module_userinput',TRUE),
		'module_tglinput' => $this->input->post('module_tglinput',TRUE),
	    );

            $this->Stx_module_model->update($this->input->post('module_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('stx_module'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Stx_module_model->get_by_id($id);

        if ($row) {
            $this->Stx_module_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('stx_module'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('stx_module'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('module_nama', 'module nama', 'trim|required');
	$this->form_validation->set_rules('module_group', 'module group', 'trim|required');
	$this->form_validation->set_rules('module_status', 'module status', 'trim|required');
	$this->form_validation->set_rules('module_userinput', 'module userinput', 'trim|required');
	$this->form_validation->set_rules('module_tglinput', 'module tglinput', 'trim|required');

	$this->form_validation->set_rules('module_id', 'module_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Stx_module.php */
/* Location: ./application/controllers/Stx_module.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-04 14:45:35 */
/* http://harviacode.com */
