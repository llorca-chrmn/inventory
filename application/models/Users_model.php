<?php 

class Users_model extends CI_Model{

	private $_table = 'user';

	public function __construct(){

		$this->load->database();
	}

	public function save($table, $data){

		$this->db->insert($table, $data);

		return $this->db->insert_id();
	}

	public function authenticate($username, $password){
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$query = $this->db->get($this->_table);

		return $query->result();
	}

	public function update($data, $where){
		$this->db->set($data);
		$this->db->where($where);
		$this->db->update($this->_table);

		return $this->db->affected_rows();
	}

	public function getDetails($id){

		$this->db->select('*');
		$this->db->from($this->_table);
		$this->db->join('user_info', 'user.userinfo_id = user_info.id');
		$this->db->where ('user.userinfo_id', $id);
		$result = $this->db->get();

		return $result->result();
	}
	public function viewUsers($id){
        $this->db->select('*');
		$this->db->from('user');
		$this->db->where ('id !=', $id);
        $result = $this->db->get();

        return $result;
	}
	
	public function deleteUser($id, $table){		
		$this->db->where('id', $id);
        $this->db->delete($table);

        return $this->db->affected_rows();
	}
}
 ?>