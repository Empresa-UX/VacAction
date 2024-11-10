<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- http://127.0.0.1:5500/html/home.html -->
         
        <!-- CSS -->
        <link rel="stylesheet" href="/css/style-home.css">
        <link rel="icon" href="/img/icons_logo/icon_black.ico" type="image/x-icon">

        <title>VacAction | Home</title>
    </head>
    <body>
        <header>
            <div class="header-container">
                <h1>Gestión de Vacaciones</h1>
                <div class="logo">
                    <img src="/img/icons_logo/icon_white2.png" alt="VacAction logo">
                </div>
                <nav> 
                    <ul>
                        <li><a href="#">Inicio</a></li>
                        <li><a href="#">Mis Vacaciones</a></li>
                        <li><a href="#">Política de Vacaciones</a></li>
                        <li><a href="#">Ayuda</a></li>
                    </ul>
                </nav>
            </div>
        </header>
        
        <div class="imagen">
            <img src="/img/backgrounds/background (11).jpg" alt="Decorative image">
        </div>
        <main>
            <section class="vacaciones">
                <h2>Días de Vacaciones Disponibles</h2>
                <p>Tienes <strong>[X]</strong> días disponibles.</p>
                <button id="solicitudes">Solicitar Vacaciones</button>
            </section>

            <section class="calendario">
                <h2>Próximas Vacaciones</h2>
                <div id="calendario-widget">
                  <!-- Aquí iría el calendario embebido -->
                </div>
            </section>
            <section class="pendientes">
                <h2>Solicitudes Pendientes</h2>
                <p>Tienes <strong>[X]</strong> solicitudes pendientes.</p>
                <button>Ver detalles</button>
            </section>

            <section class="historial">
                <h2>Historial de Vacaciones</h2>
                <p>Últimas vacaciones: [Fecha inicio] - [Fecha fin]</p>
                <button>Ver Historial Completo</button>
            </section>
        </main>

        <!--panel lateral-->
        <aside>
            <h2>Política de Vacaciones</h2>
            <a href="#">Leer Política Completa</a>
            <h2>Preguntas Frecuentes (FAQ)</h2>
            <a href="#">Ver FAQ</a>
        </aside>

        <!--Pie de pagina-->
        <footer>
            <a href="">Comentarios</a>
            <p>&copy; 2024 Gestión de Vacaciones | Contacto: VacAction@gmail.com</p>
        </footer>
    </body>
</html>