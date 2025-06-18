<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trx_wip_model extends CI_Model
{

    public $table = 'trx_wip';
    public $id = 'wip_id';
    public $order = 'DESC';
    public $tables = 'view_wip';
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

    function wiphargaproduk($table,$field,$key,$key_value)
    {
    $this->db->select($field . " as wipztotal");
    $this->db->from($table);
    $this->db->where($key,$key_value);
    $data = $this->db->get();
    if ($data->num_rows() > 0) {
        return $data->row()->wipztotal;
    }
    else {
        return '';
    }

    }


    function sumtrxboxwip($field,$value1, $value2, $value3, $usersupervisor)
    {
        $this->db->select("SUM(".$field.") as myxxtotal");
        $this->db->from('trx_master');
        $this->db->where('master_produk_id',$value1);
        $this->db->where('master_tgllaporan',$value2);
        $this->db->where('master_shift',$value3);
        $this->db->where('master_module_id','1');
        $this->db->where('master_acuan_id','3');
        $this->db->where('master_usersupervisor',$usersupervisor);
        return $this->db->get()->row()->myxxtotal;

    }


        function sumtrxboxwipmanual($field,$value1, $value2, $value3, $usersupervisor)
    {
        $this->db->select("SUM(".$field.") as myxxwiptotal");
        $this->db->from('trx_master');
        $this->db->where('master_produk_id',$value1);
        $this->db->where('master_tgllaporan',$value2);
        $this->db->where('master_shift',$value3);
        $this->db->where('master_module_id','3');
        $this->db->where('master_acuan_id','3');
        $this->db->where('master_usersupervisor',$usersupervisor);
        return $this->db->get()->row()->myxxwiptotal;

    }


    function sumtrxdisplaywip($field,$value1, $value2, $value3, $value4 ,$usersupervisor)
    {
    $this->db->select("SUM(".$field.") as mxywiptotal");
    $this->db->from('trx_master');
    $this->db->where('master_produk_id',$value1);
    $this->db->where('master_tgllaporan',$value2);
    $this->db->where('master_shift',$value3);
    $this->db->where('master_line',$value4);
    $this->db->where('master_usersupervisor',$usersupervisor);
    return $this->db->get()->row()->mxywiptotal;

    }



    function wipcounttrxper($field,$value1, $value2, $value3, $value4, $value5, $usersupervisor)
    {
	    $this->db->select("COUNT(".$field.") as wipaxtotal");
	    $this->db->from('trx_master');
	    $this->db->where('master_produk_id',$value1);
	    $this->db->where('master_tgllaporan',$value2);
	    $this->db->where('master_shift',$value3);
	    $this->db->where('master_module_id',$value4);
	    $this->db->where('master_acuan_id',$value5);
        $this->db->where('master_usersupervisor',$usersupervisor);
	    return $this->db->get()->row()->wipaxtotal;

    }

    public function wiptampil_trxmasterline($value1, $value2, $value3, $value4, $usersupervisor){
        $this->db->select('*');
        $this->db->from('trx_master');
        $this->db->where('master_produk_id',$value1);
        $this->db->where('master_tgllaporan',$value2);
        $this->db->where('master_shift',$value3);
        $this->db->where('master_module_id',$value4);
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


    public function tampil_trxmastermesinwip($value1, $value2, $value3,$value4, $usersupervisor){
        $this->db->select('*');
        $this->db->from('trx_master');
        $this->db->where('master_produk_id',$value1);
        $this->db->where('master_tgllaporan',$value2);
        $this->db->where('master_shift',$value3);
        $this->db->where('master_line',$value4);
        $this->db->where('master_module_id','1');
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

function counttrxpermesinwip($field,$value1, $value2, $value3 ,$usersupervisor)
    {
    $this->db->select("COUNT(".$field.") as xctotal");
    $this->db->from('trx_master');
    $this->db->where('master_produk_id',$value1);
    $this->db->where('master_tgllaporan',$value2);
    $this->db->where('master_shift',$value3);
    $this->db->where('master_module_id','1');
    $this->db->where('master_acuan_id','3');
    $this->db->where('master_usersupervisor',$usersupervisor);

    return $this->db->get()->row()->xctotal;

    }


  function tampil_trxmasterdetaillinewip($value1, $value2, $usersupervisor)
    {
    $this->db->select("masterdetail_id As mxxwiptotal");
    $this->db->from('trx_masterdetail');
    $this->db->where('masterdetail_master_id',$value1);
    $this->db->where('masterdetail_karyawan_id',$value2);
    $this->db->where('masterdetail_usersupervisor',$usersupervisor);
    return $this->db->get()->row()->mxxwiptotal;

    }


    public function tampil_trxlinewip($value1, $value2, $value3, $value4,$value5, $usersupervisor){
        $this->db->select('*');
        $this->db->from('trx_line');
        $this->db->where('line_produk_id',$value1);
        $this->db->where('line_tgllaporan',$value2);
        $this->db->where('line_shift',$value3);
        $this->db->where('line_nomor',$value4);
        $this->db->where('line_master_id',$value5);
        $this->db->where('line_usersupervisor',$usersupervisor);
        

        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }


    function sumtrxwaktuwip($field,$value1, $value2, $value3, $value4, $usersupervisor)
    {
    $this->db->select("SUM(".$field.") as pwiptotal");
    $this->db->from('trx_master');
    $this->db->where('master_produk_id',$value1);
    $this->db->where('master_tgllaporan',$value2);
    $this->db->where('master_shift',$value3);
    $this->db->where('master_line',$value4);
    $this->db->where('master_module_id','1');
    $this->db->where('master_usersupervisor',$usersupervisor);
    return $this->db->get()->row()->pwiptotal;
    }


    public function wiptampil_trxmasterper($value1, $value2, $value3, $value4, $value5, $usersupervisor){
        $this->db->select('*');
        $this->db->from('trx_master');
        $this->db->where('master_produk_id',$value1);
        $this->db->where('master_tgllaporan',$value2);
        $this->db->where('master_shift',$value3);
        $this->db->where('master_module_id',$value4);
        $this->db->where('master_acuan_id',$value5);
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

    function counttrxperlinewip($field,$value1, $value2, $value3,$usersupervisor)
    {
    $this->db->select("COUNT(".$field.") as ctotal");
    $this->db->from('trx_master');
    $this->db->where('master_produk_id',$value1);
    $this->db->where('master_tgllaporan',$value2);
    $this->db->where('master_shift',$value3);
    $this->db->where('master_module_id','2');
    $this->db->where('master_usersupervisor',$usersupervisor);
    return $this->db->get()->row()->ctotal;

    }



    public function wiptampil_trxmesin($value1, $value2, $value3, $value4, $usersupervisor){
        $this->db->select('*');
        $this->db->from('trx_mesin');
        $this->db->where('mesin_produk_id',$value1);
        $this->db->where('mesin_tgllaporan',$value2);
        $this->db->where('mesin_shift',$value3);
        $this->db->where('mesin_master_id',$value4);
        $this->db->where('mesin_acuan_id','3');
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


    public function wiptampil_trxmanual($value1, $value2, $value3, $value4, $usersupervisor){
        $this->db->select('*');
        $this->db->from('trx_manual');
        $this->db->where('manual_produk_id',$value1);
        $this->db->where('manual_tgllaporan',$value2);
        $this->db->where('manual_shift',$value3);
        $this->db->where('manual_master_id',$value4);
        $this->db->where('manual_acuan_id','3');
        $this->db->where('manual_usersupervisor',$usersupervisor);

        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }

    function wiptampil_trxmasterdetailmesin($field, $value1, $value2, $usersupervisor)
    {
     $this->db->select($field . " as wipbtotal");
    $this->db->from('trx_masterdetail');
    $this->db->where('masterdetail_master_id',$value1);
    $this->db->where('masterdetail_karyawan_id',$value2);
    $this->db->where('masterdetail_usersupervisor',$usersupervisor);
    return $this->db->get()->row()->wipbtotal;

    }


 function wiptampil_trxmesindetail($value1, $value2 , $usersupervisor)
    {
    $this->db->select("masterdetail_id As myyxtotal");
    $this->db->from('trx_masterdetail');
    $this->db->where('masterdetail_master_id',$value1);
    $this->db->where('masterdetail_karyawan_id',$value2);
    $this->db->where('masterdetail_usersupervisor',$usersupervisor);
    return $this->db->get()->row()->myyxtotal;

    }

    
    function total_rows($q = NULL, $xusername, $id_group, $s= NULL, $t= NULL) {

        if(!empty($xusername)){
            if($id_group=='2'){
                $this->db->group_start();
                $this->db->or_where('wip_userinput',$xusername);
                $this->db->group_end(); 
                    }elseif($id_group=='5') {
                        $this->db->group_start();
                        $this->db->or_where('wip_usersupervisor',$xusername);
                        $this->db->group_end(); 
                    } 
        }
        $this->db->group_start();
        $this->db->like('wip_id', $q);
        $this->db->or_like('wip_produk_id', $q);
        $this->db->or_like('produk_nama', $q);
        $this->db->or_like('wip_mbox1', $q);
        $this->db->or_like('wip_mbox2', $q);
        $this->db->or_like('wip_mbox3', $q);
        $this->db->or_like('wip_mbox4', $q);
        $this->db->or_like('wip_mbox5', $q);
        $this->db->or_like('wip_mbox6', $q);
        $this->db->or_like('wip_mbox7', $q);
        $this->db->or_like('wip_mbox8', $q);
        $this->db->or_like('wip_mbox9', $q);
        $this->db->or_like('wip_mbox10', $q);
        $this->db->or_like('wip_mbox11', $q);
        $this->db->or_like('wip_mbox12', $q);
        $this->db->or_like('wip_mbox13', $q);
        $this->db->or_like('wip_mbox14', $q);
        $this->db->or_like('wip_mbox15', $q);
        $this->db->or_like('wip_total', $q);
        $this->db->or_like('wip_rijek', $q);
        $this->db->group_end();

        if(!empty($s)){
            $this->db->group_start();
            $this->db->or_where('wip_shift',$s);
            $this->db->group_end();
         }


        if(!empty($t)){
            $this->db->group_start();
            $this->db->or_where('wip_tgllaporan',$t);
            $this->db->group_end();
         }



		$this->db->from($this->tables);
        return $this->db->count_all_results();
    }


    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('wip_id', $q);
	$this->db->or_like('wip_produk_id', $q);
	$this->db->or_like('wip_shift', $q);
	$this->db->or_like('wip_mbox1', $q);
	$this->db->or_like('wip_mbox2', $q);
	$this->db->or_like('wip_mbox3', $q);
	$this->db->or_like('wip_mbox4', $q);
	$this->db->or_like('wip_mbox5', $q);
	$this->db->or_like('wip_mbox6', $q);
	$this->db->or_like('wip_mbox7', $q);
	$this->db->or_like('wip_mbox8', $q);
	$this->db->or_like('wip_mbox9', $q);
	$this->db->or_like('wip_mbox10', $q);
	$this->db->or_like('wip_mbox11', $q);
	$this->db->or_like('wip_mbox12', $q);
	$this->db->or_like('wip_mbox13', $q);
	$this->db->or_like('wip_mbox14', $q);
	$this->db->or_like('wip_mbox15', $q);
	$this->db->or_like('wip_rijek', $q);
	$this->db->or_like('wip_total', $q);
	$this->db->or_like('wip_upah', $q);
	$this->db->or_like('wip_tgllaporan', $q);
	$this->db->or_like('wip_userinput', $q);
	$this->db->or_like('wip_tglinput', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }


    public function tampil_data($limit, $start = 0, $q = NULL, $xusername, $id_group, $s= NULL, $t= NULL){
     
        if(!empty($xusername)){
            if($id_group=='2'){
                $this->db->group_start();
                $this->db->or_where('wip_userinput',$xusername);
                $this->db->group_end(); 
                    }elseif($id_group=='5') {
                        $this->db->group_start();
                        $this->db->or_where('wip_usersupervisor',$xusername);
                        $this->db->group_end(); 
                    }                
        }        
        $this->db->group_start();
        $this->db->like('wip_id', $q);
        $this->db->or_like('wip_produk_id', $q);
        $this->db->or_like('produk_nama', $q);
		$this->db->or_like('wip_mbox1', $q);
		$this->db->or_like('wip_mbox2', $q);
		$this->db->or_like('wip_mbox3', $q);
		$this->db->or_like('wip_mbox4', $q);
		$this->db->or_like('wip_mbox5', $q);
		$this->db->or_like('wip_mbox6', $q);
		$this->db->or_like('wip_mbox7', $q);
		$this->db->or_like('wip_mbox8', $q);
		$this->db->or_like('wip_mbox9', $q);
		$this->db->or_like('wip_mbox10', $q);
		$this->db->or_like('wip_mbox11', $q);
		$this->db->or_like('wip_mbox12', $q);
		$this->db->or_like('wip_mbox13', $q);
		$this->db->or_like('wip_mbox14', $q);
		$this->db->or_like('wip_mbox15', $q);
		$this->db->or_like('wip_total', $q);
		$this->db->or_like('wip_rijek', $q);
        $this->db->group_end();



        if(!empty($s)){
            $this->db->group_start();
            $this->db->or_where('wip_shift',$s);
            $this->db->group_end();
         }


        if(!empty($t)){
            $this->db->group_start();
            $this->db->or_where('wip_tgllaporan',$t);
            $this->db->group_end();
         }

        $this->db->order_by('wip_tglinput','DESC');
        $this->db->limit($limit, $start);
        return $this->db->get($this->tables)->result();
    }

public function download_wip($xuser,$call_date,$xid_group){
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
        $this->db->from('trx_wip');
        $this->db->join('stx_produk','stx_produk.produk_id=trx_wip.wip_produk_id');
        
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

/* End of file Trx_wip_model.php */
/* Location: ./application/models/Trx_wip_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-04 14:45:35 */
/* http://harviacode.com */
