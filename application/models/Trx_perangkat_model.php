<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trx_perangkat_model extends CI_Model
{

    public $table = 'trx_perangkat';
    public $id = 'perangkat_id';
    public $order = 'DESC';
    public $module = '7';
    public $tabmaster = 'trx_master';
    public $trxdetail = 'trx_masterdetail';
    public $tables = 'view_perangkat';

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
    

    function pangkatid($table,$field,$key,$key_value)
    {
    $this->db->select($field . " as perangkatztotal");
    $this->db->from($table);
    $this->db->where($key,$key_value);
    $data = $this->db->get();
    if ($data->num_rows() > 0) {
        return $data->row()->perangkatztotal;
    }
    else {
        return '';
    }

    }


        function perangkatcount($field,$value1, $value2, $value3)
    {
        $this->db->select("COUNT(".$field.") as perangaktxxtotal");
        $this->db->from('trx_perangkat');
        $this->db->where('perangkat_shift',$value1);
        $this->db->where('perangkat_tgllaporan',$value2);
        $this->db->where('perangkat_master_id',$value3);
        return $this->db->get()->row()->perangaktxxtotal;

    }

    function sumperangkat($field,$value1, $value2, $value3)
    {
        $this->db->select("SUM(".$field.") as sumperangkattotal");
        $this->db->from('trx_master');
        $this->db->where('master_usersupervisor',$value1);
        $this->db->where('master_shift',$value2);
        $this->db->where('master_tgllaporan',$value3);
        $this->db->where('master_module_id <> 7');
        return $this->db->get()->row()->sumperangkattotal;

    }


    function countperangkattrx($field,$value1, $value2, $value3)
    {
        $this->db->select("COUNT(DISTINCT(".$field.")) as sumperangkattrxtotal");
        $this->db->from('view_transaksi');
        $this->db->where('masterdetail_usersupervisor',$value1);
        $this->db->where('master_shift',$value2);
        $this->db->where('master_tgllaporan',$value3);
        $this->db->where('master_module_id <> 7');
        return $this->db->get()->row()->sumperangkattrxtotal;

    }

    function perangkatxcount($field,$value1, $value2, $value3)
    {
        $this->db->select("COUNT(".$field.") as perangkatxxtotal");
        $this->db->from('trx_perangkat');
        $this->db->where('perangkat_shift',$value1);
        $this->db->where('perangkat_tgllaporan',$value2);
        $this->db->where('perangkat_master_id',$value3);
        return $this->db->get()->row()->perangkatxxtotal;

    }

    public function gettrxmaster($value1, $value2, $value3){
        $this->db->select('*');
        $this->db->from('trx_perangkat');
        $this->db->where('perangkat_master_id',$value1);
        $this->db->where('perangkat_tgllaporan',$value2);
        $this->db->where('perangkat_shift',$value3);
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }

    public function gettrxperangat($value1, $value2, $value3){
        $this->db->select('*');
        $this->db->from('trx_master');
        $this->db->where('master_usersupervisor',$value1);        
        $this->db->where('master_shift',$value2);
        $this->db->where('master_tgllaporan',$value3);
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }

    function batchInsert($data, $codeid, $xupah ,$username,$usersupervisor ){
        //get bill entries 
        $count = count($data['count']);     
        for($i = 0; $i<$count; $i++){
            $pangkat = $this->Trx_perangkat_model->pangkatid('trx_karyawan','karyawan_jabatan_id','karyawan_id', $data['jperangkat_karyawan_id'][$i]);
            if ($pangkat) {
            $xentries[] = array(
                'perangkat_karyawan_id'=>$data['jperangkat_karyawan_id'][$i],
                'perangkat_master_id'=>$codeid,
                'perangkat_tgllaporan'=>$data['jperangkat_tgllaporan'],
                'perangkat_shift'=>$data['jperangkat_shift'],
                'perangkat_upah'=>$xupah,
                'perangkat_usersupervisor'=>$usersupervisor,
                'perangkat_userinput'=>$username,
                'perangkat_tglinput'=>date('Y-m-d'),                
                );

            $yentries[] = array(
                'masterdetail_karyawan_id'=>$data['jperangkat_karyawan_id'][$i],                
                'masterdetail_master_id'=>$codeid,
                'masterdetail_upah'=>$xupah,
                'masterdetail_usersupervisor' =>$usersupervisor,
                'masterdetail_userinput'=>$username,
                'masterdetail_tglinput'=>date('Y-m-d'),                
            ); 
            
            }
        }
        $this->db->insert_batch('trx_perangkat', $xentries);
        $this->db->insert_batch('trx_masterdetail', $yentries);  
        if($this->db->affected_rows() > 0)
            return 1;

        else
            return 0;
            redirect(site_url('trx_perangkat/create'));
        }

    // get total rows
    function total_rows($q = NULL, $xusername, $id_group, $s= NULL, $t= NULL) {
        $supervisor=$this->session->userdata('user_supervisor');

        if(!empty($xusername)){
            if($id_group=='2'){
                $this->db->group_start();
                $this->db->or_where('perangkat_userinput',$xusername);
                $this->db->group_end(); 
                    }elseif(($id_group=='5') or ($id_group=='6')) {
                        $this->db->group_start();
                        $this->db->or_where('perangkat_usersupervisor',$supervisor);
                        $this->db->group_end(); 
                    } 
        }      
        $this->db->group_start();
        $this->db->like('perangkat_id', $q);
    	$this->db->or_like('perangkat_karyawan_id', $q);
        $this->db->or_like('karyawan_nama', $q);
    	$this->db->or_like('perangkat_master_id', $q);
    	$this->db->or_like('perangkat_upah', $q);
    	$this->db->or_like('perangkat_userinput', $q);
    	$this->db->or_like('perangkat_tglinput', $q);
        $this->db->group_end();

        if(!empty($s)){
            $this->db->group_start();
            $this->db->or_where('perangkat_shift',$s);
            $this->db->group_end();
         }


        if(!empty($t)){
            $this->db->group_start();
            $this->db->or_where('perangkat_tgllaporan',$t);
            $this->db->group_end();
         }
    	
        $this->db->from($this->tables);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('perangkat_id', $q);
    	$this->db->or_like('perangkat_karyawan_id', $q);
    	$this->db->or_like('perangkat_shift', $q);
    	$this->db->or_like('perangkat_master_id', $q);
    	$this->db->or_like('perangkat_upah', $q);
    	$this->db->or_like('perangkat_tgllaporan', $q);
    	$this->db->or_like('perangkat_userinput', $q);
    	$this->db->or_like('perangkat_tglinput', $q);
    	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }


    public function tampil_data($limit, $start = 0, $q = NULL, $xusername, $id_group, $s= NULL, $t= NULL){
    
    $supervisor=$this->session->userdata('user_supervisor');
        if(!empty($xusername)){
            if($id_group=='2'){
                $this->db->group_start();
                $this->db->or_where('perangkat_userinput',$xusername);
                $this->db->group_end(); 
                    }elseif(($id_group=='5') or ($id_group=='6')) {
                        $this->db->group_start();
                        $this->db->or_where('perangkat_usersupervisor',$supervisor);
                        $this->db->group_end(); 
                    }                
        }        
              
        $this->db->group_start();
        $this->db->like('perangkat_id', $q);
        $this->db->or_like('perangkat_karyawan_id', $q);
        $this->db->or_like('karyawan_nama', $q);
        $this->db->or_like('perangkat_master_id', $q);
        $this->db->or_like('perangkat_upah', $q);
        $this->db->group_end();

        if(!empty($s)){
            $this->db->group_start();
            $this->db->or_where('perangkat_shift',$s);
            $this->db->group_end();
         }


        if(!empty($t)){
            $this->db->group_start();
            $this->db->or_where('perangkat_tgllaporan',$t);
            $this->db->group_end();
         }


        $this->db->order_by('perangkat_tglinput','DESC');
        $this->db->limit($limit, $start);
        return $this->db->get($this->tables)->result();
    }
    
    public function download_perangkat($xuser,$call_date,$xid_group){
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
        $this->db->from('trx_perangkat');
        $this->db->join('trx_karyawan','trx_karyawan.karyawan_id = trx_perangkat.perangkat_karyawan_id','left');
        
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

/* End of file Trx_perangkat_model.php */
/* Location: ./application/models/Trx_perangkat_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-16 19:35:17 */
/* http://harviacode.com */
