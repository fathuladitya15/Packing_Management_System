<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Stx_menu extends CI_Model {

    public function menu()
		    {
	    $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');

        $id_group=$this->session->userdata('user_akses_level');
        $priv=$this->m_general->get_privilage($id_group,'group');
        $x['priv_count']=$this->m_general->cek_privilage($id_group,'group');
        $x['add']='N';
        $x['update']='N';
        $x['delete']='N';
        $x['comment1']='N';
        $x['report']='N';
        foreach ($priv as $a) {
            $x['add']=$a['add1'];
            $x['update']=$a['update1'];
            $x['delete']=$a['delete1'];
            $x['comment1']=$a['comment1'];
            $x['report']=$a['report1'];
        }

	}

}
