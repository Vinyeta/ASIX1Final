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
// FIN ARRAY
document.querySelectorAll(".chin")[0].addEventListener("click",boton1);
document.querySelectorAll(".chin")[1].addEventListener("click",boton2);
document.querySelectorAll(".chin")[2].addEventListener("click",boton3);
document.querySelectorAll(".chin")[3].addEventListener("click",boton4);
document.querySelectorAll(".chin")[4].addEventListener("click",boton5);

// conteo de array
let conteo = 0;
//DEFINIR POSICIONES DE ARRAY EN CADA ELEMENTO Y MOSTRAR
function boton1(){
    conteo=0;
    mostrar(sucursales[conteo]);
}
function boton2(){
    conteo=1;
    mostrar(sucursales[conteo]);
}
function boton3(){
    conteo=2;
    mostrar(sucursales[conteo]);
}
function boton4(){
    conteo=3;
    mostrar(sucursales[conteo]);
}
function boton5(){
    conteo=4;
    mostrar(sucursales[conteo]);
}
// FUNCION PARA MOSTRAR LOS DATOS EN BOX:
function mostrar(infoCiudad) { // infoCiudad contiene los datos
    const box = document.querySelector(".box");
    const velo = document.querySelector(".velo");
    //añadir class para modificar en CSS
    box.classList.add("visible");
    velo.classList.add("visible");
    // Insertar datos en el box
    document.querySelector(".box h1").innerHTML = infoCiudad.ciudad;
    document.querySelector(".imagen").innerHTML = `<img src="img/${infoCiudad.imagen}">`;
    document.querySelector(".adress").innerHTML = infoCiudad.direccion;
    document.querySelector(".mail").innerHTML = infoCiudad.mail;
    document.querySelector(".tel").innerHTML = infoCiudad.tel;
}
//FUNCIONES ANTERIOR Y SIGUIENTE:
document.querySelectorAll(".flecha")[0].addEventListener("click",anterior);
function anterior(){
    if (conteo > 0){
        conteo--;
    } else {
        conteo=sucursales.length - 1;
    }
    mostrar(sucursales[conteo]);
}
document.querySelectorAll(".flecha")[1].addEventListener("click",siguiente);
function siguiente(){
    if (conteo < sucursales.length - 1){
        conteo++;
    } else {
        conteo=0;
    }
    mostrar(sucursales[conteo]);
}
//FUNCION PARA CERRAR BOX
document.querySelector(".cerrar").addEventListener("click", cerrar);

function cerrar() {
    const box = document.querySelector(".box");
    const velo = document.querySelector(".velo");
    box.classList.remove("visible");
    velo.classList.remove("visible");
    box.style.opacity = "0";
    box.style.visibility = "hidden";
}
//pruebas
document.addEventListener("keydown", function(event) {
    if (event.ctrlKey && event.key === "e") {  
        document.body.style.backgroundColor = "pink";  
        alert("¡Felicidades Javier, has leído todo el código! :)");
    }
});


