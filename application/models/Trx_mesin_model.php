<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trx_mesin_model extends CI_Model
{

    public $table = 'trx_mesin';
    public $id = 'mesin_id';
    public $order = 'DESC';
    public $module = '1';
    public $tabmaster = 'trx_master';
    public $trxdetail = 'trx_masterdetail';
    public $tables = 'view_mesin';


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


    function mesinsum($field,$value1, $value2, $value3, $value4)
    {
        $this->db->select("SUM(".$field.") as mesinaxtotal");
        $this->db->from('trx_mesin');
        $this->db->where('mesin_produk_id',$value1);
        $this->db->where('mesin_shift',$value2);
        $this->db->where('mesin_tgllaporan',$value3);
        $this->db->where('mesin_master_id',$value4);
        return $this->db->get()->row()->mesinaxtotal;

    }

    function mesincount($field,$value1, $value2, $value3, $value4)
    {
        $this->db->select("COUNT(".$field.") as mesinxxtotal");
        $this->db->from('trx_mesin');
        $this->db->where('mesin_produk_id',$value1);
        $this->db->where('mesin_shift',$value2);
        $this->db->where('mesin_tgllaporan',$value3);
        $this->db->where('mesin_master_id',$value4);
        return $this->db->get()->row()->mesinxxtotal;

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
                $this->db->or_where('mesin_userinput',$xusername);
                $this->db->group_end(); 
                    }elseif(($id_group=='5') or ($id_group=='6')) {
                        $this->db->group_start();
                        $this->db->or_where('mesin_usersupervisor',$supervisor);
                        $this->db->group_end(); 
                        
                    }               
        }        
        $this->db->group_start();
        $this->db->like('mesin_id', $q);
        $this->db->or_like('mesin_karyawan_id', $q);
        $this->db->or_like('mesin_produk_id', $q);
        $this->db->or_like('karyawan_nama', $q);
        $this->db->or_like('produk_nama', $q);
        $this->db->or_like('mesin_master_id', $q);
        $this->db->group_end();

        if(!empty($s)){
            $this->db->group_start();
            $this->db->or_where('mesin_shift',$s);
            $this->db->group_end();
         }


        if(!empty($t)){
            $this->db->group_start();
            $this->db->or_where('mesin_tgllaporan',$t);
            $this->db->group_end();
         }

        $this->db->order_by('mesin_id','DESC');
        $this->db->limit($limit, $start);
        return $this->db->get($this->tables)->result();
    }


    // get total rows
    function total_rows($q = NULL, $xusername, $id_group, $s= NULL, $t= NULL) {
        
        $supervisor=$this->session->userdata('user_supervisor');
        if(!empty($xusername)){
            if($id_group=='2'){
                $this->db->group_start();
                $this->db->or_where('mesin_userinput',$xusername);
                $this->db->group_end(); 
                    }elseif(($id_group=='5') or ($id_group=='6')) {
                        $this->db->group_start();
                        $this->db->or_where('mesin_usersupervisor',$supervisor);
                        $this->db->group_end(); 
                    } 
        }  

        $this->db->group_start();
        $this->db->like('mesin_id', $q);
        $this->db->or_like('karyawan_nama', $q);
        $this->db->or_like('produk_nama', $q);
    	$this->db->or_like('mesin_karyawan_id', $q);
    	$this->db->or_like('mesin_produk_id', $q);
    	$this->db->or_like('mesin_master_id', $q);
    	$this->db->or_like('mesin_acuan_id', $q);
    	$this->db->or_like('mesin_line', $q);
    	$this->db->or_like('mesin_mesin', $q);
    	$this->db->or_like('mesin_display', $q);
        $this->db->or_like('mesin_upah', $q);
        $this->db->or_like('mesin_usersupervisor', $q);
    	$this->db->or_like('mesin_userinput', $q);
    	$this->db->or_like('mesin_tglinput', $q);
         $this->db->group_end();


        if(!empty($s)){
            $this->db->group_start();
            $this->db->or_where('mesin_shift',$s);
            $this->db->group_end();
         }


        if(!empty($t)){
            $this->db->group_start();
            $this->db->or_where('mesin_tgllaporan',$t);
            $this->db->group_end();
         }

    	$this->db->from($this->tables);
        return $this->db->count_all_results();
    }


    public function download_mesin($xuser,$call_date,$xid_group){
        $val=explode('-', $call_date);
        $tgl_awal=$val[0] ."-" .$val[1] ."-" .$val[2];
        $tgl_akhir=$val[3] ."-" .$val[4] ."-" .$val[5]; 

        $this->db->select('mesin_id,mesin_master_id,mesin_karyawan_id,mesin_produk_id,mesin_acuan_id,mesin_line, mesin_shift, mesin_mesin, mesin_display, mesin_mulai, mesin_selesai, mesin_istirahat,  mesin_totalmenit, mesin_tgllaporan, mesin_upah, mesin_userinput,mesin_usersupervisor, mesin_tglinput,trx_karyawan.karyawan_nama as karyawan_nama, stx_produk.produk_nama as produk_nama');
        $this->db->from('trx_mesin');
        $this->db->join('trx_karyawan','trx_karyawan.karyawan_id = trx_mesin.mesin_karyawan_id','left');
        $this->db->join('stx_produk','stx_produk.produk_id=trx_mesin.mesin_produk_id');
        
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


    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('mesin_id', $q);
    	$this->db->or_like('mesin_karyawan_id', $q);
    	$this->db->or_like('mesin_produk_id', $q);
    	$this->db->or_like('mesin_acuan_id', $q);
    	$this->db->or_like('mesin_line', $q);
    	$this->db->or_like('mesin_shift', $q);
    	$this->db->or_like('mesin_mesin', $q);
    	$this->db->or_like('mesin_display', $q);
    	$this->db->or_like('mesin_mulai', $q);
    	$this->db->or_like('mesin_selesai', $q);
    	$this->db->or_like('mesin_istirahat', $q);
    	$this->db->or_like('mesin_totalmenit', $q);
        $this->db->or_like('mesin_upah', $q);
    	$this->db->or_like('mesin_tgllaporan', $q);
    	$this->db->or_like('mesin_userinput', $q);
    	$this->db->or_like('mesin_tglinput', $q);
    	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    function batchInsert($data, $codeid, $username, $usersupervisor){
        $count = count($data['count']); 

        for($i = 0; $i<$count; $i++){
            if (strtotime($data['jmesin_mulai'][$i]) > strtotime($data['jmesin_selesai'][$i])) {
                $tengah  ="24:00";
                $noll  ="00:00";
                $ztotalkerja = ((abs((strtotime($noll) - strtotime($data['jmesin_selesai'][$i])))/60) + ((strtotime($tengah) - strtotime($data['jmesin_mulai'][$i]))/60));
                $ztotal = $ztotalkerja - $data['jmesin_istirahat'][$i];
                }else {
                    $ztotalkerja = (strtotime($data['jmesin_selesai'][$i]) -  strtotime($data['jmesin_mulai'][$i]))/60;
                    $ztotal = $ztotalkerja - $data['jmesin_istirahat'][$i];
                }

            $xentries[] = array(
                'mesin_karyawan_id'=>$data['jmesin_karyawan_id'][$i],
                'mesin_master_id'=>$codeid,
                'mesin_tgllaporan'=>$data['mesin_tgllaporan'],
                'mesin_acuan_id'=>$data['mesin_acuan_id'],
                'mesin_produk_id'=>$data['mesin_produk_id'],
                'mesin_mesin'=>$data['mesin_mesin'],
                'mesin_line'=>$data['mesin_line'],                
                'mesin_display'=>$data['mesin_display'],
                'mesin_shift'=>$data['mesin_shift'],
                'mesin_mulai'=>$data['jmesin_mulai'][$i],
                'mesin_selesai'=>$data['jmesin_selesai'][$i],
                'mesin_istirahat'=>$data['jmesin_istirahat'][$i],
                'mesin_totalmenit'=>$ztotal,
                'mesin_usersupervisor' => $usersupervisor,
                'mesin_userinput'=>$username,
                'mesin_tglinput'=>date('Y-m-d'),                
                );

            $yentries[] = array(
                'masterdetail_karyawan_id'=>$data['jmesin_karyawan_id'][$i],                
                'masterdetail_master_id'=>$codeid,
                'masterdetail_mulai'=>$data['jmesin_mulai'][$i],
                'masterdetail_selesai'=>$data['jmesin_selesai'][$i],
                'masterdetail_totalkerja'=>$ztotal,
                'masterdetail_box'=>$data['mesin_display'],
                'masterdetail_istirahat'=>$data['jmesin_istirahat'][$i],
                'masterdetail_usersupervisor'=>$usersupervisor,
                'masterdetail_userinput'=>$username,
                'masterdetail_tglinput'=>date('Y-m-d'),                
                ); 
        }
        $this->db->insert_batch('trx_mesin', $xentries); 
        $this->db->insert_batch('trx_masterdetail', $yentries); 
        
        if($this->db->affected_rows() > 0)
            return 1;

        else
            return 0;
            redirect(site_url('trx_mesin/create'));
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

/* End of file Trx_mesin_model.php */
/* Location: ./application/models/Trx_mesin_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-04 14:45:35 */
/* http://harviacode.com */
