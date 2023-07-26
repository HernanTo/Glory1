document.getElementById('img-profil-c').addEventListener('change', event => {
    var fileInput = document.getElementById('img-profil-c');
    var filePath = fileInput.value;
    var allowedExtensions = /(.jpg|.jpeg|.png)$/i;
    if(!allowedExtensions.exec(filePath)){
            $('#err_img_prod').modal('show');
            fileInput.value = '';
    }else{
        console.log(event.target.files);
        const reader = new FileReader;
        reader.onload = function(e){
          document.getElementById('edit-profile-img').src = e.target.result;
        }
        reader.readAsDataURL(event.target.files[0]);
        document.getElementById('changepicturestate').value = 1;
      }
    }
    )
    document.getElementById('trash-pic').addEventListener('click', event =>{
      document.getElementById('img-profil-c').value = "";
      document.getElementById('edit-profile-img').src = "../../assets/img/profilePictures/default.png";
      document.getElementById('changepicturestate').value = 2;
  })
  
function confirmTrash(id, nameUser){
    $('#modal-delete-user').modal('toggle');
    $('#name-user-delete').empty();
    document.getElementById('name-user-delete').appendChild(document.createTextNode(nameUser));
    document.getElementById('id_user_delete').value = id;
}
document.getElementById('btn-eliminar-user').addEventListener('click', event=>{
    document.getElementById('form-delete-user').submit();
})