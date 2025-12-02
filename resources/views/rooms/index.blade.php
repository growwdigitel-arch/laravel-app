@extends('layouts.app')

@section('title', 'Voice Rooms - ' . get_setting('site_title', 'ChatterGlow'))

@section('content')
<div class="min-h-screen bg-background">
    <main class="pt-20 pb-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-8">
                <h1 class="text-3xl sm:text-4xl font-bold mb-2">Voice Rooms</h1>
                <p class="text-muted-foreground text-lg">
                    Join live conversations and connect with amazing people
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-4 mb-6">
                <div class="flex items-center gap-2 bg-primary/10 text-primary px-4 py-2 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 animate-pulse" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="2"/>
                        <path d="M12 2v4m0 12v4M6.34 6.34 3.51 3.51m17.98 17.98-2.83-2.83M2 12h4m12 0h4M6.34 17.66 3.51 20.49m17.98-17.98-2.83 2.83"/>
                    </svg>
                    <span class="font-medium text-sm">{{ $rooms->where('is_live', true)->count() }} Live Rooms</span>
                </div>
                <div class="flex items-center gap-2 bg-muted px-4 py-2 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                    <span class="font-medium text-sm">{{ $rooms->sum('participant_count') }} Participants</span>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 mb-8">
                <div class="relative flex-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-muted-foreground" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"/>
                        <path d="m21 21-4.3-4.3"/>
                    </svg>
                    <input 
                        type="search" 
                        id="search-rooms"
                        placeholder="Search rooms..." 
                        class="w-full pl-10 pr-4 py-2.5 bg-input border border-border rounded-lg text-foreground placeholder-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring"
                    />
                </div>
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-muted-foreground" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
                    </svg>
                    <div class="flex flex-wrap gap-2">
                        @foreach(['all' => 'All Rooms', 'chat' => 'Chat', 'music' => 'Music', 'gaming' => 'Gaming', 'podcast' => 'Podcast', 'learning' => 'Learning'] as $catId => $catLabel)
                        <button 
                            class="category-filter px-4 py-2 text-sm font-medium rounded-lg transition-colors" 
                            data-category="{{ $catId }}"
                            data-active="{{ $catId === 'all' ? 'true' : 'false' }}"
                        >
                            {{ $catLabel }}
                        </button>
                        @endforeach
                    </div>
                </div>
            </div>

            @if($rooms->count() > 0)
            <div id="rooms-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($rooms as $room)
                <div class="room-card bg-card rounded-lg border border-border overflow-hidden hover:border-primary/50 transition-all" data-category="{{ strtolower($room->category) }}" data-name="{{ strtolower($room->name) }}" data-description="{{ strtolower($room->description ?? '') }}">
                    <div class="relative h-32 bg-gradient-to-br from-primary/20 to-purple-500/20 overflow-hidden">
                        @if($room->image)
                        <img src="{{ $room->image }}" alt="{{ $room->name }}" class="w-full h-full object-cover">
                        @endif
                        @if($room->is_live)
                        <div class="absolute top-3 right-3 flex items-center gap-1 bg-red-500 text-white px-2 py-1 rounded-full text-xs font-semibold">
                            <span class="w-2 h-2 bg-white rounded-full animate-pulse"></span>
                            LIVE
                        </div>
                        @endif
                        <!-- India Flag -->
                        <div class="absolute bottom-2 left-2 text-lg">🇮🇳</div>
                    </div>

                    <div class="p-4">
                        <div class="flex items-start justify-between mb-2">
                            <h3 class="font-semibold text-lg">{{ $room->name }}</h3>
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-primary/10 text-primary capitalize">
                                {{ $room->category }}
                            </span>
                        </div>

                        <p class="text-sm text-muted-foreground mb-4 line-clamp-2">
                            {{ $room->description ?? 'Join this room for great conversations!' }}
                        </p>

                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-primary/20 p-0.5">
                                    <img 
                                        src="{{ $room->host_avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($room->host_name) . '&background=random&color=fff' }}" 
                                        alt="{{ $room->host_name }}" 
                                        class="w-full h-full object-cover rounded-full"
                                        onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($room->host_name) }}&background=random&color=fff';"
                                    >
                                </div>
                                <div>
                                    <p class="text-[10px] uppercase tracking-wider text-muted-foreground font-bold">Host</p>
                                    <p class="font-bold text-sm leading-tight">{{ $room->host_name }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-1 text-muted-foreground text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                    <circle cx="9" cy="7" r="4"/>
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                </svg>
                                <span>{{ $room->participant_count }}</span>
                            </div>
                        </div>

                        @auth
                        <a href="{{ route('rooms.show', $room->id) }}" class="w-full block text-center bg-primary text-primary-foreground font-bold py-2 rounded-lg hover:opacity-90 transition-opacity">
                            Join Room
                        </a>
                        @else
                        <button onclick="document.getElementById('auth-modal').classList.remove('hidden')" class="w-full block text-center bg-primary text-primary-foreground font-bold py-2 rounded-lg hover:opacity-90 transition-opacity">
                            Join Room
                        </button>
                        @endauth
                    </div>
                </div>
                @endforeach
            </div>

            <div id="no-results" class="hidden text-center py-16">
                <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-muted flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-muted-foreground" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="2"/>
                        <path d="M12 2v4m0 12v4M6.34 6.34 3.51 3.51m17.98 17.98-2.83-2.83M2 12h4m12 0h4M6.34 17.66 3.51 20.49m17.98-17.98-2.83 2.83"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">No rooms found</h3>
                <p class="text-muted-foreground mb-6">
                    Try adjusting your search or filters
                </p>
            </div>
            @else
            <div class="text-center py-16">
                <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-muted flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-muted-foreground" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="2"/>
                        <path d="M12 2v4m0 12v4M6.34 6.34 3.51 3.51m17.98 17.98-2.83-2.83M2 12h4m12 0h4M6.34 17.66 3.51 20.49m17.98-17.98-2.83 2.83"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">No rooms available</h3>
                <p class="text-muted-foreground mb-6">
                    Be the first to create a room!
                </p>
            </div>
            @endif
        </div>
    </main>
</div>

@push('scripts')
<script>
    // Filter functionality
    const searchInput = document.getElementById('search-rooms');
    const categoryButtons = document.querySelectorAll('.category-filter');
    const roomCards = document.querySelectorAll('.room-card');
    const noResults = document.getElementById('no-results');
    const roomsGrid = document.getElementById('rooms-grid');

    let currentCategory = 'all';
    let currentSearch = '';

    function filterRooms() {
        let visibleCount = 0;

        roomCards.forEach(card => {
            const cardCategory = card.dataset.category;
            const cardName = card.dataset.name;
            const cardDescription = card.dataset.description;
            
            const matchesCategory = currentCategory === 'all' || cardCategory === currentCategory;
            const matchesSearch = currentSearch === '' || 
                cardName.includes(currentSearch.toLowerCase()) || 
                cardDescription.includes(currentSearch.toLowerCase());

            if (matchesCategory && matchesSearch) {
                card.classList.remove('hidden');
                visibleCount++;
            } else {
                card.classList.add('hidden');
            }
        });

        if (visibleCount === 0) {
            roomsGrid.classList.add('hidden');
            noResults.classList.remove('hidden');
        } else {
            roomsGrid.classList.remove('hidden');
            noResults.classList.add('hidden');
        }
    }

    // Update category filter button styles
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

    // Search input
    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            currentSearch = e.target.value;
            filterRooms();
        });
    }

    // Category buttons
    categoryButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            currentCategory = btn.dataset.category;
            updateCategoryButtons();
            filterRooms();
        });
    });

    // Initialize
    updateCategoryButtons();
</script>
@endpush
@push('scripts')
<script>
    // Shuffle rooms every 5 seconds to simulate "looply change position"
    const roomGrid = document.querySelector('.grid');
    
    function shuffleRooms() {
        const rooms = Array.from(roomGrid.children);
        if (rooms.length <= 1) return;

        // Simple shuffle: move first to last
        const firstRoom = rooms[0];
        
        // Add fade out effect
        firstRoom.style.opacity = '0';
        firstRoom.style.transform = 'scale(0.9)';
        
        setTimeout(() => {
            roomGrid.appendChild(firstRoom);
            
            // Reset styles for fade in
            setTimeout(() => {
                firstRoom.style.opacity = '1';
                firstRoom.style.transform = 'scale(1)';
            }, 50);
        }, 300);
    }

    setInterval(shuffleRooms, 5000); // Change position every 5 seconds
</script>
@endpush
@endsection
