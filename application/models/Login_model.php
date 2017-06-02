<?php

class Login_model extends CI_Model
{
    public $hostname = '{imap.gmail.com:993/imap/ssl}';

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

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

    public function check_account()
    {
        $query = $this->db->get('account');
        if ($query->num_rows() == 1) {
            return true;
        }

        return false;
    }

    public function add_account_data($username, $password)
    {
        $data = array(
            'id' => "1",
            'name' => $username,
            'password' => $password
        );

        $query = $this->db->get('account');

        if ($query->num_rows() == 1) {
            $this->db->replace('account', $data);

            return false;
        }

        $this->db->insert('account', $data);

        return false;
    }
}

?>