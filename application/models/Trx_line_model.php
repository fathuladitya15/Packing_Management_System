<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trx_line_model extends CI_Model
{

    public $table = 'trx_line';
    public $id = 'line_id';
    public $order = 'DESC';
    public $module = '2';
    public $tabmaster = 'trx_master';
    public $trxdetail = 'trx_masterdetail';
    public $tables = 'view_line';

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

   
    function linesum($field,$value1, $value2, $value3, $value4)
    {
        $this->db->select("SUM(".$field.") as lineaxtotal");
        $this->db->from('trx_line');
        $this->db->where('line_produk_id',$value1);
        $this->db->where('line_shift',$value2);
        $this->db->where('line_tgllaporan',$value3);
        $this->db->where('line_master_id',$value4);
        return $this->db->get()->row()->lineaxtotal;

    }

    function linecount($field,$value1, $value2, $value3, $value4)
    {
        $this->db->select("COUNT(".$field.") as linexxtotal");
        $this->db->from('trx_line');
        $this->db->where('line_produk_id',$value1);
        $this->db->where('line_shift',$value2);
        $this->db->where('line_tgllaporan',$value3);
        $this->db->where('line_master_id',$value4);
        return $this->db->get()->row()->linexxtotal;

    }

    public function gettrxmaster($value1, $value2, $value3, $value4, $value5){
        $this->db->select('*');
        $this->db->from('trx_master');
        $this->db->where('master_produk_id',$value1);
        $this->db->where('master_tgllaporan',$value2);
        $this->db->where('master_shift',$value3);
        $this->db->where('master_module_id',$value4);
        $this->db->where('master_id',$value5);

        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }

  


    public function tampil_data($limit, $start = 0, $q = NULL, $xusername, $id_group,$s= NULL, $t= NULL){
      $supervisor=$this->session->userdata('user_supervisor');
        if(!empty($xusername)){
            if($id_group=='2'){
                $this->db->group_start();
                $this->db->or_where('line_userinput',$xusername);
                $this->db->group_end(); 
                    }elseif(($id_group=='5') or ($id_group=='6')) {
                        $this->db->group_start();
                        $this->db->or_where('line_usersupervisor',$supervisor);
                        $this->db->group_end(); 
                    }                
        }             
        $this->db->group_start();
        $this->db->like('line_id', $q);
        $this->db->or_like('line_karyawan_id', $q);
        $this->db->or_like('line_produk_id', $q);
        $this->db->or_like('produk_nama', $q);
        $this->db->or_like('line_master_id', $q);
        $this->db->or_like('karyawan_nama', $q);
        $this->db->or_like('produk_nama', $q);
        $this->db->or_like('line_master_id', $q);
        $this->db->or_like('line_box', $q);
        $this->db->group_end();

        if(!empty($s)){
            $this->db->group_start();
            $this->db->or_where('line_shift',$s);
            $this->db->group_end();
         }


        if(!empty($t)){
            $this->db->group_start();
            $this->db->or_where('line_tgllaporan',$t);
            $this->db->group_end();
         }

        $this->db->order_by('line_id','DESC');
        $this->db->limit($limit, $start);
        return $this->db->get($this->tables)->result();
    }

    // get total rows
    function total_rows($q = NULL, $xusername, $id_group,$s= NULL, $t= NULL) {
$supervisor=$this->session->userdata('user_supervisor');
        if(!empty($xusername)){
            if($id_group=='2'){
                $this->db->group_start();
                $this->db->or_where('line_userinput',$xusername);
                $this->db->group_end(); 
                    }elseif(($id_group=='5') or ($id_group=='6')) {
                        $this->db->group_start();
                        $this->db->or_where('line_usersupervisor',$supervisor);
                        $this->db->group_end(); 
                    } 
        }  

        $this->db->group_start();
        $this->db->like('line_id', $q);
    	$this->db->or_like('line_karyawan_id', $q);
    	$this->db->or_like('line_produk_id', $q);
        $this->db->or_like('produk_nama', $q);
    	$this->db->or_like('line_nomor', $q);
    	$this->db->or_like('line_box', $q);
        $this->db->or_like('line_upah', $q);
    	$this->db->or_like('line_userinput', $q);
    	$this->db->or_like('line_tglinput', $q);
        $this->db->group_end();

        if(!empty($s)){
            $this->db->group_start();
            $this->db->or_where('line_shift',$s);
            $this->db->group_end();
         }


        if(!empty($t)){
            $this->db->group_start();
            $this->db->or_where('line_tgllaporan',$t);
            $this->db->group_end();
         }




    	$this->db->from($this->tables);
        return $this->db->count_all_results();
    }



    public function download_line($xuser,$call_date,$xid_group){
        $val=explode('-', $call_date);
        $tgl_awal=$val[0] ."-" .$val[1] ."-" .$val[2];
        $tgl_akhir=$val[3] ."-" .$val[4] ."-" .$val[5]; 

        $this->db->select('line_id,line_master_id,line_karyawan_id,line_produk_id,line_nomor, line_shift, line_box, line_mulai, line_selesai, line_istirahat,  line_totalmenit, line_tgllaporan, line_upah, line_userinput,line_usersupervisor, line_tglinput,trx_karyawan.karyawan_nama as karyawan_nama, stx_produk.produk_nama as produk_nama');
        $this->db->from('trx_line');
        $this->db->join('trx_karyawan','trx_karyawan.karyawan_id = trx_line.line_karyawan_id','left');
        $this->db->join('stx_produk','stx_produk.produk_id=trx_line.line_produk_id');
        
        if(!empty($xuser)) {
            if ($xid_group =='2') {
                $this->db->where('line_userinput',$xuser);
            }elseif($xid_group =='5') {
                $this->db->where('line_usersupervisor',$xuser);

            }
        }
        $this->db->where( 'line_tgllaporan BETWEEN "' .$tgl_awal. '" and "' .$tgl_akhir .'"');

        $this->db->order_by('line_tgllaporan');
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }

    function batchInsert($data, $codeid, $username, $usersupervisor){
        //get bill entries 
        $count = count($data['count']); 
        $username=$this->session->userdata('username');
        $usersupervisor=$this->session->userdata('user_supervisor');          
        for($i = 0; $i<$count; $i++){
            
            if (strtotime($data['jline_mulai'][$i]) > strtotime($data['jline_selesai'][$i])) {
                $tengah  ="24:00";
                $noll  ="00:00";
                $ztotalkerja = ((abs((strtotime($noll) - strtotime($data['jline_selesai'][$i])))/60) + ((strtotime($tengah) - strtotime($data['jline_mulai'][$i]))/60));
                $ztotal = $ztotalkerja - $data['jline_istirahat'][$i];
                }else {
                    $ztotalkerja = (strtotime($data['jline_selesai'][$i]) -  strtotime($data['jline_mulai'][$i]))/60;
                    $ztotal = $ztotalkerja - $data['jline_istirahat'][$i];
                }
            
            $xentries[] = array(
                'line_karyawan_id'=>$data['jline_karyawan_id'][$i],
                'line_master_id'=>$codeid,
                'line_tgllaporan'=>$data['line_tgllaporan'],
                'line_produk_id'=>$data['line_produk_id'],
                'line_nomor'=>$data['line_nomor'],
                'line_box'=>$data['line_box'],
                'line_shift'=>$data['line_shift'],
                'line_mulai'=>$data['jline_mulai'][$i],
                'line_selesai'=>$data['jline_selesai'][$i],
                'line_totalmenit'=>$ztotal,
                'line_istirahat'=>$data['jline_istirahat'][$i],
                'line_usersupervisor' => $usersupervisor,
                'line_userinput'=>$username,
                'line_tglinput'=>date('Y-m-d'),
                
                );

            $yentries[] = array(
                'masterdetail_karyawan_id'=>$data['jline_karyawan_id'][$i],
                'masterdetail_mulai'=>$data['jline_mulai'][$i],
                'masterdetail_master_id'=>$codeid,
                'masterdetail_selesai'=>$data['jline_selesai'][$i],
                'masterdetail_totalkerja'=>$ztotal,
                'masterdetail_box'=>$data['line_box'],
                'masterdetail_istirahat'=>$data['jline_istirahat'][$i],
                'masterdetail_usersupervisor'=>$usersupervisor,
                'masterdetail_userinput'=>$username,
                'masterdetail_tglinput'=>date('Y-m-d'),                
                ); 
        }

        $this->db->insert_batch('trx_line', $xentries);
        $this->db->insert_batch('trx_masterdetail', $yentries); 
        
        if($this->db->affected_rows() > 0)
            return 1;

        else
            return 0;
            redirect(site_url('trx_line/create'));
        }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('line_id', $q);
    	$this->db->or_like('line_karyawan_id', $q);
    	$this->db->or_like('line_produk_id', $q);
    	$this->db->or_like('line_nomor', $q);
    	$this->db->or_like('line_shift', $q);
    	$this->db->or_like('line_box', $q);
    	$this->db->or_like('line_mulai', $q);
    	$this->db->or_like('line_selesai', $q);
    	$this->db->or_like('line_istirahat', $q);
    	$this->db->or_like('line_totalmenit', $q);
    	$this->db->or_like('line_tgllaporan', $q);
        $this->db->or_like('line_upah', $q);
    	$this->db->or_like('line_userinput', $q);
    	$this->db->or_like('line_tglinput', $q);
    	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
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

/* End of file Trx_line_model.php */
/* Location: ./application/models/Trx_line_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-09 10:36:34 */
/* http://harviacode.com */
