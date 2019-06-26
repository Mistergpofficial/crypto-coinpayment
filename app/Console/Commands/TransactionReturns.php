<?php

namespace App\Console\Commands;

use Kevupton\LaravelCoinpayments\Models\Transaction;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

class TransactionReturns extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'TransactionReturns:transactionreturns';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get the transactions activated after 7 days';

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


     /*   Transaction::where('confirms_needed', '=', 0)->update(['status_date' => Carbon::now(), 'confirms_needed' => 99]);
        Transaction::where('confirms_needed', '=', 99)->where('day_count', '!=', 7)->where('plan', '=', 'Premium Plan')->whereRaw('status_date > SUBDATE( NOW(), INTERVAL 7 DAY)')->update(['rate' => DB::raw('rate + 1.43'), 'day_count' => DB::raw('day_count + 1'), 'returns' => DB::raw('rate / 100 * amount_btc')]);
        Transaction::where('confirms_needed', '=', 99)->where('day_count', '!=', 7)->where('plan', '=', 'Ultimate Plan')->whereRaw('status_date > SUBDATE( NOW(), INTERVAL 7 DAY)')->update(['rate' => DB::raw('rate + 2.14'), 'day_count' => DB::raw('day_count + 1'), 'returns' => DB::raw('rate / 100 * amount_btc')]);
       */// return $this->info('Achieved');

      /*  $today = Carbon::now(new \DateTimeZone('Africa/Lagos'));
        Transaction::where('confirms_needed', '=', 0)->update(['status_date' => Carbon::now(), 'confirms_needed' => 99]);
        Transaction::where('confirms_needed', '=', 99)->where('day_count', '!=', 7)->where('plan', '=', 'Premium Plan')->whereRaw('status_date '>=' $today, INTERVAL 7 DAY)')->update(['rate' => DB::raw('rate + 1.43'), 'day_count' => DB::raw('day_count + 1'), 'returns' => DB::raw('rate / 100 * amount_btc')]);
        Transaction::where('confirms_needed', '=', 99)->where('day_count', '!=', 7)->where('plan', '=', 'Ultimate Plan')->whereRaw('status_date '>=' $today, INTERVAL 7 DAY)')->update(['rate' => DB::raw('rate + 2.14'), 'day_count' => DB::raw('day_count + 1'), 'returns' => DB::raw('rate / 100 * amount_btc')]);*/

       // $today = Carbon::now(new \DateTimeZone('Africa/Lagos'));
        Transaction::where('confirms_needed', '=', 0)->update(['status_date' => Carbon::now(), 'confirms_needed' => 99]);/*
        Transaction::where('confirms_needed', '=', 99)->where('plan', '=', 'Premium Plan')->whereRaw('status_date >= SUBDATE( NOW(), INTERVAL 7 DAY)')->update(['rate' => DB::raw('rate + 1.428571428571429'), 'returns' => DB::raw('rate / 100 * amount_btc')]);
        Transaction::where('confirms_needed', '=', 99)->where('plan', '=', 'Ultimate Plan')->whereRaw('status_date >= SUBDATE( NOW(), INTERVAL 7 DAY)')->update(['rate' => DB::raw('rate + 2.142857142857143'), 'returns' => DB::raw('rate / 100 * amount_btc')]);*/

       Transaction::where('confirms_needed', '=', 99)->where('plan', '=', 'Premium Plan')->whereRaw('status_date >= SUBDATE( NOW(), INTERVAL 7 DAY)')->update(['rate' => DB::raw('rate + 1.428571428571429'), 'returns' =>  DB::raw('rate / 100 * amount_btc')]);
        Transaction::where('confirms_needed', '=', 99)->where('plan', '=', 'Ultimate Plan')->whereRaw('status_date >= SUBDATE( NOW(), INTERVAL 7 DAY)')->update(['rate' => DB::raw('rate + 2.142857142857143'), 'returns' =>  DB::raw('rate / 100 * amount_btc')]);

        Transaction::where('confirms_needed', '=', 99)->where('plan', '=', 'Premium Plan')->where('status_date' ,'<=' , Carbon::now()->subDays(7))->update(['rate' => 0.1, 'returns' =>  DB::raw('0.1 * amount_btc'), 'status_date' => Carbon::now(), 'week_count' => DB::raw('week_count + 1'),]);
        Transaction::where('confirms_needed', '=', 99)->where('plan', '=', 'Ultimate Plan')->where('status_date' ,'<=' , Carbon::now()->subDays(7))->update(['rate' => 0.15, 'returns' =>  DB::raw('0.15 * amount_btc')]);


        return $this->info('achieved');

    }


}
