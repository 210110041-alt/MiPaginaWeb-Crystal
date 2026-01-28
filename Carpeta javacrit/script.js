document.addEventListener('DOMContentLoaded', function () {
    // Referencias a elementos del DOM
    const loginScreen = document.getElementById('login-screen');
    const portfolioContent = document.getElementById('portfolio-content');
    const navLoginBtn = document.getElementById('nav-login-btn');
    const closeLoginBtn = document.getElementById('close-login');
    
    const loginView = document.getElementById('login-view');
    const registerView = document.getElementById('register-view');
    const showRegisterLink = document.getElementById('show-register');
    const showLoginLink = document.getElementById('show-login');

    // Elementos de control de sesión
    const loginForm = document.getElementById('login-form');
    const loginError = document.getElementById('login-error');    
    const loginEmailInput = document.getElementById('login-email');
    const passwordInput = document.getElementById('password');

    const registerForm = document.getElementById('register-form');
    const regUsernameInput = document.getElementById('reg-username');
    const regPasswordInput = document.getElementById('reg-password');
    const registerError = document.getElementById('register-error');
    const regEmailInput = document.getElementById('reg-email');

    const registerSuccess = document.getElementById('register-success');
    const togglePasswordBtn = document.getElementById('toggle-password');
    const toggleRegPasswordBtn = document.getElementById('toggle-reg-password');

    // Función para actualizar la interfaz según el estado de sesión
    const updateUI = (isLoggedIn) => {
        const downloadSections = document.querySelectorAll('.download-section');
        const loginPrompts = document.querySelectorAll('.login-prompt');

        if (isLoggedIn) {
            loginScreen.style.display = 'none';
            portfolioContent.style.display = 'block';
            navLoginBtn.textContent = 'Cerrar Sesión';
            downloadSections.forEach(el => el.style.display = 'inline-block'); // Mostrar descargas
            loginPrompts.forEach(el => el.style.display = 'none'); // Ocultar prompts
        } else {
            loginScreen.style.display = 'flex';
            portfolioContent.style.display = 'none';
            navLoginBtn.textContent = 'Iniciar Sesión';
            downloadSections.forEach(el => el.style.display = 'none');
            loginPrompts.forEach(el => el.style.display = 'inline-block'); // Mostrar prompts
        }
    };

    // Verificar el estado de la sesión al cargar la página y mostrar/ocultar contenido
    fetch('check_session.php')
        .then(response => response.json())
        .then(data => {
            updateUI(data.loggedIn);
        })
        .catch(error => {
            console.error('Error al verificar la sesión:', error); // Asumir que no hay sesión si hay un error
            updateUI(false); // Asumir que no hay sesión si hay un error
        });

    // 1. Abrir modal de login
    if (navLoginBtn) {
        navLoginBtn.addEventListener('click', function (e) {
            e.preventDefault();
            // Si el texto es "Cerrar Sesión", significa que hay una sesión activa
            if (navLoginBtn.textContent === 'Cerrar Sesión') {
                // Llamar a logout.php para destruir la sesión en el servidor
                fetch('logout.php')
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            updateUI(false); // Actualizar la UI al estado "sin sesión"
                            loginScreen.style.display = 'flex'; // Mostrar pantalla de login
                            portfolioContent.style.display = 'none'; // Ocultar contenido
                            alert('Has cerrado sesión.');
                        }
                    })
                    .catch(error => {
                        console.error('Error al cerrar sesión:', error);
                        alert('Ocurrió un error al cerrar la sesión.');
                    });
            } else {
                if (loginScreen) loginScreen.style.display = 'flex'; // Muestra el modal
                // Asegurar que se muestra el formulario de login y no el de registro
                if (loginView) loginView.style.display = 'block';
                if (registerView) registerView.style.display = 'none';
                if (loginError) loginError.style.display = 'none';
            }
        });
    }

    // 2. Cerrar modal
    if (closeLoginBtn) {
        closeLoginBtn.addEventListener('click', function () {
            if (loginScreen) loginScreen.style.display = 'none';
        });
    }

    // 3. Lógica de Inicio de Sesión
    if (loginForm) {
        loginForm.addEventListener('submit', function (e) {
            e.preventDefault();
            
            if (!loginEmailInput || !passwordInput) {
                console.error('Error: Campos de correo o contraseña no encontrados.');
                return;
            }

            const email = loginEmailInput.value.trim();
            const pass = passwordInput.value.trim();
            
            loginError.style.display = 'none'; // Limpiar mensaje de error previo

            // ESTE CÓDIGO ES JAVASCRIPT (Cliente):
            // Usa 'fetch' para enviar los datos (email y pass) al archivo 'login.php'
            fetch('login.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ email: email, password: pass })
            })
            .then(response => response.text()) // Recibimos texto primero para ver errores de PHP
            .then(text => {
                try {
                    const data = JSON.parse(text); // Intentamos leer la respuesta
                    if (data.success) {
                        if (loginScreen) loginScreen.style.display = 'none';
                        if (portfolioContent) portfolioContent.style.display = 'block';
                        updateUI(true); // Actualizar la UI al estado "con sesión"
                        // alert(data.message); // Se elimina el alert para una mejor experiencia.
                    } else {
                        loginError.textContent = data.message;
                        loginError.style.display = 'block';
                    }
                } catch (e) {
                    console.error('Error del servidor:', text);
                    alert('Error técnico: ' + text); // Muestra el error real de PHP
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error de conexión. Asegúrate de abrir la página desde Localhost (Laragon).');
            });
        });
    }

    // 4. Alternar entre Login y Registro
    if (showRegisterLink) {
        showRegisterLink.addEventListener('click', function (e) {
            e.preventDefault();
            if (loginView) loginView.style.display = 'none';
            if (registerView) registerView.style.display = 'block';
        });
    }

    if (showLoginLink) {
        showLoginLink.addEventListener('click', function (e) {
            e.preventDefault();
            if (registerView) registerView.style.display = 'none';
            if (loginView) loginView.style.display = 'block';
        });
    }

    // 5. Lógica de Registro
    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!regUsernameInput || !regPasswordInput || !regEmailInput) {
                console.error('Error: Campos de registro no encontrados.');
                return;
            }
            
            const newUser = regUsernameInput.value.trim();
            const newPass = regPasswordInput.value.trim();
            const newEmail = regEmailInput.value.trim();
            registerError.style.display = 'none'; // Limpiar errores previos
            if (newUser === '') {
                registerError.textContent = 'El nombre de usuario es obligatorio.';
                registerError.style.display = 'block';
                return;
            }

            if (newPass.length < 6) {
                registerError.textContent = 'La contraseña debe tener al menos 6 caracteres.';
                registerError.style.display = 'block';
                return;
            }

            // Conexión con PHP (Registro)
            fetch('register.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ username: newUser, password: newPass, email: newEmail })
            })
            .then(response => response.text())
            .then(text => {
                try {
                    const data = JSON.parse(text);
                    if (data.success) {
                        registerError.style.display = 'none';
                        registerSuccess.style.display = 'block';
                        setTimeout(function () {
                            registerSuccess.style.display = 'none';
                            if (showLoginLink) showLoginLink.click();
                            regUsernameInput.value = '';
                            regPasswordInput.value = '';
                            regEmailInput.value = '';
                        }, 1500);
                    } else {
                        registerError.textContent = data.message;
                        registerError.style.display = 'block';
                    }
                } catch (e) {
                    console.error('Error del servidor:', text);
                    alert('Error técnico: ' + text);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error de conexión. Asegúrate de abrir la página desde Localhost (Laragon).');
            });
        });
    }

    // 6. Abrir modal desde los prompts "Inicia sesión"
    document.querySelectorAll('.open-login').forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            if (navLoginBtn) navLoginBtn.click();
        });
    });

    // 7. Mostrar/Ocultar contraseña
    if (togglePasswordBtn && passwordInput) {
        togglePasswordBtn.addEventListener('click', function (e) {
            e.preventDefault(); // Evita que el botón envíe el formulario
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.textContent = type === 'password' ? 'Ver' : 'Ocultar';
        });
    }

    if (toggleRegPasswordBtn && regPasswordInput) {
        toggleRegPasswordBtn.addEventListener('click', function (e) {
            e.preventDefault();
            const type = regPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            regPasswordInput.setAttribute('type', type);
            this.textContent = type === 'password' ? 'Ver' : 'Ocultar';
        });
    }

    // 8. Lógica para animaciones de scroll
    const animatedElements = document.querySelectorAll('.animate-on-scroll');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            // Si el elemento está en la pantalla
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                // Opcional: dejar de observar el elemento una vez que ha sido animado
                observer.unobserve(entry.target);
            }
        });
    }, {
        rootMargin: '0px', // Margen alrededor del viewport
        threshold: 0.15 // El elemento se considera visible cuando el 15% de él está en pantalla
    });

    // Observar cada uno de los elementos que tienen la clase de animación
    animatedElements.forEach(el => observer.observe(el));
});