<?php

namespace App\Http\Controllers;

use App\Models\Otp;
use App\Models\User;
use App\Mail\OtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $email = $request->email;
        $otp = rand(100000, 999999);

        Otp::create([
            'email' => $email,
            'otp' => $otp,
            'expires_at' => Carbon::now()->addMinutes(10),
        ]);

        try {
            Mail::to($email)->send(new OtpMail($otp));
            return response()->json(['success' => true, 'message' => 'OTP sent to your email!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to send OTP. ' . $e->getMessage()], 500);
        }
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|numeric',
        ]);

        $otpRecord = Otp::where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$otpRecord) {
            return response()->json(['success' => false, 'message' => 'Invalid or expired OTP.']);
        }

        // Login or Register User
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            $user = User::create([
                'email' => $request->email,
                'name' => explode('@', $request->email)[0],
                'password' => bcrypt(Str::random(16)),
                'coins' => 100, // Welcome Bonus
                'emoji' => '😀',
                'avatar' => 'https://api.dicebear.com/7.x/avataaars/svg?seed=' . explode('@', $request->email)[0]
            ]);

            // Record Transaction
            \App\Models\Transaction::create([
                'user_id' => $user->id,
                'type' => 'credit',
                'amount' => 0,
                'coins' => 100,
                'description' => 'Free Credit by Company',
                'status' => 'success',
                'payment_gateway' => 'system'
            ]);
        }

        Auth::login($user);
        
        // Clear OTP
        $otpRecord->delete();

        return response()->json(['success' => true, 'message' => 'Login successful!']);
    }
    
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'emoji' => 'nullable|string|max:10',
            'avatar' => 'nullable|string',
        ]);

        $user = Auth::user();
        $user->update([
            'name' => $request->name,
            'emoji' => $request->emoji,
            'avatar' => $request->avatar,
        ]);

        return response()->json(['success' => true, 'message' => 'Profile updated successfully!']);
    }
}
