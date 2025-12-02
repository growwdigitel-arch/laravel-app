<footer class="bg-card border-t border-border mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
            <!-- Brand -->
            <div class="col-span-1">
                <div class="flex items-center gap-2 mb-4">
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
                </div>
                <p class="text-muted-foreground text-sm max-w-md">
                    Connect with people through live voice conversations. Join rooms, make friends, and explore vibrant discussions.
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="font-semibold mb-4">Quick Links</h3>
                <ul class="space-y-2 text-sm text-muted-foreground">
                    <li><a href="{{ route('home') }}" class="hover:text-foreground transition-colors">Home</a></li>
                    <li><a href="{{ route('rooms.index') }}" class="hover:text-foreground transition-colors">Voice Rooms</a></li>
                    <li><a href="{{ route('gifts.index') }}" class="hover:text-foreground transition-colors">Gifts</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-foreground transition-colors">Contact Us</a></li>
                </ul>
            </div>

            <!-- Legal & Support -->
            <div>
                <h3 class="font-semibold mb-4">Legal & Support</h3>
                <ul class="space-y-2 text-sm text-muted-foreground">
                    <li><a href="{{ route('page.privacy') }}" class="hover:text-foreground transition-colors">Privacy Policy</a></li>
                    <li><a href="{{ route('page.terms') }}" class="hover:text-foreground transition-colors">Terms of Service</a></li>
                    <li><a href="{{ route('page.refund') }}" class="hover:text-foreground transition-colors">Refund Policy</a></li>
                    <li><a href="{{ route('page.refund') }}" class="hover:text-foreground transition-colors">Refund Policy</a></li>
                </ul>
            </div>

            <!-- Get in Touch -->
            <div>
                <h3 class="font-semibold mb-4">Get in Touch</h3>
                <p class="text-sm text-muted-foreground">
                    {{ get_setting('footer_get_in_touch', 'Have questions? Reach out to us anytime.') }}
                </p>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="pt-8 border-t border-border flex justify-center items-center">
            <p class="text-sm text-muted-foreground text-center">
                © {{ date('Y') }} {{ get_setting('site_title', 'ChatterGlow') }}. All rights reserved.
            </p>
        </div>
    </div>
</footer>
