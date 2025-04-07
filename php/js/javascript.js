/*document.querySelector(".ojoAbierto").style.backgroundColor="red";buscar objeto con class/style/imagenfondo*/
document.querySelector(".ojoAbierto").addEventListener("click",cambio);

/*cambio de imagen ojo abierto a cerrado */
const repeat=document.querySelector(".ojoAbierto");
repeat.addEventListener("click",cambio);
repeat.style.cursor="pointer";
function cambio(){
    let img=repeat.getAttribute("src");
    if(img==="img/eyeOpen.svg"){
        repeat.src="img/eyeClose.svg";
        repeat.setAttribute("title","Ocultar contraseña");
        document.querySelector("#password").setAttribute("type","text");
    } else {
        repeat.src="img/eyeOpen.svg";
        repeat.setAttribute("title","Mostrar contraseña");
        document.querySelector("#password").setAttribute("type","password");
    }
}


// FUNCION COLOR DE ENLACES HEADER (REGISTRO Y LOGIN)
window.addEventListener("load", colorEnlaces);
function colorEnlaces(){
    let url=window.location.pathname; //guardar en variable la url

    const login=document.querySelector(".login");
    const registro=document.querySelector(".registro");

    if(url.includes("login.php")){ //comprobar si la variable incluye el texto que se ponga
        login.classList.add("actual"); // metodo para añadir class y editar en css
        login.style.cursor="default";
        registro.classList.remove("actual");
        login.addEventListener("click",evento);
        function evento(event){
            event.preventDefault();
        }
    }
    if(url.includes("formulario.php")){
        registro.classList.add("actual");
        registro.style.cursor="default"; //añadir css directamente
        login.classList.remove("actual"); //le quita el class para que aplique el css normal
        registro.addEventListener("click",evento);
        function evento(event){
            event.preventDefault();
        }
    }
}







