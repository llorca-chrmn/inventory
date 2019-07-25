<?php 

class Log_model extends CI_Model{

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function viewLog(){
        
        $this->db->select('*');
        $this->db->from('peripheral_info, log');
        $this->db->where('log.peripheral_id =  peripheral_info.id');
        $this->db->group_by('log.peripheral_id');
    
        $result = $this->db->get();

        return $result;
    }

    public function getAllRec($id){
        $this->db->select('*');
        $this->db->from('log');
        $this->db->join('peripheral_info', 'log.peripheral_id = peripheral_info.id');
        $this->db->join('computer', 'log.computer_id = computer.id');
        $this->db->where('log.peripheral_id', $id);


        $result = $this->db->get();

        return $result;
    }
}