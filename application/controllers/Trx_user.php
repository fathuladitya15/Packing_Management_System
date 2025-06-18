<?php
 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trx_user extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Trx_user_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('m_general');
    }

    public function index()
    {
        $username=$this->session->userdata('username');
        $supervisor=$this->session->userdata('user_supervisor');
        $id_group=$this->session->userdata('user_akses_level');
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $priv=$this->m_general->get_privilage($id_group,'trx_user');      
        $x['add']='N';
        $x['update']='N';
        $x['delete']='N';
        $x['comment1']='N';
        $x['report']='N';
        foreach ($priv as $a) {
            $id_group=$id_group;
            $nav_url='trx_user';
            $add=$a['add1'];
            $update=$a['update1'];
            $delete=$a['delete1'];
            $plus=$a['comment1'];
            $report=$a['report1'];
        }
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'trx_user/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'trx_user/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'trx_user/index.html';
            $config['first_url'] = base_url() . 'trx_user/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $trx_user = $this->Trx_user_model->tampil_data($config['per_page'], $start, $q, $username,$id_group );
        $config['total_rows'] = $this->Trx_user_model->total_rows($q, $username, $id_group,$id_group);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'trx_user_data' => $trx_user,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'add' => $add,
            'update' => $update,
            'delete' => $delete,
            'report' => $report,
            'plus' => $plus,
            'priv_count' =>$this->m_general->cek_privilage($id_group,'trx_user'),
        );
        $x['content']=$this->load->view('trx_user/trx_user_list', $data,TRUE);
        $this->load->view('template',$x);
    }

    public function read($id) 

    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $row = $this->Trx_user_model->get_by_id($id);
        if ($row) {
            $data = array(
		'username' => $row->username,
		'id_group' => $row->id_group,
		'user_password' => $row->user_password,
		'user_fullname' => $row->user_fullname,
		'user_email' => $row->user_email,
		'user_telp' => $row->user_telp,
		'user_address' => $row->user_address,
		'user_status' => $row->user_status,
		'user_photo' => $row->user_photo,
		'info1' => $row->info1,
		'info2' => $row->info2,
		'info3' => $row->info3,
		'info4' => $row->info4,
	    );
            $x['content']=$this->load->view('trx_user/trx_user_read', $data,true);
            $this->load->view('template',$x);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_user'));
        }
    }

    public function create() 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $id_group=$this->session->userdata('user_akses_level');
        if ($id_group =='5') {
            $xgroup = $this->m_general->tampil_data_perfield1('stx_group','id_group','2');
            $ysupervisor = $this->m_general->tampil_data_perfield('view_user','id_group','5');
        }else{
            $xgroup = $this->m_general->tampil_data_perfield1('stx_group','status','Active');
            $ysupervisor = $this->m_general->tampil_data_perfield('view_user','user_status','Active');
        }

        $data = array(
            'group' => $xgroup,
            'supervisor' =>$ysupervisor,
            'button' => 'Create',
            'action' => site_url('trx_user/create_action'),
	    'username' => set_value('username'),
	    'id_group' => set_value('id_group'),
	    'user_password' => set_value('user_password'),
	    'user_fullname' => set_value('user_fullname'),
	    'user_email' => set_value('user_email'),
	    'user_telp' => set_value('user_telp'),
	    'user_address' => set_value('user_address'),
	    'user_status' => set_value('user_status'),
	    'user_photo' => set_value('user_photo'),
	    'info1' => set_value('info1'),
	    'info2' => set_value('info2'),
	    'info3' => set_value('info3'),
	    'info4' => set_value('info4'),
	);
       $x['content']=$this->load->view('trx_user/trx_user_form', $data,TRUE);
        $this->load->view('template',$x);
    }
    public function create_action() 
    {
        $username=$this->session->userdata('username');
        $supervisor=$this->session->userdata('user_supervisor');
        $id_group=$this->session->userdata('user_akses_level');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

        $xid_group = $this->input->post('id_group',TRUE);
        if ($xid_group == '5') {
            $group ='2';
        } elseif($xid_group == '3') {
            $group ='3';
        }else{
            $group = $this->input->post('id_group',TRUE);
        }
        }   


            $hash_1st=md5($this->input->post('user_password'));
            $key=substr($hash_1st, 5, 5);
            $new_hash=md5($key .$hash_1st .$key);


            $data = array(
                'username' =>$this->input->post('username',TRUE),
        		'id_group' => $group,
                'user_supervisor' => $this->input->post('user_supervisor',TRUE),
        		'user_password' =>$new_hash,
        		'user_fullname' => $this->input->post('user_fullname',TRUE),
        		'user_email' => $this->input->post('user_email',TRUE),
        		'user_telp' => $this->input->post('user_telp',TRUE),
        		'user_address' => $this->input->post('user_address',TRUE),
        		'user_status' => $this->input->post('user_status',TRUE),
	    );

            $this->Trx_user_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('trx_user'));
        }
    
    
    public function update($id) 
    {
        $username=$this->session->userdata('username');
        $supervisor=$this->session->userdata('user_supervisor');
        $id_group=$this->session->userdata('user_akses_level');

        if ($id_group =='5') {
            $xgroup = $this->m_general->tampil_data_perfield1('stx_group','id_group','2');
            $ysupervisor = $this->m_general->tampil_data_perfield('view_user','id_group','5');
        }else{
            $xgroup = $this->m_general->tampil_data_perfield1('stx_group','status','Active');
            $ysupervisor = $this->m_general->tampil_data_perfield('view_user','user_status','Active');
        }

        $row = $this->Trx_user_model->get_by_id($id);
        if ($row) {
            $data = array(
                'group' => $xgroup,
                'supervisor' =>$ysupervisor,
                'button' => 'Update',
                'action' => site_url('trx_user/update_action'),
            		'username2' => set_value('username', $row->username),
                    'user3' => $this->uri->segment(3),
            		'id_group' => set_value('id_group', $row->id_group),
                    'user_supervisor' => set_value('user_supervisor', $row->user_supervisor),
            		'user_password' => set_value('user_password', $row->user_password),
            		'user_fullname' => set_value('user_fullname', $row->user_fullname),
            		'user_email' => set_value('user_email', $row->user_email),
            		'user_telp' => set_value('user_telp', $row->user_telp),
            		'user_address' => set_value('user_address', $row->user_address),
            		'user_status' => set_value('user_status', $row->user_status),
            		'user_photo' => set_value('user_photo', $row->user_photo),
            		'info1' => set_value('info1', $row->info1),
            		'info2' => set_value('info2', $row->info2),
            		'info3' => set_value('info3', $row->info3),
            		'info4' => set_value('info4', $row->info4),
	    );
           $x['content']=$this->load->view('trx_user/trx_user_form', $data,true);
           $this->load->view('template',$x); 
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_user'));
        }
    }
    
    
    public function update_action() 
    {
        $username=$this->session->userdata('username');
        $supervisor=$this->session->userdata('user_supervisor');
        $id_group=$this->session->userdata('user_akses_level');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('username', TRUE));
        } else {


        if ($id_group == '5') {
            $data = array(
                'user_fullname' => $this->input->post('user_fullname',TRUE),
                'user_email' => $this->input->post('user_email',TRUE),
                'user_telp' => $this->input->post('user_telp',TRUE),
                'user_address' => $this->input->post('user_address',TRUE),
                'user_status' => $this->input->post('user_status',TRUE)    
                );
        } else {

            $data = array(
            'id_group' => $this->input->post('id_group',TRUE),
            'user_supervisor'=> $this->input->post('user_supervisor',TRUE),
            'user_fullname' => $this->input->post('user_fullname',TRUE),
            'user_email' => $this->input->post('user_email',TRUE),
            'user_telp' => $this->input->post('user_telp',TRUE),
            'user_address' => $this->input->post('user_address',TRUE),
            'user_status' => $this->input->post('user_status',TRUE)    
            );
        } 

            $this->Trx_user_model->update($this->input->post('username1', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('trx_user'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Trx_user_model->get_by_id($id);

        if ($row) {
            $this->Trx_user_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('trx_user'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_user'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_group', 'id group', 'trim');
	$this->form_validation->set_rules('user_password', 'user password', 'trim');
	$this->form_validation->set_rules('user_fullname', 'user fullname', 'trim');
	$this->form_validation->set_rules('user_email', 'user email', 'trim');
	$this->form_validation->set_rules('user_telp', 'user telp', 'trim');
	$this->form_validation->set_rules('user_address', 'user address', 'trim');
	$this->form_validation->set_rules('user_status', 'user status', 'trim');
	$this->form_validation->set_rules('user_photo', 'user photo', 'trim');
	$this->form_validation->set_rules('info1', 'info1', 'trim');
	$this->form_validation->set_rules('info2', 'info2', 'trim');
	$this->form_validation->set_rules('info3', 'info3', 'trim');
	$this->form_validation->set_rules('info4', 'info4', 'trim');

	$this->form_validation->set_rules('username', 'username', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Trx_user.php */
/* Location: ./application/controllers/Trx_user.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-04 14:45:35 */
/* http://harviacode.com */
