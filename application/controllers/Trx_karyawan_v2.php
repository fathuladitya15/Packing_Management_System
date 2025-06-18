<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trx_karyawan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Trx_karyawan_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('m_general');
        if(!$this->session->userdata('username')){
            redirect('akses/login');
            
        }
    }


    public function index()
    {
        $username=$this->session->userdata('username');
        $supervisor=$this->session->userdata('user_supervisor');
        $id_group=$this->session->userdata('user_akses_level');
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $priv=$this->m_general->get_privilage($id_group,'trx_karyawan');      
        $x['add']='N';
        $x['update']='N';
        $x['delete']='N';
        $x['comment1']='N';
        $x['report']='N';
        foreach ($priv as $a) {
            $id_group=$id_group;
            $nav_url='trx_karyawan';
            $add=$a['add1'];
            $update=$a['update1'];
            $delete=$a['delete1'];
            $plus=$a['comment1'];
            $report=$a['report1'];
        }
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'trx_karyawan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'trx_karyawan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'trx_karyawan/index.html';
            $config['first_url'] = base_url() . 'trx_karyawan';
        }

        $config['per_page'] = 25;
        $config['page_query_string'] = TRUE;
        $trx_karyawan = $this->Trx_karyawan_model->tampil_data($config['per_page'], $start, $q, $username,$id_group );
        $config['total_rows'] = $this->Trx_karyawan_model->total_rows($q, $username, $id_group,$id_group);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'trx_karyawan_data' => $trx_karyawan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'add' => $add,
            'update' => $update,
            'delete' => $delete,
            'report' => $report,
            'plus' => $plus,
            'priv_count' =>$this->m_general->cek_privilage($id_group,'trx_karyawan'),
            'jabatan' => $this->m_general->tampil_data_perfield1('stx_jabatan','jabatan_status','Aktif'),
            'xsupervisor' =>$this->m_general->tampil_data_perfield('view_user','id_group','5'), 
        );

    	$x['content']=$this->load->view('trx_karyawan/trx_karyawan_list', $data,TRUE);
        $this->load->view('template',$x);
    }



	public function upload_karyawan(){
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		$username=$this->session->userdata('username');
		$fileName = time().$_FILES['file']['name'];
	        
	    $config['upload_path'] = './upload'; //buat folder dengan nama assets di root folder
	    $config['file_name'] = $fileName;
	    $config['allowed_types'] = 'xls|xlsx|csv';
	    $config['max_size'] = 10000;
	         
	    $this->load->library('upload');
	    $this->upload->initialize($config);
	         
	    if(! $this->upload->do_upload('file') )
	        $this->upload->display_errors();
	             
	        $media = $this->upload->data('file');
	        $inputFileName = './upload/'.$fileName;
	        //echo $inputFileName; 
	        try {
	            $inputFileType = IOFactory::identify($inputFileName);
	            $objReader = IOFactory::createReader($inputFileType);
	            $objPHPExcel = $objReader->load($inputFileName);
	        } catch(Exception $e) {
	            die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
	        }
	 
	        $sheet = $objPHPExcel->getSheet(0);
	        $highestRow = $sheet->getHighestRow();
	        $highestColumn = $sheet->getHighestColumn();
	             
	        for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
	            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
	                NULL,
	                TRUE,
	                FALSE);
	                                                 
	            //Sesuaikan sama nama kolom tabel di database                                
	            $data = array(

    				'karyawan_jabatan_id'=> $this->input->post('karyawan_jabatan_id'),
    				'karyawan_nama'=> $rowData[0][0],
    				'karyawan_alamat'=> $rowData[0][1],
    				'karyawan_jk'=> $rowData[0][2],
    				'karyawan_telp'=> $rowData[0][3],
    				'karyawan_norek'=> $rowData[0][4],
    				'karyawan_norek_an'=> $rowData[0][5],
    				'karyawan_status'=> $rowData[0][6],
    				'karyawan_deskripsi'=> $rowData[0][7],
                    'karyawan_pendidikan' => $rowData[0][8],
                    'karyawan_nikah' => $rowData[0][9],
                    'karyawan_bpjskesehatan' => $rowData[0][10],
                    'karyawan_bpjstenagakerja' => $rowData[0][11],
                    'karyawan_agama' => $rowData[0][12],
                    'karyawan_joindate' => date('Y-m-d', strtotime(str_replace('/', '-', $rowData[0][13]))),
                    'karyawan_tempatlahir' => $rowData[0][14],
					'karyawan_ibu' => $rowData[0][15],
                    'karyawan_jml_anak' => $rowData[0][16],
                    'karyawan_email' => $rowData[0][17],
				    'karyawan_usersupervisor'=> 'yupi'.$rowData[0][5],
				    'karyawan_userinput'=> $username,
				    'karyawan_tglinput'=> date('Y-m-d')
	            );
	                 
	            //sesuaikan nama dengan nama tabel
	            $insert = $this->db->insert("trx_karyawan",$data);
	            //unlink(base_url() ."upload/" .$filename);
	            //delete_files(base_url() ."upload/" .$fileName);
	                     
	        }
	        $messege= array(
				'messege'=> "Data Berhasil Upload Data"
			);
			$this->session->set_flashdata('success',$messege);
	        $id_group=$this->session->userdata('user_akses_level');
			$hak=$this->m_general->cek_privilage($id_group,'trx_karyawan');
			if($hak>0){
				header('location:'.base_url().'trx_karyawan');
			}else{
				$hak=$this->m_general->cek_privilage($id_group,'trx_karyawan');
				if($hak>0){
					header('location:'.base_url().'trx_karyawan');
				}else{
					$hak=$this->m_general->cek_privilage($id_group,'trx_karyawan');
					if($hak>0){
						header('location:'.base_url().'trx_karyawan');
					}
					else{
						echo "I'm Sory You Don't Have Permition to Access This Page";
					}
				}
			}
	}


    public function read($id) 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $row = $this->Trx_karyawan_model->get_by_id($id);
        if ($row) {
            $data = array(
                'jabatan' => $this->m_general->tampil_data_perfield1('stx_jabatan','jabatan_status','Aktif'),
                'kelamin' => $this->m_general->xenums('trx_karyawan','karyawan_jk'),
                'xstatus' => $this->m_general->xenums('trx_karyawan','karyawan_status'),

        		'karyawan_id' => $row->karyawan_id,
        		'karyawan_jabatan_id' => $row->karyawan_jabatan_id,
        		'karyawan_nama' => $row->karyawan_nama,
        		'karyawan_alamat' => $row->karyawan_alamat,
        		'karyawan_jk' => $row->karyawan_jk,
        		'karyawan_telp' => $row->karyawan_telp,
        		'karyawan_email' => $row->karyawan_email,
        		'karyawan_norek' => $row->karyawan_norek,
        		'karyawan_norek_an' => $row->karyawan_norek_an,
        		'karyawan_deskripsi' => $row->karyawan_deskripsi,
        		'karyawan_foto' => $row->karyawan_foto,
        		'karyawan_status' => $row->karyawan_status,
        		'karyawan_jml_anak' => $row->karyawan_jml_anak,
        		'karyawan_aktif' => $row->karyawan_aktif,
        		'karyawan_username' => $row->karyawan_username,
        		'karyawan_password' => $row->karyawan_password,
        		'karyawan_userinput' => $row->karyawan_userinput,
                'karyawan_usersupervisor' => $row->karyawan_usersupervisor,
        		'karyawan_tglinput' => $row->karyawan_tglinput,
                'karyawan_pendidikan' => $row->karyawan_pendidikan,
                'karyawan_nikah' => $row->karyawan_nikah,
                'karyawan_bpjskesehatan' => $row->karyawan_bpjskesehatan,
                'karyawan_bpjstenagakerja' => $row->karyawan_bpjstenagakerja,
                'karyawan_agama' => $row->karyawan_agama,
				'karyawan_ibu' => $row->karyawan_ibu,
                'karyawan_joindate' => $row->karyawan_joindate,
                'karyawan_tempatlahir' => $row->karyawan_tempatlahir,
	    );
            $x['content']=$this->load->view('trx_karyawan/trx_karyawan_read', $data,TRUE);
            $this->load->view('template',$x);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_karyawan'));
        }
    }

    public function create() 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $data = array(
            'jabatan' => $this->m_general->tampil_data_perfield1('stx_jabatan','jabatan_status','Aktif'),
            'kelamin' => $this->m_general->xenums('trx_karyawan','karyawan_jk'),
            'pendidikan' => $this->m_general->xenums('trx_karyawan','karyawan_pendidikan'),
            'nikah' => $this->m_general->xenums('trx_karyawan','karyawan_nikah'),
            'agama' => $this->m_general->xenums('trx_karyawan','karyawan_agama'),
            'xstatus' => $this->m_general->xenums('trx_karyawan','karyawan_status'), 
            'xsupervisor' =>$this->m_general->tampil_data_perfield('view_user','id_group','5'),  
            'id_group' =>$this->session->userdata('user_akses_level'),
            'button' => 'Create',
            'action' => site_url('trx_karyawan/create_action'),
        	    'karyawan_id' => set_value('karyawan_id'),
        	    'karyawan_jabatan_id' => set_value('karyawan_jabatan_id'),
        	    'karyawan_nama' => set_value('karyawan_nama'),
        	    'karyawan_alamat' => set_value('karyawan_alamat'),
        	    'karyawan_jk' => set_value('karyawan_jk'),
        	    'karyawan_telp' => set_value('karyawan_telp'),
        	    'karyawan_email' => set_value('karyawan_email'),
        	    'karyawan_norek' => set_value('karyawan_norek'),
        	    'karyawan_norek_an' => set_value('karyawan_norek_an'),
        	    'karyawan_deskripsi' => set_value('karyawan_deskripsi'),
        	    'karyawan_foto' => set_value('karyawan_foto'),
        	    'karyawan_status' => set_value('karyawan_status'),
        	    'karyawan_jml_anak' => set_value('karyawan_jml_anak'),
        	    'karyawan_aktif' => set_value('karyawan_aktif'),
        	    'karyawan_username' => set_value('karyawan_username'),
        	    'karyawan_password' => set_value('karyawan_password'),        
                'karyawan_usersupervisor' => set_value('karyawan_usersupervisor'),
        	    'karyawan_userinput' => set_value('karyawan_userinput'),
        	    'karyawan_tglinput' => set_value('karyawan_tglinput'),
                'karyawan_pendidikan' => set_value('karyawan_pendidikan'),
                'karyawan_nikah' => set_value('karyawan_nikah'),
                'karyawan_bpjskesehatan' => set_value('karyawan_bpjskesehatan'),
                'karyawan_bpjstenagakerja' => set_value('karyawan_bpjstenagakerja'),
                'karyawan_agama' => set_value('karyawan_agama'),
				'karyawan_ibu' => set_value('karyawan_ibu'),
                'karyawan_joindate' => set_value('karyawan_joindate'),
                'karyawan_tempatlahir' => set_value('karyawan_tempatlahir'),
	);
        $x['content']=$this->load->view('trx_karyawan/trx_karyawan_form', $data,TRUE);
        $this->load->view('template',$x);

    }
    
    public function create_action() 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $supervisor=$this->session->userdata('user_supervisor');
        $id_group=$this->session->userdata('user_akses_level');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

       	$row = $this->Trx_karyawan_model->get_by_id($this->input->post('karyawan_id',TRUE));
        if ($row) {

        	    $messege= array(
					'messege'=> "ID Karyawan sudah Ada"
				);
				$this->session->set_flashdata('message',$messege);
        		redirect(site_url('trx_karyawan/create'));

        }else{
            if($this->input->post('kelamin')=="Pria") $kelamin='Pria'; else $kelamin='Wanita';
            if($this->input->post('karyawan_aktif')=="Aktif") $karyawan_aktif='Aktif'; else $karyawan_aktif='Tidak Aktif';
			if($this->input->post('xstatus')=="KHL") $xstatus='KHL'; else $xstatus='PKWT';
            if($this->input->post('nikah')=="BELUM MENIKAH") $nikah='BELUM MENIKAH'; else $nikah='MENIKAH';

            if($this->input->post('pendidikan')=="S2/S3") {
                $pendidikan='S2/S3';
            }elseif($this->input->post('pendidikan')=="SLTP") {
                 $pendidikan='SLTP';
            }elseif($this->input->post('pendidikan')=="SLTA") {
                $pendidikan='SLTA';
            }elseif($this->input->post('pendidikan')=="D3") {
                $pendidikan='D3';
            }elseif($this->input->post('pendidikan')=="S1") {
                $pendidikan='S1';                        
            }else {
            $pendidikan='SD';                
            }
       
            if($this->input->post('agama')=="KRISTEN") {
                $agama='KRISTEN';
            }elseif($this->input->post('agama')=="HINDU") {
                 $agama='HINDU';
            }elseif($this->input->post('agama')=="BUDHA") {
                $agama='BUDHA';
            }elseif($this->input->post('agama')=="LAIN-LAIN") {
                $agama='LAIN-LAIN';                    
            }else {
                $agama='ISLAM';                
            }



			if($id_group =='5') {
				$xsupervisor = $supervisor;
			}else{
				$xsupervisor = $this->input->post('karyawan_usersupervisor',TRUE);

			}
            $data = array(
       
        		'karyawan_jabatan_id' => $this->input->post('karyawan_jabatan_id',TRUE),
        		'karyawan_nama' => $this->input->post('karyawan_nama',TRUE),
        		'karyawan_alamat' => $this->input->post('karyawan_alamat',TRUE),
        		'karyawan_jk' => $kelamin,
        		'karyawan_telp' => $this->input->post('karyawan_telp',TRUE),
        		'karyawan_email' => $this->input->post('karyawan_email',TRUE),
        		'karyawan_norek' => $this->input->post('karyawan_norek',TRUE),
        		'karyawan_norek_an' => $this->input->post('karyawan_norek_an',TRUE),
        		'karyawan_deskripsi' => $this->input->post('karyawan_deskripsi',TRUE),
        		'karyawan_foto' => $this->input->post('karyawan_foto',TRUE),
        		'karyawan_status' => $xstatus,
        		'karyawan_jml_anak' => $this->input->post('karyawan_jml_anak',TRUE),
        		'karyawan_aktif' => $karyawan_aktif,
        		'karyawan_username' => $this->input->post('karyawan_username',TRUE),        
                'karyawan_usersupervisor' => $xsupervisor,
        		'karyawan_password' => $this->input->post('karyawan_password',TRUE),
                'karyawan_userinput' => $username,
                'karyawan_tglinput' => date('Y-m-d'),
                'karyawan_pendidikan' => $pendidikan,
                'karyawan_nikah' =>$nikah,
                'karyawan_bpjskesehatan' => $this->input->post('karyawan_bpjskesehatan',TRUE),
                'karyawan_bpjstenagakerja' => $this->input->post('karyawan_bpjstenagakerja',TRUE),
                'karyawan_agama' => $agama,
                'karyawan_joindate' => $this->input->post('karyawan_joindate',TRUE),
				'karyawan_ibu' => $this->input->post('karyawan_ibu',TRUE),
                'karyawan_tempatlahir' => $this->input->post('karyawan_tempatlahir',TRUE),
	    );

            


        $this->db->trans_start();
        $this->Trx_karyawan_model->insert($data);
        $this->db->trans_complete();


    if ($this->db->trans_status() === FALSE)
    {
            $this->db->trans_rollback();
           // $this->session->set_flashdata('message', 'Ada kesalahan , Mohon di cek kembali Transaksi Anda');
    }
    else
    {
            $this->db->trans_commit();
                        $messege= array(
                    'messege'=> "Data Berhasil Disimpan"
                );
            $this->session->set_flashdata('success', $messege);
    }




            redirect(site_url('trx_karyawan'));
        }

        }
    }
    
    public function update($id) 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $row = $this->Trx_karyawan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'xsupervisor' =>$this->m_general->tampil_data_perfield('view_user','id_group','5'), 
                'jabatan' => $this->m_general->tampil_data_perfield1('stx_jabatan','jabatan_status','Aktif'),
                'kelamin' => $this->m_general->xenums('trx_karyawan','karyawan_jk'),
                'xstatus' => $this->m_general->xenums('trx_karyawan','karyawan_status'),
                'pendidikan' => $this->m_general->xenums('trx_karyawan','karyawan_pendidikan'),
                'nikah' => $this->m_general->xenums('trx_karyawan','karyawan_nikah'),
                'agama' => $this->m_general->xenums('trx_karyawan','karyawan_agama'),
                'id_group' =>$this->session->userdata('user_akses_level'),
                'button' => 'Update',
                'action' => site_url('trx_karyawan/update_action'),
            		'karyawan_id' => set_value('karyawan_id', $row->karyawan_id),
            		'karyawan_jabatan_id' => set_value('karyawan_jabatan_id', $row->karyawan_jabatan_id),
            		'karyawan_nama' => set_value('karyawan_nama', $row->karyawan_nama),
            		'karyawan_alamat' => set_value('karyawan_alamat', $row->karyawan_alamat),
            		'karyawan_jk' => set_value('karyawan_jk', $row->karyawan_jk),
            		'karyawan_telp' => set_value('karyawan_telp', $row->karyawan_telp),
            		'karyawan_email' => set_value('karyawan_email', $row->karyawan_email),
            		'karyawan_norek' => set_value('karyawan_norek', $row->karyawan_norek),
            		'karyawan_norek_an' => set_value('karyawan_norek_an', $row->karyawan_norek_an),
            		'karyawan_deskripsi' => set_value('karyawan_deskripsi', $row->karyawan_deskripsi),
            		'karyawan_foto' => set_value('karyawan_foto', $row->karyawan_foto),
            		'karyawan_status' => set_value('karyawan_status', $row->karyawan_status),
            		'karyawan_jml_anak' => set_value('karyawan_jml_anak', $row->karyawan_jml_anak),
            		'karyawan_aktif' => set_value('karyawan_aktif', $row->karyawan_aktif),
            		'karyawan_username' => set_value('karyawan_username', $row->karyawan_username),
            		'karyawan_password' => set_value('karyawan_password', $row->karyawan_password),
            		'karyawan_userinput' => set_value('karyawan_userinput', $row->karyawan_userinput),
                    'karyawan_tglinput' => set_value('karyawan_tglinput', $row->karyawan_tglinput),
            		'karyawan_usersupervisor' => set_value('karyawan_usersupervisor', $row->karyawan_usersupervisor),
                    'karyawan_pendidikan' => set_value('karyawan_pendidikan', $row->karyawan_pendidikan),
                    'karyawan_nikah' => set_value('karyawan_nikah', $row->karyawan_nikah),
                    'karyawan_bpjskesehatan' => set_value('karyawan_bpjskesehatan', $row->karyawan_bpjskesehatan),
                    'karyawan_bpjstenagakerja' => set_value('karyawan_bpjstenagakerja', $row->karyawan_bpjstenagakerja),
                    'karyawan_agama' => set_value('karyawan_agama', $row->karyawan_agama),
					'karyawan_ibu' => set_value('karyawan_ibu', $row->karyawan_ibu),
                    'karyawan_joindate' => set_value('karyawan_joindate', $row->karyawan_joindate),
                    'karyawan_tempatlahir' => set_value('karyawan_tempatlahir', $row->karyawan_tempatlahir),

	    );
            
		$x['content']=$this->load->view('trx_karyawan/trx_karyawan_form_update', $data,TRUE);
        $this->load->view('template',$x);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_karyawan'));
        }
    }
    
    public function update_action() 
    {
        $x['menu']=$this->m_general->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $supervisor=$this->session->userdata('user_supervisor');
        $id_group=$this->session->userdata('user_akses_level');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('karyawan_id', TRUE));
        } else {


	        if($this->input->post('karyawan_jk')=="Wanita") $karyawan_jk='Wanita'; else $karyawan_jk='Pria';
	        if($this->input->post('karyawan_aktif')=="Aktif") $karyawan_aktif='Aktif'; else $karyawan_aktif='Tidak Aktif';
	        if($this->input->post('kelamin')=="Pria") $kelamin='Pria'; else $kelamin='Wanita';
	        if($this->input->post('xstatus')=="KHL") $xstatus='KHL'; else $xstatus='PKWT';
            if($this->input->post('nikah')=="BELUM MENIKAH") $nikah='BELUM MENIKAH'; else $nikah='MENIKAH';

            if($this->input->post('pendidikan')=="S2/S3") {
                $pendidikan='S2/S3';
            }elseif($this->input->post('pendidikan')=="SLTP") {
                 $pendidikan='SLTP';
            }elseif($this->input->post('pendidikan')=="SLTA") {
                $pendidikan='SLTA';
            }elseif($this->input->post('pendidikan')=="D3") {
                $pendidikan='D3';
            }elseif($this->input->post('pendidikan')=="S1") {
                $pendidikan='S1';                        
            }else {
            $pendidikan='SD';                
            }


            if($this->input->post('agama')=="KRISTEN") {
                $agama='KRISTEN';
            }elseif($this->input->post('agama')=="HINDU") {
                 $agama='HINDU';
            }elseif($this->input->post('agama')=="BUDHA") {
                $agama='BUDHA';
            }elseif($this->input->post('agama')=="LAIN-LAIN") {
                $agama='LAIN-LAIN';                    
            }else {
                $agama='ISLAM';                
            }

        	if($id_group =='5') {
				$xsupervisor = $supervisor;
			}else{
				$xsupervisor = $this->input->post('karyawan_usersupervisor',TRUE);

			}
            $data = array(
        		'karyawan_jabatan_id' => $this->input->post('karyawan_jabatan_id',TRUE),
        		'karyawan_nama' => $this->input->post('karyawan_nama',TRUE),
        		'karyawan_alamat' => $this->input->post('karyawan_alamat',TRUE),
        		'karyawan_jk' => $kelamin,
        		'karyawan_telp' => $this->input->post('karyawan_telp',TRUE),
        		'karyawan_email' => $this->input->post('karyawan_email',TRUE),
        		'karyawan_norek' => $this->input->post('karyawan_norek',TRUE),
        		'karyawan_norek_an' => $this->input->post('karyawan_norek_an',TRUE),
        		'karyawan_deskripsi' => $this->input->post('karyawan_deskripsi',TRUE),
        		'karyawan_foto' => $this->input->post('karyawan_foto',TRUE),
        		'karyawan_status' => $xstatus,
        		'karyawan_jml_anak' => $this->input->post('karyawan_jml_anak',TRUE),
        		'karyawan_aktif' => $karyawan_aktif,
        		'karyawan_username' => $this->input->post('karyawan_username',TRUE),
        		'karyawan_password' => $this->input->post('karyawan_password',TRUE),
                'karyawan_usersupervisor' => $xsupervisor,
                'karyawan_pendidikan' => $pendidikan,
                'karyawan_nikah' => $nikah,
                'karyawan_bpjskesehatan' => $this->input->post('karyawan_bpjskesehatan',TRUE),
                'karyawan_bpjstenagakerja' => $this->input->post('karyawan_bpjstenagakerja',TRUE),
                'karyawan_agama' => $agama,
                'karyawan_joindate' => $this->input->post('karyawan_joindate',TRUE),
				'karyawan_ibu' => $this->input->post('karyawan_ibu',TRUE),
                'karyawan_tempatlahir' => $this->input->post('karyawan_tempatlahir',TRUE),
	    );

            $this->Trx_karyawan_model->update($this->input->post('karyawan_id', TRUE), $data);
            $messege= array(
					'messege'=> "Update Berhasil Disimpan"
				);
            $this->session->set_flashdata('success', $messege);
            redirect(site_url('trx_karyawan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Trx_karyawan_model->get_by_id($id);

        if ($row) {
            $this->Trx_karyawan_model->delete($id);
            $messege= array(
					'messege'=> "Delete Transaksi telah berhasil"
				);
            $this->session->set_flashdata('success', $messege);
            //redirect(site_url('trx_karyawan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('trx_karyawan'));
        }
	redirect(site_url('trx_karyawan'));
    }

    public function _rules() 
    {
    	$this->form_validation->set_rules('karyawan_jabatan_id', 'karyawan jabatan id', 'trim|required');
    	$this->form_validation->set_rules('karyawan_nama', 'karyawan nama', 'trim|required');
    	$this->form_validation->set_rules('karyawan_alamat', 'karyawan alamat', 'trim');
    	$this->form_validation->set_rules('karyawan_jk', 'karyawan jk', 'trim');
        $this->form_validation->set_rules('karyawan_telp', 'karyawan telp', 'trim');
    	$this->form_validation->set_rules('karyawan_email', 'karyawan email', 'trim');
    	$this->form_validation->set_rules('karyawan_norek', 'karyawan norek', 'trim');
    	$this->form_validation->set_rules('karyawan_norek_an', 'karyawan norek an', 'trim');
    	$this->form_validation->set_rules('karyawan_deskripsi', 'karyawan deskripsi', 'trim');
    	$this->form_validation->set_rules('karyawan_foto', 'karyawan foto', 'trim');
    	$this->form_validation->set_rules('karyawan_status', 'karyawan status', 'trim');
    	$this->form_validation->set_rules('karyawan_jml_anak', 'karyawan jml anak', 'trim');
    	$this->form_validation->set_rules('karyawan_username', 'karyawan username', 'trim');
    	$this->form_validation->set_rules('karyawan_password', 'karyawan password', 'trim');
    	$this->form_validation->set_rules('karyawan_id', 'karyawan_id', 'trim');
        $this->form_validation->set_rules('karyawan_pendidikan', 'karyawan pendidikan', 'trim');
        $this->form_validation->set_rules('karyawan_nikah', 'karyawan nikah', 'trim');
        $this->form_validation->set_rules('karyawan_bpjskesehatan', 'karyawan bpjskesehatan', 'trim');
        $this->form_validation->set_rules('karyawan_bpjstenagakerja', 'karyawan bpjstenagakerja', 'trim');
        $this->form_validation->set_rules('karyawan_agama', 'karyawan agama', 'trim');
        $this->form_validation->set_rules('karyawan_joindate', 'karyawan joindate', 'trim');
        $this->form_validation->set_rules('karyawan_tempatlahir', 'karyawan tempatlahir', 'trim');
		$this->form_validation->set_rules('karyawan_ibu', 'karyawan_ibu', 'trim');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

    }



    public function download()
    {
        $date_input=$this->input->post('tgl_daftar');
        $bln=array('01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'Mei','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December');

        $tgl=explode('-', $date_input);
        $x['tgl_awal']=$tgl[2] ." " .$bln[$tgl[1]] ." " .$tgl[0];
        $x['tgl_akhir']=$tgl[5] ." " .$bln[$tgl[4]] ." " .$tgl[3];
        $username=$this->session->userdata('username');
        $xid_group=$this->session->userdata('user_akses_level');
        if($this->session->userdata('admin')=='Y'){
            $x['data_karyawan']=$this->Trx_karyawan_model->download_karyawan('',$date_input,'');
        }else{
            $x['data_karyawan']=$this->Trx_karyawan_model->download_karyawan($username,$date_input, $xid_group);
        }
        
        $this->load->view('trx_karyawan/excel_trx_karyawan',$x);
    }

}

/* End of file Trx_karyawan.php */
/* Location: ./application/controllers/Trx_karyawan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-04 14:45:35 */
/* http://harviacode.com */
