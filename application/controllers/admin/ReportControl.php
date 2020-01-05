<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ReportControl extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("ReportModel");
        $this->load->model("LogadminModel");
		if($this->LogadminModel->isNotLogin()) redirect(site_url('admin/login'));
    }

    public function index()
    {
        $data["reports"] = $this->ReportModel->getAll();
        $this->load->view("admin/listReport/listReport", $data);
    }

    
    public function edit($no = null)
    {
        if (!isset($no)) redirect('admin/ReportControl');
       
        $report = $this->ReportModel;
        $report->update();
        $this->session->set_flashdata('success', 'Berhasil disimpan');
        

        $data["report"] = $report->getById($no);
        if (!$data["report"]) show_404();
        
        $this->load->view("admin/listReport/edit_report", $data);
    }

    public function delete($no=null)
    {
        if (!isset($no)) show_404();
        
        if ($this->ReportModel->delete($no)) {
            redirect(site_url('admin/ReportControl'));
        }
    }
}