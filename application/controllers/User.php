<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
  public function __construct(){
    parent::__construct();

    // Load Model
    $this->load->model('Main_model');

    // Load base_url
    $this->load->helper('url');
    //load database
    $this->load->database();
  }
  public function index(){
    $users = $this->Main_model->getInitialParents();

    $data['users'] = $users;

    $this->load->view('user_view',$data);
  }

  public function userDetails(){
    // POST data
    $postData = $this->input->post();

    // get data
    $data = $this->Main_model->getUserDetails($postData);
//$data = "<select><option value=\"asd\">asd</option></select>";
   echo json_encode($data);
  }

}