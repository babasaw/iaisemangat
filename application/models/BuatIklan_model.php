<?php defined('BASEPATH') OR exit('No direct script access allowed');


Class BuatIklan_model extends CI_Model {
    
    public function rules()
    {
        return [
          
            ['field' => 'nama_toko',
            'label' => 'namatoko',
            'rules' => 'required'],
            ['field' => 'isi_iklan',
            'label' => 'isiiklan',
            'rules' => 'required'],
            ['field' => 'lat_iklan',
            'label' => 'lat',
            'rules' => 'required'],
            ['field' => 'lon_iklan',
            'label' => 'lon',
            'rules' => 'required'],
            ['field' => 'waktu_kadaluarsa',
            'label' => 'nomor ijasah',
            'rules' => 'required'],
            ['field' => 'jarak_maks',
            'label' => 'nomor ijasah',
            'rules' => 'required']
        ];

    }

    public function PostIklan($data)
    { 
    $val = array(
            'id_iklan' => uniqid(),
        'nama_toko' => $data['nama_toko'],
        'isi_iklan' => $data['isi_iklan'],
        'lat_iklan' => $data['lat_iklan'],
        'lon_iklan' => $data['lon_iklan'],
        'waktu_kadaluarsa' => $data['waktu_kadaluarsa'],
        'jarak_maks' => $data['jarak_maks']
    );
          $this->db->insert('iai_iklan', $val);
          $error = $this->db->error();
    }
}

?>