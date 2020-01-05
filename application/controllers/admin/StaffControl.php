<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class StaffControl extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("StaffModel");
        $this->load->library('form_validation');
        $this->load->model("LogadminModel");
		if($this->LogadminModel->isNotLogin()) redirect(site_url('admin/login'));
    }

    public function index()
    {
        $data["staffs"] = $this->StaffModel->getAll();
        $this->load->view("admin/userStaff/listStaff", $data);
    }

    public function add()
    {
        $staff = $this->StaffModel;
        $validation = $this->form_validation;
        $validation->set_rules($staff->rules());

        if ($validation->run()) {
            $staff->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view("admin/userStaff/new_form");
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('admin/StaffControl');
       
        $staff = $this->StaffModel;
        $validation = $this->form_validation;
        $validation->set_rules($staff->rules());

        if ($validation->run()) {
            $staff->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["staff"] = $staff->getById($id);
        if (!$data["staff"]) show_404();
        
        $this->load->view("admin/userStaff/edit_form", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->StaffModel->delete($id)) {
            redirect(site_url('admin/StaffControl'));
        }
    }
}