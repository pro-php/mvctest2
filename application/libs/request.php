<?php

class Request {

	public $get = array();
	public $post = array();
	public $cookie = array();

	public function __construct() {
	    $_GET 		= $this->clean($_GET);
		$_POST 		= $this->clean($_POST);
		$_COOKIE 	= $this->clean($_COOKIE);

		$this->get 	= &$_GET;
		$this->post 	= &$_POST;
		$this->cookie 	= &$_COOKIE;
	}

  	private function clean($data) {
		if (is_array($data)) {
	  		foreach ($data as $key => $value) {
				unset($data[$key]);
				$data[$this->clean($key)] = $this->clean($value);
	  		}
		} else {
	  		$data = trim($data);
			$data = htmlspecialchars($data, ENT_QUOTES);
		}
		return $data;
	}
}
?>