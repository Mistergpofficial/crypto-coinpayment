<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kevupton\LaravelCoinpayments\Coinpayments;
use Kevupton\LaravelCoinpayments\Exceptions\IpnIncompleteException;
use Kevupton\LaravelCoinpayments\Models\Ipn;
use Kevupton\LaravelCoinpayments\Models\Transaction;
use Kevupton\LaravelCoinpayments\Models;
use Illuminate\Support\Facades\Auth;

class CoinpaymentsController extends Controller
{
    const ITEM_CURRENCY = 'BTC';
    const ITEM_PRICE    = 0.01;

    /**
     * Purchase items using coinpayments payment processor
     *
     * @param Request $request
     * @return array
     */
    public function purchaseItems (Request $request)
    {
        // validate that the request has the appropriate values
        $this->validate($request, [
            'currency' => 'required|string',
            'amount'   => 'required|integer|min:1',
        ]);


        $amount   = $request->get('amount');
        $currency = $request->get('currency');

        /*
         * Calculate the price of the item (qty * ppu)
         */
        $cost = $amount * self::ITEM_PRICE;

        /** @var Transaction $transaction */
        $transaction = \Coinpayments::createTransactionSimple($cost, self::ITEM_CURRENCY, $currency);
       // $transaction = \Coinpayments::createTransactionSimple($cost, self::ITEM_CURRENCY, $currency);

        return ['transaction' => $transaction];


    }

    /**
     * Creates a donation transaction
     *
     * @param Request $request
     * @return array
     */


    public function checkout()
    {
      // $transaction = Transaction::all()->sortByDesc('id')->take(1);
        $transaction = Transaction::where('user_id', Auth()->user()->id)->get()->sortByDesc('user_id')->take(1);

        $transaction = Transaction::where('user_id', Auth()->user()->id)->get()->sortByAsc('user_id')->take(1);

        //$transaction = Transaction::all()->last()->id;
        return view('pages.checkout')->with('transaction', $transaction);
    }

    public function donation (Request $request)
    {
        // validate that the request has the appropriate values
        $this->validate($request, [
            'currency' => 'required|string',
            'amount'   => 'required|integer',
        ]);


        $amount   = $request->get('amount_btc');
        $amountBtc   = $request->get('amount');
        $currency = $request->get('currency');
        $buyerName = $request->get('buyer_name');
        $buyerEmail = $request->get('buyer_email');
        $userId = $request->input('id');
        $plan = $request->input('registras_plan');
      //  $currency1 = 'USD';




        /*
         * Here we are donating the exact amount that they specify.
         * So we use the same currency in and out, with the same amount value.
         */
        $transaction = \Coinpayments::createTransactionSimple($amount, $amountBtc, self::ITEM_CURRENCY, $currency, $userId, $plan, $buyerName, $buyerEmail);
      /*   $withdrawal = \Coinpayments::createWithdrawal($amount, $currency, $address);*/
        

      //  $transaction = \Coinpayments::createTransactionSimple($amount, $amountBtc, self::ITEM_CURRENCY, $currency,$userId,);
        // return ['transaction' => $transaction];

    }




    /**
     * Handled on callback of IPN
     *
     * @param Request $request
     */
    public function validateIpn (Request $request)
    {
        try {
            /** @var Ipn $ipn */
            $ipn = Coinpayments::validateIPNRequest($request);

            // if the ipn came from the API side of coinpayments merchant
            if ($ipn->isApi()) {

                /*
                 * If it makes it into here then the payment is complete.
                 * So do whatever you want once the completed
                 */

                // do something here
                 Payment::find($ipn->txn_id);
            }
        }
        catch (IpnIncompleteException $e) {
            $ipn = $e->getIpn();
            /*
             * Can do something here with the IPN model if desired.
             */
        }
    }
}