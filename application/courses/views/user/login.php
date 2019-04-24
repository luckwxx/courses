<?php
class RedeemAPI {
    private $db;
 
    // Constructor - open DB connection
    function __construct() {
        $this->db = new mysqli('127.0.0.1', 'courses', 'courses', 'courses');
        $this->db->autocommit(FALSE);
    }
 
    // Destructor - close DB connection
    function __destruct() {
        $this->db->close();
    }
 
	// Helper method to get a string description for an HTTP status code
	// From http://www.gen-x-design.com/archives/create-a-rest-api-with-php/ 
	function getStatusCodeMessage($status)
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
	function sendResponse($status = 200, $body = '', $content_type = 'text/html;application/json')
	{
	    // $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->getStatusCodeMessage($status);
	    // header($status_header);
	    header('Content-type: ' . $content_type);

	    // Return unlock code, encoded with JSON
        $result = array(
        	"code" => $status,
            "msg"  => $this->getStatusCodeMessage($status),
            "data" => $body,
        );
	    echo json_encode($result);
	}
	function login() {
	    // Check for required parameters
	    if (isset($_POST["type"]) && isset($_POST["account"]) && isset($_POST["password"])) {
	 
	        // Put parameters into local variables
	        $type = $_POST["type"];
	        $account = $_POST["account"];
	        $password = md5($_POST["password"]);
	 
	        // Look up code in database
	        $user_id = 0;
	        $stmt = $this->db->prepare('SELECT id, user_id FROM user_auths WHERE identity_type=? AND identifier=? AND credential=?');
	        $stmt->bind_param("iss", $type, $account,$password);
	        $stmt->execute();
	        $stmt->bind_result($id, $user_id);
	        while ($stmt->fetch()) {
	            break;
	        }
	        $stmt->close();
	 
	        // Bail if code doesn't exist
	        if ($id <= 0) { 
	            $this->sendResponse(400, 'Invalid code 1');
	            return false;
	        }
	 
	        // Check to see if this device already redeemed    
	        $stmt = $this->db->prepare('SELECT id,nickname,avatar FROM users WHERE id=?');
	        $stmt->bind_param("i", $user_id);
	        $stmt->execute();
	        $stmt->bind_result($id, $nickname, $avatar);
	        while ($stmt->fetch()) {
	            break;
	        }
	        $stmt->close();

	        // Bail if code doesn't exist
	        if ($id <= 0) {
	            $this->sendResponse(400, 'Invalid code 2');
	            return false;
	        }
	 
	        // Return unlock code, encoded with JSON
	        $result = array(
	            "user_id" => $id,
	            "nickname" => $nickname,
	            "avatar" => $avatar,
	        );
	        $this->sendResponse(200, $result);
	        return true;
	    }
	    $this->sendResponse(400, 'Invalid request');
	    return false;
	}
}

$api = new RedeemAPI;
$api->login();

?>
