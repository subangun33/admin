<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meja extends CI_Controller {

    function __construct() {
        parent::__construct();
        // if ($this->session->userdata['logged'] == TRUE)
        // { }
            
        // else
        // {
        //     $this->session->set_flashdata('message', '<div style="color : red;">Login Terlebih Dahulu</div>');
        //     redirect('Login');
        // }

        $this->load->model('M_meja');
        $this->load->helper(array('form', 'url','tombol'));
    }

    public function index(){
         $this->load->view('meja');
    }

public function setView(){
        $result = $this->M_meja->getSemua()->result();
        $list   = array();
        $No     = 1;
        foreach ($result as $r) {
            $row    = array(
                        "no"             => $No,
                        "kode_meja"      => $r->kode_meja,
                        "no_meja"        => $r->no_meja,
                        "action"         => tombol($r->id_meja)
            );

            $list[] = $row;
            $No++;
        }   

        echo json_encode(array('data' => $list));
    }

     public function ajax_delete($id)
    {
        $this->M_meja->delete_by_kode($id);
        echo json_encode(array("status" => TRUE));
    }

    function ajax_add(){

        $kode_meja = $this->input->post('kode');
        $no_meja = $this->input->post('no_me');
        $aktif = $this->input->post('aktif');
 
        $data = array(
            "kode_meja"      => $kode_meja,
            "no_meja"        => $no_meja,
            "aktif"          => $aktif,
            
            );

        $this->M_meja->inputdata($data,'meja');
        echo json_encode(array("status" => TRUE));    
           
    }
    
       public function ajax_edit($id)
    {
        $data = $this->M_meja->edit($id);
        echo json_encode($data);
    }

    function ajax_update(){
        
        $kode_meja = $this->input->post('kode');
        $no_meja = $this->input->post('no_me');
        $aktif = $this->input->post('aktif');

    $data = array(  
         "kode_meja"      => $r->kode_meja,
         "no_meja"      => $r->no_meja,
         "aktif"          => $r->aktif,
            );

        $where = array(
        'ID' => $id
    );
 
        $this->M_meja->update($where,$data);
        echo json_encode(array("status" => TRUE));

}
}
