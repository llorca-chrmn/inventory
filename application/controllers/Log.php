<?php 

class Log extends CI_Controller{

    public function __construct(){

        parent::__construct();
        $this->load->helpers('form');
        $this->load->library('form_validation');
        $this->load->model('log_model');
    }

    public function viewLog(){
        $res = $this->log_model->viewLog()->result();
        $data = array();

        foreach($res as $row){
            $rows = array();
            $rows[] = $row->id;
            $rows[] = $row->computer_id;
            $rows[] = $row->peripheral_id;
            $rows[] = $row->brand;
            $rows[] = $row->serial;
            $rows[] = $row->model;
            $rows[] = '<button class="btn btn-round btn-default btn-xs btnViewLog"><span class="fa fa-list"></span></button>';
            
            $data[] = $rows;
        }

        $response['data'] = $data;

        return $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function getAllRec($id){
        $res = $this->log_model->getAllRec($id)->result();
        $data = array();

        foreach($res as $row){
            $rows = array();
            $rows[] = $row->brand;
            $rows[] = $row->brand;
            $rows[] = $row->serial;
            
            $data[] = $rows;
        }

        $response['data'] = $data;
        return $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }
}