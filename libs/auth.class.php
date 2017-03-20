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

}

?>
