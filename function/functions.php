<?php

require 'config/config.php';

$host_name = DB_HOST;
$user = DB_USER;
$pass = DB_PASS;
$db_name = DB_NAME;

$conn = mysqli_connect($host_name, $user, $pass, $db_name);

function set_flashdata($nama, $tipe, $pesan) {
   global $conn;
   
   $nama_session = htmlspecialchars(mysqli_real_escape_string($conn, $nama));
   
   $_SESSION[$nama_session] = [
      'tipe' => htmlspecialchars(mysqli_real_escape_string($conn, $tipe)),
      'pesan' => htmlspecialchars(mysqli_real_escape_string($conn, $pesan))
   ];
}
