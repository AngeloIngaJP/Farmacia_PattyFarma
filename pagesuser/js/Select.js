

function Seleccionado(Precio, PrecioOriginal){

    let cant = document.getElementById('Selectcant');


    let number = cant.value;

    document.getElementById('resultado1').innerHTML = (Precio*number).toFixed(2);
    document.getElementById('resultado2').innerHTML = (((PrecioOriginal).toFixed(2)-(Precio).toFixed(2))*number).toFixed(2);

}