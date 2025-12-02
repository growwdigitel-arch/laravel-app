@extends('layouts.app')

@section('title', 'Virtual Gifts - ' . get_setting('site_title', 'ChatterGlow'))

@section('content')
<div class="min-h-screen bg-background">
    <main class="pt-20 pb-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-8">
                <h1 class="text-3xl sm:text-4xl font-bold mb-2">Virtual Gifts</h1>
                <p class="text-muted-foreground text-lg">
                    Express appreciation and support your favorite creators with beautiful virtual gifts
                </p>
            </div>

            @if($gifts->whereIn('is_featured', [true, 1])->count() > 0)
            <div class="mb-12">
                <h2 class="text-2xl font-bold mb-6">Featured Gifts</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                    @foreach($gifts->where('is_featured', true) as $gift)
                    <div class="bg-card rounded-xl border border-border p-4 hover:border-primary/50 transition-all hover:scale-105 cursor-pointer">
                        <div class="aspect-square mb-3 bg-gradient-to-br from-primary/10 to-purple-500/10 rounded-lg flex items-center justify-center text-4xl">
                            @if($gift->image && str_contains($gift->image, 'http'))
                            <img src="{{ $gift->image }}" alt="{{ $gift->name }}" class="w-full h-full object-cover rounded-lg">
                            @else
                            {{ $gift->image ?? '🎁' }}
                            @endif
                        </div>
                        <p class="font-semibold text-sm text-center mb-1">{{ $gift->name }}</p>
                        <p class="text-primary text-center font-bold text-sm">${{ number_format($gift->price, 2) }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="mb-6">
                <h2 class="text-2xl font-bold mb-6">All Gifts</h2>
                <div class="flex flex-wrap gap-2 mb-6">
                    @php
                        $categories = $gifts->pluck('category')->unique()->sort();
                    @endphp
                    <button class="gift-category-filter px-4 py-2 text-sm font-medium rounded-lg bg-primary text-primary-foreground" data-category="all">
                        All
                    </button>
                    @foreach($categories as $category)
                    <button class="gift-category-filter px-4 py-2 text-sm font-medium rounded-lg bg-transparent border border-border hover:bg-accent" data-category="{{ $category }}">
                        {{ ucfirst($category) }}
                    </button>
                    @endforeach
                </div>
            </div>

            @if($gifts->count() > 0)
            <div id="gifts-grid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                @foreach($gifts as $gift)
                <div class="gift-card bg-card rounded-xl border border-border p-4 hover:border-primary/50 transition-all hover:scale-105 cursor-pointer" data-category="{{ $gift->category }}" data-gift-id="{{ $gift->id }}">
                    <div class="aspect-square mb-3 bg-gradient-to-br from-primary/10 to-purple-500/10 rounded-lg flex items-center justify-center text-5xl">
                        @if($gift->image && str_contains($gift->image, 'http'))
                        <img src="{{ $gift->image }}" alt="{{ $gift->name }}" class="w-full h-full object-cover rounded-lg">
                        @else
                        {{ $gift->image ?? '🎁' }}
                        @endif
                    </div>
                    <p class="font-semibold text-sm mb-1">{{ $gift->name }}</p>
                    @if($gift->description)
                    <p class="text-xs text-muted-foreground mb-2 line-clamp-2">{{ $gift->description }}</p>
                    @endif
                    <div class="flex items-center justify-between">
                        <p class="text-primary font-bold">${{ number_format($gift->price, 2) }}</p>
                        <button class="send-gift-btn px-3 py-1 bg-primary text-primary-foreground text-xs font-semibold rounded-full hover:opacity-90 transition-opacity">
                            Send
                        </button>
                    </div>
                </div>
                @endforeach
            </div>

            <div id="no-gifts" class="hidden text-center py-16">
                <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-muted flex items-center justify-center text-4xl">
                    🎁
                </div>
                <h3 class="text-xl font-semibold mb-2">No gifts found</h3>
                <p class="text-muted-foreground">
                    Try selecting a different category
                </p>
            </div>
            @else
            <div class="text-center py-16">
                <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-muted flex items-center justify-center text-4xl">
                    🎁
                </div>
                <h3 class="text-xl font-semibold mb-2">No gifts available</h3>
                <p class="text-muted-foreground mb-6">
                    Check back soon for new gifts!
                </p>
            </div>
            @endif

            <!-- Gift Info Section -->
            <div class="mt-16 bg-gradient-to-br from-primary/10 to-purple-500/10 rounded-2xl p-8 border border-primary/20">
                <h2 class="text-2xl font-bold mb-4 text-center">How Virtual Gifts Work</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                    <div class="text-center">
                        <div class="w-16 h-16 mx-auto mb-4 bg-primary/20 rounded-full flex items-center justify-center text-3xl">
                            🎯
                        </div>
                        <h3 class="font-semibold mb-2">Choose a Gift</h3>
                        <p class="text-sm text-muted-foreground">Browse our collection of unique virtual gifts</p>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 mx-auto mb-4 bg-primary/20 rounded-full flex items-center justify-center text-3xl">
                            💝
                        </div>
                        <h3 class="font-semibold mb-2">Send to Creator</h3>
                        <p class="text-sm text-muted-foreground">Show appreciation to your favorite room hosts</p>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 mx-auto mb-4 bg-primary/20 rounded-full flex items-center justify-center text-3xl">
                            ⭐
                        </div>
                        <h3 class="font-semibold mb-2">Support Creators</h3>
                        <p class="text-sm text-muted-foreground">Help creators continue making great content</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

@push('scripts')
<script>
    const categoryButtons = document.querySelectorAll('.gift-category-filter');
    const giftCards = document.querySelectorAll('.gift-card');
    const giftsGrid = document.getElementById('gifts-grid');
    const noGifts = document.getElementById('no-gifts');
    
    let currentCategory = 'all';
    
    function filterGifts() {
        let visibleCount = 0;
        
        giftCards.forEach(card => {
            const cardCategory = card.dataset.category;
            const matches = currentCategory === 'all' || cardCategory === currentCategory;
            
            if (matches) {
                card.classList.remove('hidden');
                visibleCount++;
            } else {
                card.classList.add('hidden');
            }
        });
        
        if (visibleCount === 0 && giftsGrid) {
            giftsGrid.classList.add('hidden');
            noGifts.classList.remove('hidden');
        } else if (giftsGrid) {
            giftsGrid.classList.remove('hidden');
            noGifts.classList.add('hidden');
        }
    }
    
    function updateCategoryButtons() {
        categoryButtons.forEach(btn => {
            const isActive = btn.dataset.category === currentCategory;
            if (isActive) {
                btn.classList.add('bg-primary', 'text-primary-foreground');
                btn.classList.remove('bg-transparent', 'border', 'border-border', 'hover:bg-accent');
            } else {
                btn.classList.remove('bg-primary', 'text-primary-foreground');
                btn.classList.add('bg-transparent', 'border', 'border-border', 'hover:bg-accent');
            }
        });
    }
    
    categoryButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            currentCategory = btn.dataset.category;
            updateCategoryButtons();
            filterGifts();
        });
    });
    
    // Send gift button
    document.querySelectorAll('.send-gift-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            const giftCard = btn.closest('.gift-card');
            const giftId = giftCard.dataset.giftId;
            
            // Here you would show a modal or navigate to payment
            alert('Gift sending feature coming soon! Gift ID: ' + giftId);
        });
    });
</script>
@endpush
@endsection
