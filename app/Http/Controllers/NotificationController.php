<?php

namespace App\Http\Controllers;

use App\Mail\AutoReloadNotification;
use App\Mail\BalanceLimitNotification;
use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NotificationController extends Controller
{
    public function corp_auto_recharge(Request $request) {
    	$transferred = $request->transferred;
        $number = $request->onum;
        $balance = $request->balance;

        $card = Card::where(['card_number' => $number, 'active' => 1])->first();

        $data = [
        	'name' => $card->user->contact->firstname . ' ' . $card->user->contact->lastname,
        	'card' => $number,
        	'balance' => $balance,
        	'transferred' => $transferred,
        ];
        Mail::to($card->user->username)->send(new AutoReloadNotification($data));
    }

    public function corp_balance_limit(Request $request) {
    	$number = $request->onum;
        $balance = $request->balance;

        $card = Card::where(['card_number' => $number, 'active' => 1])->first();
        // dd($card->user->username);
        if(!empty($card) && !in_array($card->group_id, [37, 61, 18])){
        	$data = [
	        	'name' => $card->user->contact->firstname . ' ' . $card->user->contact->lastname,
	        	'card' => $number,
	        	'balance' => ($balance < 1 ? '0' . $balance : $balance),
	        ];
	        Mail::to($card->user->username)->send(new BalanceLimitNotification($data));
        }
    }
}
