<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trx_susun extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Trx_susun_model');
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
        $priv=$this->m_general->get_privilage($id_group,'trx_susun');      
        $x['add']='N';
        $x['update']='N';
        $x['delete']='N';
        $x['comment1']='N';
        $x['report']='N';
        foreach ($priv as $a) {
            $id_group=$id_group;
            $nav_url='trx_susun';
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
            $config['base_url'] = base_url() . 'trx_susun/index.html?q=' . urlencode($q) . '&t='. urlencode($t). '&s='. urlencode($s);
            $config['first_url'] = base_url() . 'trx_susun/index.html?q=' . urlencode($q) . '&t='. urlencode($t) . '&s='. urlencode($s);
            $config['per_page'] = 0;

        } elseif (($s <> '') and ($t <> '') and ($q == '')){
            $config['base_url'] = base_url() . 'trx_susun/index.html?t='. urlencode($t). '&s='. urlencode($s);;
            $config['first_url'] = base_url() . 'trx_susun/index.html?t='. urlencode($t). '&s='. urlencode($s);;
            $config['per_page'] = 0;

        }else {
            $config['base_url'] = base_url() . 'trx_susun/index.html';
            $config['first_url'] = base_url() . 'trx_susun';
            $config['per_page'] = 25;
        }

        $config['page_query_string'] = TRUE;
        $trx_susun = $this->Trx_susun_model->tampil_data($config['per_page'], $start, $q, $username,$id_group ,$s, $t );
        $config['total_rows'] = $this->Trx_susun_model->total_rows($q, $username, $id_group ,$s, $t );
        
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'trx_susun_data' => $trx_susun,
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
            'priv_count' =>$this->m_general->cek_privilage($id_group,'trx_susun'),
        );
        $x['content']=$this->load->view('trx_susun/trx_susun_list', $data,TRUE);
        $this->load->view('template',$x);
    }

    public function read($id) 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');

        $row = $this->Trx_susun_model->get_by_id($id);
        if ($row) {
            $data = array(
		'susun_id' => $row->susun_id,
		'susun_karyawan_id' => $row->susun_karyawan_id,
		'susun_produk_id' => $row->susun_produk_id,
		'karyawan_nama' => $row->karyawan_nama,
        'produk_id' => $row->produk_id,
		'produk_nama' => $row->produk_nama,
		'susun_karu' => $row->susun_karu,
		'susun_master_id' => $row->susun_master_id,
        'susun_shift' => $row->susun_shift,
		'susun_krat1' => $row->susun_krat1,
		'susun_krat2' => $row->susun_krat2,
		'susun_krat3' => $row->susun_krat3,
		'susun_krat4' => $row->susun_krat4,
		'susun_krat5' => $row->susun_krat5,
		'susun_krat6' => $row->susun_krat6,
		'susun_krat7' => $row->susun_krat7,
		'susun_krat8' => $row->susun_krat8,
		'susun_krat9' => $row->susun_krat9,
		'susun_krat10' => $row->susun_krat10,
		'susun_krat11' => $row->susun_krat11,
		'susun_krat12' => $row->susun_krat12,
		'susun_krat13' => $row->susun_krat13,
		'susun_krat14' => $row->susun_krat14,
		'susun_krat15' => $row->susun_krat15,
		'susun_totalkrat' => $row->susun_totalkrat,
		'susun_upah' => $row->susun_upah,
		'susun_tgllaporan' => $row->susun_tgllaporan,
		'susun_userinput' => $row->susun_userinput,
		'susun_tglinput' => $row->susun_tglinput,
	    );
            $x['content']=$this->load->view('trx_susun/trx_susun_read', $data,true);
            $this->load->view('template',$x);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_susun'));
        }
    }

    public function create() 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $usersupervisor=$this->session->userdata('user_supervisor');
        $data = array(
        	'trxcode' => $this->m_general->getcode('trx_master','master_id','SUS-'),
        	'produk' => $this->m_general->tampil_produkid('stx_produk','produk_status','Aktif', 'produk_usersupervisor',$usersupervisor),
            'shift' => $this->m_general->tampil_data_perfield1('stx_shift','shift_status','Aktif'),
            'button' => 'Create',
            'action' => site_url('trx_susun/create_action'),
    		    'susun_id' => set_value('susun_id'),
    		    'susun_karyawan_id' => set_value('susun_karyawan_id'),
    		    'susun_produk_id' => set_value('susun_produk_id'),
    		    'susun_karu' => set_value('susun_karu'),
    		    'susun_master_id' => set_value('susun_master_id'),
                'susun_shift' => set_value('susun_shift'),
    		    'susun_krat1' => set_value('susun_krat1'),
    		    'susun_krat2' => set_value('susun_krat2'),
    		    'susun_krat3' => set_value('susun_krat3'),
    		    'susun_krat4' => set_value('susun_krat4'),
    		    'susun_krat5' => set_value('susun_krat5'),
    		    'susun_krat6' => set_value('susun_krat6'),
    		    'susun_krat7' => set_value('susun_krat7'),
    		    'susun_krat8' => set_value('susun_krat8'),
    		    'susun_krat9' => set_value('susun_krat9'),
    		    'susun_krat10' => set_value('susun_krat10'),
    		    'susun_krat11' => set_value('susun_krat11'),
    		    'susun_krat12' => set_value('susun_krat12'),
    		    'susun_krat13' => set_value('susun_krat13'),
    		    'susun_krat14' => set_value('susun_krat14'),
    		    'susun_krat15' => set_value('susun_krat15'),
    		    'susun_totalkrat' => set_value('susun_totalkrat'),
    		    'susun_upah' => set_value('susun_upah'),
    		    'susun_tgllaporan' => set_value('susun_tgllaporan'),
    		    'susun_userinput' => set_value('susun_userinput'),
    		    'susun_tglinput' => set_value('susun_tglinput'),
	);
        $x['content']=$this->load->view('trx_susun/trx_susun_form', $data,TRUE);
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
            $team = count($_POST['count']);
            $codeid = $this->m_general->getcode('trx_master','master_id','SUS-');
            $harga = $this->m_general->hargaproduk('stx_produk','produk_susun','produk_id',$this->input->post('jsusun_produk_id',TRUE));
            $result = $this->Trx_susun_model->batchInsert($_POST,$codeid ,$harga ,$username,$usersupervisor ); // Insert to trx_susun table 
            $sumpay = $this->Trx_susun_model->sumsusun('susun_upah',$usersupervisor,$this->input->post('jsusun_shift',TRUE) ,$this->input->post('jsusun_tgllaporan',TRUE),$codeid);             
            $data = array(
                'master_id' => $codeid,
                'master_module_id' => '5',
                'master_shift' => $this->input->post('jsusun_shift',TRUE),
                'master_jumlahteam' => $team,
                'master_produk_id' => $this->input->post('jsusun_produk_id',TRUE),
                'master_karu' => $this->input->post('jsusun_karu',TRUE),
                'master_bayarstfg' => $sumpay,
                'master_tgllaporan' => $this->input->post('jsusun_tgllaporan',TRUE),
                'master_usersupervisor' => $usersupervisor,
                'master_userinput' => $username,
                'master_tglinput' => date('Y-m-d'),
            );            
            $result2 = $this->Trx_susun_model->insertMaster($data); // insert to trx_master                
           
            if($result){
                echo 1;
            }
            else{
                echo 0;
            }
            exit;
            
            redirect(site_url('trx_susun/create'));
            
            $this->session->set_flashdata('message', 'Create Record Success');
            
        }
    }
    


