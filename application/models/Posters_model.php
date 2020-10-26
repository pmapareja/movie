<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Posters_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();

    }

    public function insertPoster($data)
    {
        $this->db->insert("poster", $data);
        return $this->db->insert_id();
    }
}