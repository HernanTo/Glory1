let roleNewUser = document.querySelector('.rol__new__user');
roleNewUser.addEventListener('change', event=>{
    if(event.target.value == 5){
        let inptCliete = document.querySelectorAll('.con-inpt-client');
        inptCliete.forEach(element => {
            $(element).addClass('con-inpt-client-visible');
        });
    }else{
        let inptCliete = document.querySelectorAll('.con-inpt-client');
        inptCliete.forEach(element => {
            $(element).removeClass('con-inpt-client-visible');
        });
    }
})