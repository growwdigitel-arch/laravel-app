<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - {{ get_setting('site_title', 'ChatterGlow') }}</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ get_setting('site_logo') ? asset(get_setting('site_logo')) : asset('favicon.ico') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-indigo-600">Admin Panel</h1>
            </div>
            <nav class="mt-6">
                <a href="{{ route('admin.dashboard') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-50 hover:text-indigo-600 {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-50 text-indigo-600 font-semibold' : 'text-gray-600' }}">
                    Dashboard
                </a>
                <a href="{{ route('admin.users') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-50 hover:text-indigo-600 {{ request()->routeIs('admin.users') ? 'bg-indigo-50 text-indigo-600 font-semibold' : 'text-gray-600' }}">
                    Users
                </a>
                <div class="pt-4 pb-2">
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Settings</p>
                </div>
                <a href="{{ route('admin.settings.site-identity') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-50 hover:text-indigo-600 {{ request()->routeIs('admin.settings.site-identity') ? 'bg-indigo-50 text-indigo-600 font-semibold' : 'text-gray-600' }}">
                    Site Identity
                </a>
                <a href="{{ route('admin.settings.legal-pages') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-50 hover:text-indigo-600 {{ request()->routeIs('admin.settings.legal-pages') ? 'bg-indigo-50 text-indigo-600 font-semibold' : 'text-gray-600' }}">
                    Legal Pages
                </a>
                <a href="{{ route('admin.settings.economy') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-50 hover:text-indigo-600 {{ request()->routeIs('admin.settings.economy') ? 'bg-indigo-50 text-indigo-600 font-semibold' : 'text-gray-600' }}">
                    Economy & Currency
                </a>
                <a href="{{ route('admin.settings.smtp') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-50 hover:text-indigo-600 {{ request()->routeIs('admin.settings.smtp') ? 'bg-indigo-50 text-indigo-600 font-semibold' : 'text-gray-600' }}">
                    SMTP Settings
                </a>
                <a href="{{ route('admin.settings.payment-gateways') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-50 hover:text-indigo-600 {{ request()->routeIs('admin.settings.payment-gateways') ? 'bg-indigo-50 text-indigo-600 font-semibold' : 'text-gray-600' }}">
                    Payment Gateways
                </a>
                <form method="POST" action="{{ route('logout') }}" class="mt-4 border-t pt-4">
                    @csrf
                    <button type="submit" class="w-full text-left block py-2.5 px-4 rounded transition duration-200 hover:bg-red-50 hover:text-red-600 text-gray-600">
                        Logout
                    </button>
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
