<?php
class Ujian_model extends CI_Model{

    public function get_tester(){
        return $this->db->query("SELECT * FROM ujian order by id_prokum")->result();
    }

    public function tambah($input){
        return $this->db->insert('ujian',$input); //masukan data ke database

    }
    
    public function edit($input, $edit){
        // var_dump($edit);exit();
        return $this->db->where('id_prokum', $edit)->update('ujian',$input); 
    }

    public function hapus($jkt){

        return $this->db->where('id_prokum', $jkt)->delete('ujian');
    }
         

        //$a = $this->db->query("");
        //return $a;
    } 