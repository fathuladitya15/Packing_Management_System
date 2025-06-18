<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stx_nav_group extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Stx_nav_group_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'stx_nav_group/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'stx_nav_group/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'stx_nav_group/index.html';
            $config['first_url'] = base_url() . 'stx_nav_group/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Stx_nav_group_model->total_rows($q);
        $stx_nav_group = $this->Stx_nav_group_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'stx_nav_group_data' => $stx_nav_group,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('stx_nav_group/stx_nav_group_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Stx_nav_group_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_nav_group' => $row->id_nav_group,
		'id_nav' => $row->id_nav,
		'id_group' => $row->id_group,
		'add1' => $row->add1,
		'update1' => $row->update1,
		'delete1' => $row->delete1,
		'comment1' => $row->comment1,
		'report1' => $row->report1,
	    );
            $this->load->view('stx_nav_group/stx_nav_group_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('stx_nav_group'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('stx_nav_group/create_action'),
	    'id_nav_group' => set_value('id_nav_group'),
	    'id_nav' => set_value('id_nav'),
	    'id_group' => set_value('id_group'),
	    'add1' => set_value('add1'),
	    'update1' => set_value('update1'),
	    'delete1' => set_value('delete1'),
	    'comment1' => set_value('comment1'),
	    'report1' => set_value('report1'),
	);
        $this->load->view('stx_nav_group/stx_nav_group_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_nav' => $this->input->post('id_nav',TRUE),
		'id_group' => $this->input->post('id_group',TRUE),
		'add1' => $this->input->post('add1',TRUE),
		'update1' => $this->input->post('update1',TRUE),
		'delete1' => $this->input->post('delete1',TRUE),
		'comment1' => $this->input->post('comment1',TRUE),
		'report1' => $this->input->post('report1',TRUE),
	    );

            $this->Stx_nav_group_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('stx_nav_group'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Stx_nav_group_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('stx_nav_group/update_action'),
		'id_nav_group' => set_value('id_nav_group', $row->id_nav_group),
		'id_nav' => set_value('id_nav', $row->id_nav),
		'id_group' => set_value('id_group', $row->id_group),
		'add1' => set_value('add1', $row->add1),
		'update1' => set_value('update1', $row->update1),
		'delete1' => set_value('delete1', $row->delete1),
		'comment1' => set_value('comment1', $row->comment1),
		'report1' => set_value('report1', $row->report1),
	    );
            $this->load->view('stx_nav_group/stx_nav_group_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('stx_nav_group'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_nav_group', TRUE));
        } else {
            $data = array(
		'id_nav' => $this->input->post('id_nav',TRUE),
		'id_group' => $this->input->post('id_group',TRUE),
		'add1' => $this->input->post('add1',TRUE),
		'update1' => $this->input->post('update1',TRUE),
		'delete1' => $this->input->post('delete1',TRUE),
		'comment1' => $this->input->post('comment1',TRUE),
		'report1' => $this->input->post('report1',TRUE),
	    );

            $this->Stx_nav_group_model->update($this->input->post('id_nav_group', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('stx_nav_group'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Stx_nav_group_model->get_by_id($id);

        if ($row) {
            $this->Stx_nav_group_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('stx_nav_group'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('stx_nav_group'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_nav', 'id nav', 'trim|required');
	$this->form_validation->set_rules('id_group', 'id group', 'trim|required');
	$this->form_validation->set_rules('add1', 'add1', 'trim|required');
	$this->form_validation->set_rules('update1', 'update1', 'trim|required');
	$this->form_validation->set_rules('delete1', 'delete1', 'trim|required');
	$this->form_validation->set_rules('comment1', 'comment1', 'trim|required');
	$this->form_validation->set_rules('report1', 'report1', 'trim|required');

	$this->form_validation->set_rules('id_nav_group', 'id_nav_group', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Stx_nav_group.php */
/* Location: ./application/controllers/Stx_nav_group.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-04 14:45:35 */
/* http://harviacode.com */
