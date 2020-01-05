<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ReporterControl extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("ReporterModel");
        $this->load->library('form_validation');
        $this->load->model("LogadminModel");
		if($this->LogadminModel->isNotLogin()) redirect(site_url('admin/login'));
    }

    public function index()
    {
        $data["reporters"] = $this->ReporterModel->getAll();
        $this->load->view("admin/userReporter/listReporter", $data);
    }

    public function add()
    {
        $reporter = $this->ReporterModel;
        $validation = $this->form_validation;
        $validation->set_rules($reporter->rules());

        if ($validation->run()) {
            $reporter->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view("admin/userReporter/new_form");
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('admin/ReporterControl');
       
        $reporter = $this->ReporterModel;
        $validation = $this->form_validation;
        $validation->set_rules($reporter->rules());

        if ($validation->run()) {
            $reporter->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["reporter"] = $reporter->getById($id);
        if (!$data["reporter"]) show_404();
        
        $this->load->view("admin/userReporter/edit_form", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->ReporterModel->delete($id)) {
            redirect(site_url('admin/ReporterControl'));
        }
    }
}