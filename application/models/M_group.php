<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_group extends CI_Model {

	
	public function tampil_data($parameter_urut,$jns_urut,$search,$sampai,$dari){
        if(!empty($search)){
            $sampai=0;
            $dari=0;
        }
        $this->db->select('*');
        $this->db->from('stx_group');
        $this->db->like('group_name',$search,'both');
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
    public function privilage($group_id){
        $this->db->select('*');
        $this->db->from('stx_nav');
        $this->db->join('stx_nav_group','stx_nav.id_nav=stx_nav_group.id_nav','left');
        $this->db->where('id_group',$group_id);
        $this->db->order_by('stx_nav.id_nav');
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }

    public function hak_akses($group_id){
        $str_menu="";

        $this->db->select('*');
        $this->db->from('stx_nav');
        $this->db->where('stx_nav.status','Active');
        $this->db->order_by('parent_idx');
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            $menu_l1=$q->result_array();
            foreach ($menu_l1 as $l1) {
                $id_nav=$l1['id_nav'];
                $parent_idx=$l1['parent_idx'];
                $nav_title=$l1['nav_title'];
                $nav_url=$l1['nav_url'];
                $fit_add=$l1['fit_add'];
                $fit_update=$l1['fit_update'];
                $fit_delete=$l1['fit_delete'];
                $fit_comment=$l1['fit_comment'];
                $fit_report=$l1['fit_report'];
                $current=$this->uri->segment(2);
                
                $this->db->select('*');
                $this->db->from('stx_nav_group');
                $this->db->where('id_nav', $id_nav);
                $this->db->where('id_group',$group_id);
                $q2=$this->db->get();
                /*Menu Level 2*/
                if($q2->num_rows() > 0) {
                    /*Jika Parent mempunyai Child*/
                    $menul2 =$q2->result_array();
                    foreach ($menul2 as $m2) {
                        if($m2['add1']=='Y') $add='checked'; else $add='';
                        if($m2['update1']=='Y') $update='checked'; else $update='';
                        if($m2['delete1']=='Y') $delete='checked'; else $delete='';
                        if($m2['comment1']=='Y') $comment1='checked'; else $comment1='';
                        if($m2['report1']=='Y') $report1='checked'; else $report1='';
                    }
                    $str_menu=$str_menu ."<div class='row'>";
                    $str_menu=$str_menu .'<div class="col-sm-2 col-xs-1" >';
                    $str_menu=$str_menu .'<input type=hidden name="nav[]" value="' .$id_nav .'"><input type="checkbox" name="id_nav' .$l1['id_nav'] .'" value="Y" checked>' .$nav_title .'</div>';
                    if($fit_add=='Y') $str_menu=$str_menu .'<div class="col-sm-2 col-xs-1"><input type="checkbox" name="add' .$l1['id_nav'] .'" value="Y" ' .$add .'>Add</div>';else $str_menu=$str_menu .'<input name ="add' .$l1['id_nav'] .'" type=hidden value="N">';
                    if($fit_update=='Y') $str_menu=$str_menu .'<div class="col-sm-2 col-xs-1"><input type="checkbox" name="update'.$l1['id_nav'] .'" value="Y" ' .$update .'>Update</div>';else $str_menu=$str_menu .'<input name ="update' .$l1['id_nav'] .'" type=hidden value="N">';
                    if($fit_delete=='Y') $str_menu=$str_menu .'<div class="col-sm-2 col-xs-1"><input type="checkbox" name="delete'.$l1['id_nav'] .'" value="Y" ' .$delete .'>Delete</div>'; else $str_menu=$str_menu .'<input name ="delete' .$l1['id_nav'] .'" type=hidden value="N">';
                    if($fit_comment=='Y') $str_menu=$str_menu .'<div class="col-sm-2 col-xs-1"><input type="checkbox" name="comment'.$l1['id_nav'] .'" value="Y" ' .$comment1 .'>Manual</div>'; else $str_menu=$str_menu .'<input name ="comment' .$l1['id_nav'] .'" type=hidden value="N">';
                    if($fit_report=='Y')$str_menu=$str_menu .'<div class="col-sm-2 col-xs-1"><input type="checkbox" name="report'.$l1['id_nav'] .'" value="Y" ' .$report1 .'>Report</div>';else $str_menu=$str_menu .'<input name ="report' .$l1['id_nav'] .'" type=hidden value="N">';
                    $str_menu=$str_menu ."</div>";
                }
                else{
                    /*Jika Parent Tidak ada Child*/
                    $str_menu=$str_menu ."<div class='row'>";
                    $str_menu=$str_menu .'<div class="col-sm-6 col-xs-6" >';
                    $str_menu=$str_menu .'<input type=hidden name="nav[]" value="' .$id_nav .'"><input type="checkbox" name="id_nav'.$l1['id_nav'] .'" value="Y">' .$nav_title .'</div>';
                    if($fit_add=='Y') $str_menu=$str_menu .'<div class="col-sm-2 col-xs-1"><input type="checkbox" name="add' .$l1['id_nav'] .'" value="Y" >Add</div>';else $str_menu=$str_menu .'<input name ="add' .$l1['id_nav'] .'" type=hidden value="N">';
                    if($fit_update=='Y') $str_menu=$str_menu .'<div class="col-sm-2 col-xs-1"><input type="checkbox" name="update'.$l1['id_nav'] .'" value="Y" >Update</div>';else $str_menu=$str_menu .'<input name ="update' .$l1['id_nav'] .'" type=hidden value="N">';
                    if($fit_delete=='Y')$str_menu=$str_menu .'<div class="col-sm-2 col-xs-1"><input type="checkbox" name="delete'.$l1['id_nav'] .'" value="Y" >Delete</div>'; else $str_menu=$str_menu .'<input name ="delete' .$l1['id_nav'] .'" type=hidden value="N">';
                    if($fit_comment=='Y')$str_menu=$str_menu .'<div class="col-sm-2 col-xs-1"><input type="checkbox" name="comment'.$l1['id_nav'] .'" value="Y" >Manual</div>'; else $str_menu=$str_menu .'<input name ="comment' .$l1['id_nav'] .'" type=hidden value="N">';
                    if($fit_report=='Y')$str_menu=$str_menu .'<div class="col-sm-2 col-xs-1"><input type="checkbox" name="report'.$l1['id_nav'] .'" value="Y" >Report</div>'; else $str_menu=$str_menu .'<input name ="report' .$l1['id_nav'] .'" type=hidden value="N">';
                    $str_menu=$str_menu ."</div>";
                }
            }
            return $str_menu;
        }
        else
        {
            return $str_menu;   
        }
    }
}
