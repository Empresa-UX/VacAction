# 📅 VacAction - Sistema de Gestión de Vacaciones para Empresas

Bienvenido a **VacAction**, una solución de gestión de vacaciones diseñada para empresas que necesitan organizar y administrar las solicitudes de tiempo libre de su personal de manera efectiva. Este proyecto permite a los usuarios solicitar vacaciones y a los administradores revisar y aprobar dichas solicitudes a través de una interfaz amigable.

## 🌟 Características Principales
- **Gestión de usuarios:** Los empleados pueden iniciar sesión, ver sus vacaciones y solicitar tiempo libre.
- **Roles de usuario:** Permite roles de usuario y administrador, para diferentes niveles de acceso.
- **Interfaz de calendario:** Visualización de las vacaciones aprobadas en un calendario interactivo.
- **Panel de administración:** Los administradores pueden ver, aprobar o rechazar solicitudes de vacaciones.

## 🛠️ Tecnologías Utilizadas
- **Backend:** PHP
- **Base de Datos:** MySQL
- **Frontend:** HTML, CSS, JavaScript
- **Bibliotecas:** FullCalendar para el calendario interactivo

## 🚀 Instalación y Configuración

### 1. Clonar el Repositorio
```bash
git clone https://github.com/Empresa-UX/VacAction.git
cd VacAction

### 2. Configurar la Base de Datos
1. Crear una base de datos llamada `vacaction_db`.
2. Importar el archivo `vacaction_db.sql` en tu base de datos.
3. Ajustar las credenciales en el archivo PHP de conexión a la base de datos.

### 3. Iniciar el Servidor
Este proyecto requiere un servidor local, como [XAMPP](https://www.apachefriends.org/) o [WAMP](https://www.wampserver.com/). Mueve los archivos del proyecto a la carpeta del servidor y accede a la aplicación desde tu navegador.

## 📂 Estructura del Proyecto
- **`css/`** - Contiene el estilo general de la aplicación.
- **`img/`** - Almacena los iconos y recursos visuales.
- **`js/`** - Contiene el JavaScript necesario, incluyendo la configuración de FullCalendar.
- **`php/`** - Incluye los scripts PHP para gestionar el inicio de sesión, el registro, y las solicitudes de vacaciones.
- **`index.php`** - Página principal de la aplicación.

## 🧭 Uso del Proyecto

### Usuarios
- **Registro e inicio de sesión:** Los usuarios pueden crear una cuenta o iniciar sesión.
- **Solicitar vacaciones:** Desde el panel principal, pueden elegir fechas y enviar la solicitud.
- **Ver vacaciones:** Revisar el estado de sus solicitudes y ver las fechas en el calendario.

### Administradores
- **Gestión de solicitudes:** Acceden a un panel donde pueden aprobar o rechazar solicitudes.
- **Visualización global:** Pueden ver todas las vacaciones solicitadas y aprobadas de la empresa.

## 📸 Capturas de Pantalla
Aquí se mostrarían imágenes de las interfaces clave, como el calendario, el panel de administración, y la vista de solicitudes. Esto puede incluir:
- **Calendario de vacaciones** - Vista del calendario con solicitudes aprobadas y pendientes.
- **Panel de administrador** - Gestión de solicitudes de los empleados.

## 🤝 Contribuciones
¡Apreciamos tus contribuciones! Si quieres mejorar VacAction, sigue estos pasos:
1. Haz un fork del repositorio.
2. Crea una nueva rama (`git checkout -b feature/nueva-caracteristica`).
3. Haz tus cambios y haz commit (`git commit -am 'Añadir nueva característica'`).
4. Haz push a la rama (`git push origin feature/nueva-caracteristica`).
5. Abre un Pull Request.

## 📄 Licencia
Este proyecto está bajo la Licencia MIT. Consulta el archivo [LICENSE](LICENSE) para obtener más detalles.
