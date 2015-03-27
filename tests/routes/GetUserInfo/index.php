<?php
header("Content-type: Application/json");

echo json_encode(array("ID" => getallheaders()['sid'],"Email" => "test@test.com", "Name" => "Test", "CardID" => "1121331", "AuthyID" =>123));

?>