<?php

require 'function/functions.php';

$result = mysqli_query($conn, "SELECT * FROM mahasiswa ORDER BY id DESC");
$rows = [];

while ($row = mysqli_fetch_assoc($result)) {
   $rows[] = $row;
}

echo json_encode($rows);