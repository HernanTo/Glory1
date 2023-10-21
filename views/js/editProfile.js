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




// Contraseñas 

var inputCurretntPass = document.getElementById('current-password');
var newPassword = document.getElementById('new-password');
var RepeatNewPassword = document.getElementById('repeat-new-password');

var stateFormsPass = [
  {
    state: false,
    input: inputCurretntPass
  }, 
  {
    state: false,
    input: newPassword
  }, 
  {
    state: false,
    input: RepeatNewPassword
  }
];


inputCurretntPass.addEventListener('change', event=>{
  if(event.target.value.length < 8){
    $(inputCurretntPass).removeClass('is-invalid');
    $(inputCurretntPass).removeClass('is-valid');
    $(inputCurretntPass).addClass('is-invalid');
    $('#current-pasw-inv').empty();
    document.getElementById('current-pasw-inv').appendChild(document.createTextNode('Ingrese una contraseña válida'));

    stateFormsPass[0].state = false;
  }else{
    if(verActNew()){
      $(newPassword).removeClass('is-invalid');
      $(newPassword).removeClass('is-valid');
      $(newPassword).addClass('is-invalid');
      
      $('#new-pass-chang').empty();
      
      document.getElementById('new-pass-chang').appendChild(document.createTextNode('La nueva contraseña no puede ser igual a la contraseña actual'));
      stateFormsPass[0].state = false;    
    }else{
      stateFormsPass[0].state = true;    
    }
  }
})

newPassword.addEventListener('change', event=>{
  let valueNewPass = event.target.value;
  let mayusOnStr = false;
  let numberOnStr = false;
  let cantStr = false;

  for(let i = 0; i < valueNewPass.length; i++){
    /\d/.test(valueNewPass.charAt(i)) ? numberOnStr = true :  null;

    if(valueNewPass[i] == valueNewPass[i].toUpperCase() && !/\d/.test(valueNewPass.charAt(i))){
      mayusOnStr = true;
    }
  }

  valueNewPass.length >= 8 ? cantStr = true : cantStr = false;

  if(!mayusOnStr || !numberOnStr || !cantStr ){
    $(newPassword).addClass('is-invalid');
    stateFormsPass[1].state = false;
    $('#new-pass-chang').empty();

    document.getElementById('new-pass-chang').appendChild(document.createTextNode('Contraseña no válida, asegúrase de que la nueva contraseña cumpla con los siguientes requisitos: mínimo 8 caracteres, al menos un número y una letra mayúscula.'));

  }else{
    $(newPassword).removeClass('is-invalid');
    $(newPassword).addClass('is-valid');
    stateFormsPass[1].state = true;
  }

if(verActNew()){
  $(newPassword).removeClass('is-invalid');
  $(newPassword).removeClass('is-valid');
  $(newPassword).addClass('is-invalid');
  
  $('#new-pass-chang').empty();
  
  document.getElementById('new-pass-chang').appendChild(document.createTextNode('La nueva contraseña no puede ser igual a la contraseña actual'));
  stateFormsPass[1].state = false;

}else{
  if(inputCurretntPass.value.length < 8){
    $(inputCurretntPass).removeClass('is-invalid');
    $(inputCurretntPass).removeClass('is-valid');
    $(inputCurretntPass).addClass('is-valid');

    stateFormsPass[0].state = true;
  }

  if(RepeatNewPassword.value != ''){
    if(retificar()){
          $(RepeatNewPassword).removeClass('is-invalid');
          $(RepeatNewPassword).addClass('is-valid');
          stateFormsPass[2].state = true;
    }else{
      $(RepeatNewPassword).removeClass('is-valid');
      $(RepeatNewPassword).addClass('is-invalid');
      stateFormsPass[2].state = false;
    }
  }
}

})

RepeatNewPassword.addEventListener('change', event=>{
  if(event.target.value == newPassword.value){
    $(RepeatNewPassword).removeClass('is-invalid');
    $(RepeatNewPassword).addClass('is-valid');
    stateFormsPass[2].state = true;
  }else{
    $(RepeatNewPassword).removeClass('is-valid');
    $(RepeatNewPassword).addClass('is-invalid');
    stateFormsPass[2].state = false;
  }
})

document.getElementById('btn-passw').addEventListener('click', event =>{
  let stateGeneral = true;

  for(let i = 0; i < stateFormsPass.length; i++){
    if(stateFormsPass[i].state == false){
      stateGeneral = false;

      $(stateFormsPass[i].input).removeClass('is-valid');
      $(stateFormsPass[i].input).removeClass('is-invalid');
      $(stateFormsPass[i].input).addClass('is-invalid');
    }
  }

  stateGeneral ? document.getElementById('form-change-password').submit() :  null;
})




function verActNew(){
  return newPassword.value == inputCurretntPass.value;
}
function retificar(){
  return newPassword.value == RepeatNewPassword.value;

}