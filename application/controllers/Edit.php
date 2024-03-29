<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit extends CI_Controller 
{
    // public function __construct()
    // {
    //     parent::__construct();
    //     is_logged_in();
    // }

    public function index()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user',['email'=>
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

     if($this->form_validation->run() == false){
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('edit/index', $data);
        $this->load->view('templates/footer');
    } else {
        $name = $this->input->post('name');
        $email = $this->input->post('email');

        $this->db->set('name', $name);
        $this->db->where('email', $email);
        $this->db->update('user');

        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Your profile has been update!</div>');
            redirect('admin');
        
    }
  }
}