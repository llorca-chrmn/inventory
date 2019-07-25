<?php 
defined('BASEPATH') OR exit('');
class Navigation extends CI_Controller{

    public function __construct(){

        parent::__construct();
        $this->load->library('session');
    }

    public function computers(){
        if((!$this->session->userdata('username') && !$this->session->userdata('password'))){
            redirect(base_url());
        }else{
            $this->navigate('Computers', 'computer-tab', 'Computers');
        }
    }

    public function peripherals(){
        if((!$this->session->userdata('username') && !$this->session->userdata('password'))){
            redirect(base_url());
        }else{
            $this->navigate('Peripherals', 'peripherals', 'Peripherals');
        }
    }

    public function peripheralsCategory(){
        if((!$this->session->userdata('username') && !$this->session->userdata('password'))){
            redirect(base_url());
        }else{
            $this->navigate('Peripherals', 'peripheralsCategory', 'Peripherals');
        }
    }

    public function logs(){
        if((!$this->session->userdata('username') && !$this->session->userdata('password'))){
            redirect(base_url());
        }else{
            $this->navigate('Logs', 'dashboard', 'Logs');
        }
    }

    public function reports(){
        if(!$this->session->userdata('username') && !$this->session->userdata('password')){
            redirect(base_url());
        }else if(!$this->session->userdata('status')){
            $this->session->sess_destroy();
            redirect(base_url());
        }else{
            $this->navigate('Reports', 'reports','Reports');
        }
    }

    public function user(){
        if((!$this->session->userdata('username') && !$this->session->userdata('password')) || ($this->session->userdata('usertype') == 'User')){
            redirect(base_url());
        }else{
            $this->navigate('Users', 'users', 'Users');
        }
    }

    public function authenticate(){
        if((!$this->session->userdata('username') && !$this->session->userdata('password'))){
            $this->index_page('Welcome', 'index');
        }else{
           redirect(base_url('Reports'));
        }
    }

    public function first_log(){
        if((!$this->session->userdata('username') && !$this->session->userdata('password')) || $this->session->userdata('status') == 1){
            redirect(base_url());
        }else{
            $this->index_page('Update Info', 'pages/first_log');
        }
    }

    public function settings(){
        if((!$this->session->userdata('username') && !$this->session->userdata('password'))){
            redirect(base_url());
        }else{
            $this->navigate('Settings', 'settings');
        }
    }

    
    public function navigate($title, $page = NULL, $pageBanner = "", $bug = ""){
        $data['title'] = $title;
        $data['page'] = $pageBanner;
        // fix later,,,,,,,,,,,,,,,,,,,,,,
        $data['class'] = $bug;
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topnav');
        if($page != NULL){
            $this->load->view('pages/' .$page, $data);
        }
        $this->load->view('templates/footer');
    }

    public function index_page($title, $page = NULL){
        $data['title'] = $title;
        $this->load->view('templates/index_header', $data);
        $this->load->view($page);
        $this->load->view('templates/index_footer');
    }
}

?>