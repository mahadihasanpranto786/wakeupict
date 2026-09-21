<?php



$servername = "localhost";
$username = "wakeupic_system_admin";
$password = "(xpjx?!(RRB0";
$dbname = "wakeupic_office";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
}