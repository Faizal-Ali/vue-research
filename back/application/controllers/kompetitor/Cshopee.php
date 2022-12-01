<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cshopee extends CI_Controller {
	
	public function __construct(){
            
		parent::__construct();
		Header('Access-Control-Allow-Origin: *');
		Header('Access-Control-Allow-Headers: *');
		$this->load->model('mo_res');
	}

	public function index(){
		echo 'untuk shopee';
	}

    public function get_data_produk_shopee($prod_id,$shop_id){
		$link = 'https://shopee.co.id/api/v4/item/get/?itemid='.$prod_id.'&shopid='.$shop_id;
		$jsonData = file_get_contents($link);
		echo $jsonData;
	}

	public function coba(){
		header('Content-Type: application/json');
		$this->get_data_toko_shopee(375943633);
	}

    public function get_data_toko_shopee($shop_id){
        $link = 'https://shopee.co.id/api/v4/product/get_shop_info?shopid='.$shop_id;
        $jsonData = file_get_contents($link);
		echo $jsonData;
    }

	public function simpan_data_produk(){
		$cr_data = $this->mo_res->getWhere('tb_link',array(
			'link' => $_POST['url']
		));

		if($cr_data['row'] > 0){
			$d = $cr_data['data'][0];
			// update nama produk di tb_link
			$this->mo_res->update('tb_link',array(
				'nama_produk' => $_POST['nama_prod'],
				'id_toko' => $_POST['shop_id'],
			),array(
				'link' => $_POST['url']
			));

			// untuk update date di tb_data_link
			$cek_data_link = $this->mo_res->getWhere('tb_data_link',array(
				'id_link' => $d['id'],
				'updated_at like' => "%".date('Y-m-d')."%"
			));

			$cek_data_link_sebelumnya = $this->mo_res->getWhere('tb_data_link',array(
				'id_link' => $d['id'],
				'created_at like' => "%".date('Y-m-d',strtotime(date('Y-m-d').' -1 days'))."%"
			));
			
			$terjual_sebelumnya = @$cek_data_link_sebelumnya['data'][0]['total_terjual'];
			$terjual_sebelumnya = empty($terjual_sebelumnya)?0:$terjual_sebelumnya;
			
			if($cek_data_link['row'] > 0 ){
				$this->mo_res->update('tb_data_link',array(
					'harga' => $_POST['harga'],
					'stok' => $_POST['stok'],
					'total_terjual' => $_POST['terjual'],
					'updated_at' => date('Y-m-d H:i:s'),
					'terjual_sebelumnya' => $terjual_sebelumnya,
				),array(
					'id_link' => $d['id'],
					'created_at like' => "%".date('Y-m-d')."%"
				));
			}else{
				$arr_in_data_link = array(
					'harga' => $_POST['harga'],
					'stok' => $_POST['stok'],
					'total_terjual' => $_POST['terjual'],
					'id_link' => $d['id'],
					'updated_at' => date('Y-m-d H:i:s'),
					'terjual_sebelumnya' => $terjual_sebelumnya,
				);

				$this->mo_res->input('tb_data_link',$arr_in_data_link);
			}

			// update data link
			// $this->mo_res->update('tb_link',array(
			// 	'harga' => $_POST['harga'],
			// 	'stok' => $_POST['stok'],
			// 	'total_terjual' => $_POST['terjual'],
			// 	'updated_at' => date('Y-m-d H:i:s'),
			// ),array(
			// 	'id' => $d['id']
			// ));
		}
	}

	public function simpan_data_toko(){
		$cek_toko = $this->mo_res->getWhere('tb_toko',array(
			'id_shopee' => $_POST['shop_id'],
			'ecom' => 'shopee'
		));

		if($cek_toko['row'] > 0){
			$this->mo_res->update('tb_toko',array(
				'nama' => $_POST['nama_toko'],
				'lokasi' => $_POST['asal'],
				'rating_star' => $_POST['rating_star'],
				'updated_at' => date('Y-m-d H:i:s'),
			),array(
				'id_shopee' => $_POST['shop_id'],
				'ecom' => 'shopee'
			));
		}else{
			$this->mo_res->input('tb_toko',array(
				'nama' => $_POST['nama_toko'],
				'lokasi' => $_POST['asal'],
				'rating_star' => $_POST['rating_star'],
				'updated_at' => date('Y-m-d H:i:s'),
				'id_shopee' => $_POST['shop_id'],
				'ecom' => 'shopee'
			));
		}
	}

	public function cek_update_link(){
		$d['id'] = 6;
		$cek_data_link_sebelumnya = $this->mo_res->getWhere('tb_data_link',array(
			'id_link' => $d['id'],
			'created_at like' => "%".date('Y-m-d',strtotime(date('Y-m-d').' -1 days'))."%"
		));
		$terjual_sebelumnya = @$cek_data_link_sebelumnya['data'][0]['total_terjual'];
		echo $terjual_sebelumnya;
		
		echo $terjual_sebelumnya;
		echo "<pre>";
		print_r ($cek_data_link_sebelumnya);
		echo "</pre>";
		
	}
}