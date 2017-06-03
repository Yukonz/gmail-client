<?php

class Inbox_model extends CI_Model
{
    public $hostname = '{imap.gmail.com:993/imap/ssl}';
    public $smtpHost = 'ssl://smtp.gmail.com';
    public $maxMessagesLoaded = 100;
    public $myName = 'My name';

    protected $password;
    protected $username;

    public function __construct()
    {
        $this->username = $this->session->userdata('username');
        $this->password = $this->session->userdata('password');
    }

    public function get_folders()
    {
        $connect = imap_open($this->hostname, $this->username, $this->password) or die('Cannot connect to Gmail: ' . imap_last_error());
        $folders = imap_listmailbox($connect, "$this->hostname", "*");
        $folders_correct = [];

        foreach ($folders as $folder_name) {
            $folder_name = str_replace('{imap.gmail.com:993/imap/ssl}', '', $folder_name);
            $folder_name = str_replace('[Gmail]/', '', $folder_name);
            $folder_name = mb_convert_encoding($folder_name, "UTF-8", "UTF7-IMAP");
            $folders_correct[] = $folder_name;
        }

        return $folders_correct;
    }

    public function get_mail_header($connect, $messageNumber)
    {
        $header = imap_header($connect, $messageNumber);

        if (property_exists($header, 'Subject')) {
            $mailSubject = $header->Subject;
        } else {
            $mailSubject = "-Без темы-";
        }

        if (property_exists($header, 'to')) {
            $mailTo = $header->to;
        } else {
            $mailTo = "";
        }

        $mailDate = $header->Date;
        $mailAddress = $header->fromaddress;
        $mailToAddress = $header->from[0]->mailbox . "@" . $header->from[0]->host;

        $mailSubjectDecoded = $this->decode_header_data($mailSubject);
        $mailAddressDecoded = $this->decode_header_data($mailAddress);

        $mailHeaderFiltered = array(
            'header' => $mailSubjectDecoded,
            'from' => $mailAddressDecoded,
            'date' => $mailDate,
            'number' => $messageNumber,
            'to' => $mailTo,
            'fromaddress' => $mailToAddress
        );

        return $mailHeaderFiltered;
    }

    public function get_mails_by_folder($folderName)
    {
        $connect = imap_open($this->get_mailbox($folderName), $this->username, $this->password) or die('Cannot connect to Gmail: ' . imap_last_error());
        $messageCount = imap_num_msg($connect);

        if ($messageCount > $this->maxMessagesLoaded) {
            $messageNumber = $messageCount - $this->maxMessagesLoaded;
        } else {
            $messageNumber = 1;
        }

        $mailsInFolder = [];

        for ($messageNumber; $messageNumber <= $messageCount; $messageNumber++) {
            $mailsInFolder[] = $this->get_mail_header($connect, $messageNumber);
        }

        return $mailsInFolder;
    }

    public function get_mailbox($folder)
    {
        $mailbox = $this->hostname;

        if ($folder !== 'INBOX') {
            $mailbox .= '[Gmail]/';
        }

        $mailbox .= urldecode($folder);

        return mb_convert_encoding($mailbox, "UTF7-IMAP", "UTF-8");
    }

    public function decode_header_data($headerData)
    {
        $elements = imap_mime_header_decode($headerData);
        $decodedHeaderData = '';

        foreach ($elements as $element) {
            $decodedHeaderData .= $element->text;
        }

        return $decodedHeaderData;
    }

    public function get_mail_by_number($mailNumber, $folderName)
    {
        $connect = imap_open($this->get_mailbox($folderName), $this->username, $this->password) or die('Cannot connect to Gmail: ' . imap_last_error());

        $currentMail = $this->get_mail_header($connect, $mailNumber);

        $mailBody = imap_body($connect, $mailNumber);

        if (strpos($mailBody, 'base64')) {
            $mailBody = imap_fetchbody($connect, $mailNumber, 2);
            $mailBodyDecoded = imap_base64($mailBody);
            $currentMail['body'] = $mailBodyDecoded;

            return $currentMail;
        } else {
            if (strpos($mailBody, 'quoted-printable')) {
                $mailBody = imap_fetchbody($connect, $mailNumber, 2);
                $mailBodyQuote = quoted_printable_decode($mailBody);
                $currentMail['body'] = $mailBodyQuote;
                if (strpos($mailBody, 'koi8-r')) {
                    $mailBodyDecoded = mb_convert_encoding($mailBodyQuote, 'UTF-8', 'KOI8-R');
                    $currentMail['body'] = $mailBodyDecoded;

                    return $currentMail;
                }

                return $currentMail;
            } else {
                $mailBody = imap_body($connect, $mailNumber);
                $currentMail['body'] = $mailBody;

                return $currentMail;
            }
        }
    }

    public function send_mail($newMailAddress, $newMailHeader, $newMailBody)
    {
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = $this->smtpHost;
        $config['smtp_port'] = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user'] = $this->username;
        $config['smtp_pass'] = $this->password;
        $config['charset'] = 'UTF-8';
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'text'; // or html
        $config['validation'] = TRUE;

        $this->email->initialize($config);

        $this->email->from($this->username, $this->myName);
        $this->email->to($newMailAddress);
        $this->email->subject($newMailHeader);
        $this->email->message($newMailBody);

        $this->email->send();

//        echo $this->email->print_debugger();

        return false;
    }

    public function delete_mail($mailNumbers, $folderName)
    {
        $connect = imap_open($this->get_mailbox($folderName), $this->username, $this->password) or die('Cannot connect to Gmail: ' . imap_last_error());

        foreach ($mailNumbers as $mailNumber) {
            imap_delete($connect, $mailNumber);
        }

        return false;
    }

}

?>


