<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Portafolio — Diseño, Programación y Mantenimiento</title>
  <!-- Favicons: preferible generar PNG/ICO; se incluye un SVG placeholder y un fallback -->
  <link rel="icon" href="img/favicon.svg" type="image/svg+xml">
  <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
  <link rel="shortcut icon" href="img/favicon.ico">
  <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
  <!-- Fallback si aún no has generado los archivos anteriores -->
  <link rel="alternate icon" href="img/logo.jpg" type="image/jpeg">
  <link rel="stylesheet" href="Carpeta CSS/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">
</head>
<body>

  <!-- PANTALLA DE LOGIN -->
  <div id="login-screen">
    <div class="login-card">
      <span id="close-login" style="position: absolute; top: 10px; right: 15px; font-size: 28px; cursor: pointer; color: #555; font-weight: bold;">&times;</span>
      <!-- VISTA DE LOGIN -->
      <div id="login-view">
        <h2>Bienvenido</h2>
        <p>Por favor, inicia sesión para ver el portafolio.</p>
        <form id="login-form">
          <div>
            <label for="login-email">Correo Electrónico</label>
            <input type="email" id="login-email" placeholder="Ingresa tu correo">
          </div>
          <div>
            <label for="password">Contraseña</label>
            <input type="password" id="password" placeholder="Ingresa tu contraseña">
          </div>
          <button type="submit">Ingresar</button>
          <p id="login-error">Credenciales incorrectas.</p>
          <p>¿No tienes cuenta? <a href="#" id="show-register">Regístrate aquí</a></p>
        </form>
      </div>

      <!-- VISTA DE REGISTRO -->
      <div id="register-view" style="display: none;">
        <h2>Crear Cuenta</h2>
        <p>Ingresa tus datos para registrarte.</p>
        <form id="register-form">
          <div>
            <label for="reg-username">Usuario</label>
            <input type="text" id="reg-username" required placeholder="Nuevo usuario">
          </div>
          <div>
            <label for="reg-password">Contraseña</label>
            <input type="password" id="reg-password" required placeholder="Contraseña">
             <label for="reg-email">Correo Electrónico</label>
            <input type="email" id="reg-email" required placeholder="Correo Electrónico">
          </div>
          <button type="submit">Registrarse</button>
          <p id="register-error"></p>
          <p id="register-success">¡Registro exitoso! Redirigiendo...</p>
          <p>¿Ya tienes cuenta? <a href="#" id="show-login">Inicia sesión</a></p>
        </form>
      </div>
    </div>
  </div>

  <!-- NAVBAR -->
  <nav>
  <div class="logo"><img src="img/logo.jpg" alt="Logo" /><span>Portafolio</span></div>
    <div class="menu-toggle">☰</div>
    <ul>
      <li><a href="#inicio" class="active">Inicio</a></li>
      <li><a href="#acerca">Acerca de</a></li>
      <li><a href="#habilidades">Habilidades</a></li>
      <li><a href="#portafolio">Portafolio</a></li>
      <li><a href="#ubicacion">Ubicación</a></li>
      <li><a href="#contacto">Contacto</a></li>
      <li><a href="#" id="nav-login-btn">Iniciar Sesión</a></li>
    </ul>
  </nav>

  <!-- INICIO -->
  <div id="portfolio-content" style="display: none;">
  <section id="inicio">
    <h1>Portafolio personal</h1>
    <p>Presento mis habilidades en <strong>🎨 Desarrollo web</strong>, <strong>💻 Programación orientada a objetos</strong> y <strong>🛠️ Mantenimiento de cómputo</strong>. Aquí verás proyectos y ejemplos.</p>
    <a href="#acerca">Sobre mí</a>
  </section>

  <!-- ACERCA DE -->
  <section id="acerca" class="animate-on-scroll">
    <h2>Sobre mí</h2>
    <p>Hola, soy Crystal — estudiante de Ingeniería en Sistemas Computacionales. Mezclo creatividad y técnica: diseño piezas gráficas, desarrollo soluciones con programación orientada a objetos y realizo mantenimiento y soporte de equipos. Me interesa crear experiencias bien diseñadas, código limpio y sistemas confiables.</p>
    <img src="img/portada.png" alt="Retrato" class="profile-pic" />
  </section>

  <!-- HABILIDADES -->
  <section id="habilidades" class="animate-on-scroll">
    <h2>Habilidades</h2>
    
    <div class="skill">
      <div class="skill-name">🎨 Desarrollo web</div>
      <div class="progress">
        <div class="progress-bar" data-width="90%">90%</div>
      </div>
    </div>

    <div class="skill">
      <div class="skill-name">💻 Programación orientada a objetos</div>
      <div class="progress">
        <div class="progress-bar" data-width="85%">85%</div>
      </div>
    </div>

    <div class="skill">
      <div class="skill-name">🛠️ Mantenimiento de cómputo</div>
      <div class="progress">
        <div class="progress-bar" data-width="80%">80%</div>
      </div>
    </div>
  </section>

  <!-- PORTAFOLIO -->
  <section id="portafolio" class="animate-on-scroll">
    <h2>Proyectos destacados</h2>
    <div class="portfolio">
      <figure>
        <figcaption>Desarrollo web - Proyectos:</figcaption>
        <img src="img/web.gif" alt="GIF Desarrollo Web">
        <a class="btn-primary" href="https://crystal-lv2.github.io/PROMEXFRUT/" target="_blank">🔗 Ver Proyecto PROMEXFRUT</a>
        <div class="download-section">
          <a class="btn-secondary" href="download.php?file=Reporte_Estancia_Promexfrut.pdf">⬇️ Descargar Reporte PDF</a>
        </div>
        <p class="login-prompt">
          👉 <a href="#" class="open-login">Inicia sesión</a> para descargar los archivos
        </p>
      </figure>
      <figure>
        <figcaption>Aplicaciónes de escritorio desarrolladas en Java - Proyectos:</figcaption>
        <img src="img/java.gif" alt="GIF Java">
        <div class="download-section" style="display: none;">
          <a class="btn-primary" href="download.php?file=CineGestor.exe">⬇️ Descargar CineGestor</a>
          <a class="btn-secondary" href="download.php?file=Calculadora.java">⬇️ Descargar Calculadora</a>
        </div>
        <p class="login-prompt">
          👉 <a href="#" class="open-login">Inicia sesión</a> para descargar los archivos
        </p>
      </figure>
      <figure>
        <figcaption>Mantenimiento preventivo y correctivo de cómputo - Proyectos:</figcaption>
        <img src="img/destornillador.gif" alt="GIF Mantenimiento">
        <div class="download-section" style="display: none;">
          <a class="btn-primary" href="download.php?file=Aprendizaje_Mantenimiento.pdf">⬇️ Descargar Reporte</a>
        </div>
        <p class="login-prompt">
          👉 <a href="#" class="open-login">Inicia sesión</a> para descargar los archivos
        </p>
      </figure>
    </div>
  </section>

  <!-- UBICACIÓN (sección separada) -->
  <section id="ubicacion" class="animate-on-scroll">
    <h2>Ubicación</h2>
    <div class="map-toggle">
      <button id="map-toggle-btn" type="button">Ver mapa completo</button>
    </div>
    <div class="map-responsive">

      <!-- Mapa embebido centrado en Culiacán -->
      <iframe src="https://www.google.com/maps?q=Culiac%C3%A1n+Sinaloa+Mexico&output=embed" allowfullscreen loading="lazy"></iframe>
    </div>
  </section>

  <!-- CONTACTO -->
  <section id="contacto" class="animate-on-scroll">
    <h2>Contacto</h2>
    <p>Puedes escribirme o dejar un comentario en el formulario:</p>

    <div class="contact-wrapper">
      <div class="contact-card comments">
        <h3>Deja un comentario</h3>
  <form id="contact-form" action="https://formsubmit.co/210110041@upve.edu.mx" method="POST">
    <!-- FormSubmit: envío directo a 210110041@upve.edu.mx. Se enviará un email de confirmación la primera vez. -->
    <input type="hidden" name="_subject" value="Contacto desde portafolio">
    <input type="hidden" name="_captcha" value="false">
          <label for="name">Nombre</label>
          <input type="text" id="name" name="name" required placeholder="Tu nombre">

          <label for="email">Tu correo</label>
          <input type="email" id="email" name="email" required placeholder="tu@correo.com">

          <label for="message">Mensaje</label>
          <textarea id="message" name="message" rows="5" required placeholder="Escribe tu mensaje..."></textarea>

          <button type="submit">Enviar</button>
        </form>

        <div id="contact-feedback" role="status" aria-live="polite"></div>
      </div>

      <div class="contact-actions">
        <a id="direct-email-link" class="contact-btn" href="https://mail.google.com/mail/?view=cm&to=210110041@upve.edu.mx" data-email="210110041@upve.edu.mx" target="_blank" rel="noopener">📧 Escribir Correo</a>
        <button id="copy-email-btn" class="contact-btn" type="button">📋 Copiar Correo</button>
        <a class="contact-btn" href="https://www.instagram.com/crys_lv?igsh=MXRwdnNmlhYXd0aQ==" target="_blank" rel="noopener">📷 Instagram</a>
      </div>

      <div id="mailto-feedback">Correo copiado al portapapeles.</div>

    </div>
  </section>
  </div>
  <script src="Carpeta%20javacrit/script.js"></script>
</body>
</html>
