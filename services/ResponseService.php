<?php

class ResponseService {

    public function success_response($payload, $error_code){
        $status = http_response_code($error_code);
        $response = [];
        $response["status"] =http_response_code($status);
        $response["payload"] = $payload;
        return json_encode($response);
    }

}