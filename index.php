<?php

session_start();

?>
<!DOCTYPE html>
<html>

<head>

   <!-- meta -->
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <!-- end of meta -->

   <title>Crud Ajax</title>

   <!-- css -->
   <link rel="stylesheet" type="text/css" href="assets/css/style.css">
   <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
   <link rel="stylesheet" type="text/css" href="assets/css/sweetalert.min.css">
   <link rel="stylesheet" type="text/css" href="assets/css/all.min.css">
   <!-- end of css -->

</head>
<body>

   <div class="container mt-3 mb-3">
      <div class="row mb-3">
         <div class="col-md-8">

            <!-- Place flash -->
            <?php if (isset($_SESSION['flash'])) : ?>
            <div class="alert alert-<?= $_SESSION['flash']['tipe']; ?> alert-dismissible fade show" role="alert">
               <span><?= $_SESSION['flash']['pesan']; ?></span>
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <?php endif; ?>
            <!-- End of flash -->

            <!-- button add data -->
            <a href="tambah.php" class="btn btn-primary">
               <i class="fas fa-fw fa-plus mr-2"></i>
               <span>Tambah data</span>
            </a>
            <!-- End of button add data -->
            
            <!-- Search data form -->
            <form action="" method="post">
               <input type="text" class="form-control mt-3 p-3" id="keyword" placeholder="Masukkan nama data..." autocomplete="off">
            </form>
            <!-- End of search data form -->

         </div>
      </div>
      <div class="row">
         <div class="col">

            <!-- Table -->
            <div class="table-responsive rounded shadow">
               <table class="table table-striped">
                  <thead>
                     <tr class="bg-primary text-light">
                        <th>#</th>
                        <th>Nama</th>
                        <th>Nrp</th>
                        <th>Opsi</th>
                     </tr>
                  </thead>
                  <tbody class="table-body">
                     <!-- Place All Data -->
                  </tbody>
               </table>
            </div>
            <!-- End of table -->

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
