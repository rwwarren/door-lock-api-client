<?php
header("Content-type: Application/json");
echo json_encode(array("LoggedIn" =>getallheaders()['sid'],"Name" =>"Test", "IsAdmin" => "1","success" => "1"));


?>