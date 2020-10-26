<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Types_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();

    }

    public function getType()
    {
        $qry = $this->db->get("type");
        return  $qry->result();
    }

}