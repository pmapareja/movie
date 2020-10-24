<?php
class Curl
{
    public $curl;
    public $ci;
    public function __construct()
    {
        $this->ci =& get_instance();
    }

    public function get($request)
    {
        $this->curl = curl_init();
       
        $key = "720c3666";

        $apiUrl = "http://www.omdbapi.com/?s=" . $request . "&apikey=" . $key;

        $headers = array(
            'Content-Type: application/json',
            'Authorization: Basic ' . $key
        );
        
        curl_setopt($this->curl, CURLOPT_URL, $apiUrl);
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
       
        $result = json_decode(curl_exec($this->curl));
        if (!isset($result)):
            throw new Exception('ERROR: CURL WAS NULL'); elseif (isset($result->errors)):
            foreach ($result->errors as $error) {
                throw new Exception($error->code.':'.$error->message.' | '.$error->description);
            } else:
            return $result;
        endif;
    }
}
