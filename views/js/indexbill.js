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