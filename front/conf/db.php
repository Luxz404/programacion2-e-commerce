<?php
$motor = "mysql";
$host = "localhost";
$user = "root";
$pass = "";
$database = "viveromarissi";
$conx = new PDO ("$motor:host=$host;dbname=$database", $user, $pass);
$conx -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


