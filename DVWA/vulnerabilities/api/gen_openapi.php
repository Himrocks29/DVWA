<?php
require("vendor/autoload.php");

$openapi = \OpenApi\Generator::scan(['./src']);
$origin = $_SERVER['HTTP_ORIGIN'];
header("Access-Control-Allow-Origin: $origin");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header('Content-Type: application/x-yaml');
echo $openapi->toYaml();
