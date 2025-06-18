<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trx_perbantuan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Trx_perbantuan_model');
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
        $priv=$this->m_general->get_privilage($id_group,'trx_perbantuan');      
        $x['add']='N';
        $x['update']='N';
        $x['delete']='N';
        $x['comment1']='N';
        $x['report']='N';
        foreach ($priv as $a) {
            $id_group=$id_group;
            $nav_url='trx_perbantuan';
            $add=$a['add1'];
            $update=$a['update1'];
            $delete=$a['delete1'];
            $plus=$a['comment1'];
            $report=$a['report1'];
        }
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        $s = urldecode($this->input->get('s', TRUE));
        $t = urldecode($this->input->get('t', TRUE));
        $username=$this->session->userdata('username');
        

        if (($q <> '') and ($s <> '') and ($t <> '')) {
            $config['base_url'] = base_url() . 'trx_perbantuan/index.html?q=' . urlencode($q) . '&t='. urlencode($t). '&s='. urlencode($s);
            $config['first_url'] = base_url() . 'trx_perbantuan/index.html?q=' . urlencode($q) . '&t='. urlencode($t) . '&s='. urlencode($s);
            $config['per_page'] = 0;

        } elseif (($s <> '') and ($t <> '') and ($q == '')){
            $config['base_url'] = base_url() . 'trx_perbantuan/index.html?t='. urlencode($t). '&s='. urlencode($s);;
            $config['first_url'] = base_url() . 'trx_perbantuan/index.html?t='. urlencode($t). '&s='. urlencode($s);;
            $config['per_page'] = 0;

        }else {
            $config['base_url'] = base_url() . 'trx_perbantuan/index.html';
            $config['first_url'] = base_url() . 'trx_perbantuan';
            $config['per_page'] = 25;
        }


        
        $config['page_query_string'] = TRUE;
        $trx_perbantuan = $this->Trx_perbantuan_model->tampil_data($config['per_page'], $start, $q, $supervisor,$id_group ,$s, $t);
        $config['total_rows'] = $this->Trx_perbantuan_model->total_rows($q, $username, $id_group,$s, $t);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'trx_perbantuan_data' => $trx_perbantuan,
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
            'priv_count' =>$this->m_general->cek_privilage($id_group,'trx_perbantuan'),
        );

        $x['content']=$this->load->view('trx_perbantuan/trx_perbantuan_list', $data,TRUE);
        $this->load->view('template',$x);
    }

    public function read($id) 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $row = $this->Trx_perbantuan_model->get_by_id($id);
        
        if ($row) {
            $data = array(
    		'perbantuan_id' => $row->perbantuan_id,
    		'perbantuan_karyawan_id' => $row->perbantuan_karyawan_id,
    		'perbantuan_kategori' => $row->perbantuan_kategori,
            'karyawan_nama' => $row->karyawan_nama,
    		'perbantuan_shift' => $row->perbantuan_shift,
    		'perbantuan_master_id' => $row->perbantuan_master_id,
    		'perbantuan_mulai' => $row->perbantuan_mulai,
    		'perbantuan_selesai' => $row->perbantuan_selesai,
    		'perbantuan_istirahat' => $row->perbantuan_istirahat,
    		'perbantuan_totalmenit' => $row->perbantuan_totalmenit,
    		'perbantuan_upah' => $row->perbantuan_upah,
    		'perbantuan_tgllaporan' => $row->perbantuan_tgllaporan,
    		'perbantuan_userinput' => $row->perbantuan_userinput,
    		'perbantuan_tglinput' => $row->perbantuan_tglinput,
	    );
            $x['content']=$this->load->view('trx_perbantuan/trx_perbantuan_read', $data,true);
            $this->load->view('template',$x);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_perbantuan'));
        }
    }

    public function create() 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $data = array(
            'perbantuan' => $this->m_general->xenums('trx_perbantuan','perbantuan_kategori'),
            'shift' => $this->m_general->tampil_data_perfield1('stx_shift','shift_status','Aktif'),
            'button' => 'Create',
            'action' => site_url('trx_perbantuan/create_action'),
        	    'perbantuan_id' => set_value('perbantuan_id'),
        	    'perbantuan_karyawan_id' => set_value('perbantuan_karyawan_id'),
        	    'perbantuan_kategori' => set_value('perbantuan_kategori'),
        	    'perbantuan_shift' => set_value('perbantuan_shift'),
        	    'perbantuan_master_id' => set_value('perbantuan_master_id'),
        	    'perbantuan_mulai' => set_value('perbantuan_mulai'),
        	    'perbantuan_selesai' => set_value('perbantuan_selesai'),
        	    'perbantuan_istirahat' => set_value('perbantuan_istirahat'),
        	    'perbantuan_totalmenit' => set_value('perbantuan_totalmenit'),
        	    'perbantuan_upah' => set_value('perbantuan_upah'),
        	    'perbantuan_tgllaporan' => set_value('perbantuan_tgllaporan'),
        	    'perbantuan_userinput' => set_value('perbantuan_userinput'),
        	    'perbantuan_tglinput' => set_value('perbantuan_tglinput'),
	);

        $x['content']=$this->load->view('trx_perbantuan/trx_perbantuan_form', $data,TRUE);
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
            $count = count($_POST['count']); 
            $codeid = $this->m_general->getcode('trx_master','master_id','PER-');
            
            if($this->input->post('perbantuan')=="Bantuan Yupi"){

                $perbantuan='Bantuan Yupi';
            }elseif ($this->input->post('perbantuan')=="Yupi Skill"){
                $perbantuan='Yupi Skill';
            }else { 
                $perbantuan='Sortir Mogul';
            }
           
            $result = $this->Trx_perbantuan_model->batchInsert($_POST,$codeid, $perbantuan, $username, $usersupervisor); // Insert to trx_perbantuan table  
            
            $sumperbantuanpay = $this->Trx_perbantuan_model->sumperbantuan('perbantuan_upah',$usersupervisor,$this->input->post('perbantuan_shift',TRUE) ,$this->input->post('perbantuan_tgllaporan',TRUE), $codeid); 
  

            $data = array(
                'master_id' => $codeid,
                'master_module_id' => '6',
                'master_shift' => $this->input->post('perbantuan_shift',TRUE),
                'master_jumlahteam' => $count,
                'master_acuanmesin' =>$perbantuan,
                'master_bayarstfg' => $sumperbantuanpay,
                'master_tgllaporan' => $this->input->post('perbantuan_tgllaporan',TRUE),
                'master_usersupervisor' => $usersupervisor,
                'master_userinput' => $username,
                'master_tglinput' => date('Y-m-d'),
            );     

            $this->Trx_perbantuan_model->insertMaster($data); // insert to trx_master               
           
            if($result){
                echo 1;
            }
            else{
                echo 0;
            }
            exit;
            redirect(site_url('trx_perbantuan/create'));
            
            $this->session->set_flashdata('message', 'Create Record Success');
        }
    }
    

    public function plus() 
    {

        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $data = array(
            'perbantuan' => $this->m_general->xenums('trx_perbantuan','perbantuan_kategori'),
            'shift' => $this->m_general->tampil_data_perfield1('stx_shift','shift_status','Aktif'),
            'button' => 'Create',
            'action' => site_url('trx_perbantuan/create_plus'),
            'perbantuan_id' => set_value('perbantuan_id'),
            'perbantuan_master_id' => set_value('perbantuan_master_id'),
            'perbantuan_karyawan_id' => set_value('perbantuan_karyawan_id'),
            'perbantuan_kategori' => set_value('perbantuan_kategori'),
            'perbantuan_shift' => set_value('perbantuan_shift'),
            'perbantuan_mulai' => set_value('perbantuan_mulai'),
            'perbantuan_selesai' => set_value('perbantuan_selesai'),
            'perbantuan_istirahat' => set_value('perbantuan_istirahat'),
            'perbantuan_totalmenit' => set_value('perbantuan_totalmenit'),
            'perbantuan_upah' => set_value('perbantuan_upah'),
            'perbantuan_tgllaporan' => set_value('perbantuan_tgllaporan'),
    );
        $x['content']=$this->load->view('trx_perbantuan/trx_perbantuan_form_plus', $data,TRUE);
        $this->load->view('template',$x);
    }
    

    public function create_plus() 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $usersupervisor=$this->session->userdata('user_supervisor'); 
        $patas = $this->m_general->hargaproduk('stx_produk','produk_step_final','produk_id','P777777');
        
        $ptengah = $this->m_general->hargaproduk('stx_produk','produk_step_final','produk_id','P777779');

        $pbawah = $this->m_general->hargaproduk('stx_produk','produk_step_final','produk_id','P777778');



        if($perbantuan =='Bantuan Yupi') {
            $bantuan='Bantuan Yupi';
            $fupah = $patas;
            
            }elseif ($perbantuan =='Yupi Skill'){
                $bantuan='Yupi Skill';
                $fupah = $ptengah;
                
                }else{
                $bantuan ='Sortir Mogul';
                $fupah = $pbawah;
                }
             
        $this->_rules();

        if($perbantuan =='Bantuan Yupi') {
            $bantuan='Bantuan Yupi';
            $fupah = $patas;
            
            }elseif ($perbantuan =='Yupi Skill'){
                $bantuan='Yupi Skill';
                $fupah = $ptengah;
                
                }else{
                $bantuan ='Sortir Mogul';
                $fupah = $pbawah;
                }
        
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

        if($this->input->post('perbantuan')=="Bantuan Yupi") $perbantuan='Bantuan Yupi'; else $perbantuan='Sortir Mogul';

        $perbantuancode = $this->Trx_perbantuan_model->gettrxmaster($perbantuan,$this->input->post('perbantuan_tgllaporan', TRUE),$this->input->post('perbantuan_shift',TRUE ), '6',$this->input->post('perbantuan_master_id', TRUE));

        if ($perbantuancode){
            $pekerja = $this->Trx_perbantuan_model->countperbantuan('perbantuan_karyawan_id', $this->input->post('perbantuan_kategori', TRUE),$this->input->post('perbantuan_tgllaporan', TRUE),$this->input->post('perbantuan_shift', TRUE));
            $upah = floor(($this->input->post('perbantuan_istirahat') * $fupah ));              
    
            $data = array(
                    'perbantuan_karyawan_id' => $this->input->post('perbantuan_karyawan_id',TRUE),
                    'perbantuan_kategori' => $bantuan,
                    'perbantuan_master_id' => $this->input->post('perbantuan_master_id', TRUE),
                    'perbantuan_shift' => $this->input->post('perbantuan_shift', TRUE),
                    'perbantuan_mulai' => '06:45:00',
                    'perbantuan_selesai' => '14:45:00',
                    'perbantuan_istirahat' => $this->input->post('perbantuan_istirahat',TRUE),
                    'perbantuan_upah' => $upah,
                    'perbantuan_totalmenit' => ($this->input->post('perbantuan_istirahat',TRUE)*60),
                    'perbantuan_tgllaporan' => $this->input->post('perbantuan_tgllaporan', TRUE),
                    'perbantuan_usersupervisor'=>$usersupervisor,
                    'perbantuan_userinput' => $username,
                    'perbantuan_tglinput' => date('Y-m-d'),
            );

            $this->Trx_perbantuan_model->insert($data);

            $xdata = array(
                    'masterdetail_karyawan_id'=>$this->input->post('perbantuan_karyawan_id',TRUE),               
                    'masterdetail_master_id'=> $this->input->post('perbantuan_master_id', TRUE),
                    'masterdetail_mulai'=>'06:45:00',
                    'masterdetail_selesai'=>'14:45:00',
                    'masterdetail_totalkerja'=>($this->input->post('perbantuan_istirahat',TRUE)*60),
                    'masterdetail_jamkerja'=>$this->input->post('perbantuan_istirahat',TRUE),
                    'masterdetail_istirahat' => $this->input->post('perbantuan_istirahat',TRUE),
                    'masterdetail_upah' => $upah,
                    'masterdetail_usersupervisor'=>$usersupervisor,
                    'masterdetail_userinput'=>$username,
                    'masterdetail_tglinput'=>date('Y-m-d'),
            );

            $this->Trx_perbantuan_model->insertdetail($xdata);
            // Total Waktu & Master TRXMASTER
                $totalteam = $this->Trx_perbantuan_model->perbantuancount('perbantuan_karyawan_id', $perbantuan ,$this->input->post('perbantuan_shift',TRUE),$this->input->post('perbantuan_tgllaporan',TRUE),$this->input->post('perbantuan_master_id',TRUE) );
                $sumperbantuanpay = $this->Trx_perbantuan_model->sumperbantuan('perbantuan_upah',$usersupervisor,$this->input->post('perbantuan_shift',TRUE) ,$this->input->post('perbantuan_tgllaporan',TRUE), $this->input->post('perbantuan_master_id', TRUE));
                $zdata = array(
                    'master_jumlahteam' => $totalteam,
                    'master_bayarstfg' => $sumperbantuanpay, 
                    );
                    $this->Trx_perbantuan_model->updateMaster($this->input->post('perbantuan_master_id',TRUE), $zdata);
                    

                    $messege= array(
                            'messege'=> "Data Berhasil Disimpan"
                        );
                    $this->session->set_flashdata('success', $messege);
                    redirect(site_url('trx_perbantuan/plus'));

            }else{
                $messege= array(
                    'messege'=> "Transaksi tidak ada , Silahkan input kembali"
                );
                $this->session->set_flashdata('message',$messege);
                redirect(site_url('trx_perbantuan/plus'));

            }

        }
    }




    public function update($id) 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $usersupervisor=$this->session->userdata('user_supervisor');
        $row = $this->Trx_perbantuan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'perbantuan' => $this->m_general->xenums('trx_perbantuan','perbantuan_kategori'),
                'shift' => $this->m_general->tampil_data_perfield1('stx_shift','shift_status','Aktif'),
                'button' => 'Update',
                'action' => site_url('trx_perbantuan/update_action'),
            		'perbantuan_id' => set_value('perbantuan_id', $row->perbantuan_id),
            		'perbantuan_karyawan_id' => set_value('perbantuan_karyawan_id', $row->perbantuan_karyawan_id),
            		'perbantuan_kategori' => set_value('perbantuan_kategori', $row->perbantuan_kategori),
            		'perbantuan_shift' => set_value('perbantuan_shift', $row->perbantuan_shift),
            		'perbantuan_master_id' => set_value('perbantuan_master_id', $row->perbantuan_master_id),
            		'perbantuan_mulai' => set_value('perbantuan_mulai', $row->perbantuan_mulai),
            		'perbantuan_selesai' => set_value('perbantuan_selesai', $row->perbantuan_selesai),
            		'perbantuan_istirahat' => set_value('perbantuan_istirahat', $row->perbantuan_istirahat),
            		'perbantuan_totalmenit' => set_value('perbantuan_totalmenit', $row->perbantuan_totalmenit),
            		'perbantuan_upah' => set_value('perbantuan_upah', $row->perbantuan_upah),
            		'perbantuan_tgllaporan' => set_value('perbantuan_tgllaporan', $row->perbantuan_tgllaporan),
            		'perbantuan_userinput' => set_value('perbantuan_userinput', $row->perbantuan_userinput),
            		'perbantuan_tglinput' => set_value('perbantuan_tglinput', $row->perbantuan_tglinput),
                    'codeid'=>$this->Trx_perbantuan_model->trxgetcode('masterdetail_id',set_value('perbantuan_karyawan_id', $row->perbantuan_karyawan_id),set_value('perbantuan_master_id', $row->perbantuan_master_id)),
    	    );
            
            $x['content']=$this->load->view('trx_perbantuan/trx_perbantuan_form_update', $data,true);
            $this->load->view('template',$x);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_perbantuan'));
        }
    }
    
    public function update_action() 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $usersupervisor=$this->session->userdata('user_supervisor');
             
        $patas = $this->m_general->hargaproduk('stx_produk','produk_step_final','produk_id','P777777');
        
        $ptengah = $this->m_general->hargaproduk('stx_produk','produk_step_final','produk_id','P777779');

        $pbawah = $this->m_general->hargaproduk('stx_produk','produk_step_final','produk_id','P777778');




        $this->_rules();

       /* if($this->input->post('perbantuan')=="Bantuan Yupi") $perbantuan='Bantuan Yupi'; else $perbantuan='Sortir Mogul';
            if (strtotime($this->input->post('perbantuan_mulai',TRUE)) > strtotime($this->input->post('perbantuan_selesai',TRUE))) {
                $tengah  ="24:00";
                $noll  ="00:00";
                $ztotalkerja = ((abs((strtotime($noll) - strtotime($this->input->post('perbantuan_selesai',TRUE))))/60) + ((strtotime($tengah) - strtotime($this->input->post('perbantuan_mulai',TRUE)))/60));
                $ztotal = $ztotalkerja - $this->input->post('perbantuan_istirahat',TRUE);
                }else {
                    $ztotalkerja = (strtotime($this->input->post('perbantuan_selesai',TRUE)) -  strtotime($this->input->post('perbantuan_mulai',TRUE)))/60;
                    $ztotal = $ztotalkerja - $this->input->post('perbantuan_istirahat',TRUE);
            } */


        if($this->input->post('perbantuan')=="Bantuan Yupi") {
            $bantuan='Bantuan Yupi';
            $fupah = $patas;
            
            }elseif ($this->input->post('perbantuan')=="Yupi Skill"){
                $bantuan='Yupi Skill';
                $fupah = $ptengah;
                
                }else{
                $bantuan ='Sortir Mogul';
                $fupah = $pbawah;
                }


        //$upah = floor(($ztotal * 16714 )/60);
        $upah = floor(($this->input->post('perbantuan_istirahat') * $fupah ));


        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('perbantuan_id', TRUE));
        } else {
            $xdata = array(
    		'perbantuan_karyawan_id' => $this->input->post('perbantuan_karyawan_id',TRUE),
            'perbantuan_kategori' => $bantuan,
            'perbantuan_shift' => $this->input->post('perbantuan_shift', TRUE),
    		'perbantuan_mulai' => '06:45:00',
    		'perbantuan_selesai' => '14:45:00',
    		'perbantuan_istirahat' => $this->input->post('perbantuan_istirahat',TRUE),
    		'perbantuan_totalmenit' => ($this->input->post('perbantuan_istirahat',TRUE)*60),
    		'perbantuan_upah' => $upah,
	    );
            $this->Trx_perbantuan_model->update($this->input->post('perbantuan_id', TRUE), $xdata);

           
        $ydata = array(
            'masterdetail_karyawan_id' => $this->input->post('perbantuan_karyawan_id',TRUE),
            'masterdetail_mulai' => '06:45:00',
            'masterdetail_selesai' => '14:45:00',
            'masterdetail_istirahat' => $this->input->post('perbantuan_istirahat',TRUE),
            'masterdetail_jamkerja' =>  $this->input->post('perbantuan_istirahat',TRUE),
            'masterdetail_totalkerja' =>($this->input->post('perbantuan_istirahat',TRUE)*60),
            'masterdetail_upah' => $upah,
        );
           $this->Trx_perbantuan_model->updateDetail($this->input->post('codeid',TRUE), $ydata);
        
        $sumperbantuanpay = $this->Trx_perbantuan_model->sumperbantuan('perbantuan_upah',$usersupervisor,$this->input->post('perbantuan_shift',TRUE) ,$this->input->post('perbantuan_tgllaporan',TRUE), $this->input->post('perbantuan_master_id', TRUE));   

        $zdata = array(
                    'master_shift' => $this->input->post('perbantuan_shift', TRUE),
                    'master_acuanmesin' =>$bantuan,
                    'master_bayarstfg' => $sumperbantuanpay,
                    );
        $this->Trx_perbantuan_model->updateMaster($this->input->post('perbantuan_master_id',TRUE), $zdata);


        $messege= array(
                    'messege'=> "Update Berhasil Disimpan"
                );
            $this->session->set_flashdata('success', $messege);
            redirect(site_url('trx_perbantuan'. '/index?q=' . urlencode($this->input->post('perbantuan_produk_id',TRUE)) . '&t='. urlencode($this->input->post('perbantuan_tgllaporan',TRUE)) . '&s='. urlencode($this->input->post('perbantuan_shift',TRUE))));
        }
    }
    
    public function delete($id) 
    {
        $usersupervisor=$this->session->userdata('user_supervisor');
        $row = $this->Trx_perbantuan_model->get_by_id($id);
        

        if ($row) {
        $codeid = $this->m_general->trxgetcode('masterdetail_id',set_value('perbantuan_karyawan_id', $row->perbantuan_karyawan_id),set_value('perbantuan_master_id', $row->perbantuan_master_id ));

            $this->Trx_perbantuan_model->delete($id);
            $this->Trx_perbantuan_model->deleteDetail($codeid);
            //Recalculate Team & time working
            $totalteam = $this->Trx_perbantuan_model->perbantuancount('perbantuan_karyawan_id',set_value('perbantuan_kategori', $row->perbantuan_kategori),set_value('perbantuan_shift', $row->perbantuan_shift),set_value('perbantuan_tgllaporan', $row->perbantuan_tgllaporan),set_value('perbantuan_master_id', $row->perbantuan_master_id));
            $sumperbantuanpay = $this->Trx_perbantuan_model->sumperbantuan('perbantuan_upah',$usersupervisor,set_value('perbantuan_shift', $row->perbantuan_shift),set_value('perbantuan_tgllaporan', $row->perbantuan_tgllaporan),set_value('perbantuan_master_id', $row->perbantuan_master_id)); 
        
    
            if ($totalteam =='0'){
                $this->Trx_perbantuan_model->deletemaster(set_value('perbantuan_master_id', $row->perbantuan_master_id));
                
            }else {
            $zdata = array(
                    'master_jumlahteam' => $totalteam,
                    'master_bayarstfg' => $sumperbantuanpay,  
                    );
            $this->Trx_perbantuan_model->updateMaster(set_value('perbantuan_master_id', $row->perbantuan_master_id), $zdata);

            }    



            $messege= array(
                    'messege'=> "Delete Transaksi telah berhasil"
                );
            $this->session->set_flashdata('success', $messege);
        //redirect(site_url('trx_perbantuan'. '/index?q=' . urlencode(set_value('perbantuan_produk_id', $row->perbantuan_produk_id)) . '&t='. urlencode(set_value('perbantuan_tgllaporan', $row->perbantuan_tgllaporan)) . '&s='. urlencode(set_value('perbantuan_shift', $row->perbantuan_shift))));
           redirect(site_url('trx_perbantuan'));
    } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_perbantuan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('perbantuan_id', 'perbantuan id', 'trim');
	$this->form_validation->set_rules('perbantuan_karyawan_id', 'perbantuan karyawan id', 'trim');
	$this->form_validation->set_rules('perbantuan_kategori', 'perbantuan produk id', 'trim');
	$this->form_validation->set_rules('perbantuan_shift', 'perbantuan shift', 'trim');
	$this->form_validation->set_rules('perbantuan_master_id', 'perbantuan master id', 'trim');
	$this->form_validation->set_rules('perbantuan_mulai', 'perbantuan mulai', 'trim');
	$this->form_validation->set_rules('perbantuan_selesai', 'perbantuan selesai', 'trim');
	$this->form_validation->set_rules('perbantuan_istirahat', 'perbantuan istirahat', 'trim');
	$this->form_validation->set_rules('perbantuan_totalmenit', 'perbantuan totalmenit', 'trim');
	$this->form_validation->set_rules('perbantuan_upah', 'perbantuan upah', 'trim|numeric');
	$this->form_validation->set_rules('perbantuan_tgllaporan', 'perbantuan tgllaporan', 'trim');
	$this->form_validation->set_rules('perbantuan_userinput', 'perbantuan userinput', 'trim');
	$this->form_validation->set_rules('perbantuan_tglinput', 'perbantuan tglinput', 'trim');

	$this->form_validation->set_rules('', '', 'trim');
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
            $x['data_perbantuan']=$this->Trx_perbantuan_model->download_perbantuan('',$date_input,'');
        }else{
            $x['data_perbantuan']=$this->Trx_perbantuan_model->download_perbantuan($username,$date_input, $xid_group);
        }
        
        $this->load->view('trx_perbantuan/excel_trx_perbantuan',$x);
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "trx_perbantuan.xls";
        $judul = "trx_perbantuan";
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
    	xlsWriteLabel($tablehead, $kolomhead++, "Perbantuan Id");
    	xlsWriteLabel($tablehead, $kolomhead++, "Perbantuan Karyawan Id");
    	xlsWriteLabel($tablehead, $kolomhead++, "Perbantuan Produk Id");
    	xlsWriteLabel($tablehead, $kolomhead++, "Perbantuan Shift");
    	xlsWriteLabel($tablehead, $kolomhead++, "Perbantuan Master Id");
    	xlsWriteLabel($tablehead, $kolomhead++, "Perbantuan Mulai");
    	xlsWriteLabel($tablehead, $kolomhead++, "Perbantuan Selesai");
    	xlsWriteLabel($tablehead, $kolomhead++, "Perbantuan Istirahat");
    	xlsWriteLabel($tablehead, $kolomhead++, "Perbantuan Totalmenit");
    	xlsWriteLabel($tablehead, $kolomhead++, "Perbantuan Upah");
    	xlsWriteLabel($tablehead, $kolomhead++, "Perbantuan Tgllaporan");
    	xlsWriteLabel($tablehead, $kolomhead++, "Perbantuan Userinput");
    	xlsWriteLabel($tablehead, $kolomhead++, "Perbantuan Tglinput");

	foreach ($this->Trx_perbantuan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->perbantuan_id);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->perbantuan_karyawan_id);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->perbantuan_kategori);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->perbantuan_shift);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->perbantuan_master_id);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->perbantuan_mulai);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->perbantuan_selesai);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->perbantuan_istirahat);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->perbantuan_totalmenit);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->perbantuan_upah);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->perbantuan_tgllaporan);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->perbantuan_userinput);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->perbantuan_tglinput);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }


}

/* End of file Trx_perbantuan.php */
/* Location: ./application/controllers/Trx_perbantuan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-16 19:35:10 */
/* http://harviacode.com */
