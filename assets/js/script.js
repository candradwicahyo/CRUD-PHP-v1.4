/*
   nama : candra dwi cahyo
   umur : 16 tahun
   email : candradwicahyo18@gmail.com
   github : github.com/candradwicahyo
   codepen : codepen.io/candradwicahyo
*/

const tableBody = document.querySelector('.table-body');

function load_data() {
   
   const xhr = new XMLHttpRequest();
   xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
         const results = JSON.parse(this.responseText);
         let content = '';
         let no = 1;
         
         results.forEach(result => {
            const {email, id, jurusan, nama, nrp} = result;
            
            content += table(id, nama, nrp, no++);
         });
         
         tableBody.innerHTML = content;
      }
   }
   xhr.open('get', 'data.php', true);
   xhr.send();
   
}

load_data();

function table(id, nama, nrp, no) {
   
   return `
      <tr>
         <td>${no}</td>
         <td>${nama}</td>
         <td>${nrp}</td>
         <td>
            <span class="badge badge-primary p-2 mb-1">
               <a href="detail.php?id=${id}" class="text-light">
                  <i class="fas fa-fw fa-eye mr-2"></i>
                  <span>detail</span>
               </a>
            </span>
            <span class="badge badge-success p-2 mb-1">
               <a href="ubah.php?id=${id}" class="text-light">
                  <i class="fas fa-fw fa-edit mr-2"></i>
                  <span>ubah</span>
               </a>
            </span>
            <span class="badge badge-danger p-2 mb-1 badge-delete" data-id="${id}">
               <i class="fas fa-fw fa-trash-alt mr-2 badge-delete" data-id="${id}"></i>
               hapus
            </span>
         </td>
     </tr>
   `;
   
}

window.addEventListener('click', function(e) {
   
   //jika target yang diclick mempunyai class badge-delete, maka munculkan pop up berupa peringatan
   if (e.target.classList.contains('badge-delete')) {
      
      //ambil id dari target
      const id_button = e.target.dataset.id;
      
      swal.fire({
         position: 'center',
         icon: 'warning',
         title: 'Apakah anda yakin',
         text: 'ingin menghapus data tersebut?',
         showCancelButton: true,
         cancelButtonText: '<i class="fas fa-fw fa-times"></i>',
         cancelButtonColor: 'red',
         confirmButtonText: '<i class="fas fa-fw fa-check"></i>'
      }).then(result => {
         
         //ketika hasil nya adalah true, maka arahkan ke hapus.php dengan mengirimkan berupa id 
         if (result.value) document.location.href = `hapus.php?id=${id_button}`;
      });
      
   }
});

const keyword = document.getElementById('keyword');
keyword.addEventListener('keyup', function() {
   
   const input_value = this.value;
   
   const xhr = new XMLHttpRequest();
   xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
         const results = JSON.parse(this.responseText);
         let content = '';
         let no = 1;
         
         results.forEach(result => {
            const {email, id, jurusan, nama, nrp} = result;
            
            content += table(id, nama, nrp, no++);
         });
         
         tableBody.innerHTML = content;
      }
   }
   xhr.open('get', `cari.php?keyword=${input_value}`, true);
   xhr.send();
   
});
