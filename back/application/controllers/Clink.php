<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clink extends CI_Controller {

	public function __construct(){
		parent::__construct();
		Header('Access-Control-Allow-Origin: *');
		Header('Access-Control-Allow-Headers: *');
		$this->load->model('mo_res');
	}

	public function index(){
		echo json_encode(array(
			'nama' => 'Faizal Ali',
			'nrp' => 3121510803
		));
	}

	public function view(){
		// $data = $this->mo_res->getAll('tb_link');
		$tgl_now = date('Y-m-d');
		$tgl_prev = date('Y-m-d', strtotime($tgl_now.'-1 days'));
		// echo $tgl_now.' => '.$tgl_prev;
		// exit;
		$join_data_link = 'tb_data_link_now.id_link = tb_data_link_prev.id_link and tb_data_link_prev.created_at like "%'.$tgl_prev.'%"';
		$this->db->select('tb_data_link_now.stok, tb_data_link_now.id_link as id, tb_data_link_now.total_terjual, (tb_data_link_now.total_terjual*tb_data_link_now.harga) as total_omset,
				tb_data_link_now.harga, (tb_data_link_now.total_terjual-tb_data_link_now.terjual_sebelumnya) as terjual_now,((tb_data_link_now.total_terjual-tb_data_link_now.terjual_sebelumnya)*tb_data_link_now.harga) as omset_now, 
				tb_data_link_prev.harga as harga_prev, (tb_data_link_prev.total_terjual-tb_data_link_prev.terjual_sebelumnya) as terjual_prev,((tb_data_link_prev.total_terjual-tb_data_link_prev.terjual_sebelumnya)*tb_data_link_prev.harga) as omset_prev,
				tb_link.link, tb_link.ecom, tb_link.nama_produk
			');
		$this->db->from('tb_data_link tb_data_link_now');
		$this->db->join('tb_data_link tb_data_link_prev',$join_data_link,'right');
		$this->db->where(array(
			'tb_data_link_now.created_at like' => date('%Y-m-d%'),
		));
		$this->db->join('tb_link','tb_data_link_now.id_link = tb_link.id','left');

		$data['data'] = $this->db->get()->result_array();
		// $data = $this->mo_res->getAll('tb_link');
		
		echo json_encode($data);
	}

	public function tambah(){
		$d = $_POST;

		$this->mo_res->input('tb_link',array(
			'nama_produk' => $d['nama_produk'],
			'link' => $d['link_produk'],
			'ecom' => $d['jenis_ecom']
		));
	}


	public function delete(){
		$this->mo_res->hapus('tb_link',array(
			'id' => $_GET['id']
		));
	}

	public function get_update(){
		$data = $this->mo_res->getWhere('tb_link',array(
			'id' => $_GET['id']
		));

		echo json_encode($data);
	}

	public function set_update(){
		$this->mo_res->update('tb_link',array(
			'nama_produk' => $_POST['nama_produk'],
			'link' => $_POST['link'],
			'ecom' => $_POST['ecom'],
		),array(
			'id' => $_POST['id']
		));
	}

	public function view_update_link(){
		$list_link = $this->db->select('*')->from('tb_link')
					 ->get()->result_array();

		$data_connecting = array();

		$get_tokped = $this->mo_res->getWhere('tb_link',array(
			'ecom' => 'tokopedia'
		),'*',1,0);

		$get_shopee = $this->mo_res->getWhere('tb_link',array(
			'ecom' => 'shopee'
		),'*',1,0);
		
		@array_push($data_connecting,@$get_shopee['data'][0]);
		@array_push($data_connecting,@$get_tokped['data'][0]);
		
		$data['list_connect'] = json_encode($data_connecting);
		$data['list_link'] = $list_link;
		
		if(!empty($data['list_link'])){
			$this->load->view('kompetitor/link/view_update',$data);
		}else{
			echo '<script>alert("update selesai")</script>';
		}
	}
}
