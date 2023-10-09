const divNotProducts = $('.not-pro-ord');
var fecha = new Date();
var fechaFormateada = fecha.toISOString().slice(0, 10);
document.getElementById('date_bill').value = fechaFormateada;
var configBill = {
    iva: 1,
    estadoPago: 0,
}

document.getElementById('iva__check').addEventListener('change', event=>{
    if(!event.target.checked){
        configBill.iva = 0;
        $('#iva_info').empty();
        document.getElementById('iva_info').appendChild(document.createTextNode('No aplica'));
        pricesTotal();
    }else{
        configBill.iva = 1;
        pricesTotal();
    }
})
// document.getElementById('estado__pago_check').addEventListener('change', event=>{
//     if(!event.target.checked){
//         $('#estado__pago').empty();
//         document.getElementById('estado__pago').appendChild(document.createTextNode('Pendiente de pago'));
        
//     }else{
//         $('#estado__pago').empty();
//         document.getElementById('estado__pago').appendChild(document.createTextNode('Paga'));

//     }
// })


let btnAddSeller = document.querySelector('#btn-add-seller');
let btnAddCustomer = document.querySelector('#btn-add-customer');

btnAddSeller.addEventListener('click', event => {
    $('#modal-add-user').modal('toggle');
})

btnAddCustomer.addEventListener('click', event => {
    $('#modal-add-user').modal('toggle');
})

selectProduts = document.getElementById('products');

let seleccionados = [];
$(selectProduts).change('select2:select', function (e) {
    for (var i = 0; i < selectProduts.options.length; i++) {
        var option = selectProduts.options[i];
        if (option.selected) {
            if(option.value != ""){
                var producto = {
                    id: option.value,
                    name: option.text,
                    price: option.getAttribute('data-price'),
                    max_amount: option.getAttribute('data-amount'),
                    amount: option.getAttribute('data-amount'),
                    img: option.getAttribute('data-img'),
                    inptCan: `can${option.value}`,
                    checkMOCan: `checkM${option.value}`,
                    inputMO: `priceM${option.value}`,
                    descuento: 'NA',
                }
                let ver = true;
                if(seleccionados.length > 0){
                    seleccionados.forEach(element => {
                        if(producto.id == element.id){
                            ver = false;
                        }
                    });

                    // Verificar si el producto ya fue agregado antes
                    if(ver){
                        seleccionados.push(producto);
                        $('.con-product-ord').empty();
                        subtotal = 0;
                        total = 0;
                        seleccionados.forEach(element => {
                            addProductList(element);
                        });
                        
                        pricesTotal();
                    }else{
                        $('#alert-prod-ag').css('display', 'block');
                        setTimeout(function(){
                            $('#alert-prod-ag').css('display', 'none');
                        }, 3000)
                    }
                }else{
                    $('.btn-sub-bill').removeClass('btn-disabled');
                    $( ".btn-sub-bill" ).prop( "disabled", false );
                    seleccionados.push(producto);
                    $('.con-product-ord').empty();
                    subtotal = 0;
                    total = 0;
                    seleccionados.forEach(element => {
                        addProductList(element);
                    });
                    
                    pricesTotal();
                }
            };
        }
    }

    $(selectProduts).val('');
    $(selectProduts).select2('close');
});

var subtotal = 0;
var total = 0;

