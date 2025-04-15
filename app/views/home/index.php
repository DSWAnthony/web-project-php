<?php
require_once '../../views/layouts/header.php'; // Asegúrate de que la ruta sea correcta
<<<<<<< HEAD
?>

<body style="background-color: #f4f4f4; margin: 0; padding: 0;">

    <!-- Sección Hero con Carrusel Integrado -->
    <!-- Sección Hero con Carrusel Integrado -->
    <section class="position-relative text-white text-center py-5"
        style="background: url('../../../public/img/imagen6.png') center center/cover no-repeat;">

        <!-- Overlay opcional para oscurecer la imagen de fondo -->
        <div style="background-color: rgba(0,0,0,0.6); position: absolute; top: 0; right: 0; bottom: 0; left: 0;"></div>

        <!-- Contenido del Hero -->
        <div class="container position-relative" style="z-index: 2;">
            <h1 class="display-4 fw-bold">Bienvenidos a ZAPTILLAS ELITE S.A.C</h1>
            <p class="lead">Encuentra el par perfecto para destacar tu estilo.</p>

            <!-- Carrusel de Zapatillas sin fondo duplicado -->
            <div id="carouselExample" class="carousel slide mx-auto my-4"
                style="max-width: 800px;" data-bs-ride="carousel">
                <div class="carousel-inner text-center">
                    <!-- Imagen 1 -->
                    <div class="carousel-item active">
                        <img src="../../../public/img/imagen1.png"
                            class="d-block mx-auto"
                            alt="Sneaker Modelo 1"
                            style="height: 180px; object-fit: contain;">
                    </div>
                    <!-- Imagen 2 -->
                    <div class="carousel-item">
                        <img src="../../../public/img/imagen2.png"
                            class="d-block mx-auto"
                            alt="Sneaker Modelo 2"
                            style="height: 180px; object-fit: contain;">
                    </div>
                    <!-- Imagen 3 -->
                    <div class="carousel-item">
                        <img src="../../../public/img/imagen3.webp"
                            class="d-block mx-auto"
                            alt="Sneaker Modelo 3"
                            style="height: 180px; object-fit: contain;">
                    </div>
                    <!-- Imagen 4 -->
                    <div class="carousel-item">
                        <img src="../../../public/img/imagen4.png"
                            class="d-block mx-auto"
                            alt="Sneaker Modelo 4"
                            style="height: 180px; object-fit: contain;">
                    </div>
                    <!-- Imagen 5 -->
                    <div class="carousel-item">
                        <img src="../../../public/img/imagen5.png"
                            class="d-block mx-auto"
                            alt="Sneaker Modelo 5"
                            style="height: 180px; object-fit: contain;">
                    </div>

=======
?><body style="background-color: #f4f4f4; margin: 0; padding: 0; font-family: 'Segoe UI', sans-serif;">


<section class="position-relative text-white text-center py-5"
         style="background: url('../../../public/img/imagen6.png') center center/cover no-repeat; min-height: 100vh; display: flex; align-items: center; justify-content: center;">

   
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0,0,0,0.6);"></div>

  
    <div class="container position-relative z-1">
        <h1 class="display-4 fw-bold">ZAPATILLAS ELITE S.A.C</h1>
        <p class="lead">Encuentra el par perfecto para destacar tu estilo.</p>

        <!-- Carrusel -->
        <div id="carouselExample" class="carousel slide mx-auto my-4" style="max-width: 700px;" data-bs-ride="carousel">
            <div class="carousel-inner rounded shadow">
                <div class="carousel-item active">
                    <img src="../../../public/img/imagen1.png" class="d-block w-100" alt="Modelo 1" style="height: 300px; object-fit: cover;">
                </div>
                <div class="carousel-item">
                    <img src="../../../public/img/imagen2.png" class="d-block w-100" alt="Modelo 2" style="height: 300px; object-fit: cover;">
                </div>
                <div class="carousel-item">
                    <img src="../../../public/img/imagen3.webp" class="d-block w-100" alt="Modelo 3" style="height: 300px; object-fit: cover;">
                </div>
                <div class="carousel-item">
                    <img src="../../../public/img/imagen4.png" class="d-block w-100" alt="Modelo 4" style="height: 300px; object-fit: cover;">
                </div>
                <div class="carousel-item">
                    <img src="../../../public/img/imagen5.png" class="d-block w-100" alt="Modelo 5" style="height: 300px; object-fit: cover;">
