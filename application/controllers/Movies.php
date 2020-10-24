<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Movies extends CI_Controller {

    public function construct()
    {
        parent::__construct();
    }

    public function index()
	{
        $this->load->view('view');
    }
    
    function request() 
    {
        $get = $this->input->get("button");
        $this->load->model("Movies_model");
        $this->load->library("Curl");
        $moviesModel = new Movies_model;
        $curl = new Curl;
       
        if ($get == 1) {
            $request = "Matrix";
        }
        if ($get == 2) {
            $request = "Matrix%20Reloaded";
        }
        if ($get == 2) {
            $request = "Matrix%20Reloaded";
        }

        switch ($get) {
            case 1:
                $request = "Matrix";
                break;
            case 2:
                $request = "Matrix%20Reloaded";
                break;
            case 3:
                $request = "Matrix%20Revolutions";
                break;
        }
                
        $response = $curl->get($request);
        if ($response->Response) {
            foreach ($response->Search as $srch) {

                $exist = $this->checkRecordExist($srch->imdbID);
                if($exist) {
                    continue;
                } else {
                    $poster = $srch->Poster != "N/A" ? 
                    $this->setPosterId($srch->Poster) : 
                    NULL;

                    $data = array(
                        "title" => $srch->Title,
                        "year" => $srch->Year,
                        "imdb_id" => $srch->imdbID,
                        "type_id" => $this->setTypeId($srch->Type),
                        "poster_id" =>$poster
                    );
                    
                    $moviesModel->insertDetails($data);
                }
               
            }   
        }
        echo json_encode(array("data" => $response));
       
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

    function setPosterId($poster)
    {
        $this->load->model("Movies_model");
        $moviesModel = new Movies_model;

        $data = array("url" => $poster);
        return $moviesModel->insertPoster($data);
    }

    function checkRecordExist($imdb)
    {
        $this->load->model("Movies_model");
        $moviesModel = new Movies_model;

        return $moviesModel->checkRecord($imdb);
    }
}