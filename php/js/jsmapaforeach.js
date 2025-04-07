// INICIO ARRAY
const sucursales = [
    {
        ciudad: "Madrid",
        imagen: "madrid.jpg",
        direccion: "Paseo de la Castellana, 12",
        mail: "madrid@typeform.com",
        tel: "(+34) 91 375 25 00"
    },
    {
        ciudad: "Nueva York",
        imagen: "newyork.jpg",
        direccion: "5th Avenue, 1199",
        mail: "newyork@typeform.com",
        tel: "(+12) 122 266 758"
    },
    {
        ciudad: "Rio de Janeiro",
        imagen: "rio.jpg",
        direccion: "Av. Presidente Vargas, 700",
        mail: "rio@typeform.com",
        tel: "(+55) 800 888 1955"
    },
    {
        ciudad: "Tokyo",
        imagen: "tokyo.jpg",
        direccion: "13-5 Ichibancho, Chiyoda 102-0082",
        mail: "tokyo@typeform.com",
        tel: "(+81) 362 060 239"
    },
    {
        ciudad: "Sidney",
        imagen: "sidney.jpg",
        direccion: "242 Georges River Rd, Croydon Park",
        mail: "sidney@typeform.com",
        tel: "(+61) 292 841 200"
    }
];
//FIN ARRAY

// conteo de array
let conteo = 0;

// FUNCION PARA MOSTRAR LOS DATOS EN BOX
function mostrar(infoCiudad) { //infoCiudad contiene los datos
    const box = document.querySelector(".box");
    const velo = document.querySelector(".velo");
    // Añadir a class y modificar en css 
    box.classList.add("visible");
    velo.classList.add("visible");
    //insertar datos en el box
    document.querySelector(".box h1").innerHTML = infoCiudad.ciudad;
    document.querySelector(".imagen").innerHTML = `<img src="img/${infoCiudad.imagen}">`;
    document.querySelector(".adress").innerHTML = infoCiudad.direccion;
    document.querySelector(".mail").innerHTML = infoCiudad.mail;
    document.querySelector(".tel").innerHTML = infoCiudad.tel;
}

document.getElementById("izq").addEventListener("click", anterior);  // Botón de "Anterior"
document.getElementById("der").addEventListener("click", siguiente);

function siguiente() {
    conteo = (conteo + 1) % sucursales.length; // Avanza al siguiente, vuelve al principio si está en el último
    mostrar(sucursales[conteo]);
}

function anterior() {
    conteo = (conteo - 1 + sucursales.length) % sucursales.length; // Va al anterior, vuelve al último si está en el primero
    mostrar(sucursales[conteo]);
}

// Crear los eventos para las chin dinámicamente
document.querySelectorAll(".chin").forEach((chin, indice) => {
    chin.addEventListener("click", () => {
        conteo = indice; // Establecer el índice de la ciudad seleccionada
        mostrar(sucursales[conteo]);
    });
});



// Función para cerrar el panel
document.querySelector(".cerrar").addEventListener("click", cerrar);

function cerrar() {
    const box = document.querySelector(".box");
    const velo = document.querySelector(".velo");
    box.classList.remove("visible");
    velo.classList.remove("visible");
    box.style.opacity = "0";
    box.style.visibility = "hidden";
}
