<?php

namespace ApiClient;

class ApiClient{

  private $apiKey;
  private $apiUrl;

  public function __construct(){
    $root = realpath(dirname(__FILE__));
    $config = parse_ini_file("$root/../properties/secure.ini");
    $this->apiKey = $config['api.key'];
    $this->apiUrl = $config['api.url'];

  }

//  private function setUpRequest(){
//    header("Access-Control-Allow-Orgin: *");
//    header("Access-Control-Allow-Methods: *");
//  }

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
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//    curl_setopt($ch,CURLOPT_POSTFIELDS, array('username'=>'test','password'=>'password', 'DoorLock-Api-Key'=>'test'));

    //execute post
    $result = curl_exec($ch);
//    print_r($result);
//    echo "sadf: " . get_class($result);
//    echo "sadf: " . $result['name'];
//    echo $result;

    //close connection
    curl_close($ch);
//    return $result;
    return json_encode($result, true);
  }

  public function logout($cookie){
    $ch = curl_init();

    //set the url, number of POST vars, POST data
    curl_setopt($ch,CURLOPT_URL, "$this->apiUrl/logout");
    curl_setopt($ch,CURLOPT_HTTPHEADER,array("X-DoorLock-Api-Key: $this->apiKey", "sid: $cookie"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//    curl_setopt($ch,CURLOPT_POST, count($fields));
//    curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
//    curl_setopt($ch,CURLOPT_POSTFIELDS, array('username'=>$params['Username'],'password'=>$params['Password']));
//    curl_setopt($ch,CURLOPT_POSTFIELDS, array('username'=>'test','password'=>'password', 'DoorLock-Api-Key'=>'test'));

    //execute post
    $result = curl_exec($ch);

    print_r($result);
    echo $result;

    //close connection
    curl_close($ch);
    return json_encode($result);
  }

  //Return if the user is logged in
  public function isLoggedIn($cookie){
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL, "$this->apiUrl/IsLoggedIn");
    curl_setopt($ch,CURLOPT_HTTPHEADER,array("X-DoorLock-Api-Key: $this->apiKey", "sid: $cookie"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    $decoded = json_decode($result, true);
    return $decoded['success'] !== '0' ;
  }

  //Returns if the user is an admin
  public function isAdmin($cookie){
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL, "$this->apiUrl/IsAdmin");
    curl_setopt($ch,CURLOPT_HTTPHEADER,array("X-DoorLock-Api-Key: $this->apiKey", "sid: $cookie"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    $decoded = json_decode($result, true);
    return $decoded['admin'] === '1';
  }

  public function getUserInfo($username){

    //TODO
    //name
    //email
    //cardID
    //authyId
    //TAKE currentPassword
    //Take new PASsword
    //Take confirm new PASsword
    return "";
  }

  public function getAllUsers($username){
    //Check if admin

    return array('InactiveUsers' => array(""), "ActiveUsers" => array(""), "Admins" => array(""));
  }

  public function registerUser($username){

  }

  public function changeUser($username){

  }

  public function updateUserInfo($username){

  }

  public function changePassword(){

  }

  public function forgotPassword(){

  }

  public function resetPassword($username){

  }

  public function lockStatus(){

  }

  public function lock(){

  }

  public function unlock(){

  }

}

?>