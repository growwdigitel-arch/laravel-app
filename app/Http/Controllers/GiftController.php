<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use Illuminate\Http\Request;

class GiftController extends Controller
{
    public function index()
    {
        $gifts = Gift::orderBy('is_featured', 'desc')
            ->orderBy('price', 'asc')
            ->get();
        
        return view('gifts.index', compact('gifts'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'gift_id' => 'required|exists:gifts,id',
            'room_id' => 'required|exists:rooms,id',
        ]);

        $gift = Gift::find($request->gift_id);
        $user = auth()->user();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Please login to send gifts.']);
        }

        // Use gift price as coin cost directly
        $coinCost = $gift->price;

        if ($user->coins < $coinCost) {
            return response()->json([
                'success' => false, 
                'message' => 'Insufficient coins! Need ' . $coinCost . ' coins.',
            ]);
        }

        // Deduct coins
        $user->decrement('coins', $coinCost);

        // Record Transaction
        \App\Models\Transaction::create([
            'user_id' => $user->id,
            'type' => 'debit',
            'amount' => 0,
            'coins' => $coinCost,
            'description' => 'Sent gift: ' . $gift->name,
            'status' => 'success',
            'payment_gateway' => 'system'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Gift sent successfully!',
            'remaining_coins' => $user->coins,
            'gift_name' => $gift->name,
            'gift_icon' => $gift->image
        ]);
    }
}
