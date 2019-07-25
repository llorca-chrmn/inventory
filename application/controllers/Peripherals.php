<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peripherals extends CI_Controller{

    public function __construct(){

        parent::__construct();
        $this->load->helpers('form');
        $this->load->library('form_validation');
        $this->load->model('peripherals_model', 'peripherals');
        $this->load->library('session');
    }

    private function _json_encode($response){

        return $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function insertPeripheral(){

        $this->form_validation->set_rules('asset_name','Asset Name', 'required|is_unique[peripheral.asset_name]',
                array('is_unique' => 'That asset is already added.'));

        if($this->form_validation->run() === TRUE){
            $peripheral_data = array(
                'asset_name' => $this->input->post('asset_name')
            );

            if($this->peripherals->save('peripheral', $peripheral_data)){
                $response['status'] = TRUE;
            }

        }else{
            $response['errors'] = $this->form_validation->error_array();
            $response['status'] = FALSE;
        }
        
        return $this->_json_encode($response);
    }

    public function updatePeripheral($id){

        $this->form_validation->set_rules('asset_name','Asset Name', 'required|is_unique[peripheral.asset_name]',
                array('is_unique' => 'That asset is already added.'));

        if($this->form_validation->run() === TRUE){
            $peripheral_data = array(
                'asset_name' => $this->input->post('asset_name')
            );

            if($this->peripherals->update('peripheral', $id, $peripheral_data)){
                $response['status'] = TRUE;
            }

        }else{
            $response['errors'] = $this->form_validation->error_array();
            $response['status'] = FALSE;
        }
        
        return $this->_json_encode($response);
    }

    public function PeripheralAsset(){
        $result = $this->peripherals->getAssetTitle()->result_array();
        $asset = array();
        $id = array();
        //print_r($result);

        foreach($result as $per => $key){
            // $data['id'] = $key['id'];
            // $data['asset'] = $key['asset_name'];
            //echo $key['id'] . $key['asset_name'];
            //$data[] = $key['id'];
            $asset[] = $key['asset_name'];
            $id[] = $key['id'];
        }
        //print_r($id);

        //print_r($result);
        $response['id'] = $id;
        $response['itemsList'] = $asset;
        $numPer = count($response['itemsList']);

        $response['status']  = TRUE;
        $response['noItem'] = $numPer;

        if($numPer === 0){
            $response['itemsList'] = "No peripherals";
            $response['status']  = FALSE;
            $response['noItem'] = 0;
        }
        
        //print_r($response);

        $this->_json_encode($response);
    }

    // public function insertPeripheralInfo(){

    //     $this->form_validation->set_rules('peripheral_id', 'Asset', 'required');
    //     $this->form_validation->set_rules('availability', 'Availability', 'required');

    //     if($this->form_validation->run() === TRUE){
    //         $peripheral_data = array(
    //             'asset_name' => $this->input->post('asset_name'),
    //             'availability' => $this->input->post('availability')
    //         );
    
    //         $id = $this->peripherals->save('peripheral',$peripheral_data);
    
    //         if($id){
    //             $response['status'] = TRUE;
    //             $response['last_id'] = $id;
    //             $peripheralinfo_data = array(
    //                 'brand' => $this->input->post('brand'),
    //                 'model' => $this->input->post('model'),
    //                 'serial'=> $this->input->post('serial'),
    //                 'remarks' =>$this->input->post('remarks'),
    //                 'peripheral_id'=> $id
    //             );

    //             $this->peripherals->save('peripheral_info', $peripheralinfo_data);
    //         }else{
    //             $response['errors']['input'] = "Input all fields";
    //         }
    //     }else{
    //         $response['errors'] = $this->form_validation->error_array();
    //         $response['status'] = FALSE;
    //     }




    //     $this->output->set_content_type('application/json')->set_output(json_encode($response));
    // }

    public function insertPeripheralInfo(){
        $peripheralinfo_data = array(
            'brand' => $this->input->post('brand'),
            'model' => $this->input->post('model'),
            'serial'=> $this->input->post('serial'),
            'port_type'=> $this->input->post('port_type'),
            'remarks' => $this->input->post('description'),
            'peripheral_id' => $this->input->post('peripheral_id'),
            'unit_cost' => $this->input->post('unit_cost'),
            'active_type' => 'spare'
        );

        $id = $this->input->post('peripheral_id');

        if($this->peripherals->save('peripheral_info', $peripheralinfo_data)){
            $this->peripherals->addSpare('peripheral', $id);
            //$response['return'] = $return;
            $response['status'] = TRUE;
        }else{
            $response['errors'] = $this->form_validation->error_array();
            $response['status'] = FALSE;
        }

        return $this->_json_encode($response);
    }
    
    public function updatePeripheralInfo($id){
        $where = array(
            'id' => $id
        );

        $result = $this->peripherals->getSpecific('peripheral_info', $where)->row();
        
        $peripheralinfo_data = array(
            'brand' => $this->input->post('brand'),
            'model' => $this->input->post('model'),
            'serial'=> $this->input->post('serial'),
            'port_type'=> $this->input->post('port_type'),
            'remarks' => $this->input->post('description'),
            'peripheral_id' => $this->input->post('peripheral_id'),
            'unit_cost' => $this->input->post('unit_cost')
        );

        $return = $this->peripherals->update('peripheral_info', $id, $peripheralinfo_data);
       
        if($result->peripheral_id != $this->input->post('peripheral_id')){
            $this->peripherals->subSpare('peripheral', $result->peripheral_id);
            $this->peripherals->addSpare('peripheral', $this->input->post('peripheral_id'));
        }
        
        $response['return'] = $return;
        $response['status'] = TRUE;

        $this->_json_encode($response);
    }

    public function deletePeripheral($id){
        $where = array(
            'id' => $id
        );

        $result = $this->peripherals->getSpecific('peripheral_info', $where)->row();
        if($result->active_type == "spare"){
            $this->peripherals->subSpare('peripheral', $result->peripheral_id);
        }else{
            $this->peripherals->subDefected('peripheral', $result->peripheral_id);
        }
        $return = $this->peripherals->delete('peripheral_info', $id);
        $response['return'] = $return;
        $response['status'] = TRUE;

        $this->_json_encode($response);
    }

    public function deletePeripheralCategory($id){
        $where = array(
            'id' => $id
        );

        $data = $this->peripherals->getSpecific('peripheral', $where)->row();
        if($data->deployed == 0){
            $return = $this->peripherals->deleteCategory($id);
            $this->peripherals->delete('peripheral', $id);
            $response['return'] = $return;
            $response['status'] = TRUE;
        }else{
            $response['status'] = FALSE;
        }
        
        $this->_json_encode($response);
    }

    public function viewPeripherals(){
        $res = $this->peripherals->viewPeripherals()->result();
        $data = array();

        foreach($res as $row){
            $rows = array();
            $rows[] = $row->IDs;
            $rows[] = $row->asset_name;
            $rows[] = $row->brand;
            $rows[] = $row->serial;
            $rows[] = $row->model;
            $rows[] = $row->port_type;
            $rows[] = $row->remarks;
            $rows[] = $row->unit_cost;
            $rows[] = $row->active_type;
            $rows[] = $row->active_type;

            $data[] = $rows;
        }

        $response['data'] = $data;

        $this->_json_encode($response);
    }

    public function viewPeripheralsCategory(){
        $res = $this->peripherals->viewPeripheralsCategory()->result();
        $data = array();

        foreach($res as $row){
            $rows = array();
            $rows[] = $row->id;
            $rows[] = $row->asset_name;
            $rows[] = $row->spare;
            $rows[] = $row->defected;
            $rows[] = $row->deployed;
            $rows[] = '<button class="btn btn-round btn-info btn-xs btnUpdateP"><span class="fa fa-pencil"></span></button>
            <button class="btn btn-round btn-danger btn-xs btnDeleteP"><span class="fa fa-trash"></span></button>';

            $data[] = $rows;
        }
        // echo "<pre>";
        // print_r($data);

        $response['data'] = $data;

        $this->_json_encode($response);
    }

    public function getRow($id){
        $where = array(
            'id' => $id
        );

        $result = $this->peripherals->getSpecific('peripheral_info', $where)->row();

        $response['row'] = $result;
        $response['status'] = TRUE;

        $this->_json_encode($response);
    }

    public function getRowCategory($id){
        $where = array(
            'id' => $id
        );

        $result = $this->peripherals->getSpecific('peripheral', $where)->row();

        $response['row'] = $result;
        $response['status'] = TRUE;

        $this->_json_encode($response);
    }

    public function autocompleteItems(){
        $result = $this->peripherals->SelectPeripheralsBy('peripheral_info.id,brand,serial,peripheral.asset_name')->result();

        // echo "<pre>";
        $datas = array();
        foreach($result as $row){
            $rows = array();
            $rows[] = $row->id;
            $rows[] = $row->asset_name;
            $rows[] = $row->brand;
            $rows[] = $row->serial;
            
            $datas[] = $rows;
        }
        // print_r($datas);

         $response['items'] = $datas;
         $this->_json_encode($response);
    }

    public function spareOrDefective($id){
        $where = array(
            'id' => $id
        );

        $result = $this->peripherals->getSpecific('peripheral_info', $where)->row();

        if($result->active_type != "deployed"){
            if($result->active_type == "spare"){
                $data = "defected";
                $this->peripherals->subSpare('peripheral', $result->peripheral_id);
                $this->peripherals->addDefected('peripheral', $result->peripheral_id);
            }else{
                $data = "spare";
                $this->peripherals->addSpare('peripheral', $result->peripheral_id);
                $this->peripherals->subDefected('peripheral', $result->peripheral_id);
            }

            $peripheral_data = array(
                "active_type" => $data
            );

            $this->peripherals->update('peripheral_info', $id, $peripheral_data);

            $response['status'] = TRUE;
        }else{
            $response['status'] = FALSE;
        }

        $this->_json_encode($response);
    }

    public function peripheralItems(){
        $result = $this->peripherals->viewPeripherals()->result();
        $datas = array();
        
        foreach($result as $row){
            $rows = array();
            $rows[] = $row->IDs;
            $rows[] = $row->asset_name;
            $rows[] = $row->brand;
            $rows[] = $row->serial;
            $rows[] = $row->spare;
            $rows[] = $row->active_type;
            
            $datas[] = $rows;
        }

         $response['items'] = $datas;
         $this->_json_encode($response);
    }
}