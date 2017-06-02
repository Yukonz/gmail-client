<?php

class Login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
    }

    public function process()
    {
        $this->form_validation->set_rules('name', 'Login', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            $data['msg'] = NULL;
            $this->load->view('login.php', $data);
        } else {
            $password = $this->input->post('password');
            $username = $this->input->post('name');

            if (!strpos($username, '@gmail.com')) {
                $username .= "@gmail.com";
            }

            $connect = $this->login_model->check_connection($username, $password);

            if ($connect) {
                $this->login_model->add_account_data($username, $password);
                redirect('inbox/INBOX');
            } else {
                $data['msg'] = "Проверьте введенные данные!";
                $this->load->view('login.php', $data);
            }
        }
    }

    public function index()
    {
        $accountExists = $this->login_model->check_account();
        $data['msg'] = NULL;

        if ($accountExists) {
            redirect('inbox/INBOX');
        } else {
            $this->load->view('login.php', $data);
        }

    }

    public function change_user()
    {
        $data['msg'] = NULL;
        $this->load->view('login.php', $data);
    }

}
