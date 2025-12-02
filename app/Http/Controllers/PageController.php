<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class PageController extends Controller
{
    public function show(Request $request)
    {
        $slug = $request->route()->parameter('slug') ?? $request->path();
        
        // Map slugs to setting keys
        $keyMap = [
            'privacy-policy' => 'privacy_policy',
            'terms-of-service' => 'terms_of_service',
            'refund-policy' => 'refund_policy',
            'cancellation-policy' => 'cancellation_policy',
        ];

        $titles = [
            'privacy-policy' => 'Privacy Policy',
            'terms-of-service' => 'Terms of Service',
            'refund-policy' => 'Refund Policy',
            'cancellation-policy' => 'Cancellation Policy',
        ];

        // Default to privacy policy if slug not found (shouldn't happen with correct routes)
        $key = $keyMap[$slug] ?? 'privacy_policy';
        $title = $titles[$slug] ?? 'Page';

        $content = Setting::where('key', $key)->value('value');

        return view('page', compact('title', 'content'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // In a real app, you might send an email here or save to DB
        // For now, just redirect back with success message

        return back()->with('success', 'Thank you for contacting us! We will get back to you soon.');
    }
}
