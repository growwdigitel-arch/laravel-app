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

    public function settings()
    {
        $paymentKey = Setting::where('key', 'payment_key')->value('value');
        $paymentSalt = Setting::where('key', 'payment_salt')->value('value');
        
        // New Settings
        $siteTitle = Setting::where('key', 'site_title')->value('value');
        $siteLogo = Setting::where('key', 'site_logo')->value('value');
        $footerLinks = Setting::where('key', 'footer_links')->value('value');
        $payuMode = Setting::where('key', 'payu_mode')->value('value');
        $payuTestKey = Setting::where('key', 'payu_test_key')->value('value');
        $payuTestSalt = Setting::where('key', 'payu_test_salt')->value('value');
        $payuLiveKey = Setting::where('key', 'payu_live_key')->value('value');
        $payuLiveSalt = Setting::where('key', 'payu_live_salt')->value('value');
        
        $privacyPolicy = Setting::where('key', 'privacy_policy')->value('value');
        $termsOfService = Setting::where('key', 'terms_of_service')->value('value');
        $refundPolicy = Setting::where('key', 'refund_policy')->value('value');
        $footerGetInTouch = Setting::where('key', 'footer_get_in_touch')->value('value');
        
        $minRechargeAmount = Setting::where('key', 'min_recharge_amount')->value('value') ?? 100;
        $maxRechargeAmount = Setting::where('key', 'max_recharge_amount')->value('value') ?? 50000;

        return view('admin.settings', compact(
            'paymentKey', 'paymentSalt', 
            'siteTitle', 'siteLogo', 'footerLinks', 
            'payuMode', 'payuTestKey', 'payuTestSalt', 'payuLiveKey', 'payuLiveSalt',
            'privacyPolicy', 'termsOfService', 'refundPolicy', 'footerGetInTouch',
            'minRechargeAmount', 'maxRechargeAmount'
        ));
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'site_title' => 'nullable|string|max:255',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'footer_links' => 'nullable|string', // JSON string
            'payu_mode' => 'nullable|in:test,live',
            'payu_test_key' => 'nullable|string',
            'payu_test_salt' => 'nullable|string',
            'payu_live_key' => 'nullable|string',
            'payu_live_salt' => 'nullable|string',
            'privacy_policy' => 'nullable|string',
            'terms_of_service' => 'nullable|string',
            'refund_policy' => 'nullable|string',
            'footer_get_in_touch' => 'nullable|string',
            'min_recharge_amount' => 'nullable|numeric|min:1',
            'max_recharge_amount' => 'nullable|numeric|min:1',
        ]);

        $settings = [
            'site_title' => $request->site_title,
            'footer_links' => $request->footer_links,
            'payu_mode' => $request->payu_mode,
            'payu_test_key' => $request->payu_test_key,
            'payu_test_salt' => $request->payu_test_salt,
            'payu_live_key' => $request->payu_live_key,
            'payu_live_salt' => $request->payu_live_salt,
            'privacy_policy' => $request->privacy_policy,
            'terms_of_service' => $request->terms_of_service,
            'refund_policy' => $request->refund_policy,
            'footer_get_in_touch' => $request->footer_get_in_touch,
            'min_recharge_amount' => $request->min_recharge_amount,
            'max_recharge_amount' => $request->max_recharge_amount,
        ];

        if ($request->hasFile('site_logo')) {
            $path = $request->file('site_logo')->store('public/logos');
            $settings['site_logo'] = str_replace('public/', 'storage/', $path);
        }

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
            Cache::forget('setting_' . $key);
        }

        return back()->with('success', 'Settings updated successfully.');
    }

    public function login()
    {
        if (auth()->check() && auth()->user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }
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
