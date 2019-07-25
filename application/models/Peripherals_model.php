<?php

class Peripherals_model extends CI_Model{

    public function __construct(){

        parent::__construct();
        $this->load->database();
    }

    public function text(){
        echo "Sakura";
        echo "TEXT";
        echo 'Tserry';
    }

    public function save($table, $data){

        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function update($table, $id, $data){
        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update($table);

        return $this->db->affected_rows();
    }

    public function delete($table, $id){
        $this->db->where('id', $id);
        $this->db->delete($table);

        return $this->db->affected_rows();
    }

    public function deleteCategory($id){
        
        $this->db->where_in('peripheral_id', $id);
        $this->db->delete('peripheral_info');

        return $this->db->affected_rows();
    }

    public function getSpecific($table, $where){
        $this->db->where($where);
        $result = $this->db->get($table);

        return $result;
    }

    public function getAssetTitle(){
        $this->db->select('asset_name,id');
        $this->db->from('peripheral');
        return $this->db->get();
    }

    public function viewPeripherals(){
        $this->db->select('*,asset_name,peripheral_info.id as IDs');
        $this->db->from('peripheral_info');
        $this->db->join('peripheral', 'peripheral.id = peripheral_info.peripheral_id');
        $result = $this->db->get();

        return $result;
    }

    public function viewPeripheralsCategory(){
        $this->db->select('*');
        $this->db->from('peripheral');
        $result = $this->db->get();

        return $result;
    }

    public function SelectPeripheralsBy($column){
        $this->db->select($column);
        $this->db->from('peripheral_info');
        $this->db->join('peripheral', 'peripheral.id = peripheral_info.peripheral_id');
        //$this->db->where('spare',0);
        $result = $this->db->get();

        return $result;
    }

    public function addSpare($table, $id){
        $this->db->where('id', $id);
        $this->db->set('spare', 'spare+1', false);
        $this->db->update($table);

        return $this->db->affected_rows();
    }

    public function subSpare($table, $id){   
        $this->db->where('id', $id);
        $this->db->set('spare', 'spare-1', false);
        $this->db->update($table);

        return $this->db->affected_rows();
    }

    public function addDefected($table, $id){
        $this->db->where('id', $id);
        $this->db->set('defected', 'defected+1', false);
        $this->db->update($table);

        return $this->db->affected_rows();
    }

    public function subDefected($table, $id){   
        $this->db->where('id', $id);
        $this->db->set('defected', 'defected-1', false);
        $this->db->update($table);

        return $this->db->affected_rows();
    }

    public function addDeployed($table, $id){
        $this->db->where('id', $id);
        $this->db->set('deployed', 'deployed+1', false);
        $this->db->update($table);

        return $this->db->affected_rows();
    }

    public function subDeployed($table, $id){
        $this->db->where('id', $id);
        $this->db->set('deployed', 'deployed-1', false);
        $this->db->update($table);

        return $this->db->affected_rows();
    }

}