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

}
