<?php 

class Assets extends CI_Controller{

    public function __construct(){

        parent::__construct();
        $this->load->helpers('form');
        $this->load->library('form_validation');
        $this->load->model('assets_model', 'assets');
    }

    public function _json($response){
        
        return $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function addAsset(){
        $data = array(
            "type"      => 'computer',
            "row"       => $this->input->post('row'),
            "hostname"  => $this->input->post('hostname'),
            "serial"    => $this->input->post('serial'),
            "motherboard"=> $this->input->post('motherboard'),
            "processor" => $this->input->post('processor'),
            "VDCard"    => $this->input->post('videocard'),
            "space"     => $this->input->post('space'),
            "remarks"   => $this->input->post('remarks'),
            "RAM_model" => $this->input->post('RAM'),
            "diskDrive_model" => $this->input->post('Diskdrive'),    
            "Laptop_model" => 'none'   
        );
        
        $last_insert = $this->assets->save('computer',$data);       
        if($last_insert > 0){
            $data_peripherals1 = array(
                'computer_id' => $last_insert,
                'peripheral_id' => $this->input->post('motherboard')
            );

            $data_peripherals2 = array(
                'computer_id' => $last_insert,
                'peripheral_id' => $this->input->post('processor')
            );

            $data_peripherals3 = array(
                'computer_id' => $last_insert,
                'peripheral_id' => $this->input->post('videocard')
            );

            $data_peripherals4 = array(
                'computer_id' => $last_insert,
                'peripheral_id' => $this->input->post('RAM')
            );

            $data_peripherals5 = array(
                'computer_id' => $last_insert,
                'peripheral_id' => $this->input->post('Diskdrive')
            );

            $this->assets->save('computers_peripherals', $data_peripherals1); 
            $this->assets->save('computers_peripherals', $data_peripherals2); 
            $this->assets->save('computers_peripherals', $data_peripherals3); 
            $this->assets->save('computers_peripherals', $data_peripherals4); 
            $this->assets->save('computers_peripherals', $data_peripherals5); 

            $this->assets->save('log', $data_peripherals1); 
            $this->assets->save('log', $data_peripherals2); 
            $this->assets->save('log', $data_peripherals3); 
            $this->assets->save('log', $data_peripherals4); 
            $this->assets->save('log', $data_peripherals5); 

            $this->assets->updatePeripheralStatus("motherboard","deploy");
            $this->assets->updatePeripheralStatus("processor","deploy");
            $this->assets->updatePeripheralStatus("RAM","deploy");
            $this->assets->updatePeripheralStatus("Diskdrive","deploy");
            $this->assets->updatePeripheralStatus("Video Card","deploy");

            $this->assets->updateAssetStatus($this->input->post('motherboard'), "deploy");
            $this->assets->updateAssetStatus($this->input->post('processor'), "deploy");
            $this->assets->updateAssetStatus($this->input->post('videocard'), "deploy");
            $this->assets->updateAssetStatus($this->input->post('RAM'), "deploy");
            $this->assets->updateAssetStatus($this->input->post('Diskdrive'), "deploy");

            $response['status'] = TRUE;
        }else{
            $response['errors'] = $this->form_validation->error_array();
            $response['status'] = FALSE;
        }

        echo json_encode($response);  
    }

    public function addAsset_Laptop(){
        $data = array(
            "type"      => 'Laptop',
            "row"       => $this->input->post('row_Lp'),
            "hostname"  => $this->input->post('hostname_Lp'),
            "serial"    => $this->input->post('serial_Lp'),
            "motherboard"=> 'none',
            "processor" => 'none',
            "VDCard"    => 'none',
            "space"     => $this->input->post('space_Lp'),
            "remarks"   => $this->input->post('remarks_Lp'),
            "RAM_model" => 'none',
            "diskDrive_model" =>'none',
            "Laptop_model" => $this->input->post('laptop'),
        );

        $last_insert = $this->assets->save('computer',$data); 

        if($last_insert > 0){
            $data_peripherals1 = array(
                'computer_id' => $last_insert,
                'peripheral_id' => $this->input->post('laptop')
            );
            $this->assets->save('computers_peripherals', $data_peripherals1); 
            $this->assets->save('log', $data_peripherals1); 
            $this->assets->updatePeripheralStatus("laptop","deploy");
            $this->assets->updateAssetStatus($this->input->post('laptop'), "deploy");
            $response['status'] = TRUE;
        }else{
            $response['errors'] = $this->form_validation->error_array();
            $response['status'] = FALSE;
        }

        $response['status'] = TRUE;
        echo json_encode($response);  
    }

    public function addAsset_Additional($id){
        $data = $this->input->post('additional');

        if($id > 0){
            $data_peripherals1 = array(
                'computer_id' => $id,
                'peripheral_id' => $data
            );
            $this->assets->save('computers_peripherals', $data_peripherals1); 
            $this->assets->save('log', $data_peripherals1); 
            $item = $this->assets->getPeripheralID($data)->result();
            foreach ($item as $x){
                $status = $this->assets->getStatus($x->peripheral_id)->result();
                foreach($status as $s){
                    $this->assets->updatePeripheralStatus_id($x->peripheral_id, "deploy", $s->deployed,$s->defected,$s->spare);
                }
            }
            $this->assets->updateAssetStatus($data, "deploy");
         
            $response['status'] = TRUE;
            $response['data'] = $data;
        }else{
            $response['errors'] = $this->form_validation->error_array();
            $response['status'] = FALSE;
        }

        echo json_encode($response);  
    }

    public function updateAsset(){
        $data = array(
            "type"      => 'Computer',
            "row"       => $this->input->post('row'),
            "hostname"  => $this->input->post('hostname'),
            "serial"    => $this->input->post('serial'),
            "motherboard"=>$this->input->post('motherboard'),
            "processor" => $this->input->post('processor'),
            "RAM_model" => $this->input->post('RAM'),
            "diskDrive_model" => $this->input->post('Diskdrive'),
            "VDCard"    => $this->input->post('videocard'),
            "space"     => $this->input->post('space'),
            "remarks"   => $this->input->post('remarks')
        );

        $id = $this->input->post('id');

        $this->assets->update($id, $data);

        echo json_encode(array("status" => TRUE));
    }

    public function test(){

        $data['new'] = $this->assets->get();
        echo "<pre>";
        print_r($data);
    }

    public function getSpecific($id){
        $get = $this->assets->get($id)->result_array();

        $this->_json($get);
    }

    public function split($data){
        $ret = explode(",",$data);
        return $ret[1];
    } 

    public function viewComputer(){

        $data = array();
        $get = $this->assets->get()->result();
        foreach ($get as $list) {
            $row = array();
            $row[] = $list->id;
            $row[] = $list->type;
            $row[] = $list->row;
            $row[] = $list->serial;
            $row[] = $list->hostname;
            if($list->Laptop_model == 'none'){
                $item = $this->assets->getItems($list->motherboard)->result();
                    foreach ($item as $i) {
                        $row[] = $i->brand;
                    }
                $item = $this->assets->getItems($list->processor)->result();
                    foreach ($item as $i) {
                        $row[] = $i->brand;
                    }
                $item = $this->assets->getItems($list->RAM_model)->result();
                    foreach ($item as $i) {
                        $row[] = $i->brand;
                    }
                $item = $this->assets->getItems($list->diskDrive_model)->result();
                    foreach ($item as $i) {
                        $row[] = $i->brand;
                    }
                $item = $this->assets->getItems($list->VDCard)->result();
                    foreach ($item as $i) {
                        $row[] = $i->brand;
                    }
                    $row[] = $list->Laptop_model;
            }else{
                $row[] = $list->motherboard;
                $row[] = $list->processor;
                $row[] = $list->RAM_model;
                $row[] = $list->diskDrive_model;
                $row[] = $list->VDCard;

                $item = $this->assets->getItems($list->Laptop_model)->result();
                foreach ($item as $i) {
                    $row[] = $i->brand;
                }
            }  
            $row[] = $list->space;
            $row[] = $list->remarks;
                $row[] = $list->date_added;
                $row[] = '<button class="btn btn-round btn-info btn-xs btnUpdate"><span class="fa fa-pencil"></span></button>
                <button class="btn btn-round btn-danger btn-xs btnDelete"><span class="fa fa-trash"></span></button>
                <button class="btn btn-round btn-success btn-xs btnAdd" id = "btnAdd_id"><span class="fa fa-plus"></span></button>
                <button class="btn btn-round btn-primary btn-xs btnDelete_additional"><span class="fa fa-minus"></span></button>';
            $data[] = $row;
        }

        $this->_json(array('data' => $data));
    }

    public function deleteAsset($id){
        if(!is_numeric($id)){
            $response['status'] = FALSE;
            $response['message'] = "There was something wrong deleting";
        }else{
            $peri = $this->assets->getSpecificAsset($id)->result();
            foreach ($peri as $i){
                $item = $this->assets->getPeripheralID($i->peripheral_id)->result();
                foreach ($item as $x){
                    $status = $this->assets->getStatus($x->peripheral_id)->result();
                    foreach($status as $s){
                        $this->assets->updatePeripheralStatus_id($x->peripheral_id, "spare", $s->deployed,$s->defected,$s->spare);
                    }
                }
            }

            $specific = $this->assets->getSpecificAsset($id)->result();
            foreach ($specific as $i) {
                $this->assets->updateAssetStatus($i->peripheral_id, "spare");
            }

            $response['status'] = TRUE;
            $this->assets->delete($id);
        }

        return $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function deleteAsset_Laptop($id){
        if(!is_numeric($id)){
            $response['status'] = FALSE;
            $response['message'] = "There was something wrong deleting";
        }else{
            $peri = $this->assets->getSpecificAsset($id)->result();
            foreach ($peri as $i){
                $item = $this->assets->getPeripheralID($i->peripheral_id)->result();
                foreach ($item as $x){
                    $status = $this->assets->getStatus($x->peripheral_id)->result();
                    foreach($status as $s){
                        $this->assets->updatePeripheralStatus_id($x->peripheral_id, "spare", $s->deployed,$s->defected,$s->spare);
                    }
                }
            }

            $specific = $this->assets->getSpecificAsset($id)->result();
            foreach ($specific as $i) {
                $this->assets->updateAssetStatus($i->peripheral_id, "spare");
            }

            $response['status'] = TRUE;
            $this->assets->delete($id);
        }

       return $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function deleteAsset_Add(){
        $id = $this->input->post('additional_Del');

        if(!is_numeric($id)){
            $response['status'] = FALSE;
            $response['message'] = "There was something wrong deleting";
        }else{
            $specific = $this->assets->getPeripheralID($id)->result();
            foreach ($specific as $i) {
                $status = $this->assets->getStatus($i->peripheral_id)->result();
                foreach($status as $s){
                    $this->assets->updatePeripheralStatus_id($i->peripheral_id, "spare", $s->deployed,$s->defected,$s->spare);
                }
            }
            $active = $this->assets->updateAssetStatus($id, "spare");
            $this->assets->delete_Specific($id);

            $response['status'] = TRUE;
        }
        return $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function deleteAsset_AllAdd($id){
        if(!is_numeric($id)){
            $response['status'] = FALSE;
            $response['message'] = "There was something wrong deleting";
        }else{
            $specific = $this->assets->getSpecificAsset($id)->result();
            foreach($specific as $row){
                $asset = $this->assets->getPeripheralID($row->peripheral_id)->result();
                foreach ($asset as $i) {
                    $name = $this->assets->get_AssetName($i->peripheral_id)->result();
                    foreach ($name as $i) {
                        $rows = $i->asset_name;
                    }
                }
                if($rows !="Motherboard"&&$rows != "Processor"&&$rows != "RAM"&&$rows != "Diskdrive"&&$rows != "Video Card"&&$rows != "Laptop"){
                    $specific = $this->assets->getPeripheralID($row->peripheral_id)->result();
                     foreach ($specific as $i) {
                        $status = $this->assets->getStatus($i->peripheral_id)->result();
                        foreach($status as $s){
                            $this->assets->updatePeripheralStatus_id($i->peripheral_id, "spare", $s->deployed,$s->defected,$s->spare);
                        }
                    }
                    $active = $this->assets->updateAssetStatus($row->peripheral_id, "spare");
                    $this->assets->delete_Specific($row->peripheral_id);
                }
            }

            $response['status'] = TRUE;
        }
        return $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function getAll_Peripherals($id){
        $asset_peripheral = $this->assets->get_asset_peripheral('computer.id, peripheral.asset_name,peripheral_info.brand,peripheral_info.model',$id);
        $additional = $this->assets->getSpecificAsset($id)->result();

        $response['additional'] = $additional;
        $this->_json($response);
    }

    public function computerlItems(){
        $result = $this->assets->viewComputer()->result();
        $datas = array();
        
        foreach($result as $row){
            $rows = array();
            $rows[] = $row->id;
            $rows[] = $row->type;
            $rows[] = $row->row;
            $rows[] = $row->hostname;
            $rows[] = $row->serial;
            $rows[] = $row->motherboard;
            $rows[] = $row->processor;
            $rows[] = $row->VDCard;
            $rows[] = $row->RAM_model;
            $rows[] = $row->diskDrive_model;
            $datas[] = $rows;
        }

         $response['items'] = $datas;
         $this->_json($response);
    }

    public function getAdditionalPeripherals($id){
        $result = $this->assets->getSpecificAsset($id)->result();
        $datas = array();

        foreach($result as $row){
            $rows = array();
            $rows[] = $row->peripheral_id;
            $item = $this->assets->getItems($row->peripheral_id)->result();
            foreach ($item as $i) {
                $rows[] = $i->brand;
            }
            $asset = $this->assets->getPeripheralID($row->peripheral_id)->result();
            foreach ($asset as $i) {
                $name = $this->assets->get_AssetName($i->peripheral_id)->result();
                foreach ($name as $i) {
                    $rows[] = $i->asset_name;
                }
            }
            $datas[] = $rows;
        }

        $response['items'] = $datas;
        $this->_json($response);
    }

    public function view_additionalAsset($id){
        $result = $this->assets->getSpecificAsset($id)->result();
        $datas = array();
        
        foreach($result as $row){
            $additional = $this->assets->get_AllInfo($row->peripheral_id)->result();
            foreach($additional as $row){
                $rows = array();
                $rows[] = $row->id;
                $rows[] = $row->brand;
                $rows[] = $row->model;
                $asset = $this->assets->getPeripheralID($row->peripheral_id)->result();
                foreach ($asset as $i) {
                $name = $this->assets->get_AssetName($i->peripheral_id)->result();
                    foreach ($name as $x) {
                        $rows[] = $x->asset_name;
                    }
                }
                $datas[] = $rows;
            }
        }

        $response['items'] = $datas;
        $this->_json($response);
    }
}
