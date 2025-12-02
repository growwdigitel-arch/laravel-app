@extends('layouts.app')

@section('title', 'Payment Successful - ' . get_setting('site_title', 'ChatterGlow'))

@section('content')
<div class="min-h-screen bg-background flex items-center justify-center px-4 py-12 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-card p-8 rounded-2xl border border-border shadow-lg text-center">
        <div class="flex justify-center">
            <div class="w-20 h-20 bg-green-500/10 rounded-full flex items-center justify-center animate-bounce">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-green-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
            </div>
        </div>
        
        <div>
            <h2 class="mt-2 text-3xl font-extrabold text-foreground">Payment Successful!</h2>
            <p class="mt-2 text-sm text-muted-foreground">
                Your transaction has been completed successfully.
            </p>
        </div>

        <div class="bg-muted/30 rounded-lg p-4 space-y-3 border border-border">
            <div class="flex justify-between text-sm">
                <span class="text-muted-foreground">Transaction ID</span>
                <span class="font-mono font-medium">{{ $transaction->txnid }}</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-muted-foreground">Amount Paid</span>
                <span class="font-bold">₹{{ $transaction->amount }}</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-muted-foreground">Coins Added</span>
                <span class="font-bold text-yellow-500 flex items-center gap-1">
                    {{ $transaction->coins }} 🪙
                </span>
            </div>
            <div class="border-t border-border pt-2 flex justify-between text-sm">
                <span class="text-muted-foreground">New Balance</span>
                <span class="font-bold text-yellow-500 flex items-center gap-1">
                    {{ auth()->user()->coins }} 🪙
                </span>
            </div>
        </div>

        <div class="flex flex-col gap-3">
            <a href="{{ route('rooms.index') }}" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-primary-foreground bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">
                Join a Room
            </a>
            <a href="{{ route('coins.index') }}" class="w-full flex justify-center py-3 px-4 border border-border rounded-lg shadow-sm text-sm font-medium text-foreground bg-background hover:bg-accent focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">
                Back to Wallet
            </a>
        </div>
    </div>
</div>
@endsection
