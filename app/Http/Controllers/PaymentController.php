<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    private $payuUrlTest = "https://test.payu.in/_payment";
    private $payuUrlLive = "https://secure.payu.in/_payment";

    private function getPaymentConfig()
    {
        $mode = get_setting('payu_mode', 'test');
        return [
            'mode' => $mode,
            'key' => $mode === 'live' ? get_setting('payu_live_key') : get_setting('payu_test_key'),
            'salt' => $mode === 'live' ? get_setting('payu_live_salt') : get_setting('payu_test_salt'),
            'url' => $mode === 'live' ? $this->payuUrlLive : $this->payuUrlTest,
        ];
    }

    public function index()
    {
        return view('coins.index');
    }

    private function verifySignature(Request $request)
    {
        $config = $this->getPaymentConfig();
        $salt = $config['salt'];
        
        $status = $request->status;
        $firstname = $request->firstname;
        $amount = $request->amount;
        $txnid = $request->txnid;
        $posted_hash = $request->hash;
        $key = $request->key;
        $productinfo = $request->productinfo;
        $email = $request->email;

        if (!$posted_hash) return false;

        // Sequence: salt|status||||||udf5|udf4|udf3|udf2|udf1|email|firstname|productinfo|amount|txnid|key
        $retHashSeq = $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
        $hash = strtolower(hash('sha512', $retHashSeq));

        return $hash === $posted_hash;
    }

    public function initiate(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'coins' => 'required|integer',
        ]);

        $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
        $amount = $request->amount;
        $productInfo = "ChatterGlow Coins - " . $request->coins;
        
        $user = auth()->user();
        $firstname = $user ? $user->name : "Guest User";
        $email = $user ? $user->email : "guest@chatterglow.com";
        
        $udf1 = "";
        $udf2 = "";
        $udf3 = "";
        $udf4 = "";
        $udf5 = "";

        // Hash Sequence: key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5||||||salt
        $config = $this->getPaymentConfig();
        $hashString = $config['key'] . '|' . $txnid . '|' . $amount . '|' . $productInfo . '|' . $firstname . '|' . $email . '|' . $udf1 . '|' . $udf2 . '|' . $udf3 . '|' . $udf4 . '|' . $udf5 . '||||||' . $config['salt'];
        
        $hash = strtolower(hash('sha512', $hashString));

        // Create pending transaction
        $userId = $user ? $user->id : null;

        Transaction::create([
            'user_id' => $userId,
            'txnid' => $txnid,
            'amount' => $amount,
            'coins' => $request->coins,
            'status' => 'pending',
        ]);

        return view('coins.checkout', [
            'action' => $config['url'],
            'key' => $config['key'],
            'txnid' => $txnid,
            'amount' => $amount,
            'productinfo' => $productInfo,
            'firstname' => $firstname,
            'email' => $email,
            'hash' => $hash,
            'surl' => route('payment.success'),
            'furl' => route('payment.failure'),
        ]);
    }

    public function success(Request $request)
    {
        if (!$this->verifySignature($request)) {
            return redirect()->route('coins.index')->with('error', 'Invalid Transaction Signature');
        }

        $transaction = Transaction::where('txnid', $request->txnid)->first();
        
        if ($transaction) {
            $transaction->update(['status' => 'success']);
            
            // Restore Session if needed
            if (!auth()->check() && $transaction->user_id) {
                \Auth::loginUsingId($transaction->user_id);
            }

            // Add coins to user
            if ($transaction->user_id) {
                $user = User::find($transaction->user_id);
                if ($user) {
                    $user->increment('coins', $transaction->coins);
                    // Sync session with new DB balance
                    session(['coins' => $user->coins]);
                }
            } else {
                // Guest logic: just add to session
                $currentCoins = session('coins', 0);
                session(['coins' => $currentCoins + $transaction->coins]);
            }
        }

        return view('payment.success', compact('transaction'));
    }

    public function failure(Request $request)
    {
        if (!$this->verifySignature($request)) {
             return redirect()->route('coins.index')->with('error', 'Invalid Transaction Signature');
        }

        $transaction = Transaction::where('txnid', $request->txnid)->first();
        if ($transaction) {
            $transaction->update(['status' => 'failed']);
            
            // Restore Session if needed
            if (!auth()->check() && $transaction->user_id) {
                \Auth::loginUsingId($transaction->user_id);
            }
        }

        return view('payment.failure', compact('transaction'));
    }
}
