<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trx_susun_model extends CI_Model
{

    public $table = 'trx_susun';
    public $id = 'susun_id';
    public $order = 'DESC';
    public $module = '5';
    public $tabmaster = 'trx_master';
    public $trxdetail = 'trx_masterdetail';
    public $tables = 'view_susun';

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


    function susuncount($field,$value1, $value2, $value3, $value4)
    {
        $this->db->select("COUNT(".$field.") as susunxxtotal");
        $this->db->from('trx_susun');
        $this->db->where('susun_produk_id',$value1);
        $this->db->where('susun_shift',$value2);
        $this->db->where('susun_tgllaporan',$value3);
        $this->db->where('susun_master_id',$value4);
        return $this->db->get()->row()->susunxxtotal;

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

    function sumsusun($field,$value1, $value2, $value3,$value4)
    {
        $this->db->select("SUM(".$field.") as sumtotal");
        $this->db->from('trx_susun');
        $this->db->where('susun_usersupervisor',$value1);
        $this->db->where('susun_shift',$value2);
        $this->db->where('susun_tgllaporan',$value3);
        $this->db->where('susun_master_id',$value4);
        return $this->db->get()->row()->sumtotal;

    }

    function batchInsert($data, $codeid ,$harga,$username,$usersupervisor ){
        //get bill entries 
        $count = count($data['count']);       
        for($i = 0; $i<$count; $i++){
            $totalkrat = ($data['jsusun_krat1'][$i] + $data['jsusun_krat2'][$i] +$data['jsusun_krat3'][$i] + $data['jsusun_krat4'][$i] + 
                         $data['jsusun_krat5'][$i] + $data['jsusun_krat6'][$i] + $data['jsusun_krat7'][$i] + $data['jsusun_krat8'][$i] + 
                         $data['jsusun_krat9'][$i] + $data['jsusun_krat10'][$i] + $data['jsusun_krat11'][$i] + $data['jsusun_krat12'][$i] + $data['jsusun_krat13'][$i] + 
                         $data['jsusun_krat14'][$i] + $data['jsusun_krat15'][$i]);
            $upah = floor($harga * $totalkrat);
            $xentries[] = array(
			    'susun_produk_id' => $data['jsusun_produk_id'],
			    'susun_karyawan_id' => $data['jsusun_karyawan_id'][$i],
			    'susun_master_id' => $codeid,
                'susun_shift' => $data['jsusun_shift'],			     	
			    'susun_krat1' => $data['jsusun_krat1'][$i],
			    'susun_krat2' => $data['jsusun_krat2'][$i],
			    'susun_krat3' => $data['jsusun_krat3'][$i],
			    'susun_krat4' => $data['jsusun_krat4'][$i],
			    'susun_krat5' => $data['jsusun_krat5'][$i],
			    'susun_krat6' => $data['jsusun_krat6'][$i],
			    'susun_krat7' => $data['jsusun_krat7'][$i],
			    'susun_krat8' => $data['jsusun_krat8'][$i],
			    'susun_krat9' => $data['jsusun_krat9'][$i],
			    'susun_krat10' => $data['jsusun_krat10'][$i],
                'susun_krat11' => $data['jsusun_krat11'][$i],
                'susun_krat12' => $data['jsusun_krat12'][$i],
                'susun_krat13' => $data['jsusun_krat13'][$i],
                'susun_krat14' => $data['jsusun_krat14'][$i],
                'susun_krat15' => $data['jsusun_krat15'][$i],
			    'susun_totalkrat' => $totalkrat,
			    'susun_upah' => $upah,
			    'susun_tgllaporan' => $data['jsusun_tgllaporan'],
                'susun_usersupervisor' => $usersupervisor,
			    'susun_userinput' => $username,
			    'susun_tglinput' => date('Y-m-d'),
                
                );

            $yentries[] = array(
                'masterdetail_karyawan_id'=>$data['jsusun_karyawan_id'][$i],                
                'masterdetail_master_id'=>$codeid,
                'masterdetail_jumlahkrat'=>$totalkrat,
                'masterdetail_upah'=>$upah,
                'masterdetail_usersupervisor'=>$usersupervisor,
                'masterdetail_userinput'=>$username,
                'masterdetail_tglinput'=>date('Y-m-d'),                
                ); 
        }
        $this->db->insert_batch('trx_susun', $xentries);
        $this->db->insert_batch('trx_masterdetail', $yentries); 
        if($this->db->affected_rows() > 0)
            return 1;
        else
            return 0;


        //$this->db->trans_start(TRUE);
        //$this->db->insert_batch('trx_susun', $xentries);
        //$this->db->insert_batch('trx_masterdetail', $yentries); 
        //$this->db->trans_complete();

/*
    if ($this->db->trans_status() === FALSE)
    {
            echo 0;
            $this->db->trans_rollback();
            $this->session->set_flashdata('message', 'Ada kesalahan , Mohon di cek kembali Transaksi Anda');
    }
    else
    {
            echo 1;
            $this->db->trans_commit();
            $this->session->set_flashdata('message', 'Create Record Success');
    }

*/





            redirect(site_url('trx_susun/create'));
    }

  

    // get total rows
    function total_rows($q = NULL, $xusername, $id_group, $s= NULL, $t= NULL) {
        $supervisor=$this->session->userdata('user_supervisor'); 
        if(!empty($xusername)){
            if($id_group=='2'){
                $this->db->group_start();
                $this->db->or_where('susun_userinput',$xusername);
                $this->db->group_end(); 
                    }elseif(($id_group=='5') or ($id_group=='6')) {
                        $this->db->group_start();
                        $this->db->or_where('susun_usersupervisor',$supervisor);
                        $this->db->group_end(); 
                    } 
        }      
        $this->db->group_start();
        $this->db->like('susun_id', $q);
		$this->db->or_like('susun_karyawan_id', $q);
		$this->db->or_like('susun_produk_id', $q);
        $this->db->or_like('produk_nama', $q);
        $this->db->or_like('karyawan_nama', $q);
		$this->db->or_like('susun_karu', $q);
		$this->db->or_like('susun_master_id', $q);
		$this->db->or_like('susun_krat15', $q);
		$this->db->or_like('susun_upah', $q);
		$this->db->or_like('susun_userinput', $q);
		$this->db->or_like('susun_tglinput', $q);
        $this->db->group_end();

        if(!empty($s)){
            $this->db->group_start();
            $this->db->or_where('susun_shift',$s);
            $this->db->group_end();
         }


        if(!empty($t)){
            $this->db->group_start();
            $this->db->or_where('susun_tgllaporan',$t);
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
                $this->db->or_where('susun_userinput',$xusername);
                $this->db->group_end(); 
                    }elseif(($id_group=='5') or ($id_group=='6')) {
                        $this->db->group_start();
                        $this->db->or_where('susun_usersupervisor',$supervisor);
                        $this->db->group_end(); 
                    }                
        }        
       
        $this->db->group_start();
            $this->db->like('susun_id', $q);
            $this->db->or_like('susun_karu', $q); 
            $this->db->or_like('susun_karyawan_id', $q);
            $this->db->or_like('susun_produk_id', $q);
            $this->db->or_like('produk_nama', $q);
            $this->db->or_like('karyawan_nama', $q);
            $this->db->or_like('susun_karu', $q); 
    		$this->db->or_like('susun_upah', $q);
        $this->db->group_end();

        if(!empty($s)){
            $this->db->group_start();
            $this->db->or_where('susun_shift',$s);
            $this->db->group_end();
         }


        if(!empty($t)){
            $this->db->group_start();
            $this->db->or_where('susun_tgllaporan',$t);
            $this->db->group_end();
         }

        $this->db->order_by('susun_id','DESC');
        $this->db->limit($limit, $start);
        return $this->db->get($this->tables)->result();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('susun_id', $q);
	$this->db->or_like('susun_karyawan_id', $q);
	$this->db->or_like('susun_produk_id', $q);
	$this->db->or_like('susun_karu', $q);
	$this->db->or_like('susun_master_id', $q);
    $this->db->or_like('susun_shift', $q);
	$this->db->or_like('susun_krat1', $q);
	$this->db->or_like('susun_krat2', $q);
	$this->db->or_like('susun_krat3', $q);
	$this->db->or_like('susun_krat4', $q);
	$this->db->or_like('susun_krat5', $q);
	$this->db->or_like('susun_krat6', $q);
	$this->db->or_like('susun_krat7', $q);
	$this->db->or_like('susun_krat8', $q);
	$this->db->or_like('susun_krat9', $q);
	$this->db->or_like('susun_krat10', $q);
	$this->db->or_like('susun_krat11', $q);
	$this->db->or_like('susun_krat12', $q);
	$this->db->or_like('susun_krat13', $q);
	$this->db->or_like('susun_krat14', $q);
	$this->db->or_like('susun_krat15', $q);
	$this->db->or_like('susun_totalkrat', $q);
	$this->db->or_like('susun_upah', $q);
	$this->db->or_like('susun_tgllaporan', $q);
	$this->db->or_like('susun_userinput', $q);
	$this->db->or_like('susun_tglinput', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }


    public function download_susun($xuser,$call_date,$xid_group){
        $val=explode('-', $call_date);
        $tgl_awal=$val[0] ."-" .$val[1] ."-" .$val[2];
        $tgl_akhir=$val[3] ."-" .$val[4] ."-" .$val[5]; 

        $this->db->select('`susun_id,susun_karyawan_id,susun_produk_id,susun_karu, susun_master_id,susun_krat1,susun_shift,susun_krat2,susun_krat3,    susun_krat4, susun_krat5,susun_krat6,susun_krat7,susun_krat8,susun_krat9,susun_krat10,susun_krat11,susun_krat12, susun_krat13,    susun_krat14,susun_krat15,susun_totalkrat,susun_upah,susun_tgllaporan,susun_usersupervisor,susun_userinput, susun_tglinput,trx_karyawan.karyawan_nama as karyawan_nama, stx_produk.produk_nama as produk_nama');
        $this->db->from('trx_susun');
        $this->db->join('trx_karyawan','trx_karyawan.karyawan_id = trx_susun.susun_karyawan_id','left');
        $this->db->join('stx_produk','stx_produk.produk_id=trx_susun.susun_produk_id');
        
        if(!empty($xuser)) {
            if ($xid_group =='2') {
                $this->db->where('susun_userinput',$xuser);
            }elseif($xid_group =='5') {
                $this->db->where('susun_usersupervisor',$xuser);

            }
        }
        $this->db->where( 'susun_tgllaporan BETWEEN "' .$tgl_awal. '" and "' .$tgl_akhir .'"');

        $this->db->order_by('susun_tgllaporan');
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
/* End of file Trx_susun_model.php */
/* Location: ./application/models/Trx_susun_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-16 19:35:36 */
/* http://harviacode.com */
