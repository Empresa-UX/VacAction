// Función para alternar el menú desplegable
function toggleDropdown() {
    const dropdown = document.getElementById("dropdown-menu");
    dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
}

// Cierra el menú si se hace clic fuera de él
window.onclick = function(event) {
    if (!event.target.matches('#listas_sesion_sector_3_header') && !event.target.closest('#listas_sesion_sector_3_header')) {
        const dropdown = document.getElementById("dropdown-menu");
        if (dropdown.style.display === "block") {
            dropdown.style.display = "none";
        }
    }
}

document.addEventListener("DOMContentLoaded", function() {
    const dropdown = document.getElementById("dropdown-menu");
    dropdown.style.display = "none"; // Oculta el menú al cargar la página
});

function toggleDropdown() {
    const dropdown = document.getElementById("dropdown-menu");
    dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
}
// -------------------------------------------------codigo sin funcionar----------------------------------------------------
// Selecciona la sección objetivo
const targetSection = document.querySelector('#contenido_2');

// Escucha el evento de scroll
window.addEventListener('scroll', () => {
    // Obtén la posición de la sección objetivo en relación con la ventana
    const rect = targetSection.getBoundingClientRect();

    // Si la sección está visible en el viewport, aplica la clase oscura
    if (rect.top <= window.innerHeight && rect.bottom >= 0) {
        targetSection.classList.add('dark-overlay');
    } else {
        // Quita la clase si la sección ya no está en vista
        targetSection.classList.remove('dark-overlay');
    }
});
