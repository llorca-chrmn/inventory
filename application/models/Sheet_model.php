<?php 


class Sheet_model extends CI_Model{

    public function __construct(){

        parent::__construct();
    }

    public function insert($data){

        $this->db->insert('log', $data);

        return $this->db->insert_id();
    }
}