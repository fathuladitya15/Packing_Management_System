<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_general extends CI_Model {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
    
	public function cek_user($username, $password, $status){
        $hash_1st=md5($password);
        $key=substr($hash_1st, 5,5);
        $new_hash=md5($key .$hash_1st .$key);
        $this->db->select('*');
        $this->db->from('trx_user');
        $this->db->join('stx_group','trx_user.id_group=stx_group.id_group');
        $this->db->where('username', $username);
        $this->db->where('user_password', $new_hash);
        //$this->db->where('status', $password);
        $this->db->where('user_status',$status);
        $q=$this->db->get();
        if($q->num_rows() >0){
            return $q->result_array();
        }else{
            return array();
        }
    }

    function trxgetcode($field,$key_value1,$key_value2)
    {
        $this->db->select($field . " as xtotal");
        $this->db->from('trx_masterdetail');
        $this->db->where('masterdetail_karyawan_id',$key_value1);
        $this->db->where('masterdetail_master_id',$key_value2);
            return $this->db->get()->row()->xtotal;
    }
    

    public function tampil_data($nama_tabel,$parameter_urut,$jns_urut,$sampai,$dari){
        $this->db->select('*');
        $this->db->from($nama_tabel);
        $this->db->order_by($parameter_urut,$jns_urut);
        $q=$this->db->get('',$sampai,$dari);
		if ($q->num_rows() > 0){
			return $q->result_array();
        }
		else
		{
			return array();	
		}
    }


    function getcode($table, $field, $name) { 
        $q = $this->db->query("SELECT MAX(RIGHT($field,6)) AS data FROM ".$table);
        $kd = ""; 
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->data)+1;
                $kd = sprintf("%06s", $tmp);
            }
        }else{
            $kd = "000001";
        }
        $kar = $name;
        return $kar.$kd;
    } 


    function sumdata($table,$field,$key,$key_value)
    {
    $this->db->select("SUM(".$field.") as total");
    $this->db->from($table);
    $this->db->where($key,$key_value);
    return $this->db->get()->row()->total;

    }

    
    function sumtrxbox($field,$value1, $value2, $value3)
    {
    $this->db->select("SUM(".$field.") as myxtotal");
    $this->db->from('trx_master');
    $this->db->where('master_produk_id',$value1);
    $this->db->where('master_tgllaporan',$value2);
    $this->db->where('master_shift',$value3);
    return $this->db->get()->row()->myxtotal;

    }


    function totaldisplayperline($field,$value1, $value2, $value3, $value4)
    {
    $this->db->select("SUM(".$field.") as mytotal");
    $this->db->from('trx_master');
    $this->db->where('master_produk_id',$value1);
    $this->db->where('master_tgllaporan',$value2);
    $this->db->where('master_shift',$value3);
    $this->db->where('master_line',$value4);
    return $this->db->get()->row()->mytotal;

    }


    function hargaproduk($table,$field,$key,$key_value)
    {
    $this->db->select($field . " as total");
    $this->db->from($table);
    $this->db->where($key,$key_value);
    return $this->db->get()->row()->total;

    }


    public function tampil_trxmmesin($value1, $value2, $value3, $value4){
        $this->db->select('*');
        $this->db->from('trx_mesin');
        $this->db->where('mesin_produk_id',$value1);
        $this->db->where('mesin_tgllaporan',$value2);
        $this->db->where('mesin_shift',$value3);
        $this->db->where('master_line',$value4);

        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }


    public function tampil_data_perfield($nama_tabel,$key,$key_value){
        $this->db->select('*');
        $this->db->from($nama_tabel);
        $this->db->where($key,$key_value);
        $q=$this->db->get();
		if ($q->num_rows() > 0){
			return $q->result_array();
        }
		else
		{
			return array();	
		}
    }

    public function tampil_data_perfield1($nama_tabel,$key,$key_value){
        $this->db->select('*');
        $this->db->from($nama_tabel);
        if(!empty($key) && !empty($key_value)) $this->db->where($key,$key_value);
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
            
        }
        else
        {
            return array(); 
        }
    }

    public function tampil_produkid($nama_tabel,$key,$key_value,$user,$user_value){
        $this->db->select('*');
        $this->db->from($nama_tabel);
        if(!empty($key) && !empty($key_value)) $this->db->where($key,$key_value);
        if(!empty($user) && !empty($user_value)) $this->db->where($user,$user_value);
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
            
        }
        else
        {
            return array(); 
        }
    }

    public function tampil_data_range($nama_tabel,$key,$key_value){
        $val=explode('-', $key_value);
        $tgl_awal=$val[0] ."-" .$val[1] ."-" .$val[2];
        $tgl_akhir=$val[3] ."-" .$val[4] ."-" .$val[5]; 
        $this->db->select('*');
        $this->db->from($nama_tabel);
        $this->db->where( $key .' BETWEEN "' .$tgl_awal. '" and "' .$tgl_akhir .'"');
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }


    public function total_data($nama_tabel,$parameter_field,$parameter_value){
        $this->db->select('*');
        $this->db->from($nama_tabel);
        if(!empty($parameter_field) && !empty($parameter_value)){
            $this->db->where($parameter_field,$parameter_value);
        }
        $q=$this->db->get();
        return $q->num_rows();
    }
     
    
    public function xenums($nama_tabel , $parameter_field){
    $query = "SHOW COLUMNS FROM ".$nama_tabel." LIKE '$parameter_field'";
     $row = $this->db->query("SHOW COLUMNS FROM ".$nama_tabel." LIKE '$parameter_field'")->row()->Type;  
     $regex = "/'(.*?)'/";
            preg_match_all( $regex , $row, $enum_array );
            $enum_fields = $enum_array[1];
            foreach ($enum_fields as $key=>$value)
            {
                $enums[$value] = $value; 
            }
            return $enums;
    }


    public function save($nama_tabel, $data, $key, $key_value){
        if($key_value!=""){
            $this->db->where($key, $key_value);
            $this->db->update($nama_tabel,$data);
        }else
        {
            $this->db->insert($nama_tabel, $data);
        }
    }
    
    public function remove($nama_tabel,$key,$key_value){
        $this->db->where($key,$key_value);
        $this->db->delete($nama_tabel);
    }

    public function menu($group_id){
        $str_menu="";

        $this->db->select('stx_group.id_group,stx_nav.id_nav,nav_title, nav_url,parent_idx,child_idx,stx_nav.status,add1,update1,delete1');
        $this->db->from('stx_nav_group');
        $this->db->join('stx_nav','stx_nav_group.id_nav=stx_nav.id_nav');
        $this->db->join('stx_group','stx_nav_group.id_group=stx_group.id_group');
        $this->db->where('parent_idx >', 0);
        $this->db->where('child_idx',0);
        $this->db->where('stx_nav.status','Active');
        $this->db->where('stx_group.id_group',$group_id);
        $this->db->order_by('parent_idx');
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            $menu_l1=$q->result_array();
            foreach ($menu_l1 as $l1) {
                $parent_idx=$l1['parent_idx'];
                $nav_title=$l1['nav_title'];
                
                $nav_url=$l1['nav_url'];
                $current=$this->uri->segment(2);
                //$url=explode('/', string)
                //if($current==$nav_url)
                //$str_menu='<li class="current-menu-item menu-item-has-children">';
                /*Menu Level 2*/
                $this->db->select('stx_group.id_group,stx_nav.id_nav,nav_title,nav_url,parent_idx,child_idx, stx_nav.status,add1,update1,delete1');
                $this->db->from('stx_nav_group');
                $this->db->join('stx_nav','stx_nav_group.id_nav=stx_nav.id_nav');
                $this->db->join('stx_group','stx_nav_group.id_group=stx_group.id_group');
                $this->db->where('parent_idx', $parent_idx);
                $this->db->where('child_idx > ',0);
                $this->db->where('stx_nav.status','Active');
                $this->db->where('stx_group.id_group',$group_id);
                $this->db->order_by('child_idx');
                $q2=$this->db->get();
                /*Menu Level 2*/
                if($q2->num_rows() > 0) {
                    /*Jika Parent mempunyai Child*/
                    $str_menu=$str_menu .'<li class="dropdown">';
                    $str_menu=$str_menu .'<a href="#" class="dropdown-toggle" data-toggle="dropdown">' .$nav_title .'</a>';
                    $str_menu=$str_menu .'<ul class="dropdown-menu" role="menu">';
                    $menu_l2=$q2->result_array();
                    foreach ($menu_l2 as $l2) {
                        $str_menu=$str_menu .'<li><a href="' .base_url() .$l2['nav_url'] .'">' .$l2['nav_title'] .'</a></li>';
                    }
                    $str_menu=$str_menu .'</ul>';
                    $str_menu=$str_menu .'</li>';
                }
                else{
                    /*Jika Parent Tidak ada Child*/
                    $str_menu=$str_menu .'<li><a href="' .base_url() .strtolower($nav_url) .'">' .$nav_title .'<span class="sr-only">' .$nav_title .'</span>' .'</a></li>';
                }
            }
            return $str_menu;
        }
        else
        {
            return $str_menu;   
        }
    }

    
    public function tampil_data_user($id_group){
        $this->db->select('*');
        $this->db->from('trx_user');
        $this->db->where('id_group',$id_group);
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }

    public function get_privilage($id_group,$link){
        $this->db->select('stx_nav_group.id_nav,stx_group.id_group,stx_nav.nav_title,stx_nav.nav_url, add1,update1, delete1,comment1,report1');
        $this->db->from('stx_nav_group');
        $this->db->join('stx_group','stx_group.id_group=stx_nav_group.id_group');
        $this->db->join('stx_nav','stx_nav_group.id_nav=stx_nav.id_nav');
        $this->db->where('stx_nav_group.id_group',$id_group);
        $this->db->where('stx_nav.nav_url',$link);
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
     }

     public function cek_privilage($id_group,$link){
        $this->db->select('stx_nav_group.id_nav,stx_group.id_group,stx_nav.nav_title,stx_nav.nav_url, add1,update1, delete1,comment1,report1');
        $this->db->from('stx_nav_group');
        $this->db->join('stx_group','stx_group.id_group=stx_nav_group.id_group');
        $this->db->join('stx_nav','stx_nav_group.id_nav=stx_nav.id_nav');
        $this->db->where('stx_nav_group.id_group',$id_group);
        $this->db->where('stx_nav.nav_url',$link);
        $q=$this->db->get();
        return $q->num_rows();
     }
}
