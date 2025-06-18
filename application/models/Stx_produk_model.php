<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stx_produk_model extends CI_Model
{

    public $table = 'stx_produk';
    public $id = 'produk_id';
    public $order = 'DESC';

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
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
     function total_rows($q = NULL, $supervisor, $id_group) {
        if(!empty($supervisor)){
            if($id_group=='2'){
                $this->db->group_start();
                $this->db->or_where('produk_usersupervisor',$supervisor);
                $this->db->group_end(); 
                    }
                    
                    /*elseif($id_group=='5') {
                        $this->db->group_start();
                        $this->db->or_where('produk_usersupervisor',$supervisor);
                        $this->db->group_end(); 
                    } */                
        }
                $this->db->group_start();
                $this->db->like('produk_id', $q);
            	$this->db->or_like('produk_kategori_id', $q);
            	$this->db->or_like('produk_nama', $q);
            	$this->db->or_like('produk_tipe', $q);
            	$this->db->or_like('produk_masterbox', $q);
            	$this->db->or_like('produk_mesin', $q);
            	$this->db->or_like('produk_mbox', $q);
            	$this->db->or_like('produk_susun', $q);
            	$this->db->or_like('produk_manual', $q);
            	$this->db->or_like('produk_wip', $q);
            	$this->db->or_like('produk_pp', $q);
            	$this->db->or_like('produk_step_final', $q);
            	$this->db->or_like('produk_userinput', $q);
            	$this->db->or_like('produk_tglinput', $q);
            	$this->db->or_like('produk_status', $q);
                $this->db->group_end();
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function tampil_data($limit, $start = 0, $q = NULL, $supervisor, $id_group){
     
        if(!empty($supervisor)){
            if($id_group=='2'){
                $this->db->group_start();
                $this->db->or_where('produk_usersupervisor',$supervisor);
                $this->db->group_end(); 
                    }
                    
                    elseif($id_group=='5') {
                        $this->db->group_start();
                        $this->db->or_where('produk_usersupervisor',$supervisor);
                        $this->db->group_end(); 
                    }                
        }             
        $this->db->group_start();
            $this->db->like('produk_id', $q);
            $this->db->or_like('produk_kategori_id', $q);
            $this->db->or_like('produk_nama', $q);
            $this->db->or_like('produk_tipe', $q);
            $this->db->or_like('produk_masterbox', $q);
            $this->db->or_like('produk_mesin', $q);
            $this->db->or_like('produk_mbox', $q);
            $this->db->or_like('produk_susun', $q);
            $this->db->or_like('produk_manual', $q);
            $this->db->or_like('produk_wip', $q);
            $this->db->or_like('produk_pp', $q);
            $this->db->or_like('produk_status', $q);
        $this->db->group_end();


        $this->db->order_by('produk_tglinput','DESC');
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }


    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('produk_id', $q);
	$this->db->or_like('produk_kategori_id', $q);
	$this->db->or_like('produk_nama', $q);
	$this->db->or_like('produk_tipe', $q);
	$this->db->or_like('produk_masterbox', $q);
	$this->db->or_like('produk_mesin', $q);
	$this->db->or_like('produk_mbox', $q);
	$this->db->or_like('produk_susun', $q);
	$this->db->or_like('produk_manual', $q);
	$this->db->or_like('produk_wip', $q);
	$this->db->or_like('produk_pp', $q);
	$this->db->or_like('produk_step_final', $q);
	$this->db->or_like('produk_userinput', $q);
	$this->db->or_like('produk_tglinput', $q);
	$this->db->or_like('produk_status', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    public function download_produk($xuser,$call_date,$xid_group){
        $val=explode('-', $call_date);
        $tgl_awal=$val[0] ."-" .$val[1] ."-" .$val[2];
        $tgl_akhir=$val[3] ."-" .$val[4] ."-" .$val[5]; 

        $this->db->select('produk_id, produk_kategori_id, produk_nama, produk_tipe, produk_masterbox, produk_mesin, produk_mbox, produk_susun, produk_manual, produk_wip, produk_pp, produk_step_final, produk_rijek_wip, produk_rijek_stfg, produk_bongkar_rijek,produk_usersupervisor, produk_userinput, produk_tglinput, produk_status');
        $this->db->from('stx_produk');
        
        if(!empty($xuser)) {
            if ($xid_group =='2') {
                $this->db->where('produk_userinput',$xuser);
            }elseif($xid_group =='5') {
                $this->db->where('produk_usersupervisor',$xuser);

            }
        }
        $this->db->where( 'produk_tglinput BETWEEN "' .$tgl_awal. '" and "' .$tgl_akhir .'"');

        $this->db->order_by('produk_tglinput');
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

/* End of file Stx_produk_model.php */
/* Location: ./application/models/Stx_produk_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-04 14:45:35 */
/* http://harviacode.com */
