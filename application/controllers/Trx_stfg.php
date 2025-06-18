<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trx_stfg extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Trx_stfg_model');
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
        $priv=$this->m_general->get_privilage($id_group,'trx_stfg');      
        $x['add']='N';
        $x['update']='N';
        $x['delete']='N';
        $x['comment1']='N';
        $x['report']='N';
        foreach ($priv as $a) {
            $id_group=$id_group;
            $nav_url='trx_stfg';
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
            $config['base_url'] = base_url() . 'trx_stfg/index.html?q=' . urlencode($q) . '&t='. urlencode($t). '&s='. urlencode($s);
            $config['first_url'] = base_url() . 'trx_stfg/index.html?q=' . urlencode($q) . '&t='. urlencode($t) . '&s='. urlencode($s);
            $config['per_page'] = 0;

        } elseif (($s <> '') and ($t <> '') and ($q == '')){
            $config['base_url'] = base_url() . 'trx_stfg/index.html?t='. urlencode($t). '&s='. urlencode($s);;
            $config['first_url'] = base_url() . 'trx_stfg/index.html?t='. urlencode($t). '&s='. urlencode($s);;
            $config['per_page'] = 0;

        }else {
            $config['base_url'] = base_url() . 'trx_stfg/index.html';
            $config['first_url'] = base_url() . 'trx_stfg';
            $config['per_page'] = 25;
        }


        $config['page_query_string'] = TRUE;
        $trx_stfg = $this->Trx_stfg_model->tampil_data($config['per_page'], $start, $q, $username,$id_group, $s, $t );
        $config['total_rows'] = $this->Trx_stfg_model->total_rows($q, $username, $id_group, $s, $t);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'trx_stfg_data' => $trx_stfg,
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
            'priv_count' =>$this->m_general->cek_privilage($id_group,'trx_stfg'),
        );
        $x['content']=$this->load->view('trx_stfg/trx_stfg_list', $data,TRUE);
        $this->load->view('template',$x);
    }

    public function read($id) 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $row = $this->Trx_stfg_model->get_by_id($id);
        if ($row) {
            $data = array(
    		'stfg_id' => $row->stfg_id,
    		'stfg_produk_id' => $row->stfg_produk_id,
    		'produk_nama' => $row->produk_nama,
    		'stfg_shift' => $row->stfg_shift,
    		'stfg_mbox1' => $row->stfg_mbox1,
    		'stfg_mbox2' => $row->stfg_mbox2,
    		'stfg_mbox3' => $row->stfg_mbox3,
    		'stfg_mbox4' => $row->stfg_mbox4,
    		'stfg_mbox5' => $row->stfg_mbox5,
    		'stfg_mbox6' => $row->stfg_mbox6,
    		'stfg_mbox7' => $row->stfg_mbox7,
    		'stfg_mbox8' => $row->stfg_mbox8,
    		'stfg_mbox9' => $row->stfg_mbox9,
    		'stfg_mbox10' => $row->stfg_mbox10,
    		'stfg_mbox11' => $row->stfg_mbox11,
    		'stfg_mbox12' => $row->stfg_mbox12,
    		'stfg_mbox13' => $row->stfg_mbox13,
    		'stfg_mbox14' => $row->stfg_mbox14,
    		'stfg_mbox15' => $row->stfg_mbox15,
    		'stfg_rijek' => $row->stfg_rijek,
    		'stfg_total' => $row->stfg_total,
    		'stfg_upah' => $row->stfg_upah,
    		'stfg_tgllaporan' => $row->stfg_tgllaporan,
    		'stfg_userinput' => $row->stfg_userinput,
    		'stfg_tglinput' => $row->stfg_tglinput,
	    );
            $x['content']=$this->load->view('trx_stfg/trx_stfg_read', $data,true);
            $this->load->view('template',$x);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_stfg'));
        }
    }

    public function create() 
    {

        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $usersupervisor=$this->session->userdata('user_supervisor');
        $data = array(
        	'produk' => $this->m_general->tampil_produkid('stx_produk','produk_status','Aktif', 'produk_usersupervisor',$usersupervisor),
        	'shift' => $this->m_general->tampil_data_perfield1('stx_shift','shift_status','Aktif'),
            'button' => 'Create',
            'action' => site_url('trx_stfg/create_action'),
	    'stfg_id' => set_value('stfg_id'),
	    'stfg_produk_id' => set_value('stfg_produk_id'),
	    'stfg_shift' => set_value('stfg_shift'),
	    'stfg_mbox1' => set_value('stfg_mbox1'),
	    'stfg_mbox2' => set_value('stfg_mbox2'),
	    'stfg_mbox3' => set_value('stfg_mbox3'),
	    'stfg_mbox4' => set_value('stfg_mbox4'),
	    'stfg_mbox5' => set_value('stfg_mbox5'),
	    'stfg_mbox6' => set_value('stfg_mbox6'),
	    'stfg_mbox7' => set_value('stfg_mbox7'),
	    'stfg_mbox8' => set_value('stfg_mbox8'),
	    'stfg_mbox9' => set_value('stfg_mbox9'),
	    'stfg_mbox10' => set_value('stfg_mbox10'),
	    'stfg_mbox11' => set_value('stfg_mbox11'),
	    'stfg_mbox12' => set_value('stfg_mbox12'),
	    'stfg_mbox13' => set_value('stfg_mbox13'),
	    'stfg_mbox14' => set_value('stfg_mbox14'),
	    'stfg_mbox15' => set_value('stfg_mbox15'),
	    'stfg_rijek' => set_value('stfg_rijek'),
	    'stfg_total' => set_value('stfg_total'),
	    'stfg_upah' => set_value('stfg_upah'),
	    'stfg_tgllaporan' => set_value('stfg_tgllaporan'),
	    'stfg_userinput' => set_value('stfg_userinput'),
	    'stfg_tglinput' => set_value('stfg_tglinput'),
	);
        $x['content']=$this->load->view('trx_stfg/trx_stfg_form', $data,TRUE);
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
            for($i = 0; $i<$count; $i++){
                	
            $totalbox=( $_POST['jstfg_mbox1'][$i] + $_POST['jstfg_mbox2'][$i] + $_POST['jstfg_mbox3'][$i] + $_POST['jstfg_mbox4'][$i] + $_POST['jstfg_mbox5'][$i] + $_POST['jstfg_mbox6'][$i] + $_POST['jstfg_mbox7'][$i] + $_POST['jstfg_mbox8'][$i] + $_POST['jstfg_mbox9'][$i] + $_POST['jstfg_mbox10'][$i] - $_POST['jstfg_rijek'][$i]);
                    
            $stfgxline=$this->Trx_stfg_model->stfgtampil_trxmasterline($_POST['jstfg_produk_id'][$i],$_POST['jstfg_tgllaporan'],$_POST['jstfg_shift'],'2',$usersupervisor );
            $stfgxmanual=$this->Trx_stfg_model->stfgtampil_trxmasterper($_POST['jstfg_produk_id'][$i],$_POST['jstfg_tgllaporan'],$_POST['jstfg_shift'],'3','1',$usersupervisor); 

                if($stfgxmanual){
	                    if ($usersupervisor =='yupi3'){
	                    	$hargastfg = $this->Trx_stfg_model->stfghargaproduk('stx_produk','produk_step_final','produk_id', $_POST['jstfg_produk_id'][$i],$usersupervisor);
		                    
		                    }else{
		                    	$hargastfg = $this->Trx_stfg_model->stfghargaproduk('stx_produk','produk_manual','produk_id', $_POST['jstfg_produk_id'][$i],$usersupervisor);
		                    }
                    
                    $masterboxtfg = $this->Trx_stfg_model->stfghargaproduk('stx_produk','produk_masterbox','produk_id', $_POST['jstfg_produk_id'][$i],$usersupervisor);
                    $stfgcuntmanual=$this->Trx_stfg_model->stfgcounttrxper('master_id',$_POST['jstfg_produk_id'][$i],$_POST['jstfg_tgllaporan'],$_POST['jstfg_shift'],'3','1',$usersupervisor);
                    $totalboxxmanual = $this->Trx_stfg_model->sumtrxboxstfgmanual('master_box',$_POST['jstfg_produk_id'][$i],$_POST['jstfg_tgllaporan'],$_POST['jstfg_shift'],$usersupervisor);
                    $xtotalupah = floor($hargastfg * $totalbox * $masterboxtfg);

                    $stfgxdata=$this->Trx_stfg_model->stfgtampil_trxmasterper($_POST['jstfg_produk_id'][$i],$_POST['jstfg_tgllaporan'],$_POST['jstfg_shift'],'3','1', $usersupervisor);     
                        for($m = 0; $m<$stfgcuntmanual; $m++){
                            foreach ($stfgxdata as $l) {
                                $stfgamanual[$m] = $l['master_id'];
                                $stfgbcount[$m] = $l['master_jumlahteam'];
                                $waktupermanual[$m] = $l['master_totalkerjamenit'];
                                $stfgcbox[$m] = $l['master_box']; 
                                $stfgdbiaya[$m] = floor(($stfgcbox[$m] / $totalboxxmanual) * $xtotalupah ); 
                                $xtotalsubupah[$m] =  floor($stfgcbox[$m] * $hargastfg * $masterboxtfg);                        

                                    $updatemastermanual[] = array(
                                        'master_id'=>$stfgamanual[$m],
                                        'master_bayarstfg' => $xtotalsubupah[$m]
                                    );

                                $stfgydata=$this->Trx_stfg_model->stfgtampil_trxmanual($_POST['jstfg_produk_id'][$i],$_POST['jstfg_tgllaporan'],$_POST['jstfg_shift'],$stfgamanual[$m], $usersupervisor);  
                                
							
                                    $t = 0;
                                    foreach ($stfgydata as $j) {
                                        $t++;
                                        $aidmanual[$t] = $j['manual_id'];
                                        $bidmaster[$t] = $j['manual_master_id'];
                                        $cidkaryawan[$t] = $j['manual_karyawan_id'];
                                        $didbox[$t] = $j['manual_box'];
                                        $etotalmenit[$t] = $j['manual_totalmenit'];

                                        $didupah[$t] = floor(($etotalmenit[$t] / $waktupermanual[$m]) * $stfgdbiaya[$m]);
                                     
                                        $stfgzdata[$t] = $this->Trx_stfg_model->stfgtampil_trxmasterdetailmanual('masterdetail_id',$bidmaster[$t], $cidkaryawan[$t], $usersupervisor);

                                            $updatemanual[] = array(
                                                'manual_id'=>$aidmanual[$t],
                                                'manual_upah' => $didupah[$t]
                                            );

                                            $updatemanualdetail[] = array(
                                                'masterdetail_id'=>$stfgzdata[$t],
                                                'masterdetail_upah' => $didupah[$t]
                                            );                                       
                                            } 
                                             $this->db->update_batch('trx_manual',$updatemanual, 'manual_id');
                                             $this->db->update_batch('trx_masterdetail',$updatemanualdetail, 'masterdetail_id'); 
                                                    
                                  
                                }
                                $this->db->update_batch('trx_master',$updatemastermanual, 'master_id');

                        }


                    }elseif ($stfgxline) {
                               
                    $hargamesin = $this->Trx_stfg_model->stfghargaproduk('stx_produk','produk_mesin','produk_id', $_POST['jstfg_produk_id'][$i],$usersupervisor);
                    $masterbox = $this->Trx_stfg_model->stfghargaproduk('stx_produk','produk_masterbox','produk_id', $_POST['jstfg_produk_id'][$i],$usersupervisor);
                	$totaldisplay = $this->Trx_stfg_model->sumtrxbox('master_display',$_POST['jstfg_produk_id'][$i],$_POST['jstfg_tgllaporan'],$_POST['jstfg_shift'],$usersupervisor);
                    $upah = floor($hargamesin * $masterbox * $totalbox); /* Total Upah */
                    /* Untuk Menghitung Total Biaya Per Line */         
                    $xcount=$this->Trx_stfg_model->counttrxperline('master_id',$_POST['jstfg_produk_id'][$i],$_POST['jstfg_tgllaporan'],$_POST['jstfg_shift'],$usersupervisor);
                    $xdata=$this->Trx_stfg_model->stfgtampil_trxmasterline($_POST['jstfg_produk_id'][$i],$_POST['jstfg_tgllaporan'],$_POST['jstfg_shift'],'2',$usersupervisor);

                        for($x = 0; $x<$xcount; $x++){
                        /* Menghitung Mesin & Line */
                            foreach ($xdata as $d) {
                                $line[$x] = $d['master_line'];
                                $masterid[$x] = $d['master_id'];
                                $totaldisplayperline[$x] = $this->Trx_stfg_model->sumtrxdisplay('master_display',$_POST['jstfg_produk_id'][$i],$_POST['jstfg_tgllaporan'],$_POST['jstfg_shift'], $line[$x],$usersupervisor);
                                $totalproline[$x]= floor((($totaldisplayperline[$x] / $totaldisplay ) * $upah )); /* Total Project Per Line */                                
                                $waktuline[$x] = $d['master_totalkerjamenit']; /* PENTING */
                                        
                                /* MEnghitung biaya Perline & Permesin */
                                $waktumesin[$x] = $this->Trx_stfg_model->sumtrxwaktu('master_totalkerjamenit',$_POST['jstfg_produk_id'][$i],$_POST['jstfg_tgllaporan'],$_POST['jstfg_shift'], $line[$x] , $usersupervisor);
                                $biayaline[$x] = floor((($waktuline[$x] / ($waktumesin[$x] + $waktuline[$x]) ) * $totalproline[$x]));
                                $biayamesin[$x] =floor((($waktumesin[$x] / ($waktumesin[$x] + $waktuline[$x]) ) * $totalproline[$x]));                       
                                
                                /* Update Upah mesin & line ditable line */
                                $this->db->query("UPDATE trx_master SET master_bayarstfg = $biayaline[$x] WHERE master_id = '$masterid[$x]'");        
                                    
                                    /* Menghitung Upah Line */
                                    $lcount[$x]=$d['master_jumlahteam'];
                                    $ldata=$this->Trx_stfg_model->tampil_trxline($_POST['jstfg_produk_id'][$i],$_POST['jstfg_tgllaporan'],$_POST['jstfg_shift'],$line[$x],$masterid[$x],$usersupervisor);                 
                                          $h = 0;
                                          foreach ($ldata as $p) {
                                                $h++;
                                                $lidline[$h] = $p['line_id'];
                                                $lidmaster[$h] = $p['line_master_id'];
                                                $lidkaryawan[$h] = $p['line_karyawan_id'];
                                                $lupah[$h] = floor((($p['line_totalmenit'] / $waktuline[$x] ) * $biayaline [$x])) ;
                                                $mdata[$h] = $this->Trx_stfg_model->tampil_trxmasterdetailline ($lidmaster[$h], $lidkaryawan[$h] ,$usersupervisor);
                                                    
                                                    $updatetrxline[] = array(
                                                        'line_id'=>$lidline[$h],
                                                        'line_upah' => $lupah[$h]
                                                    );

                                                    $updatetrxlinedetail[] = array(
                                                        'masterdetail_id'=>$mdata[$h],
                                                        'masterdetail_upah' => $lupah[$h]
                                                    ); 
                                                }

                                             $this->db->update_batch('trx_line',$updatetrxline, 'line_id');
                                             $this->db->update_batch('trx_masterdetail',$updatetrxlinedetail, 'masterdetail_id');
                                           
                                                
                    /* Menghitung Upah Permesin */
                    $zcount=$this->Trx_stfg_model->counttrxpermesin('master_id',$_POST['jstfg_produk_id'][$i],$_POST['jstfg_tgllaporan'],$_POST['jstfg_shift'],$usersupervisor);
                    $zdata=$this->Trx_stfg_model->tampil_trxmastermesin($_POST['jstfg_produk_id'][$i],$_POST['jstfg_tgllaporan'],$_POST['jstfg_shift'], $line[$x],$usersupervisor);
                    $totaldisplaypermesin[$x] = $this->Trx_stfg_model->sumtrxdisplay('master_display',$_POST['jstfg_produk_id'][$i],$_POST['jstfg_tgllaporan'],$_POST['jstfg_shift'], $line[$x], $usersupervisor);
                                                
                            for($z = 0; $z<$zcount; $z++){
                                foreach ($zdata as $f) {
                                    $mesin[$z] = $f['master_id'];           
                                    $biayapermesin[$z] = floor((($f['master_display'] / $totaldisplaypermesin[$x] ) * $biayamesin[$x] ));
                                    $waktupermesin[$z] = $f['master_totalkerjamenit'];
                                    $ycount[$z] = $f['master_jumlahteam'];
                 
                                    /* Update Upah mesin & line ditable line */ 
                                    $updatemastermesin[] = array(
                                        'master_id'=>$mesin[$z],
                                        'master_bayarstfg' => $biayapermesin[$z]
                                    );
                                    
                                    /* Menghitung Upah Karyawan */
                       
                                    $ydata=$this->Trx_stfg_model->tampil_trxmesin($_POST['jstfg_produk_id'][$i],$_POST['jstfg_tgllaporan'],$_POST['jstfg_shift'],$mesin[$z], $usersupervisor);
                                                        
                                            $b = 0;
                                            foreach ($ydata as $e) {
                                                 $b++;
                                                $yidmesin[$b] = $e['mesin_id'];
                                                $yidmaster[$b] = $e['mesin_master_id'];
                                                $yidkaryawan[$b] = $e['mesin_karyawan_id'];
                                                $yupah[$b] = floor((($e['mesin_totalmenit'] / $waktupermesin [$z] ) * $biayapermesin [$z])) ;
                                                $yxdata[$b] = $this->Trx_stfg_model->tampil_trxmasterdetailmesin ($yidmaster[$b], $yidkaryawan[$b], $usersupervisor);

                                                    $updatetrxmesin[] = array(
                                                        'mesin_id'=>$yidmesin[$b],
                                                        'mesin_upah' => $yupah[$b]
                                                    );

                                                    $updatetrxmesindetail[] = array(
                                                        'masterdetail_id'=>$yxdata[$b],
                                                        'masterdetail_upah' => $yupah[$b]
                                                    ); 
                                                }

                                             $this->db->update_batch('trx_mesin',$updatetrxmesin, 'mesin_id');
                                             $this->db->update_batch('trx_masterdetail',$updatetrxmesindetail, 'masterdetail_id');
                                            }
                                    
                                    $this->db->update_batch('trx_master',$updatemastermesin, 'master_id');
                            }

                        }
                }

                    }else{

                    /* Menghitung Upah Permesin */
                    $hargamesin = $this->Trx_stfg_model->stfghargaproduk('stx_produk','produk_mesin','produk_id', $_POST['jstfg_produk_id'][$i],$usersupervisor);
                    $masterbox = $this->Trx_stfg_model->stfghargaproduk('stx_produk','produk_masterbox','produk_id', $_POST['jstfg_produk_id'][$i],$usersupervisor);
					$totaldisplay = $this->Trx_stfg_model->sumtrxbox('master_display',$_POST['jstfg_produk_id'][$i],$_POST['jstfg_tgllaporan'],$_POST['jstfg_shift'],$usersupervisor);
					$upah = floor($hargamesin * $masterbox * $totalbox); /* Total Upah */
                    $zcount=$this->Trx_stfg_model->counttrxpermesin('master_id',$_POST['jstfg_produk_id'][$i],$_POST['jstfg_tgllaporan'],$_POST['jstfg_shift'],$usersupervisor);
                    $zdata=$this->Trx_stfg_model->tampil_trxmastermesinwline($_POST['jstfg_produk_id'][$i],$_POST['jstfg_tgllaporan'],$_POST['jstfg_shift'],'1',$usersupervisor);
                                               
                            for($z = 0; $z<$zcount; $z++){
                                foreach ($zdata as $f) {
                                    $mesin[$z] = $f['master_id'];           
                                    $biayapermesin[$z] = floor((($f['master_display'] / $totaldisplay ) * $upah ));
                                    $waktupermesin[$z] = $f['master_totalkerjamenit'];
                                    $ycount[$z] = $f['master_jumlahteam'];
                 
                                    /* Update Upah mesin*/  
                                    $updatemastermesin[] = array(
                                        'master_id'=>$mesin[$z],
                                        'master_bayarstfg' => $biayapermesin[$z]
                                    );
                                    /* Menghitung Upah Karyawan */
                       
                                    $ydata=$this->Trx_stfg_model->tampil_trxmesin($_POST['jstfg_produk_id'][$i],$_POST['jstfg_tgllaporan'],$_POST['jstfg_shift'],$mesin[$z], $usersupervisor);
                                                        
                                        $g = 0;
                                            foreach ($ydata as $e) {
                                                $g++;
                                                    $yidmesin[$g] = $e['mesin_id'];
                                                    $yidmaster[$g] = $e['mesin_master_id'];
                                                    $yidkaryawan[$g] = $e['mesin_karyawan_id'];
                                                    $yupah[$g] = floor((($e['mesin_totalmenit'] / $waktupermesin[$z] ) * $biayapermesin[$z])) ;
                                                    $yxdata[$g] = $this->Trx_stfg_model->tampil_trxmasterdetailmesin ($yidmaster[$g], $yidkaryawan[$g], $usersupervisor);

                                                    $updatetrxmesin[] = array(
                                                        'mesin_id'=>$yidmesin[$g],
                                                        'mesin_upah' => $yupah[$g]
                                                    );

                                                    $updatetrxmesindetail[] = array(
                                                        'masterdetail_id'=>$yxdata[$g],
                                                        'masterdetail_upah' => $yupah[$g]
                                                    ); 
                                                }

                                             $this->db->update_batch('trx_mesin',$updatetrxmesin, 'mesin_id');
                                             $this->db->update_batch('trx_masterdetail',$updatetrxmesindetail, 'masterdetail_id'); 


                                           
                                    }
                                $this->db->update_batch('trx_master',$updatemastermesin, 'master_id');
                            }

        			}		            
        							
        			     $entries[] = array(
        							'stfg_produk_id' => $_POST['jstfg_produk_id'][$i],
        							'stfg_shift' => $_POST['jstfg_shift'],
        							'stfg_mbox1' => $_POST['jstfg_mbox1'][$i],
        							'stfg_mbox2' => $_POST['jstfg_mbox2'][$i],
        							'stfg_mbox3' => $_POST['jstfg_mbox3'][$i],
        							'stfg_mbox4' => $_POST['jstfg_mbox4'][$i],
        							'stfg_mbox5' => $_POST['jstfg_mbox5'][$i],
        							'stfg_mbox6' => $_POST['jstfg_mbox6'][$i],
        							'stfg_mbox7' => $_POST['jstfg_mbox7'][$i],
        							'stfg_mbox8' => $_POST['jstfg_mbox8'][$i],
        							'stfg_mbox9' => $_POST['jstfg_mbox9'][$i],
        							'stfg_mbox10' => $_POST['jstfg_mbox10'][$i],
        							'stfg_rijek' => $_POST['jstfg_rijek'][$i],
        							'stfg_total' => $totalbox,
        							'stfg_upah' => '',
        							'stfg_tgllaporan' => $_POST['jstfg_tgllaporan'],
                                    'stfg_usersupervisor' => $usersupervisor,
        							'stfg_userinput' => $username,
        							'stfg_tglinput' => date('Y-m-d'),                
        			    );	
		
        }


            $result =  $this->db->insert_batch('trx_stfg', $entries); 

            redirect(site_url('trx_stfg/create'));           
            $this->session->set_flashdata('message', 'Create Record Success');

        }
    }
    

    public function update($id) 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $usersupervisor=$this->session->userdata('user_supervisor');
        $row = $this->Trx_stfg_model->get_by_id($id);

        if ($row) {
            $data = array(
            	'produk' => $this->m_general->tampil_produkid('stx_produk','produk_status','Aktif', 'produk_usersupervisor',$usersupervisor),
                'button' => 'Update',
                'action' => site_url('trx_stfg/update_action'),
		'stfg_id' => set_value('stfg_id', $row->stfg_id),
		'stfg_produk_id' => set_value('stfg_produk_id', $row->stfg_produk_id),
		'stfg_shift' => set_value('stfg_shift', $row->stfg_shift),
		'stfg_mbox1' => set_value('stfg_mbox1', $row->stfg_mbox1),
		'stfg_mbox2' => set_value('stfg_mbox2', $row->stfg_mbox2),
		'stfg_mbox3' => set_value('stfg_mbox3', $row->stfg_mbox3),
		'stfg_mbox4' => set_value('stfg_mbox4', $row->stfg_mbox4),
		'stfg_mbox5' => set_value('stfg_mbox5', $row->stfg_mbox5),
		'stfg_mbox6' => set_value('stfg_mbox6', $row->stfg_mbox6),
		'stfg_mbox7' => set_value('stfg_mbox7', $row->stfg_mbox7),
		'stfg_mbox8' => set_value('stfg_mbox8', $row->stfg_mbox8),
		'stfg_mbox9' => set_value('stfg_mbox9', $row->stfg_mbox9),
		'stfg_mbox10' => set_value('stfg_mbox10', $row->stfg_mbox10),
		'stfg_mbox11' => set_value('stfg_mbox11', $row->stfg_mbox11),
		'stfg_mbox12' => set_value('stfg_mbox12', $row->stfg_mbox12),
		'stfg_mbox13' => set_value('stfg_mbox13', $row->stfg_mbox13),
		'stfg_mbox14' => set_value('stfg_mbox14', $row->stfg_mbox14),
		'stfg_mbox15' => set_value('stfg_mbox15', $row->stfg_mbox15),
		'stfg_rijek' => set_value('stfg_rijek', $row->stfg_rijek),
		'stfg_total' => set_value('stfg_total', $row->stfg_total),
		'stfg_upah' => set_value('stfg_upah', $row->stfg_upah),
		'stfg_tgllaporan' => set_value('stfg_tgllaporan', $row->stfg_tgllaporan),
		'stfg_userinput' => set_value('stfg_userinput', $row->stfg_userinput),
		'stfg_tglinput' => set_value('stfg_tglinput', $row->stfg_tglinput),
	    );
            $x['content']=$this->load->view('trx_stfg/trx_stfg_form_update', $data,true);
             $this->load->view('template',$x);  
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_stfg'));
        }
    }
    
    public function update_action() 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $usersupervisor=$this->session->userdata('user_supervisor');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('stfg_id', TRUE));
        } else {
        $totalbox = ( $this->input->post('stfg_mbox1',TRUE) + $this->input->post('stfg_mbox2',TRUE) + $this->input->post('stfg_mbox3',TRUE) + $this->input->post('stfg_mbox4',TRUE) +$this->input->post('stfg_mbox5',TRUE) + $this->input->post('stfg_mbox6',TRUE) + $this->input->post('stfg_mbox7',TRUE) + $this->input->post('stfg_mbox8',TRUE) + $this->input->post('stfg_mbox9',TRUE) + $this->input->post('stfg_mbox10',TRUE) + $this->input->post('stfg_mbox11',TRUE) + $this->input->post('stfg_mbox12',TRUE) + $this->input->post('stfg_mbox13',TRUE) + $this->input->post('stfg_mbox14',TRUE) + $this->input->post('stfg_mbox15',TRUE) - $this->input->post('stfg_rijek',TRUE) );
            

$stfgxline=$this->Trx_stfg_model->stfgtampil_trxmasterline($this->input->post('stfg_produk_id',TRUE),$this->input->post('stfg_tgllaporan',TRUE),$this->input->post('stfg_shift',TRUE),'2',$usersupervisor );
            $stfgxmanual=$this->Trx_stfg_model->stfgtampil_trxmasterper($this->input->post('stfg_produk_id',TRUE),$this->input->post('stfg_tgllaporan',TRUE),$this->input->post('stfg_shift',TRUE),'3','1',$usersupervisor); 

                if($stfgxmanual){

	                    if ($usersupervisor =='yupi3'){
	                    	$hargastfg = $this->Trx_stfg_model->stfghargaproduk('stx_produk','produk_step_final','produk_id', $this->input->post('stfg_produk_id',TRUE),$usersupervisor);
		                    
		                    }else{
		                    	$hargastfg = $this->Trx_stfg_model->stfghargaproduk('stx_produk','produk_manual','produk_id', $this->input->post('stfg_produk_id',TRUE),$usersupervisor);
		                    }
                    
                    $masterboxtfg = $this->Trx_stfg_model->stfghargaproduk('stx_produk','produk_masterbox','produk_id', $this->input->post('stfg_produk_id',TRUE),$usersupervisor);
                    $stfgcuntmanual=$this->Trx_stfg_model->stfgcounttrxper('master_id',$this->input->post('stfg_produk_id',TRUE),$this->input->post('stfg_tgllaporan',TRUE),$this->input->post('stfg_shift',TRUE),'3','1',$usersupervisor);
                    $totalboxxmanual = $this->Trx_stfg_model->sumtrxboxstfgmanual('master_box',$this->input->post('stfg_produk_id',TRUE),$this->input->post('stfg_tgllaporan',TRUE),$this->input->post('stfg_shift',TRUE),$usersupervisor);
                    $xtotalupah = floor($hargastfg * $totalbox * $masterboxtfg);

                    $stfgxdata=$this->Trx_stfg_model->stfgtampil_trxmasterper($this->input->post('stfg_produk_id',TRUE),$this->input->post('stfg_tgllaporan',TRUE),$this->input->post('stfg_shift',TRUE),'3','1', $usersupervisor);     
                        for($m = 0; $m<$stfgcuntmanual; $m++){
                            foreach ($stfgxdata as $l) {
                                $stfgamanual[$m] = $l['master_id'];
                                $stfgbcount[$m] = $l['master_jumlahteam'];
                                $waktupermanual[$m] = $l['master_totalkerjamenit'];
                                $stfgcbox[$m] = $l['master_box'];
                                $stfgdbiaya[$m] = floor(($stfgcbox[$m] / $totalboxxmanual) * $xtotalupah );  
                                $xtotalsubupah[$m] =  floor($stfgcbox[$m] * $hargastfg * $masterboxtfg);                              

                                    $updatemastermanual[] = array(
                                        'master_id'=>$stfgamanual[$m],
                                        'master_bayarstfg' => $xtotalsubupah[$m]
                                    );

                                $stfgydata=$this->Trx_stfg_model->stfgtampil_trxmanual($this->input->post('stfg_produk_id',TRUE),$this->input->post('stfg_tgllaporan',TRUE),$this->input->post('stfg_shift',TRUE),$stfgamanual[$m], $usersupervisor);  
                                

                                    $a = 0;
                                    foreach ($stfgydata as $j) {
                                        $aidmanual[$a] = $j['manual_id'];
                                        $bidmaster[$a] = $j['manual_master_id'];
                                        $cidkaryawan[$a] = $j['manual_karyawan_id'];
                                        $didbox[$a] = $j['manual_box'];
                                        $etotalmenit[$a] = $j['manual_totalmenit'];

                                        $didupah[$a] = floor(($etotalmenit[$a] / $waktupermanual[$m]) * $stfgdbiaya[$m]);
                                     
                                        $stfgzdata[$a] = $this->Trx_stfg_model->stfgtampil_trxmasterdetailmanual('masterdetail_id',$bidmaster[$a], $cidkaryawan[$a], $usersupervisor);

                                            $updatemanual[] = array(
                                                'manual_id'=>$aidmanual[$a],
                                                'manual_upah' => $didupah[$a]
                                            );

                                            $updatemanualdetail[] = array(
                                                'masterdetail_id'=>$stfgzdata[$a],
                                                'masterdetail_upah' => $didupah[$a]
                                            );                                      
                                       
                                            }  

                                             $this->db->update_batch('trx_manual',$updatemanual, 'manual_id');
                                             $this->db->update_batch('trx_masterdetail',$updatemanualdetail, 'masterdetail_id');                                      
                                                    
                                    
                                }
                                $this->db->update_batch('trx_master',$updatemastermanual, 'master_id');
                        }


                    }elseif ($stfgxline) {
                       $hargamesin = $this->Trx_stfg_model->stfghargaproduk('stx_produk','produk_mesin','produk_id', $this->input->post('stfg_produk_id',TRUE),$usersupervisor);
                    $masterbox = $this->Trx_stfg_model->stfghargaproduk('stx_produk','produk_masterbox','produk_id', $this->input->post('stfg_produk_id',TRUE),$usersupervisor);
                	$totaldisplay = $this->Trx_stfg_model->sumtrxbox('master_display',$this->input->post('stfg_produk_id',TRUE),$this->input->post('stfg_tgllaporan',TRUE),$this->input->post('stfg_shift',TRUE),$usersupervisor);
                    $upah = floor($hargamesin * $masterbox * $totalbox); /* Total Upah */
                    /* Untuk Menghitung Total Biaya Per Line */         
                    $xcount=$this->Trx_stfg_model->counttrxperline('master_id',$this->input->post('stfg_produk_id',TRUE),$this->input->post('stfg_tgllaporan',TRUE),$this->input->post('stfg_shift',TRUE),$usersupervisor);
                    $xdata=$this->Trx_stfg_model->stfgtampil_trxmasterline($this->input->post('stfg_produk_id',TRUE),$this->input->post('stfg_tgllaporan',TRUE),$this->input->post('stfg_shift',TRUE),'2',$usersupervisor);

                        for($x = 0; $x<$xcount; $x++){
                        /* Menghitung Mesin & Line */
                            foreach ($xdata as $d) {
                                $line[$x] = $d['master_line'];
                                $masterid[$x] = $d['master_id'];
                                $totaldisplayperline[$x] = $this->Trx_stfg_model->sumtrxdisplay('master_display',$this->input->post('stfg_produk_id',TRUE),$this->input->post('stfg_tgllaporan',TRUE),$this->input->post('stfg_shift',TRUE), $line[$x],$usersupervisor);
                                $totalproline[$x]= floor((($totaldisplayperline[$x] / $totaldisplay ) * $upah )); /* Total Project Per Line */                                
                                $waktuline[$x] = $d['master_totalkerjamenit']; /* PENTING */
                                        
                                /* MEnghitung biaya Perline & Permesin */
                                $waktumesin[$x] = $this->Trx_stfg_model->sumtrxwaktu('master_totalkerjamenit',$this->input->post('stfg_produk_id',TRUE),$this->input->post('stfg_tgllaporan',TRUE),$this->input->post('stfg_shift',TRUE), $line[$x] , $usersupervisor);
                                $biayaline[$x] = floor((($waktuline[$x] / ($waktumesin[$x] + $waktuline[$x]) ) * $totalproline[$x]));
                                $biayamesin[$x] =floor((($waktumesin[$x] / ($waktumesin[$x] + $waktuline[$x]) ) * $totalproline[$x]));                       
                                
                                /* Update Upah mesin & line ditable line */
                                $this->db->query("UPDATE trx_master SET master_bayarstfg = $biayaline[$x] WHERE master_id = '$masterid[$x]'");        
                                    
                                    /* Menghitung Upah Line */
                                    $lcount[$x]=$d['master_jumlahteam'];
                                    $ldata=$this->Trx_stfg_model->tampil_trxline($this->input->post('stfg_produk_id',TRUE),$this->input->post('stfg_tgllaporan',TRUE),$this->input->post('stfg_shift',TRUE),$line[$x],$masterid[$x],$usersupervisor);                 
                                            $k = 0;
                                            foreach ($ldata as $p) {
                                                $k++;
                                                $lidline[$k] = $p['line_id'];
                                                $lidmaster[$k] = $p['line_master_id'];
                                                $lidkaryawan[$k] = $p['line_karyawan_id'];
                                                $lupah[$k] = floor((($p['line_totalmenit'] / $waktuline[$x] ) * $biayaline [$x])) ;
                                                $mdata[$k] = $this->Trx_stfg_model->tampil_trxmasterdetailline ($lidmaster[$k], $lidkaryawan[$k] ,$usersupervisor);
                                                    
                                                    $updatetrxline[] = array(
                                                        'line_id'=>$lidline[$k],
                                                        'line_upah' => $lupah[$k]
                                                    );

                                                    $updatetrxlinedetail[] = array(
                                                        'masterdetail_id'=>$mdata[$k],
                                                        'masterdetail_upah' => $lupah[$k]
                                                    ); 
                                                }

                                             $this->db->update_batch('trx_line',$updatetrxline, 'line_id');
                                             $this->db->update_batch('trx_masterdetail',$updatetrxlinedetail, 'masterdetail_id');
                                            
                                                
                    /* Menghitung Upah Permesin */
                    $zcount=$this->Trx_stfg_model->counttrxpermesin('master_id',$this->input->post('stfg_produk_id',TRUE),$this->input->post('stfg_tgllaporan',TRUE),$this->input->post('stfg_shift',TRUE),$usersupervisor);
                    $zdata=$this->Trx_stfg_model->tampil_trxmastermesin($this->input->post('stfg_produk_id',TRUE),$this->input->post('stfg_tgllaporan',TRUE),$this->input->post('stfg_shift',TRUE), $line[$x],$usersupervisor);
                    $totaldisplaypermesin[$x] = $this->Trx_stfg_model->sumtrxdisplay('master_display',$this->input->post('stfg_produk_id',TRUE),$this->input->post('stfg_tgllaporan',TRUE),$this->input->post('stfg_shift',TRUE), $line[$x], $usersupervisor);
                                                
                            for($z = 0; $z<$zcount; $z++){
                                foreach ($zdata as $f) {
                                    $mesin[$z] = $f['master_id'];           
                                    $biayapermesin[$z] = floor((($f['master_display'] / $totaldisplaypermesin[$x] ) * $biayamesin[$x] ));
                                    $waktupermesin[$z] = $f['master_totalkerjamenit'];
                                    $ycount[$z] = $f['master_jumlahteam'];
                                
                                    
                                    /* Update Upah mesin & line ditable line */
                                    $updatemastermesin[] = array(
                                        'master_id'=>$mesin[$z],
                                        'master_bayarstfg' => $biayapermesin[$z]
                                    );
                                    
                                    
                                    /* Menghitung Upah Karyawan */
                       
                                    $ydata=$this->Trx_stfg_model->tampil_trxmesin($this->input->post('stfg_produk_id',TRUE),$this->input->post('stfg_tgllaporan',TRUE),$this->input->post('stfg_shift',TRUE),$mesin[$z], $usersupervisor);
                                                        
                                            $i = 0;
                                            foreach ($ydata as $e) {
                                                $i++;
                                                $yidmesin[$i] = $e['mesin_id'];
                                                $yidmaster[$i] = $e['mesin_master_id'];
                                                $yidkaryawan[$i] = $e['mesin_karyawan_id'];
                                                $yupah[$i] = floor((($e['mesin_totalmenit'] / $waktupermesin [$z] ) * $biayapermesin [$z])) ;
                                                $yxdata[$i] = $this->Trx_stfg_model->tampil_trxmasterdetailmesin ($yidmaster[$i], $yidkaryawan[$i], $usersupervisor);
                                                    $updatetrxmesin[] = array(
                                                        'mesin_id'=>$yidmesin[$i],
                                                        'mesin_upah' => $yupah[$i]
                                                    );

                                                    $updatetrxmesindetail[] = array(
                                                        'masterdetail_id'=>$yxdata[$i],
                                                        'masterdetail_upah' => $yupah[$i]
                                                    ); 
                                                }
                                          
                                           

                                             $this->db->update_batch('trx_mesin',$updatetrxmesin, 'mesin_id');
                                             $this->db->update_batch('trx_masterdetail',$updatetrxmesindetail, 'masterdetail_id');
                                    }

                                    $this->db->update_batch('trx_master',$updatemastermesin, 'master_id');
                            }

                        }
                }                            


                    }else{

                    /* Menghitung Upah Permesin */
                    $hargamesin = $this->Trx_stfg_model->stfghargaproduk('stx_produk','produk_mesin','produk_id', $this->input->post('stfg_produk_id',TRUE),$usersupervisor);
                    $masterbox = $this->Trx_stfg_model->stfghargaproduk('stx_produk','produk_masterbox','produk_id', $this->input->post('stfg_produk_id',TRUE),$usersupervisor);
					$totaldisplay = $this->Trx_stfg_model->sumtrxbox('master_display',$this->input->post('stfg_produk_id',TRUE),$this->input->post('stfg_tgllaporan',TRUE),$this->input->post('stfg_shift',TRUE),$usersupervisor);
					$upah = floor($hargamesin * $masterbox * $totalbox); /* Total Upah */
                    $zcount=$this->Trx_stfg_model->counttrxpermesin('master_id',$this->input->post('stfg_produk_id',TRUE),$this->input->post('stfg_tgllaporan',TRUE),$this->input->post('stfg_shift',TRUE),$usersupervisor);
                    $zdata=$this->Trx_stfg_model->tampil_trxmastermesinwline($this->input->post('stfg_produk_id',TRUE),$this->input->post('stfg_tgllaporan',TRUE),$this->input->post('stfg_shift',TRUE),'1',$usersupervisor);
                                               
                            for($z = 0; $z<$zcount; $z++){
                                foreach ($zdata as $f) {
                                    $mesin[$z] = $f['master_id'];           
                                    $biayapermesin[$z] = floor((($f['master_display'] / $totaldisplay ) * $upah ));
                                    $waktupermesin[$z] = $f['master_totalkerjamenit'];
                                    $ycount[$z] = $f['master_jumlahteam'];
                 
                                    /* Update Upah mesin*/
                                    $updatemastermesin[] = array(
                                        'master_id'=>$mesin[$z],
                                        'master_bayarstfg' => $biayapermesin[$z]
                                    );   
                                    /* Menghitung Upah Karyawan */
                       
                                    $ydata=$this->Trx_stfg_model->tampil_trxmesin($this->input->post('stfg_produk_id',TRUE),$this->input->post('stfg_tgllaporan',TRUE),$this->input->post('stfg_shift',TRUE),$mesin[$z], $usersupervisor);
                                                        
                                        
                                            $s = 0;
                                            foreach ($ydata as $e) {
                                                $s++;
                                                $yidmesin[$s] = $e['mesin_id'];
                                                $yidmaster[$s] = $e['mesin_master_id'];
                                                $yidkaryawan[$s] = $e['mesin_karyawan_id'];
                                                $yupah[$s] = floor((($e['mesin_totalmenit'] / $waktupermesin[$z] ) * $biayapermesin[$z])) ;
                                                $yxdata[$s] = $this->Trx_stfg_model->tampil_trxmasterdetailmesin ($yidmaster[$s], $yidkaryawan[$s], $usersupervisor);
                                                    $updatetrxmesin[] = array(
                                                        'mesin_id'=>$yidmesin[$s],
                                                        'mesin_upah' => $yupah[$s]
                                                    );

                                                    $updatetrxmesindetail[] = array(
                                                        'masterdetail_id'=>$yxdata[$s],
                                                        'masterdetail_upah' => $yupah[$s]
                                                    ); 
                                                }

                                             $this->db->update_batch('trx_mesin',$updatetrxmesin, 'mesin_id');
                                             $this->db->update_batch('trx_masterdetail',$updatetrxmesindetail, 'masterdetail_id'); 
                                        
                                    }
                                    $this->db->update_batch('trx_master',$updatemastermesin, 'master_id');
                            }

        			}




            $data = array(
		'stfg_produk_id' => $this->input->post('stfg_produk_id',TRUE),
		'stfg_shift' => $this->input->post('stfg_shift',TRUE),
		'stfg_mbox1' => $this->input->post('stfg_mbox1',TRUE),
		'stfg_mbox2' => $this->input->post('stfg_mbox2',TRUE),
		'stfg_mbox3' => $this->input->post('stfg_mbox3',TRUE),
		'stfg_mbox4' => $this->input->post('stfg_mbox4',TRUE),
		'stfg_mbox5' => $this->input->post('stfg_mbox5',TRUE),
		'stfg_mbox6' => $this->input->post('stfg_mbox6',TRUE),
		'stfg_mbox7' => $this->input->post('stfg_mbox7',TRUE),
		'stfg_mbox8' => $this->input->post('stfg_mbox8',TRUE),
		'stfg_mbox9' => $this->input->post('stfg_mbox9',TRUE),
		'stfg_mbox10' => $this->input->post('stfg_mbox10',TRUE),
		'stfg_mbox11' => $this->input->post('stfg_mbox11',TRUE),
		'stfg_mbox12' => $this->input->post('stfg_mbox12',TRUE),
		'stfg_mbox13' => $this->input->post('stfg_mbox13',TRUE),
		'stfg_mbox14' => $this->input->post('stfg_mbox14',TRUE),
		'stfg_mbox15' => $this->input->post('stfg_mbox15',TRUE),
		'stfg_rijek' => $this->input->post('stfg_rijek',TRUE),
		'stfg_total' => $totalbox,
		'stfg_upah' => $this->input->post('stfg_upah',TRUE),
		'stfg_tgllaporan' => $this->input->post('stfg_tgllaporan',TRUE),
	    );

            $this->Trx_stfg_model->update($this->input->post('stfg_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('trx_stfg'. '/index?q='. '&t='. urlencode($this->input->post('stfg_tgllaporan',TRUE)) . '&s='. urlencode($this->input->post('stfg_shift',TRUE))));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Trx_stfg_model->get_by_id($id);

        if ($row) {
            $this->Trx_stfg_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
  redirect(site_url('trx_stfg'. '/index?q='.'&t='. urlencode(set_value('stfg_tgllaporan', $row->stfg_tgllaporan)) . '&s='. urlencode(set_value('stfg_shift', $row->stfg_shift))));

        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_stfg'));
        }
    }

    public function _rules() 
    {
    	$this->form_validation->set_rules('stfg_produk_id', 'stfg produk id', 'trim');
    	$this->form_validation->set_rules('stfg_shift', 'stfg shift', 'trim');
    	$this->form_validation->set_rules('stfg_mbox1', 'stfg mbox1', 'trim');
    	$this->form_validation->set_rules('stfg_mbox2', 'stfg mbox2', 'trim');
    	$this->form_validation->set_rules('stfg_mbox3', 'stfg mbox3', 'trim');
    	$this->form_validation->set_rules('stfg_mbox4', 'stfg mbox4', 'trim');
    	$this->form_validation->set_rules('stfg_mbox5', 'stfg mbox5', 'trim');
    	$this->form_validation->set_rules('stfg_mbox6', 'stfg mbox6', 'trim');
    	$this->form_validation->set_rules('stfg_mbox7', 'stfg mbox7', 'trim');
    	$this->form_validation->set_rules('stfg_mbox8', 'stfg mbox8', 'trim');
    	$this->form_validation->set_rules('stfg_mbox9', 'stfg mbox9', 'trim');
    	$this->form_validation->set_rules('stfg_mbox10', 'stfg mbox10', 'trim');
    	$this->form_validation->set_rules('stfg_mbox11', 'stfg mbox11', 'trim');
    	$this->form_validation->set_rules('stfg_mbox12', 'stfg mbox12', 'trim');
    	$this->form_validation->set_rules('stfg_mbox13', 'stfg mbox13', 'trim');
    	$this->form_validation->set_rules('stfg_mbox14', 'stfg mbox14', 'trim');
    	$this->form_validation->set_rules('stfg_mbox15', 'stfg mbox15', 'trim');
    	$this->form_validation->set_rules('stfg_rijek', 'stfg rijek', 'trim');
    	$this->form_validation->set_rules('stfg_total', 'stfg total', 'trim');
    	$this->form_validation->set_rules('stfg_upah', 'stfg upah', 'trim');
    	$this->form_validation->set_rules('stfg_tgllaporan', 'stfg tgllaporan', 'trim');
    	$this->form_validation->set_rules('stfg_userinput', 'stfg userinput', 'trim');
    	$this->form_validation->set_rules('stfg_tglinput', 'stfg tglinput', 'trim');
    	$this->form_validation->set_rules('stfg_id', 'stfg_id', 'trim');
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
            $x['data_stfg']=$this->Trx_stfg_model->download_stfg('',$date_input,'');
        }else{
            $x['data_stfg']=$this->Trx_stfg_model->download_stfg($username,$date_input, $xid_group);
        }
        
        $this->load->view('trx_stfg/excel_trx_stfg',$x);
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "trx_stfg.xls";
        $judul = "trx_stfg";
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
    	xlsWriteLabel($tablehead, $kolomhead++, "Stfg Produk Id");
    	xlsWriteLabel($tablehead, $kolomhead++, "Stfg Shift");
    	xlsWriteLabel($tablehead, $kolomhead++, "Stfg Mbox1");
    	xlsWriteLabel($tablehead, $kolomhead++, "Stfg Mbox2");
    	xlsWriteLabel($tablehead, $kolomhead++, "Stfg Mbox3");
    	xlsWriteLabel($tablehead, $kolomhead++, "Stfg Mbox4");
    	xlsWriteLabel($tablehead, $kolomhead++, "Stfg Mbox5");
    	xlsWriteLabel($tablehead, $kolomhead++, "Stfg Mbox6");
    	xlsWriteLabel($tablehead, $kolomhead++, "Stfg Mbox7");
    	xlsWriteLabel($tablehead, $kolomhead++, "Stfg Mbox8");
    	xlsWriteLabel($tablehead, $kolomhead++, "Stfg Mbox9");
    	xlsWriteLabel($tablehead, $kolomhead++, "Stfg Mbox10");
    	xlsWriteLabel($tablehead, $kolomhead++, "Stfg Mbox11");
    	xlsWriteLabel($tablehead, $kolomhead++, "Stfg Mbox12");
    	xlsWriteLabel($tablehead, $kolomhead++, "Stfg Mbox13");
    	xlsWriteLabel($tablehead, $kolomhead++, "Stfg Mbox14");
    	xlsWriteLabel($tablehead, $kolomhead++, "Stfg Mbox15");
    	xlsWriteLabel($tablehead, $kolomhead++, "Stfg Rijek");
    	xlsWriteLabel($tablehead, $kolomhead++, "Stfg Total");
    	xlsWriteLabel($tablehead, $kolomhead++, "Stfg Upah");
    	xlsWriteLabel($tablehead, $kolomhead++, "Stfg Tgllaporan");
    	xlsWriteLabel($tablehead, $kolomhead++, "Stfg Userinput");
    	xlsWriteLabel($tablehead, $kolomhead++, "Stfg Tglinput");

	foreach ($this->Trx_stfg_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->stfg_produk_id);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->stfg_shift);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->stfg_mbox1);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->stfg_mbox2);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->stfg_mbox3);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->stfg_mbox4);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->stfg_mbox5);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->stfg_mbox6);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->stfg_mbox7);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->stfg_mbox8);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->stfg_mbox9);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->stfg_mbox10);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->stfg_mbox11);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->stfg_mbox12);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->stfg_mbox13);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->stfg_mbox14);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->stfg_mbox15);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->stfg_rijek);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->stfg_total);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->stfg_upah);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->stfg_tgllaporan);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->stfg_userinput);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->stfg_tglinput);
	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=trx_stfg.doc");

        $data = array(
            'trx_stfg_data' => $this->Trx_stfg_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('trx_stfg/trx_stfg_doc',$data);
    }

}

/* End of file Trx_stfg.php */
/* Location: ./application/controllers/Trx_stfg.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-13 14:09:04 */
/* http://harviacode.com */
