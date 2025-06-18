<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trx_clining_model extends CI_Model
{

    public $table = 'trx_clining';
    public $id = 'clining_id';
    public $order = 'DESC';
    public $module = '11';
    public $tabmaster = 'trx_master';
    public $trxdetail = 'trx_masterdetail';
    public $tables = 'view_clining';


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
    
    function cliningcount($field,$value1, $value2, $value3, $value4)
    {
        $this->db->select("COUNT(".$field.") as cliningxxtotal");
        $this->db->from('trx_clining');
        $this->db->where('clining_line',$value1);
        $this->db->where('clining_shift',$value2);
        $this->db->where('clining_tgllaporan',$value3);
        $this->db->where('clining_master_id',$value4);
        return $this->db->get()->row()->cliningxxtotal;

    }

    public function gettrxmaster($value1, $value2, $value3, $value4,$value5){
        $this->db->select('*');
        $this->db->from('trx_master');
        $this->db->where('master_line',$value1);
        $this->db->where('master_nomesin',$value2);
        $this->db->where('master_tgllaporan',$value3);
        $this->db->where('master_shift',$value4);
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


    function sumclining($field,$value1, $value2, $value3,$value4)
    {
        $this->db->select("SUM(".$field.") as sumcliningtotal");
        $this->db->from('trx_clining');
        $this->db->where('clining_usersupervisor',$value1);
        $this->db->where('clining_shift',$value2);
        $this->db->where('clining_tgllaporan',$value3);
        $this->db->where('clining_master_id',$value4);
        return $this->db->get()->row()->sumcliningtotal;

    }

    function countclining($field,$value1, $value2, $value3, $value4)
    {
        $this->db->select("COUNT(".$field.") as cliningxtotal");
        $this->db->from('trx_clining');
        $this->db->where('clining_line',$value1);
        $this->db->where('clining_tgllaporan',$value2);
        $this->db->where('clining_shift',$value3);
        $this->db->where('clining_master_id',$value4);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data->row()->cliningxtotal;
        }
        else {
            return '';
        }

    }



    function batchInsert($data,$codeid,$clining, $upah,$username,$usersupervisor){
        //get bill entries 
        $count = count($data['count']); 
        for($i = 0; $i<$count; $i++){
            $xentries[] = array(
                'clining_master_id' => $codeid,
                'clining_karyawan_id' => $data['jclining_karyawan_id'][$i],
                'clining_shift' => $data['jclining_shift'],
                'clining_jumlahteam' => $count,
                'clining_line' => $data['jclining_line'],
                'clining_pekerjaan' => $clining,
                'clining_posisi' => $data['jclining_posisi'],
                'clining_tgllaporan' => $data['jclining_tgllaporan'],
                'clining_upah' => $upah,
                'clining_usersupervisor' => $usersupervisor,
                'clining_userinput' => $username,
                'clining_tglinput' => date('Y-m-d'),
                
                );
            
            $yentries[] = array(
                'masterdetail_karyawan_id'=>$data['jclining_karyawan_id'][$i],                
                'masterdetail_master_id'=>$codeid,
                'masterdetail_upah'=>$upah,
                'masterdetail_usersupervisor' => $usersupervisor,
                'masterdetail_userinput'=>$username,
                'masterdetail_tglinput'=>date('Y-m-d'),                
                );
        }
        $this->db->insert_batch('trx_clining', $xentries);
        $this->db->insert_batch('trx_masterdetail', $yentries); 
        if($this->db->affected_rows() > 0)
            return 1;

        else
            return 0;
            redirect(site_url('trx_clining/create'));
        }


    
function total_rows($q = NULL, $xusername, $id_group, $s= NULL, $t= NULL) {
$supervisor=$this->session->userdata('user_supervisor'); 
        if(!empty($xusername)){
            if($id_group=='2'){
                $this->db->group_start();
                $this->db->or_where('clining_userinput',$xusername);
                $this->db->group_end(); 
                    }elseif(($id_group=='5') or ($id_group=='6')) {
                        $this->db->group_start();
                        $this->db->or_where('clining_usersupervisor',$supervisor);
                        $this->db->group_end(); 
                    } 
        }      
        $this->db->group_start();
        $this->db->like('clining_id', $q);
	$this->db->or_like('clining_master_id', $q);
	$this->db->or_like('clining_karyawan_id', $q);
    $this->db->or_like('karyawan_nama', $q);
	$this->db->or_like('clining_line', $q);
	$this->db->or_like('clining_pekerjaan', $q);
    $this->db->or_like('clining_jumlahteam', $q);
	$this->db->or_like('clining_posisi', $q);
    $this->db->or_like('clining_upah', $q);
	$this->db->or_like('clining_userinput', $q);
	$this->db->or_like('clining_tglinput', $q);
    $this->db->group_end();


        if(!empty($s)){
            $this->db->group_start();
            $this->db->or_where('clining_shift',$s);
            $this->db->group_end();
         }


        if(!empty($t)){
            $this->db->group_start();
            $this->db->or_where('clining_tgllaporan',$t);
            $this->db->group_end();
         }

	
    $this->db->from($this->tables);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('clining_id', $q);
	$this->db->or_like('clining_master_id', $q);
	$this->db->or_like('clining_karyawan_id', $q);
	$this->db->or_like('clining_shift', $q);
	$this->db->or_like('clining_line', $q);
	$this->db->or_like('clining_pekerjaan', $q);
    $this->db->or_like('clining_jumlahteam', $q);
	$this->db->or_like('clining_posisi', $q);
    $this->db->or_like('clining_upah', $q);
	$this->db->or_like('clining_tgllaporan', $q);
	$this->db->or_like('clining_userinput', $q);
	$this->db->or_like('clining_tglinput', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }


    public function tampil_data($limit, $start = 0, $q = NULL, $xusername, $id_group, $s= NULL, $t= NULL){
    $supervisor=$this->session->userdata('user_supervisor');  
        if(!empty($xusername)){
            if($id_group=='2'){
                $this->db->group_start();
                $this->db->or_where('clining_userinput',$xusername);
                $this->db->group_end(); 
                  }elseif(($id_group=='5') or ($id_group=='6')) {
                        $this->db->group_start();
                        $this->db->or_where('clining_usersupervisor',$supervisor);
                        $this->db->group_end(); 
                    }                
        }         
       
        $this->db->group_start();
            $this->db->like('clining_id', $q);
            $this->db->or_like('clining_karyawan_id', $q);
            $this->db->or_like('karyawan_nama', $q);
            $this->db->or_like('clining_master_id', $q); 
            $this->db->or_like('clining_line', $q);
            $this->db->or_like('clining_jumlahteam', $q);
            $this->db->or_like('clining_pekerjaan', $q);
            $this->db->or_like('clining_posisi', $q);
            $this->db->or_like('clining_upah', $q);
        $this->db->group_end();


        if(!empty($s)){
            $this->db->group_start();
            $this->db->or_where('clining_shift',$s);
            $this->db->group_end();
         }


        if(!empty($t)){
            $this->db->group_start();
            $this->db->or_where('clining_tgllaporan',$t);
            $this->db->group_end();
         }

        $this->db->order_by('clining_id','DESC');
        $this->db->limit($limit, $start);
        return $this->db->get($this->tables)->result();
    }


public function download_clining($xuser,$call_date,$xid_group){
        $val=explode('-', $call_date);
        $tgl_awal=$val[0] ."-" .$val[1] ."-" .$val[2];
        $tgl_akhir=$val[3] ."-" .$val[4] ."-" .$val[5]; 

        $this->db->select('clining_id,
            clining_master_id,
            clining_karyawan_id,
            clining_line,
            clining_shift,
            clining_pekerjaan,
            clining_jumlahteam,
            clining_posisi,
            clining_upah,
            clining_tgllaporan,
            clining_usersupervisor,
            clining_userinput,
            trx_karyawan.karyawan_nama as karyawan_nama');
        $this->db->from('trx_clining');
        $this->db->join('trx_karyawan','trx_karyawan.karyawan_id = trx_clining.clining_karyawan_id','left');
        
        if(!empty($xuser)) {
            if ($xid_group =='2') {
                $this->db->where('clining_userinput',$xuser);
            }elseif($xid_group =='5') {
                $this->db->where('clining_usersupervisor',$xuser);

            }
        }
        $this->db->where( 'clining_tgllaporan BETWEEN "' .$tgl_awal. '" and "' .$tgl_akhir .'"');

        $this->db->order_by('clining_tgllaporan');
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


/* End of file Trx_clining_model.php */
/* Location: ./application/models/Trx_clining_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-06-06 02:26:38 */
/* http://harviacode.com */
