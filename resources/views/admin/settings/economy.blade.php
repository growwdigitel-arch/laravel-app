@extends('layouts.admin')

@section('content')
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Economy & Currency</h2>

    <div class="max-w-4xl mx-auto">
        <form action="{{ route('admin.settings.economy.update') }}" method="POST">
            @csrf
            
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="coins_per_rupee" class="block text-sm font-medium text-gray-700 mb-1">Coin Exchange Rate</label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <span class="text-gray-500 sm:text-sm">₹1 =</span>
                                </div>
                                <input type="number" name="coins_per_rupee" id="coins_per_rupee" value="{{ $coinsPerRupee ?? 1 }}" min="0.1" step="0.1" class="block w-full rounded-md border-gray-300 pl-12 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border" placeholder="1">
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                    <span class="text-gray-500 sm:text-sm">Coins</span>
                                </div>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">How many coins a user gets for 1 Rupee</p>
                        </div>
                        <div>
                            <label for="min_recharge_amount" class="block text-sm font-medium text-gray-700 mb-1">Minimum Recharge (₹)</label>
                            <input type="number" name="min_recharge_amount" id="min_recharge_amount" value="{{ $minRechargeAmount ?? 100 }}" min="1" step="1" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border">
                        </div>
                        <div>
                            <label for="max_recharge_amount" class="block text-sm font-medium text-gray-700 mb-1">Maximum Recharge (₹)</label>
                            <input type="number" name="max_recharge_amount" id="max_recharge_amount" value="{{ $maxRechargeAmount ?? 50000 }}" min="1" step="1" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border">
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50 text-right">
                    <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 font-medium shadow-sm transition-all">
                        Save Changes
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
