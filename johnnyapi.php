<?php


///////////////////////////
//     CONNECT TO DB     //
///////////////////////////


///////////////////////////
//      DEBUG MODE       //
///////////////////////////
//include_once("../rdebug/loader.php");
//


///////////////////////////
//     BEST PRACTICES    //
///////////////////////////
/*
/* #RESTful Methods Scheme:
/* get = get resource
/* post = insert resource at a non-precise URI path
/* put = insert resource at a precise URI path
/* patch = update a resource partially
/* update = update a resource completely
/* delete = remove a resource
/* head = get debug information, meta information, or description about a resource.
/* options = returns available API methods and URI paths
/*
/* #Example of URI:
/* http://programmers.stackexchange.com/questions/218798/what-is-the-limit-on-rest-api-resource-levels
/*
/* #PATH_INFO
/* E.g. If the request line is 
/*      GET http://example.com/test.php/testing/123/hello/
/* Then $_SERVER['PATH_INFO'] returns the string:
/*      "testing/123/hello/"
/* If the request line hadn't ended in a forward slash, add
/* a / to the end.
/* Then exploding that string with delimiter '/' returns:
/*      ["testing", "123", "hello"]
/* To see for yourself, turn on debug mode and log to file: 
/*      rdebug($request);
*/


//Prepare DB auth, HTTP method, and URI Path
if(!isset($conn)) die(json_encode(array("_error"=>"\$conn not set. Did you put the database connect code near the top of the page yet? Or did you save the link identifier returned by mysqli_connect() as another name besides \$conn?")));
$method = $_SERVER['REQUEST_METHOD'];
$path_info = "";
$path_info = @$_SERVER['PATH_INFO'];
if($path_info[strlen($path_info)-1]!='/') $path_info .= "/";
$request = explode("/", substr($path_info, 1));
if($request[count($request)-1]=="") array_pop($request); // Edge case: last element empty ""

//Prepare RESTful HTTP methods
$_PARAMS = array();
if (($stream = fopen('php://input', "r")) !== FALSE) {
   parse_str(stream_get_contents($stream), $_PARAMS);
}

//Prepare URI Path levels for IF statements
$LEVEL0=count($request)>0 && $request[0]!=""?true:false;
$LEVEL1=count($request)>1?true:false;
$LEVEL2=count($request)>2?true:false;
$LEVEL3=count($request)>3?true:false;
$LEVEL4=count($request)>4?true:false;
$LEVEL5=count($request)>5?true:false;

date_default_timezone_set("America/New_York");

//Reroute based on method
switch ($method) {
  case 'GET':
    get($request);  
    break;
  case 'POST':
    post($request);  
    break;
  case 'PUT':
    put($request);  
    break;
  case 'PATCH':
    patch($request);  
    break;
  case 'UPDATE':
    update($request);  
    break;
  case 'DELETE':
    delete($request);  
    break;
  case 'HEAD':
    head($request);  
    break;
  case 'OPTIONS':
    options($request);    
    break;
  default:
    error($request);  
    break;
} // switch
        
function get($request) {
    global $conn;
    global $LEVEL0, $LEVEL1, $LEVEL2, $LEVEL3, $LEVEL4, $LEVEL5;
    
    if(!$LEVEL0) 
        die(json_encode(error_arr()));
    else if($request[0]=="getValue"){

        $sUSD_Address = "";
        $bUSD_Address = "";
        $sETH_Address = "";
        $bETH_Address = "";

        



        $data = array();
                
        while($links = sqlsrv_fetch_array($sql_stmt)){
            
                                
            array_push($data, $row);
        }
        die(json_encode($data));
    }
    else
        die(json_encode(error_arr()));
    
} // get

        
function post($request) {
    global $conn;
    global $LEVEL0, $LEVEL1, $LEVEL2, $LEVEL3, $LEVEL4, $LEVEL5;
    
    if(!$LEVEL0) 
        die(json_encode(error_arr()));
    else if($request[0]=="blah"){

    }
    else
        die(json_encode(error_arr()));
} // post

        
function put($request) {
    global $conn;
    global $_PARAMS;
    $_PUT = $_PARAMS;
    global $LEVEL0, $LEVEL1, $LEVEL2, $LEVEL3, $LEVEL4, $LEVEL5;
    
} // put
        

function patch($request) {
    global $conn;
    global $_PARAMS;
    $_PATCH = $_PARAMS;
    global $LEVEL0, $LEVEL1, $LEVEL2, $LEVEL3, $LEVEL4, $LEVEL5;
    
} // patch

function update($request) {
    global $conn;
    global $_PARAMS;
    $_UPDATE = $_PARAMS;
    global $LEVEL0, $LEVEL1, $LEVEL2, $LEVEL3, $LEVEL4, $LEVEL5;
    
    if(!$LEVEL0) die(json_encode(error_arr()));
} // update
        

function delete($request) {
    global $conn;
    global $_PARAMS;
    $_DELETE = $_PARAMS;
    global $LEVEL0, $LEVEL1, $LEVEL2, $LEVEL3, $LEVEL4, $LEVEL5;
    
} // delete
        

function head($request) {
    global $conn;
    global $_PARAMS;
    $_HEAD = $_PARAMS;
    global $LEVEL0, $LEVEL1, $LEVEL2, $LEVEL3, $LEVEL4, $LEVEL5;
    
} // head
        

function options($request) {
    global $conn;
    global $_PARAMS;
    $_OPTIONS = $_PARAMS;
    global $LEVEL0, $LEVEL1, $LEVEL2, $LEVEL3, $LEVEL4, $LEVEL5;
    
} // options

        
///////////////////////////
//       FUNCTIONS       //
///////////////////////////
/* If you want to keep code
/* organized, the functions
/* that your mysqli code
/* call to transform/amend
/* information before it
/* echoes to ajax should
/* be defined below. 
/* Alternately, you could
/* include a file that
/* implements the functions 
/* so you don't have to
/* scroll up and down.
*/

function method_error($request) {
    global $conn;
    
} // method_error

function error_arr() {
    $strExtra = "";
    if(func_num_args()>0) $strExtra = ". Code '" . func_get_arg(0) . "'";
    
    return array("error"=>"Invalid connection" . $strExtra . ".");
}

/*FUNCTIONS WITH SHARED VARIABLES
Eg.
$username = new Username(1, "Admin");
var_dump($username->get_info());
*/
class Username {
    private $user_id;
    private $username;

    public function Username($user_id_, $username_) {
        $this->user_id=$user_id_;
        $this->username=$username_;
    } // constructor

    public function get_info() {
        return array("user_id"=>$this->user_id, "username"=>$this->username);	
    } // get_info
    public function get_user_id() {
        return $this->user_id;
    } // get_info
    
    public function get_username() {
        return $this->username;
    } // get_info
} // class

/*FUNCTIONS WITH EXPLICIT RELATIONSHIP*/
//Eg.
//var_dump(Settings::anonymousMode());
class Settings {
	public static function anonymousMode() {
		return true;
 	}
}

/*FUNCTIONS CALLED GLOBALLY*/
//Eg.
//var_dump(now());
BASIC_FUNCTIONS:
	function now() {
		return date("M. d, Y g:m:s a", time());
	}
END_BASIC_FUNCTIONS: //

/*IN SUMMARY*/
//
//$username = new Username(1, "Admin");
//var_dump($username->get_info());
//
//var_dump(Settings::anonymousMode());
//
//var_dump(error_arr());
//

?>