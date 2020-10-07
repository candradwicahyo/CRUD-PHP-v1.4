<?php

session_start();

require 'function/functions.php';

if (isset($_POST['submit'])) {

   $nama = trim(htmlspecialchars($_POST['nama']));
   $nrp = trim(htmlspecialchars($_POST['nrp']));
   $email = trim(htmlspecialchars(mysqli_real_escape_string($conn, $_POST['email'])));
   $jurusan = trim(htmlspecialchars($_POST['jurusan']));

   if (empty($nama) && empty($nrp) && empty($email)) {
      set_flashdata('error', 'danger', 'isi semua terlebih dahulu dengan benar');
   } else if (empty($nama)) {
      set_flashdata('error', 'danger', 'isi nama terlebih dahulu');
   } else if (empty($nrp)) {
      set_flashdata('error', 'danger', 'isi nrp terlebih dahulu');
   } else if (empty($email)) {
      set_flashdata('error', 'danger', 'isi email terlebih dahulu');
   } else if (strlen($nama) <= 4) {
      set_flashdata('error', 'danger', 'nama terlalu pendek');
   } else if (strlen($nrp) <= 8) {
      set_flashdata('error', 'danger', 'nrp minimal 9 digit');
   } else if (strlen($nrp) >= 10) {
      set_flashdata('error', 'danger', 'nrp maximal 9 digit');
   } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      set_flashdata('error', 'danger', 'bukan berupa email valid');
   } else {
      $check_nrp = mysqli_query($conn, "SELECT nrp FROM mahasiswa WHERE nrp = '$nrp'");
      $check_email = mysqli_query($conn, "SELECT email FROM mahasiswa WHERE email = '$email'");
      
      if (mysqli_num_rows($check_nrp) > 0 && mysqli_num_rows($check_email) > 0) {
         set_flashdata('error', 'danger', 'nrp dan email sudah dipakai, harap pakai nrp dan email yang lain');
      } else if (mysqli_num_rows($check_nrp) > 0) {
         set_flashdata('error', 'danger', 'nrp sudah pernah dipakai, harap pakai nrp yang lain');
      } else if (mysqli_num_rows($check_email) > 0) {
         set_flashdata('error', 'danger', 'email sudah pernah dipakai, harap ulangi lagi');
      } else {
         
         $query = "INSERT INTO mahasisw VALUES(NULL, '$nama', '$nrp', '$email', '$jurusan')";
         
         if (mysqli_query($conn, $query)) {
            set_flashdata('flash', 'success', 'data berhasil ditambahkan');
            
            header('Location: index.php?success');
            exit;
         } else {
            set_flashdata('flash', 'danger', 'data gagal ditambahkan');
            
            header('Location: index.php?failed');
            exit;
         }
         
      }
   }

}

?>
<!DOCTYPE html>
<html>

<head>

   <!-- meta -->
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <!-- end of meta -->

   <title>Add Data</title>

   <!-- css -->
   <link rel="stylesheet" type="text/css" href="assets/css/style.css">
   <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
   <link rel="stylesheet" type="text/css" href="assets/css/sweetalert.min.css">
   <link rel="stylesheet" type="text/css" href="assets/css/all.min.css">
   <!-- end of css -->

</head>
<body>

   <div class="container mt-3 mb-3">
      <div class="row">
         <div class="col-md-8">

            <!-- Flash -->
            <?php if (isset($_SESSION['error'])) : ?>
               <div class="alert alert-<?= $_SESSION['error']['tipe']; ?> alert-dismissible fade show" role="alert">
                  <span><?= $_SESSION['error']['pesan']; ?></span>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>
            <?php endif; ?>
             <!-- End of flash -->

            </div>
         </div>
         <div class="row">
            <div class="col-md-8">

               <form action="" method="post" enctype="multipart/form-data">

                  <!-- Form box -->
                  <div class="card">
                     <div class="card-header">
                        <i class="fab fa-fw fa-wpforms mr-2"></i>
                        <span>Tambah data</span>
                     </div>
                     <div class="card-body">

                        <!-- Content -->
                        <div class="form-group">
                           <label for="nama">Nama</label>
                           <input type="text" name="nama" class="form-control nama" id="nama" placeholder="Nama Lengkap" autocomplete="off">
                           <div class="invalid-feedback">
                              <span></span>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="nrp">Nrp</label>
                           <input type="text" name="nrp" class="form-control nrp" id="nrp" placeholder="Nrp" autocomplete="off">
                           <div class="invalid-feedback">
                              <span></span>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="email">Email</label>
                           <input type="text" name="email" class="form-control email" id="email" placeholder="Example@example.com" autocomplete="off">
                           <div class="invalid-feedback">
                              <span></span>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="jurusan">Jurusan</label>
                           <select name="jurusan" id="jurusan" class="form-control jurusan" required>
                              <option value="Teknik Informatika">Teknik Informatika</option>
                              <option value="Teknik Planologi">Teknik Planologi</option>
                              <option value="Teknik Lingkungan">Teknik Lingkungan</option>
                              <option value="Teknik Industri">Teknik Industri</option>
                              <option value="Teknik Hukum">Teknik Hukum</option>
                           </select>
                           <div class="invalid-feedback">
                              <span></span>
                           </div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">
                           <i class="fas fa-fw fa-plus mr-2"></i>
                           <span>Tambah data</span>
                        </button>
                        <!-- End of content -->

                     </div>
                  </div>
                  <!-- End of form box -->

               </form>

            </div>
         </div>
      </div>

      <!-- javascript -->
      <script type="text/javascript" src="assets/js/jquery-3.5.1.js"></script>
      <script type="text/javascript" src="assets/js/popper.min.js"></script>
      <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="assets/js/sweetalert.min.js"></script>
      <script type="text/javascript" src="assets/js/validate.js"></script>
      <!-- end of javascript -->

   </body>

</html>
