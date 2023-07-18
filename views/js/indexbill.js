function formatCurrency(number) {
    if (isNaN(number)) {
      return "Invalid number";
    }
    let formattedNumber = new Intl.NumberFormat("es-CO").format(number);
    formattedNumber = `$${formattedNumber}`;

    return formattedNumber;
}


let prices = document.querySelectorAll('.prices');
for (let i = 0; i < prices.length; i++) {
   let precio = prices[i].textContent;
    $(prices[i]).empty();
    prices[i].appendChild(document.createTextNode(formatCurrency(precio)));
}
function confirmTrash(id, nameUser){
  $('#modal-delete-bill').modal('toggle');
  $('#name-bill-delete').empty();
  document.getElementById('name-bill-delete').appendChild(document.createTextNode(nameUser));
  document.getElementById('id_bill_delete').value = id;
}
document.getElementById('btn-eliminar-user').addEventListener('click', event=>{
  document.getElementById('form-delete-user').submit();
})