<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalCoins = User::sum('coins');
        
        return view('admin.dashboard', compact('totalUsers', 'totalCoins'));
    }

    public function users()
    {
        $users = User::latest()->paginate(20);
        return view('admin.users', compact('users'));
    }

    // Site Identity
    public function siteIdentity()
    {
        $siteTitle = Setting::where('key', 'site_title')->value('value');
        $siteLogo = Setting::where('key', 'site_logo')->value('value');
        $footerGetInTouch = Setting::where('key', 'footer_get_in_touch')->value('value');
        
        return view('admin.settings.site_identity', compact('siteTitle', 'siteLogo', 'footerGetInTouch'));
    }

    public function updateSiteIdentity(Request $request)
    {
        $request->validate([
            'site_title' => 'nullable|string|max:255',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'footer_get_in_touch' => 'nullable|string',
        ]);

        $settings = [
            'site_title' => $request->site_title,
            'footer_get_in_touch' => $request->footer_get_in_touch,
        ];

        if ($request->hasFile('site_logo')) {
            $path = $request->file('site_logo')->store('public/logos');
            $settings['site_logo'] = str_replace('public/', 'storage/', $path);
        }

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
            Cache::forget('setting_' . $key);
        }

        return back()->with('success', 'Site Identity updated successfully.');
    }

    // Legal Pages
    public function legalPages()
    {
        $privacyPolicy = Setting::where('key', 'privacy_policy')->value('value');
        $termsOfService = Setting::where('key', 'terms_of_service')->value('value');
        $refundPolicy = Setting::where('key', 'refund_policy')->value('value');
        $cancellationPolicy = Setting::where('key', 'cancellation_policy')->value('value');
        
        return view('admin.settings.legal_pages', compact('privacyPolicy', 'termsOfService', 'refundPolicy', 'cancellationPolicy'));
    }

    public function updateLegalPages(Request $request)
    {
        $request->validate([
            'privacy_policy' => 'nullable|string',
            'terms_of_service' => 'nullable|string',
            'refund_policy' => 'nullable|string',
            'cancellation_policy' => 'nullable|string',
        ]);

        $settings = [
            'privacy_policy' => $request->privacy_policy,
            'terms_of_service' => $request->terms_of_service,
            'refund_policy' => $request->refund_policy,
            'cancellation_policy' => $request->cancellation_policy,
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
            Cache::forget('setting_' . $key);
        }

        return back()->with('success', 'Legal Pages updated successfully.');
    }

    // Economy & Currency
    public function economy()
    {
        $minRechargeAmount = Setting::where('key', 'min_recharge_amount')->value('value') ?? 100;
        $maxRechargeAmount = Setting::where('key', 'max_recharge_amount')->value('value') ?? 50000;
        $coinsPerRupee = Setting::where('key', 'coins_per_rupee')->value('value') ?? 1;
        
        return view('admin.settings.economy', compact('minRechargeAmount', 'maxRechargeAmount', 'coinsPerRupee'));
    }

    public function updateEconomy(Request $request)
    {
        $request->validate([
            'min_recharge_amount' => 'nullable|numeric|min:1',
            'max_recharge_amount' => 'nullable|numeric|min:1',
            'coins_per_rupee' => 'nullable|numeric|min:0.1',
        ]);

        $settings = [
            'min_recharge_amount' => $request->min_recharge_amount,
            'max_recharge_amount' => $request->max_recharge_amount,
            'coins_per_rupee' => $request->coins_per_rupee,
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
            Cache::forget('setting_' . $key);
        }

        return back()->with('success', 'Economy & Currency settings updated successfully.');
    }

    // SMTP Settings
    public function smtp()
    {
        $smtpHost = Setting::where('key', 'smtp_host')->value('value');
        $smtpPort = Setting::where('key', 'smtp_port')->value('value');
        $smtpUsername = Setting::where('key', 'smtp_username')->value('value');
        $smtpPassword = Setting::where('key', 'smtp_password')->value('value');
        $smtpEncryption = Setting::where('key', 'smtp_encryption')->value('value');
        $smtpFromAddress = Setting::where('key', 'smtp_from_address')->value('value');
        $smtpFromName = Setting::where('key', 'smtp_from_name')->value('value');
        
        return view('admin.settings.smtp', compact('smtpHost', 'smtpPort', 'smtpUsername', 'smtpPassword', 'smtpEncryption', 'smtpFromAddress', 'smtpFromName'));
    }

    public function updateSmtp(Request $request)
    {
        $request->validate([
            'smtp_host' => 'nullable|string',
            'smtp_port' => 'nullable|string',
            'smtp_username' => 'nullable|string',
            'smtp_password' => 'nullable|string',
            'smtp_encryption' => 'nullable|string',
            'smtp_from_address' => 'nullable|string',
            'smtp_from_name' => 'nullable|string',
        ]);

        $settings = [
            'smtp_host' => $request->smtp_host,
            'smtp_port' => $request->smtp_port,
            'smtp_username' => $request->smtp_username,
            'smtp_password' => $request->smtp_password,
            'smtp_encryption' => $request->smtp_encryption,
            'smtp_from_address' => $request->smtp_from_address,
            'smtp_from_name' => $request->smtp_from_name,
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
            Cache::forget('setting_' . $key);
        }

        return back()->with('success', 'SMTP settings updated successfully.');
    }

    // Payment Gateways
    public function paymentGateways()
    {
        $payuMode = Setting::where('key', 'payu_mode')->value('value');
        $payuTestKey = Setting::where('key', 'payu_test_key')->value('value');
        $payuTestSalt = Setting::where('key', 'payu_test_salt')->value('value');
        $payuLiveKey = Setting::where('key', 'payu_live_key')->value('value');
        $payuLiveSalt = Setting::where('key', 'payu_live_salt')->value('value');
        
        return view('admin.settings.payment_gateways', compact('payuMode', 'payuTestKey', 'payuTestSalt', 'payuLiveKey', 'payuLiveSalt'));
    }

    public function updatePaymentGateways(Request $request)
    {
        $request->validate([
            'payu_mode' => 'nullable|in:test,live',
            'payu_test_key' => 'nullable|string',
            'payu_test_salt' => 'nullable|string',
            'payu_live_key' => 'nullable|string',
            'payu_live_salt' => 'nullable|string',
        ]);

        $settings = [
            'payu_mode' => $request->payu_mode,
            'payu_test_key' => $request->payu_test_key,
            'payu_test_salt' => $request->payu_test_salt,
            'payu_live_key' => $request->payu_live_key,
            'payu_live_salt' => $request->payu_live_salt,
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
            Cache::forget('setting_' . $key);
        }

        return back()->with('success', 'Payment Gateway settings updated successfully.');
    }

    public function updateSettingsAjax(Request $request)
    {
        $data = $request->all();
        
        foreach ($data as $key => $value) {
            // Basic validation/sanitization could go here
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
            Cache::forget('setting_' . $key);
        }

        return response()->json(['success' => true]);
    }

    public function login()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();

            if (auth()->user()->is_admin) {
                return redirect()->intended(route('admin.dashboard'));
            }

            auth()->logout();
            return back()->withErrors([
                'email' => 'You do not have admin access.',
            ]);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
