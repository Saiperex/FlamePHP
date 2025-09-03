/*Pasar las fases una a una*/
const constructor_etapas = document.querySelectorAll('.constructor_etapa');
const btnPrev = document.querySelector('.prev');
const btnNext = document.querySelector('.sig');
let etapa_actual = 0;

// ✅ Función para limpiar estilos y clases de una etapa
function resetEtapa(etapa) {
    etapa.style.opacity = '';
    etapa.style.transform = '';
    etapa.classList.remove('active', 'exit-left', 'exit-right');
}

// Mostrar la etapa con animación
function mostrarEtapa(nuevaEtapa) {
    if (nuevaEtapa === etapa_actual) return;

    const direccion = nuevaEtapa > etapa_actual ? 'left' : 'right';

    const etapaAnterior = constructor_etapas[etapa_actual];
    const etapaNueva = constructor_etapas[nuevaEtapa];

    // Preparar animación de salida
    etapaAnterior.classList.remove('exit-left', 'exit-right');
    etapaAnterior.classList.add(direccion === 'left' ? 'exit-left' : 'exit-right');

    // Preparar entrada
    etapaNueva.style.transition = 'none';
    etapaNueva.style.transform = direccion === 'left' ? 'translateX(100%)' : 'translateX(-100%)';
    etapaNueva.style.opacity = '0';
    etapaNueva.classList.add('active');

    // Forzar reflow y luego activar transición
    requestAnimationFrame(() => {
        etapaNueva.style.transition = ''; // Restaurar transición
        etapaNueva.style.transform = 'translateX(0)';
        etapaNueva.style.opacity = '1';

        // ✅ Limpiar etapa anterior una vez comenzada la animación de entrada
        resetEtapa(etapaAnterior);
    });

    etapa_actual = nuevaEtapa;
    actualizarBotones();
}

// Desactivar botones cuando no se puede avanzar
function actualizarBotones() {
    btnPrev.disabled = etapa_actual === 0;
    btnNext.disabled = etapa_actual === constructor_etapas.length - 1;
}

// Eventos de navegación
btnPrev.addEventListener('click', () => {
    if (etapa_actual > 0) {
        mostrarEtapa(etapa_actual - 1);
    }
});

btnNext.addEventListener('click', () => {
    if (etapa_actual < constructor_etapas.length - 1) {
        mostrarEtapa(etapa_actual + 1);
    }
});

// Mostrar la primera etapa al cargar
window.addEventListener('DOMContentLoaded', () => {
    constructor_etapas.forEach(etapa => {
        etapa.style.transition = 'none';
        etapa.style.opacity = '0';
        etapa.style.transform = 'translateX(100%)';
        etapa.classList.remove('active', 'exit-left', 'exit-right');
    });

    const primera = constructor_etapas[0];
    primera.classList.add('active');
    primera.style.transform = 'translateX(0)';
    primera.style.opacity = '1';

    // Restaurar transición después de inicializar
    setTimeout(() => {
        constructor_etapas.forEach(etapa => {
            etapa.style.transition = '';
        });
    }, 50);

    actualizarBotones();
});
/*CARGAR SLUGS*/
const preview_slug_span = document.getElementById('preview_slug-span');
const slug = document.getElementById('slug');

slug.addEventListener('input', () => {
    let valor = slug.value;

    // Limitar a 16 caracteres
    if (valor.length > 16) {
        valor = valor.slice(0, 16);
        slug.value = valor; // 👈 también lo recorta visualmente en el input
    }

    cargarSlug(valor);
});

function cargarSlug(value) {
    preview_slug_span.textContent = value;
}