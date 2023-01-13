<?php 

function db()
{
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$db = "testcengiz";

	$conn = new mysqli($servername, $username, $password, $db);


	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}

	return $conn;
}

 ?>