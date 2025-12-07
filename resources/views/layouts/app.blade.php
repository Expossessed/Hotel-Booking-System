<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Hotel Bookie | Secure Login & Register</title>

@vite(['resources/css/app.css', 'resources/js/app.js'])

<style>
:root{
  --dark-brown:#3C2A21;
  --accent:#C45B3A;
  --accent-dark:#A94E31;
  --muted:#9CA3AF;
  --glass:rgba(255,255,255,0.08);
  --radius:18px;
  --ease:cubic-bezier(.2,.8,.2,1);
}

*{box-sizing:border-box}
html,body{height:100%}
body{
  margin:0;
  font-family:Inter,system-ui,-apple-system,"Segoe UI",Roboto,Helvetica,Arial;
  color:#fff;
  min-height:100vh;
  display:flex;
  align-items:center;
  justify-content:center;
  background:linear-gradient(180deg, rgba(0,0,0,0.72), var(--dark-brown) 80%),
             url('https://tse1.mm.bing.net/th/id/OIP.FtudhIBH-HYhxMpS4TU-sAHaE8?cb=ucfimg2&ucfimg=1&rs=1&pid=ImgDetMain&o=7&rm=3') center/cover no-repeat fixed;
  -webkit-font-smoothing:antialiased;
}

/* Card */
.auth-card{
  height:600px;
  width:min(980px,96vw);
  border-radius:var(--radius);
  overflow:hidden;
  display:grid;
  grid-template-columns:1fr 1fr;
  background:linear-gradient(180deg, rgba(0,0,0,0.45), rgba(0,0,0,0.25));
  box-shadow:0 10px 40px rgba(2,6,23,0.7);
  backdrop-filter:blur(6px) saturate(120%);
}

/* Left panel */
.left-panel{
  padding:2.25rem;
  display:flex;
  flex-direction:column;
  justify-content:center;
  gap:12px;
  text-align:center;
  background-image:linear-gradient(rgba(0,0,0,0.45), rgba(0,0,0,0.25)), url('/images/left-271639.jpg');
  background-size:cover;
  background-position:center;
}
.left-panel h2{font-size:2.4rem;margin:0;color:var(--accent)}
.left-panel p{margin:0;color:var(--muted)}

/* Right panel */
.right-panel{
  padding:2.25rem;
  display:flex;
  flex-direction:column;
  justify-content:center;
  gap:14px;
}
.brand{font-weight:800;color:var(--accent);letter-spacing:0.08em}
.subtitle{color:var(--muted);font-size:.95rem}

/* Tabs */
.tabs{display:flex;gap:8px;justify-content:center;padding:6px}
.tab{
  padding:8px 18px;
  min-width:150px;
  text-align:center;
  border-radius:10px;
  border:1px solid transparent;
  cursor:pointer;
  font-weight:600;
  color:var(--accent);
  background:transparent;
  transition:all 180ms var(--ease);
}
.tab[aria-selected="true"]{
  background:var(--accent);
  color:#fff;
  box-shadow:0 6px 18px rgba(196,91,58,0.18);
}

/* Form styles */
.field{display:flex;flex-direction:column;gap:6px;margin-bottom:6px}
label{font-size:.85rem;color:var(--muted)}
input, textarea{
  width:100%;
  padding:14px 16px;
  border-radius:12px;
  border:1px solid rgba(255,255,255,0.25);
  background: rgba(255,255,255,0.12);
  color:#fff;
  font-size:1rem;
  line-height:1.4rem;
  outline:none;
  resize:none;
  backdrop-filter: blur(12px);
  transition: all .18s var(--ease);
}
input::placeholder, textarea::placeholder{color:rgba(255,255,255,0.55)}
input:hover, textarea:hover{border-color:rgba(255,255,255,0.40)}
input:focus, textarea:focus{
  background: rgba(255,255,255,0.20);
  border-color:var(--accent);
  box-shadow:0 0 0 2px rgba(196,91,58,0.35);
}

