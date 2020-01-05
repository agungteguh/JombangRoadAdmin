<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ReportModel extends CI_Model
{
    private $_table = "report";

    public $no;
    public $name;
    public $reporterid;
    public $photo = "default.jpg";
    public $status;
    public $staffid;
    public $fixphoto;
    public $longlocation;
    public $latlocation;


    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($no)
    {
        return $this->db->get_where($this->_table, ["No" => $no])->row();
    }

    public function update()
    {
        $post = $this->input->post();
        $this->no = $post["no"];
        $this->name = $post["nama"];
        $this->reporterid = $post["reporterid"];
        $this->status = $post["status"];
        $this->staffid = $post["staffid"];
        $this->longlocation = $post["longlocation"];
        $this->latlocation = $post["latlocation"];
        $this->db->update($this->_table, $this, array("No" => $this->no));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("No" => $no));
    }
}