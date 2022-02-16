<?php
require_once("./Autoload.php");

$user = new User();
$user->setEmail("test@test.com");
$user->setRandomPassword();
$user->setRole(1);
print_r($user->toArray());

