<?php
/**
 * 视图基类
 */
class ErrorCode
{
    // Helper method to get a string description for an HTTP status code
    // From http://www.gen-x-design.com/archives/create-a-rest-api-with-php/ 
    static function  getStatusCodeMessage($status)
    {
        // these could be stored in a .ini file and loaded
        // via parse_ini_file()... however, this will suffice
        // for an example
        $codes = Array(
            100 => 'Continue',
            101 => 'Switching Protocols',
            200 => 'Success',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            306 => '(Unused)',
            307 => 'Temporary Redirect',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported'
        );
     
        return (isset($codes[$status])) ? $codes[$status] : '';
    }
     
    // Helper method to send a HTTP response code/message
    static function sendResponse($status = 200, $body = '', $msg = '', $content_type = 'text/html;application/json')
    {
        // $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->getStatusCodeMessage($status);
        // header($status_header);
        header('Content-type: ' . $content_type);

        // Return unlock code, encoded with JSON
        $result = array(
            "code" => $status,
            "msg"  => empty($msg)?ErrorCode::getStatusCodeMessage($status):$msg,
            "data" => $body,
        );
        echo json_encode($result);
    }
}