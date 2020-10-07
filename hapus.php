<?php

session_start();

require 'function/functions.php';

$id = htmlspecialchars(mysqli_real_escape_string($conn, $_GET['id']));
$query = "DELETE FROM mahasiswa WHERE id = '$id'";

if (mysqli_query($conn, $query)) {
   set_flashdata('flash', 'success', 'data berhasil dihapus');
   
   header('Location: index.php?success');
   exit;
} else {
   set_flashdata('flash', 'danger', 'data gagal dihapus');
   
   header('Location: index.php?failed');
   exit;
}