<?php

class Inbox extends CI_Controller
{
    protected $foldersList = [];

    function __construct()
    {
        parent::__construct();

        if(!($this->session->has_userdata('validated'))){
            redirect('login');
        }

        $this->load->model('inbox_model');
    }

    public function index()
    {
        $data['folders'] = $this->session->userdata['folders'];
        $data['title'] = 'Gmail-client';
        $this->load->view('template', $data);
    }

    public function view_folder()
    {
        $folderName = $_POST['folder'];
        if ($folderName == NULL) $folderName = 'INBOX';

//        $data['folders'] = $this->session->userdata['folders'];
        $data['mails'] = $this->inbox_model->get_mails_by_folder($folderName);
        $data['folder'] = $folderName;
        $data['title'] = urldecode($folderName);

//        $this->load->view('template', $data);
        $this->load->view('folder', $data);
//        $this->load->view('footer');
    }

    public function view_mail()
    {
        $folderName = $_POST['folder'];
        $mailNumber = $_POST['number'];

//        $data['folders'] = $this->session->userdata['folders'];
        $data['mail'] = $this->inbox_model->get_mail_by_number($mailNumber, $folderName);
        $data['folder'] = $folderName;
        $data['title'] = "Все письма";

//        $this->load->view('template', $data);
        $this->load->view('readmail', $data);
//        $this->load->view('footer');
    }

    public function new_mail()
    {
//        $data['folders'] = $this->session->userdata['folders'];
        $data['title'] = "Новое письмо";

//        $this->load->view('template', $data);
        $this->load->view('newmail');
//        $this->load->view('footer');
    }

    public function send_mail()
    {
        $newMailAddress = $this->input->post('email');
        $newMailHeader = $this->input->post('title');
        $newMailBody = $this->input->post('message');

        $this->inbox_model->send_mail($newMailAddress, $newMailHeader, $newMailBody);

        $this->load->view('inbox/отправленные');
    }

    public function delete($folderName)
    {
        $mailNumbers = $this->input->post('mail_number');

        $this->inbox_model->delete_mail($mailNumbers, $folderName);

        redirect('inbox/' . $folderName);
    }


}
