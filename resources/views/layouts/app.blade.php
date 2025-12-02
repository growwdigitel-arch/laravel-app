<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', get_setting('site_title', 'ChatterGlow') . ' - Voice Social Platform')</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ get_setting('site_logo') ? asset(get_setting('site_logo')) : asset('favicon.ico') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Custom CSS -->
    <style>
        :root {
            --background: 20 14% 4%;
            --foreground: 45 25% 91%;
            --border: 20 14% 15%;
            --card: 20 14% 8%;
            --card-foreground: 45 25% 85%;
            --primary: 9 75% 61%;
            --primary-foreground: 0 0% 100%;
            --secondary: 30 15% 52%;
            --secondary-foreground: 0 0% 100%;
            --muted: 20 14% 15%;
            --muted-foreground: 45 15% 46%;
            --accent: 25 45% 20%;
            --accent-foreground: 45 25% 85%;
            --destructive: 356.3033 90.5579% 54.3137%;
            --destructive-foreground: 0 0% 100%;
            --input: 20 14% 18%;
            --ring: 9 75% 61%;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: hsl(var(--background));
            color: hsl(var(--foreground));
            line-height: 1.6;
        }

        .bg-background { background-color: hsl(var(--background)); }
        .bg-card { background-color: hsl(var(--card)); }
        .bg-primary { background-color: hsl(var(--primary)); }
        .bg-secondary { background-color: hsl(var(--secondary)); }
        .bg-muted { background-color: hsl(var(--muted)); }
        .bg-accent { background-color: hsl(var(--accent)); }
        
        .text-foreground { color: hsl(var(--foreground)); }
        .text-primary { color: hsl(var(--primary)); }
        .text-muted-foreground { color: hsl(var(--muted-foreground)); }
        .text-card-foreground { color: hsl(var(--card-foreground)); }
        
        .border-border { border-color: hsl(var(--border)); }
        
        .bg-hero-gradient {
            background: linear-gradient(135deg, 
                hsl(var(--primary)) 0%, 
                hsl(280, 75%, 50%) 50%, 
                hsl(200, 75%, 50%) 100%
            );
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes slide-up {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slide-up {
            animation: slide-up 0.8s ease-out forwards;
        }

        @keyframes fade-in {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .animate-fade-in {
            animation: fade-in 0.3s ease-out;
        }
    </style>

    @stack('styles')
</head>
<body>
    @include('partials.header')
    
    <main>
        @yield('content')
    </main>
    
    @include('partials.footer')
    @include('partials.login-modal')
    @include('partials.profile-modal')
    @include('partials.contact-modal')

    <!-- Scripts -->
    @stack('scripts')
</body>
</html>