function addProductList(product){
    // $('.not-pro-ord').css("display", "none")
    let conProduct = document.createElement('div');
    $(conProduct).addClass("prod-rod");
    $(conProduct).addClass("prod-rod-bill");
    let conImg = document.createElement('div');
    $(conImg).addClass('con-img-prod');
    let imgP = document.createElement('img');
    imgP.src = `../../assets/img/products/${product.img}`;
    conImg.appendChild(imgP);
    conProduct.appendChild(conImg);

    let textProd = document.createElement('div');
    $(textProd).addClass("text-prod");

    let tagNameProdu = document.createElement('h3');
    tagNameProdu.appendChild(document.createTextNode(`${(product.name)}`));
    textProd.appendChild(tagNameProdu);
    
    let tagPrice = document.createElement('p');
    tagPrice.appendChild(document.createTextNode(formatCurrency(product.price)));
    textProd.appendChild(tagPrice);
    
    let canMax = document.createElement('i');
    $(canMax).addClass('stock-con')
    canMax.appendChild(document.createTextNode(`Stock: ${(product.max_amount)}`))
    textProd.appendChild(canMax);

    conProduct.appendChild(textProd);

    let divInfoC = document.createElement('div');
    let divamount = document.createElement('div');
    $(divamount).addClass('divamount');

    let labelCan = document.createElement('label');
    labelCan.appendChild(document.createTextNode('Cantidad: '));
    let inputamount = document.createElement('input');
    inputamount.type = "number";
    inputamount.placeholder = "Cantidad";
    inputamount.setAttribute('id', product.inptCan);
    inputamount.value = 1;
    $(inputamount).addClass('form-control');
    $(inputamount).addClass('can_amo');
    divamount.appendChild(labelCan);
    divamount.appendChild(inputamount);
    divInfoC.appendChild(divamount);
    $(divInfoC).addClass('divInfoC');

    let divManoObra = document.createElement('div');
    $(divManoObra).addClass('con-mo');
    let divConCheck = document.createElement('div');
    $(divConCheck).addClass('con-check');
    let inputCheck = document.createElement('input');
    inputCheck.setAttribute('id', product.checkMOCan);

    inputCheck.type = "checkbox";
    let labelCheck = document.createElement('label');
    labelCheck.appendChild(document.createTextNode('¿Mano de obra?'));
    divConCheck.appendChild(inputCheck);
    divConCheck.appendChild(labelCheck);
    divManoObra.appendChild(divConCheck);

    let divconInputMo = document.createElement('div');
    $(divconInputMo).addClass('con-input-mo');
    let inputPriceMo = document.createElement('input');
    inputPriceMo.type = 'number';
    $(inputPriceMo).addClass('form-control');
    $(inputPriceMo).addClass('price-mo-no');
    inputPriceMo.placeholder = "Precio";
    inputPriceMo.value = 0;
    inputPriceMo.setAttribute('id', product.inputMO);
    divconInputMo.appendChild(inputPriceMo);
    divManoObra.appendChild(divconInputMo);

    divInfoC.appendChild(divManoObra);


    let conActionProd = document.createElement('div');
    $(conActionProd).addClass('action-prod');

    let imgCross = document.createElement('img');
    // imgCross.type = "button";
    imgCross.src = "../../assets/img/icons/circle-x.svg";
    imgCross.setAttribute('data-id', product.id);

    conActionProd.appendChild(imgCross);

    let divDesc = document.createElement('div');
    $(divDesc).addClass('divDesc');

    let labeldesc = document.createElement('label');
    labeldesc.appendChild(document.createTextNode('Descuento: '));
    divDesc.appendChild(labeldesc);


    selectDescuentos = document.createElement('select');
    let opt = document.createElement('option');
    opt.textContent = 'No Aplica';
    opt.value = 'NA';
    selectDescuentos.appendChild(opt);

    opt = document.createElement('option');
    opt.textContent = '5%';
    opt.value = '0.05';
    selectDescuentos.appendChild(opt);

    opt = document.createElement('option');
    opt.textContent = '10%';
    opt.value = '0.1';
    selectDescuentos.appendChild(opt);

    divDesc.appendChild(selectDescuentos);
    divInfoC.appendChild(divDesc);

    conProduct.appendChild(conActionProd);
    conProduct.appendChild(divInfoC);

    
    $('.con-product-ord').append(conProduct);
    $(imgCross).on('click', function() {
        deleteProduct(product.id);
    });

    inputamount.onkeydown = function(event) {
        if (event.key === "e" || event.key === "E") {
          return false;
        }
      };
      
    inputamount.addEventListener('change', event =>{
        if(inputamount.value[0] == 0){
            let value = inputamount.value;
            value = reemplazarzero(value);
            inputamount.value = value;
        }else if(inputamount.value < 0){
            inputamount.value = 1;
        }
        if(parseInt(inputamount.value) > product.max_amount){
            console.log(inputamount.value)
            console.log(product.max_amount)
            inputamount.value = 1;
            $(canMax).addClass('stock_sob')
            setTimeout(() => {
                $(canMax).removeClass('stock_sob');
                
            }, 1000);
            pricesTotal();
        }else{
            pricesTotal();
        }
    })

    inputCheck.addEventListener('change', event=>{
        if(event.target.checked){
            $(inputPriceMo).removeClass('price-mo-no');
            $(inputPriceMo).addClass('price-mo');
        }else{
            $(inputPriceMo).removeClass('price-mo');
            $(inputPriceMo).addClass('price-mo-no');
            inputPriceMo.value = 0;
            pricesTotal();
        }
    })

    inputPriceMo.addEventListener('change', event=>{
        if(inputPriceMo.value < 0){
            console.log('a');
            inputPriceMo.value = 0;
        }
        pricesTotal();
    })

    selectDescuentos.addEventListener('change', event =>{
        if(selectDescuentos.value == 'NA'){
            product.descuento = 'NA';
            pricesTotal();
        }else{
            product.descuento = selectDescuentos.value;
            pricesTotal();
        }
    })

    inputPriceMo.onkeydown = function(event) {
        if (event.key === "e" || event.key === "E") {
          return false;
        }
    };
}

