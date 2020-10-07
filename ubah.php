<?php

session_start();

require 'function/functions.php';

$id = htmlspecialchars(mysqli_real_escape_string($conn, $_GET['id']));
$result = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE id = '$id'");
$data = mysqli_fetch_assoc($result);

$options = ['teknik informatika', 'teknik planologi', 'teknik lingkungan', 'teknik industri', 'teknik hukum'];

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

      $query = "UPDATE mahasiswa SET
                  nama = '$nama',
                  nrp = '$nrp',
                  email = '$email',
                  jurusan = '$jurusan'
                WHERE id = '$id'";

      if (mysqli_query($conn, $query)) {
         set_flashdata('flash', 'success', 'data berhasil diubah');

         header('Location: index.php?success');
         exit;
      } else {
         set_flashdata('flash', 'danger', 'data gagal diubah');

         header('Location: index.php?failed');
         exit;
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

   <title>Update Data</title>

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
                     <span>Ubah data</span>
                  </div>
                  <div class="card-body">

                     <!-- Content -->
                     <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control nama" id="nama" placeholder="Nama Lengkap" autocomplete="off" value="<?= $data['nama']; ?>">
                        <div class="invalid-feedback">
                           <span></span>
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="nrp">Nrp</label>
                        <input type="text" name="nrp" class="form-control nrp" id="nrp" placeholder="Nrp" autocomplete="off" value="<?= $data['nrp']; ?>">
                        <div class="invalid-feedback">
                           <span></span>
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control email" id="email" placeholder="Example@example.com" autocomplete="off" value="<?= $data['email']; ?>">
                        <div class="invalid-feedback">
                           <span></span>
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="jurusan">Jurusan</label>
                        <select name="jurusan" id="jurusan" class="form-control jurusan" required>
                           <?php foreach ($options as $option) : ?>
                           <?php if (strtolower($option) == strtolower($data['jurusan'])) : ?>
                           <option value="<?= $option; ?>" selected><?= $option; ?></option>
                           <?php else : ?>
                           <option value="<?= $option; ?>"><?= $option; ?></option>
                           <?php endif; ?>
                           <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                           <span></span>
                        </div>
                     </div>
                     <button type="submit" name="submit" class="btn btn-primary">
                        <i class="fas fa-fw fa-edit mr-2"></i>
                        <span>Ubah data</span>
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
