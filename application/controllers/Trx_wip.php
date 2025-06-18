<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trx_wip extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Trx_wip_model');
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
        $priv=$this->m_general->get_privilage($id_group,'trx_wip');      
        $x['add']='N';
        $x['update']='N';
        $x['delete']='N';
        $x['comment1']='N';
        $x['report']='N';
        foreach ($priv as $a) {
            $id_group=$id_group;
            $nav_url='trx_wip';
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
            $config['base_url'] = base_url() . 'trx_wip/index.html?q=' . urlencode($q) . '&t='. urlencode($t). '&s='. urlencode($s);
            $config['first_url'] = base_url() . 'trx_wip/index.html?q=' . urlencode($q) . '&t='. urlencode($t) . '&s='. urlencode($s);
            $config['per_page'] = 0;

        } elseif (($s <> '') and ($t <> '') and ($q == '')){
            $config['base_url'] = base_url() . 'trx_wip/index.html?t='. urlencode($t). '&s='. urlencode($s);;
            $config['first_url'] = base_url() . 'trx_wip/index.html?t='. urlencode($t). '&s='. urlencode($s);;
            $config['per_page'] = 0;

        }else {
            $config['base_url'] = base_url() . 'trx_wip/index.html';
            $config['first_url'] = base_url() . 'trx_wip';
            $config['per_page'] = 25;
        }


        $config['page_query_string'] = TRUE;
        $trx_wip = $this->Trx_wip_model->tampil_data($config['per_page'], $start, $q, $username,$id_group ,$s, $t);
        $config['total_rows'] = $this->Trx_wip_model->total_rows($q, $username, $id_group,$s, $t);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'trx_wip_data' => $trx_wip,
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
            'priv_count' =>$this->m_general->cek_privilage($id_group,'trx_wip'),
        );
        $x['content']=$this->load->view('trx_wip/trx_wip_list', $data,TRUE);
        $this->load->view('template',$x);
    }

    public function read($id) 
    {
        
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
      	$row = $this->Trx_wip_model->get_by_id($id);
        if ($row) {
            $data = array(
		'wip_id' => $row->wip_id,
		'wip_produk_id' => $row->wip_produk_id,
		'produk_nama' => $row->produk_nama,
		'wip_shift' => $row->wip_shift,
		'wip_mbox1' => $row->wip_mbox1,
		'wip_mbox2' => $row->wip_mbox2,
		'wip_mbox3' => $row->wip_mbox3,
		'wip_mbox4' => $row->wip_mbox4,
		'wip_mbox5' => $row->wip_mbox5,
		'wip_mbox6' => $row->wip_mbox6,
		'wip_mbox7' => $row->wip_mbox7,
		'wip_mbox8' => $row->wip_mbox8,
		'wip_mbox9' => $row->wip_mbox9,
		'wip_mbox10' => $row->wip_mbox10,
		'wip_mbox11' => $row->wip_mbox11,
		'wip_mbox12' => $row->wip_mbox12,
		'wip_mbox13' => $row->wip_mbox13,
		'wip_mbox14' => $row->wip_mbox14,
		'wip_mbox15' => $row->wip_mbox15,
		'wip_rijek' => $row->wip_rijek,
		'wip_total' => $row->wip_total,
		'wip_upah' => $row->wip_upah,
		'wip_tgllaporan' => $row->wip_tgllaporan,
		'wip_userinput' => $row->wip_userinput,
		'wip_tglinput' => $row->wip_tglinput,
	    );
            $x['content']=$this->load->view('trx_wip/trx_wip_read', $data,true);
            $this->load->view('template',$x);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_wip'));
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
            'action' => site_url('trx_wip/create_action'),
	    'wip_id' => set_value('wip_id'),
	    'wip_produk_id' => set_value('wip_produk_id'),
	    'wip_shift' => set_value('wip_shift'),
	    'wip_mbox1' => set_value('wip_mbox1'),
	    'wip_mbox2' => set_value('wip_mbox2'),
	    'wip_mbox3' => set_value('wip_mbox3'),
	    'wip_mbox4' => set_value('wip_mbox4'),
	    'wip_mbox5' => set_value('wip_mbox5'),
	    'wip_mbox6' => set_value('wip_mbox6'),
	    'wip_mbox7' => set_value('wip_mbox7'),
	    'wip_mbox8' => set_value('wip_mbox8'),
	    'wip_mbox9' => set_value('wip_mbox9'),
	    'wip_mbox10' => set_value('wip_mbox10'),
	    'wip_mbox11' => set_value('wip_mbox11'),
	    'wip_mbox12' => set_value('wip_mbox12'),
	    'wip_mbox13' => set_value('wip_mbox13'),
	    'wip_mbox14' => set_value('wip_mbox14'),
	    'wip_mbox15' => set_value('wip_mbox15'),
	    'wip_rijek' => set_value('wip_rijek'),
	    'wip_total' => set_value('wip_total'),
	    'wip_upah' => set_value('wip_upah'),
	    'wip_tgllaporan' => set_value('wip_tgllaporan'),
	    'wip_userinput' => set_value('wip_userinput'),
	    'wip_tglinput' => set_value('wip_tglinput'),
	);
        $x['content']=$this->load->view('trx_wip/trx_wip_form', $data,TRUE);
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
            $totalbox =  ( $_POST['jwip_mbox1'][$i] + $_POST['jwip_mbox2'][$i] + $_POST['jwip_mbox3'][$i] + $_POST['jwip_mbox4'][$i] + $_POST['jwip_mbox5'][$i] + $_POST['jwip_mbox6'][$i] + $_POST['jwip_mbox7'][$i] + $_POST['jwip_mbox8'][$i]);
            $xtotal = ($totalbox  - $_POST['jwip_mbox14'][$i]);
            $totalboxwipmanual = (( $_POST['jwip_mbox15'][$i] * $totalbox ) - ($_POST['jwip_mbox14'][$i] + $_POST['jwip_rijek'][$i]));
            $totalboxwip =($totalbox - $_POST['jwip_mbox14'][$i]);

            $hargawip[$i] = $this->Trx_wip_model->wiphargaproduk('stx_produk',' produk_wip','produk_id', $_POST['jwip_produk_id'][$i],TRUE);
                                             
                        /* Upah untuk mesin */
            $wiplinedata=$this->Trx_wip_model->wiptampil_trxmasterline($_POST['jwip_produk_id'][$i],$_POST['jwip_tgllaporan'],$_POST['jwip_shift'],'2', $usersupervisor);
            $wipmanualdata=$this->Trx_wip_model->wiptampil_trxmasterper($_POST['jwip_produk_id'][$i],$_POST['jwip_tgllaporan'],$_POST['jwip_shift'],'3','3', $usersupervisor);

            if($wipmanualdata){           
             $wipcountmanual=$this->Trx_wip_model->wipcounttrxper('master_id',$_POST['jwip_produk_id'][$i],$_POST['jwip_tgllaporan'],$_POST['jwip_shift'],'3','3', $usersupervisor);
                 $totalboxmanual = $this->Trx_wip_model->sumtrxboxwipmanual('master_box',$_POST['jwip_produk_id'][$i],$_POST['jwip_tgllaporan'],$_POST['jwip_shift'],$usersupervisor);
                 $hargawip[$i] = $this->Trx_wip_model->wiphargaproduk('stx_produk','produk_manual','produk_id', $_POST['jwip_produk_id'][$i],TRUE);
                 $duppah = floor($hargawip[$i] * $totalboxwipmanual);
               
                    for($m = 0; $m<$wipcountmanual; $m++){
                        foreach ($wipmanualdata as $l) {
                            $wipamanual[$m] = $l['master_id'];
                            $wipbcount[$m] = $l['master_jumlahteam'];
                            $wipcbox[$m] = $l['master_box'];
                            $wipdbiaya[$m] = floor(($wipcbox[$m] / $totalboxmanual) * $duppah );
                            $wipetotalwaktu[$m] = $l['master_totalkerjamenit'];
                            
                            $updatemasterwipmanual[] = array(
                                'master_id'=>$wipamanual[$m],
                                'master_bayarstfg' => $wipdbiaya[$m]
                            );

                            $wipydata=$this->Trx_wip_model->wiptampil_trxmanual($_POST['jwip_produk_id'][$i],$_POST['jwip_tgllaporan'],$_POST['jwip_shift'],$wipamanual[$m], $usersupervisor);  
                            	$c = 0;
                                foreach ($wipydata as $j) {
                                    $aidmanual[$c] = $j['manual_id'];
                                    $bidmaster[$c] = $j['manual_master_id'];
                                    $cidkaryawan[$c] = $j['manual_karyawan_id'];
                                    $didtotalmenit[$c] = $j['manual_totalmenit'];

                                    $didupah[$c] = floor(($didtotalmenit[$c] / $wipetotalwaktu[$m]) *  $wipdbiaya[$m] );
                                    $wipzdata[$c] = $this->Trx_wip_model->wiptampil_trxmasterdetailmesin('masterdetail_id',$bidmaster[$c], $cidkaryawan[$c], $usersupervisor);
                                    
                                            $updatewipmanual[] = array(
                                                'manual_id'=>$aidmanual[$c],
                                                'manual_upah' => $didupah[$c]
                                            );

                                            $updatewipmanualdetail[] = array(
                                                'masterdetail_id'=>$wipzdata[$c],
                                                'masterdetail_upah' => $didupah[$c]
                                            );
                                    }

                                $this->db->update_batch('trx_manual',$updatewipmanual, 'manual_id');
                                $this->db->update_batch('trx_masterdetail',$updatewipmanualdetail, 'masterdetail_id');                                   
                                            
                        }

                        $this->db->update_batch('trx_master',$updatemasterwipmanual, 'master_id');

                    }       

            } elseif($wiplinedata){           

			 $uppahwip = floor($hargawip[$i] * $totalboxwipmanual);
                    $totaldisplay = $this->Trx_wip_model->sumtrxboxwip('master_display',$_POST['jwip_produk_id'][$i],$_POST['jwip_tgllaporan'],$_POST['jwip_shift'],$usersupervisor);
                    /* Untuk Menghitung Total Biaya Per Line */         
                    $xcount=$this->Trx_wip_model->counttrxperlinewip('master_id',$_POST['jwip_produk_id'][$i],$_POST['jwip_tgllaporan'],$_POST['jwip_shift'],$usersupervisor);
                    $xdata=$this->Trx_wip_model->wiptampil_trxmasterline($_POST['jwip_produk_id'][$i],$_POST['jwip_tgllaporan'],$_POST['jwip_shift'],'2',$usersupervisor);

                        for($x = 0; $x<$xcount; $x++){
                        /* Menghitung Mesin & Line */
                            foreach ($xdata as $d) {
                                $wipline[$x] = $d['master_line'];
                                $masteridwip[$x] = $d['master_id'];
                                $totaldisplayperlinewip[$x] = $this->Trx_wip_model->sumtrxdisplaywip('master_display',$_POST['jwip_produk_id'][$i],$_POST['jwip_tgllaporan'],$_POST['jwip_shift'], $wipline[$x],$usersupervisor);
                                $totalprolinewip[$x]= floor((($totaldisplayperlinewip[$x] / $totaldisplay ) * $uppahwip )); /* Total Project Per Line */                                
                                $waktulinewip[$x] = $d['master_totalkerjamenit']; /* PENTING */
                                        
                                /* MEnghitung biaya Perline & Permesin */
                                $waktumesinwip[$x] = $this->Trx_wip_model->sumtrxwaktuwip('master_totalkerjamenit',$_POST['jwip_produk_id'][$i],$_POST['jwip_tgllaporan'],$_POST['jwip_shift'], $wipline[$x] , $usersupervisor);
                                $biayalinewip[$x] = floor((($waktulinewip[$x] / ($waktumesinwip[$x] + $waktulinewip[$x]) ) * $totalprolinewip[$x]));
                                $biayamesinwip[$x] =floor((($waktumesinwip[$x] / ($waktumesinwip[$x] + $waktulinewip[$x]) ) * $totalprolinewip[$x]));                       
                                
                                /* Update Upah mesin & line ditable line */
                                $this->db->query("UPDATE trx_master SET master_bayarstfg = $biayalinewip[$x] WHERE master_id = '$masteridwip[$x]'");        
                                    
                                    /* Menghitung Upah Line */
                                    $lcountwip[$x]=$d['master_jumlahteam'];
                                    $ldatawip=$this->Trx_wip_model->tampil_trxlinewip($_POST['jwip_produk_id'][$i],$_POST['jwip_tgllaporan'],$_POST['jwip_shift'],$wipline[$x],$masteridwip[$x],$usersupervisor);                 
                                     
                                        	$b = 0;
                                            foreach ($ldatawip as $p) {
                                            	$b++;
                                                $lidlinewip[$b] = $p['line_id'];
                                                $lidmasterwip[$b] = $p['line_master_id'];
                                                $lidkaryawanwip[$b] = $p['line_karyawan_id'];
                                                $lupahwip[$b] = floor((($p['line_totalmenit'] / $waktulinewip[$x] ) * $biayalinewip [$x])) ;
 
                                                $mdatawip[$b] = $this->Trx_wip_model->tampil_trxmasterdetaillinewip($lidmasterwip[$b], $lidkaryawanwip[$b] ,$usersupervisor);

                                                    $updatetrxline[] = array(
                                                        'line_id'=>$lidlinewip[$b],
                                                        'line_upah' => $lupahwip[$b]
                                                    );

                                                    $updatetrxlinedetail[] = array(
                                                        'masterdetail_id'=>$mdatawip[$b],
                                                        'masterdetail_upah' => $lupahwip[$b]
                                                    );
                                                }
                                             $this->db->update_batch('trx_line',$updatetrxline, 'line_id');
                                             $this->db->update_batch('trx_masterdetail',$updatetrxlinedetail, 'masterdetail_id');
                                           
                                                
                                /* Menghitung Upah Permesin */
                                $zcountwip=$this->Trx_wip_model->counttrxpermesinwip('master_id',$_POST['jwip_produk_id'][$i],$_POST['jwip_tgllaporan'],$_POST['jwip_shift'],$usersupervisor);
                                $zdatawip=$this->Trx_wip_model->tampil_trxmastermesinwip($_POST['jwip_produk_id'][$i],$_POST['jwip_tgllaporan'],$_POST['jwip_shift'], $wipline[$x],$usersupervisor);
                                $totaldisplaypermesinwip[$x] = $this->Trx_wip_model->sumtrxdisplaywip('master_display',$_POST['jwip_produk_id'][$i],$_POST['jwip_tgllaporan'],$_POST['jwip_shift'], $wipline[$x], $usersupervisor);
                                                            
                                        for($z = 0; $z<$zcountwip; $z++){
                                            foreach ($zdatawip as $f) {
                                                $mesinwip[$z] = $f['master_id'];           
                                                $biayapermesinwip[$z] = floor((($f['master_display'] / $totaldisplaypermesinwip[$x] ) * $biayamesinwip[$x] ));
                                                $waktupermesinwip[$z] = $f['master_totalkerjamenit'];
                                                $ycountwip[$z] = $f['master_jumlahteam'];
                             
                                                /* Update Upah mesin & line ditable line */ 
                                                $updatemasterwip[] = array(
                                                    'master_id'=>$mesinwip[$z],
                                                    'master_bayarstfg' => $biayapermesinwip[$z]
                                                );
                                                /* Menghitung Upah Karyawan */
                                   
                                                $ydatawip=$this->Trx_wip_model->wiptampil_trxmesin($_POST['jwip_produk_id'][$i],$_POST['jwip_tgllaporan'],$_POST['jwip_shift'],$mesinwip[$z], $usersupervisor);
                                                                    
                                                    $n = 0;
                                                        foreach ($ydatawip as $e) {
                                                            $n++;
                                                            $yidmesinwip[$n] = $e['mesin_id'];
                                                            $yidmasterwip[$n] = $e['mesin_master_id'];
                                                            $yidkaryawanwip[$n] = $e['mesin_karyawan_id'];
                                                            $yupahwip[$n] = floor((($e['mesin_totalmenit'] / $waktupermesinwip[$z] ) * $biayapermesinwip[$z])) ;
                                                        $yxdatawip[$n] = $this->Trx_wip_model->wiptampil_trxmesindetail($yidmasterwip[$n], $yidkaryawanwip[$n], $usersupervisor);
                                                            
                                                            $updatetrxwip[] = array(
                                                                'mesin_id'=>$yidmesinwip[$n],
                                                                'mesin_upah' => $yupahwip[$n]
                                                            );

                                                            $updatetrxwipdetail[] = array(
                                                                'masterdetail_id'=>$yxdatawip[$n],
                                                                'masterdetail_upah' => $yupahwip[$n]
                                                            ); 

                                                            }
                                                            $this->db->update_batch('trx_mesin',$updatetrxwip, 'mesin_id');
                                                            $this->db->update_batch('trx_masterdetail',$updatetrxwipdetail, 'masterdetail_id');

                                                      
                                                }
                                                 $this->db->update_batch('trx_master',$updatemasterwip, 'master_id');
                                        }

                        }
                }



                

            }else{

            $wipcountmesin=$this->Trx_wip_model->wipcounttrxper('master_id',$_POST['jwip_produk_id'][$i],$_POST['jwip_tgllaporan'],$_POST['jwip_shift'],'1','3',$usersupervisor);
            $totaldisplaywip = $this->Trx_wip_model->sumtrxboxwip('master_display',$_POST['jwip_produk_id'][$i],$_POST['jwip_tgllaporan'],$_POST['jwip_shift'],$usersupervisor);
            $uppahwip = floor($hargawip[$i] * $totalboxwipmanual);  
            $wipmanualdata=$this->Trx_wip_model->wiptampil_trxmasterper($_POST['jwip_produk_id'][$i],$_POST['jwip_tgllaporan'],$_POST['jwip_shift'],'1','3', $usersupervisor);

                for($k = 0; $k<$wipcountmesin; $k++){
                    foreach ($wipmanualdata as $g) {
                        $wipmesin[$k] = $g['master_id'];
                        $wipacount[$k] = $g['master_jumlahteam'];
                        $biayapermesinwip[$k] = floor(($g['master_display'] / $totaldisplaywip ) * $uppahwip );
                        $waktupermesinwip[$k] = $g['master_totalkerjamenit'];
                                                                       
                        $updatemasterwip[] = array(
                            'master_id'=>$wipmesin[$k],
                            'master_bayarstfg' => $biayapermesinwip[$k]
                        );


                        $wipbdata=$this->Trx_wip_model->wiptampil_trxmesin($_POST['jwip_produk_id'][$i],$_POST['jwip_tgllaporan'],$_POST['jwip_shift'],$wipmesin[$k], $usersupervisor);  
                          
                        	$f= 0;
                            foreach ($wipbdata as $j) {
                            	$f++;
                                $aidmesin[$f] = $j['mesin_id'];
                                $bidmaster[$f] = $j['mesin_master_id'];
                                $cidkaryawan[$f] = $j['mesin_karyawan_id'];
                                $didtotalmenit[$f] = $j['mesin_totalmenit'];

                                $didupah[$f] = floor(($didtotalmenit[$f] / $waktupermesinwip[$k]) * $biayapermesinwip[$k] );
                                $wipcdata[$f] = $this->Trx_wip_model->wiptampil_trxmasterdetailmesin('masterdetail_id',$bidmaster[$f], $cidkaryawan[$f], $usersupervisor);
                                    $updatetrxwip[] = array(
                                        'mesin_id'=>$aidmesin[$f],
                                        'mesin_upah' => $didupah[$f]
                                    );

                                    $updatetrxwipdetail[] = array(
                                        'masterdetail_id'=>$wipcdata[$f],
                                        'masterdetail_upah' => $didupah[$f]
                                    ); 
                            }
                            $this->db->update_batch('trx_mesin',$updatetrxwip, 'mesin_id');
                            $this->db->update_batch('trx_masterdetail',$updatetrxwipdetail, 'masterdetail_id');
                                            
                    }
                $this->db->update_batch('trx_master',$updatemasterwip, 'master_id');

                }


            }

            $entries[] = array(
                'wip_produk_id' => $_POST['jwip_produk_id'][$i],
                'wip_shift' => $_POST['jwip_shift'][$i],
                'wip_mbox15' => $_POST['jwip_mbox15'][$i],
                'wip_mbox1' => $_POST['jwip_mbox1'][$i],
                'wip_mbox2' => $_POST['jwip_mbox2'][$i],
                'wip_mbox3' => $_POST['jwip_mbox3'][$i],
                'wip_mbox4' => $_POST['jwip_mbox4'][$i],
                'wip_mbox5' => $_POST['jwip_mbox5'][$i],
                'wip_mbox6' => $_POST['jwip_mbox6'][$i],
                'wip_mbox7' => $_POST['jwip_mbox7'][$i],
                'wip_mbox8' => $_POST['jwip_mbox8'][$i],
                'wip_mbox14' => $_POST['jwip_mbox14'][$i],
                'wip_rijek' => $_POST['jwip_rijek'][$i],
                'wip_total' => $totalboxwipmanual,
                'wip_tgllaporan' => $_POST['jwip_tgllaporan'],
                'wip_userinput' => $username,
                'wip_usersupervisor' => $usersupervisor,
                'wip_tglinput' => date('Y-m-d'),
                
            );

        }
            $result =  $this->db->insert_batch('trx_wip', $entries); 
        	if($result){
                echo 1;
            }
        
            else{
                echo 0;
            }
            exit;
            redirect(site_url('trx_wip/create'));           
            $this->session->set_flashdata('message', 'Create Record Success');
        }
    }
    
    public function update($id) 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $usersupervisor=$this->session->userdata('user_supervisor');
        $row = $this->Trx_wip_model->get_by_id($id);

        if ($row) {
            $data = array(
            	'produk' => $this->m_general->tampil_produkid('stx_produk','produk_status','Aktif', 'produk_usersupervisor',$usersupervisor),
                'shift' => $this->m_general->tampil_data_perfield1('stx_shift','shift_status','Aktif'),
                'button' => 'Update',
                'action' => site_url('trx_wip/update_action'),
		'wip_id' => set_value('wip_id', $row->wip_id),
		'wip_produk_id' => set_value('wip_produk_id', $row->wip_produk_id),
		'wip_shift' => set_value('wip_shift', $row->wip_shift),
		'wip_mbox1' => set_value('wip_mbox1', $row->wip_mbox1),
		'wip_mbox2' => set_value('wip_mbox2', $row->wip_mbox2),
		'wip_mbox3' => set_value('wip_mbox3', $row->wip_mbox3),
		'wip_mbox4' => set_value('wip_mbox4', $row->wip_mbox4),
		'wip_mbox5' => set_value('wip_mbox5', $row->wip_mbox5),
		'wip_mbox6' => set_value('wip_mbox6', $row->wip_mbox6),
		'wip_mbox7' => set_value('wip_mbox7', $row->wip_mbox7),
		'wip_mbox8' => set_value('wip_mbox8', $row->wip_mbox8),
		'wip_mbox9' => set_value('wip_mbox9', $row->wip_mbox9),
		'wip_mbox10' => set_value('wip_mbox10', $row->wip_mbox10),
		'wip_mbox11' => set_value('wip_mbox11', $row->wip_mbox11),
		'wip_mbox12' => set_value('wip_mbox12', $row->wip_mbox12),
		'wip_mbox13' => set_value('wip_mbox13', $row->wip_mbox13),
		'wip_mbox14' => set_value('wip_mbox14', $row->wip_mbox14),
		'wip_mbox15' => set_value('wip_mbox15', $row->wip_mbox15),
		'wip_rijek' => set_value('wip_rijek', $row->wip_rijek),
		'wip_total' => set_value('wip_total', $row->wip_total),
		'wip_upah' => set_value('wip_upah', $row->wip_upah),
		'wip_tgllaporan' => set_value('wip_tgllaporan', $row->wip_tgllaporan),
		'wip_userinput' => set_value('wip_userinput', $row->wip_userinput),
		'wip_tglinput' => set_value('wip_tglinput', $row->wip_tglinput),
	    );
            $x['content']=$this->load->view('trx_wip/trx_wip_form_update', $data,true);
             $this->load->view('template',$x); 
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_wip'));
        }
    }
    
    public function update_action() 
    {
        
       $username=$this->session->userdata('username');
        $usersupervisor=$this->session->userdata('user_supervisor');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('wip_id', TRUE));
        } else {

            $totalbox = ( $this->input->post('wip_mbox1',TRUE) + $this->input->post('wip_mbox2',TRUE) + $this->input->post('wip_mbox3',TRUE) + $this->input->post('wip_mbox4',TRUE) +$this->input->post('wip_mbox5',TRUE) + $this->input->post('wip_mbox6',TRUE) + $this->input->post('wip_mbox7',TRUE) + $this->input->post('wip_mbox8',TRUE) + $this->input->post('wip_mbox9',TRUE) + $this->input->post('wip_mbox10',TRUE) + $this->input->post('wip_mbox11',TRUE) + $this->input->post('wip_mbox12',TRUE) + $this->input->post('wip_mbox13',TRUE)  );

            $xtotal = ($totalbox  - $this->input->post('wip_mbox14',TRUE));
            $totalboxwipmanual = (($this->input->post('wip_mbox15',TRUE) * $totalbox ) - ($this->input->post('wip_mbox14',TRUE) + $this->input->post('wip_rijek',TRUE)));
            $totalboxwip =($totalbox - $this->input->post('wip_mbox14',TRUE));
            


                $hargawip  = $this->Trx_wip_model->wiphargaproduk('stx_produk','produk_wip','produk_id', $this->input->post('wip_produk_id',TRUE));

                 
                        /* Upah untuk mesin */
            $wiplinedata=$this->Trx_wip_model->wiptampil_trxmasterline($this->input->post('wip_produk_id',TRUE),$this->input->post('wip_tgllaporan',TRUE),$this->input->post('wip_shift',TRUE),'2', $usersupervisor);
            $wipmanualdata=$this->Trx_wip_model->wiptampil_trxmasterper($this->input->post('wip_produk_id',TRUE),$this->input->post('wip_tgllaporan',TRUE),$this->input->post('wip_shift',TRUE),'3','3', $usersupervisor);

            if($wipmanualdata){           

                $wipcountmanual=$this->Trx_wip_model->wipcounttrxper('master_id',$this->input->post('wip_produk_id',TRUE),$this->input->post('wip_tgllaporan',TRUE),$this->input->post('wip_shift',TRUE),'3','3', $usersupervisor);
                 $totalboxmanual = $this->Trx_wip_model->sumtrxboxwipmanual('master_box',$this->input->post('wip_produk_id',TRUE),$this->input->post('wip_tgllaporan',TRUE),$this->input->post('wip_shift',TRUE),$usersupervisor);
                 $hargawip  = $this->Trx_wip_model->wiphargaproduk('stx_produk','produk_manual','produk_id', $this->input->post('wip_produk_id',TRUE));
                 $duppah = floor($hargawip  * $totalboxwipmanual);
               
                    for($m = 0; $m<$wipcountmanual; $m++){
                        foreach ($wipmanualdata as $l) {
                            $wipamanual[$m] = $l['master_id'];
                            $wipbcount[$m] = $l['master_jumlahteam'];
                            $wipcbox[$m] = $l['master_box'];
                            $wipdbiaya[$m] = floor(($wipcbox[$m] / $totalboxmanual) * $duppah );
                            $wipetotalwaktu[$m] = $l['master_totalkerjamenit'];
                            
        

                                    $updatemasterwipmanual[] = array(
                                        'master_id'=>$wipamanual[$m],
                                        'master_bayarstfg' => $wipdbiaya[$m]
                                    );

                            $wipydata=$this->Trx_wip_model->wiptampil_trxmanual($this->input->post('wip_produk_id',TRUE),$this->input->post('wip_tgllaporan',TRUE),$this->input->post('wip_shift',TRUE),$wipamanual[$m], $usersupervisor);  
                          
                            	$u = 0;
                                foreach ($wipydata as $j) {
                                    $aidmanual[$u] = $j['manual_id'];
                                    $bidmaster[$u] = $j['manual_master_id'];
                                    $cidkaryawan[$u] = $j['manual_karyawan_id'];
                                    $didtotalmenit[$u] = $j['manual_totalmenit'];

                                    $didupah[$u] = floor(($didtotalmenit[$u] / $wipetotalwaktu[$m]) *  $wipdbiaya[$m] );
                                    $wipzdata[$u] = $this->Trx_wip_model->wiptampil_trxmasterdetailmesin('masterdetail_id',$bidmaster[$u], $cidkaryawan[$u], $usersupervisor);
                                    
                                            $updatewipmanual[] = array(
                                                'manual_id'=>$aidmanual[$u],
                                                'manual_upah' => $didupah[$u]
                                            );

                                            $updatewipmanualdetail[] = array(
                                                'masterdetail_id'=>$wipzdata[$u],
                                                'masterdetail_upah' => $didupah[$u]
                                            );
                                    }
                                             $this->db->update_batch('trx_manual',$updatewipmanual, 'manual_id');
                                             $this->db->update_batch('trx_masterdetail',$updatewipmanualdetail, 'masterdetail_id');


                           
                                            
                        }

                        $this->db->update_batch('trx_master',$updatemasterwipmanual, 'master_id');

                    }

            } elseif($wiplinedata){
            

                    $uppahwip = floor($hargawip  * $totalboxwipmanual);
                    $totaldisplay = $this->Trx_wip_model->sumtrxboxwip('master_display',$this->input->post('wip_produk_id',TRUE),$this->input->post('wip_tgllaporan',TRUE),$this->input->post('wip_shift',TRUE),$usersupervisor);
                    /* Untuk Menghitung Total Biaya Per Line */         
                    $xcount=$this->Trx_wip_model->counttrxperlinewip('master_id',$this->input->post('wip_produk_id',TRUE),$this->input->post('wip_tgllaporan',TRUE),$this->input->post('wip_shift',TRUE),$usersupervisor);
                    $xdata=$this->Trx_wip_model->wiptampil_trxmasterline($this->input->post('wip_produk_id',TRUE),$this->input->post('wip_tgllaporan',TRUE),$this->input->post('wip_shift',TRUE),'2',$usersupervisor);

                        for($x = 0; $x<$xcount; $x++){
                        /* Menghitung Mesin & Line */
                            foreach ($xdata as $d) {
                                $wipline[$x] = $d['master_line'];
                                $masteridwip[$x] = $d['master_id'];
                                $totaldisplayperlinewip[$x] = $this->Trx_wip_model->sumtrxdisplaywip('master_display',$this->input->post('wip_produk_id',TRUE),$this->input->post('wip_tgllaporan',TRUE),$this->input->post('wip_shift',TRUE), $wipline[$x],$usersupervisor);
                                $totalprolinewip[$x]= floor((($totaldisplayperlinewip[$x] / $totaldisplay ) * $uppahwip )); /* Total Project Per Line */                                
                                $waktulinewip[$x] = $d['master_totalkerjamenit']; /* PENTING */
                                        
                                /* MEnghitung biaya Perline & Permesin */
                                $waktumesinwip[$x] = $this->Trx_wip_model->sumtrxwaktuwip('master_totalkerjamenit',$this->input->post('wip_produk_id',TRUE),$this->input->post('wip_tgllaporan',TRUE),$this->input->post('wip_shift',TRUE), $wipline[$x] , $usersupervisor);
                                $biayalinewip[$x] = floor((($waktulinewip[$x] / ($waktumesinwip[$x] + $waktulinewip[$x]) ) * $totalprolinewip[$x]));
                                $biayamesinwip[$x] =floor((($waktumesinwip[$x] / ($waktumesinwip[$x] + $waktulinewip[$x]) ) * $totalprolinewip[$x]));                       
                                
                                /* Update Upah mesin & line ditable line */
                                $this->db->query("UPDATE trx_master SET master_bayarstfg = $biayalinewip[$x] WHERE master_id = '$masteridwip[$x]'");        
                                    
                                    /* Menghitung Upah Line */
                                    $lcountwip[$x]=$d['master_jumlahteam'];
                                    $ldatawip=$this->Trx_wip_model->tampil_trxlinewip($this->input->post('wip_produk_id',TRUE),$this->input->post('wip_tgllaporan',TRUE),$this->input->post('wip_shift',TRUE),$wipline[$x],$masteridwip[$x],$usersupervisor);                 
                                   
                                        	$r = 0;
                                            foreach ($ldatawip as $p) {
                                            	$r++;
                                                $lidlinewip[$r] = $p['line_id'];
                                                $lidmasterwip[$r] = $p['line_master_id'];
                                                $lidkaryawanwip[$r] = $p['line_karyawan_id'];
                                                $lupahwip[$r] = floor((($p['line_totalmenit'] / $waktulinewip[$x] ) * $biayalinewip [$x])) ;
                                                $mdatawip[$r] = $this->Trx_wip_model->tampil_trxmasterdetaillinewip($lidmasterwip[$r], $lidkaryawanwip[$r] ,$usersupervisor);
                                                    
                                                    $updatetrxline[] = array(
                                                        'line_id'=>$lidlinewip[$r],
                                                        'line_upah' => $lupahwip[$r]
                                                    );

                                                    $updatetrxlinedetail[] = array(
                                                        'masterdetail_id'=>$mdatawip[$r],
                                                        'masterdetail_upah' => $lupahwip[$r]
                                                    );
                                                }
                                             $this->db->update_batch('trx_line',$updatetrxline, 'line_id');
                                             $this->db->update_batch('trx_masterdetail',$updatetrxlinedetail, 'masterdetail_id');
                                            
                                                
                                /* Menghitung Upah Permesin */
                                $zcountwip=$this->Trx_wip_model->counttrxpermesinwip('master_id',$this->input->post('wip_produk_id',TRUE),$this->input->post('wip_tgllaporan',TRUE),$this->input->post('wip_shift',TRUE),$usersupervisor);
                                $zdatawip=$this->Trx_wip_model->tampil_trxmastermesinwip($this->input->post('wip_produk_id',TRUE),$this->input->post('wip_tgllaporan',TRUE),$this->input->post('wip_shift',TRUE), $wipline[$x],$usersupervisor);
                                $totaldisplaypermesinwip[$x] = $this->Trx_wip_model->sumtrxdisplaywip('master_display',$this->input->post('wip_produk_id',TRUE),$this->input->post('wip_tgllaporan',TRUE),$this->input->post('wip_shift',TRUE), $wipline[$x], $usersupervisor);
                                                            
                                        for($z = 0; $z<$zcountwip; $z++){
                                            foreach ($zdatawip as $f) {
                                                $mesinwip[$z] = $f['master_id'];           
                                                $biayapermesinwip[$z] = floor((($f['master_display'] / $totaldisplaypermesinwip[$x] ) * $biayamesinwip[$x] ));
                                                $waktupermesinwip[$z] = $f['master_totalkerjamenit'];
                                                $ycountwip[$z] = $f['master_jumlahteam'];
                             
                                                /* Update Upah mesin & line ditable line */
                                                $updatemasterwip[] = array(
                                                    'master_id'=>$mesinwip[$z],
                                                    'master_bayarstfg' => $biayapermesinwip[$z]
                                                );
                                                /* Menghitung Upah Karyawan */
                                   
                                                $ydatawip=$this->Trx_wip_model->wiptampil_trxmesin($this->input->post('wip_produk_id',TRUE),$this->input->post('wip_tgllaporan',TRUE),$this->input->post('wip_shift',TRUE),$mesinwip[$z], $usersupervisor);
                                                                    
                                                       	$u= 0;
                                                        foreach ($ydatawip as $e) {
                                                            $u++;
                                                            $yidmesinwip[$u] = $e['mesin_id'];
                                                            $yidmasterwip[$u] = $e['mesin_master_id'];
                                                            $yidkaryawanwip[$u] = $e['mesin_karyawan_id'];
                                                            $yupahwip[$u] = floor((($e['mesin_totalmenit'] / $waktupermesinwip[$z] ) * $biayapermesinwip[$z])) ;
                                                      		$yxdatawip[$u] = $this->Trx_wip_model->wiptampil_trxmesindetail($yidmasterwip[$u], $yidkaryawanwip[$u], $usersupervisor);
                                                            
                                                            $updatetrxwip[] = array(
                                                                'mesin_id'=>$yidmesinwip[$u],
                                                                'mesin_upah' => $yupahwip[$u]
                                                            );

                                                            $updatetrxwipdetail[] = array(
                                                                'masterdetail_id'=>$yxdatawip[$u],
                                                                'masterdetail_upah' => $yupahwip[$u]
                                                            ); 

                                                            }
                                                            $this->db->update_batch('trx_mesin',$updatetrxwip, 'mesin_id');
                                                            $this->db->update_batch('trx_masterdetail',$updatetrxwipdetail, 'masterdetail_id');
                                                       
                                                }
                                                $this->db->update_batch('trx_master',$updatemasterwip, 'master_id');
                                        }

                        }
                }


            }else{

            $wipcountmesin=$this->Trx_wip_model->wipcounttrxper('master_id',$this->input->post('wip_produk_id',TRUE),$this->input->post('wip_tgllaporan',TRUE),$this->input->post('wip_shift',TRUE),'1','3',$usersupervisor);
            $totaldisplaywip = $this->Trx_wip_model->sumtrxboxwip('master_display',$this->input->post('wip_produk_id',TRUE),$this->input->post('wip_tgllaporan',TRUE),$this->input->post('wip_shift',TRUE),$usersupervisor);
            $uppahwip = floor($hargawip  * $totalboxwipmanual);  
            $wipmanualdata=$this->Trx_wip_model->wiptampil_trxmasterper($this->input->post('wip_produk_id',TRUE),$this->input->post('wip_tgllaporan',TRUE),$this->input->post('wip_shift',TRUE),'1','3', $usersupervisor);

                for($k = 0; $k<$wipcountmesin; $k++){
                    foreach ($wipmanualdata as $g) {
                        $wipmesin[$k] = $g['master_id'];
                        $wipacount[$k] = $g['master_jumlahteam'];
                        $biayapermesinwip[$k] = floor(($g['master_display'] / $totaldisplaywip ) * $uppahwip );
                        $waktupermesinwip[$k] = $g['master_totalkerjamenit'];
                        
                        $updatemasterwip[] = array(
                            'master_id'=>$wipmesin[$k],
                            'master_bayarstfg' => $biayapermesinwip[$k]
                        );
                        
                        $this->db->query("UPDATE trx_master SET master_bayarstfg = $biayapermesinwip[$k] WHERE master_id = '$wipmesin[$k]'");
                        $wipbdata=$this->Trx_wip_model->wiptampil_trxmesin($this->input->post('wip_produk_id',TRUE),$this->input->post('wip_tgllaporan',TRUE),$this->input->post('wip_shift',TRUE),$wipmesin[$k], $usersupervisor);  
                        
                        	$z=0;        
                            foreach ($wipbdata as $j) {
                            	$z++;
                                $aidmesin[$z] = $j['mesin_id'];
                                $bidmaster[$z] = $j['mesin_master_id'];
                                $cidkaryawan[$z] = $j['mesin_karyawan_id'];
                                $didtotalmenit[$z] = $j['mesin_totalmenit'];

                                $didupah[$z] = floor(($didtotalmenit[$z] / $waktupermesinwip[$k]) * $biayapermesinwip[$k] );
                                $wipcdata[$z] = $this->Trx_wip_model->wiptampil_trxmasterdetailmesin('masterdetail_id',$bidmaster[$z], $cidkaryawan[$z], $usersupervisor);
                                    
                                    $updatetrxwip[] = array(
                                        'mesin_id'=>$aidmesin[$z],
                                        'mesin_upah' => $didupah[$z]
                                    );

                                    $updatetrxwipdetail[] = array(
                                        'masterdetail_id'=>$wipcdata[$z],
                                        'masterdetail_upah' => $didupah[$z]
                                    ); 
                            }
                            $this->db->update_batch('trx_mesin',$updatetrxwip, 'mesin_id');
                            $this->db->update_batch('trx_masterdetail',$updatetrxwipdetail, 'masterdetail_id');

                                            
                    }
                    $this->db->update_batch('trx_master',$updatemasterwip, 'master_id');

                }


            }



            $data = array(
		'wip_produk_id' => $this->input->post('wip_produk_id',TRUE),
		'wip_shift' => $this->input->post('wip_shift',TRUE),
		'wip_mbox1' => $this->input->post('wip_mbox1',TRUE),
		'wip_mbox2' => $this->input->post('wip_mbox2',TRUE),
		'wip_mbox3' => $this->input->post('wip_mbox3',TRUE),
		'wip_mbox4' => $this->input->post('wip_mbox4',TRUE),
		'wip_mbox5' => $this->input->post('wip_mbox5',TRUE),
		'wip_mbox6' => $this->input->post('wip_mbox6',TRUE),
		'wip_mbox7' => $this->input->post('wip_mbox7',TRUE),
		'wip_mbox8' => $this->input->post('wip_mbox8',TRUE),
		'wip_mbox9' => $this->input->post('wip_mbox9',TRUE),
		'wip_mbox10' => $this->input->post('wip_mbox10',TRUE),
		'wip_mbox11' => $this->input->post('wip_mbox11',TRUE),
		'wip_mbox12' => $this->input->post('wip_mbox12',TRUE),
		'wip_mbox13' => $this->input->post('wip_mbox13',TRUE),
		'wip_mbox14' => $this->input->post('wip_mbox14',TRUE),
		'wip_mbox15' => $this->input->post('wip_mbox15',TRUE),
		'wip_rijek' => $this->input->post('wip_rijek',TRUE),
		'wip_total' => $totalboxwipmanual,
		'wip_upah' => $this->input->post('wip_upah',TRUE),
		'wip_tgllaporan' => $this->input->post('wip_tgllaporan',TRUE)
	    );

            $this->Trx_wip_model->update($this->input->post('wip_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
              redirect(site_url('trx_wip'. '/index?q='. '&t='. urlencode($this->input->post('wip_tgllaporan',TRUE)) . '&s='. urlencode($this->input->post('wip_shift',TRUE))));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Trx_wip_model->get_by_id($id);

        if ($row) {
            $this->Trx_wip_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
  redirect(site_url('trx_wip'. '/index?q='.'&t='. urlencode(set_value('wip_tgllaporan', $row->wip_tgllaporan)) . '&s='. urlencode(set_value('wip_shift', $row->wip_shift))));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_wip'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('wip_produk_id', 'wip produk id', 'trim');
	$this->form_validation->set_rules('wip_shift', 'wip shift', 'trim');
	$this->form_validation->set_rules('wip_mbox1', 'wip mbox1', 'trim');
	$this->form_validation->set_rules('wip_mbox2', 'wip mbox2', 'trim');
	$this->form_validation->set_rules('wip_mbox3', 'wip mbox3', 'trim');
	$this->form_validation->set_rules('wip_mbox4', 'wip mbox4', 'trim');
	$this->form_validation->set_rules('wip_mbox5', 'wip mbox5', 'trim');
	$this->form_validation->set_rules('wip_mbox6', 'wip mbox6', 'trim');
	$this->form_validation->set_rules('wip_mbox7', 'wip mbox7', 'trim');
	$this->form_validation->set_rules('wip_mbox8', 'wip mbox8', 'trim');
	$this->form_validation->set_rules('wip_mbox9', 'wip mbox9', 'trim');
	$this->form_validation->set_rules('wip_mbox10', 'wip mbox10', 'trim');
	$this->form_validation->set_rules('wip_mbox11', 'wip mbox11', 'trim');
	$this->form_validation->set_rules('wip_mbox12', 'wip mbox12', 'trim');
	$this->form_validation->set_rules('wip_mbox13', 'wip mbox13', 'trim');
	$this->form_validation->set_rules('wip_mbox14', 'wip mbox14', 'trim');
	$this->form_validation->set_rules('wip_mbox15', 'wip mbox15', 'trim');
	$this->form_validation->set_rules('wip_rijek', 'wip rijek', 'trim');
	$this->form_validation->set_rules('wip_total', 'wip total', 'trim');
	$this->form_validation->set_rules('wip_upah', 'wip upah', 'trim|numeric');
	$this->form_validation->set_rules('wip_tgllaporan', 'wip tgllaporan', 'trim');
	$this->form_validation->set_rules('wip_userinput', 'wip userinput', 'trim');
	$this->form_validation->set_rules('wip_tglinput', 'wip tglinput', 'trim');

	$this->form_validation->set_rules('wip_id', 'wip_id', 'trim');
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
            $x['data_wip']=$this->Trx_wip_model->download_wip('',$date_input,'');
        }else{
            $x['data_wip']=$this->Trx_wip_model->download_wip($username,$date_input, $xid_group);
        }
        
        $this->load->view('trx_wip/excel_trx_wip',$x);
    }


}

/* End of file Trx_wip.php */
/* Location: ./application/controllers/Trx_wip.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-04 14:45:35 */
/* http://harviacode.com */
