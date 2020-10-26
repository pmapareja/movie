<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Type extends CI_Controller {

    public function construct()
    {
        parent::__construct();
    }


    function setTypeId($typeName)
    {
        $this->load->model("Movies_model");
        $moviesModel = new Movies_model;
        $type = $moviesModel->getType();
        
        foreach($type as $tp) {
            if ($typeName == $tp->name) {
                return $tp->id;
                break;
            }
        }
    }

}