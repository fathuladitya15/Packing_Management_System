<?php

ini_set('max_execution_time', 0);
ini_set('memory_limit', '2048M');
// above script to download excel without limit

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trx_archive extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //$this->load->model('Trx_archive_model');
        $this->load->model('Trx_archive_model');
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
        $priv=$this->m_general->get_privilage($id_group,'trx_archive');      
        $x['add']='N';
        $x['update']='N';
        $x['delete']='N';
        $x['comment1']='N';
        $x['report']='N';
        foreach ($priv as $a) {
            $id_group=$id_group;
            $nav_url='trx_archive';
            $add=$a['add1'];
            $update=$a['update1'];
            $delete=$a['delete1'];
            $plus=$a['comment1'];
            $report=$a['report1'];
        }

        

        $data = array(
            'module' => $this->m_general->tampil_data_perfield1('stx_module','module_status','Aktif'),
            'add' => $add,
            'xmodule_id' => set_value('module_id'),
            'update' => $update,
            'delete' => $delete,
            'report' => $report,
            'plus' => $plus,
            'priv_count' =>$this->m_general->cek_privilage($id_group,'trx_archive'),
        );


        $x['content']=$this->load->view('trx_archive/trx_archive_list', $data,TRUE);
        $this->load->view('template',$x);
        
    }

    public function reporting()
    {
        $date_input=$this->input->post('tgl_daftar');
        $module_input=$this->input->post('jarchive_id');
        $bln=array('01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'Mei','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December');

        $tgl=explode('-', $date_input);
        $x['tgl_awal']=$tgl[2] ." " .$bln[$tgl[1]] ." " .$tgl[0];
        $x['tgl_akhir']=$tgl[5] ." " .$bln[$tgl[4]] ." " .$tgl[3];
        $username=$this->session->userdata('username');
        $xid_group=$this->session->userdata('user_akses_level');
        
        if ($module_input =='1'){
            if($this->session->userdata('admin')=='Y'){
                $x['data_mesin']=$this->Trx_archive_model->download_arc_mesin('',$date_input,'');
            }else{
                $x['data_mesin']=$this->Trx_archive_model->download_arc_mesin($username,$date_input, $xid_group);
            }   
            $this->load->view('trx_archive/excel_arc_mesin',$x);
        }elseif($module_input ==2){
            if($this->session->userdata('admin')=='Y'){
                $x['data_line']=$this->Trx_archive_model->download_arc_line('',$date_input,'');
            }else{
                $x['data_line']=$this->Trx_archive_model->download_arc_line($username,$date_input, $xid_group);
            }   
            $this->load->view('trx_archive/excel_arc_line',$x);
        }elseif($module_input ==3){
            if($this->session->userdata('admin')=='Y'){
                $x['data_manual']=$this->Trx_archive_model->download_arc_manual('',$date_input,'');
            }else{
                $x['data_manual']=$this->Trx_archive_model->download_arc_manual($username,$date_input, $xid_group);
            }   
            $this->load->view('trx_archive/excel_arc_manual',$x);
        }elseif($module_input ==4){
            if($this->session->userdata('admin')=='Y'){
                $x['data_stiker']=$this->Trx_archive_model->download_arc_stiker('',$date_input,'');
            }else{
                $x['data_stiker']=$this->Trx_archive_model->download_arc_stiker($username,$date_input, $xid_group);
            }   
            $this->load->view('trx_archive/excel_arc_stiker',$x);
        }elseif($module_input ==5){
            if($this->session->userdata('admin')=='Y'){
                $x['data_susun']=$this->Trx_archive_model->download_arc_susun('',$date_input,'');
            }else{
                $x['data_susun']=$this->Trx_archive_model->download_arc_susun($username,$date_input, $xid_group);
            }
            $this->load->view('trx_archive/excel_arc_susun',$x);
        }elseif($module_input ==6){
            if($this->session->userdata('admin')=='Y'){
                $x['data_perbantuan']=$this->Trx_archive_model->download_arc_perbantuan('',$date_input,'');
            }else{
                $x['data_perbantuan']=$this->Trx_archive_model->download_arc_perbantuan($username,$date_input, $xid_group);
            }   
            $this->load->view('trx_archive/excel_arc_perbantuan',$x);        
        }elseif($module_input ==7){
            if($this->session->userdata('admin')=='Y'){
                $x['data_perangkat']=$this->Trx_archive_model->download_arc_perangkat('',$date_input,'');
            }else{
                $x['data_perangkat']=$this->Trx_archive_model->download_arc_perangkat($username,$date_input, $xid_group);
            }   
            $this->load->view('trx_archive/excel_arc_perangkat',$x);
        }elseif($module_input ==8){
            if($this->session->userdata('admin')=='Y'){
                $x['data_stfg']=$this->Trx_archive_model->download_arc_stfg('',$date_input,'');
            }else{
                $x['data_stfg']=$this->Trx_archive_model->download_arc_stfg($username,$date_input, $xid_group);
            }   
            $this->load->view('trx_archive/excel_arc_stfg',$x);
        }elseif($module_input ==9){
            if($this->session->userdata('admin')=='Y'){
                $x['data_wip']=$this->Trx_archive_model->download_arc_wip('',$date_input,'');
            }else{
                $x['data_wip']=$this->Trx_archive_model->download_arc_wip($username,$date_input, $xid_group);
            }   
            $this->load->view('trx_archive/excel_arc_wip',$x);
        }elseif($module_input ==10){
            if($this->session->userdata('admin')=='Y'){
                $x['data_pp']=$this->Trx_archive_model->download_arc_pp('',$date_input,'');
            }else{
                $x['data_pp']=$this->Trx_archive_model->download_arc_pp($username,$date_input, $xid_group);
            }   
            $this->load->view('trx_archive/excel_arc_pp',$x);            
        }elseif($module_input ==11){         
            if($this->session->userdata('admin')=='Y'){
                $x['data_clining']=$this->Trx_archive_model->download_arc_clining('',$date_input,'');
            }else{
                $x['data_clining']=$this->Trx_archive_model->download_arc_clining($username,$date_input, $xid_group);
            }   
            $this->load->view('trx_archive/excel_arc_clining',$x);
        }else{
            redirect(site_url('trx_archive'));
        }
 
        
        
    }

    
}
