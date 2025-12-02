<header class="fixed top-0 left-0 right-0 z-50 bg-background/80 backdrop-blur-lg border-b border-border/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 gap-4">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                @if(get_setting('site_logo'))
                    <img src="{{ asset(get_setting('site_logo')) }}" alt="{{ get_setting('site_title', 'ChatterGlow') }}" class="w-10 h-10 rounded-full object-cover">
                @else
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[hsl(var(--primary))] to-purple-600 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"/>
                            <path d="M19 10v2a7 7 0 0 1-14 0v-2"/>
                            <line x1="12" x2="12" y1="19" y2="22"/>
                        </svg>
                    </div>
                @endif
                <span class="text-xl font-bold bg-gradient-to-r from-[hsl(var(--primary))] to-purple-600 bg-clip-text text-transparent">
                    {{ get_setting('site_title', 'ChatterGlow') }}
                </span>
            </a>

            <nav class="hidden md:flex items-center gap-1">
                <a href="{{ route('home') }}" class="px-4 py-2 rounded-lg font-medium transition-colors {{ request()->routeIs('home') ? 'bg-secondary text-secondary-foreground' : 'hover:bg-accent hover:text-accent-foreground' }}">
                    Home
                </a>
                <a href="{{ route('rooms.index') }}" class="px-4 py-2 rounded-lg font-medium transition-colors {{ request()->routeIs('rooms.*') ? 'bg-secondary text-secondary-foreground' : 'hover:bg-accent hover:text-accent-foreground' }}">
                    Voice Rooms
                </a>
                <a href="{{ route('coins.index') }}" class="px-4 py-2 rounded-lg font-medium transition-colors {{ request()->routeIs('coins.*') ? 'bg-secondary text-secondary-foreground' : 'hover:bg-accent hover:text-accent-foreground' }}">
                    Recharger
                </a>
                <a href="{{ route('contact') }}" class="px-4 py-2 rounded-lg font-medium transition-colors {{ request()->routeIs('contact') ? 'bg-secondary text-secondary-foreground' : 'hover:bg-accent hover:text-accent-foreground' }}">
                    Contact
                </a>
            </nav>

            <div class="flex items-center gap-2">
                <button id="theme-toggle" class="p-2 rounded-lg hover:bg-accent hover:text-accent-foreground transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="4"/>
                        <path d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41m11.32 11.32l1.41 1.41M2 12h2m16 0h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/>
                    </svg>
                </button>
                <!-- User Menu -->
            <div class="flex items-center gap-4">
                @guest
                <button onclick="document.getElementById('auth-modal').classList.remove('hidden')" class="bg-gradient-to-r from-pink-500 to-purple-600 text-white px-6 py-2.5 rounded-full text-sm font-bold hover:shadow-lg hover:shadow-purple-500/25 transition-all transform hover:scale-105">
                    Login
                </button>

                @endguest

                @auth
                <div class="flex items-center gap-4">
                    <a href="{{ route('coins.index') }}" class="hidden md:flex items-center gap-2 bg-muted/50 px-3 py-1.5 rounded-full hover:bg-muted transition-colors border border-border">
                        <div class="w-6 h-6 rounded-full bg-gradient-to-br from-yellow-400 to-orange-600 flex items-center justify-center text-[10px] text-white font-bold shadow-sm">🪙</div>
                        <span class="font-bold text-sm text-foreground">{{ auth()->check() ? auth()->user()->coins : session('coins', 0) }}</span>
                    </a>
                    
                    <div class="relative group">
                        <button class="w-10 h-10 rounded-full bg-muted flex items-center justify-center text-xl hover:ring-2 hover:ring-primary transition-all overflow-hidden">
                            @if(auth()->user()->avatar)
                                <img src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">
                            @else
                                {{ auth()->user()->emoji ?? '😀' }}
                            @endif
                        </button>
                        
                        <!-- Dropdown -->
                        <div class="absolute right-0 top-full mt-2 w-48 bg-card border border-border rounded-xl shadow-xl overflow-hidden hidden group-hover:block z-50">
                            <div class="p-3 border-b border-border">
                                <p class="font-bold truncate">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-muted-foreground truncate">{{ auth()->user()->email }}</p>
                            </div>
                            <button onclick="openProfileModal()" class="w-full text-left px-4 py-2 text-sm hover:bg-muted transition-colors">
                                Edit Profile
                            </button>
                            <a href="{{ route('coins.index') }}" class="block px-4 py-2 text-sm hover:bg-muted transition-colors md:hidden">
                                My Wallet ({{ auth()->check() ? auth()->user()->coins : session('coins', 0) }})
                            </a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-red-500/10 transition-colors">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endauth
            </div>    <button id="mobile-menu-button" class="md:hidden p-2 rounded-lg hover:bg-accent hover:text-accent-foreground transition-colors">
                    <svg id="menu-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="4" x2="20" y1="12" y2="12"/>
                        <line x1="4" x2="20" y1="6" y2="6"/>
                        <line x1="4" x2="20" y1="18" y2="18"/>
                    </svg>
                    <svg id="close-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 6 6 18"/>
                        <path d="m6 6 12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden border-t border-border/50 bg-background/95 backdrop-blur-lg animate-fade-in">
        <nav class="flex flex-col p-4 gap-2">
            <a href="{{ route('home') }}" class="w-full px-4 py-2 rounded-lg font-medium {{ request()->routeIs('home') ? 'bg-secondary text-secondary-foreground' : 'hover:bg-accent hover:text-accent-foreground' }}">
                Home
            </a>
            <a href="{{ route('rooms.index') }}" class="w-full px-4 py-2 rounded-lg font-medium {{ request()->routeIs('rooms.*') ? 'bg-secondary text-secondary-foreground' : 'hover:bg-accent hover:text-accent-foreground' }}">
                Voice Rooms
            </a>
            <a href="{{ route('coins.index') }}" class="w-full px-4 py-2 rounded-lg font-medium {{ request()->routeIs('coins.*') ? 'bg-secondary text-secondary-foreground' : 'hover:bg-accent hover:text-accent-foreground' }}">
                Recharger
            </a>
            <a href="{{ route('contact') }}" class="w-full px-4 py-2 rounded-lg font-medium {{ request()->routeIs('contact') ? 'bg-secondary text-secondary-foreground' : 'hover:bg-accent hover:text-accent-foreground' }}">
                Contact
            </a>
            <a href="{{ route('rooms.index') }}" class="w-full mt-2 px-6 py-2.5 bg-primary text-primary-foreground font-semibold rounded-lg hover:opacity-90 transition-opacity text-center">
                Join Room
            </a>
        </nav>
    </div>
</header>

<script>
    // Mobile menu toggle
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuIcon = document.getElementById('menu-icon');
    const closeIcon = document.getElementById('close-icon');
    
    if (mobileMenuButton) {
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            menuIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        });
    }
</script>
