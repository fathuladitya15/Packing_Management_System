<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trx_perangkat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Trx_perangkat_model');
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
        $priv=$this->m_general->get_privilage($id_group,'trx_perangkat');      
        $x['add']='N';
        $x['update']='N';
        $x['delete']='N';
        $x['comment1']='N';
        $x['report']='N';
        foreach ($priv as $a) {
            $id_group=$id_group;
            $nav_url='trx_perangkat';
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
            $config['base_url'] = base_url() . 'trx_perangkat/index.html?q=' . urlencode($q) . '&t='. urlencode($t). '&s='. urlencode($s);
            $config['first_url'] = base_url() . 'trx_perangkat/index.html?q=' . urlencode($q) . '&t='. urlencode($t) . '&s='. urlencode($s);
            $config['per_page'] = 0;

        } elseif (($s <> '') and ($t <> '') and ($q == '')){
            $config['base_url'] = base_url() . 'trx_perangkat/index.html?t='. urlencode($t). '&s='. urlencode($s);;
            $config['first_url'] = base_url() . 'trx_perangkat/index.html?t='. urlencode($t). '&s='. urlencode($s);;
            $config['per_page'] = 0;

        }else {
            $config['base_url'] = base_url() . 'trx_perangkat/index.html';
            $config['first_url'] = base_url() . 'trx_perangkat';
            $config['per_page'] = 25;
        }


        $config['page_query_string'] = TRUE;
        $trx_perangkat = $this->Trx_perangkat_model->tampil_data($config['per_page'], $start, $q, $username,$id_group ,$s, $t);
        $config['total_rows'] = $this->Trx_perangkat_model->total_rows($q, $username, $id_group,$s, $t);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'trx_perangkat_data' => $trx_perangkat,
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
            'priv_count' =>$this->m_general->cek_privilage($id_group,'trx_perangkat'),
        );

        $x['content']=$this->load->view('trx_perangkat/trx_perangkat_list', $data,TRUE);
        $this->load->view('template',$x);
    }

    public function read($id) 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');

        $row = $this->Trx_perangkat_model->get_by_id($id);
        if ($row) {
            $data = array(
        		'perangkat_id' => $row->perangkat_id,
        		'perangkat_karyawan_id' => $row->perangkat_karyawan_id,
                'perangkat_master_id' => $row->perangkat_master_id,
                'karyawan_nama' => $row->karyawan_nama,
        		'perangkat_shift' => $row->perangkat_shift,
        		'perangkat_master_id' => $row->perangkat_master_id,
        		'perangkat_upah' => $row->perangkat_upah,
        		'perangkat_tgllaporan' => $row->perangkat_tgllaporan,
        		'perangkat_userinput' => $row->perangkat_userinput,
        		'perangkat_tglinput' => $row->perangkat_tglinput,
	    );
            $x['content']=$this->load->view('trx_perangkat/trx_perangkat_read', $data,true);
            $this->load->view('template',$x);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_perangkat'));
        }
    }

    public function create() 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $data = array(
            'shift' => $this->m_general->tampil_data_perfield1('stx_shift','shift_status','Aktif'),
            'button' => 'Create',
            'action' => site_url('trx_perangkat/create_action'),
	    'perangkat_id' => set_value('perangkat_id'),
	    'perangkat_karyawan_id' => set_value('perangkat_karyawan_id'),
	    'perangkat_shift' => set_value('perangkat_shift'),
	    'perangkat_master_id' => set_value('perangkat_master_id'),
	    'perangkat_upah' => set_value('perangkat_upah'),
	    'perangkat_tgllaporan' => set_value('perangkat_tgllaporan'),
	    'perangkat_userinput' => set_value('perangkat_userinput'),
	    'perangkat_tglinput' => set_value('perangkat_tglinput'),
	);
        
        $x['content']=$this->load->view('trx_perangkat/trx_perangkat_form', $data,TRUE);
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

            $trans = $this->Trx_perangkat_model->gettrxperangat($usersupervisor,$this->input->post('jperangkat_shift',TRUE) ,$this->input->post('jperangkat_tgllaporan',TRUE));

            if ($trans) {

            $count = count($_POST['count']); 
            $codeid = $this->m_general->getcode('trx_master','master_id','PRG-');
            
            $sumperangkatpay = $this->Trx_perangkat_model->sumperangkat('master_bayarstfg',$usersupervisor,$this->input->post('jperangkat_shift',TRUE) ,$this->input->post('jperangkat_tgllaporan',TRUE));
            
            $sumperangkatteam = $this->Trx_perangkat_model->countperangkattrx('karyawan_id',$usersupervisor,$this->input->post('jperangkat_shift',TRUE) ,$this->input->post('jperangkat_tgllaporan',TRUE));

            $xupah = floor(($sumperangkatpay / $sumperangkatteam ));
            
            $result = $this->Trx_perangkat_model->batchInsert($_POST,$codeid, $xupah ,$username,$usersupervisor ); // Insert to trx_perangkat table             
            
            $perangkatcode = $this->Trx_perangkat_model->gettrxmaster($codeid,$this->input->post('jperangkat_tgllaporan', TRUE),$this->input->post('jperangkat_shift', TRUE));
        
        if ($perangkatcode){
                $data = array(
                    'master_id' => $codeid,
                    'master_module_id' => '7',
                    'master_shift' => $this->input->post('jperangkat_shift',TRUE),
                    'master_tgllaporan' => $this->input->post('jperangkat_tgllaporan',TRUE),
                    'master_bayarstfg' => $xupah,
                    'master_jumlahteam' => $count,
                    'master_usersupervisor' => $usersupervisor,
                    'master_userinput' => $username,
                    'master_tglinput' => date('Y-m-d'),
                );     
                $this->Trx_perangkat_model->insertMaster($data); // insert to trx_master  
            }
        
                         

            if($result){
                echo 1;
            }
            else{
                echo 0;
            }
            exit;
            redirect(site_url('trx_perangkat/create'));
            
            $this->session->set_flashdata('message', 'Create Record Success');
        }

        }
    }
    

    public function plus() 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $usersupervisor=$this->session->userdata('user_supervisor');
        $data = array(
            'shift' => $this->m_general->tampil_data_perfield1('stx_shift','shift_status','Aktif'),
            'button' => 'Create',
            'action' => site_url('trx_perangkat/create_plus'),
                'perangkat_id' => set_value('perangkat_id'),
                'perangkat_master_id' => set_value('perangkat_master_id'),
                'perangkat_karyawan_id' => set_value('perangkat_karyawan_id'),
                'perangkat_shift' => set_value('perangkat_shift'),
                'perangkat_upah' => set_value('perangkat_upah'),
                'perangkat_tgllaporan' => set_value('perangkat_tgllaporan'),
                'perangkat_usersupervisor' => set_value('perangkat_usersupervisor'),
                'perangkat_userinput' => set_value('perangkat_userinput'),
                'perangkat_tglinput' => set_value('perangkat_tglinput'),
    );
        $x['content']=$this->load->view('trx_perangkat/trx_perangkat_form_plus', $data,TRUE);
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

        $perangkatcode = $this->Trx_perangkat_model->gettrxmaster($this->input->post('perangkat_master_id',TRUE),$this->input->post('perangkat_tgllaporan', TRUE),$this->input->post('perangkat_shift', TRUE));
            
        $sumperangkatpay = $this->Trx_perangkat_model->sumperangkat('master_bayarstfg',$usersupervisor,$this->input->post('perangkat_shift',TRUE) ,$this->input->post('perangkat_tgllaporan',TRUE));
            
        $sumperangkatteam = $this->Trx_perangkat_model->countperangkattrx('karyawan_id',$usersupervisor,$this->input->post('perangkat_shift',TRUE) ,$this->input->post('perangkat_tgllaporan',TRUE));

        $xupah = floor(($sumperangkatpay / $sumperangkatteam ));

        if ($perangkatcode){        
        $data = array(
            'perangkat_master_id' => $this->input->post('perangkat_master_id',TRUE),
            'perangkat_karyawan_id' => $this->input->post('perangkat_karyawan_id',TRUE),
            'perangkat_shift' => $this->input->post('perangkat_shift',TRUE),            
            'perangkat_upah' => $xupah,
            'perangkat_tgllaporan' => $this->input->post('perangkat_tgllaporan',TRUE),
            'perangkat_userinput' => $username,
            'perangkat_usersupervisor' => $usersupervisor,
            'perangkat_tglinput' => date('Y-m-d'),
        );

        $this->Trx_perangkat_model->insert($data);
        
        $datax = array(
                'masterdetail_karyawan_id'=>$this->input->post('perangkat_karyawan_id',TRUE),               
                'masterdetail_master_id'=>$this->input->post('perangkat_master_id',TRUE),
                'masterdetail_upah'=>$xupah,
                'masterdetail_usersupervisor'=>$usersupervisor,
                'masterdetail_userinput'=>$username,
                'masterdetail_tglinput'=>date('Y-m-d'), 
                );

         $this->Trx_perangkat_model->insertdetail($datax);

        $totalteam = $this->Trx_perangkat_model->perangkatxcount('perangkat_karyawan_id', $this->input->post('perangkat_shift',TRUE),$this->input->post('perangkat_tgllaporan',TRUE),$this->input->post('perangkat_master_id',TRUE) );

                $zdata = array(
                    'master_jumlahteam' => $totalteam,
                    );
                    $this->Trx_perangkat_model->updateMaster($this->input->post('perangkat_master_id',TRUE), $zdata);

            $messege= array(
                            'messege'=> "Data Berhasil Disimpan"
                        );
                    $this->session->set_flashdata('success', $messege);
                    redirect(site_url('trx_perangkat/plus'));

            }else{
                $messege= array(
                    'messege'=> "Transaksi tidak ada , Silahkan input kembali"
                );
                $this->session->set_flashdata('message',$messege);
                redirect(site_url('trx_perangkat/plus'));

            }

        }
    }


    public function update($id) 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $usersupervisor=$this->session->userdata('user_supervisor');
        $row = $this->Trx_perangkat_model->get_by_id($id);

        if ($row) {
            $data = array(
                'shift' => $this->m_general->tampil_data_perfield1('stx_shift','shift_status','Aktif'),
                'button' => 'Update',
                'action' => site_url('trx_perangkat/update_action'),
        		'perangkat_id' => set_value('perangkat_id', $row->perangkat_id),
        		'perangkat_karyawan_id' => set_value('perangkat_karyawan_id', $row->perangkat_karyawan_id),
        		'perangkat_shift' => set_value('perangkat_shift', $row->perangkat_shift),
        		'perangkat_master_id' => set_value('perangkat_master_id', $row->perangkat_master_id),
        		'perangkat_upah' => set_value('perangkat_upah', $row->perangkat_upah),
        		'perangkat_tgllaporan' => set_value('perangkat_tgllaporan', $row->perangkat_tgllaporan),
        		'perangkat_userinput' => set_value('perangkat_userinput', $row->perangkat_userinput),
        		'perangkat_tglinput' => set_value('perangkat_tglinput', $row->perangkat_tglinput),
                'codeid'=>$this->m_general->trxgetcode('masterdetail_id',set_value('perangkat_karyawan_id', $row->perangkat_karyawan_id),set_value('perangkat_master_id', $row->perangkat_master_id)),
	    );
            $x['content']=$this->load->view('trx_perangkat/trx_perangkat_form_update', $data,true);
            $this->load->view('template',$x);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_perangkat'));
        }
    }
    
    public function update_action() 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $usersupervisor=$this->session->userdata('user_supervisor');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('perangkat_id', TRUE));
        } else {

        $sumperangkatpay = $this->Trx_perangkat_model->sumperangkat('master_bayarstfg',$usersupervisor,$this->input->post('perangkat_shift',TRUE) ,$this->input->post('perangkat_tgllaporan',TRUE));
            
        $sumperangkatteam = $this->Trx_perangkat_model->countperangkattrx('karyawan_id',$usersupervisor,$this->input->post('perangkat_shift',TRUE) ,$this->input->post('perangkat_tgllaporan',TRUE));

        $xupah = floor(($sumperangkatpay / $sumperangkatteam ));

        $xdata = array(
    		'perangkat_karyawan_id' => $this->input->post('perangkat_karyawan_id',TRUE),
    		'perangkat_upah' => $xupah,
	    );

        $this->Trx_perangkat_model->update($this->input->post('perangkat_id', TRUE), $xdata);

           
        $ydata = array(
            'masterdetail_karyawan_id' =>$this->input->post('perangkat_karyawan_id',TRUE),
            'masterdetail_upah' => $xupah,
        );
           $this->Trx_perangkat_model->updateDetail($this->input->post('codeid',TRUE), $ydata);

        $zdata = array(
            'master_shift' =>$this->input->post('perangkat_shift',TRUE),
        );
           $this->Trx_perangkat_model->updateMaster($this->input->post('perangkat_master_id', TRUE), $zdata);

        





        $messege= array(
                    'messege'=> "Update Berhasil Disimpan"
                );
            $this->session->set_flashdata('success', $messege);
              redirect(site_url('trx_perangkat'. '/index?q='. '&t='. urlencode($this->input->post('perangkat_tgllaporan',TRUE)) . '&s='. urlencode($this->input->post('perangkat_shift',TRUE))));
        }
    }


    public function delete($id) 
    {
        $usersupervisor=$this->session->userdata('user_supervisor');
        $row = $this->Trx_perangkat_model->get_by_id($id);

        if ($row) {
               $codeid = $this->m_general->trxgetcode('masterdetail_id',set_value('perangkat_karyawan_id', $row->perangkat_karyawan_id),set_value('perangkat_master_id', $row->perangkat_master_id ));

            $this->Trx_perangkat_model->delete($id);
            $this->Trx_perangkat_model->deleteDetail($codeid);

            $totalteam = $this->Trx_perangkat_model->perangkatcount('perangkat_karyawan_id',set_value('perangkat_shift', $row->perangkat_shift),set_value('perangkat_tgllaporan', $row->perangkat_tgllaporan),set_value('perangkat_master_id', $row->perangkat_master_id));


            if ($totalteam =='0'){
                $this->Trx_perangkat_model->deletemaster(set_value('perangkat_master_id', $row->perangkat_master_id));
                
            }else {
            $zdata = array( 
                    'master_jumlahteam' => $totalteam, 
                    );
            $this->Trx_perangkat_model->updateMaster(set_value('perangkat_master_id', $row->perangkat_master_id), $zdata);

            } 

            $this->session->set_flashdata('message', 'Delete Record Success');
 redirect(site_url('trx_perangkat'. '/index?q='.'&t='. urlencode(set_value('perangkat_tgllaporan', $row->perangkat_tgllaporan)) . '&s='. urlencode(set_value('perangkat_shift', $row->perangkat_shift))));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_perangkat'));
        }
    }

    public function _rules() 
    {
    	$this->form_validation->set_rules('perangkat_karyawan_id', 'perangkat karyawan id', 'trim');
    	$this->form_validation->set_rules('perangkat_shift', 'perangkat shift', 'trim');
    	$this->form_validation->set_rules('perangkat_master_id', 'perangkat master id', 'trim');
    	$this->form_validation->set_rules('perangkat_upah', 'perangkat upah', 'trim|numeric');
    	$this->form_validation->set_rules('perangkat_tgllaporan', 'perangkat tgllaporan', 'trim');
    	$this->form_validation->set_rules('perangkat_userinput', 'perangkat userinput', 'trim');
    	$this->form_validation->set_rules('perangkat_tglinput', 'perangkat tglinput', 'trim');
    	$this->form_validation->set_rules('perangkat_id', 'perangkat_id', 'trim');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "trx_perangkat.xls";
        $judul = "trx_perangkat";
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
    	xlsWriteLabel($tablehead, $kolomhead++, "Perangkat Karyawan Id");
    	xlsWriteLabel($tablehead, $kolomhead++, "Perangkat Shift");
    	xlsWriteLabel($tablehead, $kolomhead++, "Perangkat Master Id");
    	xlsWriteLabel($tablehead, $kolomhead++, "Perangkat Upah");
    	xlsWriteLabel($tablehead, $kolomhead++, "Perangkat Tgllaporan");
    	xlsWriteLabel($tablehead, $kolomhead++, "Perangkat Userinput");
    	xlsWriteLabel($tablehead, $kolomhead++, "Perangkat Tglinput");

	foreach ($this->Trx_perangkat_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->perangkat_karyawan_id);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->perangkat_shift);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->perangkat_master_id);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->perangkat_upah);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->perangkat_tgllaporan);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->perangkat_userinput);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->perangkat_tglinput);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
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
            $x['data_perangkat']=$this->Trx_perangkat_model->download_perangkat('',$date_input,'');
        }else{
            $x['data_perangkat']=$this->Trx_perangkat_model->download_perangkat($username,$date_input, $xid_group);
        }
        
        $this->load->view('trx_perangkat/excel_trx_perangkat',$x);
    }



}

/* End of file Trx_perangkat.php */
/* Location: ./application/controllers/Trx_perangkat.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-16 19:35:17 */
/* http://harviacode.com */
