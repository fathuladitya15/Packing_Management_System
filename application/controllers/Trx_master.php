<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trx_master extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Trx_master_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('m_general');
        if(!$this->session->userdata('username')){
            redirect('akses/login');
            
        }
    }

    public function index()
    {
    	$username=$this->session->userdata('username');
        $supervisor=$this->session->userdata('user_supervisor');
        $id_group=$this->session->userdata('user_akses_level');
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $priv=$this->m_general->get_privilage($id_group,'trx_master');      
        $x['add']='N';
        $x['update']='N';
        $x['delete']='N';
        $x['comment1']='N';
        $x['report']='N';
        foreach ($priv as $a) {
            $id_group=$id_group;
            $nav_url='trx_master';
            $add=$a['add1'];
            $update=$a['update1'];
            $delete=$a['delete1'];
            $plus=$a['comment1'];
            $report=$a['report1'];
        }
        $q = urldecode($this->input->get('q', TRUE));
        $s = urldecode($this->input->get('s', TRUE));
        $t = urldecode($this->input->get('t', TRUE));
        $start = intval($this->input->get('start'));


        if (($q <> '') && ($s <> '') && ($t <> '')) {
            $config['base_url'] = base_url() . 'trx_master/index.html?q=' . urlencode($q) . '&t='. urlencode($t). '&s='. urlencode($s);
            $config['first_url'] = base_url() . 'trx_master/index.html?q=' . urlencode($q) . '&t='. urlencode($t) . '&s='. urlencode($s);
            $config['per_page'] = 0;

        } elseif (($s <> '')  && ($t <> '')  && ($q == '')){
            $config['base_url'] = base_url() . 'trx_master/index.html?t='. urlencode($t). '&s='. urlencode($s);;
            $config['first_url'] = base_url() . 'trx_master/index.html?t='. urlencode($t). '&s='. urlencode($s);;
            $config['per_page'] = 0;

        }else {
            $config['base_url'] = base_url() . 'trx_master/index.html';
            $config['first_url'] = base_url() . 'trx_master';
            $config['per_page'] = 25;
        }


        
        $config['page_query_string'] = TRUE;
        $trx_master = $this->Trx_master_model->tampil_data($config['per_page'], $start, $q, $username,$id_group ,$s , $t);
        $config['total_rows'] = $this->Trx_master_model->total_rows($q, $username,$id_group ,$s , $t);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'trx_master_data' => $trx_master,
            'q' => $q,
            's' => $s,
            't' => $t,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'add' => $add,
            'update' => $update,
            'delete' => $delete,
            'report' => $report,
            'plus' => $plus,
            'priv_count' =>$this->m_general->cek_privilage($id_group,'trx_master'),
        );
        $x['content']=$this->load->view('trx_master/trx_master_list', $data,TRUE);
        $this->load->view('template',$x);
    }

    public function read($id) 
    {
    	$username=$this->session->userdata('username');
        $supervisor=$this->session->userdata('user_supervisor');
        $id_group=$this->session->userdata('user_akses_level');
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $row = $this->Trx_master_model->get_by_id($id);
        if ($row) {
            $data = array(
		'master_id' => $row->master_id,
        'karyawan_id' => $row->karyawan_id,
        'karyawan_nama' => $row->karyawan_nama,
        'produk_id' => $row->produk_id,
        'produk_nama' => $row->produk_nama,
		'master_module_id' => $row->master_module_id,
		'master_acuan_id' => $row->master_acuan_id,

		'master_line' => $row->master_line,
		'master_tgllaporan' => $row->master_tgllaporan,
		'master_shift' => $row->master_shift,
		'master_nomesin' => $row->master_nomesin,
		'master_jumlahteam' => $row->master_jumlahteam,
		'master_display' => $row->master_display,
		'master_box' => $row->master_box,
		'master_istirahat' => $row->master_istirahat,
		'master_totalkerjamenit' => $row->master_totalkerjamenit,
		'master_totalkerjajam' => $row->master_totalkerjajam,
		'master_karu' => $row->master_karu,
		'master_stfg' => $row->master_stfg,
		'master_bayarstfg' => $row->master_bayarstfg,
		'master_acuanmesin' => $row->master_acuanmesin,
		'master_acuanline' => $row->master_acuanline,
		'master_userinput' => $row->master_userinput,
		'master_tglinput' => $row->master_tglinput,
	    );

        $x['content']=$this->load->view('trx_master/trx_master_read', $data,true);
            $this->load->view('template',$x);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_master'));
        }
    }



    public function create() 
    {
    	$username=$this->session->userdata('username');
        $supervisor=$this->session->userdata('user_supervisor');
        $id_group=$this->session->userdata('user_akses_level');
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $data = array(
            'button' => 'Create',
            'action' => site_url('trx_master/create_action'),
	    'master_id' => set_value('master_id'),
	    'master_module_id' => set_value('master_module_id'),
	    'master_acuan_id' => set_value('master_acuan_id'),
	    'master_produk_id' => set_value('master_produk_id'),
	    'master_line' => set_value('master_line'),
	    'master_tgllaporan' => set_value('master_tgllaporan'),
	    'master_shift' => set_value('master_shift'),
	    'master_nomesin' => set_value('master_nomesin'),
	    'master_jumlahteam' => set_value('master_jumlahteam'),
	    'master_display' => set_value('master_display'),
	    'master_box' => set_value('master_box'),
	    'master_istirahat' => set_value('master_istirahat'),
	    'master_totalkerjamenit' => set_value('master_totalkerjamenit'),
	    'master_totalkerjajam' => set_value('master_totalkerjajam'),
	    'master_karu' => set_value('master_karu'),
	    'master_stfg' => set_value('master_stfg'),
	    'master_bayarstfg' => set_value('master_bayarstfg'),
	    'master_acuanmesin' => set_value('master_acuanmesin'),
	    'master_acuanline' => set_value('master_acuanline'),
	    'master_userinput' => set_value('master_userinput'),
	    'master_tglinput' => set_value('master_tglinput'),
	);
        $this->load->view('trx_master/trx_master_form', $data);
    }
    
    public function create_action() 
    {
    	$username=$this->session->userdata('username');
        $supervisor=$this->session->userdata('user_supervisor');
        $id_group=$this->session->userdata('user_akses_level');
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'master_module_id' => $this->input->post('master_module_id',TRUE),
		'master_acuan_id' => $this->input->post('master_acuan_id',TRUE),
		'master_produk_id' => $this->input->post('master_produk_id',TRUE),
		'master_line' => $this->input->post('master_line',TRUE),
		'master_tgllaporan' => $this->input->post('master_tgllaporan',TRUE),
		'master_shift' => $this->input->post('master_shift',TRUE),
		'master_nomesin' => $this->input->post('master_nomesin',TRUE),
		'master_jumlahteam' => $this->input->post('master_jumlahteam',TRUE),
		'master_display' => $this->input->post('master_display',TRUE),
		'master_box' => $this->input->post('master_box',TRUE),
		'master_istirahat' => $this->input->post('master_istirahat',TRUE),
		'master_totalkerjamenit' => $this->input->post('master_totalkerjamenit',TRUE),
		'master_totalkerjajam' => $this->input->post('master_totalkerjajam',TRUE),
		'master_karu' => $this->input->post('master_karu',TRUE),
		'master_stfg' => $this->input->post('master_stfg',TRUE),
		'master_bayarstfg' => $this->input->post('master_bayarstfg',TRUE),
		'master_acuanmesin' => $this->input->post('master_acuanmesin',TRUE),
		'master_acuanline' => $this->input->post('master_acuanline',TRUE),
		'master_userinput' => $this->input->post('master_userinput',TRUE),
		'master_tglinput' => $this->input->post('master_tglinput',TRUE),
	    );

            $this->Trx_master_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('trx_master'));
        }
    }
    
    public function update($id) 
    {
    	$username=$this->session->userdata('username');
        $supervisor=$this->session->userdata('user_supervisor');
        $id_group=$this->session->userdata('user_akses_level');
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $row = $this->Trx_master_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('trx_master/update_action'),
		'master_id' => set_value('master_id', $row->master_id),
		'master_module_id' => set_value('master_module_id', $row->master_module_id),
		'master_acuan_id' => set_value('master_acuan_id', $row->master_acuan_id),
		'master_produk_id' => set_value('master_produk_id', $row->master_produk_id),
		'master_line' => set_value('master_line', $row->master_line),
		'master_tgllaporan' => set_value('master_tgllaporan', $row->master_tgllaporan),
		'master_shift' => set_value('master_shift', $row->master_shift),
		'master_nomesin' => set_value('master_nomesin', $row->master_nomesin),
		'master_jumlahteam' => set_value('master_jumlahteam', $row->master_jumlahteam),
		'master_display' => set_value('master_display', $row->master_display),
		'master_box' => set_value('master_box', $row->master_box),
		'master_istirahat' => set_value('master_istirahat', $row->master_istirahat),
		'master_totalkerjamenit' => set_value('master_totalkerjamenit', $row->master_totalkerjamenit),
		'master_totalkerjajam' => set_value('master_totalkerjajam', $row->master_totalkerjajam),
		'master_karu' => set_value('master_karu', $row->master_karu),
		'master_stfg' => set_value('master_stfg', $row->master_stfg),
		'master_bayarstfg' => set_value('master_bayarstfg', $row->master_bayarstfg),
		'master_acuanmesin' => set_value('master_acuanmesin', $row->master_acuanmesin),
		'master_acuanline' => set_value('master_acuanline', $row->master_acuanline),
		'master_userinput' => set_value('master_userinput', $row->master_userinput),
		'master_tglinput' => set_value('master_tglinput', $row->master_tglinput),
	    );
            $this->load->view('trx_master/trx_master_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_master'));
        }
    }
    
    public function update_action() 
    {
    	$username=$this->session->userdata('username');
        $supervisor=$this->session->userdata('user_supervisor');
        $id_group=$this->session->userdata('user_akses_level');
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('master_id', TRUE));
        } else {
            $data = array(
		'master_module_id' => $this->input->post('master_module_id',TRUE),
		'master_acuan_id' => $this->input->post('master_acuan_id',TRUE),
		'master_produk_id' => $this->input->post('master_produk_id',TRUE),
		'master_line' => $this->input->post('master_line',TRUE),
		'master_tgllaporan' => $this->input->post('master_tgllaporan',TRUE),
		'master_shift' => $this->input->post('master_shift',TRUE),
		'master_nomesin' => $this->input->post('master_nomesin',TRUE),
		'master_jumlahteam' => $this->input->post('master_jumlahteam',TRUE),
		'master_display' => $this->input->post('master_display',TRUE),
		'master_box' => $this->input->post('master_box',TRUE),
		'master_istirahat' => $this->input->post('master_istirahat',TRUE),
		'master_totalkerjamenit' => $this->input->post('master_totalkerjamenit',TRUE),
		'master_totalkerjajam' => $this->input->post('master_totalkerjajam',TRUE),
		'master_karu' => $this->input->post('master_karu',TRUE),
		'master_stfg' => $this->input->post('master_stfg',TRUE),
		'master_bayarstfg' => $this->input->post('master_bayarstfg',TRUE),
		'master_acuanmesin' => $this->input->post('master_acuanmesin',TRUE),
		'master_acuanline' => $this->input->post('master_acuanline',TRUE),
		'master_userinput' => $this->input->post('master_userinput',TRUE),
		'master_tglinput' => $this->input->post('master_tglinput',TRUE),
	    );

            $this->Trx_master_model->update($this->input->post('master_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('trx_master'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Trx_master_model->get_by_id($id);

        if ($row) {
            $this->Trx_master_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('trx_master'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_master'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('master_module_id', 'master module id', 'trim|required');
	$this->form_validation->set_rules('master_acuan_id', 'master acuan id', 'trim|required');
	$this->form_validation->set_rules('master_produk_id', 'master produk id', 'trim|required');
	$this->form_validation->set_rules('master_line', 'master line', 'trim|required');
	$this->form_validation->set_rules('master_tgllaporan', 'master tgllaporan', 'trim|required');
	$this->form_validation->set_rules('master_shift', 'master shift', 'trim|required');
	$this->form_validation->set_rules('master_nomesin', 'master nomesin', 'trim|required');
	$this->form_validation->set_rules('master_jumlahteam', 'master jumlahteam', 'trim|required');
	$this->form_validation->set_rules('master_display', 'master display', 'trim|required');
	$this->form_validation->set_rules('master_box', 'master box', 'trim|required');
	$this->form_validation->set_rules('master_istirahat', 'master istirahat', 'trim|required');
	$this->form_validation->set_rules('master_totalkerjamenit', 'master totalkerjamenit', 'trim|required');
	$this->form_validation->set_rules('master_totalkerjajam', 'master totalkerjajam', 'trim|required');
	$this->form_validation->set_rules('master_karu', 'master karu', 'trim|required');
	$this->form_validation->set_rules('master_stfg', 'master stfg', 'trim|required');
	$this->form_validation->set_rules('master_bayarstfg', 'master bayarstfg', 'trim|required|numeric');
	$this->form_validation->set_rules('master_acuanmesin', 'master acuanmesin', 'trim|required|numeric');
	$this->form_validation->set_rules('master_acuanline', 'master acuanline', 'trim|required|numeric');
	$this->form_validation->set_rules('master_userinput', 'master userinput', 'trim|required');
	$this->form_validation->set_rules('master_tglinput', 'master tglinput', 'trim|required');

	$this->form_validation->set_rules('master_id', 'master_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }


    public function download()
    {
        $date_input=$this->input->post('tgl_daftar');
        $bln=array('01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'Mei','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December');

        $tgl=explode('-', $date_input);
        $x['tgl_awal']=$tgl[2] ." " .$bln[$tgl[1]] ." " .$tgl[0];
        $x['tgl_akhir']=$tgl[5] ." " .$bln[$tgl[4]] ." " .$tgl[3];
        $username=$this->session->userdata('username');
        $xid_group=$this->session->userdata('user_akses_level');
        if($this->session->userdata('admin')=='Y'){
            $x['data_master']=$this->Trx_master_model->download_master('',$date_input,'');
        }else{
            $x['data_master']=$this->Trx_master_model->download_master($username,$date_input, $xid_group);
        }
        
        $this->load->view('trx_master/excel_trx_master',$x);
    }

}

/* End of file Trx_master.php */
/* Location: ./application/controllers/Trx_master.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-04 14:45:35 */
/* http://harviacode.com */
