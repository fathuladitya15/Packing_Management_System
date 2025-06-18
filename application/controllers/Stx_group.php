<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stx_group extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Stx_group_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'stx_group/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'stx_group/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'stx_group/index.html';
            $config['first_url'] = base_url() . 'stx_group/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Stx_group_model->total_rows($q);
        $stx_group = $this->Stx_group_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'stx_group_data' => $stx_group,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('stx_group/stx_group_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Stx_group_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_group' => $row->id_group,
		'group_name' => $row->group_name,
		'status' => $row->status,
		'admin' => $row->admin,
		'dasboard_type' => $row->dasboard_type,
		'group_client' => $row->group_client,
		'info1' => $row->info1,
		'info2' => $row->info2,
	    );
            $this->load->view('stx_group/stx_group_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('stx_group'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('stx_group/create_action'),
	    'id_group' => set_value('id_group'),
	    'group_name' => set_value('group_name'),
	    'status' => set_value('status'),
	    'admin' => set_value('admin'),
	    'dasboard_type' => set_value('dasboard_type'),
	    'group_client' => set_value('group_client'),
	    'info1' => set_value('info1'),
	    'info2' => set_value('info2'),
	);
        $this->load->view('stx_group/stx_group_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_group' => $this->input->post('id_group',TRUE),
		'group_name' => $this->input->post('group_name',TRUE),
		'status' => $this->input->post('status',TRUE),
		'admin' => $this->input->post('admin',TRUE),
		'dasboard_type' => $this->input->post('dasboard_type',TRUE),
		'group_client' => $this->input->post('group_client',TRUE),
		'info1' => $this->input->post('info1',TRUE),
		'info2' => $this->input->post('info2',TRUE),
	    );

            $this->Stx_group_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('stx_group'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Stx_group_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('stx_group/update_action'),
		'id_group' => set_value('id_group', $row->id_group),
		'group_name' => set_value('group_name', $row->group_name),
		'status' => set_value('status', $row->status),
		'admin' => set_value('admin', $row->admin),
		'dasboard_type' => set_value('dasboard_type', $row->dasboard_type),
		'group_client' => set_value('group_client', $row->group_client),
		'info1' => set_value('info1', $row->info1),
		'info2' => set_value('info2', $row->info2),
	    );
            $this->load->view('stx_group/stx_group_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('stx_group'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('', TRUE));
        } else {
            $data = array(
		'id_group' => $this->input->post('id_group',TRUE),
		'group_name' => $this->input->post('group_name',TRUE),
		'status' => $this->input->post('status',TRUE),
		'admin' => $this->input->post('admin',TRUE),
		'dasboard_type' => $this->input->post('dasboard_type',TRUE),
		'group_client' => $this->input->post('group_client',TRUE),
		'info1' => $this->input->post('info1',TRUE),
		'info2' => $this->input->post('info2',TRUE),
	    );

            $this->Stx_group_model->update($this->input->post('', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('stx_group'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Stx_group_model->get_by_id($id);

        if ($row) {
            $this->Stx_group_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('stx_group'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('stx_group'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_group', 'id group', 'trim|required');
	$this->form_validation->set_rules('group_name', 'group name', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');
	$this->form_validation->set_rules('admin', 'admin', 'trim|required');
	$this->form_validation->set_rules('dasboard_type', 'dasboard type', 'trim|required');
	$this->form_validation->set_rules('group_client', 'group client', 'trim|required');
	$this->form_validation->set_rules('info1', 'info1', 'trim|required');
	$this->form_validation->set_rules('info2', 'info2', 'trim|required');

	$this->form_validation->set_rules('', '', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Stx_group.php */
/* Location: ./application/controllers/Stx_group.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-04 14:45:35 */
/* http://harviacode.com */
