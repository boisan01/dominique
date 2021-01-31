<?php
defined('BASEPATH') or exit('No direct script access allowed');

require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class Ujian extends CI_Controller
{
	function __construct(){
		parent::__construct();
    	//load chart_model from model
		$this->load->model('Ujian_model'); //untuk panggil models
    }

    public function index(){
        if($this->session->userdata("nip") != Null){

            $a['data'] = $this->Ujian_model->get_tester();    

            //echo $a['data'];exit;
            //var_dump($a['data']);exit;
            
            $this->load->view('include/head');
            $this->load->view('include/top-header');
            $this->load->view('View_ujian', $a);  
            $this->load->view('include/sidebar');
            $this->load->view('include/panel');
            $this->load->view('include/footer'); 
        }else{
             redirect('user');
        }
    }
     
    public function tambah_tester(){

            $input['id_kategori'] = $this->input->post('id_kategori');
            $input['tentang'] = $this->input->post('tentang');
            $input['status'] = $this->input->post('status');
            $input['tahun'] = $this->input->post('tahun');
            $input['nomor'] = $this->input->post('nomor');
            $input['nama_kat'] = $this->input->post('nama_kat');


    $result = $this->Ujian_model->tambah($input); //lempar hasil $input ke function tambah

    if(!$result){
        $this->session->set_flashdata('error','Data gagal ditambahkan');
        redirect('Ujian');
    }else{
        $this->session->set_flashdata('error','Data berhasil ditambahkan');
        redirect('Ujian');
      
    }  
    }
public function edit_tester(){
     
    $edit = $this->input->post('id_prokum');
    
    $input['id_kategori'] = $this->input->post('id_kategori');
    $input['tentang'] = $this->input->post('tentang');
    $input['status'] = $this->input->post('status');
    $input['tahun'] = $this->input->post('tahun');
    $input['nomor'] = $this->input->post('nomor');
    $input['nama_kat'] = $this->input->post('nama_kat');

    $result = $this->Ujian_model->edit($input, $edit);

    if(!$result){
        $this->session->set_flashdata('error','Data gagal diedit');
        redirect('Ujian');
    }else{
        $this->session->set_flashdata('error','Data berhasil diedit');
        redirect('Ujian');
    } 
}

public function hapus_tester(){

    $jkt = $this->input->post('id_prokum');

    $result = $this->Ujian_model->hapus($jkt);

    if(!$result){
        $this->session->set_flashdata('error','Data gagal dihapus');
        redirect('Ujian');
    }else{  
        $this->session->set_flashdata('error','Data berhasil dihapus');
        redirect('Ujian');
    } 
}

Public function uploadPagu(){
    $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		if(isset($_FILES['pagu']['name']) && in_array($_FILES['pagu']['type'], $file_mimes)){

            $arr=explode(".",$_FILES['pagu']['name']);
            $ext=end($arr);
             
            if($ext != "xlsx"){
                $this->session->set_flashdata('notifpagu','File salah');
            }else{
                $reader= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }         
            $loadexcel=$reader->load($_FILES['pagu']['tmp_name']); //menampung nama asli file

            $sheet=$loadexcel->getSheetByName('SK REKTOR')->toArray(null,true,true,true);

                 $numrow=0;
                 //$cunit=0;
                 $unitsas=array();
                 $outputsas=array();
                 //$jatinangor=448302;
                 //$tgl = date('Y-m-d');
             foreach($sheet as $row){
                 $numrow++;
                 if($numrow > 1){
                        // if($row['A'] == 2){
                        //     if(strpos($row['AI'],'Perencanaan')){
                        //         $cbiro=1;
                        //             }elseif (strpos($row['AI'],'Keuangan')){
                        //                 $cbiro=2;
                        //                 }elseif (strpos($row['AI'],'Alumni')){
                        //                     $cbiro=3;
                        //                     }elseif (strpos($row['AI'],'Hukum')){
                        //                         $cbiro=4;
                        //         }
                        //     }
                            // else if ($row['A'] == 3){
                                 
                                //  $cunit++;
                                //  $regex = '/^[0-9]{4}/';
                                $idk = $row['A'];
                                $tentang = $row['B']; //setelah karakter 2020
                                $sts = $row['C'];
                                $uhuy = preg_match('/\b[0-9]{4}\b/', $row['B'], $tmp);
                                // $uhuy = preg_match('/\b[0-9.-]+\b/', $row['B'], $tmp);

                                
                                $nmr = substr($tentang,31, 10) ;
                                $namakat = substr($tentang, 0, 22);
                                  
                                //  if (preg_match($regex, $row['B'])) {
                                     //var_dump($tmp[0]);
                                //  }
                                //  $tentang=$row['B'];
                                //  $biro=$satkerbiro[0];
                                 
                                //  $id_c=($cunit <10)?$cbiro."0".$cunit:$cbiro.$cunit;

                                //  $ket=trim($row['AI']);

                                array_push($unitsas,array(
                                        'id_kategori' => $idk,
                                        'tentang' => $tentang,
                                        'status' => $sts,
                                        'tahun' => $tmp[0],
                                        'nomor' => $nmr,
                                        'nama_kat' => $namakat  
                                 ));
                                 

                                //  }
                        //          else if ($row['A'] == 5){

                        //             $ket = trim($row['AI']);
                                    
                        //             $ket = substr($ket,4);
                                    
                        //                 arid_b' => $biro,
                        //                 'iray_push($outputsas,array(
                        //                 'kode_satker' => $jatinangor,
                        //                 'd_c' => $id_c,
                        //                 'pagu' => $row['AB'],
                        //                 'realisasi' => $row['AC'],
                        //                 'ket' => $ket,
                        //                 'tanggal' => $tgl
                        
                        //             ));
                        
                        // }
                            
                        // print("<pre>$numrow".print_r($tmp,true)."<pre>");
                 }
                

             }
            $this->db->truncate('Ujian');
            $result = $this->db->insert_batch('Ujian',$unitsas);
            //  $this->db->insert_batch('output_sas',$outputsas);


            if($result){
                 $this->session->set_flashdata('notifpagu','Data berhasil disimpan');
                 redirect('Ujian');
            }
             
                
        }
    }
        
}

    
?>