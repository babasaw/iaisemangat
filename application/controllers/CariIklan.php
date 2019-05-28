<?php
defined('BASEPATH') OR exit('No direct script access allowed');


Class CariIklan extends CI_Controller {

public function __construct() {
parent::__construct();
$this->load->model('CariIklan_model');

}


public function _distance($lat1, $lat2, $lon1, $lon2) {
    if (($lat1 == $lat2) && ($lon1 == $lon2)) {
      $miles=0;
     return $miles;
    }
    else {
      $theta = $lon1 - $lon2;
      $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
      $dist = acos($dist);
      $dist = rad2deg($dist);
      $miles = $dist * 60 * 1.1515;
      return $miles * 1.609344;
    }

}

public function getiklanAll(){
    $data = (array)json_decode(file_get_contents('php://input'));
    // $lat1 = $data['lat_akses'];
    // $lon1 = $data['lon_akses'];
    $iklan = $this->CariIklan_model;
    $this->form_validation = new CI_Form_validation();
    $this->form_validation->set_data($data);
    $this->form_validation->set_rules($iklan->rules());
      if ($this->form_validation->run() == TRUE) {
        $lat1 = $data['lat_akses'];
        $lon1 = $data['lon_akses'];
         $hasil=$iklan->GetIklanAll($data);
         if($hasil!=null){
         foreach($hasil as $cek){
             $i=0;
            $lat2 = $cek->lat_iklan;
            $lon2 = $cek->lon_iklan;

            $jarak=$this->_distance($lat1, $lat2, $lon1, $lon2);
            if($jarak<=$cek->jarak_maks)
            {
                $iklanid[]=$cek->id_iklan;
            }
         }
         $hasil=$iklan->GetIklanID($iklanid);
         $response['Status'] = 'Berhasil';
         $response['Data'] =  $hasil;
         getOutput($response,'200');
        }
        else{
            $hasil=$iklan->GetIklanID($iklanid);
            $response['Status'] = 'Berhasil';
            $response['Data'] =  'tidak ada promo disekitar anda';
            getOutput($response,'200');
        }
        
     } else{
        $response['Status'] = 'Error';
        $response['Error'] =  validation_errors();
        getOutput($response,'400');
      }    
      $this->db->close();
}

}