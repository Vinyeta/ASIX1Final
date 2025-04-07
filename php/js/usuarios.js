
const estrellas = document.querySelectorAll(".estrella");
const regaloInput = document.querySelector(".regalo");


estrellas.forEach((estrella) => {
    /*Recorrer todos los elementos de estrellas, es la lista
    de estrellas en html que se han obtenido con queryselector.
    estrella es el parametro de la funcion, cada vez que se recorre el
    array representa el elemento actual de la lista de estrellas*/
    estrella.addEventListener("click", function() {
        const puntaje = parseInt(estrella.getAttribute("value")); //se obtiene el value clicado y se asegura entero con parseInt
        regaloInput.value = puntaje + 1; //actualizar valor en input oculto, se suma 1 porque empieza desde el 0

        estrellas.forEach((e, posicion) => { //ejecutar la funcion para cada elemento
            if (posicion <= puntaje) { //si es menor o igual al puntaje obtenido
                e.src = "img/estrellaAmarilla.png"; 
            } else {
                e.src = "img/estrellaGris.png";
            }
        });
    });
});


//contador de caracteres
comentarioInput.addEventListener("input", function () {
    const caracteresRestantes = 200 - comentarioInput.value.length;
    contador.textContent = `${caracteresRestantes} /200`;

    
    
});