<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trx_gl_model extends CI_Model
{

    public $table = 'trx_master';
    public $id = 'master_id';
    public $order = 'DESC';
    public $tabmaster = 'trx_master';
    public $trxdetail = 'trx_masterdetail';
    public $tables = 'view_master';


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
    
    function total_rows($q = NULL, $xusername, $id_group, $s= NULL, $t= NULL) {

        if(!empty($xusername)){
            if($id_group=='5'){
                $this->db->group_start();
                $this->db->or_where('master_usersupervisor',$xusername);
                $this->db->group_end(); 
                    }elseif($id_group=='5') {
                        $this->db->group_start();
                        $this->db->or_where('master_usersupervisor',$xusername);
                        $this->db->group_end(); 
                    } 
        } 
        
        $this->db->group_start();
        $this->db->like('master_id', $q);
        $this->db->or_like('master_module_id', $q);
        $this->db->or_like('produk_nama', $q);
        $this->db->or_like('module_nama', $q);
        $this->db->or_like('master_nomesin', $q);
        $this->db->or_like('master_jumlahteam', $q);
        $this->db->or_like('master_display', $q);
        $this->db->or_like('master_box', $q);
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
	$this->db->or_like('master_shift', $s);
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
                $this->db->or_where('master_userinput',$xusername);
                $this->db->group_end(); 
                    }elseif($id_group=='5') {
                        $this->db->group_start();
                        $this->db->or_where('master_usersupervisor',$xusername);
                        $this->db->group_end(); 
                    }                
        }        
       
        $this->db->group_start();
        $this->db->like('master_id', $q);
        $this->db->or_like('master_module_id', $q);
        $this->db->or_like('produk_nama', $q);
        $this->db->or_like('module_nama', $q);
        $this->db->or_like('master_nomesin', $q);
        $this->db->or_like('master_jumlahteam', $q);
        $this->db->or_like('master_display', $q);
        $this->db->or_like('master_box', $q);
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

        $this->db->order_by('master_tgllaporan','DESC');
        $this->db->limit($limit, $start);
        return $this->db->get($this->tables)->result();
    }

    public function download_master($xuser,$call_date,$xid_group){
        $val=explode('-', $call_date);
        $tgl_awal=$val[0] ."-" .$val[1] ."-" .$val[2];
        $tgl_akhir=$val[3] ."-" .$val[4] ."-" .$val[5]; 

        $this->db->select('
                    master_id AS master_id,
                    master_module_id AS master_module_id,
                    master_tgllaporan AS master_tgllaporan,
                    master_shift AS master_shift,
                    master_acuan_id AS master_acuan_id,
                    master_produk_id AS master_produk_id,
                    master_line AS master_line,
                    master_nomesin AS master_nomesin,
                    master_jumlahteam AS master_jumlahteam,
                    master_display AS master_display,
                    master_box AS master_box,
                    master_jumlahstiker AS master_jumlahstiker,
                    master_istirahat AS master_istirahat,
                    master_totalkerjamenit AS master_totalkerjamenit,
                    master_totalkerjajam AS master_totalkerjajam,
                    master_karu AS master_karu,
                    master_stfg AS master_stfg,
                    master_bayarstfg AS master_bayarstfg,
                    master_acuanmesin AS master_acuanmesin,
                    master_acuanline AS master_acuanline,
                    master_usersupervisor AS master_usersupervisor,
                    master_userinput AS master_userinput,
                    master_tglinput AS master_tglinput');
        $this->db->from('trx_master');
        
        if(!empty($xuser)) {
            if ($xid_group =='2') {
                $this->db->where('master_userinput',$xuser);
            }elseif($xid_group =='5') {
                $this->db->where('master_usersupervisor',$xuser);

            }
        }
        $this->db->where( 'master_tgllaporan BETWEEN "' .$tgl_awal. '" and "' .$tgl_akhir .'"');

        $this->db->order_by('master_tgllaporan');
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


    function deleteDetail($detailid)
    {
        $this->db->where('masterdetail_id', $detailid);
        $this->db->delete($this->trxdetail);
    }


    function deletemodule($xdata, $detailid, $value)
    {
        $this->db->where($detailid, $value);
        $this->db->delete($this->xdata);
    }

}

/* End of file Trx_master_model.php */
/* Location: ./application/models/Trx_master_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-04 14:45:35 */
/* http://harviacode.com */
