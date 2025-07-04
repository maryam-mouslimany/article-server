<?php

class ResponseService {

    public function success_response($payload){
        $status = 200;
        $response = [];
        $response["status"] =http_response_code($status);
        $response["payload"] = $payload;
        return json_encode($response);
    }

}