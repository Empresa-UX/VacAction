'use strict'

window.addEventListener('load' , () => {
    console.log("DOM cargado"); // Un mensaje que nos avisa de si el DOM está o no cargado.

    function validarEmail(email) {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    function validarPassword(password) {
        return password.length >= 8;
    }

    document.querySelector('form').addEventListener('submit', (event) => {
        event.preventDefault(); // 

        var remember = document.querySelector('#checkbox').checked; // Tomo el valor del checkbox

        if(validarEmail(email)) {
            var email = document.querySelector('#email').value; // Tomo el valor del email
        }

        if(validarPassword(password)) {
            var password = document.querySelector('#password').value; // Tomo el valor del password
        }
    });
});