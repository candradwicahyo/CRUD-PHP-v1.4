<?php

require 'function/functions.php';

$id = htmlspecialchars(mysqli_real_escape_string($conn, $_GET['id']));
$result = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE id = '$id'");
$data = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html>

<head>

   <!-- meta -->
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <!-- end of meta -->

   <title>Detail Data Mahasiswa</title>

   <!-- css -->
   <link rel="stylesheet" type="text/css" href="css/style.css">
   <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
   <link rel="stylesheet" type="text/css" href="assets/css/sweetalert.min.css">
   <link rel="stylesheet" type="text/css" href="assets/css/all.min.css">
   <!-- end of css -->

</head>
<body>

   <div class="container">
      <div class="row mt-3 mb-3">
         <div class="col-md-8">

            <!-- List data mahasiswa -->
            <ul class="list-group shadow rounded">
               <li class="list-group-item disabled bg-primary text-light">
                  <i class="fas fa-fw fa-user mr-2"></i>
                  <span>Detail Mahasiswa</span>
               </li>
               <li class="list-group-item"><b>Nama : </b><?= $data['nama']; ?></li>
               <li class="list-group-item"><b>Nrp : </b><?= $data['nrp']; ?></li>
               <li class="list-group-item"><b>Email : </b><?= $data['email']; ?></li>
               <li class="list-group-item"><b>Jurusan : </b><?= $data['jurusan']; ?></li>
            </ul>
            <!-- End of list data mahasiswa -->
            
            <!-- Button to home page -->
            <a href="index.php?back" class="btn btn-primary mt-3 shadow">
               <i class="fas fa-fw fa-arrow-left mr-2"></i>
               <span>Kembali</span>
            </a>
            <!-- End of button -->

         </div>
      </div>
   </div>

   <!-- javascript -->
   <script type="text/javascript" src="assets/js/jquery-3.5.1.js"></script>
   <script type="text/javascript" src="assets/js/popper.min.js"></script>
   <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
   <script type="text/javascript" src="assets/js/sweetalert.min.js"></script>
   <script type="text/javascript" src="assets/js/script.js"></script>
   <!-- end of javascript -->

</body>

</html>
