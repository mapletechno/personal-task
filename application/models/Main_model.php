<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_model extends CI_Model {
  function getUsernames(){

    $this->db->select('username');
    $records = $this->db->get('users');
    $users = $records->result_array();
    return $users;
  }

  function getInitialParents(){
    $this->db->select('*');
    $this->db->where('parent_id', 0);
    $records = $this->db->get('categoriez');
    $users = $records->result_array();
    return $users;
  }
  function getUserDetails($postData=array()){
 
    $response = array();
 
    if(isset($postData['username']) ){
 
      // Select record
      // $this->db->select('*');
      // $this->db->where('username', $postData['username']);
      // $records = $this->db->get('users');
      // $response = $records->result_array();
 
      $this->db->select('*');
      $this->db->where('parent_id', $postData['username']);
      $records = $this->db->get('categoriez');
      $numRows = $records->num_rows();
      
      if($numRows < 1)
      {
        $this->db->select('*');
        $this->db->where('id', $postData['username']);
        $records = $this->db->get('categoriez');

        //get number of records in that category either A or B

        $this->db->select('*');
        $this->db->where('catType', $records->row()->catType);
        $cats = $this->db->get('categoriez');
        $catsNum = $cats->num_rows();

        //create repeated string
        $substr = str_repeat("sub ", $catsNum/2+1);

        //create the subcategory dynamically, according to it's parent category Type
        $datax = array('name'=> $substr. 'subcategory of '.$records->row()->catType, 'parent_id'=>$postData['username'], 'catType'=>$records->row()->catType);
        $this->db->insert('categoriez', $datax);
        $datax = array('name'=> $substr. ' subcategory of '.$records->row()->catType, 'parent_id'=>$postData['username'], 'catType'=>$records->row()->catType);
        $this->db->insert('categoriez', $datax);
        $this->db->select('*');
        $this->db->where('parent_id', $postData['username']);
        $records = $this->db->get('categoriez');
  
      }
      $response = $records->result_array();

      

    }
 
    return $response;
  }

}