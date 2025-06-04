<?php

// pdo connection
function getConnection(){
	$host="localhost";
	$dbname="myschoolv3";
	$username="root";
	$password="";
	
	return new PDO("mysql:host=".$host.";dbname=".$dbname, $username, $password);
}

// insert, update, delete
function execQuery($pdoconn,$pdoquery){
	$pdoconn->exec($pdoquery);
}

// select and returns the result for fetching
function selectQuery($pdoconn,$pdoquery){
	return $pdoconn->query($pdoquery);
}

// close pdo connection
function closeConnection($conn){
	$conn=null;
}
?>