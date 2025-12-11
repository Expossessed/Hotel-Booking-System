<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
      <link rel="icon" type="image/x-icon" href="https://scontent.fceb6-1.fna.fbcdn.net/v/t1.15752-9/429922800_726758146106956_6258299385019235663_n.png?_nc_cat=105&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeGLLP_iy6tVlltPnmHV6JmIXc3yic1PhchdzfKJzU-FyJvdZQoDDzahDVeGmyTPU0kAEYcq6lAN0P4hcqV_-3o6&_nc_ohc=_cnpXDv9QbkQ7kNvwGK4Yem&_nc_oc=AdkBE7ZXUgfi__RfcbEkmw81RMgQzyRtJGr0wLEt_PlghJw_MQ_7NES5kWrRv2CLSnI&_nc_zt=23&_nc_ht=scontent.fceb6-1.fna&oh=03_Q7cD4AEA6Qkyj9JAWVUOiRYz5QGOqm5dYus_Wav8lIBj0nXc6w&oe=69612B37">
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

.auth-card{
  width:min(980px,96vw);
  border-radius:var(--radius);
  overflow:hidden;
  display:grid;
  grid-template-columns:1fr 1fr;
  background:linear-gradient(180deg, rgba(0,0,0,0.45), rgba(0,0,0,0.25));
  box-shadow:0 10px 40px rgba(2,6,23,0.7);
  backdrop-filter:blur(6px) saturate(120%);
  min-height:600px;
}

/* Left panel */
.left-panel{
  padding:2rem;
  display:flex;
  flex-direction:column;
  justify-content:center;
  text-align:center;
  background-image:linear-gradient(rgba(0,0,0,0.45), rgba(0,0,0,0.25)), url('/images/left-271639.jpg');
  background-size:cover;
  background-position:center;
}
.left-panel h2{font-size:2.4rem;margin:0;color:var(--accent)}
.left-panel p{margin:0;color:var(--muted)}

/* Right panel */
.right-panel{
  padding:2rem;
  display:flex;
  flex-direction:column;
  justify-content:center;
  gap:16px;
}
.brand{font-weight:800;color:var(--accent);letter-spacing:0.08em;text-align:center;}
.subtitle{color:var(--muted);font-size:.95rem;text-align:center;}

