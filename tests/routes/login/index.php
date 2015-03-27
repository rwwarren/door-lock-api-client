<?php
header("Content-type: Application/json");
echo json_encode(array('username' => $_POST['username'], 'name' => 'sadf', 'isAdmin' => '1', 'success' => '1' ));


?>