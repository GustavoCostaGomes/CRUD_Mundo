<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "CRUD_Mundo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conecxão Falhou!!" . $conn->connect_error);
}
?>