function deleteProduct(id){
    let produtsR = [];

    for(let i = 0; i < seleccionados.length; i++){
        if (seleccionados[i].id !== id) {
            produtsR.push(seleccionados[i]);
        }
    }
    $('.con-product-ord').empty();
    subtotal = 0;
    total = 0;
    produtsR.forEach(element => {
        addProductList(element);
    });

    seleccionados = produtsR;

    if(seleccionados.length == 0 ){
        $('.con-product-ord').append(divNotProducts);
        $('.btn-sub-bill').addClass('btn-disabled');
        $( ".btn-sub-bill" ).prop( "disabled", true );
        $('#con-sub-t').empty();
        document.getElementById('con-sub-t').appendChild(document.createTextNode(formatCurrency(0)));
        $('#con-t').empty();
        document.getElementById('con-t').appendChild(document.createTextNode(formatCurrency(0)));
        $('#iva_info').empty();
        document.getElementById('iva_info').appendChild(document.createTextNode(formatCurrency(0)));
    }else{
        pricesTotal();
    }
}


function formatCurrency(number) {
    if (isNaN(number)) {
      return "Invalid number";
    }
    let formattedNumber = new Intl.NumberFormat("es-CO").format(number);
    formattedNumber = `$${formattedNumber}`;

    return formattedNumber;
}

function reemplazarzero(value){
    while(value[0] == 0){
        value = value.slice(1);
    }
    if(value == ''){
        value = 1;
    }
    return value;
}

function errModalStock(err){
    $(document).ready(function() {
        $('#err_bill_stock').modal('toggle');
    });
    err = JSON.parse(err);
    console.log(err);

    err.forEach(element => {
        console.log(element);
        let tr = document.createElement('tr');
        let td = document.createElement('td');
        
        td.appendChild(document.createTextNode(`${element.barcode} - ${element.nameprod}`))
        tr.appendChild(td);
        
        td = document.createElement('td');
        td.appendChild(document.createTextNode(`${element.stockactual}`))
        tr.appendChild(td);
        
        td = document.createElement('td');
        td.appendChild(document.createTextNode(`${element.stockseleccionado}`))
        tr.appendChild(td);

        document.getElementById('table_stock_err').appendChild(tr);
    });
}

