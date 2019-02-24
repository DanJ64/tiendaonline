window.onload = function () {
    let inputFormato = document.getElementById("formato")
    let inputCantidad = document.getElementById("unidades")

    inputFormato.onclick = function () {
        let formato = this.value;
        
        if (formato == "Digital") {
           inputCantidad.min = 0;
           inputCantidad.max = 0
           inputCantidad.value = 0

        }else if (formato == "CD"){
           inputCantidad.min = 0;
           inputCantidad.max = 100;
           //inputCantidad.value = ""
        }
    }
}