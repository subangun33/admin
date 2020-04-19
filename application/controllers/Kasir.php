<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir extends CI_Controller {

    function __construct() {
        parent::__construct();
        // if ($this->session->userdata['logged'] == TRUE)
        // { }
            
        // else
        // {
        //     $this->session->set_flashdata('message', '<div style="color : red;">Login Terlebih Dahulu</div>');
        //     redirect('Login');
        // }

        $this->load->model('M_kasir');
        $this->load->helper(array('form', 'url','tombol'));
    }

    public function index(){
         $this->load->view('kasir');
    }

public function setView(){
        $result = $this->M_kasir->getSemua()->result();
        $list   = array();
        $No     = 1;
        foreach ($result as $r) {
            $row    = array(
                        "no"                => $No,
                        "total"             => $r->total,
                        "nama_pemesan"      => $r->nama_pemesan,
                        "refdetail"         => $r->refdetail,
                        "meja"              => $r->meja,
                        "waktu_pemesanan"   => $r->waktu_pemesanan,
                        "action"            => tombol($r->id_menu)
            );

            $list[] = $row;
            $No++;
        }   

        echo json_encode(array('data' => $list));
    }

     public function ajax_delete($id)
    {
        $this->M_kasir->delete_by_kode($id);
        echo json_encode(array("status" => TRUE));
    }

    function ajax_add(){

        $total = $this->input->post('total');
        $nama_pemesan = $this->input->post('nama');
        $refdetail = $this->input->post('ref');
        $meja = $this->input->post('meja');
        $waktu_pemesanan = $this->input->post('waktu');
 
        $data = array(
            "total"             => $total,
            "nama_pemesan"    => $nama_pemesan,
            "refdetail"         => $refdetail,
            "meja"              => $meja,
            "waktu_pemesanan"   => $waktu_pemesanan,
            
            );

        $this->M_kasir->inputdata($data,'transaksi');
        echo json_encode(array("status" => TRUE));    
           
    }
    
       public function ajax_edit($id)
    {
        $data = $this->M_kasir->edit($id);
        echo json_encode($data);
    }

    function ajax_update(){
        
        $total = $this->input->post('total');
        $nama_pemesan = $this->input->post('nama');
        $refdetail = $this->input->post('ref');
        $meja = $this->input->post('meja');
        $waktu_pemesanan = $this->input->post('waktu');
 
        $data = array(
            "total"             => $total,
            "nama_pemesan"      => $nama_pemesan,
            "refdetail"         => $refdetail,
            "meja"              => $meja,
            "waktu_pemesanan"   => $waktu_pemesanan,
            );

        $where = array(
        'ID' => $id
    );
 
        $this->M_kasir->update($where,$data);
        echo json_encode(array("status" => TRUE));

}
}
