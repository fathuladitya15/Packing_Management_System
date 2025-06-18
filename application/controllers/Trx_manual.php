<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trx_manual extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Trx_manual_model');
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
        $priv=$this->m_general->get_privilage($id_group,'trx_manual');      
        $x['add']='N';
        $x['update']='N';
        $x['delete']='N';
        $x['comment1']='N';
        $x['report']='N';
        foreach ($priv as $a) {
            $id_group=$id_group;
            $nav_url='trx_manual';
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
            $config['base_url'] = base_url() . 'trx_manual/index.html?q=' . urlencode($q) . '&t='. urlencode($t). '&s='. urlencode($s);
            $config['first_url'] = base_url() . 'trx_manual/index.html?q=' . urlencode($q) . '&t='. urlencode($t) . '&s='. urlencode($s);
            $config['per_page'] = 0;

        } elseif (($s <> '') and ($t <> '') and ($q == '')){
            $config['base_url'] = base_url() . 'trx_manual/index.html?t='. urlencode($t). '&s='. urlencode($s);;
            $config['first_url'] = base_url() . 'trx_manual/index.html?t='. urlencode($t). '&s='. urlencode($s);;
            $config['per_page'] = 0;

        }else {
            $config['base_url'] = base_url() . 'trx_manual/index.html';
            $config['first_url'] = base_url() . 'trx_manual';
            $config['per_page'] = 25;
        }

        $config['page_query_string'] = TRUE;
        $trx_manual = $this->Trx_manual_model->tampil_data($config['per_page'], $start, $q, $username,$id_group,$s, $t );
        $config['total_rows'] = $this->Trx_manual_model->total_rows($q, $username, $id_group,$s, $t);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'trx_manual_data' => $trx_manual,
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
            'priv_count' =>$this->m_general->cek_privilage($id_group,'trx_manual'),
        );

        $x['content']=$this->load->view('trx_manual/trx_manual_list', $data,TRUE);
        $this->load->view('template',$x);
    }

    public function read($id) 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $row = $this->Trx_manual_model->get_by_id($id);
        if ($row) {
            $data = array(
    		'manual_id' => $row->manual_id,
    		'manual_karyawan_id' => $row->manual_karyawan_id,
            'karyawan_nama' => $row->karyawan_nama,
            'produk_id' => $row->produk_id,
            'produk_nama' => $row->produk_nama,
    		'manual_acuan_id' => $row->manual_acuan_id,
            'manual_master_id' => $row->manual_master_id,
    		'manual_shift' => $row->manual_shift,
    		'manual_box' => $row->manual_box,
    		'manual_mulai' => $row->manual_mulai,
    		'manual_selesai' => $row->manual_selesai,
    		'manual_istirahat' => $row->manual_istirahat,
    		'manual_totalmenit' => $row->manual_totalmenit,
            'manual_upah' => $row->manual_upah,
    		'manual_tgllaporan' => $row->manual_tgllaporan,
    		'manual_userinput' => $row->manual_userinput,
    		'manual_tglinput' => $row->manual_tglinput,
	    );
            $x['content']=$this->load->view('trx_manual/trx_manual_read', $data,true);
            $this->load->view('template',$x);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_manual'));
        }
    }

    public function create() 
    {

        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $usersupervisor=$this->session->userdata('user_supervisor');
        $data = array(
            'trxcode' => $this->m_general->getcode('trx_master','master_id','MAN-'),
        	'acuan' => $this->m_general->tampil_data_perfield1('stx_acuan','acuan_status','Aktif'),
        	'produk' => $this->m_general->tampil_produkid('stx_produk','produk_status','Aktif', 'produk_usersupervisor',$usersupervisor),
            'shift' => $this->m_general->tampil_data_perfield1('stx_shift','shift_status','Aktif'),
            'button' => 'Create',
            'action' => site_url('trx_manual/create_action'),
    	    'manual_id' => set_value('manual_id'),
    	    'manual_karyawan_id' => set_value('manual_karyawan_id'),
    	    'manual_produk_id' => set_value('manual_produk_id'),
    	    'manual_acuan_id' => set_value('manual_acuan_id'),
    	    'manual_shift' => set_value('manual_shift'),
    	    'manual_box' => set_value('manual_box'),
    	    'manual_mulai' => set_value('manual_mulai'),
    	    'manual_selesai' => set_value('manual_selesai'),
    	    'manual_istirahat' => set_value('manual_istirahat'),
    	    'manual_totalmenit' => set_value('manual_totalmenit'),
            'manual_upah' => set_value('manual_upah'),
    	    'manual_tgllaporan' => set_value('manual_tgllaporan'),
    	    'manual_userinput' => set_value('manual_userinput'),
    	    'manual_tglinput' => set_value('manual_tglinput'),
	);
        $x['content']=$this->load->view('trx_manual/trx_manual_form', $data,TRUE);
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
            $jumlahmanuampekerja = count($_POST['count']);
            $codeid = $this->m_general->getcode('trx_master','master_id','MAN-');
            $hargamanual = $this->m_general->hargaproduk('stx_produk','produk_manual','produk_id',$this->input->post('manual_produk_id',TRUE));
            $masterbox = $this->m_general->hargaproduk('stx_produk','produk_masterbox','produk_id',$this->input->post('manual_produk_id',TRUE));
            $result = $this->Trx_manual_model->batchInsert($_POST,$codeid ,$masterbox, $hargamanual, $username, $usersupervisor); // Insert to trx_manual table            
            $totaltime = $this->m_general->sumdata('trx_manual','manual_totalmenit','manual_master_id',$codeid);
            
            $data = array(
                'master_id' => $codeid,
                'master_module_id' => '3',
                'master_acuan_id' => $this->input->post('manual_acuan_id',TRUE),
                'master_produk_id' => $this->input->post('manual_produk_id',TRUE),
                'master_shift' => $this->input->post('manual_shift',TRUE),
                'master_box' => $this->input->post('manual_box',TRUE),
                'master_jumlahteam' => $jumlahmanuampekerja,
                'master_totalkerjamenit' =>$totaltime,
                'master_tgllaporan' => $this->input->post('manual_tgllaporan',TRUE),
                'master_usersupervisor' => $usersupervisor,
                'master_userinput' => $username,
                'master_tglinput' => date('Y-m-d'),
            );            
            $this->Trx_manual_model->insertMaster($data); // insert to trx_master              
           
            if($result){
                echo 1;
            }
            else{
                echo 0;
            }
            exit;
            redirect(site_url('trx_manual/create'));
            
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
            'action' => site_url('trx_manual/create_plus'),
            'manual_id' => set_value('manual_id'),
            'manual_master_id' => set_value('manual_master_id'),
            'manual_karyawan_id' => set_value('manual_karyawan_id'),
            'manual_produk_id' => set_value('manual_produk_id'),
            'manual_acuan_id' => set_value('manual_acuan_id'),
            'manual_shift' => set_value('manual_shift'),
            'manual_manual' => set_value('manual_manual'),
            'manual_box' => set_value('manual_box'),
            'manual_mulai' => set_value('manual_mulai'),
            'manual_selesai' => set_value('manual_selesai'),
            'manual_istirahat' => set_value('manual_istirahat'),
            'manual_totalmenit' => set_value('manual_totalmenit'),
            'manual_upah' => set_value('manual_upah'),
            'manual_tgllaporan' => set_value('manual_tgllaporan'),
    );
        $x['content']=$this->load->view('trx_manual/trx_manual_form_plus', $data,TRUE);
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

           $manualcode = $this->Trx_manual_model->gettrxmaster($this->input->post('manual_produk_id', TRUE),$this->input->post('manual_tgllaporan', TRUE),$this->input->post('manual_shift', TRUE), '3');

        if ($manualcode){

             if (strtotime($this->input->post('manual_mulai',TRUE)) > strtotime($this->input->post('manual_selesai',TRUE))) {
                $tengah  ="24:00";
                $noll  ="00:00";
                $mtotalkerja = ((abs((strtotime($noll) - strtotime($this->input->post('manual_selesai',TRUE))))/60) + ((strtotime($tengah) - strtotime($this->input->post('manual_mulai',TRUE)))/60));
                $mtotal = $mtotalkerja - $this->input->post('manual_istirahat',TRUE);
                }else {
                    $mtotalkerja = (strtotime($this->input->post('manual_selesai',TRUE)) -  strtotime($this->input->post('manual_mulai',TRUE)))/60;
                    $mtotal = $mtotalkerja - $this->input->post('manual_istirahat',TRUE);
                }
            $data = array(
                    'manual_karyawan_id' => $this->input->post('manual_karyawan_id',TRUE),
                    'manual_produk_id' => $this->input->post('manual_produk_id', TRUE),
                    'manual_acuan_id' => $this->input->post('manual_acuan_id', TRUE),
                    'manual_master_id' => $this->input->post('manual_master_id', TRUE),
                    'manual_shift' => $this->input->post('manual_shift', TRUE),
                    'manual_box' => $this->input->post('manual_box', TRUE),
                    'manual_mulai' => $this->input->post('manual_mulai',TRUE),
                    'manual_selesai' => $this->input->post('manual_selesai', TRUE),
                    'manual_istirahat' => $this->input->post('manual_istirahat',TRUE),
                    'manual_totalmenit' => $mtotal,
                    'manual_tgllaporan' => $this->input->post('manual_tgllaporan', TRUE),
                    'manual_usersupervisor' => $usersupervisor,
                    'manual_userinput' => $username,
                    'manual_tglinput' => date('Y-m-d'),
            );

            $this->Trx_manual_model->insert($data);

            $xdata = array(
                    'masterdetail_karyawan_id'=>$this->input->post('manual_karyawan_id',TRUE),               
                    'masterdetail_master_id'=> $this->input->post('manual_master_id', TRUE),
                    'masterdetail_mulai'=>$this->input->post('manual_mulai',TRUE),
                    'masterdetail_selesai'=>$this->input->post('manual_mulai',TRUE),
                    'masterdetail_totalkerja'=>$mtotal,
                    'masterdetail_box'=>$this->input->post('manual_box', TRUE),
                    'masterdetail_istirahat' => $this->input->post('manual_istirahat',TRUE),
                    'masterdetail_usersupervisor'=>$usersupervisor,
                    'masterdetail_userinput'=>$username,
                    'masterdetail_tglinput'=>date('Y-m-d'),
            );

            $this->Trx_manual_model->insertdetail($xdata);

         // Total Waktu & Master TRXMASTER
                $totalwaktu = $this->Trx_manual_model->manualsum('manual_totalmenit', $this->input->post('manual_produk_id',TRUE),$this->input->post('manual_shift',TRUE),$this->input->post('manual_tgllaporan',TRUE),$this->input->post('manual_master_id',TRUE) );
                $totalteam = $this->Trx_manual_model->manualcount('manual_karyawan_id', $this->input->post('manual_produk_id',TRUE),$this->input->post('manual_shift',TRUE),$this->input->post('manual_tgllaporan',TRUE),$this->input->post('manual_master_id',TRUE) );
        
                $zdata = array(
                    'master_totalkerjamenit' => $totalwaktu, 
                    'master_jumlahteam' => $totalteam, 
                    );
                    $this->Trx_manual_model->updateMaster($this->input->post('manual_master_id',TRUE), $zdata);
                    

                    $messege= array(
                            'messege'=> "Data Berhasil Disimpan"
                        );
                    $this->session->set_flashdata('success', $messege);
                    redirect(site_url('trx_manual/plus'));

            }else{
                $messege= array(
                    'messege'=> "Transaksi tidak ada , Silahkan input kembali"
                );
                $this->session->set_flashdata('message',$messege);
                redirect(site_url('trx_manual/plus'));

            }

        }
    }
    
   
    public function update($id) 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $usersupervisor=$this->session->userdata('user_supervisor');
        $row = $this->Trx_manual_model->get_by_id($id);

        if ($row) {
            $data = array(
                'acuan' => $this->m_general->tampil_data_perfield1('stx_acuan','acuan_status','Aktif'),
                'produk' => $this->m_general->tampil_produkid('stx_produk','produk_status','Aktif', 'produk_usersupervisor',$usersupervisor),
                'shift' => $this->m_general->tampil_data_perfield1('stx_shift','shift_status','Aktif'),
                'button' => 'Update',
                'action' => site_url('trx_manual/update_action'),
            		'manual_id' => set_value('manual_id', $row->manual_id),
                    'manual_master_id' => set_value('manual_master_id', $row->manual_master_id),
            		'manual_karyawan_id' => set_value('manual_karyawan_id', $row->manual_karyawan_id),
            		'manual_produk_id' => set_value('manual_produk_id', $row->manual_produk_id),
            		'manual_acuan_id' => set_value('manual_acuan_id', $row->manual_acuan_id),
            		'manual_shift' => set_value('manual_shift', $row->manual_shift),
            		'manual_box' => set_value('manual_box', $row->manual_box),
            		'manual_mulai' => set_value('manual_mulai', $row->manual_mulai),
            		'manual_selesai' => set_value('manual_selesai', $row->manual_selesai),
            		'manual_istirahat' => set_value('manual_istirahat', $row->manual_istirahat),
            		'manual_totalmenit' => set_value('manual_totalmenit', $row->manual_totalmenit),
                    'manual_upah' => set_value('manual_upah', $row->manual_upah),
            		'manual_tgllaporan' => set_value('manual_tgllaporan', $row->manual_tgllaporan),
            		'manual_userinput' => set_value('manual_userinput', $row->manual_userinput),
            		'manual_tglinput' => set_value('manual_tglinput', $row->manual_tglinput),
                    'codeid'=>$this->m_general->trxgetcode('masterdetail_id',set_value('manual_karyawan_id', $row->manual_karyawan_id),set_value('manual_master_id', $row->manual_master_id)),
	    );
                $x['content']=$this->load->view('trx_manual/trx_manual_form_update', $data,true);
                $this->load->view('template',$x);  
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_manual'));
        }
    }
    
    public function update_action() 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('manual_id', TRUE));
        } else {

            if (strtotime($this->input->post('manual_mulai',TRUE)) > strtotime($this->input->post('manual_selesai',TRUE))) {
                $tengah  ="24:00";
                $noll  ="00:00";
                $ztotalkerja = ((abs((strtotime($noll) - strtotime($this->input->post('manual_selesai',TRUE))))/60) + ((strtotime($tengah) - strtotime($this->input->post('manual_mulai',TRUE)))/60));
                $ztotal = $ztotalkerja - $this->input->post('manual_istirahat',TRUE);
                }else {
                    $ztotalkerja = (strtotime($this->input->post('manual_selesai',TRUE)) -  strtotime($this->input->post('manual_mulai',TRUE)))/60;
                    $ztotal = $ztotalkerja - $this->input->post('manual_istirahat',TRUE);
            }
            $xdata = array(

                    'manual_karyawan_id' => $this->input->post('manual_karyawan_id',TRUE),
                    'manual_produk_id' => $this->input->post('manual_produk_id', TRUE),
                    'manual_acuan_id' => $this->input->post('manual_acuan_id', TRUE),
                    'manual_master_id' => $this->input->post('manual_master_id', TRUE),
                    'manual_shift' => $this->input->post('manual_shift', TRUE),
                    'manual_box' => $this->input->post('manual_box', TRUE),
                    'manual_mulai' => $this->input->post('manual_mulai',TRUE),
                    'manual_selesai' => $this->input->post('manual_selesai', TRUE),
                    'manual_istirahat' => $this->input->post('manual_istirahat',TRUE),
                    'manual_totalmenit' => $ztotal,
       		
	    );

            $this->Trx_manual_model->update($this->input->post('manual_id', TRUE), $xdata);
            
            $ydata = array(
                'masterdetail_karyawan_id' => $this->input->post('manual_karyawan_id',TRUE),
                'masterdetail_box' => $this->input->post('manual_box',TRUE),
                'masterdetail_mulai' => $this->input->post('manual_mulai',TRUE),
                'masterdetail_selesai' => $this->input->post('manual_selesai',TRUE),
                'masterdetail_istirahat' => $this->input->post('manual_istirahat',TRUE),
                'masterdetail_totalkerja' => $ztotal,
        );
           $this->Trx_manual_model->updateDetail($this->input->post('codeid',TRUE), $ydata);
            

         // Total waktu masterid
        $totalwaktu = $this->Trx_manual_model->manualsum('manual_totalmenit', $this->input->post('manual_produk_id',TRUE),$this->input->post('manual_shift',TRUE),$this->input->post('manual_tgllaporan',TRUE),$this->input->post('manual_master_id',TRUE) );
        
        $zdata = array(

            'master_produk_id' => $this->input->post('manual_produk_id', TRUE),
            'master_acuan_id' => $this->input->post('manual_acuan_id', TRUE),
            'master_shift' => $this->input->post('manual_shift', TRUE),
            'master_box' => $this->input->post('manual_box', TRUE),
            'master_totalkerjamenit' => $totalwaktu, 
            );
            $this->Trx_manual_model->updateMaster($this->input->post('manual_master_id',TRUE), $zdata);
            

            $messege= array(
                    'messege'=> "Update Berhasil Disimpan"
                );
            $this->session->set_flashdata('success', $messege);
            redirect(site_url('trx_manual'. '/index?q=' . urlencode($this->input->post('manual_produk_id',TRUE)) . '&t='. urlencode($this->input->post('manual_tgllaporan',TRUE)) . '&s='. urlencode($this->input->post('manual_shift',TRUE))));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Trx_manual_model->get_by_id($id);

        if ($row) {
         $codeid = $this->m_general->trxgetcode('masterdetail_id',set_value('manual_karyawan_id', $row->manual_karyawan_id),set_value('manual_master_id', $row->manual_master_id ));

            $this->Trx_manual_model->delete($id);
            $this->Trx_manual_model->deleteDetail($codeid);

            //Recalculate Team & time working
            $totalwaktu = $this->Trx_manual_model->manualsum('manual_totalmenit',set_value('manual_produk_id', $row->manual_produk_id),set_value('manual_shift', $row->manual_shift),set_value('manual_tgllaporan', $row->manual_tgllaporan),set_value('manual_master_id', $row->manual_master_id));
            $totalteam = $this->Trx_manual_model->manualcount('manual_karyawan_id',set_value('manual_produk_id', $row->manual_produk_id),set_value('manual_shift', $row->manual_shift),set_value('manual_tgllaporan', $row->manual_tgllaporan),set_value('manual_master_id', $row->manual_master_id));
    
            if ($totalteam =='0'){
                $this->Trx_manual_model->deletemaster(set_value('manual_master_id', $row->manual_master_id));
                
            }else {
            $zdata = array(
                    'master_totalkerjamenit' => $totalwaktu, 
                    'master_jumlahteam' => $totalteam, 
                    );
            $this->Trx_manual_model->updateMaster(set_value('manual_master_id', $row->manual_master_id), $zdata);

            }    


            $messege= array(
                    'messege'=> "Delete Transaksi telah berhasil"
                );
            $this->session->set_flashdata('success', $messege);
            redirect(site_url('trx_manual'. '/index?q=' . urlencode(set_value('manual_produk_id', $row->manual_produk_id)) . '&t='. urlencode(set_value('manual_tgllaporan', $row->manual_tgllaporan)) . '&s='. urlencode(set_value('manual_shift', $row->manual_shift))));
            
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_manual'));
        }
    }

    public function _rules() 
    {
    	$this->form_validation->set_rules('manual_karyawan_id', 'manual karyawan id', 'trim');
    	$this->form_validation->set_rules('manual_produk_id', 'manual produk id', 'trim|required');
    	$this->form_validation->set_rules('manual_acuan_id', 'manual acuan id', 'trim|required');
    	$this->form_validation->set_rules('manual_shift', 'manual shift', 'trim|required');
    	$this->form_validation->set_rules('manual_box', 'manual box', 'trim');
    	$this->form_validation->set_rules('manual_mulai', 'manual mulai', 'trim');
        $this->form_validation->set_rules('manual_upah', 'manual upah', 'trim');
    	$this->form_validation->set_rules('manual_selesai', 'manual selesai', 'trim');
    	$this->form_validation->set_rules('manual_istirahat', 'manual istirahat', 'trim');
    	$this->form_validation->set_rules('manual_totalmenit', 'manual totalmenit', 'trim');
    	$this->form_validation->set_rules('manual_tgllaporan', 'manual tgllaporan', 'trim');
    	$this->form_validation->set_rules('manual_userinput', 'manual userinput', 'trim');
    	$this->form_validation->set_rules('manual_tglinput', 'manual tglinput', 'trim');
    	$this->form_validation->set_rules('manual_id', 'manual_id', 'trim');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
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
            $x['data_manual']=$this->Trx_manual_model->download_manual('',$date_input,'');
        }else{
            $x['data_manual']=$this->Trx_manual_model->download_manual($username,$date_input, $xid_group);
        }
        
        $this->load->view('trx_manual/excel_trx_manual',$x);
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "trx_manual.xls";
        $judul = "trx_manual";
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
    	xlsWriteLabel($tablehead, $kolomhead++, "manual Karyawan Id");
    	xlsWriteLabel($tablehead, $kolomhead++, "manual Produk Id");
    	xlsWriteLabel($tablehead, $kolomhead++, "manual Acuan Id");
    	xlsWriteLabel($tablehead, $kolomhead++, "manual Shift");
    	xlsWriteLabel($tablehead, $kolomhead++, "manual Box");
    	xlsWriteLabel($tablehead, $kolomhead++, "manual Mulai");
    	xlsWriteLabel($tablehead, $kolomhead++, "manual Selesai");
    	xlsWriteLabel($tablehead, $kolomhead++, "manual Istirahat");
    	xlsWriteLabel($tablehead, $kolomhead++, "manual Totalmenit");
    	xlsWriteLabel($tablehead, $kolomhead++, "manual Tgllaporan");
    	xlsWriteLabel($tablehead, $kolomhead++, "manual Userinput");
    	xlsWriteLabel($tablehead, $kolomhead++, "manual Tglinput");

	foreach ($this->Trx_manual_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->manual_karyawan_id);
	    xlsWriteLabel($tablebody, $kolombody++, $data->manual_produk_id);
	    xlsWriteNumber($tablebody, $kolombody++, $data->manual_acuan_id);
	    xlsWriteNumber($tablebody, $kolombody++, $data->manual_shift);
	    xlsWriteNumber($tablebody, $kolombody++, $data->manual_box);
	    xlsWriteLabel($tablebody, $kolombody++, $data->manual_mulai);
	    xlsWriteLabel($tablebody, $kolombody++, $data->manual_selesai);
	    xlsWriteNumber($tablebody, $kolombody++, $data->manual_istirahat);
	    xlsWriteNumber($tablebody, $kolombody++, $data->manual_totalmenit);
	    xlsWriteLabel($tablebody, $kolombody++, $data->manual_tgllaporan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->manual_userinput);
	    xlsWriteLabel($tablebody, $kolombody++, $data->manual_tglinput);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=trx_manual.doc");

        $data = array(
            'trx_manual_data' => $this->Trx_manual_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('trx_manual/trx_manual_doc',$data);
    }

}

/* End of file Trx_manual.php */
/* Location: ./application/controllers/Trx_manual.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-09 10:56:27 */
/* http://harviacode.com */
