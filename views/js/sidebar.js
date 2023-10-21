let stateMenu = false;
let minMenu = false;
let outmouse = false;
let estadoConLogs = false;

let sidebar = document.querySelector('.con-sidebar');

document.getElementById('btn-menu').addEventListener('click', event=>{
    stateMenu ? $('.sidebar').removeClass('sidebar-open') : $('.sidebar').addClass('sidebar-open');
    stateMenu = !stateMenu;
})
document.getElementById('under-sidebar').addEventListener('click', event=>{
    $('.sidebar').removeClass('sidebar-open');
    stateMenu = false;
})
document.getElementById('btn-desp-sidebar').addEventListener('click', event=>{
    minMenu ? $('.con-main-general').removeClass('con-sidebar-min') : $('.con-main-general').addClass('con-sidebar-min');
    minMenu = !minMenu;
    if(minMenu){
        outmouse = 11;
    }else{
        outmouse = false;
    }
})

sidebar.addEventListener('mouseover', event=>{
    if(outmouse){
        $('.con-main-general').addClass('con-sidebar-min-d');
    }
})
sidebar.addEventListener('mouseout', event=>{
    if(outmouse == 11){
        $('.con-main-general').removeClass('con-sidebar-min-d');
        // alert('sale')
    }
})

let estadoDrow = false;

// navbar
document.getElementById('info-us-na').addEventListener('mouseover', event =>{
     $('.dronwdonw-nav-user').addClass('dronwdonw-nav-user-show');
})
document.getElementById('info-us-na').addEventListener('mouseout', event =>{
    $('.dronwdonw-nav-user').removeClass('dronwdonw-nav-user-show');
})

document.getElementById('drown-navbar').addEventListener('mouseover', event =>{
    $('.dronwdonw-nav-user').addClass('dronwdonw-nav-user-show');
})
document.getElementById('drown-navbar').addEventListener('mouseout', event =>{
   $('.dronwdonw-nav-user').removeClass('dronwdonw-nav-user-show');
})


document.getElementById('btn-logs-s').addEventListener('click', event=>{
    if(estadoConLogs){
        $('.dronwdonw-logs').removeClass('dronwdonw-nav-log-show');
        estadoConLogs = false;
    }else{
        $('.dronwdonw-logs').addClass('dronwdonw-nav-log-show');
        estadoConLogs = true;
    }
});
document.getElementById('cross-logs').addEventListener('click', event=>{
    $('.dronwdonw-logs').removeClass('dronwdonw-nav-log-show');
    estadoConLogs = false;
})
// navbar