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
                    <span class="bg-gradient-to-r from-cyan-300 via-blue-300 to-white bg-clip-text text-transparent animate-gradient bg-[length:200%_auto]"
                        @editable('site_title')>
                        {{ $settings['site_title'] ?? 'ChatterGlow' }}
                    </span>
                </h1>
                
                <p class="text-lg sm:text-xl md:text-2xl text-white/90 mb-4 font-medium" @editable('hero_subtitle')>
                    {{ $settings['hero_subtitle'] ?? "Step into ChatterGlow's VoiceLounge — Talk Freely, Connect Deeply!" }}
                </p>
                
                <p class="text-base sm:text-lg text-white/70 mb-8 max-w-2xl mx-auto" @editable('hero_description')>
                    {{ $settings['hero_description'] ?? "Discover engaging voice rooms where every chat turns into a meaningful connection. Make new friends and explore a world of vibrant voices." }}
                </p>
                
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-10">
                    <a href="{{ route('rooms.index') }}" class="w-full sm:w-auto px-8 py-4 bg-white text-primary font-bold rounded-full hover:bg-gray-100 transition-all transform hover:scale-105 shadow-lg shadow-white/10 flex items-center justify-center gap-2" @editable('hero_btn_primary')>
                        {{ $settings['hero_btn_primary'] ?? 'Join the Voice Room' }}
                    </a>
                    <a href="{{ route('gifts.index') }}" class="w-full sm:w-auto px-8 py-4 bg-white/10 backdrop-blur-md text-white font-bold rounded-full hover:bg-white/20 transition-all transform hover:scale-105 border border-white/20 flex items-center justify-center gap-2" @editable('hero_btn_secondary')>
                        {{ $settings['hero_btn_secondary'] ?? 'Explore Gifts' }}
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
                <span class="text-primary font-semibold tracking-wider uppercase text-sm mb-2 block" @editable('features_label')>{{ $settings['features_label'] ?? 'Features' }}</span>
                <h2 class="text-3xl sm:text-5xl font-bold mb-6" @editable('features_title')>{{ $settings['features_title'] ?? 'Why ChatterGlow?' }}</h2>
                <p class="text-muted-foreground text-lg max-w-2xl mx-auto" @editable('features_description')>
                    {{ $settings['features_description'] ?? 'Experience real-time voice conversations with crystal-clear quality and amazing features designed for connection.' }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <!-- Feature 1 -->
                <div class="group bg-card/50 backdrop-blur-sm p-8 rounded-3xl border border-border hover:border-primary/50 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-primary/10">
                    <div class="w-14 h-14 bg-gradient-to-br from-primary to-purple-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-primary/20 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/>
                            <path d="M19 10v2a7 7 0 0 1-14 0v-2"/>
                            <line x1="12" y1="19" x2="12" y2="23"/>
                            <line x1="8" y1="23" x2="16" y2="23"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-3" @editable('feature_1_title')>{{ $settings['feature_1_title'] ?? 'Live Voice Chat' }}</h3>
                    <p class="text-muted-foreground leading-relaxed" @editable('feature_1_desc')>{{ $settings['feature_1_desc'] ?? 'High-quality voice chat powered by advanced WebRTC technology ensures every nuance of your voice is heard perfectly.' }}</p>
                </div>

                <!-- Feature 2 -->
                <!-- Feature 2 -->
                <div class="group bg-card/50 backdrop-blur-sm p-8 rounded-3xl border border-border hover:border-primary/50 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-primary/10">
                    <div class="w-14 h-14 bg-gradient-to-br from-pink-500 to-rose-500 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-pink-500/20 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 12v10H4V12"/>
                            <path d="M2 7h20v5H2z"/>
                            <path d="M12 22V7"/>
                            <path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"/>
                            <path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-3" @editable('feature_2_title')>{{ $settings['feature_2_title'] ?? 'Virtual Gifts' }}</h3>
                    <p class="text-muted-foreground leading-relaxed" @editable('feature_2_desc')>{{ $settings['feature_2_desc'] ?? 'Show your appreciation with stunning animated gifts. Support your favorite creators and stand out in the room.' }}</p>
                </div>

                <!-- Feature 3 -->
                <!-- Feature 3 -->
                <div class="group bg-card/50 backdrop-blur-sm p-8 rounded-3xl border border-border hover:border-primary/50 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-primary/10">
                    <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-blue-500/20 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-3" @editable('feature_3_title')>{{ $settings['feature_3_title'] ?? 'Global Community' }}</h3>
                    <p class="text-muted-foreground leading-relaxed" @editable('feature_3_desc')>{{ $settings['feature_3_desc'] ?? 'Connect with thousands of users from India and around the world. Break language barriers and make friends across borders.' }}</p>
                </div>

                <!-- Feature 4 - Safe & Secure (Premium) -->
                <!-- Feature 4 - Safe & Secure (Premium) -->
                <div class="group bg-card/50 backdrop-blur-sm p-8 rounded-3xl border border-emerald-500/20 hover:border-emerald-500/40 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-emerald-500/10 relative overflow-hidden">
                    <!-- Subtle gradient overlay -->
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    
                    <div class="relative z-10">
                        <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-emerald-500/20 group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/>
                                <path d="m9 12 2 2 4-4"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-3" @editable('feature_4_title')>{{ $settings['feature_4_title'] ?? 'Safe & Secure' }}</h3>
                        <p class="text-muted-foreground leading-relaxed" @editable('feature_4_desc')>{{ $settings['feature_4_desc'] ?? 'Your privacy matters. Moderated rooms, secure connections, and reporting tools keep the community safe.' }}</p>
                        <div class="mt-4 inline-flex items-center gap-2 px-3 py-1.5 bg-emerald-500/10 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-emerald-600 dark:text-emerald-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"/>
                                <path d="m9 12 2 2 4-4"/>
                            </svg>
                            <span class="text-xs font-semibold text-emerald-600 dark:text-emerald-400">Verified Platform</span>
                        </div>
                    </div>
                </div>

                <!-- Feature 5 -->
                <!-- Feature 5 -->
                <div class="group bg-card/50 backdrop-blur-sm p-8 rounded-3xl border border-border hover:border-primary/50 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-primary/10">
                    <div class="w-14 h-14 bg-gradient-to-br from-orange-500 to-amber-500 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-orange-500/20 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect width="7" height="7" x="3" y="3" rx="1"/>
                            <rect width="7" height="7" x="14" y="3" rx="1"/>
                            <rect width="7" height="7" x="14" y="14" rx="1"/>
                            <rect width="7" height="7" x="3" y="14" rx="1"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-3" @editable('feature_5_title')>{{ $settings['feature_5_title'] ?? 'Multiple Rooms' }}</h3>
                    <p class="text-muted-foreground leading-relaxed" @editable('feature_5_desc')>{{ $settings['feature_5_desc'] ?? 'From music to gaming, learning to casual chat - find the perfect room that matches your vibe and interests.' }}</p>
                </div>

                <!-- Feature 6 -->
                <!-- Feature 6 -->
                <div class="group bg-card/50 backdrop-blur-sm p-8 rounded-3xl border border-border hover:border-primary/50 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-primary/10">
                    <div class="w-14 h-14 bg-gradient-to-br from-violet-500 to-purple-500 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-violet-500/20 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M13 2 3 14h9l-1 8 10-12h-9l1-8z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-3" @editable('feature_6_title')>{{ $settings['feature_6_title'] ?? 'Real-time Fun' }}</h3>
                    <p class="text-muted-foreground leading-relaxed" @editable('feature_6_desc')>{{ $settings['feature_6_desc'] ?? 'Instant reactions, live interactions, and spontaneous conversations make every moment exciting and memorable.' }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-24 px-4 sm:px-6 lg:px-8 bg-white/5">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-20">
                <span class="text-primary font-semibold tracking-wider uppercase text-sm mb-2 block" @editable('how_it_works_label')>{{ $settings['how_it_works_label'] ?? 'Get Started' }}</span>
                <h2 class="text-3xl sm:text-5xl font-bold mb-6" @editable('how_it_works_title')>{{ $settings['how_it_works_title'] ?? 'How It Works' }}</h2>
                <p class="text-muted-foreground text-lg max-w-2xl mx-auto" @editable('how_it_works_desc')>
                    {{ $settings['how_it_works_desc'] ?? "Start your journey in three simple steps. It's easier than you think!" }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 relative">
                <!-- Connecting Line -->
                <div class="hidden md:block absolute top-12 left-0 right-0 h-0.5 bg-gradient-to-r from-transparent via-primary/30 to-transparent"></div>

                <div class="relative text-center">
                    <div class="w-24 h-24 mx-auto bg-background border-4 border-primary/20 rounded-full flex items-center justify-center mb-8 relative z-10 shadow-xl">
                        <span class="text-4xl font-bold text-primary">1</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3" @editable('step_1_title')>{{ $settings['step_1_title'] ?? 'Create Account' }}</h3>
                    <p class="text-muted-foreground" @editable('step_1_desc')>{{ $settings['step_1_desc'] ?? 'Sign up in seconds using your email. No complicated forms, just quick access.' }}</p>
                </div>

                <div class="relative text-center">
                    <div class="w-24 h-24 mx-auto bg-background border-4 border-primary/20 rounded-full flex items-center justify-center mb-8 relative z-10 shadow-xl">
                        <span class="text-4xl font-bold text-primary">2</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3" @editable('step_2_title')>{{ $settings['step_2_title'] ?? 'Join a Room' }}</h3>
                    <p class="text-muted-foreground" @editable('step_2_desc')>{{ $settings['step_2_desc'] ?? 'Browse through various themed rooms or create your own private space.' }}</p>
                </div>

                <div class="relative text-center">
                    <div class="w-24 h-24 mx-auto bg-background border-4 border-primary/20 rounded-full flex items-center justify-center mb-8 relative z-10 shadow-xl">
                        <span class="text-4xl font-bold text-primary">3</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3" @editable('step_3_title')>{{ $settings['step_3_title'] ?? 'Start Chatting' }}</h3>
                    <p class="text-muted-foreground" @editable('step_3_desc')>{{ $settings['step_3_desc'] ?? 'Hop on the mic, share your thoughts, and make meaningful connections.' }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-24 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-indigo-500/10 rounded-full blur-3xl translate-y-1/2 translate-x-1/4"></div>
        
        <div class="max-w-7xl mx-auto relative z-10">
            <div class="text-center mb-20">
                <span class="text-primary font-semibold tracking-wider uppercase text-sm mb-2 block" @editable('testimonials_label')>{{ $settings['testimonials_label'] ?? 'Community Love' }}</span>
                <h2 class="text-3xl sm:text-5xl font-bold mb-6" @editable('testimonials_title')>{{ $settings['testimonials_title'] ?? 'What Users Say' }}</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Review 1 -->
                <div class="bg-card/30 backdrop-blur-md p-8 rounded-3xl border border-white/5">
                    <div class="flex items-center gap-4 mb-6">
                        <img src="{{ $settings['testimonial_1_img'] ?? 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=150&h=150' }}" alt="User" class="w-12 h-12 rounded-full border-2 border-primary/50 object-cover" @editable('testimonial_1_img')>
                        <div>
                            <h4 class="font-bold" @editable('testimonial_1_name')>{{ $settings['testimonial_1_name'] ?? 'Rahul Kumar' }}</h4>
                            <div class="flex text-yellow-500 text-sm">★★★★★</div>
                        </div>
                    </div>
                    <p class="text-muted-foreground italic" @editable('testimonial_1_text')>"{{ $settings['testimonial_1_text'] ?? "I've met so many amazing people here. The audio quality is incredible, and the community is so welcoming!" }}"</p>
                </div>

                <!-- Review 2 -->
                <div class="bg-card/30 backdrop-blur-md p-8 rounded-3xl border border-white/5 transform md:-translate-y-4">
                    <div class="flex items-center gap-4 mb-6">
                        <img src="{{ $settings['testimonial_2_img'] ?? 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=150&h=150' }}" alt="User" class="w-12 h-12 rounded-full border-2 border-primary/50 object-cover" @editable('testimonial_2_img')>
                        <div>
                            <h4 class="font-bold" @editable('testimonial_2_name')>{{ $settings['testimonial_2_name'] ?? 'Sneha Reddy' }}</h4>
                            <div class="flex text-yellow-500 text-sm">★★★★★</div>
                        </div>
                    </div>
                    <p class="text-muted-foreground italic" @editable('testimonial_2_text')>"{{ $settings['testimonial_2_text'] ?? "The best place to chill after a long day. The voice rooms are super fun and the gifts are a nice touch." }}"</p>
                </div>

                <!-- Review 3 -->
                <div class="bg-card/30 backdrop-blur-md p-8 rounded-3xl border border-white/5">
                    <div class="flex items-center gap-4 mb-6">
                        <img src="{{ $settings['testimonial_3_img'] ?? 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=150&h=150' }}" alt="User" class="w-12 h-12 rounded-full border-2 border-primary/50 object-cover" @editable('testimonial_3_img')>
                        <div>
                            <h4 class="font-bold" @editable('testimonial_3_name')>{{ $settings['testimonial_3_name'] ?? 'Amit Shah' }}</h4>
                            <div class="flex text-yellow-500 text-sm">★★★★★</div>
                        </div>
                    </div>
                    <p class="text-muted-foreground italic" @editable('testimonial_3_text')>"{{ $settings['testimonial_3_text'] ?? "Finally a social app that feels genuine. No fake profiles, just real conversations with real people." }}"</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-24 px-4 sm:px-6 lg:px-8 bg-gradient-to-b from-background to-muted/20">
        <div class="max-w-3xl mx-auto">
            <div class="text-center mb-16">
                
                <h2 class="text-3xl sm:text-5xl font-bold mb-4" @editable('faq_title')>{{ $settings['faq_title'] ?? 'Frequently Asked Questions' }}</h2>
                <p class="text-muted-foreground text-lg" @editable('faq_description')>
                    {{ $settings['faq_description'] ?? "Everything you need to know about ChatterGlow" }}
                </p>
            </div>

            <div class="space-y-4">
                <!-- FAQ 1 -->
                <div class="faq-item bg-card rounded-2xl border border-border overflow-hidden hover:border-primary/30 transition-all">
                    <button onclick="toggleFAQ(this)" class="w-full px-6 sm:px-8 py-6 flex items-center justify-between text-left group">
                        <span class="font-bold text-base sm:text-lg pr-4" @editable('faq_1_question')>{{ $settings['faq_1_question'] ?? 'Will my personal information be kept confidential?' }}</span>
                        <svg class="w-5 h-5 text-muted-foreground group-hover:text-primary transition-all duration-300 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="m6 9 6 6 6-6"/>
                        </svg>
                    </button>
                    <div class="faq-answer max-h-0 overflow-hidden transition-all duration-300">
                        <div class="px-6 sm:px-8 pb-6 text-muted-foreground leading-relaxed" @editable('faq_1_answer')>
                            {{ $settings['faq_1_answer'] ?? "Of course. At ChatterGlow, your privacy and security are paramount. We take various measures to ensure your personal data is secure. Your information is protected, and we will never share it with unauthorized third parties without your explicit consent." }}
                        </div>
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="faq-item bg-card rounded-2xl border border-border overflow-hidden hover:border-primary/30 transition-all">
                    <button onclick="toggleFAQ(this)" class="w-full px-6 sm:px-8 py-6 flex items-center justify-between text-left group">
                        <span class="font-bold text-base sm:text-lg pr-4" @editable('faq_2_question')>{{ $settings['faq_2_question'] ?? 'Why choose ChatterGlow?' }}</span>
                        <svg class="w-5 h-5 text-muted-foreground group-hover:text-primary transition-all duration-300 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="m6 9 6 6 6-6"/>
                        </svg>
                    </button>
                    <div class="faq-answer max-h-0 overflow-hidden transition-all duration-300">
                        <div class="px-6 sm:px-8 pb-6 text-muted-foreground leading-relaxed" @editable('faq_2_answer')>
                            {{ $settings['faq_2_answer'] ?? "ChatterGlow provides a seamless and secure voice communication platform. We employ robust privacy measures, user-friendly interfaces, and have dedicated teams to ensure a smooth experience, always prioritizing user satisfaction and confidentiality." }}
                        </div>
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="faq-item bg-card rounded-2xl border border-border overflow-hidden hover:border-primary/30 transition-all">
                    <button onclick="toggleFAQ(this)" class="w-full px-6 sm:px-8 py-6 flex items-center justify-between text-left group">
                        <span class="font-bold text-base sm:text-lg pr-4" @editable('faq_3_question')>{{ $settings['faq_3_question'] ?? 'How do I speak in a voice room?' }}</span>
                        <svg class="w-5 h-5 text-muted-foreground group-hover:text-primary transition-all duration-300 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="m6 9 6 6 6-6"/>
                        </svg>
                    </button>
                    <div class="faq-answer max-h-0 overflow-hidden transition-all duration-300">
                        <div class="px-6 sm:px-8 pb-6 text-muted-foreground leading-relaxed" @editable('faq_3_answer')>
                            {{ $settings['faq_3_answer'] ?? "To participate in a voice room, simply navigate to the designated room in ChatterGlow and join the conversation. Once inside, you can engage in voice communication with others in the room." }}
                        </div>
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="faq-item bg-card rounded-2xl border border-border overflow-hidden hover:border-primary/30 transition-all">
                    <button onclick="toggleFAQ(this)" class="w-full px-6 sm:px-8 py-6 flex items-center justify-between text-left group">
                        <span class="font-bold text-base sm:text-lg pr-4" @editable('faq_4_question')>{{ $settings['faq_4_question'] ?? 'What should I do if the screen freezes or audio cuts out?' }}</span>
                        <svg class="w-5 h-5 text-muted-foreground group-hover:text-primary transition-all duration-300 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="m6 9 6 6 6-6"/>
                        </svg>
                    </button>
                    <div class="faq-answer max-h-0 overflow-hidden transition-all duration-300">
                        <div class="px-6 sm:px-8 pb-6 text-muted-foreground leading-relaxed" @editable('faq_4_answer')>
                            {{ $settings['faq_4_answer'] ?? "If you experience screen freezing or audio interruption while using ChatterGlow, first check your network connection. Refreshing the page or rejoining the room may also resolve the issue. If the problem persists, please contact our support team for immediate assistance." }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center bg-gradient-to-br from-primary/20 to-purple-500/20 rounded-2xl p-12 border border-primary/30">
            <h2 class="text-3xl sm:text-4xl font-bold mb-4" @editable('cta_title')>{{ $settings['cta_title'] ?? 'Ready to Start Chatting?' }}</h2>
            <p class="text-muted-foreground text-lg mb-8 max-w-2xl mx-auto" @editable('cta_description')>
                {{ $settings['cta_description'] ?? "Join thousands of users in live voice conversations. It's free and takes less than a minute to get started!" }}
            </p>
            <a href="{{ route('rooms.index') }}" class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold bg-primary text-primary-foreground rounded-full hover:opacity-90 transition-opacity" @editable('cta_button_text')>
                {{ $settings['cta_button_text'] ?? 'Browse Voice Rooms' }}
            </a>
        </div>
    </section>
</div>

@push('scripts')
<script>
    // FAQ Accordion Toggle
    function toggleFAQ(button) {
        const faqItem = button.closest('.faq-item');
        const answer = faqItem.querySelector('.faq-answer');
        const arrow = button.querySelector('svg:last-child');
        const isOpen = answer.style.maxHeight && answer.style.maxHeight !== '0px';
        
        // Close all other FAQs
        document.querySelectorAll('.faq-item').forEach(item => {
            if (item !== faqItem) {
                const otherAnswer = item.querySelector('.faq-answer');
                const otherArrow = item.querySelector('button svg:last-child');
                otherAnswer.style.maxHeight = '0px';
                otherArrow.style.transform = 'rotate(0deg)';
            }
        });
        
        // Toggle current FAQ
        if (isOpen) {
            answer.style.maxHeight = '0px';
            arrow.style.transform = 'rotate(0deg)';
        } else {
            answer.style.maxHeight = answer.scrollHeight + 'px';
            arrow.style.transform = 'rotate(180deg)';
        }
    }
</script>

<style>
    @keyframes gradient-shift {
        0%, 100% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
    }
    
    .animate-gradient {
        animation: gradient-shift 3s ease infinite;
    }
</style>
@endpush

@if(request('edit_mode'))
    @push('scripts')
        <script src="{{ asset('js/visual-editor.js') }}"></script>

        <style>
            [contenteditable="true"] {
                outline: 2px dashed #4f46e5;
                outline-offset: 4px;
                cursor: text;
                transition: all 0.2s;
            }
            [contenteditable="true"]:hover {
                background-color: rgba(79, 70, 229, 0.1);
                border-radius: 4px;
            }
            [contenteditable="true"]:focus {
                outline: 2px solid #4f46e5;
                background-color: rgba(79, 70, 229, 0.05);
            }
        </style>
    @endpush
@endif
@endsection
