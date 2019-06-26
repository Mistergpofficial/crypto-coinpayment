<?php

namespace App\Http\Controllers;
use App\Http\Requests\adminRegistration;
use App\Models\Announcement;
use App\Models\Referral;
use App\Models\Withdraw;
use App\User;
use App\Models\Link;
use App\Notifications\NotifyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Kevupton\LaravelCoinpayments\Models\Transaction;

class AdminController extends Controller
{


    public function admin_reg()
    {
        return view('auth.a_register');
    }
    public  function p_admin_reg(adminRegistration $req)
    {
        $data = $req->all();
        $user = new User();
        $user->full_name = $data['full_name'];
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->phone = $data['phone'];
        $user->bitcoin = $data['bitcoin'];
        $user->role_id = 2;
        $user->save();

        $ref = 'https://cryptotraderslab.com/account/register?ref=';

        Link::create([
            'user_id' => $user->id,
            'username' => $user->username,
            'address' => $ref.''.$user->username
        ]);

       // $link = Link::where('username', $data['upline'])->first();
        //$web = $link->user()->get();
        //Log::info($web);
        //  User::find($link->user->id)->notify(new NotifyUser($link));
       // $link->user->notify(new NotifyUser($link));

        session()->flash('success', 'User created successfully!.');
        return redirect()->back();
    }

    public function announcement()
    {
        return view('pages.create_announcement');
    }

    public function postAnnouncement(Request $request){
        $this->validate($request,[
           'subject' => 'required',
           'content' => 'required'
        ]);
       $announcement = new Announcement();
       $announcement->subject = $request->input('subject');
       $announcement->content = $request->input('content');
       $announcement->save();
    }

    public function confirm_withdrawal_payment($id)
    {

        $amount = '';
        $bal = '';
        $ref = '';
        Withdraw::where('id', $id)->update(['status' => 'PAID', 'payment_date' => Carbon::now()]);
        $user_get = Withdraw::where('id', $id)->first();

            if(count($user_get)) {
            $balance = Transaction::where('user_id', $user_get->user_id)->where('status', 'ACTIVATED')->where('confirms_needed', 99)->where('status_date' ,'<=' , Carbon::now()->subDays(6))->get();
            $referral = Referral::where('sponsor_username', $user_get->user->username)->get();
            if (count($balance) > 0)
                $bal = $balance->sum('returns'); //10000
            $bal = floatval($bal);
            $bal = number_format($bal);
            $bal = str_replace(",", "", $bal);
            if (count($referral) > 0)
                $ref = $referral->sum('amount'); //500
            $sum = $bal + $ref;
            $sum = number_format($sum);
            $sum = str_replace(",", "", $sum); //10500
            $count = count($balance);
            $amount1 = $sum / $count;
            Transaction::where('user_id', $user_get->user_id)->update(['withdrawn' => 'NO', 'bal_after_7days' => $amount1, 'returns' => 0,  'rate' => 0, 'status_date' => Carbon::now()]);
            Referral::where('sponsor_username', $user_get->user->username)->update(['amount' => 0]);
            //  Transaction::where('user_id', $user_get->user_id)->delete();
            Withdraw::where('id', $id)->delete();

        }
        return redirect()->back();
    }

    public function confirm_referral_withdrawal_payment($id)
    {
        Withdraw::where('id', $id)->update(['status' => 'PAID', 'payment_date' => Carbon::now()]);
        $user_get = Withdraw::where('id', $id)->first();
        if (count($user_get)) {
            //  Referral::where('sponsor_username', $user_get->user->username)->delete();

        }
        return redirect()->back();
    }


    public function purgeUser($id)
    {
        $user_get = User::where('id', $id)->first();

        User::where('id', $user_get->id)->delete();

        session()->flash('alert-success', 'User Purged Successfully.');

        return redirect()->back();

    }

    public function confirm_payment($id)
    {
        $transaction = Transaction::where('id', $id)->update(['status' => 'ACTIVATED', 'confirms_needed' => 0]);

        $trans = Transaction::where('id', $id)->where('status', 'ACTIVATED')->get();

        foreach ($trans as $tran) {
            $id = $tran->id;
            $amount = $tran->amount_btc;
            $username = $tran->user->upline;
            $userId = $tran->user->id;


            Referral::create([
                'user_id' => $userId,
                'amount' => $amount * 0.05,
                'initial_amount' => $amount * 0.05,
                'sponsor_username' => $username,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }

        return redirect()->back();
    }

    public function fundUsers(){
        $users = User::where('role_id', 1)->get();
        return view('pages.funding', compact('users'));
    }

    public function postFunding(Request $request){

        $this->validate($request, [
            'users' => 'required|not_in:0',
            'amount' => 'required',
        ]);
        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name" => false,
            ),
        );
        $url1 = file_get_contents('https://api.coinmarketcap.com/v1/ticker/bitcoin/', false, stream_context_create($arrContextOptions));
        $vrl = $url1;
        $json= json_decode($vrl, true);
        $btc = $json[0]["price_usd"];


        $tick = file_get_contents('https://api.coinmarketcap.com/v1/ticker/ethereum/', false, stream_context_create($arrContextOptions));
        $url = $tick;
        $data= json_decode($tick, true);
        $eth = $data[0]["price_usd"];

        $plan = "";
        $rate = "";
        $transaction = new Transaction();
        $transaction->user_id = $request->users;
        $transaction->amount_btc = $request->amount;
        if($request->amount >= '1000' && $request->amount <= '10000 '){
            $plan = 'Basic Plan';
        } elseif ($request->amount >= '10001' && $request->amount <= '30000' ) {
            $plan = 'StartUp Plan';
        } elseif ($request->amount >= '30001' && $request->amount <= '50000' ) {
            $plan = 'Standard Plan';
        } elseif ($request->amount >= '50001' && $request->amount <= '100000' ) {
            $plan = 'Premium Plan';
        } elseif ($request->amount >= '100001' && $request->amount <= '1000000' ) {
            $plan = 'Platinum Plan';
        }
        $transaction->registras_plan = $plan;
        $transaction->amount = $request->amount / $btc;
        $transaction->rate = 0;
        $transaction->returns = 0;
        $transaction->currency1 = 'BTC';
        $transaction->currency2 = 'BTC';
        $transaction->buyer_name = $request->users->full_name;
        $transaction->status = 'ACTIVATED';
        $transaction->confirms_needed = 0;
        $transaction->timeout = 9600;
        $transaction->txn_id = 'NULL';
        $transaction->created_at = Carbon::now();
        $transaction->updated_at = Carbon::now();

    }


}
