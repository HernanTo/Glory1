let btnAddUser = document.querySelector('.btn-modal-add');

btnAddUser.addEventListener('click', event => {
    $('#modal-add-user').modal('toggle');
})

// document.getElementById('submit-add-user').addEventListener('click', event=>{
    //     if (document.getElementById('submit-add-user').checkValidity()) {
        //         // document.getElementById('form-add-user').submit();
        //         console.log('todo correcto rey');
        //       } 
        // })
function confirmTrash(id, nameUser){
    
    $('#modal-delete-user').modal('toggle');
    $('#name-user-delete').empty();
    document.getElementById('name-user-delete').appendChild(document.createTextNode(nameUser));
    document.getElementById('id_user_delete').value = id;
}
document.getElementById('btn-eliminar-user').addEventListener('click', event=>{
    document.getElementById('form-delete-user').submit();
})