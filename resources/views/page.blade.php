@extends('layouts.app')

@section('title', $title . ' - ' . get_setting('site_title', 'ChatterGlow'))

@section('content')
<div class="min-h-screen bg-background py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-card border border-border rounded-2xl p-8 md:p-12 shadow-xl">
            <h1 class="text-3xl md:text-4xl font-bold mb-8 text-foreground border-b border-border pb-4">{{ $title }}</h1>
            
            <div class="prose prose-invert max-w-none text-muted-foreground">
                @if($content)
                    {!! nl2br(e($content)) !!}
                @else
                    <p>No content available.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
