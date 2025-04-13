<?php

require_once '../../views/layouts/header.php'; // Asegúrate de que la ruta sea correcta

?>
<body>
    
<div id="carouselExample" class="carousel slide mt-4" data-bs-ride="carousel">
    <div class="carousel-inner text-center" style="background-color: #000;"> <!-- Fondo opcional -->
        <!-- Imagen 1 -->
        <div class="carousel-item active">
            <img src="../../../public/img/imagen1.png" class="d-block mx-auto" style="object-fit: contain; height: 400px; width: 100%;" alt="Imagen 1">
        </div>
        <!-- Imagen 2 -->
        <div class="carousel-item">
            <img src="../../../public/img/imagen2.png" class="d-block mx-auto" style="object-fit: contain; height: 400px; width: 100%;" alt="Imagen 2">
        </div>
        <!-- Imagen 3 -->
        <div class="carousel-item">
            <img src="../../../public/img/imagen3.webp" class="d-block mx-auto" style="object-fit: contain; height: 400px; width: 100%;" alt="Imagen 3">
        </div>
        <!-- Imagen 4 -->
        <div class="carousel-item">
            <img src="../../../public/img/imagen4.png" class="d-block mx-auto" style="object-fit: contain; height: 400px; width: 100%;" alt="Imagen 4">
        </div>
        <!-- Imagen 5 -->
        <div class="carousel-item">
            <img src="../../../public/img/imagen5.png" class="d-block mx-auto" style="object-fit: contain; height: 400px; width: 100%;" alt="Imagen 5">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
    </button>
</div>



    <!-- Sección Misión -->
<section id="mision" class="container mt-5">
    <h2 class="text-center">Nuestra Misión</h2>
    <p class="text-center">Ofrecer zapatillas de alta calidad que combinan tecnología, confort y diseño innovador, adaptándose a diferentes estilos de vida y necesidades. Nos comprometemos a seleccionar y distribuir productos que garanticen la mejor experiencia para nuestros clientes, brindando opciones tanto para el uso diario como para actividades deportivas.</p>
</section>

<!-- Sección Visión -->
<section id="vision" class="container mt-5">
    <h2 class="text-center">Nuestra Visión</h2>
    <p class="text-center">Ser la empresa líder en la comercialización de calzado en Perú y expandir nuestra presencia a nivel internacional. Buscamos diferenciarnos a través de una oferta diversa y actualizada, el compromiso con la sostenibilidad y la distribución de productos que se adapten a las necesidades de cada persona. Nuestra meta es transformar la experiencia de compra de calzado mediante innovación y un servicio de excelencia.</p>
</section>

<!-- Sección Valores -->
<section id="valores" class="container mt-5">
    <h2 class="text-center">Nuestros Valores</h2>
    <div class="row mt-4">
        <!-- Confiabilidad -->
        <div class="col-md-4 mb-4">
            <div class="card border-primary">
                <div class="card-body">
                    <h5 class="card-title text-primary">Confiabilidad</h5>
                    <p class="card-text">Cumplimos lo que prometemos, desde la disponibilidad del producto hasta los tiempos de entrega.</p>
                </div>
            </div>
        </div>
        <!-- Adaptabilidad -->
        <div class="col-md-4 mb-4">
            <div class="card border-success">
                <div class="card-body">
                    <h5 class="card-title text-success">Adaptabilidad</h5>
                    <p class="card-text">Evolucionamos junto al mercado, incorporando nuevas marcas, modelos y canales de atención.</p>
                </div>
            </div>
        </div>
        <!-- Agilidad comercial -->
        <div class="col-md-4 mb-4">
            <div class="card border-warning">
                <div class="card-body">
                    <h5 class="card-title text-warning">Agilidad Comercial</h5>
                    <p class="card-text">Respondemos de forma rápida a las demandas del cliente y a los cambios del entorno.</p>
                </div>
            </div>
        </div>
        <!-- Calidad -->
        <div class="col-md-4 mb-4">
            <div class="card border-danger">
                <div class="card-body">
                    <h5 class="card-title text-danger">Calidad</h5>
                    <p class="card-text">Seleccionamos calzado que cumpla con altos estándares en confort, diseño y durabilidad.</p>
                </div>
            </div>
        </div>
        <!-- Innovación -->
        <div class="col-md-4 mb-4">
            <div class="card border-info">
                <div class="card-body">
                    <h5 class="card-title text-info">Innovación</h5>
                    <p class="card-text">Incorporamos marcas y productos con tecnología y tendencias actuales.</p>
                </div>
            </div>
        </div>
        <!-- Excelencia -->
        <div class="col-md-4 mb-4">
            <div class="card border-secondary">
                <div class="card-body">
                    <h5 class="card-title text-secondary">Excelencia</h5>
                    <p class="card-text">Nos esforzamos por brindar un servicio ágil, ordenado y profesional.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include_once '../layouts/footer.php'; ?>


</body>
</html>