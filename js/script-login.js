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

        alert("Formulario tomado"); // Un mensaje que nos avisa de si los datos del formulario están o no cargados.
    });
});

// 'use strict'

// window.addEventListener('load', () => {
//     console.log("DOM cargado");

//     // Función para validar el email
//     function validarEmail(email) {
//         var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
//         return emailRegex.test(email);
//     }

//     // Función para validar la contraseña (mínimo 8 caracteres)
//     function validarPassword(password) {
//         return password.length >= 8;
//     }

//     // Manejador del evento submit del formulario
//     document.querySelector('form').addEventListener('submit', (event) => {
//         event.preventDefault(); // Evitar el envío del formulario

//         // Variables para recoger los valores del formulario
//         var email = document.querySelector('#email').value;
//         var password = document.querySelector('#password').value;
//         var remember = document.querySelector('#checkbox').checked;

//         // Variables para los mensajes de error
//         var emailError = '';
//         var passwordError = '';

//         // Validar el email
//         if (!validarEmail(email)) {
//             emailError = "El email no tiene un formato válido. Falta el .com o algún otro error.";
//         }

//         // Validar la contraseña
//         if (!validarPassword(password)) {
//             passwordError = "La contraseña debe tener al menos 8 caracteres.";
//         }

//         // Mostrar los mensajes de error si existen
//         var errorDiv = document.querySelector('#errorMessages');
//         errorDiv.innerHTML = ''; // Limpiar mensajes previos

//         if (emailError || passwordError) {
//             if (emailError) {
//                 var emailErrorMsg = document.createElement('p');
//                 emailErrorMsg.textContent = emailError;
//                 emailErrorMsg.style.color = 'red';
//                 errorDiv.appendChild(emailErrorMsg);
//             }

//             if (passwordError) {
//                 var passwordErrorMsg = document.createElement('p');
//                 passwordErrorMsg.textContent = passwordError;
//                 passwordErrorMsg.style.color = 'red';
//                 errorDiv.appendChild(passwordErrorMsg);
//             }
//         } else {
//             // Si todo es válido, puedes procesar el formulario
//             alert("Formulario válido, listo para ser enviado.");
//             // Aquí puedes continuar con el envío o procesamiento del formulario
//         }
//     });
// });
