@extends('layouts.app')

@section('title', 'Coin Store - ' . get_setting('site_title', 'ChatterGlow'))

@section('content')
<div class="min-h-screen bg-background pt-24 pb-12 px-4">
    <div class="max-w-4xl mx-auto space-y-6">
        
        <!-- Header Card -->
        <div class="bg-card border border-border rounded-xl p-6 shadow-sm">
            <h1 class="text-xl font-bold mb-2">Fully Protected Payments</h1>
            <p class="text-sm text-muted-foreground">Your Details Are Secure with Our Trusted Payment Partners.</p>
        </div>

        <!-- Main Content Card -->
        <div class="bg-card border border-border rounded-xl p-6 shadow-sm">
            <h2 class="text-lg font-bold mb-4">Fully Protected Payments</h2>
            
            <!-- Balance -->
            <div class="flex items-center gap-2 mb-6">
                <span class="font-bold">Balance:</span>
                <div class="w-6 h-6 rounded-full bg-gradient-to-br from-yellow-400 to-orange-600 flex items-center justify-center text-[10px] text-white font-bold shadow-sm">🪙</div>
                <span class="font-bold">{{ auth()->check() ? auth()->user()->coins : session('coins', 0) }}</span>
            </div>

            <!-- Custom Price -->
            <div class="flex items-center gap-4 mb-8">
                <span class="font-bold text-sm">Custom price:</span>
                <div class="flex items-center gap-2">
                    <span class="text-lg font-bold">₹</span>
                    <input type="number" id="custom-amount" value="{{ get_setting('min_recharge_amount', 100) }}" placeholder="Enter amount" min="{{ get_setting('min_recharge_amount', 100) }}" class="w-32 bg-background border border-input rounded px-3 py-1.5 font-bold focus:ring-2 focus:ring-primary outline-none" oninput="updateCustomAmount(this.value)">
                </div>
            </div>

            <p class="text-xs text-muted-foreground mb-2">Maximum limit per transaction: ₹{{ number_format(get_setting('max_recharge_amount', 50000)) }}</p>
            
            <!-- Validation Error -->
            <div id="amount-error" class="text-red-500 text-sm font-medium mb-4 hidden"></div>

            <!-- Packages Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <!-- Package 1 -->
                <button onclick="selectPackage(20, 1)" class="package-btn group relative bg-muted/30 border border-border rounded-xl p-4 flex flex-col items-center justify-center hover:border-primary hover:bg-accent transition-all" data-amount="1">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-yellow-400 to-orange-600 flex items-center justify-center text-sm text-white font-bold shadow-sm mb-2">🪙</div>
                    <span class="text-xl font-bold">20</span>
                    <span class="text-sm font-bold">₹1</span>
                </button>

                <!-- Package 2 -->
                <button onclick="selectPackage(2500, 99)" class="package-btn group relative bg-muted/30 border border-border rounded-xl p-4 flex flex-col items-center justify-center hover:border-primary hover:bg-accent transition-all" data-amount="99">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-yellow-400 to-orange-600 flex items-center justify-center text-sm text-white font-bold shadow-sm mb-2">🪙</div>
                    <span class="text-xl font-bold">2500</span>
                    <span class="text-sm font-bold">₹99</span>
                </button>

                <!-- Package 3 -->
                <button onclick="selectPackage(8000, 299)" class="package-btn group relative bg-muted/30 border border-border rounded-xl p-4 flex flex-col items-center justify-center hover:border-primary hover:bg-accent transition-all" data-amount="299">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-yellow-400 to-orange-600 flex items-center justify-center text-sm text-white font-bold shadow-sm mb-2">🪙</div>
                    <span class="text-xl font-bold">8000</span>
                    <span class="text-sm font-bold">₹299</span>
                </button>

                <!-- Package 4 -->
                <button onclick="selectPackage(28000, 999)" class="package-btn group relative bg-muted/30 border border-border rounded-xl p-4 flex flex-col items-center justify-center hover:border-primary hover:bg-accent transition-all" data-amount="999">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-yellow-400 to-orange-600 flex items-center justify-center text-sm text-white font-bold shadow-sm mb-2">🪙</div>
                    <span class="text-xl font-bold">28000</span>
                    <span class="text-sm font-bold">₹999</span>
                </button>
                
                 <!-- Package 5 -->
                 <button onclick="selectPackage(45000, 1499)" class="package-btn group relative bg-muted/30 border border-border rounded-xl p-4 flex flex-col items-center justify-center hover:border-primary hover:bg-accent transition-all col-span-1 md:col-span-2 lg:col-span-1" data-amount="1499">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-yellow-400 to-orange-600 flex items-center justify-center text-sm text-white font-bold shadow-sm mb-2">🪙</div>
                    <span class="text-xl font-bold">45000</span>
                    <span class="text-sm font-bold">₹1499</span>
                </button>
            </div>

            <!-- Pay Now Button -->
            <div class="flex justify-center">
                <form id="payment-form" action="{{ route('payment.initiate') }}" method="POST" class="w-full max-w-md">
                    @csrf
                    <input type="hidden" name="amount" id="form-amount" value="1">
                    <input type="hidden" name="coins" id="form-coins" value="20">
                    <button type="button" id="pay-btn" onclick="submitPayment()" class="w-full bg-pink-400 hover:bg-pink-500 text-black font-bold py-3 rounded-lg transition-colors flex items-center justify-center gap-2">
                        <span>Pay Now</span>
                        <span class="text-xl">→</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const minRechargeAmount = {{ get_setting('min_recharge_amount', 100) }};
    const maxRechargeAmount = {{ get_setting('max_recharge_amount', 50000) }};
    
    let selectedAmount = 1;
    let selectedCoins = 20;

    function showError(message) {
        const errorDiv = document.getElementById('amount-error');
        errorDiv.textContent = message;
        errorDiv.classList.remove('hidden');
    }

    function clearError() {
        const errorDiv = document.getElementById('amount-error');
        errorDiv.textContent = '';
        errorDiv.classList.add('hidden');
    }

    function selectPackage(coins, amount) {
        clearError();
        
        selectedAmount = amount;
        selectedCoins = coins;
        
        document.getElementById('form-amount').value = amount;
        document.getElementById('form-coins').value = coins;
        document.getElementById('custom-amount').value = ''; // Clear custom input

        // Visual update
        document.querySelectorAll('.package-btn').forEach(btn => {
            btn.classList.remove('border-2', 'border-primary', 'bg-background');
            btn.classList.add('bg-muted/30', 'border-border');
        });
        
        const clickedBtn = event.currentTarget;
        clickedBtn.classList.remove('bg-muted/30', 'border-border');
        clickedBtn.classList.add('border-2', 'border-primary', 'bg-background');
    }

    function updateCustomAmount(amount) {
        if (!amount || amount < 1) {
            return; 
        }
        
        amount = parseFloat(amount);
        
        // Validate against limits
        if (amount < minRechargeAmount) {
            showError(`Minimum recharge amount is ₹${minRechargeAmount}`);
            return;
        }
        
        if (amount > maxRechargeAmount) {
            showError(`Maximum recharge amount is ₹${maxRechargeAmount}`);
            return;
        }
        
        clearError();
        
        // Logic: 20 coins per ₹1
        const coins = Math.floor(amount * 20);
        
        selectedAmount = amount;
        selectedCoins = coins;
        
        document.getElementById('form-amount').value = amount;
        document.getElementById('form-coins').value = coins;
        
        // Deselect all packages
        document.querySelectorAll('.package-btn').forEach(btn => {
            btn.classList.remove('border-2', 'border-primary', 'bg-background');
            btn.classList.add('bg-muted/30', 'border-border');
        });
    }

    function submitPayment() {
        const amount = parseFloat(document.getElementById('form-amount').value);
        
        if (!amount || amount < 1) {
            showError('Please select a package or enter a valid amount');
            return;
        }
        
        // Validate against limits
        if (amount < minRechargeAmount) {
            showError(`Minimum recharge amount is ₹${minRechargeAmount}`);
            return;
        }
        
        if (amount > maxRechargeAmount) {
            showError(`Maximum recharge amount is ₹${maxRechargeAmount}`);
            return;
        }

        @auth
            document.getElementById('payment-form').submit();
        @else
            document.getElementById('auth-modal').classList.remove('hidden');
        @endauth
    }
</script>
@endpush
@endsection
