<?php

$host = 'localhost';
$dbname = 'hornbill-blog';
$dbuser = 'root';
$dbpass = '';
$db = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpass);
if (!$db) {
    echo "Database connected failed";
}
