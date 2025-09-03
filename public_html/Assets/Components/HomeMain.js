document.addEventListener("DOMContentLoaded", function () {
    // Seleccionamos todos los enlaces internos (aquellos con href="#...")
    const enlacesInternos = document.querySelectorAll('a[href^="#"]:not([href="#"])');

    // Obtener el alto del header (64px en tu caso)
    const headerHeight = 64;

    // Función para verificar si la pantalla es grande (>= 870px)
    const esPantallaGrande = () => window.innerWidth >= 870;

    enlacesInternos.forEach(enlace => {
        enlace.addEventListener('click', function (e) {
            // Prevenir el comportamiento por defecto (evitar el salto instantáneo)
            e.preventDefault();

            // Obtener el destino del enlace (el ID de la sección)
            const targetId = enlace.getAttribute('href').substring(1); // Eliminar el "#"
            const targetElement = document.getElementById(targetId);

            if (targetElement) {
                // Si estamos en una pantalla grande, ajustamos el desplazamiento
                if (esPantallaGrande()) {
                    // Desplazamos considerando el alto del header (64px)
                    window.scrollTo({
                        top: targetElement.offsetTop - headerHeight,
                        behavior: 'smooth'
                    });
                } else {
                    // En pantallas pequeñas, desplazamos normalmente
                    window.scrollTo({
                        top: targetElement.offsetTop,
                        behavior: 'smooth'
                    });
                }
            }
        });
    });
});
