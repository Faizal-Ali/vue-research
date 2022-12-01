<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuser extends CI_Controller {

	public function __construct(){
		parent::__construct();
		Header('Access-Control-Allow-Origin: *');
		Header('Access-Control-Allow-Headers: *');
		header("Access-Control-Allow-Headers: *");
		$this->load->model('mo_res');
	}

	public function pengaturan(){
		$config['upload_path']          = './assets/user_files';
		$config['allowed_types']        = 'gif|jpg|png|jpeg|pdf';
		$config['overwrite'] 			= TRUE;
		$config['file_name'] 			= 'img_profile';

		$this->load->library('upload', $config);
		if($this->upload->do_upload('foto')){
			$this->mo_res->update('tb_user',array(
				'img' => json_encode($this->upload->data()),
				'username' => $_POST['username'],
				'password' => md5($_POST['password']),
			),array('id' => $_POST['id']));

			echo 'berhasil';
		}else{
			$error = array('error' => $this->upload->display_errors());
			echo 'gagal';
		}
	}
}
