<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ReporterModel extends CI_Model
{
    private $_table = "reporter";

    public $id;
    public $name;
    public $password;
    public $photo = "default.jpg";
    public $username;

    public function rules()
    {
        return [
            ['field' => 'name',
            'label' => 'Name',
            'rules' => 'required'],

            ['field' => 'password',
            'label' => 'Password',
            'rules' => 'required'],
            
            ['field' => 'username',
            'label' => 'Username',
            'rules' => 'required']
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["Id" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
       //$this->product_id = uniqid();
        $this->name = $post["name"];
        $this->password = md5($post["password"]);
        $this->username = $post["username"];
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->id = $post["id"];
        $this->name = $post["name"];
        $this->password = md5($post["password"]);
        $this->username = $post["username"];
        $this->db->update($this->_table, $this, array("Id" => $this->id));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("Id" => $id));
    }
}