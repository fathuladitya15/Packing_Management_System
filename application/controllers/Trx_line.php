<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trx_line extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Trx_line_model');
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
        $priv=$this->m_general->get_privilage($id_group,'trx_line');      
        $x['add']='N';
        $x['update']='N';
        $x['delete']='N';
        $x['comment1']='N';
        $x['report']='N';
        foreach ($priv as $a) {
            $id_group=$id_group;
            $nav_url='trx_line';
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


        if (($q <> '') and ($s <> '') and ($t <> '')) {
            $config['base_url'] = base_url() . 'trx_line/index.html?q=' . urlencode($q) . '&t='. urlencode($t). '&s='. urlencode($s);
            $config['first_url'] = base_url() . 'trx_line/index.html?q=' . urlencode($q) . '&t='. urlencode($t) . '&s='. urlencode($s);
            $config['per_page'] = 0;

        } elseif (($s <> '') and ($t <> '') and ($q == '')){
            $config['base_url'] = base_url() . 'trx_line/index.html?t='. urlencode($t). '&s='. urlencode($s);;
            $config['first_url'] = base_url() . 'trx_line/index.html?t='. urlencode($t). '&s='. urlencode($s);;
            $config['per_page'] = 0;

        }else {
            $config['base_url'] = base_url() . 'trx_line/index.html';
            $config['first_url'] = base_url() . 'trx_line';
            $config['per_page'] = 25;
        }

        $config['page_query_string'] = TRUE;
        $trx_line = $this->Trx_line_model->tampil_data($config['per_page'], $start, $q, $username,$id_group,$s, $t );
        $config['total_rows'] = $this->Trx_line_model->total_rows($q, $username, $id_group,$s, $t);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'trx_line_data' => $trx_line,
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
            'priv_count' =>$this->m_general->cek_privilage($id_group,'trx_line'),
        );
        $x['content']=$this->load->view('trx_line/trx_line_list', $data,TRUE);
        $this->load->view('template',$x);
    }

    public function read($id) 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $row = $this->Trx_line_model->get_by_id($id);
        if ($row) {
            $data = array(
			'line_id' => $row->line_id,
			'line_karyawan_id' => $row->line_karyawan_id,
	        'karyawan_nama' => $row->karyawan_nama,
	        'line_master_id' => $row->line_master_id,
            'produk_id' => $row->produk_id,
	        'produk_nama' => $row->produk_nama,
			'line_nomor' => $row->line_nomor,
			'line_shift' => $row->line_shift,
			'line_box' => $row->line_box,
			'line_mulai' => $row->line_mulai,
			'line_selesai' => $row->line_selesai,
			'line_istirahat' => $row->line_istirahat,
			'line_totalmenit' => $row->line_totalmenit,
			'line_tgllaporan' => $row->line_tgllaporan,
	        'line_upah' => $row->line_upah,
			'line_userinput' => $row->line_userinput,
			'line_tglinput' => $row->line_tglinput,
	    );
            $x['content']=$this->load->view('trx_line/trx_line_read', $data,true);
            $this->load->view('template',$x);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_line'));
        }
    }

    public function create() 
    {

        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $usersupervisor=$this->session->userdata('user_supervisor');
        $data = array(
            'trxcode' => $this->m_general->getcode('trx_master','master_id','LIN-'),
            'produk' => $this->m_general->tampil_produkid('stx_produk','produk_status','Aktif', 'produk_usersupervisor',$usersupervisor),
            'shift' => $this->m_general->tampil_data_perfield1('stx_shift','shift_status','Aktif'),         
            'button' => 'Create',
            'action' => site_url('trx_line/create_action'),
    	    'line_id' => set_value('line_id'),
    	    'line_karyawan_id' => set_value('line_karyawan_id'),
    	    'line_produk_id' => set_value('line_produk_id'),
    	    'line_nomor' => set_value('line_nomor'),
    	    'line_shift' => set_value('line_shift'),
    	    'line_box' => set_value('line_box'),
    	    'line_mulai' => set_value('line_mulai'),
    	    'line_selesai' => set_value('line_selesai'),
    	    'line_istirahat' => set_value('line_istirahat'),
            'line_upah' => set_value('line_upah'),
    	    'line_totalmenit' => set_value('line_totalmenit'),
    	    'line_tgllaporan' => set_value('line_tgllaporan'),
    	    'line_userinput' => set_value('line_userinput'),
    	    'line_tglinput' => set_value('line_tglinput'),
	);
        $x['content']=$this->load->view('trx_line/trx_line_form', $data,TRUE);
        $this->load->view('template',$x);
    }
    
    public function create_action() 
    {
        
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $usersupervisor=$this->session->userdata('user_supervisor');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
        	$jumlahpekerja = count($_POST['count']);
            $codeid = $this->m_general->getcode('trx_master','master_id','LIN-');
            $result = $this->Trx_line_model->batchInsert($_POST,$codeid , $username, $usersupervisor); // Insert to trx_line table            
            $totaltime = $this->m_general->sumdata('trx_line','line_totalmenit','line_master_id',$codeid);
         
        $data = array(
                'master_id' => $codeid,
                'master_module_id' => '2',
                'master_produk_id' => $this->input->post('line_produk_id',TRUE),
                'master_shift' => $this->input->post('line_shift',TRUE),
                'master_box' => $this->input->post('line_box',TRUE),
                'master_line' => $this->input->post('line_nomor',TRUE),
                'master_jumlahteam' => $jumlahpekerja,
                'master_totalkerjamenit' =>$totaltime,
                'master_usersupervisor' => $usersupervisor,
                'master_tgllaporan' => $this->input->post('line_tgllaporan',TRUE),
                'master_userinput' => $username,
                'master_tglinput' => date('Y-m-d'),
            );     
     

            $this->Trx_line_model->insertMaster($data); // insert to trx_master              
           
            if($result){
                echo 1;
            }
            else{
                echo 0;
            }
            exit;
            redirect(site_url('trx_line/create'));
            
            $this->session->set_flashdata('message', 'Create Record Success');;
        }
    }

    public function plus() 
    {

        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $usersupervisor=$this->session->userdata('user_supervisor');
        $data = array(
            'acuan' => $this->m_general->tampil_data_perfield1('stx_acuan','acuan_status','Aktif'),
            'produk' => $this->m_general->tampil_produkid('stx_produk','produk_status','Aktif', 'produk_usersupervisor',$usersupervisor),
            'shift' => $this->m_general->tampil_data_perfield1('stx_shift','shift_status','Aktif'),
            'button' => 'Create',
            'action' => site_url('trx_line/create_plus'),
            'line_id' => set_value('line_id'),
            'line_master_id' => set_value('line_master_id'),
            'line_karyawan_id' => set_value('line_karyawan_id'),
            'line_produk_id' => set_value('line_produk_id'),
            'line_shift' => set_value('line_shift'),
            'line_nomor' => set_value('line_nomor'),
            'line_box' => set_value('line_box'),
            'line_mulai' => set_value('line_mulai'),
            'line_selesai' => set_value('line_selesai'),
            'line_istirahat' => set_value('line_istirahat'),
            'line_totalmenit' => set_value('line_totalmenit'),
            'line_upah' => set_value('line_upah'),
            'line_tgllaporan' => set_value('line_tgllaporan'),
    );
        $x['content']=$this->load->view('trx_line/trx_line_form_plus', $data,TRUE);
        $this->load->view('template',$x);
    }
    

    public function create_plus() 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $usersupervisor=$this->session->userdata('user_supervisor');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

        $code = $this->Trx_line_model->gettrxmaster($this->input->post('line_produk_id', TRUE),$this->input->post('line_tgllaporan', TRUE),$this->input->post('line_shift', TRUE), '2',$this->input->post('line_master_id', TRUE));

        if ($code){

        	 if (strtotime($this->input->post('line_mulai',TRUE)) > strtotime($this->input->post('line_selesai',TRUE))) {
                $tengah  ="24:00";
                $noll  ="00:00";
                $ztotalkerja = ((abs((strtotime($noll) - strtotime($this->input->post('line_selesai',TRUE))))/60) + ((strtotime($tengah) - strtotime($this->input->post('line_mulai',TRUE)))/60));
                $ztotal = $ztotalkerja - $this->input->post('line_istirahat',TRUE);
                }else {
                    $ztotalkerja = (strtotime($this->input->post('line_selesai',TRUE)) -  strtotime($this->input->post('line_mulai',TRUE)))/60;
                    $ztotal = $ztotalkerja - $this->input->post('line_istirahat',TRUE);
                }

	            $data = array(
	                    'line_karyawan_id' => $this->input->post('line_karyawan_id',TRUE),
	                    'line_produk_id' => $this->input->post('line_produk_id', TRUE),
	                    'line_master_id' => $this->input->post('line_master_id', TRUE),
	                    'line_shift' => $this->input->post('line_shift', TRUE),
	                    'line_nomor' => $this->input->post('line_nomor',TRUE),
	                    'line_box' => $this->input->post('line_box', TRUE),
	                    'line_mulai' => $this->input->post('line_mulai',TRUE),
	                    'line_selesai' => $this->input->post('line_selesai', TRUE),
	                    'line_istirahat' => $this->input->post('line_istirahat',TRUE),
	                    'line_totalmenit' =>  $ztotal,
	                    'line_usersupervisor' => $usersupervisor,
	                    'line_tgllaporan' => $this->input->post('line_tgllaporan', TRUE),
	                    'line_userinput' => $username,
	                    'line_tglinput' => date('Y-m-d'),
	            );

	            $this->Trx_line_model->insert($data);

	            $xdata = array(
	                    'masterdetail_karyawan_id'=>$this->input->post('line_karyawan_id',TRUE),               
	                    'masterdetail_master_id'=> $this->input->post('line_master_id', TRUE),
	                    'masterdetail_mulai'=>$this->input->post('line_mulai',TRUE),
	                    'masterdetail_selesai'=>$this->input->post('line_mulai',TRUE),
	                    'masterdetail_totalkerja'=> $ztotal,
	                    'masterdetail_box'=>$this->input->post('line_display', TRUE),
	                    'masterdetail_istirahat' => $this->input->post('line_istirahat',TRUE),
	                    'masterdetail_box'=>$data['line_box'],
	                    'masterdetail_usersupervisor'=>$usersupervisor,
	                    'masterdetail_userinput'=>$username,
	                    'masterdetail_tglinput'=>date('Y-m-d'),
	            );

	            $this->Trx_line_model->insertdetail($xdata);

                // Total Waktu & Master TRXMASTER
                $totalwaktu = $this->Trx_line_model->linesum('line_totalmenit', $this->input->post('line_produk_id',TRUE),$this->input->post('line_shift',TRUE),$this->input->post('line_tgllaporan',TRUE),$this->input->post('line_master_id',TRUE) );
                $totalteam = $this->Trx_line_model->linecount('line_karyawan_id', $this->input->post('line_produk_id',TRUE),$this->input->post('line_shift',TRUE),$this->input->post('line_tgllaporan',TRUE),$this->input->post('line_master_id',TRUE) );
        
                $zdata = array(
                    'master_totalkerjamenit' => $totalwaktu, 
                    'master_jumlahteam' => $totalteam, 
                    );
                    $this->Trx_line_model->updateMaster($this->input->post('line_master_id',TRUE), $zdata);
                    

                $messege= array(
                        'messege'=> "Data Berhasil Disimpan"
                    );
                $this->session->set_flashdata('success', $messege);
                redirect(site_url('trx_line/plus'));
            
            }else{

                $messege= array(
                    'messege'=> "Transaksi tidak ada , Silahkan input kembali"
                );
                $this->session->set_flashdata('message',$messege);
                redirect(site_url('trx_line/plus'));
            }
        }
    }


    
    public function update($id) 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $usersupervisor=$this->session->userdata('user_supervisor');
        $row = $this->Trx_line_model->get_by_id($id);

        if ($row) {
            $data = array(
                'produk' => $this->m_general->tampil_produkid('stx_produk','produk_status','Aktif', 'produk_usersupervisor',$usersupervisor),
                'shift' => $this->m_general->tampil_data_perfield1('stx_shift','shift_status','Aktif'),               
                'button' => 'Update',
                'action' => site_url('trx_line/update_action'),
            		'line_id' => set_value('line_id', $row->line_id),
            		'line_karyawan_id' => set_value('line_karyawan_id', $row->line_karyawan_id),
            		'line_produk_id' => set_value('line_produk_id', $row->line_produk_id),
            		'line_nomor' => set_value('line_nomor', $row->line_nomor),
                    'line_master_id' => set_value('line_nomor', $row->line_master_id),
            		'line_shift' => set_value('line_shift', $row->line_shift),
            		'line_box' => set_value('line_box', $row->line_box),
            		'line_mulai' => set_value('line_mulai', $row->line_mulai),
            		'line_selesai' => set_value('line_selesai', $row->line_selesai),
                    'line_upah' => set_value('line_upah', $row->line_upah),
            		'line_istirahat' => set_value('line_istirahat', $row->line_istirahat),
            		'line_totalmenit' => set_value('line_totalmenit', $row->line_totalmenit),
            		'line_tgllaporan' => set_value('line_tgllaporan', $row->line_tgllaporan),
            		'line_userinput' => set_value('line_userinput', $row->line_userinput),
            		'line_tglinput' => set_value('line_tglinput', $row->line_tglinput),
                    'codeid'=>$this->m_general->trxgetcode('masterdetail_id',set_value('line_karyawan_id', $row->line_karyawan_id),set_value('line_master_id', $row->line_master_id)),
	    );
            $x['content']=$this->load->view('trx_line/trx_line_form_update', $data,true);
            $this->load->view('template',$x); 
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_line'));
        }
    }
    
    public function update_action() 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('line_id', TRUE));
        } else {

        	if (strtotime($this->input->post('line_mulai',TRUE)) > strtotime($this->input->post('line_selesai',TRUE))) {
                $tengah  ="24:00";
                $noll  ="00:00";
                $ztotalkerja = ((abs((strtotime($noll) - strtotime($this->input->post('line_selesai',TRUE))))/60) + ((strtotime($tengah) - strtotime($this->input->post('line_mulai',TRUE)))/60));
                $ztotal = $ztotalkerja - $this->input->post('line_istirahat',TRUE);
                }else {
                    $ztotalkerja = (strtotime($this->input->post('line_selesai',TRUE)) -  strtotime($this->input->post('line_mulai',TRUE)))/60;
                    $ztotal = $ztotalkerja - $this->input->post('line_istirahat',TRUE);
            }


            $xdata = array(
    		'line_karyawan_id' => $this->input->post('line_karyawan_id',TRUE),
            'line_produk_id' => $this->input->post('line_produk_id',TRUE),
            'line_shift' => $this->input->post('line_shift',TRUE),
    		'line_box' => $this->input->post('line_box',TRUE),
            'line_nomor' => $this->input->post('line_nomor',TRUE),            
            'line_mulai' => $this->input->post('line_mulai',TRUE),
    		'line_selesai' => $this->input->post('line_selesai',TRUE),
    		'line_istirahat' => $this->input->post('line_istirahat',TRUE),
    		'line_totalmenit' => $ztotal,
	    );
            $this->Trx_line_model->update($this->input->post('line_id', TRUE), $xdata);

        $ydata = array(
            'masterdetail_karyawan_id' => $this->input->post('line_karyawan_id',TRUE),
            'masterdetail_box' => $this->input->post('line_box',TRUE),
            'masterdetail_mulai' => $this->input->post('line_mulai',TRUE),
            'masterdetail_selesai' => $this->input->post('line_selesai',TRUE),
            'masterdetail_istirahat' => $this->input->post('line_istirahat',TRUE),
            'masterdetail_totalkerja' => $ztotal,              
        ); 
        $this->Trx_line_model->updateDetail($this->input->post('codeid',TRUE), $ydata);           
        
        // Total waktu masterid
        $totalwaktu = $this->Trx_line_model->linesum('line_totalmenit', $this->input->post('line_produk_id',TRUE),$this->input->post('line_shift',TRUE),$this->input->post('line_tgllaporan',TRUE),$this->input->post('line_master_id',TRUE) );
        
        $zdata = array(
            'master_box' => $this->input->post('line_box',TRUE),
            'master_line' => $this->input->post('line_nomor',TRUE),
            'master_shift' => $this->input->post('line_shift',TRUE),
            'master_produk_id' => $this->input->post('line_produk_id',TRUE),
            'master_totalkerjamenit' => $totalwaktu, 
            );
            $this->Trx_line_model->updateMaster($this->input->post('line_master_id',TRUE), $zdata);
            

            $messege= array(
                    'messege'=> "Update Berhasil Disimpan"
                );
            $this->session->set_flashdata('success', $messege);

            redirect(site_url('trx_line'. '/index?q=' . urlencode($this->input->post('line_produk_id',TRUE)) . '&t='. urlencode($this->input->post('line_tgllaporan',TRUE)) . '&s='. urlencode($this->input->post('line_shift',TRUE))));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Trx_line_model->get_by_id($id);

        if ($row) {
        	$codeid = $this->m_general->trxgetcode('masterdetail_id',set_value('line_karyawan_id', $row->line_karyawan_id),set_value('line_master_id', $row->line_master_id ));

            $this->Trx_line_model->delete($id);
            $this->Trx_line_model->deleteDetail($codeid);

            //Recalculate Team & time working
            $totalwaktu = $this->Trx_line_model->linesum('line_totalmenit',set_value('line_produk_id', $row->line_produk_id),set_value('line_shift', $row->line_shift),set_value('line_tgllaporan', $row->line_tgllaporan),set_value('line_master_id', $row->line_master_id));
            $totalteam = $this->Trx_line_model->linecount('line_karyawan_id',set_value('line_produk_id', $row->line_produk_id),set_value('line_shift', $row->line_shift),set_value('line_tgllaporan', $row->line_tgllaporan),set_value('line_master_id', $row->line_master_id));
        
            if ($totalteam =='0'){
            	$this->Trx_line_model->deletemaster(set_value('line_master_id', $row->line_master_id));
            	
            }else {
            	$zdata = array(
                    'master_totalkerjamenit' => $totalwaktu, 
                    'master_jumlahteam' => $totalteam, 
                );          
            $this->Trx_line_model->updateMaster(set_value('line_master_id', $row->line_master_id), $zdata);

            }
            

            $messege= array(
                    'messege'=> "Delete Transaksi telah berhasil"
                );
            $this->session->set_flashdata('success', $messege);
            
            redirect(site_url('trx_line'. '/index?q=' . urlencode(set_value('line_produk_id', $row->line_produk_id)) . '&t='. urlencode(set_value('line_tgllaporan', $row->line_tgllaporan)) . '&s='. urlencode(set_value('line_shift', $row->line_shift))));

        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_line'));
        }
    }


    public function download(){
        $date_input=$this->input->post('tgl_daftar');
        $bln=array('01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'Mei','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December');

        $tgl=explode('-', $date_input);
        $x['tgl_awal']=$tgl[2] ." " .$bln[$tgl[1]] ." " .$tgl[0];
        $x['tgl_akhir']=$tgl[5] ." " .$bln[$tgl[4]] ." " .$tgl[3];
        $username=$this->session->userdata('username');
        $xid_group=$this->session->userdata('user_akses_level');
        if($this->session->userdata('admin')=='Y'){
            $x['data_line']=$this->Trx_line_model->download_line('',$date_input,'');
        }else{
            $x['data_line']=$this->Trx_line_model->download_line($username,$date_input, $xid_group);
        }
        
        $this->load->view('trx_line/excel_trx_line',$x);
    }



    public function _rules() 
    {
    	$this->form_validation->set_rules('line_karyawan_id', 'line karyawan id', 'trim');
    	$this->form_validation->set_rules('line_produk_id', 'line produk id', 'trim');
    	$this->form_validation->set_rules('line_nomor', 'line nomor', 'trim');
    	$this->form_validation->set_rules('line_shift', 'line shift', 'trim');
    	$this->form_validation->set_rules('line_box', 'line box', 'trim');
    	$this->form_validation->set_rules('line_mulai', 'line mulai', 'trim');
    	$this->form_validation->set_rules('line_selesai', 'line selesai', 'trim');
    	$this->form_validation->set_rules('line_istirahat', 'line istirahat', 'trim');
    	$this->form_validation->set_rules('line_totalmenit', 'line totalmenit', 'trim');
    	$this->form_validation->set_rules('line_tgllaporan', 'line tgllaporan', 'trim');
    	$this->form_validation->set_rules('line_userinput', 'line userinput', 'trim');
    	$this->form_validation->set_rules('line_tglinput', 'line tglinput', 'trim');
    	$this->form_validation->set_rules('line_id', 'line_id', 'trim');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "trx_line.xls";
        $judul = "trx_line";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
    	xlsWriteLabel($tablehead, $kolomhead++, "Line Karyawan Id");
    	xlsWriteLabel($tablehead, $kolomhead++, "Line Produk Id");
    	xlsWriteLabel($tablehead, $kolomhead++, "Line Nomor");
    	xlsWriteLabel($tablehead, $kolomhead++, "Line Shift");
    	xlsWriteLabel($tablehead, $kolomhead++, "Line Box");
    	xlsWriteLabel($tablehead, $kolomhead++, "Line Mulai");
    	xlsWriteLabel($tablehead, $kolomhead++, "Line Selesai");
    	xlsWriteLabel($tablehead, $kolomhead++, "Line Istirahat");
    	xlsWriteLabel($tablehead, $kolomhead++, "Line Totalmenit");
    	xlsWriteLabel($tablehead, $kolomhead++, "Line Tgllaporan");
    	xlsWriteLabel($tablehead, $kolomhead++, "Line Userinput");
    	xlsWriteLabel($tablehead, $kolomhead++, "Line Tglinput");

	foreach ($this->Trx_line_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->line_karyawan_id);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->line_produk_id);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->line_nomor);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->line_shift);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->line_box);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->line_mulai);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->line_selesai);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->line_istirahat);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->line_totalmenit);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->line_tgllaporan);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->line_userinput);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->line_tglinput);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=trx_line.doc");

        $data = array(
            'trx_line_data' => $this->Trx_line_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('trx_line/trx_line_doc',$data);
    }

}

/* End of file Trx_line.php */
/* Location: ./application/controllers/Trx_line.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-09 10:36:34 */
/* http://harviacode.com */
