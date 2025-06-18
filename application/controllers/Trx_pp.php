<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trx_pp extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Trx_pp_model');
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
        $priv=$this->m_general->get_privilage($id_group,'trx_pp');      
        $x['add']='N';
        $x['update']='N';
        $x['delete']='N';
        $x['comment1']='N';
        $x['report']='N';
        foreach ($priv as $a) {
            $id_group=$id_group;
            $nav_url='trx_pp';
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
            $config['base_url'] = base_url() . 'trx_pp/index.html?q=' . urlencode($q) . '&t='. urlencode($t). '&s='. urlencode($s);
            $config['first_url'] = base_url() . 'trx_pp/index.html?q=' . urlencode($q) . '&t='. urlencode($t) . '&s='. urlencode($s);
            $config['per_page'] = 0;

        } elseif (($s <> '') and ($t <> '') and ($q == '')){
            $config['base_url'] = base_url() . 'trx_pp/index.html?t='. urlencode($t). '&s='. urlencode($s);;
            $config['first_url'] = base_url() . 'trx_pp/index.html?t='. urlencode($t). '&s='. urlencode($s);;
            $config['per_page'] = 0;

        }else {
            $config['base_url'] = base_url() . 'trx_pp/index.html';
            $config['first_url'] = base_url() . 'trx_pp';
            $config['per_page'] = 25;
        }

        $config['page_query_string'] = TRUE;
        $trx_pp = $this->Trx_pp_model->tampil_data($config['per_page'], $start, $q, $username,$id_group,$s, $t);
        $config['total_rows'] = $this->Trx_pp_model->total_rows($q, $username, $id_group, $s, $t);

        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $data = array(
            'trx_pp_data' => $trx_pp,
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
            'priv_count' =>$this->m_general->cek_privilage($id_group,'trx_pp'),
        );
        $x['content']=$this->load->view('trx_pp/trx_pp_list', $data,TRUE);
        $this->load->view('template',$x);
    }

    public function read($id) 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $row = $this->Trx_pp_model->get_by_id($id);
        if ($row) {
            $data = array(
		'pp_id' => $row->pp_id,
		'pp_produk_id' => $row->pp_produk_id,
        'produk_nama' => $row->produk_nama,
        'pp_shift' => $row->pp_shift,
		'pp_mbox1' => $row->pp_mbox1,
		'pp_mbox2' => $row->pp_mbox2,
		'pp_total' => $row->pp_total,
		'pp_upah' => $row->pp_upah,
		'pp_tgllaporan' => $row->pp_tgllaporan,
		'pp_userinput' => $row->pp_userinput,
		'pp_tglinput' => $row->pp_tglinput,
	    );
            $x['content']=$this->load->view('trx_pp/trx_pp_read', $data,true);
            $this->load->view('template',$x);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_pp'));
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
            'action' => site_url('trx_pp/create_action'),
    	    'pp_id' => set_value('pp_id'),
    	    'pp_produk_id' => set_value('pp_produk_id'),
            'pp_shift' => set_value('pp_shift'),
    	    'pp_mbox1' => set_value('pp_mbox1'),
    	    'pp_mbox2' => set_value('pp_mbox2'),
    	    'pp_total' => set_value('pp_total'),
    	    'pp_upah' => set_value('pp_upah'),
    	    'pp_tgllaporan' => set_value('pp_tgllaporan'),
    	    'pp_userinput' => set_value('pp_userinput'),
    	    'pp_tglinput' => set_value('pp_tglinput'),
	);
        $x['content']=$this->load->view('trx_pp/trx_pp_form', $data,TRUE);
        $this->load->view('template',$x);
    }
    
    public function create_action() 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $supervisor=$this->session->userdata('user_supervisor');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

         $count = count($_POST['count']); 
         $username=$this->session->userdata('username'); 

        for($i = 0; $i<$count; $i++){
            $totalbox =   ( $_POST['jpp_mbox1'][$i] + $_POST['jpp_mbox2'][$i] );
            $hargapp = $this->Trx_pp_model->pphargaproduk('stx_produk','produk_pp','produk_id', $_POST['jpp_produk_id'][$i],$supervisor);
            $upahpp = floor(($hargapp * $totalbox)); /* Total Upah PP */
                
            /* Menghitung Upah Permesin */
            $ppcount=$this->Trx_pp_model->ppcounttrxpermesin('master_id',$_POST['jpp_produk_id'][$i],$_POST['jpp_tgllaporan'],$_POST['jpp_shift'],'1','2', $supervisor);
            if(!empty($ppcount)){
                $ppdata=$this->Trx_pp_model->pptampil_trxmastermesin($_POST['jpp_produk_id'][$i], $_POST['jpp_tgllaporan'], $_POST['jpp_shift'], $supervisor);
                $totaldisplaymanual = $this->Trx_pp_model->sumtrxboxmanual('master_display',$_POST['jpp_produk_id'][$i],$_POST['jpp_tgllaporan'],$_POST['jpp_shift'],$supervisor);
                    for($k = 0; $k<$ppcount; $k++){
                        foreach ($ppdata as $g) {
                            $mesin[$k] = $g['master_id'];
                            $xxcount[$k] = $g['master_jumlahteam'];
                            $biayapermesinmanual[$k] = floor(($g['master_display'] / $totaldisplaymanual ) * $upahpp );
                            $waktupermesinmanual[$k] = $g['master_totalkerjamenit'];

                            $this->db->query("UPDATE trx_master SET master_bayarstfg = $biayapermesinmanual[$k] WHERE master_id = '$mesin[$k]'");
                                    
                            $zzdata=$this->Trx_pp_model->pptampil_trxmesin($_POST['jpp_produk_id'][$i], $_POST['jpp_tgllaporan'], $_POST['jpp_shift'],$mesin[$k], $supervisor);  
       
                            $v =0;  
                                foreach ($zzdata as $j) {
                                    $yidmesin[$v] = $j['mesin_id'];
                                    $yidmaster[$v] = $j['mesin_master_id'];
                                    $yidkaryawan[$v] = $j['mesin_karyawan_id'];
                                    $yidtotalmenit[$v] = $j['mesin_totalmenit'];

                                    $yzupah[$v] = floor(($yidtotalmenit[$v] / $waktupermesinmanual[$k]) *  $biayapermesinmanual[$k] );
                                    $ssdata[$v] = $this->Trx_pp_model->pptampil_trxmasterdetailmesin('masterdetail_id',$yidmaster[$v], $yidkaryawan[$v], $supervisor);
                                            
                                            $updatepp[] = array(
                                                'mesin_id'=>$yidmesin[$v],
                                                'mesin_upah' => $yzupah[$v]
                                            );

                                            $updateppdetail[] = array(
                                                'masterdetail_id'=>$ssdata[$v],
                                                'masterdetail_upah' => $yzupah[$v]
                                            ); 
                                    }
                                             $this->db->update_batch('trx_mesin',$updatepp, 'mesin_id');
                                             $this->db->update_batch('trx_masterdetail',$updateppdetail, 'masterdetail_id');                                    
                                            
                            }
                    }
            }

                    $entries[] = array(
                        'pp_shift' => $_POST['jpp_shift'],
                        'pp_produk_id' => $_POST['jpp_produk_id'][$i],                
                        'pp_mbox1' => $_POST['jpp_mbox1'][$i],
                        'pp_mbox2' => $_POST['jpp_mbox2'][$i],
                        'pp_total' => $totalbox,
                        'pp_upah' => $upahpp,
                        'pp_tgllaporan' => $_POST['jpp_tgllaporan'],
                        'pp_usersupervisor' => $supervisor,
                        'pp_userinput' => $username,
                        'pp_tglinput' => date('Y-m-d'),
                    
                    );

        }
            
        $result = $this->db->insert_batch('trx_pp', $entries); 
            redirect(site_url('trx_pp/create'));           
            $this->session->set_flashdata('message', 'Create Record Success');
        }
    }
    
    public function update($id) 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $usersupervisor=$this->session->userdata('user_supervisor');
        $row = $this->Trx_pp_model->get_by_id($id);

        if ($row) {
            $data = array(
                'produk' => $this->m_general->tampil_produkid('stx_produk','produk_status','Aktif', 'produk_usersupervisor',$usersupervisor),
                'shift' => $this->m_general->tampil_data_perfield1('stx_shift','shift_status','Aktif'),
                'button' => 'Update',
                'action' => site_url('trx_pp/update_action'),
            		'pp_id' => set_value('pp_id', $row->pp_id),
            		'pp_produk_id' => set_value('pp_produk_id', $row->pp_produk_id),
                    'pp_shift' => set_value('pp_shift', $row->pp_shift),
            		'pp_mbox1' => set_value('pp_mbox1', $row->pp_mbox1),
            		'pp_mbox2' => set_value('pp_mbox2', $row->pp_mbox2),
            		'pp_total' => set_value('pp_total', $row->pp_total),
            		'pp_upah' => set_value('pp_upah', $row->pp_upah),
            		'pp_tgllaporan' => set_value('pp_tgllaporan', $row->pp_tgllaporan),
            		'pp_userinput' => set_value('pp_userinput', $row->pp_userinput),
            		'pp_tglinput' => set_value('pp_tglinput', $row->pp_tglinput),
	    );
            $x['content']=$this->load->view('trx_pp/trx_pp_form_update', $data,true);
             $this->load->view('template',$x); 
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_pp'));
        }
    }
    
    public function update_action() 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $supervisor=$this->session->userdata('user_supervisor');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('pp_id', TRUE));
        } else {
            $totalbox = ( $this->input->post('pp_mbox1',TRUE) +  $this->input->post('pp_mbox2',TRUE));
            $hargapp = $this->Trx_pp_model->pphargaproduk('stx_produk','produk_pp','produk_id', $this->input->post('pp_produk_id',TRUE),$supervisor);
            $upahpp = floor(($hargapp * $totalbox)); /* Total Upah PP */
                
            /* Menghitung Upah Permesin */
            $ppcount=$this->Trx_pp_model->ppcounttrxpermesin('master_id',$this->input->post('pp_produk_id',TRUE),$this->input->post('pp_tgllaporan',TRUE),$this->input->post('pp_shift',TRUE),'1','2', $supervisor);
            if(!empty($ppcount)){
                $ppdata=$this->Trx_pp_model->pptampil_trxmastermesin($this->input->post('pp_produk_id',TRUE), $this->input->post('pp_tgllaporan',TRUE), $this->input->post('pp_shift',TRUE), $supervisor);
                $totaldisplaymanual = $this->Trx_pp_model->sumtrxboxmanual('master_display',$this->input->post('pp_produk_id',TRUE),$this->input->post('pp_tgllaporan',TRUE),$this->input->post('pp_shift',TRUE),$supervisor);
                    for($k = 0; $k<$ppcount; $k++){
                        foreach ($ppdata as $g) {
                            $mesin[$k] = $g['master_id'];
                            $xxcount[$k] = $g['master_jumlahteam'];
                            $biayapermesinmanual[$k] = floor(($g['master_display'] / $totaldisplaymanual ) * $upahpp );
                            $waktupermesinmanual[$k] = $g['master_totalkerjamenit'];

                            $this->db->query("UPDATE trx_master SET master_bayarstfg = $biayapermesinmanual[$k] WHERE master_id = '$mesin[$k]'");
                                    
                            $zzdata=$this->Trx_pp_model->pptampil_trxmesin($this->input->post('pp_produk_id',TRUE), $this->input->post('pp_tgllaporan',TRUE), $this->input->post('pp_shift',TRUE),$mesin[$k], $supervisor);  
                            $z = 0;    
                                foreach ($zzdata as $j) {
                                    $z++;
                                    $yidmesin[$z] = $j['mesin_id'];
                                    $yidmaster[$z] = $j['mesin_master_id'];
                                    $yidkaryawan[$z] = $j['mesin_karyawan_id'];
                                    $yidtotalmenit[$z] = $j['mesin_totalmenit'];

                                    $yzupah[$z] = floor(($yidtotalmenit[$z] / $waktupermesinmanual[$k]) *  $biayapermesinmanual[$k] );                                   
                                    
                                    $ssdata[$z] = $this->Trx_pp_model->pptampil_trxmasterdetailmesin('masterdetail_id',$yidmaster[$z], $yidkaryawan[$z], $supervisor);
                                            
                                            $updatepp[] = array(
                                                'mesin_id'=>$yidmesin[$z],
                                                'mesin_upah' => $yzupah[$z]
                                            );

                                            $updateppdetail[] = array(
                                                'masterdetail_id'=>$ssdata[$z],
                                                'masterdetail_upah' => $yzupah[$z]
                                            ); 
                                    }
                                             $this->db->update_batch('trx_mesin',$updatepp, 'mesin_id');
                                             $this->db->update_batch('trx_masterdetail',$updateppdetail, 'masterdetail_id');
                              
                                            
                            }
                    }
            }

            $data = array(
        		'pp_id' => $this->input->post('pp_id',TRUE),
        		'pp_produk_id' => $this->input->post('pp_produk_id',TRUE),
                'pp_shift' => $this->input->post('pp_shift',TRUE),
        		'pp_mbox1' => $this->input->post('pp_mbox1',TRUE),
        		'pp_mbox2' => $this->input->post('pp_mbox2',TRUE),
        		'pp_total' => $totalbox,
        		'pp_upah' => $this->input->post('pp_upah',TRUE),
        		'pp_tgllaporan' => $this->input->post('pp_tgllaporan',TRUE),
	    );

            $this->Trx_pp_model->update($this->input->post('pp_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
              redirect(site_url('trx_pp'. '/index?q='. '&t='. urlencode($this->input->post('pp_tgllaporan',TRUE)) . '&s='. urlencode($this->input->post('pp_shift',TRUE))));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Trx_pp_model->get_by_id($id);

        if ($row) {
            $this->Trx_pp_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
  redirect(site_url('trx_pp'. '/index?q='.'&t='. urlencode(set_value('pp_tgllaporan', $row->pp_tgllaporan)) . '&s='. urlencode(set_value('pp_shift', $row->pp_shift))));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_pp'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('pp_id', 'pp id', 'trim');
	$this->form_validation->set_rules('pp_produk_id', 'pp produk id', 'trim');
	$this->form_validation->set_rules('pp_mbox1', 'pp mbox1', 'trim');
	$this->form_validation->set_rules('pp_mbox2', 'pp mbox2', 'trim');
	$this->form_validation->set_rules('pp_total', 'pp total', 'trim');
	$this->form_validation->set_rules('pp_upah', 'pp upah', 'trim|numeric');
	$this->form_validation->set_rules('pp_tgllaporan', 'pp tgllaporan', 'trim');
	$this->form_validation->set_rules('pp_userinput', 'pp userinput', 'trim');
	$this->form_validation->set_rules('pp_tglinput', 'pp tglinput', 'trim');

	$this->form_validation->set_rules('pp_id', 'pp_id', 'trim');
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
            $x['data_pp']=$this->Trx_pp_model->download_pp('',$date_input,'');
        }else{
            $x['data_pp']=$this->Trx_pp_model->download_pp($username,$date_input, $xid_group);
        }
        
        $this->load->view('trx_pp/excel_trx_pp',$x);
    }

}

/* End of file Trx_pp.php */
/* Location: ./application/controllers/Trx_pp.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-04 14:45:35 */
/* http://harviacode.com */
