<?php

namespace App\Http\Controllers;
use App\Models\Announcement;
use App\Models\Referral;
use App\Models\Withdraw;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kevupton\LaravelCoinpayments\Models\Transaction;
use Carbon\Carbon;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $users = User::where('role_id', 1)->get();
        $admins = User::where('role_id', 2)->get();
        return view('pages.dashboard')->with(compact('users', 'admins'));
    }

    public function profile(){
        return view('pages.profile');
    }

    public function myReferral(){
        return view('pages.referrals');
    }

    public function addFund(){
        return view('pages.add_fund');
    }
    public function withdrawFund(){
        $user = Auth::user();
        $balan = '';
        $withdrawn="";
        $withdraw ="";
        $ref = '';
        $sum = '';
        $balance = Transaction::where('user_id', $user->id)->where('status', 'ACTIVATED')->where('confirms_needed', 99)->where('status_date' ,'<=' , Carbon::now()->subDays(6))->get();
        foreach ($balance as $balan) {
            $withdrawn = $balan->withdrawn;
        }
        if(count($balance) > 0)
            $balan = $balance->sum('returns'); //1300
            $bal_after_7days = $balance->sum('bal_after_7days');
        $balan = floatval($balan);
        $balan = number_format($balan);
        $balan = str_replace(",", "", $balan);
        $referral = Referral::where('sponsor_username', $user->username)->get();
        foreach($referral as $rd){
            $withdraw = $rd->withdraw;
        }
        if (count($referral) > 0)
            $ref = $referral->sum('amount'); //1300
        $sum = $balan + $ref;
        $sum = number_format($sum);
        $sum = str_replace(",", "", $sum);
        return view('pages.withdraw_fund', compact('ref', 'balan', 'sum', 'withdrawn', 'withdraw', 'referral', 'balance', 'bal_after_7days'));
    }
    public function postWithdraw(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required',
        ]);
        $user = Auth::user();
        $amount = '';
        $bal = '';
        $ref = '';
        $amount1 = '';
        $balance = Transaction::where('user_id', $user->id)->where('status', 'ACTIVATED')->where('confirms_needed', 99)->where('status_date' ,'<=' , Carbon::now()->subDays(6))->get();
        $referral = Referral::where('sponsor_username', $user->username)->get();
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
        if ($request->amount < $sum) {
            $amount = $sum - $request->amount; //10000
            $count = count($balance) + count($referral);
            $amount1 = $amount / $count;
            Transaction::where('user_id', $user->id)->where('status', 'ACTIVATED')->where('confirms_needed', 99)->where('status_date' ,'<=' , Carbon::now()->subDays(6))->update(['returns' => $amount1, 'withdrawn' => 'YES']);
            Referral::where('sponsor_username', $user->username)->update(['amount' => $amount1,  'withdraw' => 'YES']);
        } elseif ($request->amount == $sum) {
            $amount = $sum - $request->amount;
            $count = count($balance) + count($referral);
            $amount1 = $amount / $count;
            Transaction::where('user_id', $user->id)->where('status', 'ACTIVATED')->where('confirms_needed', 99)->where('status_date' ,'<=' , Carbon::now()->subDays(6))->update(['returns' => $amount1, 'withdrawn' => 'YES']);
            Referral::where('sponsor_username', $user->username)->update(['amount' => $amount1,  'withdraw' => 'YES']);
        }
        $withdraw = new Withdraw();
        $withdraw->user_id = $user->id;
        $withdraw->full_name= $user->full_name;
        $withdraw->email = $user->email;
        $withdraw->amount = $request->input('amount');
        $withdraw->type = $request->input('total');
        $withdraw->save();


        /*  $withdraw = new Withdraw();
          $withdraw->user_id = $user->id;
          $withdraw->full_name= $user->full_name;
          $withdraw->email = $user->email;
          $withdraw->amount = $request->input('amount');
          $withdraw->type = $request->input('total');
          $withdraw->save();


          Transaction::where('user_id', $user->id)->where('status', 'ACTIVATED')->where('confirms_needed', 99)->where('status_date' ,'<=' , Carbon::now()->subDays(7))->update(['withdrawn' => 'YES']);
          Referral::where('sponsor_username', $user->username)->update(['withdraw' => 'YES']);
  */

        return redirect()->back();



    }

    public function postReferralWithdrawal(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required',
        ]);
        $user = Auth::user();
        $amount = '';
        $bal = '';
        $ref = '';
        $amount1 = '';
        $referral = Referral::where('sponsor_username', $user->username)->get();
        if (count($referral) > 0)
            $ref = $referral->sum('amount'); //1300
        if ($request->amount < $ref) {
            $amount = $ref - $request->amount;
            $count = count($referral);
            $amount1 = $amount / $count;
            Referral::where('sponsor_username', $user->username)->update(['amount' => $amount1, 'withdraw' => 'YES']);
        } elseif ($request->amount == $ref) {
            $amount = $ref - $request->amount;
            $count = count($referral);
            $amount1 = $amount / $count;
            Referral::where('sponsor_username', $user->username)->update(['amount' => $amount1, 'withdraw' => 'YES']);
        }
        $withdraw = new Withdraw();
        $withdraw->user_id = $user->id;
        $withdraw->full_name= $user->full_name;
        $withdraw->email = $user->email;
        $withdraw->amount = $request->input('amount');
        $withdraw->type = $request->input('referral');
        $withdraw->save();


      //  Referral::where('sponsor_username', $user->username)->update(['withdraw' => 'YES']);

    }


    public function myTransactions(){
        return view('pages.transactions');
    }


    public function adminTransactions(){
        $transactions = Transaction::simplePaginate(5);
        return view('pages.admin_transactions', compact('transactions'));
    }

    public function adminWithdrawals(){
        $withdrawals = Withdraw::withTrashed()->simplePaginate(5);
        return view('pages.admin_withdrawals', compact('withdrawals'));
    }



    public function manageUsers()
    {
        $users = User::where('role_id', 1)->simplePaginate(8);
        return view('pages.manage-users', compact('users'));
    }


}
