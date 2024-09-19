'use strict'

window.addEventListener('load' , () => {
    console.log("DOM cargado"); // Un mensaje que nos avisa de si el DOM está o no cargado.

    document.querySelector('form').addEventListener('submit', (event) => {
        event.preventDefault(); // 

        if(typeof(email) == 'String') {
            var email = document.querySelector('#email').value; // Tomo el valor del email
            var password = document.querySelector('#password').value; // Tomo el valor del password
            var remember = document.querySelector('#checkbox').checked; // Tomo el valor del checkbox
        }


        console.log("Formulario tomado"); // Un mensaje que nos avisa de si los datos del formulario están o no cargados.
    });
});