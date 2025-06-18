<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trx_mesin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Trx_mesin_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('m_general');
        //$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
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
        $priv=$this->m_general->get_privilage($id_group,'trx_mesin');      
        $x['add']='N';
        $x['update']='N';
        $x['delete']='N';
        $x['comment1']='N';
        $x['report']='N';
        foreach ($priv as $a) {
            $id_group=$id_group;
            $nav_url='trx_mesin';
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
            $config['base_url'] = base_url() . 'trx_mesin/index.html?q=' . urlencode($q) . '&t='. urlencode($t). '&s='. urlencode($s);
            $config['first_url'] = base_url() . 'trx_mesin/index.html?q=' . urlencode($q) . '&t='. urlencode($t) . '&s='. urlencode($s);
            $config['per_page'] = 0;

        } elseif (($s <> '') and ($t <> '') and ($q == '')){
            $config['base_url'] = base_url() . 'trx_mesin/index.html?t='. urlencode($t). '&s='. urlencode($s);;
            $config['first_url'] = base_url() . 'trx_mesin/index.html?t='. urlencode($t). '&s='. urlencode($s);;
            $config['per_page'] = 0;

        }else {
            $config['base_url'] = base_url() . 'trx_mesin/index.html';
            $config['first_url'] = base_url() . 'trx_mesin';
            $config['per_page'] = 25;
        }


        $config['page_query_string'] = TRUE;      
        $trx_mesin = $this->Trx_mesin_model->tampil_data($config['per_page'], $start, $q, $username,$id_group,$s, $t );
        $config['total_rows'] = $this->Trx_mesin_model->total_rows($q, $username, $id_group,$s, $t);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'trx_mesin_data' => $trx_mesin,
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
            'priv_count' =>$this->m_general->cek_privilage($id_group,'trx_mesin'),

        );
        $x['content']=$this->load->view('trx_mesin/trx_mesin_list', $data,TRUE);
        $this->load->view('template',$x);
    }

    public function read($id) 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $row = $this->Trx_mesin_model->get_by_id($id);
        if ($row) {
            $data = array(
    		'mesin_id' => $row->mesin_id,
    		'mesin_karyawan_id' => $row->mesin_karyawan_id,
    		'mesin_produk_id' => $row->mesin_produk_id,
            'produk_id' => $row->produk_id,
            'karyawan_nama' => $row->karyawan_nama,
            'produk_nama' => $row->produk_nama,
            'mesin_master_id' => $row->mesin_master_id,
    		'mesin_acuan_id' => $row->mesin_acuan_id,
    		'mesin_line' => $row->mesin_line,
    		'mesin_shift' => $row->mesin_shift,
    		'mesin_mesin' => $row->mesin_mesin,
    		'mesin_display' => $row->mesin_display,
    		'mesin_mulai' => $row->mesin_mulai,
    		'mesin_selesai' => $row->mesin_selesai,
    		'mesin_istirahat' => $row->mesin_istirahat,
    		'mesin_totalmenit' => $row->mesin_totalmenit,
            'mesin_upah' => $row->mesin_upah,
    		'mesin_tgllaporan' => $row->mesin_tgllaporan,
    		'mesin_userinput' => $row->mesin_userinput,
    		'mesin_tglinput' => $row->mesin_tglinput,
	    );
            $x['content']=$this->load->view('trx_mesin/trx_mesin_read', $data,true);
            $this->load->view('template',$x);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_mesin'));
        }
    }

    public function create() 
    {

        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $usersupervisor=$this->session->userdata('user_supervisor');
        $id_group=$this->session->userdata('user_akses_level');
        $data = array(
            'acuan' => $this->m_general->tampil_data_perfield1('stx_acuan','acuan_status','Aktif'),
            'produk' => $this->m_general->tampil_produkid('stx_produk','produk_status','Aktif', 'produk_usersupervisor',$usersupervisor),
            'shift' => $this->m_general->tampil_data_perfield1('stx_shift','shift_status','Aktif'),
            'button' => 'Create',
            'action' => site_url('trx_mesin/create_action'),
    	    'mesin_id' => set_value('mesin_id'),
    	    'mesin_karyawan_id' => set_value('mesin_karyawan_id'),
    	    'mesin_produk_id' => set_value('mesin_produk_id'),
    	    'mesin_acuan_id' => set_value('mesin_acuan_id'),
    	    'mesin_line' => set_value('mesin_line'),
    	    'mesin_shift' => set_value('mesin_shift'),
    	    'mesin_mesin' => set_value('mesin_mesin'),
    	    'mesin_display' => set_value('mesin_display'),
    	    'mesin_mulai' => set_value('mesin_mulai'),
    	    'mesin_selesai' => set_value('mesin_selesai'),
    	    'mesin_istirahat' => set_value('mesin_istirahat'),
    	    'mesin_totalmenit' => set_value('mesin_totalmenit'),
            'mesin_upah' => set_value('mesin_upah'),
    	    'mesin_tgllaporan' => set_value('mesin_tgllaporan'),
    	    'mesin_userinput' => set_value('mesin_userinput'),
    	    'mesin_tglinput' => set_value('mesin_tglinput'),
	);
        $x['content']=$this->load->view('trx_mesin/trx_mesin_form', $data,TRUE);
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
            $jumlahmesinpekerja = count($_POST['count']);
            $codeid = $this->m_general->getcode('trx_master','master_id','MES-');
            $result = $this->Trx_mesin_model->batchInsert($_POST,$codeid, $username, $usersupervisor); // Insert to trx_mesin table            
            $totaltime = $this->m_general->sumdata('trx_mesin','mesin_totalmenit','mesin_master_id',$codeid);
            $data = array(
                'master_id' => $codeid,
                'master_module_id' => '1',
                'master_acuan_id' => $this->input->post('mesin_acuan_id',TRUE),
                'master_produk_id' => $this->input->post('mesin_produk_id',TRUE),
                'master_shift' => $this->input->post('mesin_shift',TRUE),
                'master_display' => $this->input->post('mesin_display',TRUE),
                'master_line' => $this->input->post('mesin_line',TRUE),
                'master_nomesin' => $this->input->post('mesin_mesin',TRUE),
                'master_jumlahteam' => $jumlahmesinpekerja,
                'master_totalkerjamenit' =>$totaltime,
                'master_tgllaporan' => $this->input->post('mesin_tgllaporan',TRUE),
                'master_usersupervisor' => $usersupervisor,
                'master_userinput' => $username,
                'master_tglinput' => date('Y-m-d'),
            );     

            $this->Trx_mesin_model->insertMaster($data); // insert to trx_master                
           
            if($result){
                echo 1;
            }
            else{
                echo 0;
            }
            exit;
            redirect(site_url('trx_mesin/create'));
            
            $this->session->set_flashdata('message', 'Create Record Success');
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
            'action' => site_url('trx_mesin/create_plus'),
            'mesin_id' => set_value('mesin_id'),
            'mesin_master_id' => set_value('mesin_master_id'),
            'mesin_karyawan_id' => set_value('mesin_karyawan_id'),
            'mesin_produk_id' => set_value('mesin_produk_id'),
            'mesin_acuan_id' => set_value('mesin_acuan_id'),
            'mesin_line' => set_value('mesin_line'),
            'mesin_shift' => set_value('mesin_shift'),
            'mesin_mesin' => set_value('mesin_mesin'),
            'mesin_display' => set_value('mesin_display'),
            'mesin_mulai' => set_value('mesin_mulai'),
            'mesin_selesai' => set_value('mesin_selesai'),
            'mesin_istirahat' => set_value('mesin_istirahat'),
            'mesin_totalmenit' => set_value('mesin_totalmenit'),
            'mesin_upah' => set_value('mesin_upah'),
            'mesin_tgllaporan' => set_value('mesin_tgllaporan'),
    );
        $x['content']=$this->load->view('trx_mesin/trx_mesin_form_plus', $data,TRUE);
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
           $mesincode = $this->Trx_mesin_model->gettrxmaster($this->input->post('mesin_produk_id', TRUE),$this->input->post('mesin_tgllaporan', TRUE),$this->input->post('mesin_shift', TRUE), '1');

        if ($mesincode){

             if (strtotime($this->input->post('mesin_mulai',TRUE)) > strtotime($this->input->post('mesin_selesai',TRUE))) {
                $tengah  ="24:00";
                $noll  ="00:00";
                $ptotalkerja = ((abs((strtotime($noll) - strtotime($this->input->post('mesin_selesai',TRUE))))/60) + ((strtotime($tengah) - strtotime($this->input->post('mesin_mulai',TRUE)))/60));
                $ptotal = $ptotalkerja - $this->input->post('mesin_istirahat',TRUE);
                }else {
                    $ptotalkerja = (strtotime($this->input->post('mesin_selesai',TRUE)) -  strtotime($this->input->post('mesin_mulai',TRUE)))/60;
                    $ptotal = $ptotalkerja - $this->input->post('mesin_istirahat',TRUE);
                }
            $data = array(
                    'mesin_karyawan_id' => $this->input->post('mesin_karyawan_id',TRUE),
                    'mesin_produk_id' => $this->input->post('mesin_produk_id', TRUE),
                    'mesin_acuan_id' => $this->input->post('mesin_acuan_id', TRUE),
                    'mesin_line' => $this->input->post('mesin_line', TRUE),
                    'mesin_master_id' => $this->input->post('mesin_master_id', TRUE),
                    'mesin_shift' => $this->input->post('mesin_shift', TRUE),
                    'mesin_mesin' => $this->input->post('mesin_mesin',TRUE),
                    'mesin_display' => $this->input->post('mesin_display', TRUE),
                    'mesin_mulai' => $this->input->post('mesin_mulai',TRUE),
                    'mesin_selesai' => $this->input->post('mesin_selesai', TRUE),
                    'mesin_istirahat' => $this->input->post('mesin_istirahat',TRUE),
                    'mesin_totalmenit' => $ptotal,
                    'mesin_tgllaporan' => $this->input->post('mesin_tgllaporan', TRUE),
                    'mesin_usersupervisor'=>$usersupervisor,
                    'mesin_userinput' => $username,
                    'mesin_tglinput' => date('Y-m-d'),
            );

            $this->Trx_mesin_model->insert($data);

            $xdata = array(
                    'masterdetail_karyawan_id'=>$this->input->post('mesin_karyawan_id',TRUE),               
                    'masterdetail_master_id'=> $this->input->post('mesin_master_id', TRUE),
                    'masterdetail_mulai'=>$this->input->post('mesin_mulai',TRUE),
                    'masterdetail_selesai'=>$this->input->post('mesin_mulai',TRUE),
                    'masterdetail_totalkerja'=>$ptotal,
                    'masterdetail_box'=>$this->input->post('mesin_display', TRUE),
                    'masterdetail_istirahat' => $this->input->post('mesin_istirahat',TRUE),
                    'masterdetail_usersupervisor'=>$usersupervisor,
                    'masterdetail_userinput'=>$username,
                    'masterdetail_tglinput'=>date('Y-m-d'),
            );

                $this->Trx_mesin_model->insertdetail($xdata);

            // Total Waktu & Master TRXMASTER
                $totalwaktu = $this->Trx_mesin_model->mesinsum('mesin_totalmenit', $this->input->post('mesin_produk_id',TRUE),$this->input->post('mesin_shift',TRUE),$this->input->post('mesin_tgllaporan',TRUE),$this->input->post('mesin_master_id',TRUE) );
                $totalteam = $this->Trx_mesin_model->mesincount('mesin_karyawan_id', $this->input->post('mesin_produk_id',TRUE),$this->input->post('mesin_shift',TRUE),$this->input->post('mesin_tgllaporan',TRUE),$this->input->post('mesin_master_id',TRUE) );
        
                $zdata = array(
                    'master_totalkerjamenit' => $totalwaktu, 
                    'master_jumlahteam' => $totalteam, 
                    );
                    $this->Trx_mesin_model->updateMaster($this->input->post('mesin_master_id',TRUE), $zdata);
                    

                    $messege= array(
                            'messege'=> "Data Berhasil Disimpan"
                        );
                    $this->session->set_flashdata('success', $messege);
                    redirect(site_url('trx_mesin/plus'));

            }else{
                $messege= array(
                    'messege'=> "Transaksi tidak ada , Silahkan input kembali"
                );
                $this->session->set_flashdata('message',$messege);
                redirect(site_url('trx_mesin/plus'));

            }

        }
    }
    
    public function update($id) 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $usersupervisor=$this->session->userdata('user_supervisor');
        $row = $this->Trx_mesin_model->get_by_id($id);

        if ($row) {
            $data = array(
                'acuan' => $this->m_general->tampil_data_perfield1('stx_acuan','acuan_status','Aktif'),
                'produk' => $this->m_general->tampil_produkid('stx_produk','produk_status','Aktif', 'produk_usersupervisor',$usersupervisor),
                'shift' => $this->m_general->tampil_data_perfield1('stx_shift','shift_status','Aktif'),
                'button' => 'Update',
                'action' => site_url('trx_mesin/update_action'),
            		'mesin_id' => set_value('mesin_id', $row->mesin_id),
            		'mesin_karyawan_id' => set_value('mesin_karyawan_id', $row->mesin_karyawan_id),
            		'mesin_produk_id' => set_value('mesin_produk_id', $row->mesin_produk_id),
            		'mesin_acuan_id' => set_value('mesin_acuan_id', $row->mesin_acuan_id),
            		'mesin_line' => set_value('mesin_line', $row->mesin_line),
                    'mesin_master_id' => set_value('mesin_line', $row->mesin_master_id),
            		'mesin_shift' => set_value('mesin_shift', $row->mesin_shift),
            		'mesin_mesin' => set_value('mesin_mesin', $row->mesin_mesin),
            		'mesin_display' => set_value('mesin_display', $row->mesin_display),
            		'mesin_mulai' => set_value('mesin_mulai', $row->mesin_mulai),
            		'mesin_selesai' => set_value('mesin_selesai', $row->mesin_selesai),
            		'mesin_istirahat' => set_value('mesin_istirahat', $row->mesin_istirahat),
                    'mesin_upah' => set_value('mesin_upah', $row->mesin_upah),
            		'mesin_totalmenit' => set_value('mesin_totalmenit', $row->mesin_totalmenit),
            		'mesin_tgllaporan' => set_value('mesin_tgllaporan', $row->mesin_tgllaporan),
            		'mesin_userinput' => set_value('mesin_userinput', $row->mesin_userinput),
            		'mesin_tglinput' => set_value('mesin_tglinput', $row->mesin_tglinput),
                     'codeid'=>$this->m_general->trxgetcode('masterdetail_id',set_value('mesin_karyawan_id', $row->mesin_karyawan_id),set_value('mesin_master_id', $row->mesin_master_id)),
	    );
            $x['content']=$this->load->view('trx_mesin/trx_mesin_form_update', $data,true);
            $this->load->view('template',$x);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_mesin'));
        }
    }
    
    public function update_action() 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('mesin_id', TRUE));
        } else {


            if (strtotime($this->input->post('mesin_mulai',TRUE)) > strtotime($this->input->post('mesin_selesai',TRUE))) {
                $tengah  ="24:00";
                $noll  ="00:00";
                $ztotalkerja = ((abs((strtotime($noll) - strtotime($this->input->post('mesin_selesai',TRUE))))/60) + ((strtotime($tengah) - strtotime($this->input->post('mesin_mulai',TRUE)))/60));
                $ztotal = $ztotalkerja - $this->input->post('mesin_istirahat',TRUE);
                }else {
                    $ztotalkerja = (strtotime($this->input->post('mesin_selesai',TRUE)) -  strtotime($this->input->post('mesin_mulai',TRUE)))/60;
                    $ztotal = $ztotalkerja - $this->input->post('mesin_istirahat',TRUE);
            }

            $xdata = array(
        		'mesin_karyawan_id' => $this->input->post('mesin_karyawan_id',TRUE),
                'mesin_produk_id' => $this->input->post('mesin_produk_id',TRUE),
        		'mesin_acuan_id' => $this->input->post('mesin_acuan_id',TRUE),
                'mesin_line' => $this->input->post('mesin_line',TRUE),
                'mesin_shift' => $this->input->post('mesin_shift',TRUE),
                'mesin_mesin' => $this->input->post('mesin_mesin',TRUE),
        		'mesin_display' => $this->input->post('mesin_display',TRUE),
        		'mesin_mulai' => $this->input->post('mesin_mulai',TRUE),
        		'mesin_selesai' => $this->input->post('mesin_selesai',TRUE),
        		'mesin_istirahat' => $this->input->post('mesin_istirahat',TRUE),
        		'mesin_totalmenit' =>  $ztotal,
	       );

            $this->Trx_mesin_model->update($this->input->post('mesin_id', TRUE), $xdata);
            
            $ydata = array(
                'masterdetail_karyawan_id'=>$this->input->post('mesin_karyawan_id',TRUE),                
                'masterdetail_mulai'=>$this->input->post('mesin_mulai',TRUE),
                'masterdetail_selesai'=>$this->input->post('mesin_selesai',TRUE),
                'masterdetail_istirahat'=>$this->input->post('mesin_istirahat',TRUE),
                'masterdetail_box'=> $this->input->post('mesin_display',TRUE),
                'masterdetail_totalkerja' => $ztotal,
            ); 
             $this->Trx_mesin_model->updateDetail($this->input->post('codeid',TRUE), $ydata);

            // Total waktu masterid
        $totalwaktu = $this->Trx_mesin_model->mesinsum('mesin_totalmenit', $this->input->post('mesin_produk_id',TRUE),$this->input->post('mesin_shift',TRUE),$this->input->post('mesin_tgllaporan',TRUE),$this->input->post('mesin_master_id',TRUE) );
        
        $zdata = array(
            'master_acuan_id' => $this->input->post('mesin_acuan_id',TRUE),
            'master_line' => $this->input->post('mesin_line',TRUE),
            'master_nomesin' => $this->input->post('mesin_mesin',TRUE),
            'master_shift' => $this->input->post('mesin_shift',TRUE),
            'master_produk_id' => $this->input->post('mesin_produk_id',TRUE),
            'master_totalkerjamenit' => $totalwaktu, 
            );
            $this->Trx_mesin_model->updateMaster($this->input->post('mesin_master_id',TRUE), $zdata);
            

            $messege= array(
                    'messege'=> "Update Berhasil Disimpan"
                );
            $this->session->set_flashdata('success', $messege);
            redirect(site_url('trx_mesin'. '/index?q=' . urlencode($this->input->post('mesin_produk_id',TRUE)) . '&t='. urlencode($this->input->post('mesin_tgllaporan',TRUE)) . '&s='. urlencode($this->input->post('mesin_shift',TRUE))));

        }
    }
    
    public function delete($id) 
    {
        $row = $this->Trx_mesin_model->get_by_id($id);

        if ($row) {
        $codeid = $this->m_general->trxgetcode('masterdetail_id',set_value('mesin_karyawan_id', $row->mesin_karyawan_id),set_value('mesin_master_id', $row->mesin_master_id ));

            $this->Trx_mesin_model->delete($id);
            $this->Trx_mesin_model->deleteDetail($codeid);

            //Recalculate Team & time working
            $totalwaktu = $this->Trx_mesin_model->mesinsum('mesin_totalmenit',set_value('mesin_produk_id', $row->mesin_produk_id),set_value('mesin_shift', $row->mesin_shift),set_value('mesin_tgllaporan', $row->mesin_tgllaporan),set_value('mesin_master_id', $row->mesin_master_id));
            $totalteam = $this->Trx_mesin_model->mesincount('mesin_karyawan_id',set_value('mesin_produk_id', $row->mesin_produk_id),set_value('mesin_shift', $row->mesin_shift),set_value('mesin_tgllaporan', $row->mesin_tgllaporan),set_value('mesin_master_id', $row->mesin_master_id));
        
            
            if ($totalteam == '0'){
                $this->Trx_mesin_model->deletemaster(set_value('mesin_master_id', $row->mesin_master_id));
            }else{
            $zdata = array(
                    'master_totalkerjamenit' => $totalwaktu, 
                    'master_jumlahteam' => $totalteam, 
                    );
            $this->Trx_mesin_model->updateMaster(set_value('mesin_master_id', $row->mesin_master_id), $zdata);

            }


            $messege= array(
                    'messege'=> "Delete Transaksi telah berhasil"
                );
            $this->session->set_flashdata('success', $messege);
            redirect(site_url('trx_mesin'. '/index?q=' . urlencode(set_value('mesin_produk_id', $row->mesin_produk_id)) . '&t='. urlencode(set_value('mesin_tgllaporan', $row->mesin_tgllaporan)) . '&s='. urlencode(set_value('mesin_shift', $row->mesin_shift))));

        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_mesin'));
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
            $x['data_mesin']=$this->Trx_mesin_model->download_mesin('',$date_input,'');
        }else{
            $x['data_mesin']=$this->Trx_mesin_model->download_mesin($username,$date_input,$xid_group);
        }
        
        $this->load->view('trx_mesin/excel_trx_mesin',$x);
    }



    public function _rules() 
    {
    	$this->form_validation->set_rules('mesin_karyawan_id', 'mesin karyawan id', 'trim');
    	$this->form_validation->set_rules('mesin_produk_id', 'mesin produk id', 'trim');
    	$this->form_validation->set_rules('mesin_acuan_id', 'mesin acuan id', 'trim');
    	$this->form_validation->set_rules('mesin_line', 'mesin line', 'trim');
    	$this->form_validation->set_rules('mesin_shift', 'mesin shift', 'trim');
    	$this->form_validation->set_rules('mesin_mesin', 'mesin mesin', 'trim');
    	$this->form_validation->set_rules('mesin_display', 'mesin display', 'trim');
    	$this->form_validation->set_rules('mesin_mulai', 'mesin mulai', 'trim');
    	$this->form_validation->set_rules('mesin_selesai', 'mesin selesai', 'trim');
    	$this->form_validation->set_rules('mesin_istirahat', 'mesin istirahat', 'trim');
    	$this->form_validation->set_rules('mesin_totalmenit', 'mesin totalmenit', 'trim');
    	$this->form_validation->set_rules('mesin_tgllaporan', 'mesin tgllaporan', 'trim');
    	$this->form_validation->set_rules('mesin_userinput', 'mesin userinput', 'trim');
        $this->form_validation->set_rules('mesin_upah', 'mesin upah', 'trim');
    	$this->form_validation->set_rules('mesin_tglinput', 'mesin tglinput', 'trim');
    	$this->form_validation->set_rules('mesin_id', 'mesin_id', 'trim');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}
