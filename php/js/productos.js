
    const consultaGet = new URLSearchParams(window.location.search); //devuelve cadena de consulta de url (despues de ?)
    const categoria = consultaGet.get("categoria");

    
    const redes = document.querySelector(".imgRedes");
    const sistemas = document.querySelector(".imgSistemas");
    const web = document.querySelector(".imgWeb");
    const todos = document.querySelector(".imgFiltro");


    if (categoria === "Redes") {
        redes.style.backgroundColor = "green";
        redes.style.border = "3px solid red";
        redes.style.borderRadius = "5px";
        redes.style.cursor = "default";
        redes.addEventListener("click", (e) => e.preventDefault()); //desactiva el enlace
    }
    if (categoria === "Sistemas") {
        sistemas.style.backgroundColor = "green";
        sistemas.style.border = "3px solid red";
        sistemas.style.borderRadius = "5px";
        sistemas.style.cursor = "default";
        sistemas.addEventListener("click", (e) => e.preventDefault());
    }
    if (categoria === "Web") {
        web.style.backgroundColor = "green";
        web.style.border = "3px solid red";
        web.style.borderRadius = "5px";
        web.style.cursor = "default";
        web.addEventListener("click", (e) => e.preventDefault());
    }
    if (categoria === null) {
        todos.style.backgroundColor = "green";
        todos.style.border = "3px solid red";
        todos.style.borderRadius = "5px";
        todos.style.cursor = "default";
        todos.addEventListener("click", (e) => e.preventDefault());
    };



