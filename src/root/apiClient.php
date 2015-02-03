<?php

namespace ApiClient;

class ApiClient{

  private $apiKey;
  private $apiUrl;

  public function __construct($location = null){
    $root = realpath(dirname(__FILE__)) . "/../properties/secure.ini";
    $location = ($location === null) ? $root : $location;
    $config = parse_ini_file($location);
    $this->apiKey = $config['api.key'];
    $this->apiUrl = $config['api.url'];
  }

  public function login($params, $cookie){
    //open connection
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL, "$this->apiUrl/login");
    curl_setopt($ch,CURLOPT_HTTPHEADER,array("X-DoorLock-Api-Key: $this->apiKey", "sid: $cookie"));
    curl_setopt($ch,CURLOPT_POSTFIELDS, array('username'=>$params['Username'],'password'=>$params['Password']));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    return json_decode($result, true);
  }

  public function logout($cookie){
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL, "$this->apiUrl/logout");
    curl_setopt($ch,CURLOPT_HTTPHEADER,array("X-DoorLock-Api-Key: $this->apiKey", "sid: $cookie"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    return json_decode($result, true);
  }

  //Return if the user is logged in
  public function isLoggedIn($cookie){
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL, "$this->apiUrl/IsLoggedIn");
    curl_setopt($ch,CURLOPT_HTTPHEADER,array("X-DoorLock-Api-Key: $this->apiKey", "sid: $cookie"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    return json_decode($result, true);
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

  public function getUserInfo($cookie){
    //TODO GetUserInfo
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL, "$this->apiUrl/GetUserInfo");
    curl_setopt($ch,CURLOPT_HTTPHEADER,array("X-DoorLock-Api-Key: $this->apiKey", "sid: $cookie"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    return json_decode($result, true);
    //TODO
    //name
    //email
    //cardID
    //authyId
//    return "";
  }

  public function getAllUsers($cookie){
    //Check if admin
    //TODO GetAllUsers
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL, "$this->apiUrl/GetAllUsers");
    curl_setopt($ch,CURLOPT_HTTPHEADER,array("X-DoorLock-Api-Key: $this->apiKey", "sid: $cookie"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
//    return json_decode($result, true);

    return array('InactiveUsers' => array(""), "ActiveUsers" => array(""), "Admins" => array(""));
  }

  public function registerUser($params, $cookie){
    //TODO RegisterUser
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL, "$this->apiUrl/RegisterUser");
    curl_setopt($ch,CURLOPT_HTTPHEADER,array("X-DoorLock-Api-Key: $this->apiKey", "sid: $cookie"));
    curl_setopt($ch,CURLOPT_POSTFIELDS, array('personName'=>$params['personName'], 'newUsername'=>$params['newUsername'],
      'newPersonPassword'=>$params['newPersonPassword'], 'newPersonEmail'=>$params['newPersonEmail'],
      'personAuthyID'=>$params['personAuthyID'], 'personCardID'=>$params['personCardID'],
      'newPersonIsAdmin'=>$params['newPersonIsAdmin']));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    return json_decode($result, true);
    //isset($_POST['personName']) && isset($_POST['username'])&&
    //isset($_POST['password']) && isset($_POST['email']) && isAdmin() && isset($_POST['admin']
  }

  public function changeUserType($params, $cookie){
    //TODO ChangeUserType
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL, "$this->apiUrl/ChangeUserType");
    curl_setopt($ch,CURLOPT_HTTPHEADER,array("X-DoorLock-Api-Key: $this->apiKey", "sid: $cookie"));
    curl_setopt($ch,CURLOPT_POSTFIELDS, array('userToChange'=>$params['userToChange'], 'newType'=>$params['newType']));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    return json_decode($result, true);
  }

  public function updateUserInfo($params, $cookie){
    //TODO UpdateUserInfo
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL, "$this->apiUrl/UpdateUserInfo");
    curl_setopt($ch,CURLOPT_HTTPHEADER,array("X-DoorLock-Api-Key: $this->apiKey", "sid: $cookie"));
    curl_setopt($ch,CURLOPT_POSTFIELDS, array('username'=>$params['username'],'old-password'=>$params['old-password'],
        'new-password'=>$params['new-password'], 'confirm-new-password' => $params['confirm-new-password'],
        'authy'=>$params['authy'], 'card'=>$params['card'], 'email'=>$params['email'], 'name'=>$params['name']));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    return json_decode($result, true);
    //name
    //email
    //cardID
    //authyId
    //TAKE currentPassword
    //Take new PASsword
    //Take confirm new PASsword
  }

//  public function changePassword(){
////NOt this??
//  }

  public function forgotPassword($params){
    //TODO ForgotPassword
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL, "$this->apiUrl/ForgotPassword");
    curl_setopt($ch,CURLOPT_HTTPHEADER,array("X-DoorLock-Api-Key: $this->apiKey"));
    curl_setopt($ch,CURLOPT_POSTFIELDS, array('resetToken'=>$params['resetToken'],'pass'=>$params['pass'],
                      'confirmPass' => $params['confirmPass']));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    return json_decode($result, true);
  }

  public function resetPassword($params, $cookie){
    //TODO ResetPassword
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL, "$this->apiUrl/ResetPassword");
    curl_setopt($ch,CURLOPT_HTTPHEADER,array("X-DoorLock-Api-Key: $this->apiKey", "sid: $cookie"));
    curl_setopt($ch,CURLOPT_POSTFIELDS, array('username'=>$params['Username'],'email'=>$params['Email']));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    return json_decode($result, true);
  }

  public function lockStatus(){
    //TODO LockStatus
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL, "$this->apiUrl/LockStatus");
    curl_setopt($ch,CURLOPT_HTTPHEADER,array("X-DoorLock-Api-Key: $this->apiKey", "sid: $cookie"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    return json_decode($result, true);
  }

  public function lock($cookie){
    //TODO lock
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL, "$this->apiUrl/Lock");
    curl_setopt($ch,CURLOPT_HTTPHEADER,array("X-DoorLock-Api-Key: $this->apiKey", "sid: $cookie"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    return json_decode($result, true);
  }

  public function unlock($cookie){
    //TODO unlock
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL, "$this->apiUrl/Unlock");
    curl_setopt($ch,CURLOPT_HTTPHEADER,array("X-DoorLock-Api-Key: $this->apiKey", "sid: $cookie"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    return json_decode($result, true);
  }

}

?>