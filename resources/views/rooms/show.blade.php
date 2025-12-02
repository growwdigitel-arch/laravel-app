@extends('layouts.app')

@section('title', $room->name . ' - ' . get_setting('site_title', 'ChatterGlow'))

@section('content')
<div class="min-h-screen bg-background pt-20 pb-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-[1600px] mx-auto w-full flex flex-col lg:flex-row gap-6">
        
        <!-- Left Side: Participants -->
        <div class="flex-1 flex flex-col">
            <!-- Clean Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-2">
                        <h1 class="text-2xl sm:text-3xl font-bold">{{ $room->name }}</h1>
                        @if($room->is_live)
                        <span class="bg-red-500 text-white text-xs px-3 py-1 rounded-full animate-pulse font-bold">LIVE</span>
                        @endif
                    </div>
                    <p class="text-muted-foreground">{{ $room->description }}</p>
                </div>
                
                <div class="flex items-center gap-3 flex-wrap">
                    <!-- Coin Balance -->
                    <div class="bg-card px-5 py-2.5 rounded-full border-2 border-border flex items-center gap-2 shadow-sm">
                        <div class="w-6 h-6 rounded-full bg-gradient-to-br from-yellow-400 to-orange-600 flex items-center justify-center text-[10px] text-white font-bold shadow-sm">🪙</div>
                        <span id="user-coins" class="font-bold text-lg">{{ auth()->check() ? auth()->user()->coins : session('coins', 0) }}</span>
                    </div>
                    
                    <!-- Mic Toggle (Defaults to Muted) -->
                    <button onclick="toggleMic(this)" class="muted p-3 rounded-full bg-red-500/10 border-2 border-red-500/30 hover:bg-red-500/20 transition-all relative group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="1" y1="1" x2="23" y2="23"/>
                            <path d="M9 9v3a3 3 0 0 0 5.12 2.12M15 9.34V4a3 3 0 0 0-5.94-.6"/>
                            <path d="M17 16.95A7 7 0 0 1 5 12v-2m14 0v2a7 7 0 0 1-.11 1.23"/>
                            <line x1="12" y1="19" x2="12" y2="22"/>
                            <line x1="8" y1="22" x2="16" y2="22"/>
                        </svg>
                    </button>
                    
                    <!-- Gift Button -->
                    @auth
                    <button onclick="openGiftModal()" class="bg-gradient-to-r from-pink-500 to-purple-600 text-white px-6 py-2.5 rounded-full text-sm font-bold hover:shadow-lg hover:shadow-purple-500/30 transition-all transform hover:scale-105 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 12v10H4V12"/>
                            <path d="M2 7h20v5H2z"/>
                            <path d="M12 22V7"/>
                            <path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"/>
                            <path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"/>
                        </svg>
                        Send Gift
                    </button>
                    @else
                    <button onclick="document.getElementById('auth-modal').classList.remove('hidden')" class="bg-primary text-primary-foreground px-6 py-2.5 rounded-full text-sm font-bold hover:opacity-90 transition-opacity">
                        + Add Coins
                    </button>
                    @endauth
                    
                    <!-- Leave Room -->
                    <a href="{{ route('rooms.index') }}" class="bg-red-500/10 text-red-500 hover:bg-red-500/20 px-5 py-2.5 rounded-full text-sm font-bold transition-colors flex items-center gap-2 border border-red-500/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                            <polyline points="16 17 21 12 16 7"/>
                            <line x1="21" x2="9" y1="12" y2="12"/>
                        </svg>
                        Leave
                    </a>
                </div>
            </div>

            <!-- Participants Grid -->
            <div class="flex-1 overflow-auto">
                <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 gap-4">
                    @foreach($participants as $participant)
                    <div class="aspect-square bg-card rounded-2xl border-2 border-border relative overflow-hidden group hover:border-primary/40 hover:shadow-lg transition-all" 
                         data-participant-id="{{ $participant['name'] }}"
                         data-is-me="{{ isset($participant['is_me']) && $participant['is_me'] ? 'true' : 'false' }}">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <!-- Avatar with enhanced speaking animation -->
                            <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full overflow-hidden border-2 relative transition-all duration-300
                                {{ $participant['is_speaking'] ? 'border-green-500 ring-4 ring-green-500/20 animate-pulse scale-105' : ($participant['mic_on'] ? 'border-green-500/50' : 'border-gray-500') }} 
                                {{ isset($participant['is_me']) && $participant['is_me'] ? 'ring-4 ring-primary/30' : '' }}">
                                
                                <!-- Speaking Wave Animation -->
                                @if($participant['is_speaking'])
                                <div class="absolute inset-0 rounded-full border-2 border-green-500 animate-ping opacity-75"></div>
                                <div class="absolute inset-0 rounded-full border-2 border-green-400 animate-pulse"></div>
                                @endif
                                
                                @if($participant['avatar'])
                                    <img 
                                        src="{{ $participant['avatar'] }}" 
                                        alt="{{ $participant['name'] }}" 
                                        class="w-full h-full object-cover {{ $participant['is_speaking'] ? 'scale-110' : '' }} transition-transform duration-300"
                                        onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($participant['name']) }}&background=random&color=fff';"
                                    >
                                @else
                                    <div class="w-full h-full bg-primary flex items-center justify-center text-white font-bold text-xl sm:text-2xl {{ $participant['is_speaking'] ? 'scale-110' : '' }} transition-transform duration-300">
                                        {{ $participant['initials'] }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Name Overlay -->
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-2.5 text-center">
                            <p class="text-white font-semibold text-xs sm:text-sm truncate">
                                {{ $participant['name'] }}
                                @if(isset($participant['is_me']) && $participant['is_me'])
                                    <span class="text-[10px] text-primary font-bold ml-1">(You)</span>
                                @endif
                            </p>
                            @if($participant['is_host'])
                                <span class="text-[10px] text-yellow-400 font-bold block uppercase tracking-wider">HOST</span>
                            @endif
                        </div>
                        
                        <!-- Mic Status Indicator -->
                        <div class="absolute top-2 right-2">
                            @if($participant['is_speaking'])
                                <!-- Speaking -->
                                <div class="p-1.5 rounded-full bg-green-500 border-2 border-white shadow-lg animate-pulse">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"/>
                                        <path d="M19 10v2a7 7 0 0 1-14 0v-2"/>
                                        <line x1="12" y1="19" x2="12" y2="22"/>
                                    </svg>
                                </div>
                            @elseif($participant['mic_on'])
                                <!-- Mic On but not speaking -->
                                <div class="p-1.5 rounded-full bg-green-500/20 border border-green-500/50">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-green-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"/>
                                        <path d="M19 10v2a7 7 0 0 1-14 0v-2"/>
                                        <line x1="12" y1="19" x2="12" y2="22"/>
                                    </svg>
                                </div>
                            @else
                                <!-- Mic Off -->
                                <div class="p-1.5 rounded-full bg-red-500/20 border border-red-500/50">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="1" y1="1" x2="23" y2="23"/>
                                        <path d="M9 9v3a3 3 0 0 0 5.12 2.12M15 9.34V4a3 3 0 0 0-5.94-.6"/>
                                        <path d="M17 16.95A7 7 0 0 1 5 12v-2m14 0v2a7 7 0 0 1-.11 1.23"/>
                                        <line x1="12" y1="19" x2="12" y2="22"/>
                                        <line x1="8" y1="22" x2="16" y2="22"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>
                    @endforeach

                    <!-- Empty Slots -->
                    @for($i = 0; $i < (12 - count($participants)); $i++)
                    <div class="aspect-square bg-card/30 rounded-2xl border-2 border-dashed border-border/50 flex items-center justify-center opacity-40 hover:opacity-60 transition-opacity">
                        <div class="w-12 h-12 rounded-full bg-muted/50 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-muted-foreground/50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                            </svg>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>

        <!-- Right Side: Chat -->
        <div class="w-full lg:w-[400px] bg-card border-2 border-border rounded-2xl flex flex-col h-[600px] lg:h-[calc(100vh-120px)] shrink-0 lg:sticky lg:top-24 shadow-xl">
            <!-- Chat Header -->
            <div class="p-4 border-b-2 border-border bg-gradient-to-r from-primary/5 to-purple-500/5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary to-purple-600 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold text-lg">Live Chat</p>
                        <p class="text-xs text-muted-foreground">Join the conversation</p>
                    </div>
                </div>
            </div>
            
            <!-- Messages -->
            <div id="chat-messages" class="flex-1 overflow-y-auto p-4 space-y-3 bg-gradient-to-b from-background/50 to-background">
                <!-- Pinned Message -->
                <div class="bg-gradient-to-r from-primary/10 to-purple-500/10 border-2 border-primary/20 rounded-xl p-4 sticky top-0 z-10 backdrop-blur-md shadow-sm">
                    <div class="flex items-center gap-2 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="12" y1="17" x2="12" y2="22"></line>
                            <path d="M5 17h14v-1.76a2 2 0 0 0-1.11-1.79l-1.78-.9A2 2 0 0 1 15 10.76V6h1a2 2 0 0 0 0-4H8a2 2 0 0 0 0 4h1v4.76a2 2 0 0 1-1.11 1.79l-1.78.9A2 2 0 0 0 5 15.24Z"></path>
                        </svg>
                        <span class="text-xs font-bold text-primary uppercase tracking-wider">Pinned by Host</span>
                    </div>
                    <p class="text-sm font-medium leading-relaxed">
                        Welcome to {{ $room->name }}! {{ $room->description }}
                    </p>
                </div>
            </div>
            
            <!-- Chat Input -->
            <div class="p-4 border-t-2 border-border bg-background/50">
                <div class="relative">
                    <input 
                        type="text" 
                        id="chat-input" 
                        placeholder="Type your message..." 
                        class="w-full bg-background border-2 border-input rounded-full px-5 py-3 pr-12 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all"
                    >
                    <button 
                        onclick="sendMessage()" 
                        class="absolute right-2 top-1/2 -translate-y-1/2 bg-gradient-to-r from-primary to-purple-600 text-white p-2 rounded-full hover:scale-110 transition-transform"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="22" x2="11" y1="2" y2="13"/>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Gift Modal -->
<div id="gift-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm hidden">
    <div class="bg-card w-full max-w-lg p-6 rounded-2xl border border-border shadow-2xl relative">
        <button onclick="closeGiftModal()" class="absolute top-4 right-4 text-muted-foreground hover:text-foreground">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="18" x2="6" y1="6" y2="18"/>
                <line x1="6" x2="18" y1="6" y2="18"/>
            </svg>
        </button>

        <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
            <span class="text-pink-500">🎁</span> Send a Gift
        </h2>

        <div class="grid grid-cols-4 gap-4 mb-6">
            @foreach($gifts as $gift)
            <button onclick="sendGift({{ $gift->id }}, {{ $gift->price }}, '{{ $gift->name }}')" class="group relative flex flex-col items-center p-3 rounded-xl border border-border hover:border-pink-500 hover:bg-pink-500/10 transition-all">
                <div class="text-3xl mb-2 transform group-hover:scale-110 transition-transform">{{ $gift->image }}</div>
                <span class="text-xs font-medium truncate w-full text-center">{{ $gift->name }}</span>
                <div class="flex items-center gap-1 mt-1 text-xs text-yellow-500 font-bold">
                    <div class="w-4 h-4 rounded-full bg-gradient-to-br from-yellow-400 to-orange-600 flex items-center justify-center text-[8px] text-white font-bold shadow-sm">🪙</div> {{ $gift->price }}
                </div>
            </button>
            @endforeach
        </div>
        
        <div class="flex justify-between items-center pt-4 border-t border-border">
            <div class="flex items-center gap-2">
                <span class="text-sm text-muted-foreground">Balance:</span>
                <span class="font-bold text-yellow-500 flex items-center gap-1">
                    <div class="w-5 h-5 rounded-full bg-gradient-to-br from-yellow-400 to-orange-600 flex items-center justify-center text-[10px] text-white font-bold shadow-sm">🪙</div> <span id="modal-user-coins">{{ auth()->check() ? auth()->user()->coins : session('coins', 0) }}</span>
                </span>
            </div>
            <a href="{{ route('coins.index') }}" class="text-sm text-primary hover:underline">Recharge</a>
        </div>
    </div>
</div>

<script>
    function openGiftModal() {
        document.getElementById('gift-modal').classList.remove('hidden');
    }

    function closeGiftModal() {
        document.getElementById('gift-modal').classList.add('hidden');
    }

    async function sendGift(giftId, price, giftName) {
        const currentCoins = parseInt(document.getElementById('modal-user-coins').innerText);
        
        if (currentCoins < price) {
            alert('Insufficient coins! Please recharge.');
            window.location.href = "{{ route('coins.index') }}";
            return;
        }

        if (!confirm(`Send ${giftName} for ${price} coins?`)) return;

        try {
            const response = await fetch("{{ route('gifts.send') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ gift_id: giftId, room_id: {{ $room->id }} })
            });

            const data = await response.json();

            if (data.success) {
                // Update UI
                const newBalance = data.remaining_coins;
                document.getElementById('user-coins').innerText = newBalance;
                document.getElementById('modal-user-coins').innerText = newBalance;
                
                // Show message in chat
                const chatMessages = document.getElementById('chat-messages');
                const messageDiv = document.createElement('div');
                messageDiv.className = 'mb-4 text-center animate-fade-in';
                messageDiv.innerHTML = `
                    <div class="inline-block bg-gradient-to-r from-pink-500/20 to-purple-500/20 border border-pink-500/30 rounded-full px-4 py-1 text-xs text-pink-200">
                        <span class="font-bold">{{ auth()->user()->name }}</span> sent <span class="font-bold">${giftName}</span> <span class="text-lg">${data.gift_icon}</span>
                    </div>
                `;
                chatMessages.appendChild(messageDiv);
                chatMessages.scrollTop = chatMessages.scrollHeight;
                
                closeGiftModal();
            } else {
                alert(data.message);
            }
        } catch (error) {
            console.error(error);
            alert('Failed to send gift');
        }
    }
