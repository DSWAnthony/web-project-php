<?php
require_once '../../views/layouts/header.php'; // Asegúrate de que la ruta sea correcta
?><body style="background-color: #f4f4f4; margin: 0; padding: 0; font-family: 'Segoe UI', sans-serif;">


<section class="position-relative text-white text-center py-5"
         style="background: url('../../../public/img/imagen6.png') center center/cover no-repeat; min-height: 100vh; display: flex; align-items: center; justify-content: center;">

   
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0,0,0,0.6);"></div>

  
    <div class="container position-relative z-1">
        <h1 class="display-4 fw-bold">ZAPATILLAS ELITE S.A.C</h1>
        

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
                </div>
            </div>

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
