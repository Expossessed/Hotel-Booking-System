<div class="navbar navbar-top px-4 md:px-12 py-3 sticky top-0 z-50 shadow-lg" style="background-color: #312620; border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
    
    <div class="flex-1">
        <a href="{{ route('home') }}" class="text-xl md:text-2xl font-extrabold tracking-widest text-white">
            HOTEL BOOKIE
        </a>
    </div>

    <div class="flex-none">
        <ul class="menu menu-horizontal p-0 hidden md:flex gap-6 navbar-menu text-lg" style="color: #F7F7F7;">
            <li><a href="{{ route('home') }}" style="color: #F7F7F7;">Home</a></li>
            <li><a href="{{ route('user.rooms') }}" style="color: #F7F7F7;">Rooms</a></li>
            <li><a href="{{ route('about') }}" style="color: #F7F7F7;">About</a></li>
            <li><a href="{{ route('contact') }}" style="color: #F7F7F7;">Contact</a></li>
        </ul>

        @auth
        <div class="flex items-center gap-4 ml-6">
            <div class="text-right hidden md:block">
                <div class="text-xs text-white/60">Balance</div>
                <div class="font-semibold text-white">${{ number_format(auth()->user()->balance ?? 0, 2) }}</div>
            </div>
            <a href="{{ route('cashIn.show') }}" class="btn btn-sm" style="background-color: #C45B3A; border: none; color: white; font-weight: bold; font-size: 18px;">+</a>
            <div class="dropdown dropdown-end ml-4">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar border-2 border-white/50 hover:bg-white/10 transition-colors">
                    <div class="w-10 rounded-full bg-white/10 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 19.5a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </div>
                </div>
                <ul tabindex="0" class="menu menu-sm dropdown-content z-[1] p-2 shadow-xl rounded-box w-52 mt-3" style="background: #312620; border: 1px solid rgba(255, 255, 255, 0.15);">
                    <li><a href="{{ route('bookings.userHistory') }}" class="font-medium" style="color: #F7F7F7;">My Bookings</a></li>
                    <li><a href="{{ route('profile.edit') }}" class="font-medium" style="color: #F7F7F7;">Profile & Settings</a></li>
                    @if(auth()->user()->isAdmin())
                        <li><a href="{{ route('admin.front') }}" style="color: #FFD700; font-weight: bold;">Admin Panel</a></li>
                    @endif
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-red-400 hover:bg-red-600 hover:text-white transition-colors duration-200">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        @else
        <div class="ml-8 hidden md:block">
            <a href="{{ route('login') }}" class="btn btn-accent-color btn-md px-6 font-semibold rounded-none" style="background-color: #C45B3A; border: none; color: white;">Login</a>
        </div>
        @endauth

        <div class="dropdown dropdown-end md:hidden ml-2">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" /></svg>
            </div>
            <ul tabindex="0" class="menu menu-sm dropdown-content z-[1] p-2 shadow-xl rounded-box w-52 mt-3" style="background: #312620; border: 1px solid rgba(255, 255, 255, 0.15);">
                <li><a href="{{ route('home') }}" style="color: #F7F7F7;">Home</a></li>
                <li><a href="{{ route('user.rooms') }}" style="color: #F7F7F7;">Rooms</a></li>
                <li><a href="{{ route('about') }}" style="color: #F7F7F7;">About</a></li>
                <li><a href="{{ route('contact') }}" style="color: #F7F7F7;">Contact</a></li>
                @auth
                    <li><a href="{{ route('bookings.userHistory') }}" class="font-medium" style="color: #F7F7F7;">My Bookings</a></li>
                    <li><a href="{{ route('profile.edit') }}" class="font-medium" style="color: #F7F7F7;">Profile</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-red-400 hover:bg-red-600 hover:text-white transition-colors duration-200">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="mt-2"><a href="{{ route('login') }}" class="btn btn-sm rounded-none" style="background-color: #C45B3A; border: none; color: white;">Login</a></li>
                @endauth
            </ul>
        </div>
    </div>
</div>
