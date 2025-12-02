<div id="contact-modal" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/90 backdrop-blur-md hidden">
    <div class="relative w-full max-w-lg p-4">
        <!-- Gradient Border -->
        <div class="absolute inset-0 bg-gradient-to-r from-pink-500 via-purple-500 to-indigo-500 rounded-3xl blur opacity-75 animate-pulse"></div>
        
        <div class="relative bg-black/80 backdrop-blur-xl rounded-3xl overflow-hidden shadow-2xl border border-white/10">
            <!-- Close Button -->
            <button onclick="document.getElementById('contact-modal').classList.add('hidden')" class="absolute top-4 right-4 text-white/50 hover:text-white transition-colors z-20">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" x2="6" y1="6" y2="18"/>
                    <line x1="6" x2="18" y1="6" y2="18"/>
                </svg>
            </button>

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

                <form class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-xs font-medium text-gray-400 ml-1">Name</label>
                            <input type="text" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 outline-none text-white placeholder-gray-600 focus:bg-white/10 focus:border-white/20 transition-all" placeholder="John Doe">
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-medium text-gray-400 ml-1">Email</label>
                            <input type="email" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 outline-none text-white placeholder-gray-600 focus:bg-white/10 focus:border-white/20 transition-all" placeholder="john@example.com">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-medium text-gray-400 ml-1">Subject</label>
                        <select class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 outline-none text-white focus:bg-white/10 focus:border-white/20 transition-all appearance-none">
                            <option value="" class="bg-gray-900">Select a topic</option>
                            <option value="support" class="bg-gray-900">General Support</option>
                            <option value="billing" class="bg-gray-900">Billing & Payments</option>
                            <option value="partnership" class="bg-gray-900">Partnership</option>
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-medium text-gray-400 ml-1">Message</label>
                        <textarea rows="4" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 outline-none text-white placeholder-gray-600 focus:bg-white/10 focus:border-white/20 transition-all resize-none" placeholder="How can we help you?"></textarea>
                    </div>

                    <button type="button" onclick="alert('Message sent successfully!')" class="w-full bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-400 hover:to-purple-500 text-white font-bold py-3.5 rounded-xl transition-all shadow-lg shadow-purple-500/25 transform hover:scale-[1.02] active:scale-[0.98] mt-4">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