.btn{padding:14px 16px;border-radius:12px;border:none;cursor:pointer;font-weight:700;width:100%;transition:.2s}
.btn-accent{background:var(--accent);color:#fff}
.btn-accent:hover{background:var(--accent-dark)}
.btn-secondary{background:var(--accent);color:#fff}
.muted-right{text-align:right;font-size:.9rem;color:var(--muted)}

/* Panes & consistent layout */
.panes{position:relative;min-height:360px}
.pane{
  position:absolute;
  inset:0;
  opacity:0;
  pointer-events:none;
  transform:translateY(8px);
  transition:opacity 360ms var(--ease), transform 360ms var(--ease);
  display:flex;
  flex-direction:column;
  justify-content:space-between;
}
.pane[aria-hidden="false"]{opacity:1;pointer-events:auto;transform:none}
.pane form{display:flex;flex-direction:column;justify-content:space-between}

/* Responsive */
@media (max-width:880px){
  .auth-card{grid-template-columns:1fr;}
  .left-panel{display:none}
}
@media (max-width:420px){
  .right-panel{padding:1.25rem}
  .left-panel h2{font-size:1.6rem}
}


</style>
</head>
<body>

<div id="offline-banner">Offline — some features may be unavailable</div>

@auth
<script>window.location.href = "{{ route('rooms.list') }}";</script>
@endauth

@guest
<main class="auth-card" role="main" aria-live="polite">

  <section class="left-panel" aria-hidden="true">
    <h2>Welcome Back.</h2>
    <p>Your next luxury stay awaits. Fast check-in and room management at your fingertips.</p>
  </section>

  <section class="right-panel">
    <div style="text-align:center">
      <h1 class="brand">HOTEL BOOKIE</h1>
      <p class="subtitle">Luxury • Comfort • Convenience</p>
    </div>

    <div class="tabs" role="tablist" aria-label="Authentication Tabs">
      <button id="tab-login" class="tab" role="tab" aria-selected="true" aria-controls="pane-login">Login</button>
      <button id="tab-register" class="tab" role="tab" aria-selected="false" aria-controls="pane-register">Register</button>
    </div>

    <div class="panes" id="panes">

      <!-- LOGIN -->
      <div id="pane-login" class="pane" role="tabpanel" aria-hidden="false" aria-labelledby="tab-login">
        <form id="loginForm" action="{{ route('login') }}" method="POST" novalidate>
          @csrf
          <div class="field">
            <label for="login_email">Email address</label>
            <input id="login_email" name="email" type="email" required autocomplete="email" placeholder="Enter your email">
          </div>

          <div class="field">
            <label for="login_password">Password</label>
            <input id="login_password" name="password" type="password" required autocomplete="current-password" placeholder="Enter your password">
          </div>

          <div class="muted-right"><a href="{{ route('password.request') }}" style="color:var(--muted);text-decoration:underline">Forgot password?</a></div>

          <button type="submit" class="btn btn-accent">Login</button>
        </form>
      </div>

      <!-- REGISTER -->
      <div id="pane-register" class="pane" role="tabpanel" aria-hidden="true" aria-labelledby="tab-register">
        <form id="registerForm" action="{{ route('register') }}" method="POST" novalidate>
          @csrf
          <div class="field">
            <label for="reg_name">Full name</label>
            <input id="reg_name" name="name" type="text" required autocomplete="name" placeholder="Enter your full name">
          </div>

          <div class="field">
            <label for="reg_email">Email address</label>
            <input id="reg_email" name="email" type="email" required autocomplete="email" placeholder="Enter your email">
          </div>

          <div class="field">
            <label for="reg_password">Password</label>
            <input id="reg_password" name="password" type="password" required autocomplete="new-password" placeholder="Enter your password">
          </div>

          <div class="field">
            <label for="reg_password_confirmation">Confirm password</label>
            <input id="reg_password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password" placeholder="Confirm your password">
          </div>

          <button type="submit" class="btn btn-accent">Create Account</button>
        </form>
      </div>

    </div>
  </section>
</main>
@endguest

<script>
(function(){
  const tabLogin = document.getElementById('tab-login');
  const tabRegister = document.getElementById('tab-register');
  const paneLogin = document.getElementById('pane-login');
  const paneRegister = document.getElementById('pane-register');

  function selectTab(selected){
    if(selected==='login'){
      tabLogin.setAttribute('aria-selected','true');
      tabRegister.setAttribute('aria-selected','false');
      paneLogin.setAttribute('aria-hidden','false');
      paneRegister.setAttribute('aria-hidden','true');
      setTimeout(()=>{ const f=paneLogin.querySelector('input'); if(f) f.focus();},80);
    }else{
      tabLogin.setAttribute('aria-selected','false');
      tabRegister.setAttribute('aria-selected','true');
      paneLogin.setAttribute('aria-hidden','true');
      paneRegister.setAttribute('aria-hidden','false');
      setTimeout(()=>{ const f=paneRegister.querySelector('input'); if(f) f.focus();},80);
    }
  }

  tabLogin.addEventListener('click', e=>{e.preventDefault(); selectTab('login');});
  tabRegister.addEventListener('click', e=>{e.preventDefault(); selectTab('register');});

  // Keyboard navigation
  document.addEventListener('keydown', e=>{
    if(e.key==='ArrowLeft') selectTab('login');
    if(e.key==='ArrowRight') selectTab('register');
  });

  // Offline banner
  const offlineBanner=document.getElementById('offline-banner');
  function updateOnline(){ if(navigator.onLine) offlineBanner.style.display='none'; else offlineBanner.style.display='block'; }
  window.addEventListener('online', updateOnline);
  window.addEventListener('offline', updateOnline);
  updateOnline();
})();
</script>

</body>
</html>
