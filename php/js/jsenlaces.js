
// FUNCION COLOR DE ENLACES HEADER (USUARIO REGISTRADO)
window.addEventListener("load", enlacesColor);
function enlacesColor(){
    let enlace=window.location.pathname;

    const logout=document.querySelector(".linkLogout");
    const productos=document.querySelector(".linkProductos");
    const usuarios=document.querySelector(".linkUsuarios");
    const mapa=document.querySelector(".linkMapa");

    if(enlace.includes("logout.php")){
        logout.style.color="red";
        logout.style.cursor="default";
        productos.style.color="blue";
        usuarios.style.color="blue";
        mapa.style.color="blue";
        logout.addEventListener("click",evento);
        function evento(event){
            event.preventDefault();
        }
    }
    if(enlace.includes("productos.php")){
        productos.style.color="red";
        productos.style.cursor="default";
        logout.style.color="blue";
        usuarios.style.color="blue";
        mapa.style.color="blue";
        productos.addEventListener("click",evento);
        function evento(event){
            event.preventDefault();
        }
    }
    if(enlace.includes("baseDatos.php")){
        usuarios.style.color="red";
        usuarios.style.cursor="default";
        logout.style.color="blue";
        productos.style.color="blue";
        mapa.style.color="blue";
        usuarios.addEventListener("click",evento);
        function evento(event){
            event.preventDefault();
        }
    }
    if(enlace.includes("mapa.php")){
        mapa.style.color="red";
        mapa.style.cursor="default";
        logout.style.color="blue";
        productos.style.color="blue";
        usuarios.style.color="blue";
        mapa.addEventListener("click",evento);
        function evento(event){
            event.preventDefault();
        }
    }
}