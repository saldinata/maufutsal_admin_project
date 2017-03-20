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


}

?>
