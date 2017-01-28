<?php

namespace NutriCalc\Component;


class Response
{
    private $status;
    private $responseBody;
    private $errors = [];
    private $statusCode;

    public function __construct($responseBody = '', $status = 'OK', $errors = '', $statusCode = 200)
    {
        $this->responseBody = $responseBody;
        $this->status = $status;
        empty($errors) ? $this->errors = [] : $this->setupErrors($errors);
        $this->statusCode = $statusCode;
    }

    public function send()
    {
        $response = new \stdClass();
        $response->status = $this->status;
        !empty($this->errors) ? $response->errors = $this->errors : $response->errors = false;
        !empty($this->responseBody) ? $response->body = $this->responseBody : $response->body = false;

        header('Content-Type: application/json');
        http_response_code($this->statusCode);
        echo json_encode($response);
        exit(0);
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function setBody($body)
    {
        $this->responseBody = $body;
    }

    public function addError($error)
    {
        array_push($this->errors, $error);
        return $this;
    }

    private function setupErrors($errors)
    {
        if (is_array($errors)){
            foreach ($errors as $key => $value){
                array_push($this->errors, $value);
            }
        }else{
            array_push($this->errors, $errors);
        }
    }

    public function setStatusCode($code)
    {
        $this->statusCode = $code;
    }
}