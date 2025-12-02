@auth
<div id="profile-modal" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/90 backdrop-blur-md hidden">
    <div class="bg-card w-full max-w-2xl p-0 rounded-2xl border border-border shadow-2xl relative overflow-hidden flex flex-col max-h-[90vh]">
        <!-- Header -->
        <div class="p-6 border-b border-border flex justify-between items-center bg-muted/20">
            <h2 class="text-2xl font-bold">My Profile</h2>
            <button onclick="closeProfileModal()" class="text-muted-foreground hover:text-foreground">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" x2="6" y1="6" y2="18"/>
                    <line x1="6" x2="18" y1="6" y2="18"/>
                </svg>
            </button>
        </div>

        <!-- Tabs -->
        <div class="flex border-b border-border">
            <button onclick="switchTab('edit')" id="tab-edit" class="flex-1 py-3 text-sm font-medium border-b-2 border-primary text-primary transition-colors">
                Edit Profile
            </button>
            <button onclick="switchTab('history')" id="tab-history" class="flex-1 py-3 text-sm font-medium border-b-2 border-transparent text-muted-foreground hover:text-foreground transition-colors">
                Recharge History
            </button>
        </div>

        <!-- Content -->
        <div class="flex-1 overflow-y-auto p-6">
            <!-- Edit Profile Tab -->
            <div id="content-edit" class="space-y-6">
                <!-- Avatar Selector -->
                <div>
                    <label class="block text-sm font-medium mb-3">Choose Character</label>
                    <div class="grid grid-cols-4 sm:grid-cols-6 gap-3">
                        @php
                            $seeds = ['Felix', 'Aneka', 'Zoe', 'Jack', 'Bella', 'Leo', 'Mia', 'Max', 'Luna', 'Oliver', 'Chloe', 'Noah'];
                        @endphp
                        @foreach($seeds as $seed)
                        @php $avatarUrl = 'https://api.dicebear.com/7.x/avataaars/svg?seed=' . $seed; @endphp
                        <button onclick="selectAvatar('{{ $avatarUrl }}')" class="avatar-btn relative rounded-xl overflow-hidden border-2 transition-all {{ (auth()->user()->avatar == $avatarUrl) ? 'border-primary ring-2 ring-primary/50' : 'border-transparent hover:border-primary/50' }}" data-avatar="{{ $avatarUrl }}">
                            <img src="{{ $avatarUrl }}" alt="{{ $seed }}" class="w-full h-auto bg-muted/50">
                            @if(auth()->user()->avatar == $avatarUrl)
                            <div class="absolute inset-0 bg-primary/20 flex items-center justify-center">
                                <svg class="w-6 h-6 text-white drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            @endif
                        </button>
                        @endforeach
                    </div>
                    <input type="hidden" id="profile-avatar" value="{{ auth()->user()->avatar }}">
                </div>

                <!-- Name Input -->
                <div>
                    <label class="block text-sm font-medium mb-2">Display Name</label>
                    <input type="text" id="profile-name" value="{{ auth()->user()->name }}" class="w-full bg-background border border-input rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary outline-none">
                </div>

                <button onclick="saveProfile()" id="save-profile-btn" class="w-full bg-primary text-primary-foreground font-bold py-3 rounded-lg hover:opacity-90 transition-opacity">
                    Save Changes
                </button>
            </div>

            <!-- History Tab -->
            <div id="content-history" class="hidden space-y-4">
                @php
                    $transactions = \App\Models\Transaction::where('user_id', auth()->id())->latest()->get();
                @endphp

                @if($transactions->count() > 0)
                    @foreach($transactions as $txn)
                    <div class="flex items-center justify-between p-4 rounded-xl bg-muted/30 border border-border">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full {{ $txn->status == 'failed' ? 'bg-red-500/20 text-red-500' : ($txn->type == 'credit' ? 'bg-green-500/20 text-green-500' : 'bg-blue-500/20 text-blue-500') }} flex items-center justify-center">
                                @if($txn->status == 'failed')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                @elseif($txn->type == 'credit')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                @else
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                @endif
                            </div>
                            <div>
                                <p class="font-bold text-sm">
                                    @if($txn->status == 'failed')
                                        Payment Failed
                                    @elseif($txn->description == 'Welcome Bonus' || $txn->description == 'Free Credit by Company')
                                        Free Credit by {{ get_setting('site_title', 'ChatterGlow') }}
                                    @elseif($txn->type == 'credit')
                                        Successful Payment
                                    @else
                                        {{ $txn->description ?? 'Spent' }}
                                    @endif
                                </p>
                                <p class="text-xs text-muted-foreground">{{ $txn->created_at->format('d M Y, h:i A') }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-bold {{ $txn->status == 'failed' ? 'text-red-500' : ($txn->type == 'credit' ? 'text-green-500' : 'text-red-500') }}">
                                {{ $txn->type == 'credit' ? '+' : '-' }}{{ $txn->coins }}
                            </p>
                            <span class="text-xs text-muted-foreground">Coins</span>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="text-center py-12 text-muted-foreground">
                        <p>No transactions yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    function openProfileModal() {
        document.getElementById('profile-modal').classList.remove('hidden');
    }

    function closeProfileModal() {
        document.getElementById('profile-modal').classList.add('hidden');
    }

    function switchTab(tab) {
        const tabs = ['edit', 'history'];
        tabs.forEach(t => {
            const btn = document.getElementById(`tab-${t}`);
            const content = document.getElementById(`content-${t}`);
            
            if (t === tab) {
                btn.classList.add('border-primary', 'text-primary');
                btn.classList.remove('border-transparent', 'text-muted-foreground');
                content.classList.remove('hidden');
            } else {
                btn.classList.remove('border-primary', 'text-primary');
                btn.classList.add('border-transparent', 'text-muted-foreground');
                content.classList.add('hidden');
            }
        });
    }

    function selectAvatar(url) {
        // Update hidden input
        const input = document.getElementById('profile-avatar');
        if(input) input.value = url;
        
        // Update visual selection
        document.querySelectorAll('.avatar-btn').forEach(btn => {
            btn.classList.remove('border-primary', 'ring-2', 'ring-primary/50');
            btn.classList.add('border-transparent');
            btn.querySelector('.check-overlay')?.remove(); // Remove checkmark overlay
            
            if (btn.dataset.avatar === url) {
                btn.classList.remove('border-transparent');
                btn.classList.add('border-primary', 'ring-2', 'ring-primary/50');
                // Add checkmark overlay
                const overlay = document.createElement('div');
                overlay.className = 'check-overlay absolute inset-0 bg-primary/20 flex items-center justify-center';
                overlay.innerHTML = '<svg class="w-6 h-6 text-white drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>';
                btn.appendChild(overlay);
            }
        });
    }

    async function saveProfile() {
        const name = document.getElementById('profile-name').value;
        const avatar = document.getElementById('profile-avatar').value;
        const btn = document.getElementById('save-profile-btn');

        if (!name) return alert('Name is required');

        btn.disabled = true;
        btn.innerText = 'Saving...';

        try {
            const response = await fetch("{{ route('auth.update-profile') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ name, avatar })
            });

            const data = await response.json();

            if (data.success) {
                window.location.reload();
            } else {
                alert(data.message);
            }
        } catch (error) {
            console.error(error);
            alert('Something went wrong');
        } finally {
            btn.disabled = false;
            btn.innerText = 'Save Changes';
        }
    }
</script>
@endauth
