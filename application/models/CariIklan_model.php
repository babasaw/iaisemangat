<?php defined('BASEPATH') OR exit('No direct script access allowed');


Class CariIklan_model extends CI_Model {
    
    public function rules()
    {
        return [
          
            ['field' => 'lat_akses',
            'label' => 'lat',
            'rules' => 'required'],
            ['field' => 'lon_akses',
            'label' => 'lon',
            'rules' => 'required']
        ];

    }

    public function GetIklanAll($data)
    {  
        $tanggal=date('Y-m-d H:i:s');
            $query = $this->db->
            query(" SELECT *
            FROM iai_iklan
            WHERE WAKTU_KADALUARSA > '$tanggal';");
            $dataiklan = $query->result();
            return $dataiklan;
            $this->db->close();
    }

    public function GetIklanId($data)
    {  
        foreach($data as $cek){
            $query = $this->db->
            query(" SELECT
            nama_toko,
            isi_iklan,
            lat_iklan,
            lon_iklan,
            waktu_kadaluarsa
            FROM iai_iklan
            where id_iklan = '$cek';");
            $dataiklan[] = $query->row();
        }
            return $dataiklan;
            $this->db->close();

    }

}

?>