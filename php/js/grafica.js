let miGrafica = null; 

document.querySelector('#btnProductos').addEventListener('click', ()=>mostrarProductos());
document.querySelector('#btnCategorias').addEventListener('click',()=> mostrarCategorias());
const mostrarProductos=()=>{
    fetch('../php/getProductosRanking.php')
    .then(response => response.json())
    .then(data => {
        const nombres=[];
        const valores=[];
        data.forEach(item => {
            nombres.push(item.nombre);
            valores.push(item.ventas_count);
        });
        dibujarGrafica(nombres, valores);
        locucion(`El producto más vendido es ${nombres[0]} con ${valores[0]} productos vendidos`);
    })
    .catch(error => {
        console.error('Error al obtener los datos:', error);
    });
}
const mostrarCategorias = ()=>{
    fetch('../php/getCategoriasRanking.php')
    .then(response => response.json())
    .then(data => {
        const nombres=[];
        const valores=[];
        data.forEach(item => {
            nombres.push(item.categoria);
            valores.push(item.total_ventas);
        });
        dibujarGrafica(nombres, valores);
        locucion(`La categoria más vendida es ${nombres[0]} con ${valores[0]} productos vendidos`);
    })
    .catch(error => {
        console.error('Error al obtener los datos:', error);
    });
};
function dibujarGrafica(nombres, valores){
    // Dibujar la gráfica (en vez de hoja y miGrafica puedes poner el nombre que quieras)
    let hoja = document.querySelector('.miGrafica').getContext('2d');
    if (miGrafica) {
        // si ya existe una gráfica en pantalla, y se quiere dibujar OTRA, antes se tiene que borrar la actual
        miGrafica.destroy();
    }
    miGrafica = new Chart(hoja, {
        type: 'bar', // indica qué tipo de gráfica se creará (también existe ‘line’ (de líneas), ‘pie’ (quesito)..
        data: {
            labels: nombres, // son los nombres que hay debajo de las barras (HTML, CSS)
            datasets: [{
                data: valores, // son los valores numéricos con los que se crearán las barras
                backgroundColor: [ // son los colores de las barras
                    'rgba(66, 133, 244, 1)',
                    'rgba(234, 67, 53, 1)',
                    'rgba(251, 188, 5, 1)',
                    'rgba(52, 168, 83, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ]
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: false 
                }
            },
            scales: {
                y: {
                    beginAtZero: true, // que empiece a contar a partir de 0
                    ticks: {
                        color: 'gray' , // color del texto de los valores de la linea vertical de la izquierda (0, 1, 2…)
                        stepSize: 1 // estos valores van de 1 en 1
                    },
                },
                x: {
                    ticks: {
                        color: 'black',
                        maxRotation: 0, 
                        align:'justify',
                        callback: function(index) {
                            const text= nombres[index];
                            const words = text.split(' ');
                            if (words.length > 4) {
                                return [
                                    words.slice(0, 4).join(' '), 
                                    words.slice(4, 8).join(' '), 
                                    words.slice(8,12).join(' '),
                                    words.slice(12).join(' ')
                                ];
                            } else if (words.length > 2) {
                                return [
                                    words.slice(0, 2).join(' '),
                                    words.slice(2).join(' ') 
                                ];
                            } else {
                                return text; 
                            }
                        }
                    },
                }
            },
            responsive: true, // las barras se adapan al ancho | alto del navegador
            maintainAspectRatio: false, // permite modificarlo con CSS
        }})
    } // Cierro la función
const locucion= (texto)=>{;
                        let locucion = new SpeechSynthesisUtterance(texto);
                        locucion.lang = 'es-ES';
                        locucion.pitch = 1.3;
                        locucion.rate = 1.25;   
                        if (window.speechSynthesis.speaking || window.speechSynthesis.pending) {
                            window.speechSynthesis.cancel();
                        }
                        window.speechSynthesis.speak(locucion);     
}
mostrarProductos();
