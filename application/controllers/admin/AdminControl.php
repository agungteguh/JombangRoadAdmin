<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AdminControl extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("AdminModel");
        $this->load->library('form_validation');
        $this->load->model("LogadminModel");
		if($this->LogadminModel->isNotLogin()) redirect(site_url('admin/login'));
    }

    public function index()
    {
        $data["admins"] = $this->AdminModel->getAll();
        $this->load->view("admin/userAdmin/listAdmin", $data);
    }

    public function add()
    {
        $admin = $this->AdminModel;
        $validation = $this->form_validation;
        $validation->set_rules($admin->rules());

        if ($validation->run()) {
            $admin->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view("admin/userAdmin/new_form");
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('admin/AdminControl');
       
        $admin = $this->AdminModel;
        $validation = $this->form_validation;
        $validation->set_rules($admin->rules());

        if ($validation->run()) {
            $admin->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["admin"] = $admin->getById($id);
        if (!$data["admin"]) show_404();
        
        $this->load->view("admin/userAdmin/edit_form", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->AdminModel->delete($id)) {
            redirect(site_url('admin/AdminControl'));
        }
    }
}