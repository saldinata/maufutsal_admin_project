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


	public function reqpubimg($id)
	{
		$id 		= $this->util->sanitation($id);
		$state 	= "A";
		$dataRespons = [];

		$query = "UPDATE tbl_slider SET state=? WHERE id_slider=?";
		$respons = $this->db->updateValue($query,[$state,$id]);

		array_push($dataRespons,
		[
			'type'		=> 'respubimg',
			'publish'	=> 'success'
		]);

		echo json_encode($dataRespons, JSON_PRETTY_PRINT);
	}

	public function reqnopubimg($id)
	{
		$id 		= $this->util->sanitation($id);
		$state 	= "NA";
		$dataRespons = [];

		$query = "UPDATE tbl_slider SET state=? WHERE id_slider=?";
		$respons = $this->db->updateValue($query,[$state,$id]);

		array_push($dataRespons,
		[
			'type'			=> 'resnopubimg',
			'nonpublish'	=> 'success'
		]);

		echo json_encode($dataRespons, JSON_PRETTY_PRINT);
	}

	public function reqdelsliderimg($id)
	{
		$id 		= (int) $this->util->sanitation($id);
		$dataRespons = [];

		$query 			= "SELECT * FROM tbl_slider WHERE id_slider=?";
		$get_pict_dat	= $this->db->getValue($query,[$id]);
		$pict_path		= "..\image\slider\\".$get_pict_dat['path'];

		$query = "DELETE FROM tbl_slider WHERE id_slider=?";
		$respons = $this->db->deleteValue($query,[$id]);

		unlink($pict_path);

		array_push($dataRespons,
		[
			'type'			=> 'resdelsliderimg',
			'deleteimg'		=> 'success'
		]);

		echo json_encode($dataRespons, JSON_PRETTY_PRINT);
	}

	public function reqdelmemacc($id)
	{
		$id = (int) $this->util->sanitation($id);
		$dataRespons = [];

		$query = "DELETE FROM tbl_user WHERE id_user=?";
		$respons = $this->db->deleteValue($query,[$id]);

		array_push($dataRespons,
		[
			'type'			=> 'resdelmemacc',
			'deleteacc'		=> 'success'
		]);

		echo json_encode($dataRespons, JSON_PRETTY_PRINT);
	}


	public function reqdelownacc($id)
	{
		$id = (int) $this->util->sanitation($id);
		$dataRespons = [];

		$query 	= "SELECT * FROM tbl_field_information WHERE id_user=?";
		$respons	= $this->db->getValue($query,[$id]);
		$court_reg	= $respons['court_reg'];
		$id_reg		= $respons['id_reg'];

		$query 	= "DELETE FROM tbl_detail_owner_futsal WHERE id_reg=?";
		$respons = $this->db->deleteValue($query,[$id_reg]);

		$query 	= "DELETE FROM tbl_harga_lapangan WHERE court_reg=?";
		$respons = $this->db->deleteValue($query,[$court_reg]);

		$query 	= "DELETE FROM tbl_harga_pembaharuan WHERE court_reg=?";
		$respons = $this->db->deleteValue($query,[$court_reg]);

		$query 	= "DELETE FROM tbl_arena_futsal WHERE court_reg=?";
		$respons = $this->db->deleteValue($query,[$court_reg]);

		$query 	= "DELETE FROM tbl_user WHERE id_user=?";
		$respons = $this->db->deleteValue($query,[$id]);

		$query 	= "DELETE FROM tbl_field_information WHERE id_user=?";
		$respons = $this->db->deleteValue($query,[$id]);

		array_push($dataRespons,
		[
			'type'			=> 'resdelownacc',
			'deleteacc'		=> 'success'
		]);

		echo json_encode($dataRespons, JSON_PRETTY_PRINT);
	}

	public function reqconfieresev($idbooking)
	{
		$idbooking 		= $this->util->sanitation($idbooking);
		$dataRespons	= [];
		$verification 	= "2";

		$query 	= "UPDATE tbl_booking_lapangan SET verification=? WHERE id_booking=? ";
		$result 	= $this->db->updateValue($query,[$verification,$idbooking]);

		array_push($dataRespons,
		[
			'type'	=> 'resconfieresev',
			'state'	=> 'success'
		]);

		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	public function reqconfigpayturn($idbooking)
  	{
  	    $dataRespons    = [];
  	    $idbooking      = $this->util->sanitation($idbooking);
  	    $verification   = "2";

  	    $query  = "UPDATE tbl_member_kompetisi SET verification=? WHERE id_member_kompetisi=?";
  	    $result = $this->db->updateValue($query,[$verification,$idbooking]);

  	    array_push($dataRespons,
  	    [
  	        'type'  =>  'resconfigpayturn',
  	        'state' =>  'success'
  	    ]);

  	    echo json_encode($dataRespons, JSON_PRETTY_PRINT);
  	}


	public function reqpayresfiedet($idbooking)
	{
		$idbooking 		= $this->util->sanitation($idbooking);
		$dataRespons	= [];

		$query	= "SELECT * FROM tbl_booking_lapangan WHERE id_booking=?";
		$result 	= $this->db->getAllValue($query,[$idbooking]);

		foreach($result as $data)
		{
			$court_reg 		= $data['court_reg'];
			$code_area		= $data['code_arena'];
			$code_category	= $data['code_category'];
			$bookers_mail 	= $data['id_user_member'];


			$query 		= "SELECT * FROM tbl_field_information WHERE court_reg=?";
			$field_data	= $this->db->getValue($query,[$court_reg]);

			$query		= "SELECT * FROM tbl_arena_futsal WHERE code_arena=?";
			$arena_data	= $this->db->getValue($query,[$code_area]);

			$query 		= "SELECT * FROM tbl_user WHERE username=?";
			$user_data 	= $this->db->getValue($query,[$bookers_mail]);

			array_push($dataRespons,
			[
				'type'			=> 'respayresfiedet',
				'date_time'		=> $data['date_time'],
				'field_name'	=> $field_data['nama_lapangan'],
				'address'		=> $field_data['alamat'],
				'arena_name'	=> $arena_data['nama_arena'],
				'usage'			=> $data['jam_mulai']."-".$data['jam_akhir'],
				'booking_num'	=> $data['nomor_booking'],
				'bookers_mail'	=> $bookers_mail,
				'bookers_name'	=> $user_data['name'],
				'nominal_trx'	=> $data['price']
			]);
		}

		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	public function reqpayturninfo($idbooking)
	{
		$idbooking 		= $this->util->sanitation($idbooking);
		$dataRespons	= [];

		$query	= "SELECT * FROM tbl_member_kompetisi WHERE id_member_kompetisi=?";
		$result 	= $this->db->getAllValue($query,[$idbooking]);

		  foreach($result as $data)
		  {
			  	$id_kompetisi = $data['id_kompetisi'];

				$query 			= "SELECT * FROM tbl_kompetisi WHERE id_kompetisi=?";
				$result_data	=  $this->db->getValue($query,[$id_kompetisi]);


				array_push($dataRespons,
				[
					 'type'          	=> 'respayturninfo',
					 'tanggal'       	=> $data['tanggal'],
					 'tanggal_trx'		=> $data['booking_datetime'],
					 'nominal'			=> $result_data['biaya'],
					 'nama_kompetisi'	=> $result_data['nama_kompetisi'],
					 'jenis_kompetisi'=> $result_data['jenis_kompetisi'],
					 'nama_team'     	=> $data['nama_team'],
					 'bank_name'     	=> $data['bank_name'],
					 'bank_account'  	=> $data['account_no'],
					 'account_name'  	=> $data['account_name'],
					 'code_reg'      	=> $data['code_reg']
				]);
		  }

		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	public function reqapprate($idharga)
	{
		$idharga 		= $this->util->sanitation($idharga);
		$dataRespons	= [];
		$change_state	= "1";

		$query 			= "UPDATE tbl_harga_lapangan SET status_price=? WHERE id_harga=?";
		$result_dana	= $this->db->updateValue($query,[$change_state,$idharga]);

		array_push($dataRespons,
		[
			'type'		=> 'resapprate',
			'success'	=>	'true'
		]);

		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	public function reqrejectrate($idharga)
	{
		$idharga 		= $this->util->sanitation($idharga);
		$dataRespons 	= [];
		$change_state	= "2";

		$query 			= "UPDATE tbl_harga_lapangan SET status_price=? WHERE id_harga=?";
		$result_dana	= $this->db->updateValue($query,[$change_state,$idharga]);

		array_push($dataRespons,
		[
			'type'		=> 'resrejectrate',
			'success'	=> 'true'
		]);

		echo json_encode($dataRespons, JSON_PRETTY_PRINT);
	}
}

?>
