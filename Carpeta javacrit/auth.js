// Clase Auth - login demo para uso local (no para producción)
// Provee: login(email,password), logout(), isAuthenticated(), getUser(), onAuthChange(cb)
class Auth {
  constructor(options = {}) {
    this.storageKey = options.storageKey || 'pm_auth_user';
    this._listeners = [];
    this.user = null;
    // cargar estado inicial desde localStorage O sessionStorage
    try {
      const raw = localStorage.getItem(this.storageKey) || sessionStorage.getItem(this.storageKey);
      this.user = raw ? JSON.parse(raw) : null;
    } catch (e) {
      this.user = null;
    }
  }

  // Intentar autenticación vía API (Laragon PHP). Si falla la conexión, usar fallback local demo.
  async login(email, password, remember = true) {
    if (!email || !password) throw new Error('Email y contraseña son requeridos');
    const emailPattern = /^\S+@\S+\.\S+$/;
    if (!emailPattern.test(email)) throw new Error('Formato de correo inválido');

    // Intentar llamada al servidor
    try {
      const res = await fetch('/portafolio-auth/api/login.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ email, password }),
        credentials: 'include'
      });

      // Si el backend no existe (404), forzar error para usar fallback
      if (res.status === 404) throw new Error('Backend not found');

      const json = await res.json().catch(() => null);
      if (res.ok && json && json.success) {
        this.user = json.user;
        const storage = remember ? localStorage : sessionStorage;
        if (remember) sessionStorage.removeItem(this.storageKey); else localStorage.removeItem(this.storageKey);
        try { storage.setItem(this.storageKey, JSON.stringify(this.user)); } catch (e) {}
        this._emitChange();
        return this.user;
      }
      // si el servidor respondió con error, propagar mensaje
      const msg = json && json.message ? json.message : 'Credenciales inválidas';
      throw new Error(msg);
    } catch (err) {
      // Fallback local si no hay servidor o hay error de red
      if (err instanceof TypeError || /NetworkError|failed|Backend not found/i.test(err.message)) {
        // Simular login local (demo): acepta cualquier contraseña de 4+ caracteres
        if (password.length < 4) throw new Error('Contraseña demasiado corta (mín 4 caracteres)');
        const user = { email: email.toLowerCase(), name: email.split('@')[0], loggedAt: Date.now(), demo: true };
        this.user = user;
        const storage = remember ? localStorage : sessionStorage;
        if (remember) sessionStorage.removeItem(this.storageKey); else localStorage.removeItem(this.storageKey);
        try { storage.setItem(this.storageKey, JSON.stringify(user)); } catch (e) {}
        this._emitChange();
        return user;
      }
      throw err;
    }
  }

  async register(email, password, name) {
    if (!email || !password) throw new Error('Email y contraseña son requeridos');
    try {
      const res = await fetch('/portafolio-auth/api/register.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ email, password, name })
      });
      const json = await res.json();
      if (res.ok && json.success) return json;
      throw new Error(json.message || 'Error al registrar');
    } catch (e) {
      throw e;
    }
  }

  async logout() {
    // intentar notificar al servidor
    try {
      await fetch('/portafolio-auth/api/logout.php', { method: 'GET', credentials: 'include' });
    } catch (e) { /* ignore network error */ }
    this.user = null;
    try { localStorage.removeItem(this.storageKey); } catch (e) {}
    try { sessionStorage.removeItem(this.storageKey); } catch (e) {}
    this._emitChange();
  }

  isAuthenticated() { return !!this.user; }
  isLoggedIn() { return this.isAuthenticated(); }
  getUser() { return this.user; }

  onAuthChange(cb) { if (typeof cb === 'function') this._listeners.push(cb); return () => { this._listeners = this._listeners.filter(f => f !== cb); }; }

  _emitChange() { this._listeners.forEach(cb => { try { cb(this.user); } catch (e) { console.error(e); } }); }
}

window.Auth = Auth;

/* Ejemplo de uso
const auth = new Auth();
auth.onAuthChange(user => console.log('auth change', user));
*/
