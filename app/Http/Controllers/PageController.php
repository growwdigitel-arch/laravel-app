<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show($slug)
    {
        $title = '';
        $content = '';

        if ($slug === 'privacy-policy') {
            $title = 'Privacy Policy';
            $content = get_setting('privacy_policy');
        } elseif ($slug === 'terms-of-service') {
            $title = 'Terms of Service';
            $content = get_setting('terms_of_service');
        } elseif ($slug === 'refund-policy') {
            $title = 'Refund and Cancellation Policy';
            $content = get_setting('refund_policy');
        } else {
            abort(404);
        }

        return view('page', compact('title', 'content'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function submitContact(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string|max:5000',
        ]);

        // In a real app, you might send an email or save to DB here.
        // For now, just flash success message.

        return back()->with('success', 'We will contact you soon!');
    }
}
