<?php

session_start();
$usuario = $_SESSION['login_user'];

// SQL Query To Fetch Complete Information Of User
//$a = "select nombreUsuario from usuarios where nombreUsuario=" . $user_check;
//$ses_sql = mysqli_query($db, $a);
//$row = mysqli_fetch_array($ses_sql);
//$login_session = $row['nombreUsuario'];
//if (!isset($login_session)) {
//    mysqli_close($connection); // Closing Connection
//    header('Location: index.php'); // Redirecting To Home Page
//}

