@extends('layouts.admin')

@section('content')
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Payment Gateways</h2>

    <div class="max-w-4xl mx-auto">
        <form action="{{ route('admin.settings.payment-gateways.update') }}" method="POST">
            @csrf
            
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-6">
                    <h4 class="font-medium text-gray-900 mb-4">PayU Configuration</h4>
                    <div class="mb-6">
                        <label for="payu_mode" class="block text-sm font-medium text-gray-700 mb-1">Mode</label>
                        <select name="payu_mode" id="payu_mode" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border">
                            <option value="test" {{ $payuMode === 'test' ? 'selected' : '' }}>Test / Sandbox</option>
                            <option value="live" {{ $payuMode === 'live' ? 'selected' : '' }}>Live / Production</option>
                        </select>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <h5 class="font-medium text-gray-700 mb-3">Test Credentials</h5>
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-xs font-medium text-gray-500 uppercase">Key</label>
                                    <input type="text" name="payu_test_key" value="{{ $payuTestKey }}" class="mt-1 w-full rounded border-gray-300 text-sm p-2 border">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-500 uppercase">Salt</label>
                                    <input type="text" name="payu_test_salt" value="{{ $payuTestSalt }}" class="mt-1 w-full rounded border-gray-300 text-sm p-2 border">
                                </div>
                            </div>
                        </div>
                        <div class="bg-indigo-50 p-4 rounded-lg border border-indigo-100">
                            <h5 class="font-medium text-indigo-900 mb-3">Live Credentials</h5>
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-xs font-medium text-indigo-500 uppercase">Key</label>
                                    <input type="text" name="payu_live_key" value="{{ $payuLiveKey }}" class="mt-1 w-full rounded border-indigo-200 text-sm p-2 border">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-indigo-500 uppercase">Salt</label>
                                    <input type="text" name="payu_live_salt" value="{{ $payuLiveSalt }}" class="mt-1 w-full rounded border-indigo-200 text-sm p-2 border">
                                </div>
                            </div>
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
