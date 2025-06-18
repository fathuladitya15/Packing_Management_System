<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trx_karyawan_model extends CI_Model
{

    public $table = 'trx_karyawan';
    public $id = 'karyawan_id';
    public $order = 'DESC';

    public $module = '3';
    public $tabmaster = 'trx_master';
    public $trxdetail = 'trx_masterdetail';
    public $tables = 'view_karyawan';

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

    public function tampil_data($limit, $start = 0, $q = NULL, $xusername, $id_group){
     
        if(!empty($xusername)){
               
        }             
        $this->db->group_start();
        $this->db->like('karyawan_id', $q);
            $this->db->or_like('jabatan_id', $q);
            $this->db->or_like('jabatan_nama', $q);
            $this->db->or_like('karyawan_usersupervisor', $q);
            $this->db->or_like('karyawan_nama', $q);
            $this->db->or_like('karyawan_alamat', $q);
            $this->db->or_like('karyawan_jk', $q);
            $this->db->or_like('karyawan_telp', $q);
            $this->db->or_like('karyawan_email', $q);
            $this->db->or_like('karyawan_status', $q);
            $this->db->or_like('karyawan_userinput', $q);
            $this->db->or_like('karyawan_tglinput', $q);
            $this->db->or_like('karyawan_pendidikan', $q);
            $this->db->or_like('karyawan_nikah', $q);
            $this->db->or_like('karyawan_bpjskesehatan', $q);
            $this->db->or_like('karyawan_bpjstenagakerja', $q);
            $this->db->or_like('karyawan_agama', $q);
            $this->db->or_like('karyawan_joindate', $q);
            $this->db->or_like('karyawan_tempatlahir', $q);
        $this->db->group_end();

        $this->db->order_by('karyawan_id', 'DESC');
        $this->db->limit($limit, $start);
        return $this->db->get($this->tables)->result();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('karyawan_id', $q);
        	$this->db->or_like('jabatan_id', $q);
        	$this->db->or_like('karyawan_nama', $q);
        	$this->db->or_like('karyawan_alamat', $q);
            $this->db->or_like('karyawan_usersupervisor', $q);
        	$this->db->or_like('karyawan_jk', $q);
        	$this->db->or_like('karyawan_telp', $q);
        	$this->db->or_like('karyawan_email', $q);
        	$this->db->or_like('karyawan_norek', $q);
        	$this->db->or_like('karyawan_norek_an', $q);
        	$this->db->or_like('karyawan_deskripsi', $q);
        	$this->db->or_like('karyawan_status', $q);
        	$this->db->or_like('karyawan_jml_anak', $q);
        	$this->db->or_like('karyawan_aktif', $q);
        	$this->db->or_like('karyawan_userinput', $q);
        	$this->db->or_like('karyawan_tglinput', $q);
            $this->db->or_like('karyawan_pendidikan', $q);
            $this->db->or_like('karyawan_nikah', $q);
            $this->db->or_like('karyawan_bpjskesehatan', $q);
            $this->db->or_like('karyawan_bpjstenagakerja', $q);
            $this->db->or_like('karyawan_agama', $q);
            $this->db->or_like('karyawan_joindate', $q);
            $this->db->or_like('karyawan_tempatlahir', $q);
	$this->db->from($this->tables);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('karyawan_id', $q);
	$this->db->or_like('karyawan_jabatan_id', $q);
	$this->db->or_like('karyawan_nama', $q);
	$this->db->or_like('karyawan_alamat', $q);
	$this->db->or_like('karyawan_jk', $q);
	$this->db->or_like('karyawan_telp', $q);
	$this->db->or_like('karyawan_email', $q);
	$this->db->or_like('karyawan_norek', $q);
	$this->db->or_like('karyawan_norek_an', $q);
	$this->db->or_like('karyawan_deskripsi', $q);
	$this->db->or_like('karyawan_foto', $q);
	$this->db->or_like('karyawan_status', $q);
	$this->db->or_like('karyawan_jml_anak', $q);
	$this->db->or_like('karyawan_aktif', $q);
	$this->db->or_like('karyawan_username', $q);
	$this->db->or_like('karyawan_password', $q);
	$this->db->or_like('karyawan_userinput', $q);
	$this->db->or_like('karyawan_tglinput', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }


    public function download_karyawan($xuser,$call_date,$xid_group){
        $val=explode('-', $call_date);
        $tgl_awal=$val[0] ."-" .$val[1] ."-" .$val[2];
        $tgl_akhir=$val[3] ."-" .$val[4] ."-" .$val[5]; 

        $this->db->select('karyawan_id, karyawan_jabatan_id, karyawan_nama, karyawan_alamat, karyawan_jk, karyawan_telp, karyawan_email, karyawan_norek, karyawan_norek_an, karyawan_deskripsi, karyawan_foto, karyawan_status, karyawan_jml_anak, karyawan_usersupervisor, karyawan_aktif, karyawan_username, karyawan_password, karyawan_userinput, `karyawan_pendidikan`, `karyawan_nikah`, `karyawan_bpjskesehatan`, `karyawan_bpjstenagakerja`, `karyawan_agama`, `karyawan_joindate`, `karyawan_tempatlahir`, stx_jabatan.jabatan_nama as jabatan_nama');
        $this->db->from('trx_karyawan');
        $this->db->join('stx_jabatan','trx_karyawan.karyawan_jabatan_id = stx_jabatan.jabatan_id','left');
        
        $this->db->where( 'karyawan_tglinput BETWEEN "' .$tgl_awal. '" and "' .$tgl_akhir .'"');

        $this->db->order_by('karyawan_tglinput');
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

/* End of file Trx_karyawan_model.php */
/* Location: ./application/models/Trx_karyawan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-04 14:45:35 */
/* http://harviacode.com */
