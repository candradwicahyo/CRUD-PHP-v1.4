/*
   nama : candra dwi cahyo
   umur : 16 tahun
   email : candradwicahyo18@gmail.com
   github : github.com/candradwicahyo
   codepen : codepen.io/candradwicahyo
*/

const formControl = document.querySelectorAll('.form-control');
formControl.forEach(input => {
   input.addEventListener('keyup', function() {
      if (this.classList.contains('nama')) {
         if (!this.value) {
            //jalankan function berikut ketika nama belum diisi
            add_class(input, 'isi nama terlebih dahulu');
         } else if (this.value.length <= 4) {
            //jalankan function berikut ketika jumlah nama terlalu pendek
            add_class(input, 'nama terlalu pendek');
         } else {
            //jalankan function berikut ketika semua validasi terpenuhi
            remove_class(input);
         }
      } else if (this.classList.contains('nrp')) {
         
         var validate_number = /^[0-9]+$/;
         
         if (!this.value) {
            //jalankan function berikut ketika nama belum diisi
            add_class(input, 'isi nrp terlebih dahulu');
         } else if (!this.value.match(validate_number)) {
            //jalankan function berikut ketika value input bukan nerupa angka
            add_class(input, 'bukan berupa angka');
         } else if (this.value.length <= 8) {
            //jalankan function berikut ketika jumlah karakter kurang dari 9 digit
            add_class(input, 'minimal digit nrp adalah 9');
         } else if (this.value.length >= 10) {
            //jalankan function berikut ketika jumlah karakter lebih dari 9 dogit
            add_class(input, 'maximal digit nrp adalah 9');
         } else {
            //jalankan function berikut ketika semua validasi terpenuhi
            remove_class(input);
         }
      } else if (this.classList.contains('email')) {
         
         let pattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
         
         if (!this.value) {
            //jalankan function berikut ketika email belum diisi
            add_class(input, 'isi email terlebih dahulu');
         } else if (!this.value.match(pattern)) {
            //jalankan function berikut ketika value input bukan merupakan email
            add_class(input, 'bukan berupa email');
         } else {
            //jalankan function berikut ketika semua validasi terpenuhi
            remove_class(input);
         }
      }
   });
});

function add_class(input, pesan) {
   input.nextElementSibling.innerHTML = pesan;
   input.classList.add('is-invalid');
}

function remove_class(input) {
   input.nextElementSibling.innerHTML = '';
   input.classList.remove('is-invalid');
}