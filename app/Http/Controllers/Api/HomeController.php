<?php

namespace App\Http\Controllers\Api;

use App\Models\Announcement;
use App\Models\Notification;
use App\Models\Referral;
use App\Models\Withdraw;
use App\User;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Kevupton\LaravelCoinpayments\Models\Transaction;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function link()
    {
        $user = Auth()->user();
        $link = Link::where('user_id', $user->id)->first();
        //$link = Link::all();
        return response()->json($link, 200);
    }

    public function postUpdate(Request $request)
    {
        $this->validate($request, [
            'full_name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'bitcoin' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required'
        ]);

        if (Auth()->user()->id == $request->id) {
            $requestData = $request->all();
            unset($requestData['_token']);

            // Update to db

            $user = new User();
            $user->where('id', $request->id)->update($requestData);

            return response()->json($user, 200);
        }
        return response()->json([], 422);
    }

    public function update_profile_picture(Request $request){
      // \Log::info($request->all());
        $validator = Validator::make($request->all(), [
            'image' => 'required|image64:jpeg,jpg,png'
        ]);
        if ($validator->passes()) {
            $exploded = explode(',', $request->image);

            $decoded = base64_decode($exploded[1]);

            if(str_contains($exploded[0], 'jpeg'))
                $extension = 'jpg';
            else
                $extension = 'png';

            $theImages = "";
            $fileName = str_random().'.'.$extension;
            $path = public_path('alex_images/').$fileName;
            
           // $path = 'alex_images/' .$fileName;

            file_put_contents($path, $decoded);
            $theImages = $fileName;
        }else{
            return response()->json(['errors'=>$validator->errors()], 422);
        }

        User::where('id', Auth::user()->id)->update(['pro_pic' => $theImages]);
        return response()->json(['error'=>false]);

    }

    public function myReferrals()
    {
        $user = Auth::user()->username;
        $check = User::where('upline', $user)->simplePaginate(7);
        return response()->json($check, 200);
    }

    public function myReferralsCount()
    {
        $user = Auth::user()->username;
        $check = User::where('upline', $user)->count();
        return response()->json($check, 200);
    }


    public function allUsers(){
        $user = User::where('role_id', 1)->get();
        return response()->json($user, 200);
    }

    public function getNotifications() {
      // $notification =  DB::table('notifications')->where('upline_username', Auth::user()->username)->get();
        $notification = Auth::user()->unreadNotifications;
        return response()->json($notification, 200);
    }

    public function read(Request $request){
        Auth::user()->unreadNotifications()->find($request->id)->markAsRead();
    }
    public function getNotificationsCount() {
        $notificationCount = Auth::user()->unreadNotifications->count();

        return response()->json($notificationCount, 200);
    }


    public function announcement(){
        $announcement = Announcement::simplePaginate(2);
        return response()->json($announcement);
    }

    public function getTransaction()
    {

        $user = Auth::user();
        //$deposit = "";
        $balance = Transaction::where('user_id', Auth()->user()->id)->get();
      //  if(count($balance) > 0)
        //    $deposit = $balance; //1300

       // $sum = $bal + $ref;

       return response()->json($balance, 200);

    }
    public function getContracts()
    {

        $user = Auth::user();
        $deposit = "";
        $balance = Transaction::where('user_id', Auth()->user()->id)->simplePaginate(5);
      /*  if(count($balance) > 0)
            $deposit = $balance; */ //1300

        // $sum = $bal + $ref;

        return response()->json($balance, 200);

    }
    public function getContractForAdmin()
    {

        $depo = "";
        $balance = Transaction::paginate(5);
        if(count($balance) > 0)
            $depo = $balance; //1300

        // $sum = $bal + $ref;

        return response()->json($depo);

    }

    public function getWithdrawalsForAdmin()
    {

        $depo = "";
        $balance = Withdraw::paginate(5);
        if(count($balance) > 0)
            $depo = $balance; //1300

        // $sum = $bal + $ref;

        return response()->json($depo);

    }


    public function getReferral()
    {
        $user = Auth::user();
        $ref = "";
        $referral = Referral::where('sponsor_username', $user->username)->get();
        // $ref = $referral->sum('initial_amount'); //1300
        return response()->json($referral);

    /*    $user = Auth::user();
        $ref = '';
        $referral = Referral::where('sponsor_username', $user->username)->get();
        $ref = $referral->sum('initial_amount'); //1300
       // return response()->json($ref);
         return response()->json([
             'ref' => $ref,
             'referral' => $referral
         ]);*/

    }

    public function getStuff(){

        $user = Auth::user();
        $bal = "";
        $ref = '';
        $withdrawn="";
        $withdraw ="";
        $balance = Transaction::where('user_id', $user->id)->where('status', 'ACTIVATED')->where('confirms_needed', 99)->get();
        foreach ($balance as $bal) {
            $withdrawn = $bal->withdrawn;
        }
        $referral = Referral::where('sponsor_username', $user->username)->get();
        foreach($referral as $rd){
            $withdraw = $rd->withdraw;

        }
        if(count($referral) > 0)
            $ref = $referral->sum('amount'); //1300
        if(count($balance) > 0)
            $bal = $balance->sum('returns'); //1300
        $bal = floatval($bal);
        $bal = number_format($bal);
        $bal = str_replace(",", "", $bal);
        $deposit = $balance->sum('amount');
        $sum = $bal + $ref;
        $sum = number_format($sum);
        $sum = str_replace(",", "", $sum);
        return response()->json([
            'profit' => $bal,
            'sum' => $sum,
            'ref' => $ref,
            'withdrawn' => $withdrawn,
            'withdraw' => $withdraw
        ]);

        /*  $user = Auth::user();
          $bal = '';
          $ref = '';
          $sum = '';
          //$balan = '';
          $withdrawn="";
          $withdraw ="";
          $ban = '';

         $balance = Transaction::where('user_id', $user->id)->whereRaw('status_date > SUBDATE( NOW(), INTERVAL 7 DAY)')->where('day_count', 7)->where('withdrawn', '=', 'NO')->get();
          $balan = [];

          foreach ($balance as $bal) {
              $withdrawn = $bal->withdrawn;
              $balan[] = $bal->rate / 100 * $bal->amount_btc;
              $balan[] = array_sum($balan);
          }
          $referral = Referral::where('sponsor_username', $user->username)->where('withdraw', '=', 'NO')->get();
          foreach($referral as $rd){
              $withdraw = $rd->withdraw;

          }
          if (count($referral) > 0)
              $ref = $referral->sum('initial_amount'); //1300


          $sum = array_sum($balan) + $ref;


          return response()->json([
              'profit' => $balan,
              'sum' => $sum,
              'ref' => $ref,
              'withdrawn' => $withdrawn,
              'withdraw' => $withdraw
          ]);*/
    }



    public function apiReferralWithdraw()
    {

        $user = Auth::user();
        $ref = '';
        $referral = Referral::where('sponsor_username', $user->username)->get();
        if(count($referral) > 0)
            $ref = $referral->sum('amount'); //1300
        return response()->json([
            'ref' => $ref
        ]);
    }

    public function clientWithdrawal()
    {
        $def = "";
        $def = Withdraw::where('user_id', '=' , Auth()->user()->id)->orderBy('created_at')->simplePaginate(5);
        /* if(count($deposit) > 0)
             $def = $deposit;*/
        return response()->json($def);
    }











}
