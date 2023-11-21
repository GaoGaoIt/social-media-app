<?php

$user = 'sam';

$password = '886488Sam@';

$db = 'EventsWave';

$host = '118.107.200.71';

$port = 3306;

$conn = mysqli_connect($host, $user, $password, $db,$port) ;

if (!$conn)
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

?>