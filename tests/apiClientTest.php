<?php
$root = realpath(dirname(__FILE__));
include_once("$root/../src/root/apiClient.php");
require_once("$root/../vendor/hamcrest/hamcrest-php/hamcrest/Hamcrest.php");
require_once("$root/../vendor/hamcrest/hamcrest-php/hamcrest/Hamcrest/SelfDescribing.php");
require_once("$root/../vendor/hamcrest/hamcrest-php/hamcrest/Hamcrest/Matcher.php");
require_once("$root/../vendor/hamcrest/hamcrest-php/hamcrest/Hamcrest/MatcherAssert.php");
require_once("$root/../vendor/hamcrest/hamcrest-php/hamcrest/Hamcrest/BaseMatcher.php");
require_once("$root/../vendor/hamcrest/hamcrest-php/hamcrest/Hamcrest/Core/IsNot.php");
require_once("$root/../vendor/hamcrest/hamcrest-php/hamcrest/Hamcrest/Core/IsEqual.php");
require_once("$root/../vendor/hamcrest/hamcrest-php/hamcrest/Hamcrest/Util.php");
require_once("$root/../vendor/hamcrest/hamcrest-php/hamcrest/Hamcrest/AssertionError.php");
require_once("$root/../vendor/hamcrest/hamcrest-php/hamcrest/Hamcrest/Description.php");
require_once("$root/../vendor/hamcrest/hamcrest-php/hamcrest/Hamcrest/BaseDescription.php");
require_once("$root/../vendor/hamcrest/hamcrest-php/hamcrest/Hamcrest/StringDescription.php");

class apiClientTest extends PHPUnit_Framework_TestCase {

  private $client;

  /**
   * /@  b e foreClass
   */
//  public static function setUpBeforeClass(){
//  protected function setUp(){
  protected function setUp(){
    global $root;
    $this->client = new ApiClient\ApiClient("$root/../src/properties/secure_new.ini");
    $ch = curl_init($this->client->getUrl());
    curl_setopt($ch, CURLOPT_HEADER, true);    // we want headers
    curl_setopt($ch, CURLOPT_NOBODY, true);    // we don't need body
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_TIMEOUT,10);
    $output = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

//    echo 'HTTP code: ' . $httpcode;
    while($httpcode !== 200){
//    while($result = exec("ping -c 2 $this->client->getUrl()") == 200){
//      echo $httpcode;
      sleep(1);
      $output = curl_exec($ch);
      $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    }
    curl_close($ch);
//    sleep(1);
  }
  /**
   * @test
   */
  public function testLogin(){
//    global $root;
//    $client = new ApiClient\ApiClient("$root/../src/properties/secure_new.ini");
    assertThat("Client should not be null", $this->client, not(equalTo(null)));
//    $result = $this->client->login(array("Username" => "", "Password" => ""),"");
//    sleep(1);
    $username = "test";
    $result = $this->client->login(array("Username" => $username, "Password" => "password"),"");
//    sleep(100);
    assertThat("Client login should not be null", $result, not(equalTo(null)));
    assertThat("Client login username should not be null", $result['username'], not(equalTo(null)));
    assertThat("Client login username should equal $username", $result['username'], equalTo($username));
//    assertThat("Client login username should equal $username", $result['username'], not(equalTo($username)));
//    print_r($result);
  }

  /**
   * @test
   */
  public function testLogout(){
//    $client = new ApiClient\ApiClient;
   //@*depends testLogin
//    $this->assertTrue($this->client !== null);
//    $this->assertTrue($client->logout("") === null);
    assertThat("Client should not be null", $this->client, not(equalTo(null)));
    $result = $this->client->logout("");
    assertThat("Client logout should not be null", $result, not(equalTo(null)));
    assertThat("Client logout should be logged out", $result['Logged Out'], equalTo("test"));
//    print_r($result);
//    echo $result['Logged Out'];

  }

  /**
   * @test
   */
  public function testIsLoggedIn(){
//    $client = new ApiClient\ApiClient;
//    $this->assertTrue($client !== null);
//    $this->assertTrue($client->isLoggedIn("") === null);
    assertThat("Client should not be null", $this->client, not(equalTo(null)));
    $result = $this->client->isLoggedIn("test");
//    sleep(100);
    assertThat("Client is logged in result should not be null", $result, not(equalTo(null)));
    assertThat("Client login should be logged in", $result['LoggedIn'], equalTo("test"));
//    print_r($result);


  }

  /**
   * @test
   */
  public function testIsAdmin(){
//    $client = new ApiClient\ApiClient;
//    $this->assertTrue($client !== null);
//    $this->assertTrue($client->isAdmin("") !== null);
    assertThat("Client should not be null", $this->client, not(equalTo(null)));
    $result = $this->client->isAdmin("test");
//    sleep(100);
    assertThat("Client is admin result should not be null", $result, not(equalTo(null)));
    assertThat("Client should be admin", $result, equalTo(true));
//    print_r($result);

  }

  /**
   * @test
   */
  public function testGetUserInfo(){
//    $client = new ApiClient\ApiClient;
//    $this->assertTrue($client !== null);
//    $this->assertTrue($client->getUserInfo("") === null);
    assertThat("Client should not be null", $this->client, not(equalTo(null)));
    $result = $this->client->getUserInfo("test");
//    sleep(100);
    assertThat("Client is get user info result should not be null", $result, not(equalTo(null)));
    assertThat("Client get user info to equal", $result['ID'], equalTo("test"));

  }

  /**
   * @test
   */
  public function testGetAllUsers(){
//    $client = new ApiClient\ApiClient;
//    $this->assertTrue($client !== null);
//    $this->assertTrue($client->getAllUsers("") !== null);

  }

  /**
   * @test
   */
  public function testRegisterUser(){
//    $client = new ApiClient\ApiClient;
//    $this->assertTrue($client !== null);
//    $this->assertTrue($client->registerUser(array("personName" => "", "newUsername" => "", "newPersonPassword" => "",
//      "newPersonEmail" => "", "personAuthyID" => "", "personCardID" => "", "newPersonIsAdmin" => ""), "") === null);

  }

  /**
   * @test
   */
  public function testChangeUserType(){
//    $client = new ApiClient\ApiClient;
//    $this->assertTrue($client !== null);
//    $this->assertTrue($client->changeUserType(array("userToChange" => "", "newType" => "" ), "") === null);

  }

  /**
   * @test
   */
  public function testUpdateUserInfo(){
//    $client = new ApiClient\ApiClient;
//    $this->assertTrue($client !== null);
//    $this->assertTrue($client->updateUserInfo(array("username" => "", "old-password" => "", "new-password" => "",
//      "confirm-new-password" => "", "authy" => "", "card" => "", "email" => "", "name" => ""), "") === null);

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
//    $client = new ApiClient\ApiClient;
//    $this->assertTrue($client !== null);
//    $this->assertTrue($client->resetPassword(array("Username" => "", "Email" => ""), "") === null);

  }

  /**
   * @test
   */
  public function testLockStatus(){
//    $client = new ApiClient\ApiClient;
//    $this->assertTrue($client !== null);
//    $this->assertTrue($client->lockStatus("") !== null);

  }

  /**
   * @test
   */
  public function testLock(){
//    $client = new ApiClient\ApiClient;
//    $this->assertTrue($client !== null);
//    $this->assertTrue($client->lock("") !== null);

  }

  /**
   * @test
   */
  public function testUnlock(){
//    $client = new ApiClient\ApiClient;
//    $this->assertTrue($client !== null);
//    $this->assertTrue($client->unlock("") !== null);

  }

}
