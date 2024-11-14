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


  