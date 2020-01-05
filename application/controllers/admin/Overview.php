<?php

class Overview extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
		$this->load->model("LogadminModel");
		if($this->LogadminModel->isNotLogin()) redirect(site_url('admin/login'));
	}

	public function index()
	{
        // load view admin/overview.php
        $this->load->view("admin/overview");
	}
}
