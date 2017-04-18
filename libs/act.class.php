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

		$dist_name					= $this->util->sanitation($dist_name);
		$dist_addr					= $this->util->sanitation($dist_addr);
		$dist_pic						= $this->util->sanitation($dist_pic);
		$dist_private_phone	= $this->util->sanitation($dist_private_phone);
		$dist_office_phone	= $this->util->sanitation($dist_office_phone);
		$dist_mail					= $this->util->sanitation($dist_mail);

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

}

?>
