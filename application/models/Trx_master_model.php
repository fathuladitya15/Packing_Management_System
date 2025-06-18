<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trx_master_model extends CI_Model
{

    public $table = 'trx_master';
    public $id = 'master_id';
    public $order = 'DESC';
    public $tabmaster = 'trx_master';
    public $trxdetail = 'trx_masterdetail';
    public $tables = 'view_transaksi';

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
    
    function total_rows($q = NULL, $xusername, $id_group, $s, $t) {

        if(!empty($xusername)){
            if($id_group=='2'){
                $this->db->group_start();
                $this->db->or_where('masterdetail_userinput',$xusername);
                $this->db->group_end(); 
                    }elseif($id_group=='5') {
                        $this->db->group_start();
                        $this->db->or_where('masterdetail_usersupervisor',$xusername);
                        $this->db->group_end(); 
                    } 
        } 
        
        $this->db->group_start();
        $this->db->like('master_id', $q);
        $this->db->or_like('master_module_id', $q);
        $this->db->or_like('karyawan_id', $q);
        $this->db->or_like('karyawan_nama', $q);
        $this->db->or_like('produk_nama', $q);
        $this->db->or_like('module_nama', $q);
        $this->db->or_like('masterdetail_mulai', $q);
        $this->db->or_like('masterdetail_selesai', $q);
        $this->db->or_like('masterdetail_istirahat', $q);
        $this->db->or_like('masterdetail_box', $q);
        $this->db->or_like('masterdetail_jumlahstiker', $q);
        $this->db->or_like('masterdetail_jumlahkrat', $q);
        $this->db->or_like('masterdetail_upah', $q);
        $this->db->or_like('masterdetail_userinput', $q);
        $this->db->or_like('masterdetail_tglinput', $q);
        $this->db->group_end();


        if(!empty($s)){
            $this->db->group_start();
            $this->db->where('master_shift',$s);
            $this->db->group_end();
         }


        if(!empty($t)){
            $this->db->group_start();
            $this->db->where('master_tgllaporan',$t);
            $this->db->group_end();
         }

	$this->db->from($this->tables);
        return $this->db->count_all_results();
    }


    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('master_id', $q);
	$this->db->or_like('master_module_id', $q);
	$this->db->or_like('master_acuan_id', $q);
	$this->db->or_like('master_produk_id', $q);
	$this->db->or_like('master_line', $q);
	$this->db->or_like('master_tgllaporan', $q);
	$this->db->or_like('master_shift', $q);
	$this->db->or_like('master_nomesin', $q);
	$this->db->or_like('master_jumlahteam', $q);
	$this->db->or_like('master_display', $q);
	$this->db->or_like('master_box', $q);
	$this->db->or_like('master_istirahat', $q);
	$this->db->or_like('master_totalkerjamenit', $q);
	$this->db->or_like('master_totalkerjajam', $q);
	$this->db->or_like('master_karu', $q);
	$this->db->or_like('master_stfg', $q);
	$this->db->or_like('master_bayarstfg', $q);
	$this->db->or_like('master_acuanmesin', $q);
	$this->db->or_like('master_acuanline', $q);
	$this->db->or_like('master_userinput', $q);
	$this->db->or_like('master_tglinput', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }


public function tampil_data($limit, $start = 0, $q = NULL, $xusername, $id_group, $s= NULL, $t= NULL){
     
        if(!empty($xusername)){
            if($id_group=='2'){
                $this->db->group_start();
                $this->db->or_where('masterdetail_userinput',$xusername);
                $this->db->group_end(); 
                    }elseif($id_group=='5') {
                        $this->db->group_start();
                        $this->db->or_where('masterdetail_usersupervisor',$xusername);
                        $this->db->group_end(); 
                    }                
        }        
       
        $this->db->group_start();
        $this->db->like('master_id', $q);
        $this->db->or_like('master_module_id', $q);
        $this->db->or_like('karyawan_id', $q);
        $this->db->or_like('karyawan_nama', $q);
        $this->db->or_like('produk_nama', $q);
        $this->db->or_like('module_nama', $q);
        $this->db->or_like('masterdetail_mulai', $q);
        $this->db->or_like('masterdetail_selesai', $q);
        $this->db->or_like('masterdetail_istirahat', $q);
        $this->db->or_like('masterdetail_box', $q);
        $this->db->or_like('masterdetail_jumlahstiker', $q);
        $this->db->or_like('masterdetail_jumlahkrat', $q);
        $this->db->or_like('masterdetail_upah', $q);
        $this->db->or_like('masterdetail_userinput', $q);
        $this->db->or_like('masterdetail_tglinput', $q);
        $this->db->group_end();


        if(!empty($s)){
            $this->db->group_start();
            $this->db->or_where('master_shift',$s);
            $this->db->group_end();
         }


        if(!empty($t)){
            $this->db->group_start();
            $this->db->or_where('master_tgllaporan',$t);
            $this->db->group_end();
         }

        $this->db->order_by('karyawan_id');
        $this->db->limit($limit, $start);
        return $this->db->get($this->tables)->result();
    }

    public function download_master($xuser,$call_date,$xid_group){
        $val=explode('-', $call_date);
        $tgl_awal=$val[0] ."-" .$val[1] ."-" .$val[2];
        $tgl_akhir=$val[3] ."-" .$val[4] ."-" .$val[5]; 

        $this->db->select('
                  stx_module.module_nama,
                  trx_karyawan.karyawan_id as karyawan_id,
                  trx_karyawan.karyawan_nama as karyawan_nama,
                  master_id,
                  master_module_id as master_module_id,
                  master_tgllaporan as master_tgllaporan,
                  master_shift as master_shift,
                  master_nomesin as master_nomesin,
                  master_display as master_display,
                  master_box as master_box,
                  stx_produk.produk_id as produk_id,
                  stx_produk.produk_nama as produk_nama,
                  trx_masterdetail.masterdetail_jumlahkrat as masterdetail_jumlahkrat,
                  trx_masterdetail.masterdetail_mulai as masterdetail_mulai,
                  trx_masterdetail.masterdetail_selesai as masterdetail_selesai,
                  trx_masterdetail.masterdetail_istirahat as masterdetail_istirahat,
                  trx_masterdetail.masterdetail_totalkerja as masterdetail_totalkerja,
                  trx_masterdetail.masterdetail_box as masterdetail_box,
                  trx_masterdetail.masterdetail_jumlahstiker as masterdetail_jumlahstiker,
                  trx_masterdetail.masterdetail_jumlahkrat as masterdetail_jumlahkrat,
                  trx_masterdetail.masterdetail_upah as masterdetail_upah,
                  trx_masterdetail.masterdetail_tglinput as masterdetail_tglinput,
                  trx_masterdetail.masterdetail_userinput as masterdetail_userinput,
                  trx_masterdetail.masterdetail_usersupervisor as masterdetail_usersupervisor');
        $this->db->from('trx_master');
        $this->db->join('trx_masterdetail','trx_masterdetail.masterdetail_master_id = trx_master.master_id');
        $this->db->join('stx_module','stx_module.module_id=trx_master.master_module_id');
        $this->db->join('trx_karyawan','trx_karyawan.karyawan_id=trx_masterdetail.masterdetail_karyawan_id','left');
        $this->db->join('stx_produk','stx_produk.produk_id=trx_master.master_produk_id','left');
        
        if(!empty($xuser)) {
            if ($xid_group =='2') {
                $this->db->where('trx_masterdetail.masterdetail_userinput',$xuser);
            }elseif($xid_group =='5') {
                $this->db->where('trx_masterdetail.masterdetail_usersupervisor',$xuser);

            }
        }
        $this->db->where( 'master_tgllaporan BETWEEN "' .$tgl_awal. '" and "' .$tgl_akhir .'"');

        $this->db->order_by('karyawan_id');
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

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Trx_master_model.php */
/* Location: ./application/models/Trx_master_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-04 14:45:35 */
/* http://harviacode.com */
