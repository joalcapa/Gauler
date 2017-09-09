<?php

namespace Fundamentary\Http;

class Response {
    
    private $data = null;
    private $status;
    
    const DATA_JSON = 'json';
    const CONTENT_TYPE_JSON = 'Content-Type: application/json; charset=utf-8';
    
    public function __construct($status, $data = null) {
        if($data)
            $this->data =  $data;
        $this->status = $status;
    }
    
    /**
     * Preparación y envío de la respuesta de la api Rest.
     */
    public function send() {
        switch($this->status) {
            case '200':
                $this->sendResponse($this->status, 'OK');
                break;
            case '201':
                $this->sendResponse($this->status, 'CREATED');
                break;
            case '202':
                $this->sendResponse($this->status, 'ACCEPTED');
                break;
            case '400':
                $this->sendResponse($this->status, 'BAD REQUEST');
                break;
            case '401':
                $this->sendResponse($this->status, 'NOT AUTORIZED');
                break;
            case '404':
                $this->sendResponse($this->status, 'RESOURCE NOT FOUND');
                break;
            case '500':
                $this->sendResponse($this->status, 'ERROR INTERNAL SERVER');
                break;
            case '501':
                $this->sendResponse($this->status, 'NOT IMPLEMENTED');
                break;
            case '502':
                $this->sendResponse($this->status, 'BAD GATEWAY');
                break;
            case '503':
                $this->sendResponse($this->status, 'SERVICE UNAVAILABLE');
                break;
            case '504':
                $this->sendResponse($this->status, 'GATEWAY TIMEOUT');
                break;
            case '507': 
                $this->sendResponse($this->status, 'INSUFFICIENT STORAGE');
                break;
            case '511':
                $this->sendResponse($this->status, 'NETWORK AUTHENTICATION REQUIRED');
                break;
            default:
                break;
        }
    }
    
    /**
     * Preparación de las cabeceras óptimas, y envío de la respuesta http según el estado de la misma.
     *
     * @param  string  $codeStatus
     * @param  string  $messageStatus
     */
    private function sendResponse($codeStatus, $messageStatus) {
        header('Status: '.$codeStatus.' '.$messageStatus);
        if($this->data)
            $this->sendTypeData(self::DATA_JSON);
        else {
            header(self::CONTENT_TYPE_JSON);
            $data = [
                'status' => $codeStatus,
                'message' => $messageStatus
            ];
            $data = json_encode($data);
            echo $data;
        }
    }
    
    /**
     * Preparación y envío de la data.
     *
     * @param  string  $typeData
     */
    private function sendTypeData($typeData) {
        switch($typeData) {
            case self::DATA_JSON:
                header(self::CONTENT_TYPE_JSON);
                $this->data = [
                    'status' => '200',
                    'message' => 'OK',
                    'data' => $this->data,
                ];
                $this->data = json_encode($this->data);
                break;
            default:
                break;
        }
        
        echo $this->data;
    } 
}