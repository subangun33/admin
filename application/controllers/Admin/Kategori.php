<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

    function __construct() {
        parent::__construct();
        // if ($this->session->userdata['logged'] == TRUE)
        // { }
        // else
        // {
        //     $this->session->set_flashdata('message', '<div style="color : red;">Login Terlebih Dahulu</div>');
        //     redirect(base_url('login'));
        // }
         $this->load->helper(array('form', 'url','tombol')); 
         // $this->load->model(array('DbHelper', 'M_kategori')); 
         $this->load->library('form_validation'); 

    }

    public function index(){
        $this->load->view('exs');
    }

 public function setView(){
        $result = $this->M_kategori->getSemua()->result();
        $list   = array();
        $No     = 1;
        foreach ($result as $r) {
            $row    = array(
                        "no"        => $No,
                        "id"       => $r->ID,
                        "kode"       => $r->Kode,
                        "nama"        => $r->Nama,
                        "ket"    => $r->Ket,
                        "action"     => tombol($r->ID)
            );

            $list[] = $row;
            $No++;
        }   

        echo json_encode(array('data' => $list));
    }

    public function ajax_delete($id)
    {
        $this->M_kategori->delete_by_kode($id);
        echo json_encode(array("status" => TRUE));
    }

    function ajax_add(){

        $kode = $this->input->post('kode');
        $nama = $this->input->post('nama');
        $ket = $this->input->post('ket');
 
        $data = array(
            "Kode"       => $kode,
            "Nama"       => $nama,
            "Ket"       => $ket
            );

        $this->M_kategori->inputdata($data,'kategori');
        echo json_encode(array("status" => TRUE));    
           
    }
    
       public function ajax_edit($id)
    {
        $data = $this->M_kategori->edit($id);
        echo json_encode($data);
    }

    function ajax_update(){
        
        $id = $this->input->post('id');
        $kode = $this->input->post('kode');
        $nama = $this->input->post('nama');
        $ket = $this->input->post('ket');

    $data = array(  
        "Kode"       => $kode,
        "Nama"       => $nama,
        "Ket"       => $ket
            );

        $where = array(
        'ID' => $id
    );
 
        $this->M_kategori->update($where,$data);
        echo json_encode(array("status" => TRUE));

}

 
   
	
}
