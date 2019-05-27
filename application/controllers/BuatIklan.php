<?php
defined('BASEPATH') OR exit('No direct script access allowed');


Class BuatIklan extends CI_Controller {

public function __construct() {
parent::__construct();
$this->load->model('BuatIklan_model');

}


    


public function PostIklan() {
    $data = (array)json_decode(file_get_contents('php://input'));
    $iklan = $this->BuatIklan_model;
    $this->form_validation = new CI_Form_validation();
    $this->form_validation->set_data($data);
    $this->form_validation->set_rules($iklan->rules());
      if ($this->form_validation->run() == TRUE) {
        $iklan->PostIklan($data);
      $response['Status'] = 'Success';
      $response['Data'] =  'Iklan Berhasil Disimpan';
      getOutput($response,'200');
      }else{
        $response['Status'] = 'Error';
        $response['Error'] =  validation_errors();
        getOutput($response,'400');
      }

}


}
?>