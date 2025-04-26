<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    private $data = "";
    public function construct()
    {

        parent::__construct();
    }



    public function verify_login()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect(base_url('login'));
        }
    }

    public function verify_permission()
    {
        if (!$this->ion_auth->in_group('admin')) {
            // $this->session->set_flashdata('error', 'Sem permissão para acessar esta página!');
            // redirect(base_url(), 'refresh');

            redirect(base_url('acesso-restrito'));
        }

    }
    public function render_page($view, $data = null)
    {
        $viewdata = (empty($data)) ? $this->$data : $data;

        $this->load->view('template/header', $data);
        $this->load->view($view, $viewdata);
        $this->load->view('template/footer');
    }
}
