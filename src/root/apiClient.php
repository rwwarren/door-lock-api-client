<?php



namespace ApiClient;

//require __DIR__.'/../../../door-lock/web/src/vendor/predis/predis/src/Autoloader.php';
////require __DIR__.'/../../../../door-lock/web/src/vendor/predis/predis/src/Autoloader.php';
//\Predis\Autoloader::register();
//$client = new \Predis\Client([
//  'scheme' => 'tcp',
//  'host'   => '127.0.0.1',
//  //'host'   => '10.0.0.1',
//  'port'   => 6379,
//]);

class ApiClient{

  private $apiKey;
  private $apiUrl;

  public function __construct(){
    $root = realpath(dirname(__FILE__));
    $config = parse_ini_file("$root/../properties/secure.ini");
    $this->apiKey = $config['api.key'];
    $this->apiUrl = $config['api.url'];

  }

  private function setUpRequest(){
    header("Access-Control-Allow-Orgin: *");
    header("Access-Control-Allow-Methods: *");
  }

  public function login($params, $cookie){
//    $this->setUpRequest();
    //open connection
    $ch = curl_init();

    //set the url, number of POST vars, POST data
    curl_setopt($ch,CURLOPT_URL, "$this->apiUrl/login");
    curl_setopt($ch,CURLOPT_HTTPHEADER,array("X-DoorLock-Api-Key: $this->apiKey", "sid: $cookie"));
//    curl_setopt($ch,CURLOPT_POST, count($fields));
//    curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch,CURLOPT_POSTFIELDS, array('username'=>$params['Username'],'password'=>$params['Password']));
//    curl_setopt($ch,CURLOPT_POSTFIELDS, array('username'=>'test','password'=>'password', 'DoorLock-Api-Key'=>'test'));

    //execute post
    $result = curl_exec($ch);

    //close connection
    curl_close($ch);
    return $result;
  }

  public function logout(){

  }

  public function isLoggedIn($sid){
//    echo __DIR__;
//    global $client;
//    $userID = $client->hget('apiKeys', sid);
    include_once __DIR__.'/../../../door-lock/web/src/vendor/predis/predis/src/Autoloader.php';
//    require_once __DIR__.'/../../../door-lock/web/src/vendor/predis/predis/src/Autoloader.php';
//require __DIR__.'/../../../../door-lock/web/src/vendor/predis/predis/src/Autoloader.php';
    \Predis\Autoloader::register();
    $client = new \Predis\Client([
      'scheme' => 'tcp',
      'host'   => '127.0.0.1',
      //'host'   => '10.0.0.1',
      'port'   => 6379,
    ]);
//    echo $client->hget('loggedInUsers', $sid);
    return $client->hget('loggedInUsers', $sid);
//    return
//    return isset($_SESSION['username']) && $_SESSION['username'] !== null;
  }

  public function isAdmin($sid){
//    echo __DIR__;
    global $client;
    $userID = $client->hget('apiKeys', sid);
//    return
    return isset($_SESSION['username']) && $_SESSION['username'] !== null;
  }

  public function changePassword(){

  }

  public function forgotPassword(){

  }

  public function lockStatus(){

  }

  public function lock(){

  }

  public function unlock(){

  }

}

?>