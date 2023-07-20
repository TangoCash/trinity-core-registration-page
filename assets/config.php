<?php
// General Configuation
$title = 'Server Name';
$realmlist = 'logon.server.com';
$linksite = 'https://www.wowhead.com/wotlk/de/item=';

// Database Information
$host = "localhost"; // Host IP or localhost
$user = "root"; // Database Username
$pass = "ascent"; // Database Password
$database_auth = "auth"; // Select Auth Database
$database_characters = "characters"; // Select Characters Database
$database_world = "world"; // Select World Database
$DB = mysqli_connect($host, $user, $pass, $database_auth);
$DB_CH = mysqli_connect($host, $user, $pass, $database_characters);
$DB_W = mysqli_connect($host, $user, $pass, $database_world);

if(!$DB)
{
    echo "Auth Connection Error:". mysqli_connect_error();
}

if(!$DB_CH)
{
    echo "Characters Connection Error:". mysqli_connect_error();
}

if(!$DB_W)
{
    echo "World Connection Error:". mysqli_connect_error();
}
?>
