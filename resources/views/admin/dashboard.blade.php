@extends('layouts.admin')

@section('content')
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Dashboard</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Total Users Card -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500 text-sm font-medium">Total Users</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>

        <!-- Total Coins Card -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500 text-sm font-medium">Total Coins in Circulation</p>
                    <p class="text-2xl font-bold text-gray-800">{{ number_format($totalCoins) }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
