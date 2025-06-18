<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stx_produk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Stx_produk_model');
        $this->load->library('form_validation');
        $this->load->model('m_users');
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
        $priv=$this->m_general->get_privilage($id_group,'stx_produk');      
        $x['add']='N';
        $x['update']='N';
        $x['delete']='N';
        $x['comment1']='N';
        $x['report']='N';
        foreach ($priv as $a) {
            $id_group=$id_group;
            $nav_url='stx_produk';
            $add=$a['add1'];
            $update=$a['update1'];
            $delete=$a['delete1'];
            $plus=$a['comment1'];
            $report=$a['report1'];
        }

        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'stx_produk/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'stx_produk/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'stx_produk/index.html';
            $config['first_url'] = base_url() . 'stx_produk';
        }

        $config['per_page'] = 25;
        $config['page_query_string'] = TRUE;
        $stx_produk = $this->Stx_produk_model->tampil_data($config['per_page'], $start, $q, $supervisor,$id_group );
        $config['total_rows'] = $this->Stx_produk_model->total_rows($q, $supervisor, $id_group,$id_group);
        

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'stx_produk_data' => $stx_produk,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'add' => $add,
            'update' => $update,
            'delete' => $delete,
            'report' => $report,
            'plus' => $plus,
            'priv_count' =>$this->m_general->cek_privilage($id_group,'stx_produk'),
        );

        $x['content']=$this->load->view('stx_produk/stx_produk_list', $data,TRUE);
        $this->load->view('template',$x);
    }

    public function read($id) 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $row = $this->Stx_produk_model->get_by_id($id);
        if ($row) {
            $data = array(
    		'produk_id' => $row->produk_id,
    		'produk_kategori_id' => $row->produk_kategori_id,
    		'produk_nama' => $row->produk_nama,
    		'produk_tipe' => $row->produk_tipe,
    		'produk_masterbox' => $row->produk_masterbox,
    		'produk_mesin' => $row->produk_mesin,
    		'produk_mbox' => $row->produk_mbox,
    		'produk_susun' => $row->produk_susun,
    		'produk_manual' => $row->produk_manual,
    		'produk_wip' => $row->produk_wip,
    		'produk_pp' => $row->produk_pp,
    		'produk_step_final' => $row->produk_step_final,
            'produk_usersupervisor' => $row->produk_usersupervisor,
    		'produk_userinput' => $row->produk_userinput,
    		'produk_tglinput' => $row->produk_tglinput,
    		'produk_status' => $row->produk_status,
	    );
            
            $x['content']=$this->load->view('stx_produk/stx_produk_read', $data,TRUE);
            $this->load->view('template',$x);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('stx_produk'));
        }
    }

    public function create() 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
         $data = array(
                'xsupervisor' =>$this->m_general->tampil_data_perfield('view_user','id_group','5'),  
                'acuan' => $this->m_general->tampil_data_perfield1('stx_acuan','acuan_status','Aktif'),
                'id_group' =>$this->session->userdata('user_akses_level'),
                'button' => 'Create',
                'action' => site_url('stx_produk/create_action'),
        	    'produk_id' => set_value('produk_id'),
        	    'produk_kategori_id' => set_value('produk_kategori_id'),
        	    'produk_nama' => set_value('produk_nama'),
        	    'produk_tipe' => set_value('produk_tipe'),
        	    'produk_masterbox' => set_value('produk_masterbox'),
        	    'produk_mesin' => set_value('produk_mesin'),
        	    'produk_mbox' => set_value('produk_mbox'),
        	    'produk_susun' => set_value('produk_susun'),
        	    'produk_manual' => set_value('produk_manual'),
        	    'produk_wip' => set_value('produk_wip'),
        	    'produk_pp' => set_value('produk_pp'),
        	    'produk_step_final' => set_value('produk_step_final'),
                'produk_usersupervisor' => set_value('produk_usersupervisor'),
        	    'produk_userinput' => set_value('produk_userinput'),
        	    'produk_tglinput' => set_value('produk_tglinput'),
        	    'produk_status' => set_value('produk_status'),
	);

        $x['content']=$this->load->view('stx_produk/stx_produk_form', $data,TRUE);
        $this->load->view('template',$x);

    }
    
    public function create_action() 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $supervisor=$this->session->userdata('user_supervisor');
        $id_group=$this->session->userdata('user_akses_level');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

        $row = $this->Stx_produk_model->get_by_id($this->input->post('produk_id',TRUE));
        if ($row) {
                $messege= array(
                    'messege'=> "ID Produk sudah Ada"
                );
                $this->session->set_flashdata('message',$messege);
                redirect(site_url('stx_produk/create'));

        }else{
            if($id_group =='5') {
                $xsupervisor = $supervisor;
            }else{
                $xsupervisor = $this->input->post('produk_usersupervisor',TRUE);

            }

            if($this->input->post('produk_status')=="Aktif") $xstatus='Aktif'; else $xstatus='Tidak Aktif';
            $data = array(

            'produk_id' => $this->input->post('produk_id',TRUE),        
    		'produk_kategori_id' => $this->input->post('produk_kategori_id',TRUE),
    		'produk_nama' => $this->input->post('produk_nama',TRUE),
    		'produk_tipe' => $this->input->post('produk_tipe',TRUE),
    		'produk_masterbox' => $this->input->post('produk_masterbox',TRUE),
    		'produk_mesin' => $this->input->post('produk_mesin',TRUE),
    		'produk_mbox' => $this->input->post('produk_mbox',TRUE),
    		'produk_susun' => $this->input->post('produk_susun',TRUE),
    		'produk_manual' => $this->input->post('produk_manual',TRUE),
    		'produk_wip' => $this->input->post('produk_wip',TRUE),
    		'produk_pp' => $this->input->post('produk_pp',TRUE),
    		'produk_step_final' => $this->input->post('produk_step_final',TRUE),
            'produk_usersupervisor' => $xsupervisor,
    		'produk_userinput' => $username,
    		'produk_tglinput' => date('Y-m-d'),
    		'produk_status' => $xstatus,
	    );

            $this->Stx_produk_model->insert($data);
            $messege= array(
                    'messege'=> "Data Berhasil Disimpan"
                );
            $this->session->set_flashdata('success', $messege);
            redirect(site_url('stx_produk'));
            }
        }
    }
    
    public function update($id) 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
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

        $row = $this->Stx_produk_model->get_by_id($id);

        if ($row) {
            $data = array(
                    'acuan' => $this->m_general->tampil_data_perfield1('stx_acuan','acuan_status','Aktif'),
                    'xsupervisor' =>$this->m_general->tampil_data_perfield('view_user','id_group','5'), 
                    'id_group' =>$this->session->userdata('user_akses_level'),
                    'button' => 'Update',
                    'action' => site_url('stx_produk/update_action'),
    		'produk_id' => set_value('produk_id', $row->produk_id),
    		'produk_kategori_id' => set_value('produk_kategori_id', $row->produk_kategori_id),
    		'produk_nama' => set_value('produk_nama', $row->produk_nama),
    		'produk_tipe' => set_value('produk_tipe', $row->produk_tipe),
    		'produk_masterbox' => set_value('produk_masterbox', $row->produk_masterbox),
    		'produk_mesin' => set_value('produk_mesin', $row->produk_mesin),
    		'produk_mbox' => set_value('produk_mbox', $row->produk_mbox),
    		'produk_susun' => set_value('produk_susun', $row->produk_susun),
    		'produk_manual' => set_value('produk_manual', $row->produk_manual),
    		'produk_wip' => set_value('produk_wip', $row->produk_wip),
    		'produk_pp' => set_value('produk_pp', $row->produk_pp),
    		'produk_step_final' => set_value('produk_step_final', $row->produk_step_final),
            'produk_usersupervisor' => set_value('produk_usersupervisor', $row->produk_usersupervisor),
    		'produk_userinput' => set_value('produk_userinput', $row->produk_userinput),
    		'produk_tglinput' => set_value('produk_tglinput', $row->produk_tglinput),
    		'produk_status' => set_value('produk_status', $row->produk_status),
	    );
            
        $x['content']=$this->load->view('stx_produk/stx_produk_form', $data,TRUE);
        $this->load->view('template',$x);
       
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('stx_produk'));
        }
    }
    
    public function update_action() 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $supervisor=$this->session->userdata('user_supervisor');
        $id_group=$this->session->userdata('user_akses_level');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('produk_id', TRUE));
        } else {
            
            if($this->input->post('produk_status')=="Aktif") $produk_status='Aktif'; else $produk_status='Tidak Aktif';
            if($id_group =='5') {
                $xsupervisor = $supervisor;
            }else{
                $xsupervisor = $this->input->post('produk_usersupervisor',TRUE);

            }
            $data = array(
                
    		'produk_kategori_id' => $this->input->post('produk_kategori_id',TRUE),
    		'produk_nama' => $this->input->post('produk_nama',TRUE),
    		'produk_tipe' => $this->input->post('produk_tipe',TRUE),
    		'produk_masterbox' => $this->input->post('produk_masterbox',TRUE),
    		'produk_mesin' => $this->input->post('produk_mesin',TRUE),
    		'produk_mbox' => $this->input->post('produk_mbox',TRUE),
    		'produk_susun' => $this->input->post('produk_susun',TRUE),
    		'produk_manual' => $this->input->post('produk_manual',TRUE),
    		'produk_wip' => $this->input->post('produk_wip',TRUE),
    		'produk_pp' => $this->input->post('produk_pp',TRUE),
    		'produk_step_final' => $this->input->post('produk_step_final',TRUE),
    		'produk_usersupervisor' => $xsupervisor,
		    'produk_status' => $produk_status,
	    );

            $this->Stx_produk_model->update($this->input->post('produk_id', TRUE), $data);
           $messege= array(
                    'messege'=> "Update Berhasil Disimpan"
                );
            $this->session->set_flashdata('success', $messege);
            redirect(site_url('stx_produk'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Stx_produk_model->get_by_id($id);

        if ($row) {
            $this->Stx_produk_model->delete($id);
            $messege= array(
                    'messege'=> "Delete Transaksi telah berhasil"
                );
            $this->session->set_flashdata('success', $messege);
            redirect(site_url('stx_produk'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('stx_produk'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('produk_kategori_id', 'produk kategori id', 'trim|required');
	$this->form_validation->set_rules('produk_nama', 'produk nama', 'trim|required');
	$this->form_validation->set_rules('produk_tipe', 'produk tipe', 'trim|required');
	$this->form_validation->set_rules('produk_masterbox', 'produk masterbox', 'trim|required');
	$this->form_validation->set_rules('produk_mesin', 'produk mesin', 'trim');
	$this->form_validation->set_rules('produk_mbox', 'produk mbox', 'trim');
	$this->form_validation->set_rules('produk_susun', 'produk susun', 'trim');
	$this->form_validation->set_rules('produk_manual', 'produk manual', 'trim');
	$this->form_validation->set_rules('produk_wip', 'produk wip', 'trim');
	$this->form_validation->set_rules('produk_pp', 'produk pp', 'trim');
	$this->form_validation->set_rules('produk_step_final', 'produk step final', 'trim');
	$this->form_validation->set_rules('produk_status', 'produk status','trim');
	$this->form_validation->set_rules('produk_id', 'produk_id', 'trim');
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
            $x['data_produk']=$this->Stx_produk_model->download_produk('',$date_input,'');
        }else{
            $x['data_produk']=$this->Stx_produk_model->download_produk($username,$date_input, $xid_group);
        }
        
        $this->load->view('stx_produk/excel_stx_produk',$x);
    }    

}

/* End of file Stx_produk.php */
/* Location: ./application/controllers/Stx_produk.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-04 14:45:35 */
/* http://harviacode.com */
