<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_users extends CI_Model {

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
	
	public function tampil_data($parameter_urut,$jns_urut,$search,$sampai,$dari){
        if(!empty($search)){
            $sampai=0;
            $dari=0;
        }
        $this->db->select('*');
        $this->db->from('trx_user');
        $this->db->join('stx_group','trx_user.id_group=stx_group.id_group');
        $this->db->like('user_fullname',$search,'both');
        $this->db->or_like('user_address',$search,'both');
        $this->db->or_like('user_email',$search,'both');
        $this->db->or_like('user_telp',$search,'both');
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

    public function randomPassword() {
    	$chars = 'abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789';
      	for($i = 0; $i < 8; ++$i) {
        	$random = str_shuffle($chars);
        	$ret .= $random[0];
      	}
      	return $ret ;

	   
	}
}
