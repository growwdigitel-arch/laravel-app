@extends('layouts.app')

@section('title', 'Payment Failed - ' . get_setting('site_title', 'ChatterGlow'))

@section('content')
<div class="min-h-screen bg-background flex items-center justify-center px-4 py-12 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-card p-8 rounded-2xl border border-border shadow-lg text-center">
        <div class="flex justify-center">
            <div class="w-20 h-20 bg-red-500/10 rounded-full flex items-center justify-center animate-pulse">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </div>
        </div>
        
        <div>
            <h2 class="mt-2 text-3xl font-extrabold text-foreground">Payment Failed</h2>
            <p class="mt-2 text-sm text-muted-foreground">
                We couldn't process your transaction. Please try again.
            </p>
        </div>

        @if(isset($transaction))
        <div class="bg-muted/30 rounded-lg p-4 space-y-3 border border-border">
            <div class="flex justify-between text-sm">
                <span class="text-muted-foreground">Transaction ID</span>
                <span class="font-mono font-medium">{{ $transaction->txnid }}</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-muted-foreground">Attempted Amount</span>
                <span class="font-bold">₹{{ $transaction->amount }}</span>
            </div>
        </div>
        @endif

        <div class="flex flex-col gap-3">
            <a href="{{ route('coins.index') }}" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                Try Again
            </a>
            <a href="{{ route('home') }}" class="w-full flex justify-center py-3 px-4 border border-border rounded-lg shadow-sm text-sm font-medium text-foreground bg-background hover:bg-accent focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">
                Back to Home
            </a>
        </div>
    </div>
</div>
@endsection
