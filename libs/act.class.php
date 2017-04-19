<?php

class ActivityApps
{
	private $db;
	private $util;
	private $auth;

	public function __construct($db,$util,$auth)
	{
		$this->db = $db;
		$this->util = $util;
		$this->auth = $auth;
	}

	public function createDistCode()
	{
		$genDistCode = "Dist-".mt_rand(10,100).time();
		$dataRespons = array
		(
				'distcode' => $genDistCode
		);

		return json_encode($dataRespons, JSON_PRETTY_PRINT);
	}

	public function reqstoredistdat($dist_name,$dist_addr,$dist_pic,$dist_private_phone,$dist_office_phone,$dist_mail)
	{
		$dataRespons = [];

		$dist_name				= $this->util->sanitation($dist_name);
		$dist_addr				= $this->util->sanitation($dist_addr);
		$dist_pic				= $this->util->sanitation($dist_pic);
		$dist_private_phone	= $this->util->sanitation($dist_private_phone);
		$dist_office_phone	= $this->util->sanitation($dist_office_phone);
		$dist_mail				= $this->util->sanitation($dist_mail);

		$req_distcode 			= json_decode($this->createDistCode());
		$dist_code 					= $req_distcode->{'distcode'};

		$query = "INSERT INTO tbl_distributor(nama_dist,code_dist) VALUES (?,?)";
		$result_store = $this->db->insertValue($query,[$dist_name,$dist_code]);

		if($result_store)
		{
			$query = "SELECT * FROM tbl_distributor WHERE code_dist=?";
			$result_get_id = $this->db->getValue($query,[$dist_code]);

			if($result_get_id)
			{
				$id_dist 	= $result_get_id['id_dist'];
				$query 		= "INSERT INTO tbl_detail_distributor(id_dist,alamat,PIC,nomor_telepon,no_kantor,email) VALUES(?,?,?,?,?,?)";

				$result_store_detail = $this->db->insertValue($query,[$id_dist,$dist_addr,$dist_pic,$dist_private_phone,$dist_office_phone,$dist_mail]);

				if($result_store_detail)
				{
					array_push($dataRespons,
						[
							'type' 		=> 'resstoredistdat',
							'state'		=> 'success'
						]
					);
				}
				else
				{
					array_push($dataRespons,
						[
							'type' 		=> 'resstoredistdat',
							'state'		=> 'fail'
						]
					);
				}
			}
		}

		else
		{
			array_push($dataRespons,
				[
					'type' 		=> 'resstoredistdat',
					'state'		=> 'fail'
				]
			);
		}

		echo json_encode($dataRespons, JSON_PRETTY_PRINT);
	}


	public function reqstoredistpro($dist_name,$dist_product,$dist_price,$dist_note)
	{
			$dataRespons = [];

			$dist_name		= $this->util->sanitation($dist_name);
			$dist_product 	= $this->util->sanitation($dist_product);
			$dist_price 	= $this->util->sanitation($dist_price);
			$dist_note		= $this->util->sanitation($dist_note);

			$query = "SELECT * FROM tbl_distributor WHERE code_dist=?";
			$result_get_id = $this->db->getValue($query,[$dist_name]);

			if($result_get_id)
			{
				$id_dist = $result_get_id['id_dist'];

				$query = "INSERT INTO tbl_product_dist(nama_product,id_dist,price,note) VALUES(?,?,?,?)";

				$result_store_dist_product = $this->db->insertValue($query,[$dist_name,$id_dist,$dist_price,$dist_note]);

				if($result_store_dist_product)
				{
					array_push($dataRespons,
						[
							'type' 		=> 'resstoredistpro',
							'state'		=> 'success'
						]
					);
				}
			}
			else
			{
				array_push($dataRespons,
					[
						'type' 		=> 'resstoredistpro',
						'state'		=> 'fail'
					]
				);
			}

			echo json_encode($dataRespons, JSON_PRETTY_PRINT);
	}


	public function reqgetalldistpro()
	{
		$dataRespons = [];

		$query = "SELECT * FROM tbl_product_dist";
		$result_get_all_product = $this->db->getAllValue($query);

		if(!empty($result_get_all_product))
		{
			foreach($result_get_all_product as $product_data)
			{
				$product_name 	= $product_data['nama_product'];
				$price 			= $product_data['price'];
				$note 			= $product_data['note'];
				$id_dist 		= $product_data['id_dist'];
				$product_id		= $product_data['id_product_dist'];

				$query = "SELECT * FROM tbl_distributor WHERE id_dist=?";
				$result_dist_info =	$this->db->getValue($query,[$id_dist]);

				$dist_name = $result_dist_info['nama_dist'];

				array_push($dataRespons,
				[
					'type'				=> 'resgetalldistpro',
					'product_name' 	=> $product_name,
					'product_id'		=> $product_id,
					'price'				=> $price,
					'note'				=> $note,
					'distributor'		=> $dist_name
				]);
			}

		}
		else
		{
			array_push($dataRespons,
			[
				'type'			=> 'resgetalldistpro',
				'product_name' => 'none',
				'product_id' 	=> 'none',
				'price'			=> 'none',
				'note'			=> 'none',
				'distributor'	=> 'none'
			]);
		}

		echo json_encode($dataRespons, JSON_PRETTY_PRINT);
	}

}

?>
