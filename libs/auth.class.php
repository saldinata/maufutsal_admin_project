<?php

class Authentication
{
	private $db;
	private $util;

	public function __construct($db,$util)
	{
		$this->db 	= $db;
		$this->util = $util;
	}

	public function reqchklogincookie()
	{
		$returnBack = 'false';

		if(isset($_COOKIE['mfadsytusr']))
		{
			$returnBack = 'true';
		}

		$dataRespons = array
		(
				'returnBack' => $returnBack
		);

		return json_encode($dataRespons,JSON_PRETTY_PRINT);
	}


	public function reqchklogin($username,$password)
	{
		$user = $this->util->sanitation($username);
		$pass = $this->util->sanitation($password);
		$pass = $this->util->encode($pass);

		$dataRespons = [];

		$query = "SELECT * FROM tbl_user WHERE username=? AND password=?";
		$result_chk = $this->db->getValue($query,[$user,$pass]);

		if(!empty($result_chk))
		{
			$level = $this->util->encode($result_chk['level']);
			$user  = $this->util->encode($user);

			setcookie("mfadsytusr", $user, time() + (86400 * 30), "/");
			setcookie("mfadsytlvl", $level, time() + (86400 * 30), "/");

			array_push($dataRespons,
			[
				'type'		=> 'reschklogin',
				'success'	=> 'true'

			]);
		}
		else
		{
			array_push($dataRespons,
			[
				'type'		=> 'reschklogin',
				'success'	=> 'false'
			]);
		}

		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}

	public function reqadduser($username,$password,$level_user)
	{

	}

	public function reqlogout()
	{
		$dataRespons = [];

		$user = $this->util->decode($_COOKIE["mfadsytusr"]);
		setcookie("mfadsytusr", $user, time() - 3600, "/");

		array_push($dataRespons,
		[
			'type'			=> 'reslogout',
			'destination'	=> 'login'
		]);
		echo json_encode($dataRespons,JSON_PRETTY_PRINT);
	}
}

?>