</script>

@push('scripts')
<script>
    // Mic Toggle
    function toggleMic(btn) {
        btn.classList.toggle('muted');
        const icon = btn.querySelector('svg');
        
        if (btn.classList.contains('muted')) {
            // Muted state - Red
            btn.className = 'muted p-3 rounded-full bg-red-500/10 border-2 border-red-500/30 hover:bg-red-500/20 transition-all relative group';
            icon.classList.add('text-red-500');
            icon.classList.remove('text-green-500');
            icon.innerHTML = `<line x1="1" y1="1" x2="23" y2="23"/><path d="M9 9v3a3 3 0 0 0 5.12 2.12M15 9.34V4a3 3 0 0 0-5.94-.6"/><path d="M17 16.95A7 7 0 0 1 5 12v-2m14 0v2a7 7 0 0 1-.11 1.23"/><line x1="12" y1="19" x2="12" y2="22"/><line x1="8" y1="22" x2="16" y2="22"/>`;
            
            // Update participant card mic indicator
            updateParticipantMic(false);
        } else {
            // Active state - Green
            btn.className = 'p-3 rounded-full bg-green-500/10 border-2 border-green-500/30 hover:bg-green-500/20 transition-all relative group';
            icon.classList.remove('text-red-500');
            icon.classList.add('text-green-500');
            icon.innerHTML = `<path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" x2="12" y1="19" y2="22"/>`;
            
            // Update participant card mic indicator
            updateParticipantMic(true);
        }
    }
    
    // Update user's participant card mic status
    function updateParticipantMic(micOn) {
        const myCard = document.querySelector('[data-is-me="true"]');
        if (!myCard) return;
        
        const micIndicator = myCard.querySelector('.absolute.top-2.right-2');
        const avatar = myCard.querySelector('.w-16, .sm\\:w-20');
        
        if (micIndicator) {
            if (micOn) {
                // Mic On (green, not speaking)
                micIndicator.innerHTML = `
                    <div class="p-1.5 rounded-full bg-green-500/20 border border-green-500/50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-green-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"/>
                            <path d="M19 10v2a7 7 0 0 1-14 0v-2"/>
                            <line x1="12" y1="19" x2="12" y2="22"/>
                        </svg>
                    </div>`;
                    
                // Update avatar border
                if (avatar) {
                    avatar.classList.remove('border-gray-500');
                    avatar.classList.add('border-green-500/50');
                }
            } else {
                // Mic Off (red)
                micIndicator.innerHTML = `
                    <div class="p-1.5 rounded-full bg-red-500/20 border border-red-500/50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="1" y1="1" x2="23" y2="23"/>
                            <path d="M9 9v3a3 3 0 0 0 5.12 2.12M15 9.34V4a3 3 0 0 0-5.94-.6"/>
                            <path d="M17 16.95A7 7 0 0 1 5 12v-2m14 0v2a7 7 0 0 1-.11 1.23"/>
                            <line x1="12" y1="19" x2="12" y2="22"/>
                            <line x1="8" y1="22" x2="16" y2="22"/>
                        </svg>
                    </div>`;
                    
                // Update avatar border
                if (avatar) {
                    avatar.classList.remove('border-green-500/50');
                    avatar.classList.add('border-gray-500');
                }
            }
        }
    }

    // User Chat
    document.getElementById('chat-input').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            sendMessage();
        }
    });

    function sendMessage() {
        const input = document.getElementById('chat-input');
        const message = input.value.trim();
        
        if (message) {
            const chatMessages = document.getElementById('chat-messages');
            const msgDiv = document.createElement('div');
            msgDiv.className = 'flex gap-2 animate-fade-in justify-end'; // Align right for user
            msgDiv.innerHTML = `
                <div class="flex flex-col items-end">
                    <p class="text-xs font-bold text-muted-foreground">You</p>
                    <p class="text-sm bg-primary text-primary-foreground p-2 rounded-l-lg rounded-br-lg">${message}</p>
                </div>
                <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-xs font-bold text-white shrink-0 overflow-hidden">
                    @if(auth()->check() && auth()->user()->avatar)
                        <img src="{{ auth()->user()->avatar }}" alt="You" class="w-full h-full object-cover">
                    @else
                        {{ auth()->check() ? substr(auth()->user()->name, 0, 1) : 'G' }}
                    @endif
                </div>
            `;
            
            chatMessages.appendChild(msgDiv);
            chatMessages.scrollTop = chatMessages.scrollHeight;
            input.value = '';
        }
    }
</script>
@endpush
@endsection
