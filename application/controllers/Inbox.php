<?php

class Inbox extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('inbox_model');
    }

    public function index()
    {
        redirect('inbox/INBOX');
    }

    public function view_folder($folderName)
    {
        $data['folders'] = $this->inbox_model->get_folders();
        $data['mails'] = $this->inbox_model->get_mails_by_folder($folderName);
        $data['folder'] = $folderName;
        $data['title'] = urldecode($folderName);

        $this->load->view('template', $data);
        $this->load->view('folder', $data);
        $this->load->view('footer');
    }

    public function view_mail($folderName, $mailNumber)
    {
        $data['folders'] = $this->inbox_model->get_folders();
        $data['mail'] = $this->inbox_model->get_mail_by_number($mailNumber, $folderName);
        $data['folder']=$folderName;
        $data['title']="Все письма";

        $this->load->view('template', $data);
        $this->load->view('readmail', $data);
        $this->load->view('footer');
    }

    public function new_mail()
    {
        $data['folders'] = $this->inbox_model->get_folders();
        $data['title'] = "Новое письмо";

        $this->load->view('template', $data);
        $this->load->view('newmail');
        $this->load->view('footer');
    }

    public function send_mail()
    {
        $this->form_validation->set_rules('email', 'e-mail', 'required');
        $this->form_validation->set_rules('message', 'message', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $data['folders'] = $this->inbox_model->get_folders();
            $data['title'] = "Новое письмо";

            $this->load->view('template', $data);
            $this->load->view('newmail');
            $this->load->view('footer');
        }
            else
            {
                $newMailAddress = $this->input->post('email');
                $newMailHeader = $this->input->post('title');
                $newMailBody = $this->input->post('message');

                $this->inbox_model->send_mail($newMailAddress, $newMailHeader, $newMailBody);

                redirect('inbox/Отправленные');
            }
    }

    public function delete($folderName)
    {
        $mailNumbers = $this->input->post('mail_number');

        $this->inbox_model->delete_mail($mailNumbers, $folderName);

        redirect('inbox/' . $folderName);
    }


}
