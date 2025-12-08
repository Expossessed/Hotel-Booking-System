<div class="navbar px-4 md:px-12 py-3 sticky top-0 z-50 backdrop-blur-lg bg-[#201A17]/90 border-b border-white/10 shadow-lg">

    <!-- LOGO -->
    <div class="flex-1">
        <a href="{{ route('home') }}" class="text-2xl md:text-3xl font-extrabold tracking-widest text-white drop-shadow-sm">
            HOTEL BOOKIE
        </a>
    </div>

    <!-- DESKTOP MENU -->
    <div class="hidden md:flex items-center gap-10">
        <a href="{{ route('home') }}" class="text-[#F7F7F7] hover:text-white hover:underline underline-offset-4 transition">Home</a>
        <a href="{{ route('user.rooms') }}" class="text-[#F7F7F7] hover:text-white hover:underline underline-offset-4 transition">Rooms</a>
        <a href="{{ route('about') }}" class="text-[#F7F7F7] hover:text-white hover:underline underline-offset-4 transition">About</a>
        <a href="{{ route('contact') }}" class="text-[#F7F7F7] hover:text-white hover:underline underline-offset-4 transition">Contact</a>

        @auth
        <!-- BALANCE -->
        <div class="text-right">
            <div class="text-xs text-white/50">Balance</div>
            <div class="font-semibold text-white">${{ number_format(auth()->user()->balance ?? 0, 2) }}</div>
        </div>

        <!-- CASH IN -->
        <a href="{{ route('cashIn.show') }}" 
           class="btn btn-sm bg-[#C45B3A] hover:bg-[#db6d4a] text-white font-bold border-none ml-3">
           +
        </a>

        <!-- PROFILE DROPDOWN -->
        <div class="dropdown dropdown-end ml-4">
            <label tabindex="0" class="btn btn-ghost btn-circle avatar hover:bg-white/10 border border-white/20 transition">
                <div class="w-10 rounded-full bg-white/10 flex items-center justify-center">
                    <img src="https://th.bing.com/th/id/OIP.hGSCbXlcOjL_9mmzerqAbQHaHa?o=7rm=3&rs=1&pid=ImgDetMain&o=7&rm=3" alt="">
                </div>
            </label>

            <ul tabindex="0" class="menu dropdown-content mt-3 w-56 p-3 rounded-xl bg-[#2B2320]/95 backdrop-blur-xl border border-white/10 shadow-2xl">
                <li><a href="{{ route('bookings.userHistory') }}" class="text-[#F7F7F7]">My Bookings</a></li>
                <li><a href="{{ route('profile.settings') }}" class="text-[#F7F7F7]">Profile & Settings</a></li>

                @if(auth()->user()->isAdmin())
                <li><a href="{{ route('admin.front') }}" class="text-yellow-400 font-semibold">Admin Panel</a></li>
                @endif

                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-red-400 hover:bg-red-600 hover:text-white rounded-lg transition">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
        @else
        <a href="{{ route('login') }}" 
           class="btn bg-[#C45B3A] hover:bg-[#db6d4a] text-white px-6 font-semibold border-none rounded-none">
           Login
        </a>
        @endauth
    </div>

    <!-- MOBILE MENU -->
    <div class="md:hidden">
        <div class="dropdown dropdown-end">
            <label tabindex="0" class="btn btn-ghost text-white btn-circle">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                           d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </label>

            <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 w-56 p-3 rounded-xl bg-[#2B2320]/95 backdrop-blur-xl border border-white/10 shadow-2xl">
                <li><a href="{{ route('home') }}" class="text-[#F7F7F7]">Home</a></li>
                <li><a href="{{ route('user.rooms') }}" class="text-[#F7F7F7]">Rooms</a></li>
                <li><a href="{{ route('about') }}" class="text-[#F7F7F7]">About</a></li>
                <li><a href="{{ route('contact') }}" class="text-[#F7F7F7]">Contact</a></li>

                @auth
                    <li><a href="{{ route('bookings.userHistory') }}" class="text-[#F7F7F7]">My Bookings</a></li>
                    <li><a href="{{ route('profile.settings') }}" class="text-[#F7F7F7]">Profile</a></li>

                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="text-red-400 hover:bg-red-600 hover:text-white rounded-lg transition">
                                Logout
                            </button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}" class="btn btn-sm bg-[#C45B3A] hover:bg-[#db6d4a] text-white border-none">
                        Login
                    </a></li>
                @endauth
            </ul>
        </div>
    </div>

</div>
