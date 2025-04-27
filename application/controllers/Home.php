<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {


	public function __construct()
	{
		parent::__construct();
		// $this->verify_login();
		
	}

	public function index()
	{
		$dados["title"] = "Home";
		$this->render_page('admin/home', $dados);
	}

	

}


