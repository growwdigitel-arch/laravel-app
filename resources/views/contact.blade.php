@extends('layouts.app')

@section('title', 'Contact Us - ' . get_setting('site_title', 'ChatterGlow'))

@section('content')
<div class="min-h-screen bg-black flex flex-col justify-center py-24 px-4 sm:px-6 lg:px-8">
    <div class="relative w-full max-w-lg mx-auto">
        <!-- Gradient Border -->
        <div class="absolute inset-0 bg-gradient-to-r from-pink-500 via-purple-500 to-indigo-500 rounded-3xl blur opacity-75 animate-pulse"></div>
        
        <div class="relative bg-black/80 backdrop-blur-xl rounded-3xl overflow-hidden shadow-2xl border border-white/10">
            <div class="p-8">
                <div class="text-center mb-8">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-gradient-to-br from-pink-500 to-purple-600 flex items-center justify-center shadow-lg shadow-purple-500/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-white mb-2">Get in Touch</h2>
                    <p class="text-gray-400 text-sm">We'd love to hear from you. Send us a message!</p>
                </div>

                @if(session('success'))
                <div class="rounded-xl bg-green-500/10 border border-green-500/20 p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-400">
                                {{ session('success') }}
                            </p>
                        </div>
                    </div>
                </div>
                @endif

                <form class="space-y-4" action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <div class="space-y-2">
                        <label for="username" class="text-xs font-medium text-gray-400 ml-1">Username</label>
                        <input id="username" name="username" type="text" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 outline-none text-white placeholder-gray-600 focus:bg-white/10 focus:border-white/20 transition-all" placeholder="John Doe" value="{{ old('username', auth()->user()->name ?? '') }}">
                    </div>

                    <div class="space-y-2">
                        <label for="email" class="text-xs font-medium text-gray-400 ml-1">Email</label>
                        <input id="email" name="email" type="email" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 outline-none text-white placeholder-gray-600 focus:bg-white/10 focus:border-white/20 transition-all" placeholder="john@example.com" value="{{ old('email', auth()->user()->email ?? '') }}">
                    </div>

                    <div class="space-y-2">
                        <label for="phone" class="text-xs font-medium text-gray-400 ml-1">Phone Number</label>
                        <input id="phone" name="phone" type="tel" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 outline-none text-white placeholder-gray-600 focus:bg-white/10 focus:border-white/20 transition-all" placeholder="+1 234 567 890" value="{{ old('phone') }}">
                    </div>

                    <div class="space-y-2">
                        <label for="message" class="text-xs font-medium text-gray-400 ml-1">Message</label>
                        <textarea id="message" name="message" rows="4" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 outline-none text-white placeholder-gray-600 focus:bg-white/10 focus:border-white/20 transition-all resize-none" placeholder="How can we help you?">{{ old('message') }}</textarea>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-400 hover:to-purple-500 text-white font-bold py-3.5 rounded-xl transition-all shadow-lg shadow-purple-500/25 transform hover:scale-[1.02] active:scale-[0.98] mt-4">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
