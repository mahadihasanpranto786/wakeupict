<?php
session_start();
require 'logic.php';
$servername = "localhost";
$username = "wakeupic_stg";
$password = "1LwvDQhR{Tp!";
$dbname = "wakeupic_stg_office";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
}
