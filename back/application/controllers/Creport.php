<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Creport extends CI_Controller {

	public function __construct(){
		parent::__construct();
		Header('Access-Control-Allow-Origin: *');
		Header('Access-Control-Allow-Headers: *');
		header("Access-Control-Allow-Headers: *");
		$this->load->model('mo_res');
	}

	public function get_report(){
		$data = $this->mo_res->getAll('tb_link');

		$arr_data_set = array();
		$arr_labels = array();
		
		for ($i=1; $i < date('t'); $i++) {
			$tgl = $i < 10 ? '0'.$i:$i;
			array_push($arr_labels,$tgl);
		}

		foreach($data['data'] as $d){
			$arr_data = array();
			for ($i=1; $i < date('t'); $i++) {
				$tgl = $i < 10 ? '0'.$i:$i;
				$get_data = $this->mo_res->getWhere('tb_data_link',array(
					'id_link' => $d['id'],
					'terjual_sebelumnya >' => 0,
					'updated_at like' => date('%Y-m-').$tgl.'%'
				));
				
				$penjualan = empty($get_data['data'][0]['terjual_sebelumnya'])?0:$get_data['data'][0]['total_terjual']-$get_data['data'][0]['terjual_sebelumnya'];
				array_push($arr_data,$penjualan);
			}

			$arr_temp = array(
				'label' => $d['nama_produk'],
				'data' => $arr_data,
				'borderColor' => sprintf ( "#%06X\n", mt_rand( 0, 0xFFFFFF ))
			);
			array_push($arr_data_set,$arr_temp);
		}

		$data = array(
			'labels' => $arr_labels,
			'datasets' => $arr_data_set
		);

		echo json_encode($data);
	}

	public function get_report_table(){
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
		$this->db->limit(5,0);
		$this->db->order_by('omset_now desc');
		$data['data'] = $this->db->get()->result_array();
		// $data = $this->mo_res->getAll('tb_link');
		
		echo json_encode($data);
	
	}
}
