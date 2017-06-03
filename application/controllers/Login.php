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
            $username = $this->security->xss_clean($this->input->post('name'));
            $password = $this->security->xss_clean($this->input->post('password'));

            if (!strpos($username, '@gmail.com')) {
                $username .= "@gmail.com";
            }

            $connect = $this->login_model->check_connection($username, $password);

            if ($connect) {
                $data = array(
                    'password' => $password,
                    'username' => $username,
                    'validated' => true,
                    'folders' => []
                );
                $this->session->set_userdata($data);

                $this->load->model('inbox_model');
                $data['folders'] = $this->inbox_model->get_folders();

                $this->session->set_userdata($data);

                redirect('inbox/INBOX');
            } else {
                $data['msg'] = "Проверьте введенные данные!";
                $this->load->view('login.php', $data);
            }
        }
    }



    public function index()
    {
        if($this->session->has_userdata('validated')){
            redirect('inbox/INBOX');
        }

        $data['msg'] = NULL;
        $this->load->view('login.php', $data);
    }

    public function change_user()
    {
        $this->session->sess_destroy();
        $data['msg'] = NULL;
        $this->load->view('login.php', $data);
    }

}