>>>>>>> 2108e96009da811a0bcf1392bcc2e9c4c732be76
                </div>

                <!-- Controles del Carrusel -->
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
            </div>

<<<<<<< HEAD
            <!-- Botón de Llamado a la Acción -->
            <a href="#productos" class="btn btn-primary btn-lg">Explora nuestros modelos</a>
        </div>
    </section>

    <!-- Sección Misión -->
    <section id="mision" class="container mt-5">
        <h2 class="text-center">Nuestra Misión</h2>
        <p class="text-center">
            Ofrecer zapatillas de alta calidad que combinan tecnología, confort y diseño innovador,
            adaptándose a diferentes estilos de vida y necesidades. Nos comprometemos a seleccionar y
            distribuir productos que garanticen la mejor experiencia para nuestros clientes, brindando
            opciones tanto para el uso diario como para actividades deportivas.
        </p>
    </section>

    <!-- Sección Visión -->
    <section id="vision" class="container mt-5">
        <h2 class="text-center">Nuestra Visión</h2>
        <p class="text-center">
            Ser la empresa líder en la comercialización de calzado en Perú y expandir nuestra presencia
            a nivel internacional. Buscamos diferenciarnos a través de una oferta diversa y actualizada,
            el compromiso con la sostenibilidad y la distribución de productos que se adapten a las necesidades
            de cada persona. Nuestra meta es transformar la experiencia de compra de calzado mediante innovación
            y un servicio de excelencia.
        </p>
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
            <!-- Agilidad Comercial -->
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
=======
            <!-- Controles -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>

       
        
    </div>
</section>


<section id="mision" class="container py-5">
    <h2 class="text-center mb-4"><i class="fas fa-bullseye text-primary me-2"></i>Nuestra Misión</h2>
    <p class="text-center fs-5">
        Ofrecer zapatillas de alta calidad que combinan tecnología, confort y diseño innovador. Nos comprometemos con una experiencia de compra sobresaliente.
    </p>
</section>


<section id="vision" class="container py-5 bg-light rounded">
    <h2 class="text-center mb-4"><i class="fas fa-eye text-success me-2"></i>Nuestra Visión</h2>
    <p class="text-center fs-5">
        Ser líderes en calzado en Perú y llegar a nuevos mercados internacionales, innovando constantemente para superar las expectativas de nuestros clientes.
    </p>
</section>

<section id="valores" class="container py-5">
    <h2 class="text-center mb-5"><i class="fas fa-star text-warning me-2"></i>Nuestros Valores</h2>
    <div class="row g-4">
        <!-- Card 1 -->
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-handshake fa-2x text-primary mb-3"></i>
                    <h5 class="card-title">Confiabilidad</h5>
                    <p class="card-text">Cumplimos lo que prometemos, desde la calidad hasta la entrega.</p>
                </div>
            </div>
        </div>
   
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-sync-alt fa-2x text-success mb-3"></i>
                    <h5 class="card-title">Adaptabilidad</h5>
                    <p class="card-text">Nos renovamos constantemente con las últimas tendencias del calzado.</p>
                </div>
            </div>
        </div>
       
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-bolt fa-2x text-warning mb-3"></i>
                    <h5 class="card-title">Agilidad</h5>
                    <p class="card-text">Respondemos rápido a las necesidades de nuestros clientes y del mercado.</p>
                </div>
            </div>
        </div>
      
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-gem fa-2x text-danger mb-3"></i>
                    <h5 class="card-title">Calidad</h5>
                    <p class="card-text">Cada zapatilla pasa por un filtro de calidad exigente y riguroso.</p>
                </div>
            </div>
        </div>
     
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-lightbulb fa-2x text-info mb-3"></i>
                    <h5 class="card-title">Innovación</h5>
                    <p class="card-text">Buscamos nuevas formas de sorprenderte con calzado único.</p>
                </div>
            </div>
        </div>
    
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-trophy fa-2x text-secondary mb-3"></i>
                    <h5 class="card-title">Excelencia</h5>
                    <p class="card-text">Trabajamos para superar tus expectativas en cada paso.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include_once '../layouts/footer.php'; ?>
</body>

</html>
>>>>>>> 2108e96009da811a0bcf1392bcc2e9c4c732be76
