
var fecha = new Date();
var fechaFormateada = fecha.toISOString().slice(0, 10);
document.getElementById('date_bill').value = fechaFormateada;
let estadoSub = false;


document.getElementById('desc').addEventListener('keypress', event =>{
    let valTextAr = document.getElementById('desc').value
    let textClean = '';
    let count = 0;

    for (let i = 0; i < valTextAr.length; i++) {
        if(valTextAr[i] != '<' && valTextAr[i] != '>' && valTextAr[i] != "/" && valTextAr[i] != '&' && valTextAr[i] != '$'){
            textClean += valTextAr[i];
            // console.log(textClean);
            count++;
        }
        document.getElementById('desc').value = textClean;
        $('#count__chart').empty();
        document.getElementById('count__chart').appendChild(document.createTextNode(count));
    }
})

const habBtnSub = () =>{
    if(document.getElementById('date_bill').value != '' &&
    document.getElementById('references').value != '' &&
    document.getElementById('customers').value != '' &&
    document.getElementById('seller').value != '' &&
    document.getElementById('desc').value != '' &&
    document.getElementById('price').value != ''){
        $('.btn-sub-bill').removeClass('btn-disabled');
        $( ".btn-sub-bill" ).prop( "disabled", false );
        estadoSub = true;
    }else{
        desBtnSub();
        estadoSub = false;
    }
}

const desBtnSub = () =>{
    $('.btn-sub-bill').removeClass('btn-disabled');
    $('.btn-sub-bill').addClass('btn-disabled');
    $( ".btn-sub-bill" ).prop( "disabled", true );
}

let inputServ = ['date_bill', 'references', 'customers', 'seller', 'desc', 'price'];

inputServ.forEach(element => {
    document.getElementById(element).addEventListener('change', event => {
        habBtnSub();
    })
});

document.querySelector('.btn-sub-bill').addEventListener('click', event=>{
    if(estadoSub){
        let iva = document.createElement('input')
        iva.type = 'text';
        iva.value = document.getElementById('iva__check').checked;
        iva.setAttribute('name', 'iva_check');
        iva.setAttribute('class', 'hide_in_form');

        let estado_pago = document.createElement('input')
        estado_pago.type = 'text';
        estado_pago.value = document.getElementById('estado__pago_check').checked;
        estado_pago.setAttribute('name', 'estado_pago_check');
        estado_pago.setAttribute('class', 'hide_in_form');

        $('#form-bill').append(iva);
        $('#form-bill').append(estado_pago);

        document.getElementById('form-bill').submit();
    }
})


$("input[data-type='currency']").on({
    keyup: function() {
      formatCurrency($(this));
    },
    blur: function() { 
      formatCurrency($(this), "blur");
    }
});


function formatNumber(n) {
  return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}


function formatCurrency(input, blur) {
  // appends $ to value, validates decimal side
  // and puts cursor back in right position.
  
  // get input value
  var input_val = input.val();
  
  // don't validate empty input
  if (input_val === "") { return; }
  
  // original length
  var original_len = input_val.length;

  // initial caret position 
  var caret_pos = input.prop("selectionStart");
    
  // check for decimal
  if (input_val.indexOf(".") >= 0) {

    // get position of first decimal
    // this prevents multiple decimals from
    // being entered
    var decimal_pos = input_val.indexOf(".");

    // split number by decimal point
    var left_side = input_val.substring(0, decimal_pos);
    var right_side = input_val.substring(decimal_pos);

    // add commas to left side of number
    left_side = formatNumber(left_side);

    // validate right side
    right_side = formatNumber(right_side);
    
    // On blur make sure 2 numbers after decimal
    if (blur === "blur") {
      right_side += "00";
    }
    
    // Limit decimal to only 2 digits
    right_side = right_side.substring(0, 2);

    // join number by .
    input_val = "$" + left_side + "." + right_side;

  } else {
    // no decimal entered
    // add commas to number
    // remove all non-digits
    input_val = formatNumber(input_val);
    input_val = "$" + input_val;
  }
  
  // send updated string to input
  input.val(input_val);

  // put caret back in the right position
  var updated_len = input_val.length;
  caret_pos = updated_len - original_len + caret_pos;
  input[0].setSelectionRange(caret_pos, caret_pos);
}