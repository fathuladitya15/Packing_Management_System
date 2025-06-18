<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trx_stiker_model extends CI_Model
{

    public $table = 'trx_stiker';
    public $id = 'stiker_id';
    public $order = 'DESC';
    public $module = '4';
    public $tabmaster = 'trx_master';
    public $trxdetail = 'trx_masterdetail';
    public $tables = 'view_stiker';

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


    function stikercount($field,$value1, $value2, $value3, $value4)
    {
        $this->db->select("COUNT(".$field.") as stikerxxtotal");
        $this->db->from('trx_stiker');
        $this->db->where('stiker_produk_id',$value1);
        $this->db->where('stiker_shift',$value2);
        $this->db->where('stiker_tgllaporan',$value3);
        $this->db->where('stiker_master_id',$value4);
        return $this->db->get()->row()->stikerxxtotal;

    }

    function sumstiker($field,$value1, $value2, $value3,$value4)
    {
        $this->db->select("SUM(".$field.") as sumstikertotal");
        $this->db->from('trx_stiker');
        $this->db->where('stiker_usersupervisor',$value1);
        $this->db->where('stiker_shift',$value2);
        $this->db->where('stiker_tgllaporan',$value3);
        $this->db->where('stiker_master_id',$value4);
        return $this->db->get()->row()->sumstikertotal;

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

    
    function countstiker($field,$value1, $value2, $value3)
    {
        $this->db->select("COUNT(".$field.") as stikerxtotal");
        $this->db->from('trx_stiker');
        $this->db->where('stiker_produk_id',$value1);
        $this->db->where('stiker_tgllaporan',$value2);
        $this->db->where('stiker_shift',$value3);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->row()->stikerxtotal;
        }
        else {
            return '';
        }

    }


    // get total rows
    function total_rows($q = NULL, $xusername, $id_group, $s= NULL, $t= NULL) {
    $supervisor=$this->session->userdata('user_supervisor');
        if(!empty($xusername)){
            if($id_group=='2'){
                $this->db->group_start();
                $this->db->or_where('stiker_userinput',$xusername);
                $this->db->group_end(); 
                    }elseif(($id_group=='5') or ($id_group=='6')) {
                        $this->db->group_start();
                        $this->db->or_where('stiker_usersupervisor',$supervisor);
                        $this->db->group_end(); 
                    } 
        }      
        $this->db->group_start();
        $this->db->like('stiker_id', $q);
    	$this->db->or_like('stiker_karyawan_id', $q);
    	$this->db->or_like('stiker_produk_id', $q);
        $this->db->or_like('karyawan_nama', $q);
        $this->db->or_like('produk_nama', $q);
    	$this->db->or_like('stiker_kategori', $q);
    	$this->db->or_like('stiker_jumlahstiker', $q);
        $this->db->or_like('stiker_jumlahteam', $q);
    	$this->db->or_like('stiker_upah', $q);
    	$this->db->or_like('stiker_userinput', $q);
    	$this->db->or_like('stiker_tglinput', $q);
        $this->db->group_end();

        if(!empty($s)){
            $this->db->group_start();
            $this->db->or_where('stiker_shift',$s);
            $this->db->group_end();
         }


        if(!empty($t)){
            $this->db->group_start();
            $this->db->or_where('stiker_tgllaporan',$t);
            $this->db->group_end();
         }
    	
        $this->db->from($this->tables);
        return $this->db->count_all_results();
    }


    public function tampil_data($limit, $start = 0, $q = NULL, $xusername, $id_group, $s= NULL, $t= NULL){
    $supervisor=$this->session->userdata('user_supervisor'); 
        if(!empty($xusername)){
            if($id_group=='2'){
                $this->db->group_start();
                $this->db->or_where('stiker_userinput',$xusername);
                $this->db->group_end(); 
                     }elseif(($id_group=='5') or ($id_group=='6')) {
                        $this->db->group_start();
                        $this->db->or_where('stiker_usersupervisor',$supervisor);
                        $this->db->group_end(); 
                    }                
        }        
       
        $this->db->group_start();
        $this->db->like('stiker_id', $q);
        $this->db->or_like('stiker_karyawan_id', $q);
        $this->db->or_like('stiker_produk_id', $q);
        $this->db->or_like('karyawan_nama', $q);
        $this->db->or_like('produk_nama', $q);
        $this->db->or_like('stiker_kategori', $q);
        $this->db->or_like('stiker_jumlahstiker', $q);
        $this->db->or_like('stiker_jumlahteam', $q);
        $this->db->or_like('stiker_upah', $q);
        $this->db->group_end();


        if(!empty($s)){
            $this->db->group_start();
            $this->db->or_where('stiker_shift',$s);
            $this->db->group_end();
         }


        if(!empty($t)){
            $this->db->group_start();
            $this->db->or_where('stiker_tgllaporan',$t);
            $this->db->group_end();
         }

        $this->db->order_by('stiker_id','DESC');
        $this->db->limit($limit, $start);
        return $this->db->get($this->tables)->result();
    }


    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('stiker_id', $q);
    	$this->db->or_like('stiker_karyawan_id', $q);
    	$this->db->or_like('stiker_produk_id', $q);
    	$this->db->or_like('stiker_kategori', $q);
    	$this->db->or_like('stiker_shift', $q);
    	$this->db->or_like('stiker_jumlahstiker', $q);
        $this->db->or_like('stiker_jumlahteam', $q);
    	$this->db->or_like('stiker_upah', $q);
    	$this->db->or_like('stiker_tgllaporan', $q);
    	$this->db->or_like('stiker_userinput', $q);
    	$this->db->or_like('stiker_tglinput', $q);
    	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }



    function batchInsert($data, $codeid, $upah, $stiker,$username, $usersupervisor){
        //get bill entries 
        $count = count($data['count']); 
        for($i = 0; $i<$count; $i++){
            $xentries[] = array(
                'stiker_karyawan_id'=>$data['jstiker_karyawan_id'][$i],
                'stiker_master_id'=>$codeid,
                'stiker_produk_id'=>$data['stiker_produk_id'],               
                'stiker_kategori'=>$stiker,
                'stiker_shift'=>$data['stiker_shift'],
                'stiker_jumlahstiker'=>$data['stiker_jumlahstiker'],
                'stiker_jumlahteam'=>$count,
                'stiker_tgllaporan'=>$data['stiker_tgllaporan'],
                'stiker_upah'=>floor($upah),
                'stiker_usersupervisor'=>$usersupervisor,
                'stiker_userinput'=>$username,
                'stiker_tglinput'=>date('Y-m-d'),
                
                );

            $yentries[] = array(
                'masterdetail_karyawan_id'=>$data['jstiker_karyawan_id'][$i],                
                'masterdetail_master_id'=>$codeid,
                'masterdetail_jumlahstiker'=>$data['stiker_jumlahstiker'],
                'masterdetail_upah'=>floor($upah),
                'masterdetail_usersupervisor'=>$usersupervisor,
                'masterdetail_userinput'=>$username,
                'masterdetail_tglinput'=>date('Y-m-d'),                
                ); 
        }
        $this->db->insert_batch('trx_stiker', $xentries);
        $this->db->insert_batch('trx_masterdetail', $yentries);  
        if($this->db->affected_rows() > 0)
            return 1;

        else
            return 0;
            redirect(site_url('trx_stiker/create'));
        }



    public function download_stiker($xuser,$call_date,$xid_group){
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
        $this->db->from('trx_stiker');
        $this->db->join('trx_karyawan','trx_karyawan.karyawan_id = trx_stiker.stiker_karyawan_id','left');
        $this->db->join('stx_produk','stx_produk.produk_id=trx_stiker.stiker_produk_id');
        
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

/* End of file Trx_stiker_model.php */
/* Location: ./application/models/Trx_stiker_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-04 14:45:35 */
/* http://harviacode.com */
