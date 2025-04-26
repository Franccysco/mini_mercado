<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function index()
    {

        //Dados a serem enviados para o cabeçalho
        $dados['title'] = 'Login';

        $this->form_validation->set_rules('identity', 'Login', 'required');
        $this->form_validation->set_rules('password', 'Senha', 'required');
        $this->form_validation->set_rules('remember', 'Lembrar-me', 'integer');

        if ($this->form_validation->run() === true) {
            // Recupera os dados do formulário
            $remember = (bool) $this->input->post('remember');

            $status = $this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember);
            // Checa o status da operação gravando a mensagem na seção
            if (!$status) {
                $this->session->set_flashdata('error', $this->ion_auth->errors());
            } else {
                $this->session->set_flashdata('success', $this->ion_auth->messages());
                // Redireciona o usuário para a home
                redirect(base_url("home"));
            }
        } else {
            $this->session->set_flashdata('error', validation_errors('<p>', '</p>'));
            // redirect(base_url('login'));

        }

       // $dados['titulo'] = 'Login';

        $this->load->view('admin/login', $dados);

    }

    // public function login()
    // {

    // }

    public function logout()
    {
        // log the user out
        $this->ion_auth->logout();

        // redirect them to the login page
        $this->session->set_flashdata('success', $this->ion_auth->messages());
        redirect(base_url('login'));

    }

}
