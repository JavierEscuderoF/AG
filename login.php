<?php
include 'utilidades/utilidades.php';
session_start(); // Starting Session
$error = ''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $error = "Username or Password is invalid";
    } else {
// Define $username and $password
        $username = $_POST['username'];
        $password = $_POST['password'];
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
        $db = conectar_bd();
// To protect MySQL injection for Security purpose
        $username = stripslashes($username);
        $password = stripslashes($password);
        $username = mysqli_real_escape_string($db, $username);
        $password = mysqli_real_escape_string($db, $password);

// SQL query to fetch information of registerd users and finds user match.
        $resultado = mysqli_query($db, "select * from usuarios where pass='$password' AND nombreUsuario='$username'");
        $rows = $resultado->num_rows;
        if ($rows == 1) {
            $_SESSION['login_user'] = $username; // Initializing Session
            header("location: main.php"); // Redirecting To Other Page
        } else {
            $error = "Username or Password is invalid";
        }
        mysqli_free_result($resultado); // Closing Connection
    }
}
?>