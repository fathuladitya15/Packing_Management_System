<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stx_nav extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Stx_nav_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'stx_nav/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'stx_nav/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'stx_nav/index.html';
            $config['first_url'] = base_url() . 'stx_nav/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Stx_nav_model->total_rows($q);
        $stx_nav = $this->Stx_nav_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'stx_nav_data' => $stx_nav,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('stx_nav/stx_nav_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Stx_nav_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_nav' => $row->id_nav,
		'nav_title' => $row->nav_title,
		'nav_url' => $row->nav_url,
		'parent_idx' => $row->parent_idx,
		'child_idx' => $row->child_idx,
		'status' => $row->status,
		'fit_add' => $row->fit_add,
		'fit_update' => $row->fit_update,
		'fit_delete' => $row->fit_delete,
		'fit_comment' => $row->fit_comment,
		'fit_report' => $row->fit_report,
		'info1' => $row->info1,
		'info2' => $row->info2,
	    );
            $this->load->view('stx_nav/stx_nav_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('stx_nav'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('stx_nav/create_action'),
	    'id_nav' => set_value('id_nav'),
	    'nav_title' => set_value('nav_title'),
	    'nav_url' => set_value('nav_url'),
	    'parent_idx' => set_value('parent_idx'),
	    'child_idx' => set_value('child_idx'),
	    'status' => set_value('status'),
	    'fit_add' => set_value('fit_add'),
	    'fit_update' => set_value('fit_update'),
	    'fit_delete' => set_value('fit_delete'),
	    'fit_comment' => set_value('fit_comment'),
	    'fit_report' => set_value('fit_report'),
	    'info1' => set_value('info1'),
	    'info2' => set_value('info2'),
	);
        $this->load->view('stx_nav/stx_nav_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nav_title' => $this->input->post('nav_title',TRUE),
		'nav_url' => $this->input->post('nav_url',TRUE),
		'parent_idx' => $this->input->post('parent_idx',TRUE),
		'child_idx' => $this->input->post('child_idx',TRUE),
		'status' => $this->input->post('status',TRUE),
		'fit_add' => $this->input->post('fit_add',TRUE),
		'fit_update' => $this->input->post('fit_update',TRUE),
		'fit_delete' => $this->input->post('fit_delete',TRUE),
		'fit_comment' => $this->input->post('fit_comment',TRUE),
		'fit_report' => $this->input->post('fit_report',TRUE),
		'info1' => $this->input->post('info1',TRUE),
		'info2' => $this->input->post('info2',TRUE),
	    );

            $this->Stx_nav_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('stx_nav'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Stx_nav_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('stx_nav/update_action'),
		'id_nav' => set_value('id_nav', $row->id_nav),
		'nav_title' => set_value('nav_title', $row->nav_title),
		'nav_url' => set_value('nav_url', $row->nav_url),
		'parent_idx' => set_value('parent_idx', $row->parent_idx),
		'child_idx' => set_value('child_idx', $row->child_idx),
		'status' => set_value('status', $row->status),
		'fit_add' => set_value('fit_add', $row->fit_add),
		'fit_update' => set_value('fit_update', $row->fit_update),
		'fit_delete' => set_value('fit_delete', $row->fit_delete),
		'fit_comment' => set_value('fit_comment', $row->fit_comment),
		'fit_report' => set_value('fit_report', $row->fit_report),
		'info1' => set_value('info1', $row->info1),
		'info2' => set_value('info2', $row->info2),
	    );
            $this->load->view('stx_nav/stx_nav_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('stx_nav'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_nav', TRUE));
        } else {
            $data = array(
		'nav_title' => $this->input->post('nav_title',TRUE),
		'nav_url' => $this->input->post('nav_url',TRUE),
		'parent_idx' => $this->input->post('parent_idx',TRUE),
		'child_idx' => $this->input->post('child_idx',TRUE),
		'status' => $this->input->post('status',TRUE),
		'fit_add' => $this->input->post('fit_add',TRUE),
		'fit_update' => $this->input->post('fit_update',TRUE),
		'fit_delete' => $this->input->post('fit_delete',TRUE),
		'fit_comment' => $this->input->post('fit_comment',TRUE),
		'fit_report' => $this->input->post('fit_report',TRUE),
		'info1' => $this->input->post('info1',TRUE),
		'info2' => $this->input->post('info2',TRUE),
	    );

            $this->Stx_nav_model->update($this->input->post('id_nav', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('stx_nav'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Stx_nav_model->get_by_id($id);

        if ($row) {
            $this->Stx_nav_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('stx_nav'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('stx_nav'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nav_title', 'nav title', 'trim|required');
	$this->form_validation->set_rules('nav_url', 'nav url', 'trim|required');
	$this->form_validation->set_rules('parent_idx', 'parent idx', 'trim|required');
	$this->form_validation->set_rules('child_idx', 'child idx', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');
	$this->form_validation->set_rules('fit_add', 'fit add', 'trim|required');
	$this->form_validation->set_rules('fit_update', 'fit update', 'trim|required');
	$this->form_validation->set_rules('fit_delete', 'fit delete', 'trim|required');
	$this->form_validation->set_rules('fit_comment', 'fit comment', 'trim|required');
	$this->form_validation->set_rules('fit_report', 'fit report', 'trim|required');
	$this->form_validation->set_rules('info1', 'info1', 'trim|required');
	$this->form_validation->set_rules('info2', 'info2', 'trim|required');

	$this->form_validation->set_rules('id_nav', 'id_nav', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Stx_nav.php */
/* Location: ./application/controllers/Stx_nav.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-04 14:45:35 */
/* http://harviacode.com */
