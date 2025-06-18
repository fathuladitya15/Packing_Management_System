<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trx_pp_model extends CI_Model
{

    public $table = 'trx_pp';
    public $id = 'pp_id';
    public $order = 'DESC';
    public $tables = 'view_pp';

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
    
    // get total rows
    function total_rows($q = NULL, $xusername, $id_group, $s= NULL, $t= NULL) {

        if(!empty($xusername)){
            if($id_group=='2'){
                $this->db->group_start();
                $this->db->or_where('pp_userinput',$xusername);
                $this->db->group_end(); 
                    }elseif($id_group=='5') {
                        $this->db->group_start();
                        $this->db->or_where('pp_usersupervisor',$xusername);
                        $this->db->group_end(); 
                    } 
        }
        $this->db->group_start();
    	$this->db->or_like('pp_id', $q);
    	$this->db->or_like('pp_produk_id', $q);
        $this->db->or_like('produk_nama', $q);
    	$this->db->or_like('pp_mbox1', $q);
    	$this->db->or_like('pp_mbox2', $q);
    	$this->db->or_like('pp_total', $q);
    	$this->db->or_like('pp_upah', $q);
    	$this->db->or_like('pp_userinput', $q);
    	$this->db->or_like('pp_tglinput', $q);
        $this->db->group_end();


        if(!empty($s)){
            $this->db->group_start();
            $this->db->or_where('pp_shift',$s);
            $this->db->group_end();
         }


        if(!empty($t)){
            $this->db->group_start();
            $this->db->or_where('pp_tgllaporan',$t);
            $this->db->group_end();
         }

    	$this->db->from($this->tables);
        return $this->db->count_all_results();
    }

    function sumtrxboxmanual($field,$value1, $value2, $value3, $usersupervisor)
    {
    $this->db->select("SUM(".$field.") as myxxtotal");
    $this->db->from('trx_master');
    $this->db->where('master_produk_id',$value1);
    $this->db->where('master_tgllaporan',$value2);
    $this->db->where('master_shift',$value3);
    $this->db->where('master_module_id','1');
    $this->db->where('master_acuan_id','2');
    $this->db->where('master_usersupervisor',$usersupervisor);
    return $this->db->get()->row()->myxxtotal;

    }


    function pphargaproduk($table,$field,$key,$key_value, $usersupervisor)
    {
    $this->db->select($field . " as ppxxtotal");
    $this->db->from($table);
    $this->db->where($key,$key_value);
    $this->db->where('produk_usersupervisor',$usersupervisor);
    $data = $this->db->get();
    if ($data->num_rows() > 0) {
        return $data->row()->ppxxtotal;
    }
    else {
        return '';
    }


    }

    public function pptampil_trxmesin($value1, $value2, $value3, $value4, $usersupervisor){
        $this->db->select('*');
        $this->db->from('trx_mesin');
        $this->db->where('mesin_produk_id',$value1);
        $this->db->where('mesin_tgllaporan',$value2);
        $this->db->where('mesin_shift',$value3);
        $this->db->where('mesin_master_id',$value4);
        $this->db->where('mesin_acuan_id','2');
        $this->db->where('mesin_usersupervisor',$usersupervisor);


        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }



    function ppcounttrxmesin($field,$value1, $value2, $value3 , $value4)
    {
        $this->db->select("count(".$field.") as mxftotal");
        $this->db->from('trx_mesin');
        $this->db->where('mesin_produk_id',$value1);
        $this->db->where('mesin_tgllaporan',$value2);
        $this->db->where('mesin_shift',$value3);
        $this->db->where('mesin_master_id',$value4);
        return $this->db->get()->row()->mxftotal;

    }


    function pptampil_trxmasterdetailmesin($field, $value1, $value2, $usersupervisor)
    {
        $this->db->select($field . " as xxftotal");
        $this->db->from('trx_masterdetail');
        $this->db->where('masterdetail_master_id',$value1);
        $this->db->where('masterdetail_karyawan_id',$value2);
        $this->db->where('masterdetail_usersupervisor',$usersupervisor);
        return $this->db->get()->row()->xxftotal;

    }

    function ppcounttrxpermesin($field,$value1, $value2, $value3, $value4, $value5, $usersupervisor)
    {
    $this->db->select("COUNT(".$field.") as ppcxtotal");
    $this->db->from('trx_master');
    $this->db->where('master_produk_id',$value1);
    $this->db->where('master_tgllaporan',$value2);
    $this->db->where('master_shift',$value3);
    $this->db->where('master_module_id',$value4);
    $this->db->where('master_acuan_id',$value5);
    $this->db->where('master_usersupervisor',$usersupervisor);

    return $this->db->get()->row()->ppcxtotal;

    }
    

    public function pptampil_trxmastermesin($value1, $value2, $value3, $usersupervisor){
        $this->db->select('*');
        $this->db->from('trx_master');
        $this->db->where('master_produk_id',$value1);
        $this->db->where('master_tgllaporan',$value2);
        $this->db->where('master_shift',$value3);
        $this->db->where('master_module_id','1');
        $this->db->where('master_acuan_id','2');
        $this->db->where('master_usersupervisor',$usersupervisor);

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
     
        if(!empty($xusername)){
            if($id_group=='2'){
                $this->db->group_start();
                $this->db->or_where('pp_userinput',$xusername);
                $this->db->group_end(); 
                    }elseif($id_group=='5') {
                        $this->db->group_start();
                        $this->db->or_where('pp_usersupervisor',$xusername);
                        $this->db->group_end(); 
                    }                
        }            
        $this->db->group_start();        
        $this->db->like('pp_id', $q);
        $this->db->or_like('pp_produk_id', $q);
        $this->db->or_like('produk_nama', $q);
        $this->db->or_like('pp_mbox1', $q);
        $this->db->or_like('pp_mbox2', $q);
        $this->db->or_like('pp_total', $q);
        $this->db->or_like('pp_upah', $q);
        $this->db->group_end();

        if(!empty($s)){
            $this->db->group_start();
            $this->db->or_where('pp_shift',$s);
            $this->db->group_end();
         }


        if(!empty($t)){
            $this->db->group_start();
            $this->db->or_where('pp_tgllaporan',$t);
            $this->db->group_end();
         }

        $this->db->order_by('pp_tglinput','DESC');
        $this->db->limit($limit, $start);
        return $this->db->get($this->tables)->result();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('', $q);
	$this->db->or_like('pp_id', $q);
	$this->db->or_like('pp_produk_id', $q);
	$this->db->or_like('pp_mbox1', $q);
	$this->db->or_like('pp_mbox2', $q);
	$this->db->or_like('pp_total', $q);
	$this->db->or_like('pp_upah', $q);
	$this->db->or_like('pp_tgllaporan', $q);
	$this->db->or_like('pp_userinput', $q);
	$this->db->or_like('pp_tglinput', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }


        public function download_pp($xuser,$call_date,$xid_group){
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
        $this->db->from('trx_pp');
        $this->db->join('stx_produk','stx_produk.produk_id=trx_pp.pp_produk_id');
        
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

/* End of file Trx_pp_model.php */
/* Location: ./application/models/Trx_pp_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-04 14:45:35 */
/* http://harviacode.com */