public function plus() 
    {

        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $usersupervisor=$this->session->userdata('user_supervisor');
        $data = array(
            'produk' => $this->m_general->tampil_produkid('stx_produk','produk_status','Aktif', 'produk_usersupervisor',$usersupervisor),
            'shift' => $this->m_general->tampil_data_perfield1('stx_shift','shift_status','Aktif'),
            'button' => 'Create',
            'action' => site_url('trx_susun/create_plus'),
            'susun_id' => set_value('susun_id'),
            'susun_produk_id' => set_value('susun_produk_id'),
            'susun_karyawan_id' => set_value('susun_karyawan_id'),
            'susun_master_id' => set_value('susun_master_id'),                
            'susun_krat1' => set_value('susun_krat1'),
            'susun_krat2' => set_value('susun_krat2'),
            'susun_krat3' => set_value('susun_krat3'),
            'susun_krat4' => set_value('susun_krat4'),
            'susun_krat5' => set_value('susun_krat5'),
            'susun_krat6' => set_value('susun_krat6'),
            'susun_krat7' => set_value('susun_krat7'),
            'susun_krat8' => set_value('susun_krat8'),
            'susun_krat9' => set_value('susun_krat9'),
            'susun_krat10' => set_value('susun_krat10'),
            'susun_krat11' => set_value('susun_krat11'),
            'susun_krat12' => set_value('susun_krat12'),
            'susun_krat13' => set_value('susun_krat13'),
            'susun_krat14' => set_value('susun_krat14'),
            'susun_krat15' => set_value('susun_krat15'),
            'susun_totalkrat' => set_value('susun_totalkrat'),
            'susun_upah' => set_value('susun_upah'),
            'susun_tgllaporan' => set_value('susun_tgllaporan'),
            'susun_userinput' => set_value('susun_userinput'),
            'susun_tglinput' => set_value('susun_tglinput'),

    );
        $x['content']=$this->load->view('trx_susun/trx_susun_form_plus', $data,TRUE);
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

           $susuncode = $this->Trx_susun_model->gettrxmaster($this->input->post('susun_produk_id', TRUE),$this->input->post('susun_tgllaporan', TRUE),$this->input->post('susun_shift', TRUE), '5');

        if ($susuncode){
            $pharga = $this->m_general->hargaproduk('stx_produk','produk_susun','produk_id',$this->input->post('susun_produk_id',TRUE));
            $ptotalkrat = ($this->input->post('susun_krat1',TRUE) + $this->input->post('susun_krat2',TRUE) +$this->input->post('susun_krat3',TRUE) +$this->input->post('susun_krat4',TRUE) +$this->input->post('susun_krat5',TRUE) +$this->input->post('susun_krat6',TRUE) +$this->input->post('susun_krat7',TRUE) +$this->input->post('susun_krat8',TRUE) +$this->input->post('susun_krat9',TRUE) +$this->input->post('susun_krat10',TRUE) +$this->input->post('susun_krat11',TRUE) +$this->input->post('susun_krat12',TRUE) +$this->input->post('susun_krat13',TRUE) +$this->input->post('susun_krat14',TRUE) +$this->input->post('susun_krat15',TRUE));
            $pupah = floor($pharga * $ptotalkrat);

            $data = array(
            'susun_produk_id' => $this->input->post('susun_produk_id',TRUE),
            'susun_karyawan_id' => $this->input->post('susun_karyawan_id',TRUE),
            'susun_master_id' => $this->input->post('susun_master_id',TRUE),
            'susun_shift' => $this->input->post('susun_shift',TRUE),                 
            'susun_krat1' => $this->input->post('susun_krat1',TRUE),
            'susun_krat2' => $this->input->post('susun_krat2',TRUE),
            'susun_krat3' => $this->input->post('susun_krat3',TRUE),
            'susun_krat4' => $this->input->post('susun_krat4',TRUE),
            'susun_krat5' => $this->input->post('susun_krat5',TRUE),
            'susun_krat6' => $this->input->post('susun_krat6',TRUE),
            'susun_krat7' => $this->input->post('susun_krat7',TRUE),
            'susun_krat8' => $this->input->post('susun_krat8',TRUE),
            'susun_krat9' => $this->input->post('susun_krat9',TRUE),
            'susun_krat10' => $this->input->post('susun_krat10',TRUE),
            'susun_krat11' => $this->input->post('susun_krat11',TRUE),
            'susun_krat12' => $this->input->post('susun_krat12',TRUE),
            'susun_krat13' => $this->input->post('susun_krat13',TRUE),
            'susun_krat14' => $this->input->post('susun_krat14',TRUE),
            'susun_krat15' => $this->input->post('susun_krat15',TRUE),
            'susun_totalkrat' => $ptotalkrat,
            'susun_upah' => $pupah,
            'susun_usersupervisor' => $usersupervisor,
            'susun_tgllaporan' => $this->input->post('susun_tgllaporan',TRUE),
            'susun_userinput' => $username,
            'susun_tglinput' => date('Y-m-d'),
            );

            $this->Trx_susun_model->insert($data);

            $xdata = array(
                    'masterdetail_karyawan_id'=>$this->input->post('susun_karyawan_id',TRUE),               
                    'masterdetail_master_id'=> $this->input->post('susun_master_id', TRUE),
                    'masterdetail_jumlahkrat'=>$ptotalkrat,
                    'masterdetail_upah'=>$pupah,
                    'masterdetail_usersupervisor'=>$usersupervisor,
                    'masterdetail_userinput'=>$username,
                    'masterdetail_tglinput'=>date('Y-m-d'),
            );

            $this->Trx_susun_model->insertdetail($xdata);

         // Total Waktu & Master TRXMASTER
                $totalteam = $this->Trx_susun_model->susuncount('susun_karyawan_id', $this->input->post('susun_produk_id',TRUE),$this->input->post('susun_shift',TRUE),$this->input->post('susun_tgllaporan',TRUE),$this->input->post('susun_master_id',TRUE) );
                $sumpay = $this->Trx_susun_model->sumsusun('susun_upah',$usersupervisor,$this->input->post('susun_shift',TRUE) ,$this->input->post('susun_tgllaporan',TRUE), $this->input->post('susun_master_id',TRUE));
        
                $zdata = array(
                    'master_jumlahteam' => $totalteam,
                    'master_bayarstfg' => $sumpay,

                    );
                    $this->Trx_susun_model->updateMaster($this->input->post('susun_master_id',TRUE), $zdata);
                    

                    $messege= array(
                            'messege'=> "Data Berhasil Disimpan"
                        );
                    $this->session->set_flashdata('success', $messege);
                    redirect(site_url('trx_susun/plus'));

            }else{
                $messege= array(
                    'messege'=> "Transaksi tidak ada , Silahkan input kembali"
                );
                $this->session->set_flashdata('message',$messege);
                redirect(site_url('trx_susun/plus'));

            }

        }
    }

    public function update($id) 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $usersupervisor=$this->session->userdata('user_supervisor');

        $row = $this->Trx_susun_model->get_by_id($id);

        if ($row) {
            $data = array(
            	'produk' => $this->m_general->tampil_produkid('stx_produk','produk_status','Aktif', 'produk_usersupervisor',$usersupervisor),
                'shift' => $this->m_general->tampil_data_perfield1('stx_shift','shift_status','Aktif'),
                'button' => 'Update',
                'action' => site_url('trx_susun/update_action'),
        		'susun_id' => set_value('susun_id', $row->susun_id),
        		'susun_karyawan_id' => set_value('susun_karyawan_id', $row->susun_karyawan_id),
        		'susun_produk_id' => set_value('susun_produk_id', $row->susun_produk_id),
        		'susun_master_id' => set_value('susun_master_id', $row->susun_master_id),
                'susun_shift' => set_value('susun_shift', $row->susun_shift),
        		'susun_krat1' => set_value('susun_krat1', $row->susun_krat1),
        		'susun_krat2' => set_value('susun_krat2', $row->susun_krat2),
        		'susun_krat3' => set_value('susun_krat3', $row->susun_krat3),
        		'susun_krat4' => set_value('susun_krat4', $row->susun_krat4),
        		'susun_krat5' => set_value('susun_krat5', $row->susun_krat5),
        		'susun_krat6' => set_value('susun_krat6', $row->susun_krat6),
        		'susun_krat7' => set_value('susun_krat7', $row->susun_krat7),
        		'susun_krat8' => set_value('susun_krat8', $row->susun_krat8),
        		'susun_krat9' => set_value('susun_krat9', $row->susun_krat9),
        		'susun_krat10' => set_value('susun_krat10', $row->susun_krat10),
        		'susun_krat11' => set_value('susun_krat11', $row->susun_krat11),
        		'susun_krat12' => set_value('susun_krat12', $row->susun_krat12),
        		'susun_krat13' => set_value('susun_krat13', $row->susun_krat13),
        		'susun_krat14' => set_value('susun_krat14', $row->susun_krat14),
        		'susun_krat15' => set_value('susun_krat15', $row->susun_krat15),
        		'susun_totalkrat' => set_value('susun_totalkrat', $row->susun_totalkrat),
        		'susun_upah' => set_value('susun_upah', $row->susun_upah),
        		'susun_tgllaporan' => set_value('susun_tgllaporan', $row->susun_tgllaporan),
        		'susun_userinput' => set_value('susun_userinput', $row->susun_userinput),
        		'susun_tglinput' => set_value('susun_tglinput', $row->susun_tglinput),
                'codeid'=>$this->m_general->trxgetcode('masterdetail_id',set_value('susun_karyawan_id', $row->susun_karyawan_id),set_value('susun_master_id', $row->susun_master_id)),
	    );
           $x['content']=$this->load->view('trx_susun/trx_susun_form_update', $data,true);
           $this->load->view('template',$x); 
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_susun'));
        }
    }
    
    public function update_action() 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $usersupervisor=$this->session->userdata('user_supervisor');

        $this->_rules();
        $harga = $this->m_general->hargaproduk('stx_produk','produk_susun','produk_id',$this->input->post('susun_produk_id',TRUE));
        $totalkerja = $this->input->post('susun_totalkrat',TRUE);
        $upah = ($harga * $totalkerja);

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('susun_id', TRUE));
        } else {

            $uharga = $this->m_general->hargaproduk('stx_produk','produk_susun','produk_id',$this->input->post('susun_produk_id',TRUE));
            $utotalkrat = ($this->input->post('susun_krat1',TRUE) + $this->input->post('susun_krat2',TRUE) +$this->input->post('susun_krat3',TRUE) +$this->input->post('susun_krat4',TRUE) +$this->input->post('susun_krat5',TRUE) +$this->input->post('susun_krat6',TRUE) +$this->input->post('susun_krat7',TRUE) +$this->input->post('susun_krat8',TRUE) +$this->input->post('susun_krat9',TRUE) +$this->input->post('susun_krat10',TRUE) +$this->input->post('susun_krat11',TRUE) +$this->input->post('susun_krat12',TRUE) +$this->input->post('susun_krat13',TRUE) +$this->input->post('susun_krat14',TRUE) +$this->input->post('susun_krat15',TRUE));
            $uupah = floor($uharga * $utotalkrat);

            $xdata = array(
        		'susun_karyawan_id' => $this->input->post('susun_karyawan_id',TRUE),
                'susun_produk_id' => $this->input->post('susun_produk_id',TRUE),
                'susun_shift' => $this->input->post('susun_shift',TRUE), 
        		'susun_krat1' => $this->input->post('susun_krat1',TRUE),
        		'susun_krat2' => $this->input->post('susun_krat2',TRUE),
        		'susun_krat3' => $this->input->post('susun_krat3',TRUE),
        		'susun_krat4' => $this->input->post('susun_krat4',TRUE),
        		'susun_krat5' => $this->input->post('susun_krat5',TRUE),
        		'susun_krat6' => $this->input->post('susun_krat6',TRUE),
        		'susun_krat7' => $this->input->post('susun_krat7',TRUE),
        		'susun_krat8' => $this->input->post('susun_krat8',TRUE),
        		'susun_krat9' => $this->input->post('susun_krat9',TRUE),
        		'susun_krat10' => $this->input->post('susun_krat10',TRUE),
        		'susun_krat11' => $this->input->post('susun_krat11',TRUE),
        		'susun_krat12' => $this->input->post('susun_krat12',TRUE),
        		'susun_krat13' => $this->input->post('susun_krat13',TRUE),
        		'susun_krat14' => $this->input->post('susun_krat14',TRUE),
        		'susun_krat15' => $this->input->post('susun_krat15',TRUE),
        		'susun_totalkrat' => $utotalkrat,
        		'susun_upah' => $uupah,
	    );
        $this->Trx_susun_model->update($this->input->post('susun_id', TRUE), $xdata);

        $ydata = array(
                'masterdetail_karyawan_id'=>$this->input->post('susun_karyawan_id',TRUE),                
                'masterdetail_jumlahkrat'=>$utotalkrat,
                'masterdetail_upah'=>$uupah,              
         ); 
        $this->Trx_susun_model->updateDetail($this->input->post('codeid',TRUE), $ydata);

        $sumpay = $this->Trx_susun_model->sumsusun('susun_upah',$usersupervisor,$this->input->post('susun_shift',TRUE) ,$this->input->post('susun_tgllaporan',TRUE),$this->input->post('susun_master_id',TRUE));
        
        $zdata = array(
                    'master_produk_id' => $this->input->post('susun_produk_id',TRUE),
                    'master_shift' => $this->input->post('susun_shift',TRUE), 
                    'master_bayarstfg' => $sumpay,
                    );
        $this->Trx_susun_model->updateMaster($this->input->post('susun_master_id',TRUE), $zdata);

        $messege= array(
                    'messege'=> "Update Berhasil Disimpan"
                );
            $this->session->set_flashdata('success', $messege);
        redirect(site_url('trx_susun'. '/index?q=' . urlencode($this->input->post('susun_produk_id',TRUE)) . '&t='. urlencode($this->input->post('susun_tgllaporan',TRUE)) . '&s='. urlencode($this->input->post('susun_shift',TRUE))));
        }
    }
    
    public function delete($id) 
    {
        $usersupervisor=$this->session->userdata('user_supervisor');
        $row = $this->Trx_susun_model->get_by_id($id);

        if ($row) {
      $codeid = $this->m_general->trxgetcode('masterdetail_id',set_value('susun_karyawan_id', $row->susun_karyawan_id),set_value('susun_master_id', $row->susun_master_id ));

            $this->Trx_susun_model->delete($id);
            $this->Trx_susun_model->deleteDetail($codeid);
            //Recalculate Team & time working
            $totalteam = $this->Trx_susun_model->susuncount('susun_karyawan_id',set_value('susun_produk_id', $row->susun_produk_id),set_value('susun_shift', $row->susun_shift),set_value('susun_tgllaporan', $row->susun_tgllaporan),set_value('susun_master_id', $row->susun_master_id));
                $sumpay = $this->Trx_susun_model->sumsusun('susun_upah',$usersupervisor,set_value('susun_shift', $row->susun_shift),set_value('susun_tgllaporan', $row->susun_tgllaporan),set_value('susun_master_id', $row->susun_master_id));
        
   
            if ($totalteam =='0'){
                $this->Trx_susun_model->deletemaster(set_value('susun_master_id', $row->susun_master_id));
                
            }else {
            $zdata = array(
                    'master_jumlahteam' => $totalteam,
                    'master_bayarstfg' => $sumpay,

                    );
            $this->Trx_susun_model->updateMaster(set_value('susun_master_id', $row->susun_master_id), $zdata);

            } 

            $messege= array(
                    'messege'=> "Delete Transaksi telah berhasil"
                );
            $this->session->set_flashdata('success', $messege);
       redirect(site_url('trx_susun'. '/index?q=' . urlencode(set_value('susun_produk_id', $row->susun_produk_id)) . '&t='. urlencode(set_value('susun_tgllaporan', $row->susun_tgllaporan)) . '&s='. urlencode(set_value('susun_shift', $row->susun_shift))));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_susun'));
        }
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
            $x['data_susun']=$this->Trx_susun_model->download_susun('',$date_input,'');
        }else{
            $x['data_susun']=$this->Trx_susun_model->download_susun($username,$date_input, $xid_group);
        }
        
        $this->load->view('trx_susun/excel_trx_susun',$x);
    }

    public function _rules() 
    {
    	$this->form_validation->set_rules('susun_karyawan_id', 'susun karyawan id', 'trim');
    	$this->form_validation->set_rules('susun_produk_id', 'susun produk id', 'trim');
    	$this->form_validation->set_rules('susun_karu', 'susun karu', 'trim');
    	$this->form_validation->set_rules('susun_master_id', 'susun master id', 'trim');
        $this->form_validation->set_rules('susun_shift', 'susun susun_shift', 'trim');
    	$this->form_validation->set_rules('susun_krat1', 'susun krat1', 'trim');
    	$this->form_validation->set_rules('susun_krat2', 'susun krat2', 'trim');
    	$this->form_validation->set_rules('susun_krat3', 'susun krat3', 'trim');
    	$this->form_validation->set_rules('susun_krat4', 'susun krat4', 'trim');
    	$this->form_validation->set_rules('susun_krat5', 'susun krat5', 'trim');
    	$this->form_validation->set_rules('susun_krat6', 'susun krat6', 'trim');
    	$this->form_validation->set_rules('susun_krat7', 'susun krat7', 'trim');
    	$this->form_validation->set_rules('susun_krat8', 'susun krat8', 'trim');
    	$this->form_validation->set_rules('susun_krat9', 'susun krat9', 'trim');
    	$this->form_validation->set_rules('susun_krat10', 'susun krat10', 'trim');
    	$this->form_validation->set_rules('susun_krat11', 'susun krat11', 'trim');
    	$this->form_validation->set_rules('susun_krat12', 'susun krat12', 'trim');
    	$this->form_validation->set_rules('susun_krat13', 'susun krat13', 'trim');
    	$this->form_validation->set_rules('susun_krat14', 'susun krat14', 'trim');
    	$this->form_validation->set_rules('susun_krat15', 'susun krat15', 'trim');
    	$this->form_validation->set_rules('susun_totalkrat', 'susun total Krat', 'trim');
    	$this->form_validation->set_rules('susun_upah', 'susun upah', 'trim|numeric');
    	$this->form_validation->set_rules('susun_tgllaporan', 'susun tgllaporan', 'trim');
    	$this->form_validation->set_rules('susun_userinput', 'susun userinput', 'trim');
    	$this->form_validation->set_rules('susun_tglinput', 'susun tglinput', 'trim');
    	$this->form_validation->set_rules('susun_id', 'susun_id', 'trim');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "trx_susun.xls";
        $judul = "trx_susun";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Susun Karyawan Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Susun Produk Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Susun Karu");
	xlsWriteLabel($tablehead, $kolomhead++, "Susun Master Id");
    xlsWriteLabel($tablehead, $kolomhead++, "Susun shift");
	xlsWriteLabel($tablehead, $kolomhead++, "Susun Krat1");
	xlsWriteLabel($tablehead, $kolomhead++, "Susun Krat2");
	xlsWriteLabel($tablehead, $kolomhead++, "Susun Krat3");
	xlsWriteLabel($tablehead, $kolomhead++, "Susun Krat4");
	xlsWriteLabel($tablehead, $kolomhead++, "Susun Krat5");
	xlsWriteLabel($tablehead, $kolomhead++, "Susun Krat6");
	xlsWriteLabel($tablehead, $kolomhead++, "Susun Krat7");
	xlsWriteLabel($tablehead, $kolomhead++, "Susun Krat8");
	xlsWriteLabel($tablehead, $kolomhead++, "Susun Krat9");
	xlsWriteLabel($tablehead, $kolomhead++, "Susun Krat10");
	xlsWriteLabel($tablehead, $kolomhead++, "Susun Krat11");
	xlsWriteLabel($tablehead, $kolomhead++, "Susun Krat12");
	xlsWriteLabel($tablehead, $kolomhead++, "Susun Krat13");
	xlsWriteLabel($tablehead, $kolomhead++, "Susun Krat14");
	xlsWriteLabel($tablehead, $kolomhead++, "Susun Krat15");
	xlsWriteLabel($tablehead, $kolomhead++, "Susun Upah");
	xlsWriteLabel($tablehead, $kolomhead++, "Susun Tgllaporan");
	xlsWriteLabel($tablehead, $kolomhead++, "Susun Userinput");
	xlsWriteLabel($tablehead, $kolomhead++, "Susun Tglinput");

	foreach ($this->Trx_susun_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->susun_karyawan_id);
	    xlsWriteLabel($tablebody, $kolombody++, $data->susun_produk_id);
	    xlsWriteLabel($tablebody, $kolombody++, $data->susun_karu);
	    xlsWriteLabel($tablebody, $kolombody++, $data->susun_master_id);
         xlsWriteNumber($tablebody, $kolombody++, $data->susun_shift);
	    xlsWriteNumber($tablebody, $kolombody++, $data->susun_krat1);
	    xlsWriteNumber($tablebody, $kolombody++, $data->susun_krat2);
	    xlsWriteNumber($tablebody, $kolombody++, $data->susun_krat3);
	    xlsWriteNumber($tablebody, $kolombody++, $data->susun_krat4);
	    xlsWriteNumber($tablebody, $kolombody++, $data->susun_krat5);
	    xlsWriteNumber($tablebody, $kolombody++, $data->susun_krat6);
	    xlsWriteNumber($tablebody, $kolombody++, $data->susun_krat7);
	    xlsWriteNumber($tablebody, $kolombody++, $data->susun_krat8);
	    xlsWriteNumber($tablebody, $kolombody++, $data->susun_krat9);
	    xlsWriteNumber($tablebody, $kolombody++, $data->susun_krat10);
	    xlsWriteNumber($tablebody, $kolombody++, $data->susun_krat11);
	    xlsWriteNumber($tablebody, $kolombody++, $data->susun_krat12);
	    xlsWriteNumber($tablebody, $kolombody++, $data->susun_krat13);
	    xlsWriteNumber($tablebody, $kolombody++, $data->susun_krat14);
	    xlsWriteNumber($tablebody, $kolombody++, $data->susun_krat15);
	    xlsWriteNumber($tablebody, $kolombody++, $data->susun_upah);
	    xlsWriteLabel($tablebody, $kolombody++, $data->susun_tgllaporan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->susun_userinput);
	    xlsWriteLabel($tablebody, $kolombody++, $data->susun_tglinput);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=trx_susun.doc");

        $data = array(
            'trx_susun_data' => $this->Trx_susun_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('trx_susun/trx_susun_doc',$data);
    }

}

/* End of file Trx_susun.php */
/* Location: ./application/controllers/Trx_susun.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-16 19:35:36 */
/* http://harviacode.com */
