<?php

class Login_model extends CI_Model
{
    public $hostname = '{imap.gmail.com:993/imap/ssl}';

    public function check_connection($username, $password)
    {
        $connect = @imap_open($this->hostname, $username, $password);
        imap_errors();
        imap_alerts();

        if ($connect == false) {
            return false;
        }

        return true;
    }

}

?>