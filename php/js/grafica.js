
let miGrafica=null;
const nombres=[];
const valores=[];
fetch('../php/getProductosRanking.php')
    .then(response => response.json())
    .then(data => {
        console.log(data);
        data.forEach(item => {
            nombres.push(item.nombre);
            valores.push(item.ventas_count);
        });
    })
dibujarGrafica(nombres, valores);
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
                        color: 'black' // el color del texto del texto de la barra horizontal (HTML, CSS)
                    }
                }
            },
            responsive: true, // las barras se adapan al ancho | alto del navegador
            maintainAspectRatio: false, // permite modificarlo con CSS
        }})
    } // Cierro la función