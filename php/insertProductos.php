<?php
$productos = [
    [
        'nombre' => 'Cisco IE-3300',
        'descripcion' => 'Conmutador Ethernet Cisco Catalyst IE3300 IE-3300 con 8 puertos gestionable y 2 ranuras SFP. Los switches de Cisco cuentan con la escalabilidad necesaria para satisfacer las necesidades de redes de todos los tamaños.',
        'precio' => 2345.97,
        'img' => 'img/productos/switches/1.webp',
        'categoria' => 'Switches'
    ],
    [
        'nombre' => 'Cisco Business CBS110-16PP',
        'descripcion' => 'Forman parte del portafolio de redes Cisco Business, son una familia de switches asequibles que brindan conectividad Gigabit Ethernet para la red de su pequeña empresa.',
        'precio' => 257.01,
        'img' => 'img/productos/switches/2.jpg',
        'categoria' => 'Switches'
    ],
    [
        'nombre' => 'Cisco Catalyst C1000-24P-4G-L',
        'descripcion' => 'Los switches Cisco ® Catalyst ® de la serie 1000 están fijos y son configurables Gigabit Ethernet y Fast Ethernet de Capa 2 de clase empresarial de conmutadores diseñados para las pequeñas empresas y sucursales.',
        'precio' => 990.63,
        'img' => 'img/productos/switches/3.webp',
        'categoria' => 'Switches'
    ],
    [
        'nombre' => 'Cisco CBS110-16T-EU',
        'descripcion' => 'Estos conmutadores de nivel de entrada asequibles, plug-and-play, proporcionan conmutación Gigabit Ethernet con características como Power over Ethernet (PoE), eficiencia energética y priorización de tráfico para una transformación digital perfecta.',
        'precio' => 156.80,
        'img' => 'img/productos/switches/4.webp',
        'categoria' => 'Switches'
    ],
    [
        'nombre' => 'Cisco C1000-48P-4X-L',
        'descripcion' => 'Este switch de red sencillo, flexible y seguro es ideal para las implementaciones fundamentales de IoT (Internet de las cosas). Funciona con el software Cisco IOS y cuenta con una CLI (interfaz de línea de comandos) y una interfaz de usuario web intuitiva.',
        'precio' => 2646.00,
        'img' => 'img/productos/switches/5.webp',
        'categoria' => 'Switches'
    ],
    [
        'nombre' => 'Cisco SF110-16',
        'descripcion' => 'Proporcionan todas las funciones, además de capacidad de expansión y la protección de la inversión que cabe esperar de Cisco, sin necesidad de software de instalación y sin nada que configurar.',
        'precio' => 117.57,
        'img' => 'img/productos/switches/6.webp',
        'categoria' => 'Switches'
    ],
    [
        'nombre' => 'Cisco SF110-24',
        'descripcion' => 'Proporcionan fiabilidad y conectividad de red básica para pequeñas empresas, sin complejidad. Solo tiene que enchufarlo, conectar los equipos informáticos y otros dispositivos de empresa, y comenzar a trabajar.',
        'precio' => 59.99,
        'img' => 'img/productos/switches/7.webp',
        'categoria' => 'Switches'
    ],
    [
        'nombre' => 'Cisco SG110D-05',
        'descripcion' => 'Los switches no gestionados SG110D-05 de Cisco proporcionan fiabilidad y conectividad de red básica para pequeñas empresas por un precio asequible y sin apenas complejidad.',
        'precio' => 95.16,
        'img' => 'img/productos/switches/8.webp',
        'categoria' => 'Switches'
    ],
    [
        'nombre' => 'Cisco CBS250-24T-4X',
        'descripcion' => 'La serie Cisco Business 250 es la próxima generación de conmutadores inteligentes asequibles que combinan un potente rendimiento de red, seguridad y confiabilidad con un conjunto completo de funciones de red.',
        'precio' => 1140.59,
        'img' => 'img/productos/switches/9.webp',
        'categoria' => 'Switches'
    ]
];

require_once("conexionok.php");



$sql = "INSERT IGNORE INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `img`, `categoria`) VALUES ";

foreach ($productos as $producto) {
    $nombre=$producto['nombre'];
    $desc=$producto['descripcion'];
    $precio=$producto['precio'];
    $img=$producto['img'];
    $categoria=$producto['categoria'];
    $sql=$sql."(NULL, '$nombre', '$desc', '$precio', '$img','$categoria'),";
}
$sql=rtrim($sql, ",");
$sql=$sql.";";

if ($con->query($sql) === TRUE) {
    echo "Datos introducidos";
  } else {
    echo "Error introduciendo datos: " . $con->error;
  }
  
  $con->close();
  echo "<div><a href='index.php'>Volver</a></div>";

?>
