<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
        <link rel="icon" type="image/x-icon" href="https://scontent.fceb6-1.fna.fbcdn.net/v/t1.15752-9/429922800_726758146106956_6258299385019235663_n.png?_nc_cat=105&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeGLLP_iy6tVlltPnmHV6JmIXc3yic1PhchdzfKJzU-FyJvdZQoDDzahDVeGmyTPU0kAEYcq6lAN0P4hcqV_-3o6&_nc_ohc=_cnpXDv9QbkQ7kNvwGK4Yem&_nc_oc=AdkBE7ZXUgfi__RfcbEkmw81RMgQzyRtJGr0wLEt_PlghJw_MQ_7NES5kWrRv2CLSnI&_nc_zt=23&_nc_ht=scontent.fceb6-1.fna&oh=03_Q7cD4AEA6Qkyj9JAWVUOiRYz5QGOqm5dYus_Wav8lIBj0nXc6w&oe=69612B37">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Bookie | Profile Settings</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />

    <style>

        :root {
            --color-dark-brown: #3C2A21;
            --color-accent-orange: #C45B3A;
            --color-text-light: #F7F7F7;
        }

        body {
            background-image: none;
            background-color: var(--color-dark-brown);
            min-height: 100vh;
        }
        
        body, .text-gray-100 {
            color: var(--color-text-light);
        }

        .btn-accent-color {
            background-color: var(--color-accent-orange);
            border-color: var(--color-accent-orange);
            color: var(--color-text-light);
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }
        .btn-accent-color:hover {
            background-color: #A94E31; 
            border-color: #A94E31;
        }

        .input-dark-style {
            background-color: rgba(0, 0, 0, 0.3);
            color: var(--color-text-light);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .input-dark-style:focus:not(:disabled) {
             border-color: var(--color-accent-orange);
             outline: none;
             box-shadow: 0 0 0 2px rgba(196, 91, 58, 0.5);
        }
        .input-dark-style::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }
        
        .input-dark-style:disabled {
            background-color: rgba(0, 0, 0, 0.1);
            border-color: rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.5);
        }
    </style>
</head>
<body class="relative">

@include('layouts.hotelNav')


<main class="px-4 md:px-6 py-16">

    <div class="max-w-6xl mx-auto">

        <header class="mb-10 text-center md:text-left">
            <h1 class="text-5xl font-serif font-bold text-white mb-2">
                User Profile Settings
            </h1>
            <p class="text-lg text-white/70">
                Update your personal details and account credentials.
            </p>
            <div class="divider before:bg-white/10 after:bg-white/10 mt-4"></div>
        </header>

        <div class="bg-black/40 p-8 md:p-12 rounded-lg shadow-2xl">
                <form id="profileForm" action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PATCH')

                    {{-- success notification handled globally in the navbar (SweetAlert) --}}

                    @if($errors->any())
                        <div class="alert alert-error bg-red-600 text-white mb-4 px-4 py-3 rounded">
                            <ul class="list-disc pl-5">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="space-y-6">
                        <div>
                            <label class="label"><span class="label-text text-white/80 font-medium">Full Name</span></label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="input input-dark-style w-full rounded-none" required>
                        </div>

                        <div>
                            <label class="label"><span class="label-text text-white/80 font-medium">Email Address</span></label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="input input-dark-style w-full rounded-none" readonly>
                        </div>

                        <hr class="border-white/20 my-6">

                        <p class="text-sm text-white/70">
                            Change password (leave blank if not changing)
                        </p>

                        <div>
                            <label class="label"><span class="label-text text-white/80">Current Password</span></label>
                            <input type="password" name="current_password" class="input input-dark-style w-full rounded-none">
                        </div>

                        <div>
                            <label class="label"><span class="label-text text-white/80">New Password</span></label>
                            <input type="password" name="new_password" class="input input-dark-style w-full rounded-none">
                        </div>

                        <div>
                            <label class="label"><span class="label-text text-white/80">Confirm New Password</span></label>
                            <input type="password" name="new_password_confirmation" class="input input-dark-style w-full rounded-none">
                        </div>

                        <button id="saveBtn" type="submit" disabled class="btn btn-accent-color btn-lg px-10 rounded-none font-semibold mt-6 opacity-50 cursor-not-allowed">
                            Save Changes
                        </button>
                    </div>
            </form>
        </div>

    </div>

</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('profileForm');
    if (!form) return;
        const saveBtn = document.getElementById('saveBtn');

        // Collect initial values to compare against
        const initial = {};
        Array.from(form.elements).forEach(el => {
            if (!el.name) return;
            // ignore CSRF and method fields
            if (el.type === 'hidden' && (el.name === '_token' || el.name === '_method')) return;
            // track text, email, password, checkbox, radio, textarea, select
            if (['text','email','password','textarea','select-one','select-multiple'].includes(el.type) || el.tagName.toLowerCase() === 'textarea') {
                initial[el.name] = el.value || '';
            }
        });

        function setEnabledState() {
            let dirty = false;

            Array.from(form.elements).forEach(el => {
                if (!el.name) return;
                if (el.type === 'hidden' && (el.name === '_token' || el.name === '_method')) return;
                const before = initial[el.name] ?? '';
                const now = el.value || '';
                if (before !== now) dirty = true;
            });

            if (dirty) {
                saveBtn.disabled = false;
                saveBtn.classList.remove('opacity-50','cursor-not-allowed');
            } else {
                saveBtn.disabled = true;
                saveBtn.classList.add('opacity-50','cursor-not-allowed');
            }
        }

        // Monitor changes
        form.addEventListener('input', setEnabledState);
        form.addEventListener('change', setEnabledState);

        // Initial check (in case some fields are pre-filled differently)
        setEnabledState();
    });
</script>

</body>
</html>