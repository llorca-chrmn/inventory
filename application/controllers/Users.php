<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users extends CI_Controller{

	public function __construct(){

		parent::__construct();
		$this->load->helpers('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('Users_model', 'users');
		$this->load->model('Peripherals_model');
        // if($this->session->userdata(''))
	}

	private function _json_encode($response){

        return $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

	public function register(){

		$this->form_validation->set_rules('username-register', 'Username', 'required|is_unique[user.username]');
		$this->form_validation->set_rules('password-register', 'Password', 'required');
		$this->form_validation->set_rules('confirm-password', 'Password', 'required|matches[password-register]');

		
		if($this->form_validation->run() == FALSE){

			$response['status'] = FALSE;
			$response['errors'] = $this->form_validation->error_array();

			return $this->output->set_content_type('application/json')->set_output(json_encode($response));
		}else{
			$data = array(
				"username" => $this->input->post('username-register'),
				"password" => $this->input->post('password-register')
			);

			$temp = $this->users->save('user', $data);

			return $this->output->set_content_type('application/json')->set_output(json_encode(array("status" => TRUE)));
		}
	}

	public function logout(){
		session_destroy();
		redirect(base_url());
	}

	// TESTS
	// TESTS
	// TESTS
	// TESTS
	public function showS(){
		echo "<pre>";
		print_r($_SESSION);
	}

	public function test(){
		$result = $this->users->authenticate('cherry', 'ann');
		echo "<pre>";
		print_r($result);

		echo $result->id;
	}

	public function join(){
		$data = $this->users->getDetails('42');

		echo "<pre>";
		print_r($data);
	}
	// TESTS
	// TESTS
	// TESTS
	// TESTS

	public function authenticate(){

		$this->form_validation->set_rules('username', "Username", 'required');
		$this->form_validation->set_rules('password', "Password", 'required');

		if($this->form_validation->run() == FALSE){

			$response['status'] = FALSE;
			$response['errors'] = $this->form_validation->error_array();

			return $this->output->set_content_type('application/json')->set_output(json_encode($response));
		}else{
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$result = $this->users->authenticate($username, $password);

			if($result){
				$response['status'] = TRUE;
				$rows = array();
				foreach($result as $row){

					
					$rows['username'] = $row->username;
					$rows['password'] = $row->password;
					$rows['usertype'] = $row->usertype;
					$rows['added'] = $row->date_added;
					$rows['status'] = $row->status;
						if($row->status){
							$response['first_log'] = FALSE;
						}else{
							$response['first_log'] = TRUE;
						}
					$rows['id'] = $row->id;
					$rows['userinfo_id'] = $row->userinfo_id;
					$rows['logged_in'] = 1;
				}

				$this->session->set_userdata($rows);

				$get = $this->users->getDetails($this->session->userdata('userinfo_id'));

				foreach ($get as $row) {
					$rows['image'] = $row->image;
					$rows['firstname'] = $row->firstname;
					$rows['middlename'] = $row->middlename;
					$rows['lastname'] = $row->lastname;
					$rows['age'] = $row->age;
					$rows['DOB'] = $row->DOB;
					$rows['contact'] = $row->contact;
					$rows['email'] = $row->email;
				}

				$this->session->set_userdata($rows);

				//$this->users->getDetails();

				return $this->output->set_content_type('application/json')->set_output(json_encode($response));
			}else{

				$response['status'] = "NOT FOUND";
				$response['message'] = "That info was not found in the database or is incorrect";

				return $this->output->set_content_type('application/json')->set_output(json_encode($response));
			}

			$response['data'] = $result;
			$response['status'] = FALSE;
			$response['message'] = "Invalid Credentials";

			return $this->output->set_content_type('application/json')->set_output(json_encode($response));
		}
	}

	public function first_log(){

		$this->form_validation->set_rules('firstname', 'Firstname', 'trim|required|callback_alpha_space');
		$this->form_validation->set_rules('middlename', 'Middlename', 'trim|callback_alpha_space');
		$this->form_validation->set_rules('lastname', 'Lastname', 'trim|required|callback_alpha_space');
		$this->form_validation->set_rules('DOB', 'Date of Birth', 'required');
		$this->form_validation->set_rules('age', 'Age', 'required|integer');
		$this->form_validation->set_rules('contact', 'Contact', 'required|numeric');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');

		if($this->form_validation->run() == FALSE){

			$response['status'] = FALSE;
			$response['errors'] = $this->form_validation->error_array();

			return $this->output->set_content_type('application/json')->set_output(json_encode($response));
		}else{

	        $config = array(
	        	'upload_path'	=> './assets/build/profiles/',
	        	'allowed_types'	=> 'gif|jpg|png'
	        );

			$this->load->library('upload', $config);

			if(!$this->upload->do_upload('profile_pic')){

				$response['image_error'] = $this->upload->display_errors();
				$response['status'] = FALSE;

			}else{
				// $response['datas'] = $this->upload->data(); <-----------------------------------------//SAMPLE TO GET DETAILS OF THE IMAGE
				// $response['datas'] = $this->upload->data('detail'); <---------------------------------//SAMPLE TO GET ONE DETAILS O THE IMAGE

				$image_name = $this->upload->data('file_name');

				$insert_data = array(
					'firstname' => $this->input->post('firstname'),
					'middlename'=> $this->input->post('middlename'),
					'lastname' => $this->input->post('lastname'),
					'DOB' => $this->input->post('DOB'),
					'age' => $this->input->post('age'),
					'contact' => $this->input->post('contact'),
					'email' => $this->input->post('email'),
					'image' => $image_name
				);

				$id = $this->users->save('user_info', $insert_data);

				$response['status'] = TRUE;
				$response['last_id'] = $id;
				$this->session->set_userdata($insert_data);
			}
			return $this->output->set_content_type('application/json')->set_output(json_encode($response));
		}
	}

	public function update_first($id){

		$update_data = array(
			"status" => 1,
			"userinfo_id" => $id,
			"usertype" => "User"
		);

		$response['updated'] = TRUE;

		$where = array(
			"id" => $this->session->userdata('id')
		);

		$this->users->update($update_data, $where);
		$this->session->set_userdata('usertype', 'User');
		$this->session->set_userdata('status', '1');

		return $this->output->set_content_type('application/json')->set_output(json_encode($response));

	}


	public function alpha_space($text){

		if (! preg_match('/^[a-zA-Z ]+$/', $text)) {
	        $this->form_validation->set_message('alpha_space', 'The %s field is invalid');
	        return FALSE;
	    } else {
	        return TRUE;
	    }

	}

	public function viewUsers(){
		$res = $this->users->viewUsers($this->session->userdata('id'))->result();
        $data = array();

        foreach($res as $row){
            $rows = array();
            $rows[] = $row->id;
            $rows[] = $row->username;
			$rows[] = $row->usertype;
			$rows[] = '<a href="" data-toggle="modal" data-target="#frmEditType" class="editType">Change User Type</a>';
            $rows[] = '<button class="btn btn-round btn-danger btn-xs btnDelete"><span class="fa fa-trash"></span></button>';

            $data[] = $rows;
        }

        $response['data'] = $data;
        $this->_json_encode($response);
	}

	public function editUserType($id){
		
		$update_data = array(
			'usertype' => $this->input->post('usertype')
		);

		$this->Peripherals_model->update('user', $id, $update_data);
		$response['status'] = TRUE;
		
		$this->_json_encode($response);
	}

	public function getRowUser($id){
        $where = array(
            'id' => $id
        );

        $result = $this->Peripherals_model->getSpecific('user', $where)->row();

        $response['row'] = $result;
        $response['status'] = TRUE;

        $this->_json_encode($response);
	}
	
	public function deleteUser($id){
		$where = array(
            'id' => $id
		);
		
		$result = $this->Peripherals_model->getSpecific('user', $where)->row();

		$val = array(
			'id' => $result->userinfo_id
		);
		$data = $this->Peripherals_model->getSpecific('user_info', $val)->row();
		unlink("assets/build/profiles/".$data->image);
		$return = $this->users->deleteUser($result->userinfo_id, 'user_info');
        // $this->users->delete('user_info', $id);
        $response['return'] = $return;
        $response['status'] = TRUE;

        $this->_json_encode($response);
	}
	
	public function accountSettings(){

		$this->form_validation->set_rules('firstname', 'Firstname', 'trim|required|callback_alpha_space');
		$this->form_validation->set_rules('middlename', 'Middlename', 'trim|callback_alpha_space');
		$this->form_validation->set_rules('lastname', 'Lastname', 'trim|required|callback_alpha_space');
		$this->form_validation->set_rules('DOB', 'Date of Birth', 'required');
		$this->form_validation->set_rules('age', 'Age', 'required|integer');
		$this->form_validation->set_rules('contact', 'Contact', 'required|numeric');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');

		if($this->form_validation->run() == FALSE){

			$response['status'] = FALSE;
			$response['errors'] = $this->form_validation->error_array();

			return $this->output->set_content_type('application/json')->set_output(json_encode($response));
		}else{

	        $config = array(
	        	'upload_path'	=> './assets/build/profiles/',
	        	'allowed_types'	=> 'gif|jpg|png'
	        );

			$this->load->library('upload', $config);

			if($this->upload->do_upload('profile_pic')){
				$image_name = $this->upload->data('file_name');
				if($this->session->userdata('image')){
					unlink("assets/build/profiles/".$this->session->userdata('image'));
				}
			}else{
				$image_name = $this->session->userdata('image');
			}
				
			$insert_data = array(
				'firstname' => $this->input->post('firstname'),
				'middlename'=> $this->input->post('middlename'),
				'lastname' => $this->input->post('lastname'),
				'DOB' => $this->input->post('DOB'),
				'age' => $this->input->post('age'),
				'contact' => $this->input->post('contact'),
				'email' => $this->input->post('email'),
				'image' => $image_name
			);

			$id = $this->Peripherals_model->update('user_info', $this->session->userdata('userinfo_id'), $insert_data);

			$response['status'] = TRUE;
			
			$this->session->set_userdata($insert_data);
			
			return $this->output->set_content_type('application/json')->set_output(json_encode($response));
		}
	}
}

?>