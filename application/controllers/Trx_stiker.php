<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trx_stiker extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Trx_stiker_model');
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
        $priv=$this->m_general->get_privilage($id_group,'trx_stiker');      
        $x['add']='N';
        $x['update']='N';
        $x['delete']='N';
        $x['comment1']='N';
        $x['report']='N';
        foreach ($priv as $a) {
            $id_group=$id_group;
            $nav_url='trx_stiker';
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
            $config['base_url'] = base_url() . 'trx_stiker/index.html?q=' . urlencode($q) . '&t='. urlencode($t). '&s='. urlencode($s);
            $config['first_url'] = base_url() . 'trx_stiker/index.html?q=' . urlencode($q) . '&t='. urlencode($t) . '&s='. urlencode($s);
            $config['per_page'] = 0;

        } elseif (($s <> '') and ($t <> '') and ($q == '')){
            $config['base_url'] = base_url() . 'trx_stiker/index.html?t='. urlencode($t). '&s='. urlencode($s);;
            $config['first_url'] = base_url() . 'trx_stiker/index.html?t='. urlencode($t). '&s='. urlencode($s);;
            $config['per_page'] = 0;

        }else {
            $config['base_url'] = base_url() . 'trx_stiker/index.html';
            $config['first_url'] = base_url() . 'trx_stiker';
            $config['per_page'] = 25;
        }

        $config['page_query_string'] = TRUE;
        $trx_stiker = $this->Trx_stiker_model->tampil_data($config['per_page'], $start, $q, $username,$id_group,$s, $t );
        $config['total_rows'] = $this->Trx_stiker_model->total_rows($q, $username, $id_group,$s, $t);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'trx_stiker_data' => $trx_stiker,
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
            'priv_count' =>$this->m_general->cek_privilage($id_group,'trx_stiker'),
        );
        $x['content']=$this->load->view('trx_stiker/trx_stiker_list', $data,TRUE);
        $this->load->view('template',$x);
    }

    public function read($id) 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $row = $this->Trx_stiker_model->get_by_id($id);
        if ($row) {
            $data = array(
    		'stiker_id' => $row->stiker_id,
    		'stiker_karyawan_id' => $row->stiker_karyawan_id,
            'karyawan_nama' => $row->karyawan_nama,
            'produk_nama' => $row->produk_nama,
            'stiker_master_id' => $row->stiker_master_id,
    		'stiker_produk_id' => $row->stiker_produk_id,
    		'stiker_kategori' => $row->stiker_kategori,
    		'stiker_shift' => $row->stiker_shift,
    		'stiker_jumlahstiker' => $row->stiker_jumlahstiker,
            'stiker_jumlahteam' => $row->stiker_jumlahteam,
    		'stiker_upah' => $row->stiker_upah,
    		'stiker_tgllaporan' => $row->stiker_tgllaporan,
    		'stiker_userinput' => $row->stiker_userinput,
    		'stiker_tglinput' => $row->stiker_tglinput,
	    );
            $x['content']=$this->load->view('trx_stiker/trx_stiker_read', $data,true);
            $this->load->view('template',$x);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_stiker'));
        }
    }

    public function create() 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $usersupervisor=$this->session->userdata('user_supervisor');
        $data = array(
            'stiker' => $this->m_general->xenums('trx_stiker','stiker_kategori'),
            'produk' => $this->m_general->tampil_produkid('stx_produk','produk_status','Aktif', 'produk_usersupervisor',$usersupervisor),
            'shift' => $this->m_general->tampil_data_perfield1('stx_shift','shift_status','Aktif'),
            'button' => 'Create',
            'action' => site_url('trx_stiker/create_action'),
    	    'stiker_id' => set_value('stiker_id'),
    	    'stiker_karyawan_id' => set_value('stiker_karyawan_id'),
    	    'stiker_produk_id' => set_value('stiker_produk_id'),
    	    'stiker_kategori' => set_value('stiker_kategori'),
    	    'stiker_shift' => set_value('stiker_shift'),
    	    'stiker_jumlahstiker' => set_value('stiker_jumlahstiker'),
            'stiker_jumlahteam' => set_value('stiker_jumlahteam'),
    	    'stiker_upah' => set_value('stiker_upah'),
    	    'stiker_tgllaporan' => set_value('stiker_tgllaporan'),
    	    'stiker_userinput' => set_value('stiker_userinput'),
    	    'stiker_tglinput' => set_value('stiker_tglinput'),
	);
        $x['content']=$this->load->view('trx_stiker/trx_stiker_form', $data,TRUE);
        $this->load->view('template',$x);
    }
    
    

    public function create_action() 
    {
        
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $usersupervisor=$this->session->userdata('user_supervisor'); 
        $satas = $this->m_general->hargaproduk('stx_produk','produk_step_final','produk_id','S777777');
        $sbawah = $this->m_general->hargaproduk('stx_produk','produk_step_final','produk_id','S777778');

        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $count = count($_POST['count']); 
            $codeid = $this->m_general->getcode('trx_master','master_id','STI-');
    
            if($this->input->post('stiker')=="Sachet / Bag") {
                $stiker='Sachet / Bag';
                $rupah = ($satas *  $this->input->post('stiker_jumlahstiker',TRUE));
                //$upah = floor(((33 *  $this->input->post('stiker_jumlahstiker',TRUE)) / $count ));
                $upah = floor((($satas *  $this->input->post('stiker_jumlahstiker',TRUE)) / $count ));
            }else{            
                $stiker='Display / Box';
                $rupah = ($sbawah *  $this->input->post('stiker_jumlahstiker',TRUE) ); 
                //$upah = floor(((28 *  $this->input->post('stiker_jumlahstiker',TRUE) ) / $count ));
                $upah = floor((($sbawah *  $this->input->post('stiker_jumlahstiker',TRUE)) / $count ));
             }


            $result = $this->Trx_stiker_model->batchInsert($_POST,$codeid, $upah,$stiker,$username, $usersupervisor ); // Insert to trx_mesin table            
            
            $data = array(
            'master_id' => $codeid,
            'master_module_id' => '4',
            'master_produk_id' => $this->input->post('stiker_produk_id',TRUE),
            'master_shift' => $this->input->post('stiker_shift',TRUE),
            'master_jumlahstiker' => $this->input->post('stiker_jumlahstiker',TRUE),
            'master_jumlahteam' => $count,
            'master_bayarstfg' => $rupah,
            'master_tgllaporan' => $this->input->post('stiker_tgllaporan',TRUE),
            'master_usersupervisor' => $usersupervisor,
            'master_userinput' => $username,
            'master_tglinput' => date('Y-m-d'),
	    );
        $this->Trx_stiker_model->insertMaster($data); // insert to trx_master  
        
                       
           
            if($result){
                echo 1;
            }
            else{
                echo 0;
            }
            exit;
            redirect(site_url('trx_stiker/create'));
            
            $this->session->set_flashdata('message', 'Create Record Success');
        }
    }


    public function plus() 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $usersupervisor=$this->session->userdata('user_supervisor');
        $data = array(
            'stiker' => $this->m_general->xenums('trx_stiker','stiker_kategori'),
            'produk' => $this->m_general->tampil_produkid('stx_produk','produk_status','Aktif', 'produk_usersupervisor',$usersupervisor),
            'shift' => $this->m_general->tampil_data_perfield1('stx_shift','shift_status','Aktif'),
            'button' => 'Create',
            'action' => site_url('trx_stiker/create_plus'),
        'stiker_id' => set_value('stiker_id'),
        'stiker_master_id' => set_value('stiker_master_id'),
        'stiker_karyawan_id' => set_value('stiker_karyawan_id'),
        'stiker_produk_id' => set_value('stiker_produk_id'),
        'stiker_kategori' => set_value('stiker_kategori'),
        'stiker_shift' => set_value('stiker_shift'),
        'stiker_jumlahstiker' => set_value('stiker_jumlahstiker'),
        'stiker_jumlahteam' => set_value('stiker_jumlahteam'),
        'stiker_upah' => set_value('stiker_upah'),
        'stiker_tgllaporan' => set_value('stiker_tgllaporan'),
        'stiker_usersupervisor' => set_value('stiker_usersupervisor'),
        'stiker_userinput' => set_value('stiker_userinput'),
        'stiker_tglinput' => set_value('stiker_tglinput'),
    );
        $x['content']=$this->load->view('trx_stiker/trx_stiker_form_plus', $data,TRUE);
        $this->load->view('template',$x);
    }
    
    public function create_plus() 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $usersupervisor=$this->session->userdata('user_supervisor'); 
        $satas = $this->m_general->hargaproduk('stx_produk','produk_step_final','produk_id','S777777');
        $sbawah = $this->m_general->hargaproduk('stx_produk','produk_step_final','produk_id','S777778');

        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

        $stikercode = $this->Trx_stiker_model->gettrxmaster($this->input->post('stiker_produk_id', TRUE),$this->input->post('stiker_tgllaporan', TRUE),$this->input->post('stiker_shift', TRUE), '4');

        if ($stikercode){
            $pekerja = $this->Trx_stiker_model->countstiker('stiker_karyawan_id', $this->input->post('stiker_produk_id', TRUE),$this->input->post('stiker_tgllaporan', TRUE),$this->input->post('stiker_shift', TRUE));
            $jumlahpekerja = $pekerja + 1 ;

            if($this->input->post('stiker')=="Sachet / Bag") {
                $stiker='Sachet / Bag';
                //$rupah = ($satas *  $this->input->post('stiker_jumlahstiker',TRUE));
                //$upah = floor(((33 *  $this->input->post('stiker_jumlahstiker',TRUE)) / $count ));
                $xupah = floor((($satas *  $this->input->post('stiker_jumlahstiker',TRUE)) / $jumlahpekerja ));
            }else{            
                $stiker='Display / Box';
                //$rupah = ($sbawah *  $this->input->post('stiker_jumlahstiker',TRUE) ); 
                //$upah = floor(((28 *  $this->input->post('stiker_jumlahstiker',TRUE) ) / $count ));
                $xupah = floor((($sbawah *  $this->input->post('stiker_jumlahstiker',TRUE)) / $jumlahpekerja ));
             }

            /*if($this->input->post('stiker')=="Sachet / Bag") {
                $stiker='Sachet / Bag';
                //$xupah = floor(((33 * $this->input->post('stiker_jumlahstiker',TRUE) ) / $jumlahpekerja));
                $xupah = floor((($satas *  $this->input->post('stiker_jumlahstiker',TRUE)) / $count ));
             }else{
                $stiker='Display / Box'; 
                $xupah = floor(((28 * $this->input->post('stiker_jumlahstiker',TRUE) ) / $jumlahpekerja));
            }*/

                $mastercode =  $this->input->post('stiker_master_id',TRUE);
                
                $data = array(
                        'stiker_master_id' => $this->input->post('stiker_master_id',TRUE),
                        'stiker_karyawan_id' => $this->input->post('stiker_karyawan_id',TRUE),
                        'stiker_produk_id' => $this->input->post('stiker_produk_id',TRUE),
                        'stiker_kategori' => $stiker,
                        'stiker_shift' => $this->input->post('stiker_shift',TRUE),
                        'stiker_jumlahstiker' => $this->input->post('stiker_jumlahstiker',TRUE),
                        'stiker_jumlahteam' => $jumlahpekerja,
                        'stiker_upah' => $xupah,
                        'stiker_tgllaporan' => $this->input->post('stiker_tgllaporan',TRUE),
                        'stiker_userinput' => $username,
                        'stiker_usersupervisor' => $usersupervisor,
                        'stiker_tglinput' => date('Y-m-d'),
                );

                $this->Trx_stiker_model->insert($data);
                
                $datax = array(
                        'masterdetail_karyawan_id'=>$this->input->post('stiker_karyawan_id',TRUE),               
                        'masterdetail_master_id'=>$this->input->post('stiker_master_id',TRUE),
                        'masterdetail_jumlahstiker'=>$this->input->post('stiker_jumlahstiker',TRUE),
                        'masterdetail_upah'=>$xupah,
                        'masterdetail_usersupervisor'=>$usersupervisor,
                        'masterdetail_userinput'=>$username,
                        'masterdetail_tglinput'=>date('Y-m-d'), 
                        );

                 $this->Trx_stiker_model->insertdetail($datax);

                    $this->db->query("UPDATE trx_stiker SET stiker_upah = $xupah, stiker_jumlahteam = $jumlahpekerja  WHERE stiker_master_id =  '$mastercode'");
                    $this->db->query("UPDATE trx_masterdetail SET masterdetail_upah = $xupah WHERE masterdetail_master_id =  '$mastercode'");
                    $this->db->query("UPDATE trx_master SET master_jumlahteam = $jumlahpekerja WHERE master_id =  '$mastercode'");
                   

                    $messege= array(
                            'messege'=> "Data Berhasil Disimpan"
                        );
                    $this->session->set_flashdata('success', $messege);
                    redirect(site_url('trx_stiker/plus'));

            }else{
                $messege= array(
                    'messege'=> "Transaksi tidak ada , Silahkan input kembali"
                );
                $this->session->set_flashdata('message',$messege);
                redirect(site_url('trx_stiker/plus'));

            }

        }
    }



    
    public function update($id) 
    {

        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $usersupervisor=$this->session->userdata('user_supervisor');

        $row = $this->Trx_stiker_model->get_by_id($id);

        if ($row) {
            $data = array(
                'stiker' => $this->m_general->xenums('trx_stiker','stiker_kategori'),
                'produk' => $this->m_general->tampil_produkid('stx_produk','produk_status','Aktif', 'produk_usersupervisor',$usersupervisor),
                'shift' => $this->m_general->tampil_data_perfield1('stx_shift','shift_status','Aktif'),
                'button' => 'Update',
                'action' => site_url('trx_stiker/update_action'),
        		'stiker_id' => set_value('stiker_id', $row->stiker_id),
        		'stiker_karyawan_id' => set_value('stiker_karyawan_id', $row->stiker_karyawan_id),
                'stiker_master_id' => set_value('stiker_master_id', $row->stiker_master_id),
        		'stiker_produk_id' => set_value('stiker_produk_id', $row->stiker_produk_id),
        		'stiker_kategori' => set_value('stiker_kategori', $row->stiker_kategori),
        		'stiker_shift' => set_value('stiker_shift', $row->stiker_shift),
        		'stiker_jumlahstiker' => set_value('stiker_jumlahstiker', $row->stiker_jumlahstiker),
                'stiker_jumlahteam' => set_value('stiker_jumlahteam', $row->stiker_jumlahteam),
        		'stiker_upah' => set_value('stiker_upah', $row->stiker_upah),
        		'stiker_tgllaporan' => set_value('stiker_tgllaporan', $row->stiker_tgllaporan),
                'codeid'=>$this->m_general->trxgetcode('masterdetail_id',set_value('stiker_karyawan_id', $row->stiker_karyawan_id),set_value('stiker_master_id', $row->stiker_master_id)),
	    );

         

        $x['content']=$this->load->view('trx_stiker/trx_stiker_form_update', $data,true);
        $this->load->view('template',$x);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_stiker'));
        }
    }
    
    public function update_action() 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $usersupervisor=$this->session->userdata('user_supervisor');
        $satas = $this->m_general->hargaproduk('stx_produk','produk_step_final','produk_id','S777777');
        $sbawah = $this->m_general->hargaproduk('stx_produk','produk_step_final','produk_id','S777778');
        
        $this->_rules();

        $pekerja = $this->Trx_stiker_model->countstiker('stiker_karyawan_id', $this->input->post('stiker_produk_id', TRUE),$this->input->post('stiker_tgllaporan', TRUE),$this->input->post('stiker_shift', TRUE));

        $pekerja = $this->Trx_stiker_model->stikercount('stiker_karyawan_id', $this->input->post('stiker_produk_id', TRUE),$this->input->post('stiker_shift', TRUE),$this->input->post('stiker_tgllaporan', TRUE),$this->input->post('stiker_master_id', TRUE));


        $jumlahstiker = $this->input->post('stiker_jumlahstiker',TRUE);
        $mastercode =  $this->input->post('stiker_master_id',TRUE);
