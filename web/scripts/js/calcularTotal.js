window.onload = function(){
    let precioVisual = document.getElementById("total")
    let precios = document.getElementsByClassName("precio")
    let precioTotal = 0;
    
    for(precio of precios){
        precioTotal += parseFloat(precio.textContent);
    }

    precioVisual.textContent = precioTotal + " €"
}