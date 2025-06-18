<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trx_perbantuan_model extends CI_Model
{

    public $table = 'trx_perbantuan';
    public $id = 'perbantuan_id';
    public $order = 'DESC';
    public $module = '6';
    public $tabmaster = 'trx_master';
    public $trxdetail = 'trx_masterdetail';
    public $tables = 'view_perbantuan';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->tables)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->tables)->row();
    }
    

    public function gettrxmaster($value1, $value2, $value3, $value4,$value5){
        $this->db->select('*');
        $this->db->from('trx_master');
        $this->db->where('master_acuanmesin',$value1);
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


    function countperbantuan($field,$value1, $value2, $value3)
    {
        $this->db->select("COUNT(".$field.") as perbantuanxtotal");
        $this->db->from('trx_perbantuan');
        $this->db->where('perbantuan_kategori',$value1);
        $this->db->where('perbantuan_tgllaporan',$value2);
        $this->db->where('perbantuan_shift',$value3);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->row()->perbantuanxtotal;
        }
        else {
            return '';
        }

    }


    function perbantuancount($field,$value1, $value2, $value3, $value4)
    {
        $this->db->select("COUNT(".$field.") as perbantuanxxtotal");
        $this->db->from('trx_perbantuan');
        $this->db->where('perbantuan_kategori',$value1);
        $this->db->where('perbantuan_shift',$value2);
        $this->db->where('perbantuan_tgllaporan',$value3);
        $this->db->where('perbantuan_master_id',$value4);
        return $this->db->get()->row()->perbantuanxxtotal;

    }


    function sumperbantuan($field,$value1, $value2, $value3,$value4)
    {
        $this->db->select("SUM(".$field.") as sumperbantuantotal");
        $this->db->from('trx_perbantuan');
        $this->db->where('perbantuan_usersupervisor',$value1);
        $this->db->where('perbantuan_shift',$value2);
        $this->db->where('perbantuan_tgllaporan',$value3);
        $this->db->where('perbantuan_master_id',$value4);
        return $this->db->get()->row()->sumperbantuantotal;

    }

    public function tampil_data($limit, $start = 0, $q = NULL, $xusername, $id_group, $s= NULL, $t= NULL){
      $supervisor=$this->session->userdata('user_supervisor');
        if(!empty($xusername)){
            if(($id_group=='5') or ($id_group=='6') or ($id_group=='2')) {
                        $this->db->group_start();
                        $this->db->or_where('perbantuan_usersupervisor',$supervisor);
                        $this->db->group_end(); 
                    }                
        }         
        $this->db->group_start();
        $this->db->like('perbantuan_id', $q);
        $this->db->or_like('perbantuan_karyawan_id', $q);
        $this->db->or_like('perbantuan_kategori', $q);
        $this->db->or_like('karyawan_nama', $q);
        $this->db->or_like('perbantuan_master_id', $q);
        $this->db->or_like('perbantuan_mulai', $q);
        $this->db->or_like('perbantuan_selesai', $q);
        $this->db->or_like('perbantuan_istirahat', $q);
        $this->db->group_end();

        if(!empty($s)){
            $this->db->group_start();
            $this->db->or_where('perbantuan_shift',$s);
            $this->db->group_end();
         }


        if(!empty($t)){
            $this->db->group_start();
            $this->db->or_where('perbantuan_tgllaporan',$t);
            $this->db->group_end();
         }

        $this->db->order_by('perbantuan_id','DESC');
        $this->db->limit($limit, $start);
        return $this->db->get($this->tables)->result();
    }


    function trxgetcode($field,$key_value1,$key_value2)
    {
        $this->db->select($field . " as xtotal");
        $this->db->from('trx_masterdetail');
        $this->db->where('masterdetail_karyawan_id',$key_value1);
        $this->db->where('masterdetail_master_id',$key_value2);
            return $this->db->get()->row()->xtotal;
    }

    function batchInsert($data, $codeid, $perbantuan, $username, $usersupervisor){
        //get bill entries 
        $count = count($data['count']); 
        $patas = $this->m_general->hargaproduk('stx_produk','produk_step_final','produk_id','P777777');
        $pbawah = $this->m_general->hargaproduk('stx_produk','produk_step_final','produk_id','P777778');
        if($perbantuan=="Bantuan Yupi") {
            $bantuan='Bantuan Yupi';
            $fupah = $patas;
        }else{
            $bantuan='Sortir Mogul';
            $fupah = $pbawah;; 
        }

        for($i = 0; $i<$count; $i++){

            /* if (strtotime($data['jperbantuan_mulai'][$i]) > strtotime($data['jperbantuan_selesai'][$i])) {
                    $tengah  ="24:00";
                    $noll  ="00:00";
                    $totalkerja = ((abs((strtotime($noll) - strtotime($data['jperbantuan_selesai'][$i])))/60) + ((strtotime($tengah) - strtotime($data['jperbantuan_mulai'][$i]))/60));
                    $total = $totalkerja - $data['jperbantuan_istirahat'][$i];
                    }else {
                        $totalkerja = (strtotime($data['jperbantuan_selesai'][$i]) -  strtotime($data['jperbantuan_mulai'][$i]))/60;
                        $total = $totalkerja - $data['jperbantuan_istirahat'][$i];
                    } */


                    
            
            //$upah = floor(($t * $fupah ));
            //$upah = floor(($total * $patas )/$pbawah);
 
            $xentries[] = array(
                'perbantuan_karyawan_id'=>$data['jperbantuan_karyawan_id'][$i],
                'perbantuan_master_id'=>$codeid,
                'perbantuan_tgllaporan'=>$data['perbantuan_tgllaporan'],
                'perbantuan_kategori'=>$bantuan,
                'perbantuan_shift'=>$data['perbantuan_shift'],
                'perbantuan_mulai'=>'06:45:00',
                'perbantuan_selesai'=>'14:45:00',
                'perbantuan_istirahat'=>$data['jperbantuan_istirahat'][$i],
                'perbantuan_totalmenit'=>($data['jperbantuan_istirahat'][$i]*60),
                'perbantuan_upah'=> floor($data['jperbantuan_istirahat'][$i] * $fupah ),
                'perbantuan_usersupervisor'=>$usersupervisor,
                'perbantuan_userinput'=>$username,
                'perbantuan_tglinput'=>date('Y-m-d'),
                
                );

            $yentries[] = array(
                'masterdetail_karyawan_id'=>$data['jperbantuan_karyawan_id'][$i],                
                'masterdetail_master_id'=>$codeid,
                'masterdetail_mulai'=>'06:45:00',
                'masterdetail_selesai'=>'14:45:00',
                'masterdetail_istirahat'=>$data['jperbantuan_istirahat'][$i],
                'masterdetail_totalkerja'=>($data['jperbantuan_istirahat'][$i]*60),
                'masterdetail_jamkerja' => $data['jperbantuan_istirahat'][$i],
                'masterdetail_upah'=>floor($data['jperbantuan_istirahat'][$i] * $fupah ),
                'masterdetail_usersupervisor'=>$usersupervisor,
                'masterdetail_userinput'=>$username,
                'masterdetail_tglinput'=>date('Y-m-d'),                
                ); 
        }
        
        $this->db->insert_batch('trx_perbantuan', $xentries);
        $this->db->insert_batch('trx_masterdetail', $yentries);  
        if($this->db->affected_rows() > 0)
            return 1;

        else
            return 0;
            redirect(site_url('trx_perbantuan/create'));
        }


    // get total rows
 function total_rows($q = NULL, $xusername, $id_group, $s= NULL, $t= NULL) {
 $supervisor=$this->session->userdata('user_supervisor');
        if(!empty($xusername)){
            if($id_group=='2'){
                $this->db->group_start();
                $this->db->or_where('perbantuan_userinput',$xusername);
                $this->db->group_end(); 
                    }elseif(($id_group=='5') or ($id_group=='6')) {
                        $this->db->group_start();
                        $this->db->or_where('perbantuan_usersupervisor',$supervisor);
                        $this->db->group_end(); 
                    } 
        }
        
        $this->db->group_start();
    	$this->db->or_like('perbantuan_id', $q);
    	$this->db->or_like('perbantuan_karyawan_id', $q);
    	$this->db->or_like('perbantuan_kategori', $q);
    	$this->db->or_like('perbantuan_master_id', $q);
        $this->db->or_like('karyawan_nama', $q);
    	$this->db->or_like('perbantuan_mulai', $q);
    	$this->db->or_like('perbantuan_selesai', $q);
    	$this->db->or_like('perbantuan_istirahat', $q);
    	$this->db->or_like('perbantuan_totalmenit', $q);
    	$this->db->or_like('perbantuan_upah', $q);
    	$this->db->or_like('perbantuan_userinput', $q);
    	$this->db->or_like('perbantuan_tglinput', $q);
        $this->db->group_end();

        if(!empty($s)){
            $this->db->group_start();
            $this->db->or_where('perbantuan_shift',$s);
            $this->db->group_end();
         }


        if(!empty($t)){
            $this->db->group_start();
            $this->db->or_where('perbantuan_tgllaporan',$t);
            $this->db->group_end();
         }

    	$this->db->from($this->tables);
            return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
    	$this->db->or_like('perbantuan_id', $q);
    	$this->db->or_like('perbantuan_karyawan_id', $q);
    	$this->db->or_like('perbantuan_kategori', $q);
    	$this->db->or_like('perbantuan_shift', $q);
    	$this->db->or_like('perbantuan_master_id', $q);
    	$this->db->or_like('perbantuan_mulai', $q);
    	$this->db->or_like('perbantuan_selesai', $q);
    	$this->db->or_like('perbantuan_istirahat', $q);
    	$this->db->or_like('perbantuan_totalmenit', $q);
    	$this->db->or_like('perbantuan_upah', $q);
    	$this->db->or_like('perbantuan_tgllaporan', $q);
    	$this->db->or_like('perbantuan_userinput', $q);
    	$this->db->or_like('perbantuan_tglinput', $q);
    	$this->db->limit($limit, $start);
            return $this->db->get($this->table)->result();
    }


    public function download_perbantuan($xuser,$call_date,$xid_group){
        $val=explode('-', $call_date);
        $tgl_awal=$val[0] ."-" .$val[1] ."-" .$val[2];
        $tgl_akhir=$val[3] ."-" .$val[4] ."-" .$val[5]; 

        $this->db->select('perbantuan_id,
            perbantuan_master_id,
            perbantuan_karyawan_id,
            perbantuan_kategori,
            perbantuan_shift,
            perbantuan_mulai,
            perbantuan_selesai,
            perbantuan_istirahat,
            perbantuan_totalmenit,
            perbantuan_upah,
            perbantuan_tgllaporan,
            perbantuan_usersupervisor,
            perbantuan_userinput,
            trx_karyawan.karyawan_nama as karyawan_nama');
        $this->db->from('trx_perbantuan');
        $this->db->join('trx_karyawan','trx_karyawan.karyawan_id = trx_perbantuan.perbantuan_karyawan_id','left');
        
        if(!empty($xuser)) {
            if ($xid_group =='2') {
                $this->db->where('perbantuan_userinput',$xuser);
            }elseif($xid_group =='5') {
                $this->db->where('perbantuan_usersupervisor',$xuser);

            }
        }
        $this->db->where( 'perbantuan_tgllaporan BETWEEN "' .$tgl_awal. '" and "' .$tgl_akhir .'"');

        $this->db->order_by('perbantuan_tgllaporan');
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
/* End of file Trx_perbantuan_model.php */
/* Location: ./application/models/Trx_perbantuan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-16 19:35:10 */
/* http://harviacode.com */
