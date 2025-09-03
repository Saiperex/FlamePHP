const boton = document.querySelector(".button_menu ");
const cabecera = document.querySelector(".cabecera");
const enlaces = document.querySelectorAll(".menu_opc"); // o el selector que uses

boton.addEventListener("click", () => {
    cabecera.classList.toggle("menu_activo");
});

// Cerrar el menú al hacer clic en cualquier enlace
enlaces.forEach(enlace => {
    enlace.addEventListener("click", () => {
        cabecera.classList.remove("menu_activo");
    });
});
// Cerrar el menú si el ancho es mayor o igual a 940px
window.addEventListener("resize", () => {
    if (window.innerWidth >= 870) {
        cabecera.classList.remove("menu_activo");
    }
});