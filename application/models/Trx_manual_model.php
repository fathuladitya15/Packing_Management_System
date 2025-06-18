<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trx_manual_model extends CI_Model
{

    public $table = 'trx_manual';
    public $id = 'manual_id';
    public $order = 'DESC';
    public $module = '3';
    public $tabmaster = 'trx_master';
    public $trxdetail = 'trx_masterdetail';
    public $tables = 'view_manual';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->tables)->row();
    }


    
    function manualsum($field,$value1, $value2, $value3, $value4)
    {
        $this->db->select("SUM(".$field.") as manualaxtotal");
        $this->db->from('trx_manual');
        $this->db->where('manual_produk_id',$value1);
        $this->db->where('manual_shift',$value2);
        $this->db->where('manual_tgllaporan',$value3);
        $this->db->where('manual_master_id',$value4);
        return $this->db->get()->row()->manualaxtotal;

    }

    function manualcount($field,$value1, $value2, $value3, $value4)
    {
        $this->db->select("COUNT(".$field.") as manualxxtotal");
        $this->db->from('trx_manual');
        $this->db->where('manual_produk_id',$value1);
        $this->db->where('manual_shift',$value2);
        $this->db->where('manual_tgllaporan',$value3);
        $this->db->where('manual_master_id',$value4);
        return $this->db->get()->row()->manualxxtotal;

    }
    
    public function gettrxmaster($value1, $value2, $value3, $value4){
        $this->db->select('*');
        $this->db->from('trx_master');
        $this->db->where('master_produk_id',$value1);
        $this->db->where('master_tgllaporan',$value2);
        $this->db->where('master_shift',$value3);
        $this->db->where('master_module_id',$value4);

        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }

    public function tampil_data($limit, $start = 0, $q = NULL, $xusername, $id_group, $s= NULL, $t= NULL){
    $supervisor=$this->session->userdata('user_supervisor'); 
        if(!empty($xusername)){
            if($id_group=='2'){
                $this->db->group_start();
                $this->db->or_where('manual_userinput',$xusername);
                $this->db->group_end(); 
                    }elseif(($id_group=='5') or ($id_group=='6')) {
                        $this->db->group_start();
                        $this->db->or_where('manual_usersupervisor',$supervisor);
                        $this->db->group_end(); 
                    }                
        }        
        $this->db->group_start();
        $this->db->like('manual_id', $q);
        $this->db->or_like('manual_karyawan_id', $q);
        $this->db->or_like('manual_produk_id', $q);
        $this->db->or_like('manual_master_id', $q);
        $this->db->or_like('karyawan_nama', $q);
        $this->db->or_like('produk_nama', $q);
        $this->db->group_end();


        if(!empty($s)){
            $this->db->group_start();
            $this->db->or_where('manual_shift',$s);
            $this->db->group_end();
         }


        if(!empty($t)){
            $this->db->group_start();
            $this->db->or_where('manual_tgllaporan',$t);
            $this->db->group_end();
         }

        $this->db->order_by('manual_id', 'DESC');
        $this->db->limit($limit, $start);
        return $this->db->get($this->tables)->result();
    }


    // get total rows
    function total_rows($q = NULL, $xusername, $id_group, $s= NULL, $t= NULL) {
    $supervisor=$this->session->userdata('user_supervisor'); 
        if(!empty($xusername)){
            if($id_group=='2'){
                $this->db->group_start();
                $this->db->or_where('manual_userinput',$xusername);
                $this->db->group_end(); 
                    }elseif(($id_group=='5') or ($id_group=='6')) {
                        $this->db->group_start();
                        $this->db->or_where('manual_usersupervisor',$supervisor);
                        $this->db->group_end(); 
                    } 
        } 
        
        $this->db->group_start();
        $this->db->like('manual_id', $q);
        $this->db->or_like('manual_karyawan_id', $q);
        $this->db->or_like('manual_produk_id', $q);
        $this->db->or_like('karyawan_nama', $q);
        $this->db->or_like('produk_nama', $q);
        $this->db->or_like('manual_box', $q);
        $this->db->or_like('manual_istirahat', $q);
        $this->db->or_like('manual_upah', $q);
        $this->db->group_end();

        if(!empty($s)){
            $this->db->group_start();
            $this->db->or_where('manual_shift',$s);
            $this->db->group_end();
         }


        if(!empty($t)){
            $this->db->group_start();
            $this->db->or_where('manual_tgllaporan',$t);
            $this->db->group_end();
         }

	    $this->db->from($this->tables);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('manual_id', $q);
    	$this->db->or_like('manual_karyawan_id', $q);
    	$this->db->or_like('manual_produk_id', $q);
    	$this->db->or_like('manual_acuan_id', $q);
    	$this->db->or_like('manual_shift', $q);
    	$this->db->or_like('manual_box', $q);
    	$this->db->or_like('manual_mulai', $q);
    	$this->db->or_like('manual_selesai', $q);
    	$this->db->or_like('manual_istirahat', $q);
        $this->db->or_like('manual_upah', $q);
    	$this->db->or_like('manual_totalmenit', $q);
    	$this->db->or_like('manual_tgllaporan', $q);
    	$this->db->or_like('manual_userinput', $q);
    	$this->db->or_like('manual_tglinput', $q);
    	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }


    function batchInsert($data, $codeid ,$masterbox, $hargamanual, $username, $usersupervisor){
        //get bill entries 
        $count = count($data['count']); 
        $username=$this->session->userdata('username'); 
        $usersupervisor=$this->session->userdata('user_supervisor');        
        for($i = 0; $i<$count; $i++){
            $xorang = count($data['count']);
            if (strtotime($data['jmanual_mulai'][$i]) > strtotime($data['jmanual_selesai'][$i])) {
                $tengah  ="24:00";
                $noll  ="00:00";
                $ytotalkerja = ((abs((strtotime($noll) - strtotime($data['jmanual_selesai'][$i])))/60) + ((strtotime($tengah) - strtotime($data['jmanual_mulai'][$i]))/60));
                $ytotal = $ytotalkerja - $data['jmanual_istirahat'][$i];
                }else {
                    $ytotalkerja = (strtotime($data['jmanual_selesai'][$i]) -  strtotime($data['jmanual_mulai'][$i]))/60;
                    $ytotal = $ytotalkerja - $data['jmanual_istirahat'][$i];
                }

            $xentries[] = array(
                'manual_karyawan_id'=>$data['jmanual_karyawan_id'][$i],
                'manual_master_id'=>$codeid,
                'manual_tgllaporan'=>$data['manual_tgllaporan'],
                'manual_acuan_id'=>$data['manual_acuan_id'],
                'manual_produk_id'=>$data['manual_produk_id'],
                'manual_box'=>$data['manual_box'],
                'manual_shift'=>$data['manual_shift'],
                'manual_mulai'=>$data['jmanual_mulai'][$i],
                'manual_selesai'=>$data['jmanual_selesai'][$i],
                'manual_istirahat'=>$data['jmanual_istirahat'][$i],
                'manual_totalmenit'=>$ytotal,
                'manual_usersupervisor' => $usersupervisor,
                'manual_userinput'=>$username,
                'manual_tglinput'=>date('Y-m-d'),                
                );

            $yentries[] = array(
                'masterdetail_karyawan_id'=>$data['jmanual_karyawan_id'][$i],
                'masterdetail_mulai'=>$data['jmanual_mulai'][$i],
                'masterdetail_master_id'=>$codeid,
                'masterdetail_selesai'=>$data['jmanual_selesai'][$i],
                'masterdetail_box'=>$data['manual_box'],
                'masterdetail_istirahat'=>$data['jmanual_istirahat'][$i],
                'masterdetail_totalkerja'=>$ytotal,
                'masterdetail_usersupervisor'=>$usersupervisor,
                'masterdetail_userinput'=>$username,
                'masterdetail_tglinput'=>date('Y-m-d'),                
                );
        }
        $this->db->insert_batch('trx_manual', $xentries);
        $this->db->insert_batch('trx_masterdetail', $yentries); 
        
        if($this->db->affected_rows() > 0)
            return 1;

        else
            return 0;
            //redirect(site_url('trx_manual/create'));
        }


    public function download_manual($xuser,$call_date,$xid_group){
        $val=explode('-', $call_date);
        $tgl_awal=$val[0] ."-" .$val[1] ."-" .$val[2];
        $tgl_akhir=$val[3] ."-" .$val[4] ."-" .$val[5]; 

        $this->db->select('manual_id,manual_master_id,manual_karyawan_id,manual_produk_id,manual_acuan_id, manual_shift, manual_box, manual_mulai, manual_selesai, manual_istirahat,  manual_totalmenit, manual_tgllaporan, manual_upah, manual_userinput,manual_usersupervisor, manual_tglinput,trx_karyawan.karyawan_nama as karyawan_nama, stx_produk.produk_nama as produk_nama');
        $this->db->from('trx_manual');
        $this->db->join('trx_karyawan','trx_karyawan.karyawan_id = trx_manual.manual_karyawan_id','left');
        $this->db->join('stx_produk','stx_produk.produk_id=trx_manual.manual_produk_id');
        
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



    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }


    function insertMaster($data)
    {
        $this->db->insert($this->tabmaster, $data);
    }


    function insertdetail($data)
    {
        $this->db->insert($this->trxdetail, $data);
    }

     function updateMaster($masterid, $data)
    {
        $this->db->where('master_id', $masterid);
        $this->db->update($this->tabmaster, $data);
    }

     function updateDetail($detailid, $data)
    {
        $this->db->where('masterdetail_id', $detailid);
        $this->db->update($this->trxdetail, $data);
    } 

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    function deletemaster($masterid)
    {
        $this->db->where('master_id', $masterid);
        $this->db->delete($this->tabmaster);
    }

    function deleteDetail($detailid)
    {
        $this->db->where('masterdetail_id', $detailid);
        $this->db->delete($this->trxdetail);
    }


    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Trx_manual_model.php */
/* Location: ./application/models/Trx_manual_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-09 10:56:27 */
/* http://harviacode.com */
