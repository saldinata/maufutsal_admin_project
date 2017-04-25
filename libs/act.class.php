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


	public function reqorderdistpro($futsal_code,$nominal,$id_product)
	{
		$futsal_code 	= $this->util->sanitation($futsal_code);
		$nominal			= $this->util->sanitation($nominal);
		$id_product 	= $this->util->sanitation($id_product);
		$dateTransaction 	= $this->util->getDateTimeToday();
		$order_code			= mt_rand();
		$dataRespons 		= [];

		$query = "INSERT INTO tbl_order_third_party(tanggal, code_futsal, nominal, code_order, id_product_dist) VALUES(?,?,?,?,?)";
		$result_insert_data = $this->db->insertValue($query,[$dateTransaction,$futsal_code,$nominal,$order_code,$id_product]);


		if($result_insert_data)
		{
			array_push($dataRespons,
			[
				'type'			=> 'resorderdistpro',
				'state'			=>	'succes',
				'code_order'	=> $order_code
			]);
		}
		else
		{
			array_push($dataRespons,
			[
				'type'			=> 'resorderdistpro',
				'state'			=>	'failed',
				'code_order'	=> '-'
			]);
		}

		echo json_encode($dataRespons, JSON_PRETTY_PRINT);
	}

	public function reqsaveaboutcontent($contents)
	{
		$dataRespons = [];
		$contents 	= $contents;

		$this->util->setDefaultTimeZone("Asia/Bangkok");
		$date_content 	= $this->util->getDateTimeToday();

		$query 	= "SELECT * FROM tbl_web_about";
		$chk_db 	= $this->db->getAllValue($query);

		if(!empty($chk_db))
		{
			foreach($chk_db as $data_db)
			{
				$id_about = $data_db['id_about'];
			}

			$query = "UPDATE tbl_web_about SET date_content=?, content=? WHERE id_about=?";
			$update_value = $this->db->updateValue($query,[$date_content,$contents,$id_about]);

			array_push($dataRespons,
			[
				'type'	=> 'ressaveaboutcontent',
				'state'	=> 'success'
			]);
		}
		else
		{
			$query = "INSERT INTO tbl_web_about(date_content,content) VALUES(?,?)";
			$insert_value = $this->db->insertValue($query,[$date_content,$contents]);

			if($insert_value)
			{
				array_push($dataRespons,
				[
					'type'	=> 'ressaveaboutcontent',
					'state'	=> 'success'
				]);
			}
			else
			{
				array_push($dataRespons,
				[
					'type'	=> 'ressaveaboutcontent',
					'state'	=> 'fail'
				]);
			}
		}
		echo json_encode($dataRespons, JSON_PRETTY_PRINT);
	}



	public function reqsaveprivacycontent($contents)
	{
		$dataRespons = [];
		$contents 	= $contents;

		$this->util->setDefaultTimeZone("Asia/Bangkok");
		$date_content 	= $this->util->getDateTimeToday();

		$query 	= "SELECT * FROM tbl_web_privacy";
		$chk_db 	= $this->db->getAllValue($query);

		if(!empty($chk_db))
		{
			foreach($chk_db as $data_db)
			{
				$id_privacy = $data_db['id_privacy'];
			}

			$query = "UPDATE tbl_web_privacy SET date_content=?, content=? WHERE id_privacy=?";
			$update_value = $this->db->updateValue($query,[$date_content,$contents,$id_privacy]);

			array_push($dataRespons,
			[
				'type'	=> 'ressaveprivacycontent',
				'state'	=> 'success'
			]);
		}
		else
		{
			$query = "INSERT INTO tbl_web_privacy(date_content,content) VALUES(?,?)";
			$insert_value = $this->db->insertValue($query,[$date_content,$contents]);

			if($insert_value)
			{
				array_push($dataRespons,
				[
					'type'	=> 'ressaveprivacycontent',
					'state'	=> 'success'
				]);
			}
			else
			{
				array_push($dataRespons,
				[
					'type'	=> 'ressaveprivacycontent',
					'state'	=> 'fail'
				]);
			}
		}
		echo json_encode($dataRespons, JSON_PRETTY_PRINT);
	}


	public function reqsavecareercontent($contents)
	{
		$dataRespons = [];
		$contents 	= $contents;

		$this->util->setDefaultTimeZone("Asia/Bangkok");
		$date_content 	= $this->util->getDateTimeToday();

		$query 	= "SELECT * FROM tbl_web_career";
		$chk_db 	= $this->db->getAllValue($query);

		if(!empty($chk_db))
		{
			foreach($chk_db as $data_db)
			{
				$id_career = $data_db['id_career'];
			}

			$query = "UPDATE tbl_web_career SET date_content=?, content=? WHERE id_career=?";
			$update_value = $this->db->updateValue($query,[$date_content,$contents,$id_career]);

			array_push($dataRespons,
			[
				'type'	=> 'ressavecareercontent',
				'state'	=> 'success'
			]);
		}
		else
		{
			$query = "INSERT INTO tbl_web_career(date_content,content) VALUES(?,?)";
			$insert_value = $this->db->insertValue($query,[$date_content,$contents]);

			if($insert_value)
			{
				array_push($dataRespons,
				[
					'type'	=> 'ressavecareercontent',
					'state'	=> 'success'
				]);
			}
			else
			{
				array_push($dataRespons,
				[
					'type'	=> 'ressavecareercontent',
					'state'	=> 'fail'
				]);
			}
		}
		echo json_encode($dataRespons, JSON_PRETTY_PRINT);
	}


	public function reqsavecontactcontent($phone,$address,$company,$email)
	{
		$dataRespons = [];

		$phone 	= $this->util->sanitation($phone);
		$address = $this->util->sanitation($address);
		$company = $this->util->sanitation($company);
		$email 	= $this->util->sanitation($email);


		$query 	= "SELECT * FROM tbl_web_contact";
		$chk_db 	= $this->db->getAllValue($query);

		if(!empty($chk_db))
		{
			foreach($chk_db as $data_db)
			{
				$id_contact = $data_db['id_contact'];
			}

			$query = "UPDATE tbl_web_contact SET no_telp=?, alamat=?, perusahaan=?, email=? WHERE id_contact=?";
			$update_value = $this->db->updateValue($query,[$phone,$address,$company,$email,$id_contact]);

			array_push($dataRespons,
			[
				'type'	=> 'ressavecontactcontent',
				'state'	=> 'success'
			]);
		}
		else
		{
			$query = "INSERT INTO tbl_web_contact(no_telp,alamat,perusahaan,email) VALUES(?,?,?,?)";
			$insert_value = $this->db->insertValue($query,[$phone,$address,$company,$email]);

			if($insert_value)
			{
				array_push($dataRespons,
				[
					'type'	=> 'ressavecontactcontent',
					'state'	=> 'success'
				]);
			}
			else
			{
				array_push($dataRespons,
				[
					'type'	=> 'ressavecontactcontent',
					'state'	=> 'fail'
				]);
			}
		}
		echo json_encode($dataRespons, JSON_PRETTY_PRINT);
	}



	public function reqsavesocialcontent($facebook,$twitter,$instagram,$google)
	{
		$dataRespons = [];

		$facebook 	= $this->util->sanitation($facebook);
		$twitter 	= $this->util->sanitation($twitter);
		$instagram 	= $this->util->sanitation($instagram);
		$google		= $this->util->sanitation($google);


		$query 	= "SELECT * FROM tbl_web_social";
		$chk_db 	= $this->db->getAllValue($query);

		if(!empty($chk_db))
		{
			foreach($chk_db as $data_db)
			{
				$id_social = $data_db['id_social'];
			}

			$query = "UPDATE tbl_web_social SET facebook=?, twitter=?, instagram=?, google=? WHERE id_social=?";
			$update_value = $this->db->updateValue($query,[$facebook,$twitter,$instagram,$google,$id_social]);

			array_push($dataRespons,
			[
				'type'	=> 'ressavesocialcontent',
				'state'	=> 'success'
			]);
		}
		else
		{
			$query = "INSERT INTO tbl_web_social(facebook,twitter,instagram,google) VALUES(?,?,?,?)";
			$insert_value = $this->db->insertValue($query,[$facebook,$twitter,$instagram,$google]);

			if($insert_value)
			{
				array_push($dataRespons,
				[
					'type'	=> 'ressavesocialcontent',
					'state'	=> 'success'
				]);
			}
			else
			{
				array_push($dataRespons,
				[
					'type'	=> 'ressavesocialcontent',
					'state'	=> 'fail'
				]);
			}
		}
		echo json_encode($dataRespons, JSON_PRETTY_PRINT);
	}

}

?>
