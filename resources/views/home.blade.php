@extends('layouts.app')

@section('title', get_setting('site_title', 'ChatterGlow') . ' - Live Voice Chat Platform')

@section('content')
<div class="min-h-screen bg-background">
    <!-- Hero Section -->
    <section class="relative min-h-[90vh] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 bg-hero-gradient"></div>
        
        <div class="absolute top-20 left-10 w-72 h-72 bg-purple-500/30 rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-pink-500/20 rounded-full blur-3xl animate-float" style="animation-delay: 1s;"></div>
        <div class="absolute top-1/2 left-1/3 w-64 h-64 bg-indigo-500/20 rounded-full blur-3xl animate-float" style="animation-delay: 2s;"></div>
        
        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="animate-slide-up">
                <h1 class="text-4xl sm:text-5xl md:text-7xl font-bold text-white mb-6 leading-tight">
                    Live Chat In 
                    <span class="bg-gradient-to-r from-pink-200 to-white bg-clip-text text-transparent">
                        {{ get_setting('site_title', 'ChatterGlow') }}
                    </span>
                </h1>
                
                <p class="text-lg sm:text-xl md:text-2xl text-white/90 mb-4 font-medium">
                    Step into ChatterGlow's VoiceLounge — Talk Freely, Connect Deeply!
                </p>
                
                <p class="text-base sm:text-lg text-white/70 mb-8 max-w-2xl mx-auto">
                    Discover engaging voice rooms where every chat turns into a meaningful connection.
                    Make new friends and explore a world of vibrant voices.
                </p>
                
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-10">
                    <a href="{{ route('rooms.index') }}" class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-[hsl(var(--primary))] bg-white rounded-full shadow-lg hover:shadow-xl transition-shadow">
                        Join the Voice Room
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 12h14"/>
                            <path d="m12 5 7 7-7 7"/>
                        </svg>
                    </a>
                    <a href="{{ route('gifts.index') }}" class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white border-2 border-white/40 rounded-full backdrop-blur-sm bg-white/10 hover:bg-white/20 transition-colors">
                        Explore Gifts
                    </a>
                </div>
                
                <div class="flex items-center justify-center gap-3">
                    <div class="flex -space-x-3">
                        @foreach(['Alex', 'Sarah', 'Mike'] as $name)
                        <div class="w-10 h-10 rounded-full border-2 border-white overflow-hidden">
                            <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ $name }}" alt="{{ $name }}" class="w-full h-full object-cover">
                        </div>
                        @endforeach
                    </div>
                    <div class="flex items-center gap-1.5 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                        <span class="text-white font-semibold text-sm">+3K Members</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-background to-transparent"></div>
    </section>

    <!-- Features Section -->
    <section class="py-24 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        <div class="absolute top-1/2 left-0 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl -translate-y-1/2"></div>
        <div class="max-w-7xl mx-auto relative z-10">
            <div class="text-center mb-20">
                <span class="text-primary font-semibold tracking-wider uppercase text-sm mb-2 block">Features</span>
                <h2 class="text-3xl sm:text-5xl font-bold mb-6">Why ChatterGlow?</h2>
                <p class="text-muted-foreground text-lg max-w-2xl mx-auto">
                    Experience real-time voice conversations with crystal-clear quality and amazing features designed for connection.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="group bg-card/50 backdrop-blur-sm p-8 rounded-3xl border border-border hover:border-primary/50 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-primary/10">
                    <div class="w-14 h-14 bg-gradient-to-br from-primary to-purple-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-primary/20 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"/>
                            <path d="M19 10v2a7 7 0 0 1-14 0v-2"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-3">Crystal Clear Audio</h3>
                    <p class="text-muted-foreground leading-relaxed">High-quality voice chat powered by advanced WebRTC technology ensures every nuance of your voice is heard perfectly.</p>
                </div>

                <div class="group bg-card/50 backdrop-blur-sm p-8 rounded-3xl border border-border hover:border-primary/50 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-primary/10">
                    <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-blue-500/20 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-3">Global Community</h3>
                    <p class="text-muted-foreground leading-relaxed">Connect with thousands of users from around the world. Break language barriers and make friends across borders.</p>
                </div>

                <div class="group bg-card/50 backdrop-blur-sm p-8 rounded-3xl border border-border hover:border-primary/50 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-primary/10">
                    <div class="w-14 h-14 bg-gradient-to-br from-pink-500 to-rose-500 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-pink-500/20 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/>
                            <path d="M5 3v4"/>
                            <path d="M19 17v4"/>
                            <path d="M3 5h4"/>
                            <path d="M17 19h4"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-3">Expressive Gifts</h3>
                    <p class="text-muted-foreground leading-relaxed">Show your appreciation with stunning animated gifts. Support your favorite creators and stand out in the room.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-24 px-4 sm:px-6 lg:px-8 bg-white/5">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-20">
                <span class="text-primary font-semibold tracking-wider uppercase text-sm mb-2 block">Get Started</span>
                <h2 class="text-3xl sm:text-5xl font-bold mb-6">How It Works</h2>
                <p class="text-muted-foreground text-lg max-w-2xl mx-auto">
                    Start your journey in three simple steps. It's easier than you think!
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 relative">
                <!-- Connecting Line -->
                <div class="hidden md:block absolute top-12 left-0 right-0 h-0.5 bg-gradient-to-r from-transparent via-primary/30 to-transparent"></div>

                <div class="relative text-center">
                    <div class="w-24 h-24 mx-auto bg-background border-4 border-primary/20 rounded-full flex items-center justify-center mb-8 relative z-10 shadow-xl">
                        <span class="text-4xl font-bold text-primary">1</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Create Account</h3>
                    <p class="text-muted-foreground">Sign up in seconds using your email. No complicated forms, just quick access.</p>
                </div>

                <div class="relative text-center">
                    <div class="w-24 h-24 mx-auto bg-background border-4 border-primary/20 rounded-full flex items-center justify-center mb-8 relative z-10 shadow-xl">
                        <span class="text-4xl font-bold text-primary">2</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Join a Room</h3>
                    <p class="text-muted-foreground">Browse through various themed rooms or create your own private space.</p>
                </div>

                <div class="relative text-center">
                    <div class="w-24 h-24 mx-auto bg-background border-4 border-primary/20 rounded-full flex items-center justify-center mb-8 relative z-10 shadow-xl">
                        <span class="text-4xl font-bold text-primary">3</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Start Chatting</h3>
                    <p class="text-muted-foreground">Hop on the mic, share your thoughts, and make meaningful connections.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-24 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-indigo-500/10 rounded-full blur-3xl translate-y-1/2 translate-x-1/4"></div>
        
        <div class="max-w-7xl mx-auto relative z-10">
            <div class="text-center mb-20">
                <span class="text-primary font-semibold tracking-wider uppercase text-sm mb-2 block">Community Love</span>
                <h2 class="text-3xl sm:text-5xl font-bold mb-6">What Users Say</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Review 1 -->
                <div class="bg-card/30 backdrop-blur-md p-8 rounded-3xl border border-white/5">
                    <div class="flex items-center gap-4 mb-6">
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Sarah" alt="User" class="w-12 h-12 rounded-full border-2 border-primary/50">
                        <div>
                            <h4 class="font-bold">Sarah M.</h4>
                            <div class="flex text-yellow-500 text-sm">★★★★★</div>
                        </div>
                    </div>
                    <p class="text-muted-foreground italic">"I've met so many amazing people here. The audio quality is incredible, and the community is so welcoming!"</p>
                </div>

                <!-- Review 2 -->
                <div class="bg-card/30 backdrop-blur-md p-8 rounded-3xl border border-white/5 transform md:-translate-y-4">
                    <div class="flex items-center gap-4 mb-6">
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=James" alt="User" class="w-12 h-12 rounded-full border-2 border-primary/50">
                        <div>
                            <h4 class="font-bold">James K.</h4>
                            <div class="flex text-yellow-500 text-sm">★★★★★</div>
                        </div>
                    </div>
                    <p class="text-muted-foreground italic">"The best place to chill after a long day. The voice rooms are super fun and the gifts are a nice touch."</p>
                </div>

                <!-- Review 3 -->
                <div class="bg-card/30 backdrop-blur-md p-8 rounded-3xl border border-white/5">
                    <div class="flex items-center gap-4 mb-6">
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Emily" alt="User" class="w-12 h-12 rounded-full border-2 border-primary/50">
                        <div>
                            <h4 class="font-bold">Emily R.</h4>
                            <div class="flex text-yellow-500 text-sm">★★★★★</div>
                        </div>
                    </div>
                    <p class="text-muted-foreground italic">"Finally a social app that feels genuine. No fake profiles, just real conversations with real people."</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center bg-gradient-to-br from-primary/20 to-purple-500/20 rounded-2xl p-12 border border-primary/30">
            <h2 class="text-3xl sm:text-4xl font-bold mb-4">Ready to Start Chatting?</h2>
            <p class="text-muted-foreground text-lg mb-8 max-w-2xl mx-auto">
                Join thousands of users in live voice conversations. It's free and takes less than a minute to get started!
            </p>
            <a href="{{ route('rooms.index') }}" class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold bg-primary text-primary-foreground rounded-full hover:opacity-90 transition-opacity">
                Browse Voice Rooms
                <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M5 12h14"/>
                    <path d="m12 5 7 7-7 7"/>
                </svg>
            </a>
        </div>
    </section>
</div>
@endsection
