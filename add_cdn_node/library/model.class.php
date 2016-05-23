<?php
class Model extends SQLQuery {

	function __construct() {

		$this->connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	}

	function __destruct() {
	}
}
