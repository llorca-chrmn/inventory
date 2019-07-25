<?php

class Reports_model extends CI_Model{
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function totalSpare(){
        $this->db->select_sum('spare');
        $this->db->from('peripheral');
        return $this->db->get();
    }

    public function totalDeployed(){
        $this->db->select_sum('deployed');
        $this->db->from('peripheral');
        return $this->db->get();
    }

    public function totalDefected(){
        $this->db->select_sum('defected');
        $this->db->from('peripheral');
        return $this->db->get();
    }

    public function countByLocation(){
        $this->db->select('space, type, COUNT(id) as total');
        $this->db->select('sum(case when type = "Computer" then 1 else 0 end) as desktop');
        $this->db->select('sum(case when type = "Laptop" then 1 else 0 end) as laptop');
        $this->db->from('computer');
        $this->db->group_by('space');
        return $this->db->get();
    }

    public function totalPeripheral(){
        $this->db->select('asset_name, SUM(spare + defected + deployed) as total');
        $this->db->from('peripheral');
        $this->db->group_by('asset_name');

        return $this->db->get();
    }
}
