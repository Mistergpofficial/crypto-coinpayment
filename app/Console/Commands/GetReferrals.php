<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Kevupton\LaravelCoinpayments\Models\Transaction;
use App\Models\Referral;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GetReferrals extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'GetReferrals:getreferrals';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'referral commission script';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $id = '';
        $amount = '';
        $username = '';
        $userId = '';
        $user = '';
        $trans = Transaction::where('confirms_needed', '=', 99)->where('referral_gotten', 'NOPE')->get();
        foreach ($trans as $tran) {
            if ($tran->user->upline !== NULL) {
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
                Transaction::where('confirms_needed', '=', 99)->update(['referral_gotten' => 'YES']);
            } else {
                echo 'error';
            }

            //        Log::info($tran);
        }




        }
}
