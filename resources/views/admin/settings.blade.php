@extends('layouts.admin')

@section('content')
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Settings</h2>

    <div class="bg-white shadow-md rounded-lg p-6 max-w-4xl">
        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Site Identity -->
            <div class="mb-8 border-b pb-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Site Identity</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="site_title" class="block text-sm font-medium text-gray-700 mb-1">Site Title</label>
                        <input type="text" name="site_title" id="site_title" value="{{ $siteTitle }}" 
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border"
                            placeholder="e.g. MyVoiceApp">
                    </div>

                    <div>
                        <label for="site_logo" class="block text-sm font-medium text-gray-700 mb-1">Site Logo</label>
                        <input type="file" name="site_logo" id="site_logo" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        @if($siteLogo)
                            <div class="mt-2">
                                <img src="{{ asset($siteLogo) }}" alt="Current Logo" class="h-12 w-auto object-contain">
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Legal Pages -->
            <div class="mb-8 border-b pb-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Legal Pages</h3>
                
                <div class="mb-6">
                    <label for="privacy_policy" class="block text-sm font-medium text-gray-700 mb-1">Privacy Policy</label>
                    <textarea name="privacy_policy" id="privacy_policy" rows="6" 
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border"
                        placeholder="Enter Privacy Policy content here...">{{ $privacyPolicy }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="terms_of_service" class="block text-sm font-medium text-gray-700 mb-1">Terms of Service</label>
                    <textarea name="terms_of_service" id="terms_of_service" rows="6" 
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border"
                        placeholder="Enter Terms of Service content here...">{{ $termsOfService }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="refund_policy" class="block text-sm font-medium text-gray-700 mb-1">Refund and Cancellation Policy</label>
                    <textarea name="refund_policy" id="refund_policy" rows="6" 
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border"
                        placeholder="Enter Refund Policy content here...">{{ $refundPolicy }}</textarea>
                </div>
            </div>

            <!-- Footer Links -->
            <div class="mb-8 border-b pb-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Footer Links</h3>
                <div class="mb-4">
                    <label for="footer_links" class="block text-sm font-medium text-gray-700 mb-1">Links (JSON Format)</label>
                    <textarea name="footer_links" id="footer_links" rows="4" 
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border"
                        placeholder='[{"text": "Privacy Policy", "url": "/privacy"}, {"text": "Terms", "url": "/terms"}]'>{{ $footerLinks }}</textarea>
                    <p class="mt-1 text-xs text-gray-500">Enter links as a JSON array of objects with "text" and "url" properties.</p>
                </div>

                <div class="mb-4">
                    <label for="footer_get_in_touch" class="block text-sm font-medium text-gray-700 mb-1">Get in Touch Text</label>
                    <textarea name="footer_get_in_touch" id="footer_get_in_touch" rows="3" 
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border"
                        placeholder="Enter footer contact text here...">{{ $footerGetInTouch }}</textarea>
                </div>
            </div>

            <!-- Payment Configuration -->
            <div class="mb-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Payment Gateway (PayU)</h3>
                
                <div class="mb-6">
                    <label for="payu_mode" class="block text-sm font-medium text-gray-700 mb-1">Mode</label>
                    <select name="payu_mode" id="payu_mode" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border">
                        <option value="test" {{ $payuMode === 'test' ? 'selected' : '' }}>Test / Sandbox</option>
                        <option value="live" {{ $payuMode === 'live' ? 'selected' : '' }}>Live / Production</option>
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Test Credentials -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <h4 class="font-medium text-gray-700 mb-3">Test Credentials</h4>
                        <div class="mb-4">
                            <label for="payu_test_key" class="block text-sm font-medium text-gray-700 mb-1">Test Key</label>
                            <input type="text" name="payu_test_key" id="payu_test_key" value="{{ $payuTestKey }}" 
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border">
                        </div>
                        <div class="mb-4">
                            <label for="payu_test_salt" class="block text-sm font-medium text-gray-700 mb-1">Test Salt</label>
                            <input type="text" name="payu_test_salt" id="payu_test_salt" value="{{ $payuTestSalt }}" 
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border">
                        </div>
                    </div>

                    <!-- Live Credentials -->
                    <div class="bg-indigo-50 p-4 rounded-lg border border-indigo-100">
                        <h4 class="font-medium text-indigo-900 mb-3">Live Credentials</h4>
                        <div class="mb-4">
                            <label for="payu_live_key" class="block text-sm font-medium text-gray-700 mb-1">Live Key</label>
                            <input type="text" name="payu_live_key" id="payu_live_key" value="{{ $payuLiveKey }}" 
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border">
                        </div>
                        <div class="mb-4">
                            <label for="payu_live_salt" class="block text-sm font-medium text-gray-700 mb-1">Live Salt</label>
                            <input type="text" name="payu_live_salt" id="payu_live_salt" value="{{ $payuLiveSalt }}" 
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recharge Limits -->
            <div class="mb-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Recharge Limits</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="min_recharge_amount" class="block text-sm font-medium text-gray-700 mb-1">Minimum Recharge Amount (₹)</label>
                        <input type="number" name="min_recharge_amount" id="min_recharge_amount" value="{{ $minRechargeAmount ?? 100 }}" 
                            min="1" step="1"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border"
                            placeholder="e.g. 100">
                        <p class="mt-1 text-xs text-gray-500">Minimum amount users can recharge</p>
                    </div>

                    <div>
                        <label for="max_recharge_amount" class="block text-sm font-medium text-gray-700 mb-1">Maximum Recharge Amount (₹)</label>
                        <input type="number" name="max_recharge_amount" id="max_recharge_amount" value="{{ $maxRechargeAmount ?? 50000 }}" 
                            min="1" step="1"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border"
                            placeholder="e.g. 50000">
                        <p class="mt-1 text-xs text-gray-500">Maximum amount per transaction</p>
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-6 border-t">
                <button type="submit" class="bg-indigo-600 text-white px-6 py-2.5 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 font-medium shadow-sm transition-colors">
                    Save Settings
                </button>
            </div>
        </form>
    </div>
@endsection
