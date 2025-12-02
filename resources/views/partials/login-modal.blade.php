@guest
<div id="auth-modal" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/90 backdrop-blur-md hidden">
    <div class="relative w-full max-w-md p-1">
        <!-- Gradient Border -->
        <div class="absolute inset-0 bg-gradient-to-r from-pink-500 via-purple-500 to-indigo-500 rounded-3xl blur opacity-75 animate-pulse"></div>
        
        <div class="relative bg-black/80 backdrop-blur-xl rounded-3xl overflow-hidden shadow-2xl border border-white/10">
            <!-- Close Button -->
            <button onclick="document.getElementById('auth-modal').classList.add('hidden')" class="absolute top-4 right-4 text-white/50 hover:text-white transition-colors z-20">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" x2="6" y1="6" y2="18"/>
                    <line x1="6" x2="18" y1="6" y2="18"/>
                </svg>
            </button>

            <div class="p-8 md:p-10 text-center">
                <!-- Logo/Icon -->
                <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-gradient-to-br from-pink-500 to-purple-600 p-0.5 shadow-lg shadow-purple-500/30">
                    <div class="w-full h-full rounded-full bg-black flex items-center justify-center">
                        <span class="text-4xl">🎤</span>
                    </div>
                </div>

                <h2 class="text-3xl font-bold mb-2 bg-gradient-to-r from-pink-400 via-purple-400 to-indigo-400 bg-clip-text text-transparent">Welcome Back</h2>
                <p class="text-gray-400 mb-8 text-sm">Enter your email to access your account</p>

                <!-- Step 1: Email -->
                <div id="step-email">
                    <div class="space-y-6">
                        <div class="relative group">
                            <div class="absolute inset-0 bg-gradient-to-r from-pink-500 to-purple-500 rounded-xl blur opacity-20 group-hover:opacity-40 transition-opacity"></div>
                            <div class="relative bg-white/5 border border-white/10 rounded-xl px-4 py-3 flex items-center gap-3 transition-colors focus-within:bg-white/10 focus-within:border-white/20">
                                <span class="text-gray-400">📧</span>
                                <input type="email" id="login-email" class="bg-transparent w-full outline-none text-white placeholder-gray-500" placeholder="name@example.com">
                            </div>
                        </div>

                        <button onclick="sendOtp()" id="send-otp-btn" class="w-full bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-400 hover:to-purple-500 text-white font-bold py-3.5 rounded-xl transition-all shadow-lg shadow-purple-500/25 transform hover:scale-[1.02] active:scale-[0.98]">
                            Get Verification Code
                        </button>

                        <div id="otp-input-container" class="hidden space-y-6 animate-slide-up">
                            <div class="relative group">
                                <div class="absolute inset-0 bg-gradient-to-r from-pink-500 to-purple-500 rounded-xl blur opacity-20 group-hover:opacity-40 transition-opacity"></div>
                                <input type="text" id="login-otp" class="relative w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 outline-none text-white placeholder-gray-500 text-center tracking-[0.5em] font-bold text-xl focus:bg-white/10 focus:border-white/20 transition-all" placeholder="000000" maxlength="6">
                            </div>

                            <button onclick="verifyOtp()" id="verify-otp-btn" class="w-full bg-white text-black font-bold py-3.5 rounded-xl transition-all hover:bg-gray-100 transform hover:scale-[1.02] active:scale-[0.98]">
                                Verify & Login
                            </button>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex items-center justify-center gap-2 text-xs text-gray-500">
                    <span>By continuing, you agree to our</span>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors underline decoration-dotted">Terms of Service</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
async function sendOtp() {
    const email = document.getElementById('login-email').value;
    const btn = document.getElementById('send-otp-btn');
    
    if (!email) return alert('Please enter your email');
    
    btn.disabled = true;
    btn.innerText = 'Sending...';
    
    try {
        const response = await fetch("{{ route('auth.send-otp') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ email })
        });
        
        const data = await response.json();
        
        if (data.success) {
            document.getElementById('otp-input-container').classList.remove('hidden');
            document.getElementById('send-otp-btn').innerText = 'Resend';
            document.getElementById('login-otp').focus();
            alert('OTP sent to ' + email);
        } else {
            alert(data.message);
        }
    } catch (error) {
        console.error(error);
        alert('Something went wrong');
    } finally {
        btn.disabled = false;
        if(btn.innerText === 'Sending...') btn.innerText = 'Get OTP';
    }
}

async function verifyOtp() {
    const email = document.getElementById('login-email').value;
    const otp = document.getElementById('login-otp').value;
    const btn = document.getElementById('verify-otp-btn');
    
    if (!otp) return alert('Please enter OTP');
    
    btn.disabled = true;
    btn.innerText = 'Verifying...';
    
    try {
        const response = await fetch("{{ route('auth.verify-otp') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ email, otp })
        });
        
        const data = await response.json();
        
        if (data.success) {
            window.location.reload();
        } else {
            alert(data.message);
            btn.disabled = false;
            btn.innerHTML = 'Sign in <span class="text-lg">→</span>';
        }
    } catch (error) {
        console.error(error);
        alert('Something went wrong');
        btn.disabled = false;
        btn.innerHTML = 'Sign in <span class="text-lg">→</span>';
    }
}
</script>
@endguest