/* Tabs */
.tabs{display:flex;gap:8px;justify-content:center;padding:6px}
.tab{
  padding:10px 20px;
  min-width:150px;
  text-align:center;
  border-radius:12px;
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

/* Form fields */
.field{display:flex;flex-direction:column;gap:6px;margin-bottom:12px}
label{font-size:.85rem;color:var(--muted)}
input, textarea{
  width:100%;
  padding:14px 16px;
  border-radius:12px;
  border:1px solid rgba(196,91,58,0.18);
  background: rgba(196,91,58,0.18);
  color:rgba(196,91,58,1);
  font-size:1rem;
  outline:none;
  transition: all .18s var(--ease);
}
/* input:focus, textarea:focus{border-color:var(--accent); background: rgba(196,91,58,0.18);} */
input::placeholder, textarea::placeholder{color: rgba(196,91,58,0.8);}

.btn{padding:14px 16px;border-radius:12px;border:none;cursor:pointer;font-weight:700;width:100%;transition:.2s}
.btn-accent{background:var(--accent);color:#fff}
.btn-accent:hover{background:var(--accent-dark)}
.field-error{border-color:#dc2626 !important}

/* Panes */
.panes{position:relative;min-height:360px}
.pane{
  position:absolute;
  inset:0;
  opacity:0;
  pointer-events:none;
  transform:translateY(8px);
  transition:opacity 360ms var(--ease), transform 360ms var(--ease);
}
.pane[aria-hidden="false"]{opacity:1;pointer-events:auto;transform:none}

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

@auth
<script>window.location.href = "{{ route('rooms.list') }}";</script>
@endauth

@guest
<main class="auth-card">

  <section class="left-panel" aria-hidden="true">
    <h2>Welcome Back.</h2>
    <p>Your next luxury stay awaits. Fast check-in and room management at your fingertips.</p>
  </section>


  <section class="right-panel">
    <div>
      <h1 class="brand">HOTEL BOOKIE</h1>
      <p class="subtitle">Luxury • Comfort • Convenience</p>
    </div>


    <div class="tabs" role="tablist">
      <button id="tab-login" class="tab" role="tab" aria-selected="true" aria-controls="pane-login">Login</button>
      <button id="tab-register" class="tab" role="tab" aria-selected="false" aria-controls="pane-register">Register</button>
    </div>

    <div class="panes">

      <div id="pane-login" class="pane" role="tabpanel" aria-hidden="false">
        @if ($errors->any() && old('form_type')==='login')
          <div style="background:#7f1d1d;padding:.875rem;margin-bottom:1rem;border-left:4px solid #dc2626;border-radius:.375rem;">
            <ul style="color:#fee2e2;margin:0;padding-left:1rem;">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        <form action="{{ route('login') }}" method="POST">
          @csrf
          <input type="hidden" name="form_type" value="login">
          <div class="field">
            <label for="login_email">Email</label>
            <input id="login_email" type="email" name="email" required placeholder="Enter your email" value="{{ old('email') }}" class="@error('email') field-error @enderror">
          </div>
          <div class="field">
            <label for="login_password">Password</label>
            <input id="login_password" type="password" name="password" required placeholder="Enter your password" class="@error('password') field-error @enderror">
          </div>
          <div style="text-align:right;font-size:.85rem;margin-bottom:12px;">
            <a href="{{ route('password.request') }}" style="color:var(--muted);text-decoration:underline;">Forgot password?</a>
          </div>
          <button type="submit" class="btn btn-accent">Login</button>
        </form>
      </div>

      <div id="pane-register" class="pane" role="tabpanel" aria-hidden="true">
        @if ($errors->any() && old('form_type')==='register')
          <div style="background:#7f1d1d;padding:.875rem;margin-bottom:1rem;border-left:4px solid #dc2626;border-radius:.375rem;">
            <ul style="color:#fee2e2;margin:0;padding-left:1rem;">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        <form action="{{ route('register') }}" method="POST">
          @csrf
          <input type="hidden" name="form_type" value="register">
          <div class="field">
            <label for="reg_name">Full Name</label>
            <input id="reg_name" type="text" name="name" required placeholder="Enter your full name" value="{{ old('name') }}" class="@error('name') field-error @enderror">
          </div>
          <div class="field">
            <label for="reg_email">Email</label>
            <input id="reg_email" type="email" name="email" required placeholder="Enter your email" value="{{ old('email') }}" class="@error('email') field-error @enderror">
          </div>
          <div class="field">
            <label for="reg_password">Password</label>
            <input id="reg_password" type="password" name="password" required placeholder="Enter your password" class="@error('password') field-error @enderror">
          </div>
          <div class="field">
            <label for="reg_password_confirmation">Confirm Password</label>
            <input id="reg_password_confirmation" type="password" name="password_confirmation" required placeholder="Confirm password" class="@error('password_confirmation') field-error @enderror">
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

  function selectTab(tab){
    if(tab==='login'){
      tabLogin.setAttribute('aria-selected','true');
      tabRegister.setAttribute('aria-selected','false');
      paneLogin.setAttribute('aria-hidden','false');
      paneRegister.setAttribute('aria-hidden','true');
    }else{
      tabLogin.setAttribute('aria-selected','false');
      tabRegister.setAttribute('aria-selected','true');
      paneLogin.setAttribute('aria-hidden','true');
      paneRegister.setAttribute('aria-hidden','false');
    }
  }

  tabLogin.addEventListener('click',()=>selectTab('login'));
  tabRegister.addEventListener('click',()=>selectTab('register'));

  const initialTab="{{ old('form_type') }}";
  if(initialTab==='register') selectTab('register');
})();
</script>

</body>
</html>
