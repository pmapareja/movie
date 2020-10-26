<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Movies_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();

    }

    public function insertDetails($data)
    {
        $this->db->insert("details", $data);
    }


    public function checkRecord($imdb)
    {
        $this->db->select("id");
        $this->db->where("imdb_id", $imdb);
        $qry = $this->db->get("details");

        $result = $qry->result();

        return !empty($result) ? true : false;
        
    }
}