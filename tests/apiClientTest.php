<?php
$root = realpath(dirname(__FILE__));
include_once("$root/../src/root/apiClient.php");

class apiClientTest extends PHPUnit_Framework_TestCase {

  /**
   * @test
   */
  public function testLogin(){
    $client = new ApiClient\ApiClient();
    $this->assertTrue($client !== null);
    $this->assertTrue($client->login(array("Username" => "", "Password" => ""),"") !== null);

  }

  /**
   * @test
   */
  public function testLogout(){
    $client = new ApiClient\ApiClient;
    $this->assertTrue($client !== null);
    $this->assertTrue($client->logout("") === null);

  }

  /**
   * @test
   */
  public function testIsLoggedIn(){
    $client = new ApiClient\ApiClient;
    $this->assertTrue($client !== null);
    $this->assertTrue($client->isLoggedIn("") === null);

  }

  /**
   * @test
   */
  public function testIsAdmin(){
    $client = new ApiClient\ApiClient;
    $this->assertTrue($client !== null);
    $this->assertTrue($client->isAdmin("") !== null);

  }

  /**
   * @test
   */
  public function testGetUserInfo(){
    $client = new ApiClient\ApiClient;
    $this->assertTrue($client !== null);
    $this->assertTrue($client->getUserInfo("") === null);

  }

  /**
   * @test
   */
  public function testGetAllUsers(){
    $client = new ApiClient\ApiClient;
    $this->assertTrue($client !== null);
    $this->assertTrue($client->getAllUsers("") !== null);

  }

  /**
   * @test
   */
  public function testRegisterUser(){
    $client = new ApiClient\ApiClient;
    $this->assertTrue($client !== null);
    $this->assertTrue($client->registerUser(array("personName" => "", "newUsername" => "", "newPersonPassword" => "",
      "newPersonEmail" => "", "personAuthyID" => "", "personCardID" => "", "newPersonIsAdmin" => ""), "") === null);

  }

  /**
   * @test
   */
  public function testChangeUserType(){
    $client = new ApiClient\ApiClient;
    $this->assertTrue($client !== null);
    $this->assertTrue($client->changeUserType(array("userToChange" => "", "newType" => "" ), "") === null);

  }

  /**
   * @test
   */
  public function testUpdateUserInfo(){
    $client = new ApiClient\ApiClient;
    $this->assertTrue($client !== null);
    $this->assertTrue($client->updateUserInfo(array("username" => "", "old-password" => "", "new-password" => "",
      "confirm-new-password" => "", "authy" => "", "card" => "", "email" => "", "name" => ""), "") === null);

  }

  /**
   * @test
   */
  public function testForgotPassword(){
    $client = new ApiClient\ApiClient;
    $this->assertTrue($client !== null);
    $this->assertTrue($client->forgotPassword(array("resetToken" => "", "pass" => "", "confirmPass" => "")) === null);

  }

  /**
   * @test
   */
  public function testResetPassword(){
    $client = new ApiClient\ApiClient;
    $this->assertTrue($client !== null);
    $this->assertTrue($client->resetPassword(array("Username" => "", "Email" => ""), "") === null);

  }

  /**
   * @test
   */
  public function testLockStatus(){
    $client = new ApiClient\ApiClient;
    $this->assertTrue($client !== null);
    $this->assertTrue($client->lockStatus("") !== null);

  }

  /**
   * @test
   */
  public function testLock(){
    $client = new ApiClient\ApiClient;
    $this->assertTrue($client !== null);
    $this->assertTrue($client->lock("") !== null);

  }

  /**
   * @test
   */
  public function testUnlock(){
    $client = new ApiClient\ApiClient;
    $this->assertTrue($client !== null);
    $this->assertTrue($client->unlock("") !== null);

  }

}
