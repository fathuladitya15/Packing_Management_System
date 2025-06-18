<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trx_clining extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Trx_clining_model');
        $this->load->library('form_validation');
         $this->load->model('m_general');
        $this->load->library('session');
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
        $priv=$this->m_general->get_privilage($id_group,'trx_clining');      
        $x['add']='N';
        $x['update']='N';
        $x['delete']='N';
        $x['comment1']='N';
        $x['report']='N';
        foreach ($priv as $a) {
            $id_group=$id_group;
            $nav_url='trx_clining';
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
            $config['base_url'] = base_url() . 'trx_clining/index.html?q=' . urlencode($q) . '&t='. urlencode($t). '&s='. urlencode($s);
            $config['first_url'] = base_url() . 'trx_clining/index.html?q=' . urlencode($q) . '&t='. urlencode($t) . '&s='. urlencode($s);
            $config['per_page'] = 0;

        } elseif (($s <> '') and ($t <> '') and ($q == '')){
            $config['base_url'] = base_url() . 'trx_clining/index.html?t='. urlencode($t). '&s='. urlencode($s);;
            $config['first_url'] = base_url() . 'trx_clining/index.html?t='. urlencode($t). '&s='. urlencode($s);;
            $config['per_page'] = 0;

        }else {
            $config['base_url'] = base_url() . 'trx_clining/index.html';
            $config['first_url'] = base_url() . 'trx_clining';
            $config['per_page'] = 25;
        }

        $config['page_query_string'] = TRUE;
        $trx_clining = $this->Trx_clining_model->tampil_data($config['per_page'], $start, $q, $username,$id_group,$s, $t );
        $config['total_rows'] = $this->Trx_clining_model->total_rows($q, $username, $id_group,$s, $t);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'trx_clining_data' => $trx_clining,
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
            'priv_count' =>$this->m_general->cek_privilage($id_group,'trx_clining'),
        );

        $x['content']=$this->load->view('trx_clining/trx_clining_list', $data,TRUE);
        $this->load->view('template',$x);
    }

    public function read($id) 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $row = $this->Trx_clining_model->get_by_id($id);
        if ($row) {
            $data = array(
    		'clining_id' => $row->clining_id,
    		'clining_master_id' => $row->clining_master_id,
    		'clining_karyawan_id' => $row->clining_karyawan_id,
            'karyawan_nama' => $row->karyawan_nama,
    		'clining_shift' => $row->clining_shift,
    		'clining_line' => $row->clining_line,
    		'clining_pekerjaan' => $row->clining_pekerjaan,
            'clining_jumlahteam' => $row->clining_jumlahteam,
    		'clining_posisi' => $row->clining_posisi,
    		'clining_upah' => $row->clining_upah,
    		'clining_tgllaporan' => $row->clining_tgllaporan,
    		'clining_userinput' => $row->clining_userinput,
    		'clining_tglinput' => $row->clining_tglinput,
	    );
       
        $x['content']=$this->load->view('trx_clining/trx_clining_read', $data,TRUE);
            $this->load->view('template',$x);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_clining'));
        }
    }

    public function create() 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $data = array(
            'clining' => $this->m_general->xenums('trx_clining','clining_pekerjaan'),
            'shift' => $this->m_general->tampil_data_perfield1('stx_shift','shift_status','Aktif'),
            'button' => 'Create',
            'action' => site_url('trx_clining/create_action'),
        	    'clining_id' => set_value('clining_id'),
        	    'clining_master_id' => set_value('clining_master_id'),
        	    'clining_karyawan_id' => set_value('clining_karyawan_id'),
        	    'clining_shift' => set_value('clining_shift'),
        	    'clining_line' => set_value('clining_line'),
        	    'clining_pekerjaan' => set_value('clining_pekerjaan'),
                'clining_jumlahteam' => set_value('clining_pekerjaan'),
        	    'clining_posisi' => set_value('clining_posisi'),
        	    'clining_upah' => set_value('clining_upah'),
        	    'clining_tgllaporan' => set_value('clining_tgllaporan'),
        	    'clining_userinput' => set_value('clining_userinput'),
        	    'clining_tglinput' => set_value('clining_tglinput'),
	);
        $x['content']=$this->load->view('trx_clining/trx_clining_form', $data,TRUE);
        $this->load->view('template',$x);
    }
    
    public function create_action() 
    {
        
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $usersupervisor=$this->session->userdata('user_supervisor'); 
        $catas = $this->m_general->hargaproduk('stx_produk','produk_step_final','produk_id','C777777');
        $cbawah = $this->m_general->hargaproduk('stx_produk','produk_step_final','produk_id','C777778');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

        	$count = count($_POST['count']); 
            $codeid = $this->m_general->getcode('trx_master','master_id','CLI-');

            if($this->input->post('clining')=="Setting SC") {
                $clining='Setting SC';
                //$fupah = 151363;
                $fupah = $catas;
                $upah = floor(($fupah / $count ));
            }else{
                $clining='Setting OC';
                //$fupah = 8409; 
                $fupah = $cbawah;
                $upah = floor(($fupah / $count ));
            }

            $result = $this->Trx_clining_model->batchInsert($_POST,$codeid,$clining,$upah,$username,$usersupervisor); // Insert to trx_mesin table       
            $data = array(
                'master_id' => $codeid,
                'master_module_id' => '11',
                'master_line' => $this->input->post('jclining_line',TRUE),
                'master_nomesin' => $this->input->post('jclining_posisi',TRUE),
                'master_shift' => $this->input->post('jclining_shift',TRUE),
                'master_jumlahteam' => $count,
                'master_bayarstfg' =>$fupah,
                'master_acuanmesin' =>$clining,
                'master_usersupervisor' =>$usersupervisor,
                'master_tgllaporan' => $this->input->post('jclining_tgllaporan',TRUE),
                'master_userinput' => $username,
                'master_tglinput' => date('Y-m-d'),
	    );

        $this->Trx_clining_model->insertMaster($data); // insert to trx_master  
              
           
            if($result){
                echo 1;
            }
            else{
                echo 0;
            }
            exit;
            redirect(site_url('trx_clining/create'));
            
            $this->session->set_flashdata('message', 'Create Record Success');
        }
    }


     public function plus() 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $usersupervisor=$this->session->userdata('user_supervisor');
        $data = array(
            'clining' => $this->m_general->xenums('trx_clining','clining_pekerjaan'),
            'produk' => $this->m_general->tampil_produkid('stx_produk','produk_status','Aktif', 'produk_usersupervisor',$usersupervisor),
            'shift' => $this->m_general->tampil_data_perfield1('stx_shift','shift_status','Aktif'),
            'button' => 'Create',
            'action' => site_url('trx_clining/create_plus'),
                'clining_id' => set_value('clining_id'),
                'clining_master_id' => set_value('clining_master_id'),
                'clining_karyawan_id' => set_value('clining_karyawan_id'),
                'clining_line' => set_value('clining_line'),
                'clining_pekerjaan' => set_value('clining_pekerjaan'),
                'clining_jumlahteam' => set_value('clining_jumlahteam'),
                'clining_shift' => set_value('clining_shift'),
                'clining_posisi' => set_value('clining_posisi'),
                'clining_upah' => set_value('clining_upah'),
                'clining_tgllaporan' => set_value('clining_tgllaporan'),
                'clining_usersupervisor' => set_value('clining_usersupervisor'),
                'clining_userinput' => set_value('clining_userinput'),
                'clining_tglinput' => set_value('clining_tglinput'),
    );
        $x['content']=$this->load->view('trx_clining/trx_clining_form_plus', $data,TRUE);
        $this->load->view('template',$x);
    }
    
    public function create_plus() 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $usersupervisor=$this->session->userdata('user_supervisor'); 
        $catas = $this->m_general->hargaproduk('stx_produk','produk_step_final','produk_id','C777777');
        $cbawah = $this->m_general->hargaproduk('stx_produk','produk_step_final','produk_id','C777778');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {


        $cliningcode = $this->Trx_clining_model->gettrxmaster($this->input->post('clining_line', TRUE),$this->input->post('clining_posisi', TRUE),$this->input->post('clining_tgllaporan', TRUE),$this->input->post('clining_shift', TRUE), $this->input->post('clining_master_id', TRUE));

        if ($cliningcode){
            $pekerja = $this->Trx_clining_model->countclining('clining_karyawan_id', $this->input->post('clining_line', TRUE),$this->input->post('clining_tgllaporan', TRUE),$this->input->post('clining_shift', TRUE),$this->input->post('clining_master_id', TRUE));
            
            $jumlahpekerja = $pekerja + 1 ;

            if($this->input->post('clining')=="Setting SC") {
                $clining='Setting SC';
                $fupah = $catas;
                $upah = floor(($fupah / $jumlahpekerja ));
            }else{
                $clining='Setting OC'; 
                $fupah = $cbawah;
                $upah = floor(($fupah / $jumlahpekerja ));
            }

            /*
             if($this->input->post('clining')=="Setting SC") {
                $clining='Setting SC';
                $upah = floor(((151363 ) / $jumlahpekerja ));
             }else{
                $clining='Setting OC'; 
                $upah = floor(((8409) / $jumlahpekerja ));
            }
            */

             $mastercode =  $this->input->post('clining_master_id',TRUE);

                $data = array(
                        'clining_master_id' => $this->input->post('clining_master_id',TRUE),
                        'clining_karyawan_id' => $this->input->post('clining_karyawan_id',TRUE),
                        'clining_line' => $this->input->post('clining_line',TRUE),
                        'clining_pekerjaan' => $clining,
                        'clining_jumlahteam' => $jumlahpekerja,
                        'clining_shift' => $this->input->post('clining_shift',TRUE),
                        'clining_posisi' => $this->input->post('clining_posisi',TRUE),
                        'clining_upah' => $upah,
                        'clining_tgllaporan' => $this->input->post('clining_tgllaporan',TRUE),
                        'clining_userinput' => $username,
                        'clining_usersupervisor' => $usersupervisor,
                        'clining_tglinput' => date('Y-m-d'),
                );

                $this->Trx_clining_model->insert($data);
                
                $datax = array(
                        'masterdetail_karyawan_id'=>$this->input->post('clining_karyawan_id',TRUE),               
                        'masterdetail_master_id'=>$this->input->post('clining_master_id',TRUE),
                        'masterdetail_upah'=>$upah,
                        'masterdetail_usersupervisor'=>$usersupervisor,
                        'masterdetail_userinput'=>$username,
                        'masterdetail_tglinput'=>date('Y-m-d'), 
                        );

                 $this->Trx_clining_model->insertdetail($datax);


                $this->db->query("UPDATE trx_clining SET clining_upah = $upah, clining_jumlahteam = $jumlahpekerja  WHERE clining_master_id =  '$mastercode'");
                $this->db->query("UPDATE trx_masterdetail SET masterdetail_upah = $upah WHERE masterdetail_master_id =  '$mastercode'");
                $this->db->query("UPDATE trx_master SET master_jumlahteam = $jumlahpekerja WHERE master_id =  '$mastercode'");


           $messege= array(
                            'messege'=> "Data Berhasil Disimpan"
                        );
                    $this->session->set_flashdata('success', $messege);
                    redirect(site_url('trx_clining/plus'));

            }else{

                $messege= array(
                    'messege'=> "Transaksi tidak ada , Silahkan input kembali"
                );
                $this->session->set_flashdata('message',$messege);
                redirect(site_url('trx_clining/plus'));

            }

        }
    }

    

    
    public function update($id) 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $row = $this->Trx_clining_model->get_by_id($id);

        if ($row) {
            $data = array(
            	'clining' => $this->m_general->xenums('trx_clining','clining_pekerjaan'),
                'shift' => $this->m_general->tampil_data_perfield1('stx_shift','shift_status','Aktif'),
                'button' => 'Update',
                'action' => site_url('trx_clining/update_action'),
		'clining_id' => set_value('clining_id', $row->clining_id),
		'clining_master_id' => set_value('clining_master_id', $row->clining_master_id),
		'clining_karyawan_id' => set_value('clining_karyawan_id', $row->clining_karyawan_id),
        'clining_jumlahteam' => set_value('clining_jumlahteam', $row->clining_jumlahteam),
		'clining_shift' => set_value('clining_shift', $row->clining_shift),
		'clining_line' => set_value('clining_line', $row->clining_line),
		'clining_pekerjaan' => set_value('clining_pekerjaan', $row->clining_pekerjaan),
		'clining_posisi' => set_value('clining_posisi', $row->clining_posisi),
		'clining_upah' => set_value('clining_upah', $row->clining_upah),
		'clining_tgllaporan' => set_value('clining_tgllaporan', $row->clining_tgllaporan),
        'codeid'=>$this->m_general->trxgetcode('masterdetail_id',set_value('clining_karyawan_id', $row->clining_karyawan_id),set_value('clining_master_id', $row->clining_master_id)),
	    );

        $x['content']=$this->load->view('trx_clining/trx_clining_form_update', $data,true);
        $this->load->view('template',$x);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_clining'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('clining_id', TRUE));
        } else {

            $catas = $this->m_general->hargaproduk('stx_produk','produk_step_final','produk_id','C777777');
            $cbawah = $this->m_general->hargaproduk('stx_produk','produk_step_final','produk_id','C777778');



 			$pekerja = $this->Trx_clining_model->countclining('clining_karyawan_id', $this->input->post('clining_line', TRUE),$this->input->post('clining_tgllaporan', TRUE),$this->input->post('clining_shift', TRUE),$this->input->post('clining_master_id', TRUE));

			$jumlahpekerja = $pekerja;


            if($this->input->post('clining')=="Setting SC") {
                $clining='Setting SC';
                $fupah = $catas;
                $upah = floor(($fupah / $jumlahpekerja ));
            }else{
                $clining='Setting OC'; 
                $fupah = $cbawah;
                $upah = floor(($fupah / $jumlahpekerja ));
            }



 /*            if($this->input->post('clining')=="Setting SC") {
                $clining='Setting SC';
                $upah = floor(((151363 ) / $jumlahpekerja ));
             }else{
                $clining='Setting OC'; 
                $upah = floor(((8409) / $jumlahpekerja ));
 
                } */


            $data = array(
        		'clining_karyawan_id' => $this->input->post('clining_karyawan_id',TRUE),
                'clining_pekerjaan' => $clining,
        		'clining_line' => $this->input->post('clining_line',TRUE),
                'clining_shift' => $this->input->post('clining_shift',TRUE),
                'clining_posisi' => $this->input->post('clining_posisi',TRUE),
                'clining_upah' => $upah,
	           );

            $this->Trx_clining_model->update($this->input->post('clining_id', TRUE), $data);
            
            $ydata = array(
                'masterdetail_karyawan_id' => $this->input->post('clining_karyawan_id',TRUE),
                'masterdetail_upah' => $upah,
               );

            $this->Trx_clining_model->updateDetail($this->input->post('codeid',TRUE), $ydata);

           $mdata = array(
                'master_line' => $this->input->post('clining_line',TRUE),
                'master_shift' => $this->input->post('clining_shift',TRUE),
                'master_nomesin' => $this->input->post('clining_posisi',TRUE),
                'master_acuanmesin' =>$clining,
               );

            $this->Trx_clining_model->updateMaster($this->input->post('clining_master_id',TRUE), $mdata);

            $messege= array(
                    'messege'=> "Update Berhasil Disimpan"
                );
            $this->session->set_flashdata('success', $messege);

redirect(site_url('trx_clining'. '/index?q=' . urlencode($this->input->post('clining_produk_id',TRUE)) . '&t='. urlencode($this->input->post('clining_tgllaporan',TRUE)) . '&s='. urlencode($this->input->post('clining_shift',TRUE))));

        }
    }
    
    public function delete($id) 
    {
        $row = $this->Trx_clining_model->get_by_id($id);

        if ($row) {
        $codeid = $this->m_general->trxgetcode('masterdetail_id',set_value('clining_karyawan_id', $row->clining_karyawan_id),set_value('clining_master_id', $row->clining_master_id ));

        $mastercode = set_value('clining_master_id', $row->clining_master_id);

        $this->Trx_clining_model->delete($id);
        $this->Trx_clining_model->deleteDetail($codeid);

        $totalteam = $this->Trx_clining_model->cliningcount('clining_karyawan_id',set_value('clining_line', $row->clining_line),set_value('clining_shift', $row->clining_shift),set_value('clining_tgllaporan', $row->clining_tgllaporan),set_value('clining_master_id', $row->clining_master_id)); 
        $catas = $this->m_general->hargaproduk('stx_produk','produk_step_final','produk_id','C777777');
        $cbawah = $this->m_general->hargaproduk('stx_produk','produk_step_final','produk_id','C777778');






            if ($totalteam =='0'){
                $this->Trx_clining_model->deletemaster(set_value('clining_master_id', $row->clining_master_id));
                
            }else {

                if(set_value('clining_pekerjaan', $row->clining_pekerjaan)=="Setting SC") {
                    $clining='Setting SC';
                    $fupah = $catas;
                    $xupah = floor(($fupah / $totalteam ));
                }else{
                    $clining='Setting OC'; 
                    $fupah = $cbawah;
                    $xupah = floor(($fupah / $totalteam ));
                }


 /*           if(set_value('clining_pekerjaan', $row->clining_pekerjaan)=="Setting SC") {
	            $clining='Setting SC';
	            $xupah = floor(((151363 ) / $totalteam ));
         	}else{
	            $clining='Setting OC'; 
	            $xupah = floor(((8409) / $totalteam ));
        	}*/

            $this->db->query("UPDATE trx_clining SET clining_upah = $xupah, clining_jumlahteam = $totalteam  WHERE clining_master_id =  '$mastercode'");
            $this->db->query("UPDATE trx_masterdetail SET masterdetail_upah = $xupah WHERE masterdetail_master_id =  '$mastercode'");
            $this->db->query("UPDATE trx_master SET master_jumlahteam = $totalteam WHERE master_id =  '$mastercode'");


            } 


            $messege= array(
                    'messege'=> "Delete Transaksi telah berhasil"
                );
            $this->session->set_flashdata('success', $messege);
            //redirect(site_url('trx_clining'. '/index?q=' . urlencode(set_value('clining_produk_id', $row->clining_produk_id)) . '&t='. urlencode(set_value('clining_tgllaporan', $row->clining_tgllaporan)) . '&s='. urlencode(set_value('clining_shift', $row->clining_shift))));
            
            
            redirect(site_url('trx_clining'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_clining'));
        }
    }



    public function _rules() 
    {
	$this->form_validation->set_rules('clining_master_id', 'clining master id', 'trim');
	$this->form_validation->set_rules('clining_karyawan_id', 'clining karyawan id', 'trim');
	$this->form_validation->set_rules('clining_shift', 'clining shift', 'trim');
	$this->form_validation->set_rules('clining_line', 'clining line', 'trim');
	$this->form_validation->set_rules('clining_pekerjaan', 'clining pekerjaan', 'trim');
	$this->form_validation->set_rules('clining_posisi', 'clining posisi', 'trim');
	$this->form_validation->set_rules('clining_tgllaporan', 'trx tgllaporan', 'trim');
	$this->form_validation->set_rules('clining_upah', 'trx upah', 'trim');
	$this->form_validation->set_rules('clining_userinput', 'clining userinput', 'trim');
	$this->form_validation->set_rules('clining_tglinput', 'clining tglinput', 'trim');

	$this->form_validation->set_rules('clining_id', 'clining_id', 'trim');
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
            $x['data_clining']=$this->Trx_clining_model->download_clining('',$date_input,'');
        }else{
            $x['data_clining']=$this->Trx_clining_model->download_clining($username,$date_input, $xid_group);
        }
        
        $this->load->view('trx_clining/excel_trx_clining',$x);
    }


    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "trx_clining.xls";
        $judul = "trx_clining";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Clining Master Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Clining Karyawan Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Clining Shift");
	xlsWriteLabel($tablehead, $kolomhead++, "Clining Line");
	xlsWriteLabel($tablehead, $kolomhead++, "Clining Pekerjaan");
	xlsWriteLabel($tablehead, $kolomhead++, "Clining Posisi");
	xlsWriteLabel($tablehead, $kolomhead++, "Trx Tgllaporan");
	xlsWriteLabel($tablehead, $kolomhead++, "Clining Userinput");
	xlsWriteLabel($tablehead, $kolomhead++, "Clining Tglinput");

	foreach ($this->Trx_clining_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->clining_master_id);
	    xlsWriteNumber($tablebody, $kolombody++, $data->clining_karyawan_id);
	    xlsWriteNumber($tablebody, $kolombody++, $data->clining_shift);
	    xlsWriteLabel($tablebody, $kolombody++, $data->clining_line);
	    xlsWriteLabel($tablebody, $kolombody++, $data->clining_pekerjaan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->clining_posisi);
	    xlsWriteLabel($tablebody, $kolombody++, $data->clining_tgllaporan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->clining_userinput);
	    xlsWriteLabel($tablebody, $kolombody++, $data->clining_tglinput);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Trx_clining.php */
/* Location: ./application/controllers/Trx_clining.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-06-06 02:26:38 */
/* http://harviacode.com */