function pricesTotal(){
    subtotal = 0;
    seleccionados.forEach(element => {
        let amount = document.getElementById(element.inptCan).value;
        let manoObra = document.getElementById(element.inputMO).value;
        
        subtotal = subtotal + (parseInt(element.price) * parseInt(amount)) + parseInt(manoObra);
        subtotal = element.descuento == 'NA' ? subtotal : subtotal - (subtotal * element.descuento);

       $('#con-sub-t').empty();
       document.getElementById('con-sub-t').appendChild(document.createTextNode(formatCurrency(subtotal)));
    })
    if(configBill.iva == 1){
        iva = subtotal * 0.19;
        $('#iva_info').empty();
        document.getElementById('iva_info').appendChild(document.createTextNode(formatCurrency(iva)));
    }else{
        iva = 0;
        $('#iva_info').empty();
        document.getElementById('iva_info').appendChild(document.createTextNode('No Aplica'));
    }

    $('#con-t').empty();
    document.getElementById('con-t').appendChild(document.createTextNode(formatCurrency(subtotal + iva)));
}

$('.btn-sub-bill').on('click', function(){
    if(document.getElementById('references').value != ''){
        if(document.getElementById('customers').value != ''){
            if(document.getElementById('seller').value != ''){
                seleccionados.forEach(element =>{
                    let inputProduct = document.createElement('input');
                    inputProduct.type = "number";
                    inputProduct.setAttribute('name', 'product_id[]');
                    $(inputProduct).addClass('inp-inf');
                    inputProduct.value = element.id;
                    inputProduct.setAttribute('class', 'hide_in_form');
                    
                    let inputAmount = document.createElement('input');
                    inputAmount.type = "number";
                    inputAmount.setAttribute('name', 'product_amount[]');
                    $(inputAmount).addClass('inp-inf');
                    inputAmount.value = document.getElementById(element.inptCan).value;
                    inputAmount.setAttribute('class', 'hide_in_form');
            
                    let inputPrice = document.createElement('input');
                    inputPrice.type = "number";
                    inputPrice.setAttribute('name', 'product_price[]');
                    $(inputPrice).addClass('inp-inf');
                    inputPrice.value = element.price;
                    inputPrice.setAttribute('class', 'hide_in_form');
                    
                    let CheckManoObra = document.createElement('input');
                    CheckManoObra.type = 'check';
                    CheckManoObra.value = document.getElementById(element.checkMOCan).checked;
                    CheckManoObra.setAttribute('name', 'check_mano_obra[]');
                    CheckManoObra.setAttribute('class', 'hide_in_form');
            
                    let priceManoObra = document.createElement('input');
                    priceManoObra.type = 'text';
                    priceManoObra.value = document.getElementById(element.inputMO).value;
                    priceManoObra.setAttribute('name', 'price_mano_obra[]');
                    priceManoObra.setAttribute('class', 'hide_in_form');

                    let descuento = document.createElement('input')
                    descuento.type = 'text';
                    descuento.value = element.descuento;
                    descuento.setAttribute('name', 'descuento[]');
                    descuento.setAttribute('class', 'hide_in_form');
                    
                    let iva = document.createElement('input')
                    iva.type = 'text';
                    iva.value = document.getElementById('iva__check').checked;
                    iva.setAttribute('name', 'iva_check');
                    iva.setAttribute('class', 'hide_in_form');

                    // let estado_pago = document.createElement('input')
                    // estado_pago.type = 'text';
                    // estado_pago.value = document.getElementById('estado__pago_check').checked;
                    // estado_pago.setAttribute('name', 'estado_pago_check');
                    // estado_pago.setAttribute('class', 'hide_in_form');

                    $('#form-bill').append(inputProduct);
                    $('#form-bill').append(inputAmount);
                    $('#form-bill').append(inputPrice);
                    $('#form-bill').append(CheckManoObra);
                    $('#form-bill').append(priceManoObra);
                    $('#form-bill').append(descuento);
                    $('#form-bill').append(iva);
                    // $('#form-bill').append(estado_pago);
            
                    document.getElementById('form-bill').submit();
                })
            }

        }
    }
})