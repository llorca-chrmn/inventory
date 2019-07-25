<?php 

class Sheets extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->library('excel');
		$this->load->database();
		$this->load->model('assets_model', 'assets');
		$this->load->model('sheet_model', 'sheets');
	}

	public function db(){
		// print_r($this->db->hostname());
		$CI = &get_instance();
		$CI->load->database();
		echo $CI->db->hostname . "<br>";
		echo $CI->db->database . "<br>";
		echo $CI->db->username . "<br>";
		echo $CI->db->password . "<br>";
		return "----";
		/*
		host = localhost
		dbname = id3881716_inventory_system
		username = ejaymumar , id3881716_ejaymumar
		pw = 4132602123
		*/
	}

	public function test(){

		$this->load->view('test');
	}

	public function index(){

		echo "YEAH<br><br>";
		$get = $this->assets->get()->result();
		$rows = 1;
		foreach ($get as $row) {
			echo $rows ."  \t";
			echo $row->id .'<br>';
		}

		$letters = array();
		for($i = 'A'; $i <= 'Z'; $i++){
			$letters[] = $i;
		}
		// echo "<pre>";
		// print_r($letters);
		$get = $this->assets->get()->result();

		foreach ($letters as $letter) {
			echo $letter ."<br>";
		}

	}
	public function samples(){
		$get = $this->assets->get()->result();
		$total = count($get);

		

		// for ($i='a'; $i < 'z'; $i++) { 
		// 	echo $i .'<br>';
		// }
		$c = 65;
		foreach ($get as $row) {
			echo $row->hostname ."|" . chr($c) ."<br>";
			$c++;
		
		}
	}

	public function rar($r = 'sdsdd asdasdasds'){
		echo ucwords(strtolower($r));
	}

	public function read(){

		$file = FCPATH . 'assets\excel\computers.xls';

		$excel = PHPExcel_IOFactory::load($file);

		$cells = $excel->getActiveSheet()->getCellCollection();

		foreach ($cells as $cell){

			$column = $excel->getActiveSheet()->getCell($cell)->getColumn();
			$row = $excel->getActiveSheet()->getCell($cell)->getrow();
			$data_value = $excel->getActiveSheet()->getCell($cell)->getValue();

			if($row == 1){
				$header[$row][$column] = $data_value;
			}else{
				$arr_data[$row][$column] = $data_value;
			}
		}

		$data['header'] = $header;
		$data['values'] = $arr_data;

		echo $rows = $excel->setActiveSheetIndex(0)->getHighestRow();
		echo $col = $excel->setActiveSheetIndex(0)->getHighestColumn();
		$da = $excel->setActiveSheetIndex(0)->rangeToArray(
			'A2:'.$col.$row,Null, True, False
		);
		echo "<pre>";
		//echo $da[0][1];
		//echo $excel->getActiveSheet()->getCellByColumnAndRow(0,1)->getValue(); 
		for($i=2;$i<=$rows;$i++){	

	        $type = $excel->getActiveSheet()->getCellByColumnAndRow(1,$i)->getValue(); //type
	        $row = $excel->getActiveSheet()->getCellByColumnAndRow(2,$i)->getValue();
	        $hostname = $excel->getActiveSheet()->getCellByColumnAndRow(3,$i)->getValue();
	        $serial = $excel->getActiveSheet()->getCellByColumnAndRow(4,$i)->getValue();
	        $motherboard = $excel->getActiveSheet()->getCellByColumnAndRow(5,$i)->getValue();
	        $processor = $excel->getActiveSheet()->getCellByColumnAndRow(6,$i)->getValue();
	        $ram = $excel->getActiveSheet()->getCellByColumnAndRow(7,$i)->getValue();
	        $hdd = $excel->getActiveSheet()->getCellByColumnAndRow(8,$i)->getValue();
	        $vdcard = $excel->getActiveSheet()->getCellByColumnAndRow(9,$i)->getValue();
	        $space = $excel->getActiveSheet()->getCellByColumnAndRow(10,$i)->getValue();
	        $data_user = array(
		            "type"      => $type,
		            "row"       => $row,
		            "hostname"  => $hostname,
		            "serial"    => $serial,
		            "motherboard"=>$motherboard,
		            "processor" => $processor,
		            "RAM"       => $ram,
		            "HDD"       => $hdd,
		            "VDCard"    => $vdcard,
		            "space"     => $space
	        );
		 	
		 	$this->sheets->insert($data_user);

      	}

		echo "<br>";

		//print_r($da);


		

		// foreach ($da as $key) {
		// 	//$key;
		// 	foreach ($key as $value) {
		// 		echo $value.'<br>';
		// 	}
		// }

		
		//print_r($data);
	}

	public function insertDBV(){
		$this->load->view('test');
	}

	public function insertDB(){

		$config = array(
        	'upload_path'	=> './assets/excel',
        	'allowed_types'	=> 'gif|jpg|png'
        );

		$this->load->library('upload', $config);

		if(!$this->upload->do_upload('userfile')){

			$error = $this->upload->display_errors();

		}else{
			$upload_data = $this->upload->upload_data();
			$filename = $upload_data['file_name'];

			$reader = PHPExcel_IOFactory::createReader('Excel2007');
			$reader->setReadDataOnly(true);

			$excel = $reader->load(FCPATH. 'assets/excel/'.$filename);
			$totalrows = $excel->setActiveSheetIndex(0)->getHighestRow();
			$worksheet = $excel->setActiveSheetIndex(0);

			for($i=3;$i<=$totalrows;$i++){		
	              $type= $worksheet->getCellByColumnAndRow(1,$i)->getValue(); //Excel Column 1

				  $data = array(
		            "type"      => $type,
		            "row"       => $this->input->post('row'),
		            "hostname"  => $this->input->post('hostname'),
		            "serial"    => $this->input->post('serial'),
		            "motherboard"=>$this->input->post('motherboard'),
		            "processor" => $this->input->post('processor'),
		            "RAM"       => $this->input->post('RAM'),
		            "HDD"       => $this->input->post('HDD'),
		            "VDCard"    => $this->input->post('VDCard'),
		            "space"     => $this->input->post('space'),
		            "remarks"   => $this->input->post('remarks')
		        );
				  $this->sheets->insert($data_user);
	              
							  
	        }
		}
	}

	public function extodb(){
		$reader = PHPExcel_IOFactory::createReader('Excel2007');
		$reader->setReadDataOnly(true);

		$excel = $reader->load(FCPATH. 'assets\excel\computers.xls');
		$totalrows = $excel->setActiveSheetIndex(0)->getHighestRow();
		$worksheet = $excel->setActiveSheetIndex(0);

		for($i=3;$i<=$totalrows;$i++){		
              $type= $worksheet->getCellByColumnAndRow(1,$i)->getValue(); //Excel Column 1
              $row= $worksheet->getCellByColumnAndRow(2,$i)->getValue();
              $hostname = $worksheet->getCellByColumnAndRow(3,$i)->getValue();
              $serial = $worksheet->getCellByColumnAndRow(4,$i)->getValue();
              $motherboard = $worksheet->getCellByColumnAndRow(5,$i)->getValue();
              $processor = $worksheet->getCellByColumnAndRow(6,$i)->getValue();
              $ram = $worksheet->getCellByColumnAndRow(7,$i)->getValue();
              $hdd = $worksheet->getCellByColumnAndRow(8,$i)->getValue();
              $vdcard = $worksheet->getCellByColumnAndRow(9,$i)->getValue();
              $space = $worksheet->getCellByColumnAndRow(10,$i)->getValue();

			  $data = array(
	            "type"      => $type,
	            "row"       => $row,
	            "hostname"  => $hostname,
	            "serial"    => $serial,
	            "motherboard"=>$motherboard,
	            "processor" => $processor,
	            "RAM"       => $ram,
	            "HDD"       => $hdd,
	            "VDCard"    => $vdcard,
	            "space"     => $space
	        );
			  $this->sheets->insert($data_user);
              
						  
        }
	}

	public function columnStyle($letter,$rowheader, $cw, $bold = false, $allign = PHPExcel_Style_Alignment::HORIZONTAL_CENTER){

		$this->excel->getActiveSheet()->setCellValue($letter.'2',$rowheader);
		$this->excel->getActiveSheet()->getStyle($letter.'2')->getFont()->setSize(14)->setBold(true);
		$this->excel->getActiveSheet()->getStyle($letter.'2')->getAlignment()->setHorizontal($allign);

		$this->excel->getActiveSheet()->getColumnDimension($letter)->setWidth($cw);
		$this->excel->getActiveSheet()->getStyle($letter)->getFont()->setBold($bold);
		$this->excel->getActiveSheet()->getStyle($letter)->getAlignment()->setHorizontal($allign);
	}

	public function date(){

		echo Date('Y-m-d H:i:s');
		$date = '2017-12-06 10:30:56';

		echo "<br><br>".$date;
		echo "<br><br><br>";
		$ts = strtotime($date);
		echo date('F d, Y', $ts);

	}

	public function dummy(){
		echo 'SHEETS';
		//$this->load->view('test');
	}

	public function saveComputers(){
		$get = $this->assets->get()->result();

		$letters = array();
		for($i = 'A'; $i <= 'Z'; $i++){
			$letters[] = $i;
		}

		//TITLES
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('All Computers');

		$this->excel->getActiveSheet()->setCellValue('A1','ALL COMPUTERS');
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);

		$this->excel->getActiveSheet()->mergeCells('A1:M1');
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('A1:M1')->getFont()->setBold(true);

		// COLUMN STYLES
		$this->columnStyle('A','ID',4,true);
		$this->columnStyle('B','TYPE',10);
		$this->columnStyle('C','ROW',7);
		$this->columnStyle('D','HOSTNAME',15);
		$this->columnStyle('E','SERIAL',11,true);
		$this->columnStyle('F','MOTHERBOARD',22,true);
		$this->columnStyle('G','PROCESSOR',16);
		$this->columnStyle('H','RAM',11);
		$this->columnStyle('I','HDD SPACE',15);
		$this->columnStyle('J','VIDEO CARD',18);
		$this->columnStyle('K','SPACE',14);
		$this->columnStyle('L','DATE ADDED',20);
		$this->columnStyle('M','REMARKS',50);

		// $letter = 65;
		$cnt = 3;
		// $as = chr($letter);

		foreach ($get as $row) {
			$this->excel->getActiveSheet()->setCellValue('A'.$cnt, $row->id)
										->setCellValue('B'.$cnt, $row->type)
										->setCellValue('C'.$cnt, $row->row)
										->setCellValue('D'.$cnt, $row->hostname)
										->setCellValue('E'.$cnt, $row->serial)
										->setCellValue('F'.$cnt, $row->motherboard)
										->setCellValue('G'.$cnt, $row->processor)
										->setCellValue('H'.$cnt, $row->RAM)
										->setCellValue('I'.$cnt, $row->HDD)
										->setCellValue('J'.$cnt, $row->VDCard)
										->setCellValue('K'.$cnt, $row->space)
										->setCellValue('L'.$cnt, Date('F d, Y', strtotime($row->date_added)))
										->setCellValue('M'.$cnt, $row->remarks);						
			$cnt++;
		}

		// $this->excel->getActiveSheet()->fromArray($get);

		$filename = "computers.xls";

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' .$filename. '"');
		header('Cache-Control: max-age=0');

		$writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		$writer->save('php://output');

		// echo "<pre>";
		// print_r($get);
	}

	public function create(){

		$this->excel->setActiveSheetIndex(0);

		$this->excel->getActiveSheet()->setTitle('TEST');

		$this->excel->getActiveSheet()->setCellValue('B1','Example 1');

		$this->excel->getActiveSheet()->mergeCells('B1:E1');



		$filename = 'text.xls';

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' .$filename .'"');
		header('Cache-Control: max-age=0');

		$create = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');

		$create->save('php://output');
	}
}


?>