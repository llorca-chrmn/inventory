<?php 

class Assets_model extends CI_Model{

    private $_table = 'computer';
    private $_tablePeri = 'computers_peripherals';

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function save($table,$data){
        $this->db->insert($table, $data);
        return $this->db->insert_id(); 
    }

    public function get($id = NULL){
        if(is_numeric($id)){
            $this->db->where('id', $id);
        }else{
            return $this->db->get($this->_table);    
        }
        return  $this->db->get($this->_table);
    }

    public function delete($id){
        $this->db->where('id',$id);
        $this->db->delete($this->_table);
    }

    public function delete_Specific($id){
        $this->db->where('peripheral_id', $id);
        $this->db->delete($this->_tablePeri);
    }

    public function update($id, $data){
        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update($this->_table);
    }

    public function insert_peripherals($data){
        $this->db->insert('computers_peripherals',$data);
        return $this->db->insert_id();
    }

    public function update_peripheral_usage($id){
        $this->db->set('is_used', 1);
        $this->db->where('id', $id);
        $this->db->update('peripheral_info');

        return true;
    }
    
    public function get_asset_peripheral($select = '*', $id){
        $this->db->select($select);
        $this->db->from('computer');
        $this->db->join('computers_peripherals', 'computer.id = computers_peripherals.computer_id');
        $this->db->join('peripheral_info', 'computers_peripherals.peripheral_id = peripheral_info.id');
        $this->db->join('peripheral', 'peripheral_info.peripheral_id = peripheral.id');
        $this->db->where('computer.id', $id);

        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function viewComputer(){
        $this->db->select('*,type,computer.id as IDs');
        $this->db->from('computer');
        $result = $this->db->get();

        return $result;
    }

    public function getItems($id){
        $this->db->select('brand');
        $this->db->where('id', $id);
        $this->db->from('peripheral_info');
        $result = $this->db->get();
        return $result;
    }

    public function updatePeripheralStatus($data, $type){
        if($type == "deploy"){
            if('spare' == 0){
                $this->db->set('spare', 0, false);
            }else{
                $this->db->set('spare', 'spare-1', false);
            }
            $this->db->set('deployed', 'deployed+1', false);
        }else{
            if('deployed' == 0){
                $this->db->set('deployed', 0, false);
            }else{
                $this->db->set('deployed', 'deployed-1', false);
            }
            $this->db->set('spare', 'spare+1', false);
        }
        $this->db->where('asset_name', $data);
        $this->db->update("peripheral");
    }

    public function updatePeripheralStatus_id($data, $type,$deployed,$defected,$spare){
        if($type == "deploy"){
            if($spare == 0){
                $this->db->set('spare', 0, false);
            }else{
                $this->db->set('spare', 'spare-1', false);
            }
            $this->db->set('deployed', 'deployed+1', false);
        }else{
            if($deployed == 0){
                $this->db->set('deployed', 0, false);
            }else{
                $this->db->set('deployed', 'deployed-1', false);
            }
            $this->db->set('spare', 'spare+1', false);
        }
        $this->db->where('id', $data);
        $this->db->update("peripheral");
    }

    public function updateAssetStatus($id, $type){
        if($type == "deploy"){
            $this->db->set('active_type', "deployed");
        }else{
            $this->db->set('active_type', "spare");
        }
        $this->db->where('id', $id);
        $this->db->update("peripheral_info");
    }

    public function getSpecificAsset($id){
        $this->db->select('peripheral_id');
        $this->db->where('computer_id', $id);
        $this->db->from('computers_peripherals');
        $result = $this->db->get();
        return $result;
    }

    public function getPeripheralID($id){
        $this->db->select('peripheral_id');
        $this->db->where('id', $id);
        $this->db->from('peripheral_info');
        $result = $this->db->get();
        return $result;
    }

    public function get_AssetName($id){
        $this->db->select('asset_name');
        $this->db->where('id', $id);
        $this->db->from('peripheral');
        $result = $this->db->get();
        return $result;
    }

    public function getStatus($id){
        $this->db->select('deployed,defected,spare');
        $this->db->where('id', $id);
        $this->db->from('peripheral');
        $result = $this->db->get();
        return $result;
    }

    public function get_AllInfo($id){
        $this->db->select('id,brand,model,peripheral_id');
        $this->db->where('id', $id);
        $this->db->from('peripheral_info');
        $result = $this->db->get();
        return $result;
    }
}