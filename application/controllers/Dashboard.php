<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        // if ($this->session->userdata['logged'] == TRUE)
        // { }
            
        // else
        // {
        //     $this->session->set_flashdata('message', '<div style="color : red;">Login Terlebih Dahulu</div>');
        //     redirect('Login');
        // }

        $this->load->model('M_dashboard');
    }

    public function index(){
         $this->load->view('exs');
    }

}