/*
        if($this->input->post('stiker')=="Sachet / Bag") {
            $stiker='Sachet / Bag';
            $upah = floor(((33 * $jumlahstiker ) / $pekerja));
         }else{
            $stiker='Display / Box'; 
            $upah = floor(((28 * $jumlahstiker ) / $pekerja));
            }     
*/

            if($this->input->post('stiker')=="Sachet / Bag") {
                $stiker='Sachet / Bag';
                $upah = floor((($satas *  $jumlahstiker) / $pekerja ));
            }else{            
                $stiker='Display / Box';
                $upah = floor((($sbawah *  $jumlahstiker) / $pekerja ));
             }

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('stiker_id', TRUE));
        } else {

            $xdata = array(
    		'stiker_karyawan_id' => $this->input->post('stiker_karyawan_id',TRUE),
            'stiker_produk_id' => $this->input->post('stiker_produk_id',TRUE),
            'stiker_kategori' => $stiker,
            'stiker_shift' => $this->input->post('stiker_shift',TRUE),
    		'stiker_jumlahstiker' => $this->input->post('stiker_jumlahstiker',TRUE),
	    );
            $this->Trx_stiker_model->update($this->input->post('stiker_id', TRUE), $xdata);
          

            $ydata = array(
            'masterdetail_karyawan_id' => $this->input->post('stiker_karyawan_id',TRUE),
            'masterdetail_jumlahstiker' => $this->input->post('stiker_jumlahstiker',TRUE),
        );
           $this->Trx_stiker_model->updateDetail($this->input->post('codeid',TRUE), $ydata);


        $mdata = array(
            'master_produk_id' => $this->input->post('stiker_produk_id',TRUE),
            'master_shift' => $this->input->post('stiker_shift',TRUE),
            'master_jumlahstiker' => $this->input->post('stiker_jumlahstiker',TRUE),
        );
           $this->Trx_stiker_model->updatemaster($this->input->post('codeid',TRUE), $mdata);

        
        $this->db->query("UPDATE trx_stiker SET stiker_upah = $upah, stiker_jumlahstiker = $jumlahstiker  WHERE stiker_master_id =  '$mastercode'");
        $this->db->query("UPDATE trx_masterdetail SET masterdetail_upah = $upah, masterdetail_jumlahstiker = $jumlahstiker WHERE masterdetail_master_id =  '$mastercode'");
                          

        $messege= array(
                    'messege'=> "Update Berhasil Disimpan"
                );
            $this->session->set_flashdata('success', $messege);
        redirect(site_url('trx_stiker'. '/index?q=' . urlencode($this->input->post('stiker_produk_id',TRUE)) . '&t='. urlencode($this->input->post('stiker_tgllaporan',TRUE)) . '&s='. urlencode($this->input->post('stiker_shift',TRUE))));
        }
    }
    
    public function delete($id) 
    {
        $usersupervisor=$this->session->userdata('user_supervisor');
        $row = $this->Trx_stiker_model->get_by_id($id);

        if ($row) {
        $codeid = $this->m_general->trxgetcode('masterdetail_id',set_value('stiker_karyawan_id', $row->stiker_karyawan_id),set_value('stiker_master_id', $row->stiker_master_id ));

        $mastercode = set_value('stiker_master_id', $row->stiker_master_id);
        $jumlahpekerja = ( set_value('stiker_jumlahteam', $row->stiker_jumlahteam) - 1);
        $satas = $this->m_general->hargaproduk('stx_produk','produk_step_final','produk_id','S777777');
        $sbawah = $this->m_general->hargaproduk('stx_produk','produk_step_final','produk_id','S777778');       


            $this->Trx_stiker_model->delete($id);
            $this->Trx_stiker_model->deleteDetail($codeid);

            $totalteam = $this->Trx_stiker_model->stikercount('stiker_karyawan_id',set_value('stiker_produk_id', $row->stiker_produk_id),set_value('stiker_shift', $row->stiker_shift),set_value('stiker_tgllaporan', $row->stiker_tgllaporan),set_value('stiker_master_id', $row->stiker_master_id));

    
            if ($totalteam =='0'){
                $this->Trx_stiker_model->deletemaster(set_value('stiker_master_id', $row->stiker_master_id));
                
            }else {
                if(set_value('stiker_kategori', $row->stiker_kategori)=="Sachet / Bag") {
                    $stiker='Sachet / Bag';
                    $xupah = floor((($satas *  set_value('stiker_jumlahstiker', $row->stiker_jumlahstiker)) / $jumlahpekerja ));
                }else{            
                    $stiker='Display / Box';
                    $xupah = floor((($sbawah *  set_value('stiker_jumlahstiker', $row->stiker_jumlahstiker)) / $jumlahpekerja ));
                 }


/*
            if(set_value('stiker_kategori', $row->stiker_kategori)=="Sachet / Bag") {
                    $stiker='Sachet / Bag';
                    $xupah = floor(((33 * set_value('stiker_jumlahstiker', $row->stiker_jumlahstiker) ) / $jumlahpekerja));
            }else{
                    $stiker='Display / Box'; 
                    $xupah = floor(((28 *  set_value('stiker_jumlahstiker', $row->stiker_jumlahstiker)) / $jumlahpekerja));
            }
*/        
                $this->db->query("UPDATE trx_stiker SET stiker_upah = $xupah, stiker_jumlahteam = $totalteam  WHERE stiker_master_id =  '$mastercode'");
                $this->db->query("UPDATE trx_masterdetail SET masterdetail_upah = $xupah WHERE masterdetail_master_id =  '$mastercode'");
                $this->db->query("UPDATE trx_master SET master_jumlahteam = $totalteam  WHERE master_id =  '$mastercode'");
            } 

      
            $messege= array(
                    'messege'=> "Delete Transaksi telah berhasil"
                );
            $this->session->set_flashdata('success', $messege);
       redirect(site_url('trx_stiker'. '/index?q=' . urlencode(set_value('stiker_produk_id', $row->stiker_produk_id)) . '&t='. urlencode(set_value('stiker_tgllaporan', $row->stiker_tgllaporan)) . '&s='. urlencode(set_value('stiker_shift', $row->stiker_shift))));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_stiker'));
        }
    }

    public function _rules() 
    {
    	$this->form_validation->set_rules('stiker_karyawan_id', 'stiker karyawan id', 'trim');
    	$this->form_validation->set_rules('stiker_produk_id', 'stiker produk id', 'trim');
    	$this->form_validation->set_rules('stiker_kategori', 'stiker kategori', 'trim');
    	$this->form_validation->set_rules('stiker_shift', 'stiker shift', 'trim');
    	$this->form_validation->set_rules('stiker_jumlahstiker', 'stiker jumlahstiker', 'trim');
        $this->form_validation->set_rules('stiker_jumlahteam', 'stiker jumlahteam', 'trim');
    	$this->form_validation->set_rules('stiker_upah', 'stiker upah', 'trim');
    	$this->form_validation->set_rules('stiker_tgllaporan', 'stiker tgllaporan', 'trim');
    	$this->form_validation->set_rules('stiker_userinput', 'stiker userinput', 'trim');
    	$this->form_validation->set_rules('stiker_tglinput', 'stiker tglinput', 'trim');
    	$this->form_validation->set_rules('stiker_id', 'stiker_id', 'trim');
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
            $x['data_stiker']=$this->Trx_stiker_model->download_stiker('',$date_input,'');
        }else{
            $x['data_stiker']=$this->Trx_stiker_model->download_stiker($username,$date_input, $xid_group);
        }
        
        $this->load->view('trx_stiker/excel_trx_stiker',$x);
    }

}
