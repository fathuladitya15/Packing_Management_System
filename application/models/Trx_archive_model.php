<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trx_archive_model extends CI_Model
{


    function __construct()
    {
        parent::__construct();
    }

    public function download_arc_mesin($xuser,$call_date,$xid_group){
        $val=explode('-', $call_date);
        $tgl_awal=$val[0] ."-" .$val[1] ."-" .$val[2];
        $tgl_akhir=$val[3] ."-" .$val[4] ."-" .$val[5]; 

        $this->db->select('mesin_id,mesin_master_id,mesin_karyawan_id,mesin_produk_id,mesin_acuan_id,mesin_line, mesin_shift, mesin_mesin, mesin_display, mesin_mulai, mesin_selesai, mesin_istirahat,  mesin_totalmenit, mesin_tgllaporan, mesin_upah, mesin_userinput,mesin_usersupervisor, mesin_tglinput,trx_karyawan.karyawan_nama as karyawan_nama, stx_produk.produk_nama as produk_nama');
        $this->db->from('trx_mesin_arc');
        $this->db->join('trx_karyawan','trx_karyawan.karyawan_id = trx_mesin_arc.mesin_karyawan_id','left');
        $this->db->join('stx_produk','stx_produk.produk_id=trx_mesin_arc.mesin_produk_id');
        
        if(!empty($xuser)) {
            if ($xid_group =='2') {
                $this->db->where('mesin_userinput',$xuser);
            }elseif($xid_group =='5') {
                $this->db->where('mesin_usersupervisor',$xuser);

            }
        }
        $this->db->where( 'mesin_tgllaporan BETWEEN "' .$tgl_awal. '" and "' .$tgl_akhir .'"');

        $this->db->order_by('mesin_tgllaporan');
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }

    public function download_arc_line($xuser,$call_date,$xid_group){
        $val=explode('-', $call_date);
        $tgl_awal=$val[0] ."-" .$val[1] ."-" .$val[2];
        $tgl_akhir=$val[3] ."-" .$val[4] ."-" .$val[5]; 

        $this->db->select('line_id,line_master_id,line_karyawan_id,line_produk_id,line_nomor, line_shift, line_box, line_mulai, line_selesai, line_istirahat,  line_totalmenit, line_tgllaporan, line_upah, line_userinput,line_usersupervisor, line_tglinput,trx_karyawan.karyawan_nama as karyawan_nama, stx_produk.produk_nama as produk_nama');
        $this->db->from('trx_line_arc');
        $this->db->join('trx_karyawan','trx_karyawan.karyawan_id = trx_line_arc.line_karyawan_id','left');
        $this->db->join('stx_produk','stx_produk.produk_id=trx_line_arc.line_produk_id');
        
        if(!empty($xuser)) {
            if ($xid_group =='2') {
                $this->db->where('line_userinput',$xuser);
            }elseif($xid_group =='5') {
                $this->db->where('line_usersupervisor',$xuser);

            }
        }
        $this->db->where( 'line_tgllaporan BETWEEN "' .$tgl_awal. '" and "' .$tgl_akhir .'"');

        $this->db->order_by('line_tgllaporan');
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }


    public function download_arc_manual($xuser,$call_date,$xid_group){
        $val=explode('-', $call_date);
        $tgl_awal=$val[0] ."-" .$val[1] ."-" .$val[2];
        $tgl_akhir=$val[3] ."-" .$val[4] ."-" .$val[5]; 

        $this->db->select('manual_id,manual_master_id,manual_karyawan_id,manual_produk_id,manual_acuan_id, manual_shift, manual_box, manual_mulai, manual_selesai, manual_istirahat,  manual_totalmenit, manual_tgllaporan, manual_upah, manual_userinput,manual_usersupervisor, manual_tglinput,trx_karyawan.karyawan_nama as karyawan_nama, stx_produk.produk_nama as produk_nama');
        $this->db->from('trx_manual_arc');
        $this->db->join('trx_karyawan','trx_karyawan.karyawan_id = trx_manual_arc.manual_karyawan_id','left');
        $this->db->join('stx_produk','stx_produk.produk_id=trx_manual_arc.manual_produk_id');
        
        if(!empty($xuser)) {
            if ($xid_group =='2') {
                $this->db->where('manual_userinput',$xuser);
            }elseif($xid_group =='5') {
                $this->db->where('manual_usersupervisor',$xuser);

            }
        }
        $this->db->where( 'manual_tgllaporan BETWEEN "' .$tgl_awal. '" and "' .$tgl_akhir .'"');

        $this->db->order_by('manual_tgllaporan');
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }


    public function download_arc_stiker($xuser,$call_date,$xid_group){
        $val=explode('-', $call_date);
        $tgl_awal=$val[0] ."-" .$val[1] ."-" .$val[2];
        $tgl_akhir=$val[3] ."-" .$val[4] ."-" .$val[5]; 

        $this->db->select('stiker_id,
            stiker_master_id,
            stiker_karyawan_id,
            stiker_produk_id,
            stiker_kategori,
            stiker_shift,
            stiker_jumlahstiker,
            stiker_jumlahteam,
            stiker_upah,
            stiker_tgllaporan,
            stiker_usersupervisor,
            stiker_userinput,
            trx_karyawan.karyawan_nama as karyawan_nama, 
            stx_produk.produk_nama as produk_nama');
        $this->db->from('trx_stiker_arc');
        $this->db->join('trx_karyawan','trx_karyawan.karyawan_id = trx_stiker_arc.stiker_karyawan_id','left');
        $this->db->join('stx_produk','stx_produk.produk_id=trx_stiker_arc.stiker_produk_id');
        
        if(!empty($xuser)) {
            if ($xid_group =='2') {
                $this->db->where('stiker_userinput',$xuser);
            }elseif($xid_group =='5') {
                $this->db->where('stiker_usersupervisor',$xuser);

            }
        }
        $this->db->where( 'stiker_tgllaporan BETWEEN "' .$tgl_awal. '" and "' .$tgl_akhir .'"');

        $this->db->order_by('stiker_tgllaporan');
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }

    public function download_arc_susun($xuser,$call_date,$xid_group){
        $val=explode('-', $call_date);
        $tgl_awal=$val[0] ."-" .$val[1] ."-" .$val[2];
        $tgl_akhir=$val[3] ."-" .$val[4] ."-" .$val[5]; 

        $this->db->select('`susun_id,susun_karyawan_id,susun_produk_id,susun_karu, susun_master_id,susun_krat1,susun_shift,susun_krat2,susun_krat3,    susun_krat4, susun_krat5,susun_krat6,susun_krat7,susun_krat8,susun_krat9,susun_krat10,susun_krat11,susun_krat12, susun_krat13,    susun_krat14,susun_krat15,susun_totalkrat,susun_upah,susun_tgllaporan,susun_usersupervisor,susun_userinput, susun_tglinput,trx_karyawan.karyawan_nama as karyawan_nama, stx_produk.produk_nama as produk_nama');
        $this->db->from('trx_susun_arc');
        $this->db->join('trx_karyawan','trx_karyawan.karyawan_id = trx_susun_arc.susun_karyawan_id','left');
        $this->db->join('stx_produk','stx_produk.produk_id=trx_susun_arc.susun_produk_id');
        
        if(!empty($xuser)) {
            if ($xid_group =='2') {
                $this->db->where('susun_userinput',$xuser);
            }elseif($xid_group =='5') {
                $this->db->where('susun_usersupervisor',$xuser);

            }
        }
        $this->db->where( 'susun_tgllaporan BETWEEN "' .$tgl_awal. '" and "' .$tgl_akhir .'"');

        $this->db->order_by('susun_tgllaporan');
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }


    public function download_arc_perbantuan($xuser,$call_date,$xid_group){
        $val=explode('-', $call_date);
        $tgl_awal=$val[0] ."-" .$val[1] ."-" .$val[2];
        $tgl_akhir=$val[3] ."-" .$val[4] ."-" .$val[5]; 

        $this->db->select('perbantuan_id,
            perbantuan_master_id,
            perbantuan_karyawan_id,
            perbantuan_kategori,
            perbantuan_shift,
            perbantuan_mulai,
            perbantuan_selesai,
            perbantuan_istirahat,
            perbantuan_totalmenit,
            perbantuan_upah,
            perbantuan_tgllaporan,
            perbantuan_usersupervisor,
            perbantuan_userinput,
            trx_karyawan.karyawan_nama as karyawan_nama');
        $this->db->from('trx_perbantuan_arc');
        $this->db->join('trx_karyawan','trx_karyawan.karyawan_id = trx_perbantuan_arc.perbantuan_karyawan_id','left');
        
        if(!empty($xuser)) {
            if ($xid_group =='2') {
                $this->db->where('perbantuan_userinput',$xuser);
            }elseif($xid_group =='5') {
                $this->db->where('perbantuan_usersupervisor',$xuser);

            }
        }
        $this->db->where( 'perbantuan_tgllaporan BETWEEN "' .$tgl_awal. '" and "' .$tgl_akhir .'"');

        $this->db->order_by('perbantuan_tgllaporan');
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }


    public function download_arc_perangkat($xuser,$call_date,$xid_group){
        $val=explode('-', $call_date);
        $tgl_awal=$val[0] ."-" .$val[1] ."-" .$val[2];
        $tgl_akhir=$val[3] ."-" .$val[4] ."-" .$val[5]; 

        $this->db->select('perangkat_id,
            perangkat_master_id,
            perangkat_karyawan_id,
            perangkat_shift,
            perangkat_upah,
            perangkat_tgllaporan,
            perangkat_usersupervisor,
            perangkat_userinput,
            trx_karyawan.karyawan_nama as karyawan_nama');
        $this->db->from('trx_perangkat_arc');
        $this->db->join('trx_karyawan','trx_karyawan.karyawan_id = trx_perangkat_arc.perangkat_karyawan_id','left');
        
        if(!empty($xuser)) {
            if ($xid_group =='2') {
                $this->db->where('perangkat_userinput',$xuser);
            }elseif($xid_group =='5') {
                $this->db->where('perangkat_usersupervisor',$xuser);

            }
        }
        $this->db->where( 'perangkat_tgllaporan BETWEEN "' .$tgl_awal. '" and "' .$tgl_akhir .'"');

        $this->db->order_by('perangkat_tgllaporan');
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }

    public function download_arc_stfg($xuser,$call_date,$xid_group){
        $val=explode('-', $call_date);
        $tgl_awal=$val[0] ."-" .$val[1] ."-" .$val[2];
        $tgl_akhir=$val[3] ."-" .$val[4] ."-" .$val[5]; 

        $this->db->select('stfg_id,
            stfg_produk_id,
            stfg_shift,
            stfg_mbox1,
            stfg_mbox2,
            stfg_mbox3,
            stfg_mbox4,
            stfg_mbox5,
            stfg_mbox6,
            stfg_mbox7,
            stfg_mbox8,
            stfg_mbox9,
            stfg_mbox10,
            stfg_mbox11,
            stfg_mbox12,
            stfg_mbox13,
            stfg_mbox14,
            stfg_mbox15,
            stfg_total,
            stfg_rijek,
            stfg_upah,
            stfg_tgllaporan,
            stfg_usersupervisor,
            stfg_userinput,
            stx_produk.produk_nama as produk_nama');
        $this->db->from('trx_stfg_arc');
        $this->db->join('stx_produk','stx_produk.produk_id=trx_stfg_arc.stfg_produk_id');
        
        if(!empty($xuser)) {
            if ($xid_group =='2') {
                $this->db->where('stfg_userinput',$xuser);
            }elseif($xid_group =='5') {
                $this->db->where('stfg_usersupervisor',$xuser);

            }
        }
        $this->db->where( 'stfg_tgllaporan BETWEEN "' .$tgl_awal. '" and "' .$tgl_akhir .'"');

        $this->db->order_by('stfg_tgllaporan');
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }


    public function download_arc_wip($xuser,$call_date,$xid_group){
        $val=explode('-', $call_date);
        $tgl_awal=$val[0] ."-" .$val[1] ."-" .$val[2];
        $tgl_akhir=$val[3] ."-" .$val[4] ."-" .$val[5]; 

        $this->db->select('wip_id,
            wip_produk_id,
            wip_shift,
            wip_mbox1,
            wip_mbox2,
            wip_mbox3,
            wip_mbox4,
            wip_mbox5,
            wip_mbox6,
            wip_mbox7,
            wip_mbox8,
            wip_mbox9,
            wip_mbox10,
            wip_mbox11,
            wip_mbox12,
            wip_mbox13,
            wip_mbox14,
            wip_mbox15,
            wip_total,
            wip_rijek,
            wip_upah,
            wip_tgllaporan,
            wip_usersupervisor,
            wip_userinput,
            stx_produk.produk_nama as produk_nama');
        $this->db->from('trx_wip_arc');
        $this->db->join('stx_produk','stx_produk.produk_id=trx_wip_arc.wip_produk_id');
        
        if(!empty($xuser)) {
            if ($xid_group =='2') {
                $this->db->where('wip_userinput',$xuser);
            }elseif($xid_group =='5') {
                $this->db->where('wip_usersupervisor',$xuser);

            }
        }
        $this->db->where( 'wip_tgllaporan BETWEEN "' .$tgl_awal. '" and "' .$tgl_akhir .'"');

        $this->db->order_by('wip_tgllaporan');
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }

    public function download_arc_pp($xuser,$call_date,$xid_group){
        $val=explode('-', $call_date);
        $tgl_awal=$val[0] ."-" .$val[1] ."-" .$val[2];
        $tgl_akhir=$val[3] ."-" .$val[4] ."-" .$val[5]; 

        $this->db->select('pp_id,
            pp_produk_id,
            pp_shift,
            pp_mbox1,
            pp_mbox2,
            pp_total,
            pp_upah,
            pp_tgllaporan,
            pp_usersupervisor,
            pp_userinput,
            stx_produk.produk_nama as produk_nama');
        $this->db->from('trx_pp_arc');
        $this->db->join('stx_produk','stx_produk.produk_id=trx_pp_arc.pp_produk_id');
        
        if(!empty($xuser)) {
            if ($xid_group =='2') {
                $this->db->where('pp_userinput',$xuser);
            }elseif($xid_group =='5') {
                $this->db->where('pp_usersupervisor',$xuser);

            }
        }
        $this->db->where( 'pp_tgllaporan BETWEEN "' .$tgl_awal. '" and "' .$tgl_akhir .'"');

        $this->db->order_by('pp_tgllaporan');
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }


    public function download_arc_clining($xuser,$call_date,$xid_group){
        $val=explode('-', $call_date);
        $tgl_awal=$val[0] ."-" .$val[1] ."-" .$val[2];
        $tgl_akhir=$val[3] ."-" .$val[4] ."-" .$val[5]; 

        $this->db->select('clining_id,
            clining_master_id,
            clining_karyawan_id,
            clining_line,
            clining_shift,
            clining_pekerjaan,
            clining_jumlahteam,
            clining_posisi,
            clining_upah,
            clining_tgllaporan,
            clining_usersupervisor,
            clining_userinput,
            trx_karyawan.karyawan_nama as karyawan_nama');
        $this->db->from('trx_clining_arc');
        $this->db->join('trx_karyawan','trx_karyawan.karyawan_id = trx_clining_arc.clining_karyawan_id','left');
        
        if(!empty($xuser)) {
            if ($xid_group =='2') {
                $this->db->where('clining_userinput',$xuser);
            }elseif($xid_group =='5') {
                $this->db->where('clining_usersupervisor',$xuser);

            }
        }
        $this->db->where( 'clining_tgllaporan BETWEEN "' .$tgl_awal. '" and "' .$tgl_akhir .'"');

        $this->db->order_by('clining_tgllaporan');
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }

    



    
}


/* End of file Trx_clining_model.php */
/* Location: ./application/models/Trx_clining_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-06-06 02:26:38 */
/* http://harviacode.com */
