<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Bookie | Secure Login & Register</title>


    {{-- Use locally-built assets via Vite for offline resilience --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- If you want fonts available offline, consider downloading them and referencing locally. --}}

    <style>
        :root {
            --color-dark-brown: #3C2A21;
            --color-accent-orange: #C45B3A;
            --color-text-light: #F7F7F7; 
            --color-bg-contrast: #312620; 
        }
        
        :root {
            --tab-fade-duration: 700ms; 
            --tab-easing: cubic-bezier(.2,.8,.2,1);
            --tab-slide-duration: 700ms; 
        }

        body {
            /* Prefer local images under /public/images for offline use; remote URL as fallback */
            background: linear-gradient(to bottom, rgba(0,0,0,0.8), var(--color-dark-brown) 90%),
                        url('/images/hero-164595.jpg'),
                        url('https://images.pexels.com/photos/164595/pexels-photo-164595.jpeg')
                        center/cover no-repeat fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', sans-serif;
            color: white;
        }


        .auth-card {
            max-width: 900px;
            min-height: 580px;

            border-radius: 20px;
            overflow: hidden;
            display: flex;
            box-shadow: 0px 8px 30px rgba(0,0,0,0.8);
            background: var(--color-bg-contrast);
            transition: all 0.3s ease;
        }


        .left-panel {
            /* Use a local image when available (public/images/left-271639.jpg)
               with the remote URL as a fallback for development.
            */
            background: linear-gradient(to top, rgba(0,0,0,0.8), rgba(0,0,0,0.4)),
                        url('/images/left-271639.jpg'),
                        url('https://images.pexels.com/photos/271639/pexels-photo-271639.jpeg')
                        center/cover no-repeat;
            flex: 1;

            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            text-align: center;
        }

        .right-panel {
            flex: 1;
            padding: 2.5rem; 
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

       
        .hotel-title {
            font-weight: 800;
            color: var(--color-accent-orange);
            letter-spacing: 0.1em;
            text-shadow: 0 0 5px rgba(196, 91, 58, 0.4);
        }

        .tab-active {
            color: white !important;
            background-color: var(--color-accent-orange) !important;
        }

        .tabs a {
            color: var(--color-accent-orange);
            border-radius: 0.5rem;
            transition: background-color 0.3s;
        }

        .input, .input:focus, .input-bordered {
            background-color: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.2);
            color: white;
            border-radius: 0.5rem;
        }
        
        .input:focus {
            border-color: var(--color-accent-orange) !important;
            box-shadow: 0 0 0 2px var(--color-accent-orange);
        }

        .btn-accent-color {
            background-color: var(--color-accent-orange);
            border-color: var(--color-accent-orange);
            color: var(--color-text-light);
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            border-radius: 0.5rem;
        }
        .btn-accent-color:hover {
            background-color: #A94E31; 
            border-color: #A94E31;
        }
        
        .btn-secondary-color {
            background-color: #2e7d32;
            border-color: #2e7d32;
            color: var(--color-text-light);
            transition: background-color 0.3s ease;
            border-radius: 0.5rem;
        }
        .btn-secondary-color:hover {
            background-color: #1b5e20;
            border-color: #1b5e20;
        }

        
        #tabContent {
            flex: 1 1 auto;
            overflow: hidden;
            position: relative;
        }

        #panesInner {
            display: block;
            transition: transform var(--tab-slide-duration) var(--tab-easing);
            will-change: transform;
        }

        .tab-pane {
            opacity: 0;
            transition: opacity var(--tab-fade-duration) var(--tab-easing);
            pointer-events: none;
            padding-bottom: 1rem;
        }

        .tab-pane.active {
            opacity: 1;
            pointer-events: auto;
        }

        .tab-pane .input,
        .tab-pane .label-text,
        .tab-pane .btn {
            opacity: 0;
            transition: opacity var(--tab-fade-duration) var(--tab-easing);
        }
        .tab-pane.active .input,
        .tab-pane.active .label-text,
        .tab-pane.active .btn {
            opacity: 1;
        }


        @media (max-width: 768px) {
            .auth-card {
                margin: 1rem;
                min-height: auto;
            }
            .right-panel {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>

<!-- Offline indicator: toggles when navigator goes offline/online -->
<div id="offline-banner" style="display:none;position:fixed;top:0;left:0;right:0;background:#b91c1c;color:white;padding:6px 12px;text-align:center;z-index:9999;">Offline — some features may be unavailable</div>

@auth
<script> 
    window.location.href = "{{ route('rooms.list') }}"; 
</script>
@endauth

@guest
<div class="auth-card mx-4 sm:mx-auto">
    
    <div class="left-panel hidden md:block">
        <h2 class="text-5xl font-extrabold mb-4" style="color: var(--color-text-light);">
            Welcome Back.
        </h2>
        <p class="text-gray-300 text-lg mb-8">
            Your next luxury stay awaits. Fast check-in and room management at your fingertips.
        </p>
    </div>

    <div class="right-panel">
        <h3 class="text-3xl text-center hotel-title mb-1">HOTEL BOOKIE</h3>
        <p class="text-center text-gray-400 mb-6 text-sm">Luxury • Comfort • Convenience</p>
        
        <div role="tablist" class="tabs tabs-boxed mb-6 bg-black/30 w-full">
            <a role="tab" class="tab font-semibold tab-active" id="login-tab">Login</a>
            <a role="tab" class="tab font-semibold" id="register-tab">Register</a>
        </div>

        <div id="tabContent">
            <div id="panesInner">

            <div id="login" class="tab-pane active">
                <form id="loginForm" action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="label"><span class="label-text text-gray-300">Email Address</span></label>
                        <input type="email" class="input input-bordered w-full" name="email" id="login_email" required autofocus>
                    </div>
                    <div class="mb-2">
                        <label class="label"><span class="label-text text-gray-300">Password</span></label>
                        <input type="password" class="input input-bordered w-full" name="password" required>
                    </div>
                    
                    <div class="text-right mb-6"> 
                        <a href="{{ route('password.request') }}" class="text-sm text-gray-400 hover:text-white transition-colors">
                            Forgot Password?
                        </a>
                    </div>
                    
                    <button type="submit" class="btn btn-accent-color w-full">Login</button>
                </form>
            </div>

            <div id="register" class="tab-pane">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="label"><span class="label-text text-gray-300">Full Name</span></label>
                        <input type="text" class="input input-bordered w-full" name="name" required>
                    </div>
                    <div class="mb-4">
                        <label class="label"><span class="label-text text-gray-300">Email Address</span></label>
                        <input type="email" class="input input-bordered w-full" name="email" required>
                    </div>
                    <div class="mb-4">
                        <label class="label"><span class="label-text text-gray-300">Password</span></label>
                        <input type="password" class="input input-bordered w-full" name="password" required>
                    </div>
                    <div class="mb-6">
                        <label class="label"><span class="label-text text-gray-300">Confirm Password</span></label>
                        <input type="password" class="input input-bordered w-full" name="password_confirmation" required>
                    </div>
                    
                    <button type="submit" class="btn btn-secondary-color w-full">Create Account</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endguest

<script>
document.addEventListener('DOMContentLoaded', function(){
    const loginTab = document.getElementById('login-tab');
    const registerTab = document.getElementById('register-tab');
    const loginPane = document.getElementById('login');
    const registerPane = document.getElementById('register');
    const tabContentEl = document.getElementById('tabContent');
    const panesInner = document.getElementById('panesInner');

    function showPane(pane){
        const panes = Array.from(document.querySelectorAll('#tabContent .tab-pane'));
        panes.forEach(p => {
            if(p === pane){
                p.classList.add('active');
            } else {
                p.classList.remove('active');
            }
        });

        if(panesInner && tabContentEl && pane){
            const targetY = pane.offsetTop || 0;
            setTimeout(() => {
                panesInner.style.transform = `translateY(-${targetY}px)`;
            }, 20);
        }
    }

    function setActive(tab){
        [loginTab, registerTab].forEach(t => t.classList.remove('tab-active'));
        if(tab) tab.classList.add('tab-active');
    }

    if(loginTab && registerTab){
        loginTab.addEventListener('click', function(e){
            e.preventDefault();
            document.documentElement.style.setProperty('--tab-fade-duration', '480ms');
            document.documentElement.style.setProperty('--tab-easing', 'cubic-bezier(.2,.8,.2,1)');
            document.documentElement.style.setProperty('--tab-slide-duration', '480ms');
            setActive(loginTab);
            showPane(loginPane);
        });

        registerTab.addEventListener('click', function(e){
            e.preventDefault();
            document.documentElement.style.setProperty('--tab-fade-duration', '1000ms');
            document.documentElement.style.setProperty('--tab-easing', 'cubic-bezier(.16,.84,.24,1)');
            document.documentElement.style.setProperty('--tab-slide-duration', '1000ms');
            setActive(registerTab);
            showPane(registerPane);
        });
    }

    setActive(loginTab);
    if(typeof panesInner !== 'undefined' && panesInner) panesInner.style.transform = 'translateY(0)';
    showPane(loginPane);
});
</script>

<script>
// Show offline banner when navigator.offline
function updateOnlineStatus() {
    const el = document.getElementById('offline-banner');
    if (!el) return;
    if (navigator.onLine) {
        el.style.display = 'none';
    } else {
        el.style.display = 'block';
    }
}
window.addEventListener('online', updateOnlineStatus);
window.addEventListener('offline', updateOnlineStatus);
// initialize
updateOnlineStatus();
</script>

</body>
</html>