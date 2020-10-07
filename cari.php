<?php

require 'function/functions.php';

$keyword = htmlspecialchars(mysqli_real_escape_string($conn, $_GET['keyword']));
$query = "SELECT * FROM mahasiswa WHERE 
             nama LIKE '%$keyword%' OR
             nrp LIKE '%$keyword%' OR
             email LIKE '%$keyword%' OR
             jurusan LIKE '%$keyword%'
           ORDER BY id DESC";
$result = mysqli_query($conn, $query);
$rows = [];

while ($row = mysqli_fetch_assoc($result)) {
   $rows[] = $row;
}

echo json_encode($rows);