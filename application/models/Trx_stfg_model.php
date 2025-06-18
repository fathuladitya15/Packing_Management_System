<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trx_stfg_model extends CI_Model
{

    public $table = 'trx_stfg';
    public $id = 'stfg_id';
    public $order = 'DESC';
    public $module = '8';
    public $tables = 'view_stfg';
    public $tabmaster = 'trx_master';
    public $trxdetail = 'trx_masterdetail';
    public $yid = 'mesin_id';


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
    


    function stfghargaproduk($table,$field,$key,$key_value, $usersupervisor)
    {
    $this->db->select($field . " as stfgztotal");
    $this->db->from($table);
    $this->db->where($key,$key_value);
    $this->db->where('produk_usersupervisor',$usersupervisor);
    $data = $this->db->get();
    if ($data->num_rows() > 0) {
        return $data->row()->stfgztotal;
    }
    else {
        return '';
    }

    }


    function stfgcounttrxper($field,$value1, $value2, $value3, $value4, $value5, $usersupervisor)
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


    public function stfgtampil_trxmasterper($value1, $value2, $value3, $value4, $value5, $usersupervisor){
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


        function sumtrxboxstfgmanual($field,$value1, $value2, $value3, $usersupervisor)
    {
        $this->db->select("SUM(".$field.") as myxxmanualtotal");
        $this->db->from('trx_master');
        $this->db->where('master_produk_id',$value1);
        $this->db->where('master_tgllaporan',$value2);
        $this->db->where('master_shift',$value3);
        $this->db->where('master_module_id','3');
        $this->db->where('master_acuan_id','1');
        $this->db->where('master_usersupervisor',$usersupervisor);
        return $this->db->get()->row()->myxxmanualtotal;

    }

    public function stfgtampil_trxmasterline($value1, $value2, $value3, $value4, $usersupervisor){
        $this->db->select('*');
        $this->db->from('trx_master');
        $this->db->where('master_produk_id',$value1);
        $this->db->where('master_tgllaporan',$value2);
        $this->db->where('master_shift',$value3);
        $this->db->where('master_module_id',$value4);
        $this->db->where('master_acuan_id IS NULL');
        $this->db->where('master_line IS NOT NULL');
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

    public function stfgtampil_trxmanual($value1, $value2, $value3, $value4, $usersupervisor){
        $this->db->select('*');
        $this->db->from('trx_manual');
        $this->db->where('manual_produk_id',$value1);
        $this->db->where('manual_tgllaporan',$value2);
        $this->db->where('manual_shift',$value3);
        $this->db->where('manual_master_id',$value4);
        $this->db->where('manual_acuan_id','1');
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


    function stfgtampil_trxmasterdetailmanual($field, $value1, $value2,$usersupervisor)
    {
        $this->db->select($field . " as stfgbtotal");
        $this->db->from('trx_masterdetail');
        $this->db->where('masterdetail_master_id',$value1);
        $this->db->where('masterdetail_karyawan_id',$value2);
        $this->db->where('masterdetail_usersupervisor',$usersupervisor);
        return $this->db->get()->row()->stfgbtotal;

    }


    function sumtrxbox($field,$value1, $value2, $value3, $usersupervisor)
    {
    $this->db->select("SUM(".$field.") as myxtotal");
    $this->db->from('trx_master');
    $this->db->where('master_produk_id',$value1);
    $this->db->where('master_tgllaporan',$value2);
    $this->db->where('master_shift',$value3);
    $this->db->where('master_module_id','1');
    $this->db->where('master_acuan_id','1');
    $this->db->where('master_usersupervisor',$usersupervisor);
    return $this->db->get()->row()->myxtotal;

    }


	function counttrxperline($field,$value1, $value2, $value3,$usersupervisor)
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



    function sumtrxdisplay($field,$value1, $value2, $value3, $value4 ,$usersupervisor)
    {
    $this->db->select("SUM(".$field.") as mxytotal");
    $this->db->from('trx_master');
    $this->db->where('master_produk_id',$value1);
    $this->db->where('master_tgllaporan',$value2);
    $this->db->where('master_shift',$value3);
    $this->db->where('master_line',$value4);
    $this->db->where('master_usersupervisor',$usersupervisor);
    return $this->db->get()->row()->mxytotal;

    }



    function counttrxpermesin($field,$value1, $value2, $value3 ,$usersupervisor)
    {
    $this->db->select("COUNT(".$field.") as xctotal");
    $this->db->from('trx_master');
    $this->db->where('master_produk_id',$value1);
    $this->db->where('master_tgllaporan',$value2);
    $this->db->where('master_shift',$value3);
    $this->db->where('master_module_id','1');
    $this->db->where('master_acuan_id','1');
    $this->db->where('master_usersupervisor',$usersupervisor);

    return $this->db->get()->row()->xctotal;

    }



        function tampil_trxmasterdetailmesin($value1, $value2 , $usersupervisor)
    {
    $this->db->select("masterdetail_id As myyxtotal");
    $this->db->from('trx_masterdetail');
    $this->db->where('masterdetail_master_id',$value1);
    $this->db->where('masterdetail_karyawan_id',$value2);
    $this->db->where('masterdetail_usersupervisor',$usersupervisor);
    return $this->db->get()->row()->myyxtotal;

    }



    public function tampil_trxmesin($value1, $value2, $value3, $value4, $usersupervisor){
        $this->db->select('*');
        $this->db->from('trx_mesin');
        $this->db->where('mesin_produk_id',$value1);
        $this->db->where('mesin_tgllaporan',$value2);
        $this->db->where('mesin_shift',$value3);
        $this->db->where('mesin_master_id',$value4);
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


    function counttrxmesin($field,$value1, $value2, $value3 , $value4)
    {
    $this->db->select("count(".$field.") as mftotal");
    $this->db->from('trx_mesin');
    $this->db->where('mesin_produk_id',$value1);
    $this->db->where('mesin_tgllaporan',$value2);
    $this->db->where('mesin_shift',$value3);
    $this->db->where('mesin_master_id',$value4);
    return $this->db->get()->row()->mftotal;

    }

    public function tampil_trxmastermesin($value1, $value2, $value3,$value4, $usersupervisor){
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

    public function tampil_trxmastermesinwline($value1, $value2, $value3,$value4, $usersupervisor){
        $this->db->select('*');
        $this->db->from('trx_master');
        $this->db->where('master_produk_id',$value1);
        $this->db->where('master_tgllaporan',$value2);
        $this->db->where('master_shift',$value3);
        $this->db->where('master_acuan_id',$value4);
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


    public function tampil_trxline($value1, $value2, $value3, $value4,$value5, $usersupervisor){
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



    function tampil_trxmasterdetailline($value1, $value2, $usersupervisor)
    {
    $this->db->select("masterdetail_id As mxxtotal");
    $this->db->from('trx_masterdetail');
    $this->db->where('masterdetail_master_id',$value1);
    $this->db->where('masterdetail_karyawan_id',$value2);
    $this->db->where('masterdetail_usersupervisor',$usersupervisor);
    return $this->db->get()->row()->mxxtotal;

    }


    function counttrxline($field,$value1, $value2, $value3 , $value4)
    {
    $this->db->select("count(".$field.") as mltotal");
    $this->db->from('trx_line');
    $this->db->where('line_produk_id',$value1);
    $this->db->where('line_tgllaporan',$value2);
    $this->db->where('line_shift',$value3);
    $this->db->where('line_nomor',$value4);
    return $this->db->get()->row()->mltotal;

    }


    function sumtrxwaktu($field,$value1, $value2, $value3, $value4, $usersupervisor)
    {
    $this->db->select("SUM(".$field.") as ptotal");
    $this->db->from('trx_master');
    $this->db->where('master_produk_id',$value1);
    $this->db->where('master_tgllaporan',$value2);
    $this->db->where('master_shift',$value3);
    $this->db->where('master_line',$value4);
    $this->db->where('master_module_id','1');
    $this->db->where('master_usersupervisor',$usersupervisor);
    return $this->db->get()->row()->ptotal;
    }


    function total_rows($q = NULL, $xusername, $id_group, $s= NULL, $t= NULL) {

        if(!empty($xusername)){
            if($id_group=='2'){
                $this->db->group_start();
                $this->db->or_where('stfg_userinput',$xusername);
                $this->db->group_end(); 
                    }elseif($id_group=='5') {
                        $this->db->group_start();
                        $this->db->or_where('stfg_usersupervisor',$xusername);
                        $this->db->group_end(); 
                    } 
        }
        $this->db->group_start();
        $this->db->like('stfg_id', $q);
		$this->db->or_like('stfg_produk_id', $q);
        $this->db->or_like('produk_nama', $q);
		$this->db->or_like('stfg_mbox1', $q);
		$this->db->or_like('stfg_mbox2', $q);
		$this->db->or_like('stfg_mbox3', $q);
		$this->db->or_like('stfg_mbox4', $q);
		$this->db->or_like('stfg_mbox5', $q);
		$this->db->or_like('stfg_mbox6', $q);
		$this->db->or_like('stfg_mbox7', $q);
		$this->db->or_like('stfg_mbox8', $q);
		$this->db->or_like('stfg_mbox9', $q);
		$this->db->or_like('stfg_mbox10', $q);
		$this->db->or_like('stfg_mbox11', $q);
		$this->db->or_like('stfg_mbox12', $q);
		$this->db->or_like('stfg_mbox13', $q);
		$this->db->or_like('stfg_mbox14', $q);
		$this->db->or_like('stfg_mbox15', $q);
		$this->db->or_like('stfg_rijek', $q);
		$this->db->or_like('stfg_total', $q);
		$this->db->or_like('stfg_upah', $q);
		$this->db->or_like('stfg_userinput', $q);
		$this->db->or_like('stfg_tglinput', $q);
        $this->db->group_end();

        if(!empty($s)){
            $this->db->group_start();
            $this->db->or_where('stfg_shift',$s);
            $this->db->group_end();
         }


        if(!empty($t)){
            $this->db->group_start();
            $this->db->or_where('stfg_tgllaporan',$t);
            $this->db->group_end();
         }

		$this->db->from($this->tables);
        return $this->db->count_all_results();
    }


    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('stfg_id', $q);
		$this->db->or_like('stfg_produk_id', $q);
		$this->db->or_like('stfg_mbox1', $q);
		$this->db->or_like('stfg_mbox2', $q);
		$this->db->or_like('stfg_mbox3', $q);
		$this->db->or_like('stfg_mbox4', $q);
		$this->db->or_like('stfg_mbox5', $q);
		$this->db->or_like('stfg_mbox6', $q);
		$this->db->or_like('stfg_mbox7', $q);
		$this->db->or_like('stfg_mbox8', $q);
		$this->db->or_like('stfg_mbox9', $q);
		$this->db->or_like('stfg_mbox10', $q);
		$this->db->or_like('stfg_mbox11', $q);
		$this->db->or_like('stfg_mbox12', $q);
		$this->db->or_like('stfg_mbox13', $q);
		$this->db->or_like('stfg_mbox14', $q);
		$this->db->or_like('stfg_mbox15', $q);
		$this->db->or_like('stfg_rijek', $q);
		$this->db->or_like('stfg_total', $q);
		$this->db->or_like('stfg_upah', $q);
		$this->db->or_like('stfg_userinput', $q);
		$this->db->or_like('stfg_tglinput', $q);
		$this->db->limit($limit, $start);




        return $this->db->get($this->table)->result();
    }


    public function tampil_data($limit, $start = 0, $q = NULL, $xusername, $id_group, $s= NULL, $t= NULL){
     
        if(!empty($xusername)){
            if($id_group=='2'){
                $this->db->group_start();
                $this->db->or_where('stfg_userinput',$xusername);
                $this->db->group_end(); 
                    }elseif($id_group=='5') {
                        $this->db->group_start();
                        $this->db->or_where('stfg_usersupervisor',$xusername);
                        $this->db->group_end(); 
                    }                
        }            
        $this->db->group_start();
        $this->db->like('stfg_id', $q);
        $this->db->or_like('stfg_produk_id', $q);
        $this->db->or_like('produk_nama', $q);
		$this->db->or_like('stfg_mbox1', $q);
		$this->db->or_like('stfg_mbox2', $q);
		$this->db->or_like('stfg_mbox3', $q);
		$this->db->or_like('stfg_mbox4', $q);
		$this->db->or_like('stfg_mbox5', $q);
		$this->db->or_like('stfg_mbox6', $q);
		$this->db->or_like('stfg_mbox7', $q);
		$this->db->or_like('stfg_mbox8', $q);
		$this->db->or_like('stfg_mbox9', $q);
		$this->db->or_like('stfg_mbox10', $q);
		$this->db->or_like('stfg_mbox11', $q);
		$this->db->or_like('stfg_mbox12', $q);
		$this->db->or_like('stfg_mbox13', $q);
		$this->db->or_like('stfg_mbox14', $q);
		$this->db->or_like('stfg_mbox15', $q);
		$this->db->or_like('stfg_total', $q);
		$this->db->or_like('stfg_rijek', $q);
        $this->db->group_end();

        if(!empty($s)){
            $this->db->group_start();
            $this->db->or_where('stfg_shift',$s);
            $this->db->group_end();
         }


        if(!empty($t)){
            $this->db->group_start();
            $this->db->or_where('stfg_tgllaporan',$t);
            $this->db->group_end();
         }

        $this->db->order_by('stfg_tglinput', 'DESC');
        $this->db->limit($limit, $start);
        return $this->db->get($this->tables)->result();
    }

    public function download_stfg($xuser,$call_date,$xid_group){
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
        $this->db->from('trx_stfg');
        $this->db->join('stx_produk','stx_produk.produk_id=trx_stfg.stfg_produk_id');
        
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

    
    function updateupah($yid, $ydata)
    {
        $this->db->where($this->yid, $yid);
        $this->db->update($this->trx_mesin, $ydata);
    }


    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}
