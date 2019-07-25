<?php
defined('BASEPATH') OR exit('');
class Reports extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model(['reports_model', 'peripherals_model']);
    }

    private function _json_encode($response){
        return $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function index(){
        $result = $this->reports_model->totalSpare()->result();
        $result1 = $this->reports_model->totalDeployed()->result();
        $result2 = $this->reports_model->totalDefected()->result();

        $spare = array();
        $deployed = array();
        $defected = array();

        foreach($result as $key){
            $spare[] = $key->spare;   
        }

        foreach($result1 as $key){
            $deployed[] = $key->deployed;   
        }

        foreach($result2 as $key){
            $defected[] = $key->defected;   
        }

        $response['spare'] = $spare;
        $response['deployed'] = $deployed;
        $response['defected'] = $defected;
        $response['status'] = true;

        $this->_json_encode($response);
    }

    public function countByLocation(){
        $column= $this->reports_model->countByLocation()->result();
        $data = array();

        foreach($column as $row){
            $rows = array();
            $rows[] = $row->space;
            $rows[] = $row->total;
            $rows[] = $row->desktop;
            $rows[] = $row->laptop;

            $data[] = $rows;
        }

        $response['data'] = $data;
        $response['status'] = true;
        $this->_json_encode($response);
    }

    public function totalPeripheral(){
        $column= $this->reports_model->totalPeripheral()->result();
        $data = array();

        foreach($column as $row){
            $rows = array();
            $rows[] = $row->asset_name;
            $rows[] = $row->total;

            $data[] = $rows;
        }

        $response['data'] = $data;
       
        $this->_json_encode($response);
    }
    
}